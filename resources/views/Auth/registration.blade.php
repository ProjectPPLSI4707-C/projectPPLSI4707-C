<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body, html {
            height: 100%;
        }

        /* Background */
        .container {
            position: relative;
            height: 100vh;
            background: linear-gradient(rgba(25,55,109,0.9), rgba(25,55,109,0.9)),
                        url('/images/bg.jpg') center/cover no-repeat;
        }

        /* Shape kiri */
        .left-shape {
            position: absolute;
            width: 30%;
            height: 100%;
            background: #eee;
            clip-path: polygon(0 0, 100% 0, 60% 100%, 0% 100%);
        }

        /* Title */
        .title {
            text-align: center;
            color: white;
            padding-top: 30px;
        }

        .title h1 {
            font-size: 28px;
            font-weight: 600;
        }

        .title p {
            font-size: 16px;
        }

        /* Card */
        .card {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #f8f8f8;
            padding: 30px 40px;
            border-radius: 20px;
            width: 600px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .card h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Grid form */
        .grid {
            display: flex;
            gap: 20px;
        }

        .col {
            width: 50%;
        }

        label {
            font-size: 12px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0 12px;
            border-radius: 8px;
            border: 1px solid #7aa7d9;
        }

        /* Error */
        .error {
            color: red;
            font-size: 12px;
            text-align: center;
            margin-bottom: 10px;
        }

        /* Button */
        button {
            display: block;
            margin: 0 auto;
            background: #0b3c7c;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 10px;
            cursor: pointer;
        }

        button:hover {
            background: #082c5c;
        }

        /* Dropdown kanan bawah */
        .dropdown {
            position: absolute;
            right: 50px;
            bottom: 50px;
        }

        .dropdown-btn {
            background: #eee;
            padding: 8px 12px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        .dropdown-menu {
            margin-top: 5px;
            background: #eee;
            border-radius: 10px;
            overflow: hidden;
        }

        .dropdown-menu div {
            padding: 10px;
            cursor: pointer;
        }

        .dropdown-menu div:hover {
            background: #ddd;
        }
    </style>
    <meta charset="UTF-8">
    <title>Register - SKOTER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

<div class="container">

    <!-- Background kiri -->
    <div class="left-shape"></div>

    <!-- Judul -->
    <div class="title">
        <h1>SKOTER</h1>
        <p>Sistem Koperasi Terpadu</p>
    </div>

    <!-- Card -->
    <div class="card">
        <h3>Registrasi Pengguna</h3>

        <form>
            <div class="grid">

                <!-- KIRI -->
                <div class="col">
                    <label>Nama Depan</label>
                    <input type="text">

                    <label>Nama Belakang</label>
                    <input type="text">

                    <label>Nomor Telepon</label>
                    <input type="text">
                </div>

                <!-- KANAN -->
                <div class="col">
                    <label>Alamat Email</label>
                    <input type="email">

                    <label>Password</label>
                    <input type="password">

                    <label>Konfirmasi Password</label>
                    <input type="password">
                </div>

            </div>

            <p class="error">
                *Silahkan Sesuaikan Kembali Data yang sudah Anda Input
            </p>

            <button type="submit">Registrasi</button>
        </form>
    </div>

    <!-- Dropdown kanan bawah -->
    <div class="dropdown">
        <button class="dropdown-btn">Registrasi Sebagai ▾</button>
        <div class="dropdown-menu">
            <div>Member</div>
            <div>Non member</div>
            <div>Polish Pope</div>
        </div>
    </div>

</div>

</body>
</html>