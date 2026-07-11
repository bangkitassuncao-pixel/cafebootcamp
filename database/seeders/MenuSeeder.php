<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $items = [
            [
                'name' => 'Espresso',
                'category' => 'coffee',
                'price' => 18000,
                'description' => 'Ekstrak kopi klasik, kental dan pekat dengan crema keemasan yang tebal.',
                'image' => 'assets/images/menu/espresso.jpg',
            ],
            [
                'name' => 'Cafe Latte',
                'category' => 'coffee',
                'price' => 25000,
                'description' => 'Keseimbangan espresso yang kaya dan susu segar kukus bertekstur lembut.',
                'image' => 'assets/images/menu/cafe_latte.jpg',
            ],
            [
                'name' => 'Cappuccino',
                'category' => 'coffee',
                'price' => 25000,
                'description' => 'Espresso berpadu dengan susu panas dan lapisan busa susu tebal.',
                'image' => 'assets/images/menu/cafe_latte.jpg',
            ],
            [
                'name' => 'Caramel Macchiato',
                'category' => 'coffee',
                'price' => 28000,
                'description' => 'Espresso premium dengan sirup vanilla, susu, dan siraman saus karamel manis.',
                'image' => 'assets/images/menu/cafe_latte.jpg',
            ],
            [
                'name' => 'Matcha Latte',
                'category' => 'non-coffee',
                'price' => 26000,
                'description' => 'Teh hijau Jepang premium asli berpadu dengan kelembutan susu segar.',
                'image' => 'assets/images/menu/cafe_latte.jpg',
            ],
            [
                'name' => 'Chocolate Hazelnut',
                'category' => 'non-coffee',
                'price' => 26000,
                'description' => 'Cokelat hitam premium dipadukan dengan aroma kacang hazelnut yang manis.',
                'image' => 'assets/images/menu/cafe_latte.jpg',
            ],
            [
                'name' => 'Croissant Almond',
                'category' => 'food-snack',
                'price' => 24000,
                'description' => 'Pastry mentega renyah dengan isian krim almond manis dan taburan almond panggang.',
                'image' => 'assets/images/menu/croissant_almond.jpg',
            ],
            [
                'name' => 'Nasi Goreng Byte',
                'category' => 'food-snack',
                'price' => 32000,
                'description' => 'Nasi goreng khas Byte & Brew dengan racikan rempah istimewa, telur, dan kerupuk.',
                'image' => 'assets/images/menu/nasi_goreng_byte.jpg',
            ],
            [
                'name' => 'French Fries',
                'category' => 'food-snack',
                'price' => 18000,
                'description' => 'Kentang goreng gurih renyah dengan taburan garam laut halus dan saus cabai.',
                'image' => 'assets/images/menu/nasi_goreng_byte.jpg',
            ],
        ];

        foreach ($items as $item) {
            Menu::create($item);
        }
    }
}
