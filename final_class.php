<?php

final class Database {

    public function connect() {
        echo "Koneksi database";
    }

}

// ✅ Penggunaan yang benar (langsung pakai class Database)
$db = new Database();
$db->connect(); // Output: Koneksi database

/*
// ❌ ERROR jika dilakukan — final class tidak bisa di-extend!
class MyDB extends Database {   // Fatal Error!

}
*/

