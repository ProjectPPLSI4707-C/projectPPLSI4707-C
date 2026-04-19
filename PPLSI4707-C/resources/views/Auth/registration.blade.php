<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pengguna</title>
    <style>
        .registration-form {
            background-color:white;
            width: 600px;
            height: 400px;
            margin: 100px auto; 
            border-radius:30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            display:flex;
            gap:110px;
        }
    </style>
</head>
<body>

     <section class="registration-section">
         <div class="foto">
                     <img src="{{asset('storage/image/login.jpeg') }}" alt="">
                </div>
        <h2>SKOTER</h2>
        <p>Sistem Koperasi Terpadu</p>
        <div class="registration-form">
            <form action="" method="POST">
                @csrf
                <div class="wrapper1">
                    <p>Registrasi Pengguna</p>
                        <div class="namadepan">
                            <label for="first_name">Nama Depan</label>
                            <input type="text" id="first_name" name="first_name" required>
                        </div>

                        <div class="namabelakang">
                            <label for="last_name">Nama Belakang</label>
                            <input type="text" id="last_name" name="last_name" required>
                        </div>

                        <div class="nomortelepon">
                            <label for="phone">Nomor Telepon</label>
                            <input type="text" id="phone" name="phone" required>
                        </div>
                    </form>
                </div>

                 <div class="wrapper2">
                    <div class="email">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="password">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="confirm_password">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>

                    <button type="submit">Registrasi</button>
        </div>
    </section>
</body>
</html>