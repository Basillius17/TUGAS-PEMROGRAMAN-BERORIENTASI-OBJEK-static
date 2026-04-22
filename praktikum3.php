<?php

// ========== CLASS PRODUK ==========
class Produk {
    public static $jumlahProduk = 0;

    public $nama;
    public $harga;

    public function __construct($nama, $harga) {
        $this->nama  = $nama;
        $this->harga = $harga;
        self::$jumlahProduk++;
    }

    public function TambahProduk() {
        // Bisa digunakan untuk menambah produk via instance
        self::$jumlahProduk++;
    }

    public function info() {
        return [
            'nama'  => $this->nama,
            'harga' => $this->harga,
        ];
    }
}

// ========== CLASS TRANSAKSI ==========
class Transaksi {
    private $produk;
    private $jumlah;

    public function __construct($produk, $jumlah) {
        $this->produk = $produk;
        $this->jumlah = $jumlah;
    }

    final public function prosesTransaksi() {
        $total = $this->produk->harga * $this->jumlah;
        return [
            'nama_produk' => $this->produk->nama,
            'harga_satuan' => $this->produk->harga,
            'jumlah'      => $this->jumlah,
            'total'       => $total,
        ];
    }
}

// ========== DATA PRODUK (minimal 3) ==========
$daftarProduk = [
    new Produk("Laptop Asus Vivobook", 7500000),
    new Produk("Mouse Wireless Logitech", 250000),
    new Produk("Keyboard Mechanical", 450000),
    new Produk("Monitor 24 inch Full HD", 2800000),
    new Produk("Headset Gaming RGB", 350000),
];

// ========== SIMULASI TRANSAKSI ==========
$transaksiList = [
    new Transaksi($daftarProduk[0], 1),
    new Transaksi($daftarProduk[1], 3),
    new Transaksi($daftarProduk[2], 2),
];

$hasilTransaksi = [];
foreach ($transaksiList as $t) {
    $hasilTransaksi[] = $t->prosesTransaksi();
}

$grandTotal = array_sum(array_column($hasilTransaksi, 'total'));

function rupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum 3 - Sistem Produk Sederhana</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a0533 50%, #0d1b2a 100%);
            min-height: 100vh;
            padding: 30px 20px;
            color: #e0e0e0;
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 6px;
            color: #c77dff;
        }

        .subtitle {
            text-align: center;
            color: #a0aec0;
            margin-bottom: 30px;
        }

        .container { max-width: 960px; margin: 0 auto; }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        @media (max-width: 640px) { .grid-2 { grid-template-columns: 1fr; } }

        .card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(199,125,255,0.2);
            border-radius: 16px;
            padding: 22px;
            backdrop-filter: blur(10px);
        }

        .card h2 {
            font-size: 1rem;
            color: #c77dff;
            margin-bottom: 16px;
            border-bottom: 1px solid rgba(199,125,255,0.25);
            padding-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Stat box */
        .stat-box {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 900;
            color: #c77dff;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #a0aec0;
            margin-top: 6px;
        }

        /* Daftar produk */
        .produk-list { display: flex; flex-direction: column; gap: 10px; }

        .produk-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(199,125,255,0.08);
            border: 1px solid rgba(199,125,255,0.15);
            border-radius: 10px;
            padding: 10px 14px;
        }

        .produk-nama { font-weight: 600; font-size: 0.95rem; }
        .produk-harga { color: #68d391; font-weight: 700; font-size: 0.9rem; }

        /* Transaksi tabel */
        .full-card { margin-bottom: 20px; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        thead th {
            background: rgba(199,125,255,0.15);
            padding: 10px 14px;
            text-align: left;
            color: #c77dff;
            font-weight: 600;
        }

        tbody tr { border-bottom: 1px solid rgba(255,255,255,0.05); }
        tbody tr:hover { background: rgba(255,255,255,0.04); }

        tbody td { padding: 10px 14px; }

        .badge {
            display: inline-block;
            background: rgba(104,211,145,0.15);
            color: #68d391;
            border-radius: 20px;
            padding: 2px 10px;
            font-size: 0.8rem;
        }

        tfoot td {
            padding: 12px 14px;
            font-weight: 700;
            color: #c77dff;
            background: rgba(199,125,255,0.08);
            border-top: 2px solid rgba(199,125,255,0.3);
        }

        /* Grand total */
        .grand-card {
            text-align: center;
            background: linear-gradient(135deg, rgba(199,125,255,0.15), rgba(104,211,145,0.1));
            border: 1px solid rgba(199,125,255,0.4);
            border-radius: 16px;
            padding: 28px;
            margin-bottom: 20px;
        }

        .grand-label { font-size: 1rem; color: #a0aec0; margin-bottom: 8px; }
        .grand-total { font-size: 2.4rem; font-weight: 900; color: #68d391; }

        /* Code info */
        .code-block {
            background: #0d1117;
            border-radius: 10px;
            padding: 16px;
            font-family: 'Consolas', monospace;
            font-size: 0.85rem;
            color: #79c0ff;
            line-height: 1.7;
            overflow-x: auto;
        }

        .kw  { color: #ff7b72; }
        .fn  { color: #d2a8ff; }
        .cm  { color: #6e7681; }
    </style>
</head>
<body>
<div class="container">

    <h1>🛒 Praktikum 3</h1>
    <p class="subtitle">Sistem Produk Sederhana — Static Variable &amp; Final Method</p>

    <!-- Stat + Produk List -->
    <div class="grid-2">
        <!-- Jumlah Produk -->
        <div class="card stat-box">
            <h2>📦 Total Produk Terdaftar</h2>
            <div class="stat-number"><?= Produk::$jumlahProduk ?></div>
            <div class="stat-label">Produk dalam sistem</div>
        </div>

        <!-- Daftar Produk -->
        <div class="card">
            <h2>🏷️ Daftar Produk</h2>
            <div class="produk-list">
                <?php foreach ($daftarProduk as $i => $p): ?>
                <div class="produk-item">
                    <span class="produk-nama"><?= htmlspecialchars($p->nama) ?></span>
                    <span class="produk-harga"><?= rupiah($p->harga) ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Tabel Transaksi -->
    <div class="card full-card">
        <h2>🧾 Simulasi Transaksi</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hasilTransaksi as $i => $h): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($h['nama_produk']) ?></td>
                    <td><?= rupiah($h['harga_satuan']) ?></td>
                    <td><span class="badge"><?= $h['jumlah'] ?> pcs</span></td>
                    <td style="color:#68d391;font-weight:700"><?= rupiah($h['total']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align:right">GRAND TOTAL</td>
                    <td><?= rupiah($grandTotal) ?></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Grand Total Card -->
    <div class="grand-card">
        <div class="grand-label">Total Pembayaran Semua Transaksi</div>
        <div class="grand-total"><?= rupiah($grandTotal) ?></div>
    </div>

    <!-- Snippet kode -->
    <div class="card">
        <h2>📄 Struktur Class</h2>
        <div class="code-block">
<span class="kw">class</span> <span class="fn">Produk</span> {<br>
&nbsp;&nbsp;<span class="kw">public static</span> $jumlahProduk = <span style="color:#f0883e">0</span>;<br>
&nbsp;&nbsp;<span class="kw">public function</span> <span class="fn">__construct</span>($nama, $harga) {<br>
&nbsp;&nbsp;&nbsp;&nbsp;$this->nama = $nama; $this->harga = $harga;<br>
&nbsp;&nbsp;&nbsp;&nbsp;self::$jumlahProduk++;<br>
&nbsp;&nbsp;}<br>
&nbsp;&nbsp;<span class="kw">public function</span> <span class="fn">TambahProduk</span>() { self::$jumlahProduk++; }<br>
}<br><br>
<span class="kw">class</span> <span class="fn">Transaksi</span> {<br>
&nbsp;&nbsp;<span class="kw">final public function</span> <span class="fn">prosesTransaksi</span>() {<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="kw">return</span> $this->produk->harga * $this->jumlah;<br>
&nbsp;&nbsp;}<br>
}
        </div>
    </div>

</div>
</body>
</html>
