<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\OperatingHour;
use App\Models\Product;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Users ─────────────────────────────────────────
        User::create([
            'name' => 'Administrator', 'email' => 'admin@gopusram.test',
            'password' => Hash::make('password'), 'role' => 'admin', 'kelas' => null,
        ]);
        User::create([
            'name' => 'Petugas PM', 'email' => 'pm@gopusram.test',
            'password' => Hash::make('password'), 'role' => 'pm', 'kelas' => 'XII PM 1',
        ]);
        User::create([
            'name' => 'Budi Santoso', 'email' => 'budi@gopusram.test',
            'password' => Hash::make('password'), 'role' => 'siswa', 'kelas' => 'XI RPL 1',
        ]);

        // ── Operating Hours ────────────────────────────────
        OperatingHour::create([
            'is_open' => true, 'jam_buka' => '07:00:00', 'jam_tutup' => '14:00:00',
        ]);

        // ── Kategori & Produk ──────────────────────────────
        $data = [
            'Minuman' => [
                ['Aqua Botol 600ml',        2000,  120, 'Air mineral segar kemasan botol 600ml'],
                ['Aqua Galon 19L',          25000,  30, 'Air mineral galon isi ulang 19 liter'],
                ['Teh Botol Sosro 350ml',   5000,   80, 'Teh manis dalam kemasan botol'],
                ['Pocari Sweat 500ml',      8000,   60, 'Minuman isotonik pengganti ion tubuh'],
                ['Mizone 500ml',            7000,   55, 'Minuman bernutrisi rasa jeruk/passion fruit'],
                ['Coca Cola Kaleng 330ml',  8000,   45, 'Minuman bersoda klasik kemasan kaleng'],
                ['Fanta Strawberry 390ml',  7000,   40, 'Minuman bersoda rasa stroberi'],
                ['Kopi Good Day Sachet',    2500,  100, 'Kopi susu instan sachet siap seduh'],
                ['Nutrisari Jeruk Sachet',  2000,   90, 'Minuman serbuk rasa jeruk vitamin C'],
                ['Susu Ultra Milk 200ml',   5000,   70, 'Susu UHT full cream kemasan kecil'],
            ],
            'Makanan Ringan' => [
                ['Chitato Sapi Panggang 68g', 10000, 55, 'Keripik kentang rasa sapi panggang'],
                ['Pringles Original 107g',   22000,  30, 'Keripik kentang premium rasa original'],
                ['Oreo Original 137g',        9000,  50, 'Biskuit sandwich cokelat dengan krim vanilla'],
                ['Roma Marie 225g',           8000,  45, 'Biskuit marie klasik renyah'],
                ['Tango Wafer Cokelat',       5000,  70, 'Wafer berlapis cokelat crispy'],
                ['Qtela Singkong 230g',      12000,  40, 'Keripik singkong aneka rasa'],
                ['Cheetos Jagung Bakar',      7000,  60, 'Snack jagung rasa jagung bakar'],
                ['Lays Original 68g',        10000,  35, 'Keripik kentang tipis rasa original'],
                ['Richeese Nabati 145g',      8000,  65, 'Wafer keju lezat berlapis krim keju'],
                ['Beng-Beng Share It',        5000,  80, 'Wafer karamel berlapis cokelat'],
            ],
            'Mie & Makanan Instan' => [
                ['Indomie Goreng Original',  3500,  150, 'Mie goreng instan rasa original terpopuler'],
                ['Indomie Soto Ayam',        3500,  120, 'Mie kuah rasa soto ayam gurih'],
                ['Indomie Rendang',          4000,   80, 'Mie goreng rasa rendang pedas'],
                ['Mie Sedaap Goreng',        3000,  100, 'Mie goreng instan dengan bumbu spesial'],
                ['Supermi Ayam Bawang',      2500,   90, 'Mie kuah rasa ayam bawang'],
                ['Pop Mie Ayam 75g',         5000,   60, 'Mie cup instan rasa ayam, tinggal seduh'],
                ['Sarimi Soto Koya',         3000,   70, 'Mie kuah dengan taburan koya gurih'],
                ['Bihun Jagung Instan',      3500,   50, 'Bihun instan berbahan jagung lebih sehat'],
            ],
            'Roti & Kue' => [
                ['Roti Tawar Sari Roti',     12000,  30, 'Roti tawar lembut kemasan 10 lembar'],
                ['Roti Kasur Cokelat',        5000,  45, 'Roti isi cokelat empuk dan lembut'],
                ['Monde Butter Cookies',     18000,  25, 'Kue kering butter premium dalam kaleng'],
                ['Serabi Solo Mini (isi 5)',   8000,  20, 'Serabi tradisional Solo isi 5 pcs'],
                ['Bolu Gulung Pandan',         7000,  30, 'Bolu gulung rasa pandan lembut'],
                ['Croissant Mini (isi 3)',     8000,  25, 'Croissant mentega mini renyah'],
            ],
            'Permen & Cokelat' => [
                ['Silver Queen Cashew 95g',  15000,  35, 'Cokelat susu dengan kacang mete premium'],
                ['KitKat 2 Finger',           8000,  50, 'Wafer cokelat renyah KitKat 2 jari'],
                ['Kopiko Kopi Candy',         3000,  80, 'Permen rasa kopi arabika asli'],
                ['Relaxa Mint',               2000,  70, 'Permen mint menyegarkan'],
                ['Sugus Aneka Rasa',          2000,  60, 'Permen lunak aneka rasa buah'],
                ['Yupi Gummy Bears',          5000,  45, 'Permen gummy berbentuk beruang lucu'],
                ['Mentos Fruit Roll',         5000,  55, 'Permen mint rasa buah-buahan'],
            ],
            'Kebutuhan Sehari-hari' => [
                ['Tisu Paseo 250 lembar',     8000,  40, 'Tisu serbaguna lembut 250 lembar'],
                ['Tisu Basah Freshtex',      10000,  30, 'Tisu basah pembersih 50 lembar'],
                ['Masker Earloop 1 pcs',      2000, 100, 'Masker 3 lapis pelindung debu dan virus'],
                ['Hand Sanitizer 60ml',      10000,  35, 'Gel pembersih tangan tanpa air 60ml'],
                ['Pulpen Standard AE7',       3000,  80, 'Pulpen tinta biru lancar untuk menulis'],
                ['Pensil 2B Faber-Castell',   3500,  60, 'Pensil 2B untuk menulis dan menggambar'],
                ['Buku Tulis Sidu 38 lembar', 4500,  50, 'Buku tulis bergaris 38 lembar'],
                ['Penghapus Steadler',        3000,  70, 'Penghapus bersih tidak merusak kertas'],
            ],
            'Frozen Food' => [
                ['Sosis So Good 375g',       25000,  20, 'Sosis ayam siap goreng kemasan 375g'],
                ['Nugget So Good 500g',      35000,  15, 'Nugget ayam crispy kemasan 500g'],
                ['Bakso Sapi Frozen 500g',   30000,  18, 'Bakso daging sapi asli kemasan beku'],
                ['Dimsum Ayam Frozen 200g',  18000,  22, 'Dimsum ayam kukus siap makan kemasan beku'],
                ['Otak-otak Ikan 200g',      15000,  25, 'Otak-otak ikan gurih kemasan beku'],
            ],
        ];

        foreach ($data as $namaKategori => $produkList) {
            $category = Category::create(['nama_kategori' => $namaKategori]);

            foreach ($produkList as [$nama, $harga, $stok, $deskripsi]) {
                Product::create([
                    'category_id' => $category->id,
                    'nama_produk' => $nama,
                    'harga'       => $harga,
                    'stok'        => $stok,
                    'deskripsi'   => $deskripsi,
                    'is_active'   => true,
                    'gambar'      => null,
                ]);
            }
        }
    }
}