<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $obat = $_POST['obat'] ?? '';
    $penyakit = $_POST['penyakit'] ?? '';

    $error = [];

    if (empty($obat) || empty($penyakit)) {
        $error[] = "Silahkan pilih obat dan penyakit yang ingin dibeli.";
    }

    if (!empty($error)) {
        foreach ($error as $pesan) {
            echo "<p style='color:red;'>&gt; " . htmlspecialchars($pesan) . "</p>";
        }
    } else {

        
        if ($obat == 'pil') {
            $hargaObat = 30000;
        } elseif ($obat == 'tablet') {
            $hargaObat = 20000;
        } else {
            $hargaObat = 10000;
        }

        if ($penyakit == 'demam') {
            $hargaKategori = 40000;
        } elseif ($penyakit == 'flu') {
            $hargaKategori = 30000;
        } else {
            $hargaKategori = 0;
        }

        
        function totalBayar($hargaObat, $hargaKategori) {
            return $hargaObat + $hargaKategori;
        }

       
        function dapatDiskon($totalBayar) {
            if ($totalBayar >= 60000) {
                return 0.2;
            } else {
                return 0;
            }
        }

     
        function totalHarga($diskon, $totalBayar) {
            return $totalBayar - ($diskon * $totalBayar);
        }

        $totalBayar = totalBayar($hargaObat, $hargaKategori);
        $diskon = dapatDiskon($totalBayar);
        $totalHarga = totalHarga($diskon, $totalBayar);

      
        echo "<h2>Informasi Belanja</h2>";
        echo "<p>Obat: " . htmlspecialchars(ucfirst($obat)) . "</p>";
        echo "<p>Penyakit: " . htmlspecialchars(ucfirst($penyakit)) . "</p>";

        echo "<p>Total Bayar: Rp " . number_format($totalBayar, 0, ',', '.') . "</p>";

        if ($diskon == 0) {
            echo "<p>Maaf tidak ada diskon yang diberikan.</p>";
        } else {
            echo "<p>Selamat! Anda mendapatkan diskon " . htmlspecialchars($diskon * 100) . "%.</p>";
        }

        echo "<p>Total Harga: Rp " . number_format($totalHarga, 0, ',', '.') . "</p>";

        if ($penyakit == 'lainnya') {
            echo "<p>Maaf, untuk penyakit lainnya silahkan konsultasikan dengan dokter.</p>";
        }
    }
}
?>

<h2>Belanja</h2>
<h3>Daftar Stok</h3>

<form method="POST" action="?menu=B">

    <p>
        Obat:
        <br />
        <select name="obat">
            <option value="">-- Pilih Obat --</option>
            <option value="pil">Pil</option>
            <option value="tablet">Tablet</option>
            <option value="sirup">Sirup</option>
        </select>
    </p>

    <p>
        Penyakit:
        <br />
        <select name="penyakit">
            <option value="">-- Pilih Penyakit --</option>
            <option value="demam">Demam</option>
            <option value="flu">Flu</option>
            <option value="lainnya">Lainnya</option>
        </select>
    </p>

    <button type="submit">Beli</button>
</form>
