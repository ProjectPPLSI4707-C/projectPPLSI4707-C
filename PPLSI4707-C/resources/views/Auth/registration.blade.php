<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrasi Pengguna</title>
<style>
body{
    font-family: Arial, sans-serif;
    background: #f5f7fa;
}

.registration-section{
    text-align: center;
}

.registration-form{
    background-color:white;
    width: 750px;
    margin: 50px auto;
    border-radius:30px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    padding:30px;
}

.foto img{
    width:200px;
    border-radius:20px;
}

.form-row{
    display:flex;
    gap:40px;
}

.wrapper1, .wrapper2{
    flex:1;
    text-align:left;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

label{
    font-size:14px;
    display:block;
    margin-bottom:5px;
}

input{
    width:100%;
    height:40px;
    border:none;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
    border-radius:20px;
    padding:0 15px;
    margin-bottom:15px;
}

input:focus{
    outline:none;
    box-shadow: 0 0 0 2px #2563eb;
}

button{
    width:100%;
    height:45px;
    border:none;
    border-radius:25px;
    background:#2563eb;
    color:white;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
    margin-top:20px;
}

button:hover{
    background:#1e4fd1;
}

h2{
    margin-top:20px;
}

@media(max-width:768px){
    .form-row{
        flex-direction:column;
    }
    .registration-form{
        width:90%;
    }
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

            <div class="form-row">
                <!-- KIRI -->
                <div class="wrapper1">
                    <p><b>Registrasi Pengguna</b></p>

                    <label>Nama Depan</label>
                    <input type="text" name="first_name" required>

                    <label>Nama Belakang</label>
                    <input type="text" name="last_name" required>

                    <label>Nomor Telepon</label>
                    <input type="text" name="phone" required>
                </div>

                <!-- KANAN -->
                <div class="wrapper2">
                    <label>Email</label>
                    <input type="email" name="email" required>

                    <label>Password</label>
                    <input type="password" name="password" required>

                    <label>Konfirmasi Password</label>
                    <input type="password" name="confirm_password" required>
                </div>
            </div>

            <!-- BUTTON DI BAWAH -->
            <button type="submit">Registrasi</button>
        </form>
    </div>
</section>

</body>
</html>