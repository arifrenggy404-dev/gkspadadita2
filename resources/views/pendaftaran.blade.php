<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pendaftaran Katekesasi</title>
    <style>
        body { font-family: 'Arial', sans-serif; background: #f4f4f4; padding: 20px; }
        .container { background: white; max-width: 600px; margin: auto; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { color: #003366; margin-bottom: 20px; text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; background: #003366; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-top: 10px; }
        button:hover { background: #002244; }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #003366; text-decoration: none; }
    </style>
</head>
<body>

<div class="container">
    <h2>Formulir Pendaftaran Katekesasi</h2>
    <form action="#" method="POST">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" required>
        </div>
        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jk">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" required>
        </div>
        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" required>
        </div>
        <div class="form-group">
            <label>Nama Ayah</label>
            <input type="text" name="nama_ayah">
        </div>
        <div class="form-group">
            <label>Nama Ibu</label>
            <input type="text" name="nama_ibu">
        </div>
        <div class="form-group">
            <label>Nomor Telepon / WhatsApp</label>
            <input type="tel" name="telepon" required>
        </div>
        <button type="submit">Kirim Pendaftaran</button>
    </form>
    <a href="index.html" class="back-link">← Kembali ke Beranda</a>
</div>

</body>
</html>