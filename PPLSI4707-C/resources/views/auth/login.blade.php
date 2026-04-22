<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - SKOTER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

.title {
    margin-left : 300px
}

body, html {
    height: 100%;
}

/* Container */
.container {
    position: relative;
    height: 100vh;
    background: linear-gradient(rgba(25, 55, 109, 0.9), rgba(25, 55, 109, 0.9)),
                url('/images/bg.jpg') no-repeat center center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Left diagonal shape */
.left-shape {
    position: absolute;
    left: 0;
    top: 0;
    width: 35%;
    height: 100%;
    background: #f5f5f5;
    clip-path: polygon(0 0, 100% 0, 60% 100%, 0% 100%);
}

/* Title */
.title {
    position: absolute;
    top: 40px;
    text-align: center;
    color: white;
}

.title h1 {
    font-size: 28px;
    font-weight: 600;
}

.title p {
    font-size: 16px;
}

/* Login Card */
.login-card {
    background: #fff;
    margin-left : 150px;
    padding: 40px;
    width: 500px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    z-index: 2;
}

.login-card h3 {
    margin-bottom: 20px;
}

/* Form */
.form-group {
    margin-bottom: 15px;
}

.form-group label {
    font-size: 12px;
    display: block;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ddd;
}

/* Password wrapper */
.password-wrapper {
    position: relative;
}

.password-wrapper .eye {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}

/* Button */
button {
    width: 100%;
    padding: 12px;
    background: #1e73e8;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 10px;
}

button:hover {
    background: #155ab6;
}

/* Signup */
.signup-text {
    text-align: center;
    font-size: 12px;
    margin-top: 15px;
}

.signup-text a {
    color: #1e73e8;
    text-decoration: none;
}
</style>
    <!-- Font & Style -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="container">
    <!-- Background Shape -->
    <div class="left-shape"></div>

    <!-- Overlay Content -->
    <div class="content">
        <div class="title">
            <h1>SKOTER</h1>
            <p>Sistem Koperasi Terpadu</p>
        </div>

        <div class="login-card">
            <h3>Selamat Datang!</h3>

            <form method="POST" action="#">

                <div class="form-group">
                    <label>Login</label>
                    <input type="email" placeholder="Masukkan Email">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="password-wrapper">
                        <input type="password" placeholder="Masukkan Password">
                        <span class="eye">&#128065;</span>
                    </div>
                </div>

                <button type="submit">Sign in</button>

                <p class="signup-text">
                    Dont have an account? <a href="#">Sign up now</a>
                </p>
            </form>
        </div>
    </div>
</div>

</body>
</html>