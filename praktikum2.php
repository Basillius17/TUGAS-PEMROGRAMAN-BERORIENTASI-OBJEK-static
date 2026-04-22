<?php

class Matematika {
    public static function kali($a, $b) {
        return $a * $b;
    }

    public static function bagi($a, $b) {
        if ($b == 0) {
            return "Error: Pembagi tidak boleh nol!";
        }
        return $a / $b;
    }

    public static function tambah($a, $b) {
        return $a + $b;
    }

    public static function kurang($a, $b) {
        return $a - $b;
    }

    public static function luasPersegi($sisi) {
        return $sisi * $sisi;
    }
}

// Ambil nilai dari form jika ada
$angka1   = isset($_POST['angka1'])   ? (float) $_POST['angka1']   : null;
$angka2   = isset($_POST['angka2'])   ? (float) $_POST['angka2']   : null;
$sisi     = isset($_POST['sisi'])     ? (float) $_POST['sisi']     : null;
$operasi  = isset($_POST['operasi'])  ? $_POST['operasi']           : null;

$hasilOperasi = null;
$hasilPersegi = null;

if ($angka1 !== null && $angka2 !== null && $operasi) {
    switch ($operasi) {
        case 'tambah': $hasilOperasi = Matematika::tambah($angka1, $angka2); break;
        case 'kurang': $hasilOperasi = Matematika::kurang($angka1, $angka2); break;
        case 'kali':   $hasilOperasi = Matematika::kali($angka1, $angka2);   break;
        case 'bagi':   $hasilOperasi = Matematika::bagi($angka1, $angka2);   break;
    }
}

if ($sisi !== null) {
    $hasilPersegi = Matematika::luasPersegi($sisi);
}

