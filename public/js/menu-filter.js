// Fungsi untuk memfilter kartu menu berdasarkan tab kategori yang diklik
function filterMenu(category) {
    // Ubah gaya visual tombol tab 
    const tabs = ['all', 'coffee', 'non-coffee', 'food-snack'];
    tabs.forEach(tab => {
        const btn = document.getElementById(`tab-${tab}`);
        if (btn) {
            if (tab === category) {
                btn.className = "px-6 py-3 rounded-2xl text-sm font-semibold transition-all bg-[#20622c] text-white shadow-[0_10px_20px_rgba(32,98,44,0.15)] border border-transparent";
            } else {
                btn.className = "px-6 py-3 rounded-2xl text-sm font-semibold transition-all bg-white text-neutral-600 border border-[#ebdcb9]/40 hover:bg-[#f5f3ef]";
            }
        }
    });

    // Saring kartu-kartu produk menu di halaman catalog
    const cards = document.querySelectorAll('.menu-card');
    cards.forEach(card => {

        if (category === 'all' || card.getAttribute('data-category') === category) {
            card.style.display = 'flex';
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'scale(1)';
            }, 50);
        } else {
            // Sembunyikan kartu dengan animasi transisi mengecil dan memudar
            card.style.opacity = '0';
            card.style.transform = 'scale(0.95)';
            setTimeout(() => {
                card.style.display = 'none';
            }, 300);
        }
    });
}

// Mengekspos fungsi secara global ke objek window agar pemanggilan inline HTML onclick tetap berfungsi
window.filterMenu = filterMenu;