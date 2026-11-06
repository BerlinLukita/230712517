<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama = $_POST['nama'] ?? '';
    $penyakit = $_POST['penyakit'] ?? '';
    $sesi = $_POST['sesi'] ?? '';

    $error = [];

    if (empty(trim($nama)) || empty(trim($penyakit)) || empty($sesi)) {
        $error[] = "Harap lengkapi semua data.";
    }

    if (!empty($nama) && !preg_match("/^[a-zA-Z ]+$/", $nama)) {
        $error[] = "Nama hanya boleh mengandung huruf dan spasi.";
    }

    if (!empty($error)) {
        foreach ($error as $pesan) {
            echo "<p style='color:red;'>&gt; " . htmlspecialchars($pesan) . "</p>";
        }
    } else {

        if ($sesi == '1') {
            $tempat = "Ruang dr. Jung di Lantai 3";
        } else {
            $tempat = "Online Meeting (Zoom)";
        }

        echo "<h2>Informasi Pendaftaran</h2>";
        echo "<p>Nama: " . htmlspecialchars($nama) . "</p>";
        echo "<p>Penyakit: " . htmlspecialchars($penyakit) . "</p>";
        echo "<p>Sesi: " . htmlspecialchars($sesi) . "</p>";
        echo "<p>Tempat Konsultasi: " . htmlspecialchars($tempat) . "</p>";
        echo "<p>Keterangan: Anda mendapat pada sesi '" . htmlspecialchars($sesi) . "' di " . htmlspecialchars($tempat) . ". Silahkan hadir tepat waktu.</p>";
    }
}
?>

<h2>Pendaftaran Konsultasi</h2>

<form method="POST" action="?menu=p">
    <p>
        Nama:
        <br />
        <input type="text" name="nama" />
    </p>

    <p>
        Penyakit:
        <br />
        <input type="text" name="penyakit" />
    </p>

    <p>
        Sesi:
        <br />
        <select name="sesi">
            <option value="">-- Pilih Sesi --</option>
            <option value="1">Sesi 1</option>
            <option value="2">Sesi 2</option>
        </select>
    </p>

    <button type="submit">Daftar</button>
</form>