// Contoh output langsung (tanpa form)
$contohKali  = Matematika::kali(4, 5);
$contohBagi  = Matematika::bagi(10, 2);
$contohTambah = Matematika::tambah(8, 3);
$contohKurang = Matematika::kurang(15, 7);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum 2 - Static Method</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            padding: 30px 20px;
            color: #e0e0e0;
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 10px;
            color: #e94560;
        }

        .subtitle {
            text-align: center;
            color: #a0aec0;
            margin-bottom: 30px;
            font-size: 0.95rem;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            backdrop-filter: blur(10px);
        }

        .card h2 {
            font-size: 1.1rem;
            color: #e94560;
            margin-bottom: 16px;
            border-bottom: 1px solid rgba(233,69,96,0.3);
            padding-bottom: 8px;
        }

        /* Contoh output */
        .result-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
        }

        .result-item {
            background: rgba(233,69,96,0.1);
            border: 1px solid rgba(233,69,96,0.3);
            border-radius: 10px;
            padding: 14px;
            text-align: center;
        }

        .result-item .label {
            font-size: 0.8rem;
            color: #a0aec0;
            margin-bottom: 6px;
        }

        .result-item .value {
            font-size: 1.4rem;
            font-weight: bold;
            color: #68d391;
        }

        /* Form */
        .form-row {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: flex-end;
            margin-bottom: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex: 1;
            min-width: 120px;
        }

        label {
            font-size: 0.85rem;
            color: #a0aec0;
        }

        input[type="number"], select {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 8px;
            padding: 10px 14px;
            color: #fff;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.2s;
        }

        input[type="number"]:focus, select:focus {
            border-color: #e94560;
        }

        select option { background: #1a1a2e; }

        button[type="submit"] {
            background: linear-gradient(135deg, #e94560, #c23152);
            border: none;
            border-radius: 8px;
            padding: 10px 24px;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.1s, box-shadow 0.2s;
            white-space: nowrap;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 14px rgba(233,69,96,0.5);
        }

        .hasil-box {
            background: rgba(104,211,145,0.1);
            border: 1px solid rgba(104,211,145,0.3);
            border-radius: 10px;
            padding: 14px 20px;
            font-size: 1.1rem;
            color: #68d391;
            text-align: center;
            margin-top: 10px;
        }

        .code-block {
            background: #0d1117;
            border-radius: 10px;
            padding: 16px;
            font-family: 'Consolas', monospace;
            font-size: 0.88rem;
            color: #79c0ff;
            line-height: 1.6;
            overflow-x: auto;
        }

        .code-block .kw    { color: #ff7b72; }
        .code-block .fn    { color: #d2a8ff; }
        .code-block .str   { color: #a5d6ff; }
        .code-block .num   { color: #f0883e; }
        .code-block .cmt   { color: #6e7681; }
    </style>
</head>
<body>
<div class="container">
    <h1>⚙️ Praktikum 2</h1>
    <p class="subtitle">Static Method — Kelas Matematika</p>

    <!-- Contoh Output Langsung -->
    <div class="card">
        <h2>📊 Output Contoh (Tanpa Form)</h2>
        <div class="result-grid">
            <div class="result-item">
                <div class="label">Kali(4, 5)</div>
                <div class="value"><?= $contohKali ?></div>
            </div>
            <div class="result-item">
                <div class="label">Bagi(10, 2)</div>
                <div class="value"><?= $contohBagi ?></div>
            </div>
            <div class="result-item">
                <div class="label">Tambah(8, 3)</div>
                <div class="value"><?= $contohTambah ?></div>
            </div>
            <div class="result-item">
                <div class="label">Kurang(15, 7)</div>
                <div class="value"><?= $contohKurang ?></div>
            </div>
        </div>
    </div>

    <!-- Kalkulator operasi -->
    <div class="card">
        <h2>🔢 Kalkulator Operasi Matematika</h2>
        <form method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label>Angka 1</label>
                    <input type="number" name="angka1" step="any"
                           value="<?= htmlspecialchars($_POST['angka1'] ?? '') ?>" placeholder="0">
                </div>
                <div class="form-group">
                    <label>Operasi</label>
                    <select name="operasi">
                        <option value="tambah" <?= ($operasi=='tambah')?'selected':'' ?>>Tambah (+)</option>
                        <option value="kurang" <?= ($operasi=='kurang')?'selected':'' ?>>Kurang (−)</option>
                        <option value="kali"   <?= ($operasi=='kali')  ?'selected':'' ?>>Kali (×)</option>
                        <option value="bagi"   <?= ($operasi=='bagi')  ?'selected':'' ?>>Bagi (÷)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Angka 2</label>
                    <input type="number" name="angka2" step="any"
                           value="<?= htmlspecialchars($_POST['angka2'] ?? '') ?>" placeholder="0">
                </div>
                <!-- Simpan sisi jika ada -->
                <input type="hidden" name="sisi" value="<?= htmlspecialchars($_POST['sisi'] ?? '') ?>">
                <button type="submit">Hitung</button>
            </div>
        </form>
        <?php if ($hasilOperasi !== null): ?>
        <div class="hasil-box">
            Hasil: <strong><?= $hasilOperasi ?></strong>
        </div>
        <?php endif; ?>
    </div>

    <!-- Kalkulator luas persegi -->
    <div class="card">
        <h2>⬛ Hitung Luas Persegi</h2>
        <form method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label>Panjang Sisi</label>
                    <input type="number" name="sisi" step="any"
                           value="<?= htmlspecialchars($_POST['sisi'] ?? '') ?>" placeholder="0">
                </div>
                <!-- Simpan nilai operasi jika ada -->
                <input type="hidden" name="angka1" value="<?= htmlspecialchars($_POST['angka1'] ?? '') ?>">
                <input type="hidden" name="angka2" value="<?= htmlspecialchars($_POST['angka2'] ?? '') ?>">
                <input type="hidden" name="operasi" value="<?= htmlspecialchars($_POST['operasi'] ?? '') ?>">
                <button type="submit">Hitung Luas</button>
            </div>
        </form>
        <?php if ($hasilPersegi !== null): ?>
        <div class="hasil-box">
            Luas Persegi (<?= $_POST['sisi'] ?> × <?= $_POST['sisi'] ?>) = <strong><?= $hasilPersegi ?></strong>
        </div>
        <?php endif; ?>
    </div>

    <!-- Kode class -->
    <div class="card">
        <h2>📄 Source Code: Class Matematika</h2>
        <div class="code-block">
<span class="kw">class</span> <span class="fn">Matematika</span> {<br>
&nbsp;&nbsp;<span class="kw">public static function</span> <span class="fn">kali</span>($a, $b) { <span class="kw">return</span> $a * $b; }<br>
&nbsp;&nbsp;<span class="kw">public static function</span> <span class="fn">bagi</span>($a, $b) { <span class="kw">return</span> $a / $b; }<br>
&nbsp;&nbsp;<span class="kw">public static function</span> <span class="fn">tambah</span>($a, $b) { <span class="kw">return</span> $a + $b; }<br>
&nbsp;&nbsp;<span class="kw">public static function</span> <span class="fn">kurang</span>($a, $b) { <span class="kw">return</span> $a - $b; }<br>
&nbsp;&nbsp;<span class="kw">public static function</span> <span class="fn">luasPersegi</span>($sisi) { <span class="kw">return</span> $sisi * $sisi; }<br>
}
        </div>
    </div>
</div>
</body>
</html>
