<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderReceiptMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CafeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

    public function menu()
    {
        $menus = Menu::all();
        return view('menu', compact('menus'));
    }

    public function dineIn()
    {
        $menus = Menu::all();
        return view('order.dine-in', compact('menus'));
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'table_number' => 'required|integer|min:1|max:12',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string|in:cash,qris,transfer',
        ]);

        try {
            // Jalankan transaksi database
            $order = DB::transaction(function () use ($request) {
                // Fetch all menus in the request to calculate price securely on server side
                $menuIds = collect($request->items)->pluck('id');
                $menus = Menu::whereIn('id', $menuIds)->get()->keyBy('id');

                $subtotal = 0;
                $orderItemsData = [];

                foreach ($request->items as $item) {
                    $menu = $menus->get($item['id']);
                    if (!$menu) {
                        throw new \Exception('Menu tidak ditemukan.');
                    }
                    
                    $itemTotal = $menu->price * $item['quantity'];
                    $subtotal += $itemTotal;

                    $orderItemsData[] = [
                        'menu_id' => $menu->id,
                        'quantity' => $item['quantity'],
                        'price' => $menu->price,
                    ];
                }

                $tax = (int) round($subtotal * 0.1);
                $total = $subtotal + $tax;

                // Generate order code (BB-xxxx)
                $orderCode = 'BB-' . mt_rand(1000, 9999);
                while (Order::where('order_code', $orderCode)->exists()) {
                    $orderCode = 'BB-' . mt_rand(1000, 9999);
                }

                $newOrder = Order::create([
                    'order_code' => $orderCode,
                    'customer_name' => $request->customer_name,
                    'customer_email' => $request->customer_email,
                    'table_number' => $request->table_number,
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'total' => $total,
                    'payment_method' => $request->payment_method,
                    'status' => 'pending',
                ]);

                foreach ($orderItemsData as $itemData) {
                    $newOrder->items()->create($itemData);
                }

                return $newOrder;
            });

            // Kirim email resi setelah database transaksi sukses committed
            try {
                Mail::to($order->customer_email)->send(new OrderReceiptMail($order));
            } catch (\Exception $mailException) {
                // Catat di log saja agar user tidak mendapati error 500 jika SMTP offline
                Log::warning('Gagal mengirimkan email struk ke ' . $order->customer_email . ': ' . $mailException->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil disimpan.',
                'order' => [
                    'order_code' => $order->order_code,
                    'customer_name' => $order->customer_name,
                    'customer_email' => $order->customer_email,
                    'table_number' => $order->table_number,
                    'subtotal' => $order->subtotal,
                    'tax' => $order->tax,
                    'total' => $order->total,
                    'payment_method' => $order->payment_method,
                    'date' => $order->created_at->translatedFormat('d M Y, H:i'),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat pesanan: ' . $e->getMessage()
            ], 500);
        }
    }
}