<?php

class Kendaraan {

    final public function mesin() {
        echo "Mesin standar";
    }

}

// Class Mobil boleh extends Kendaraan,
// tapi TIDAK BOLEH override method mesin() yang final
class Mobil extends Kendaraan {

    public function info() {
        echo "Ini adalah kendaraan jenis Mobil";
    }

}

// ✅ Penggunaan yang benar
$k = new Kendaraan();
$k->mesin(); // Output: Mesin standar

echo "\n";

$m = new Mobil();
$m->mesin(); // Output: Mesin standar (diwarisi dari Kendaraan)
$m->info();  // Output: Ini adalah kendaraan jenis Mobil

/*
// ❌ ERROR jika Mobil mencoba override mesin():
class Mobil extends Kendaraan {
    public function mesin() {        // Fatal Error!
        echo "Mesin mobil";
    }
}
*/

