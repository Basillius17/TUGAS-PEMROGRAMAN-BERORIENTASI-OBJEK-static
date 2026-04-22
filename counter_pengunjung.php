<?php

class Pengunjung {
    public static $jumlah = 0;

    public function __construct() {
        self::$jumlah++;
    }

    public static function reset() {
        self::$jumlah = 0;
    }
}

// Buat 5 objek Pengunjung
$p1 = new Pengunjung();
$p2 = new Pengunjung();
$p3 = new Pengunjung();
$p4 = new Pengunjung();
$p5 = new Pengunjung();

echo "=== PRAKTIKUM 1: Static Variable ===\n\n";
echo "Jumlah Pengunjung SEBELUM reset: " . Pengunjung::$jumlah . "\n";

// Reset jumlah pengunjung
Pengunjung::reset();

echo "Jumlah Pengunjung SESUDAH reset : " . Pengunjung::$jumlah . "\n";
