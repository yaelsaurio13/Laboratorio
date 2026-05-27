<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Login - Pugnela</title>

<style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background: linear-gradient(135deg, #f7d6d0 0%, #d8c3a5 100%);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-box {
    background: #fffaf7;
    padding: 40px;
    border-radius: 18px;
    width: 350px;
    box-shadow: 0 0 25px rgba(0,0,0,0.12);
}

h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #6b4f3f;
    font-size: 38px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #6b4f3f;
    font-weight: bold;
    font-size: 18px;
}

input {
    width: 100%;
    padding: 12px;
    border: 1px solid #d6b8a8;
    border-radius: 10px;
    background: #fff;
    box-sizing: border-box;
    font-size: 15px;
}

input:focus {
    outline: none;
    border-color: #d49a89;
    box-shadow: 0 0 5px rgba(212,154,137,0.4);
}

button {
    width: 100%;
    padding: 14px;
    background: #d89aa6;
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 17px;
    transition: 0.3s;
    margin-top: 10px;
}

button:hover {
    background: #c88492;
}

.error {
    background: #ffe0e0;
    color: #8b4b4b;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 20px;
    text-align: center;
}

.info {
    margin-top: 20px;
    padding: 14px;
    background: #f3e5dc;
    border-radius: 10px;
    font-size: 13px;
    text-align: center;
    color: #6b4f3f;
    line-height: 1.5;
}

.logo {
    text-align: center;
    font-size: 55px;
    margin-bottom: 10px;
}

.subtitle {
    text-align: center;
    color: #a67c6b;
    margin-top: -15px;
    margin-bottom: 25px;
    font-size: 15px;
}

</style>

</head>

<body>

<div class="login-box">

<div class="logo">🍥</div>

<h2>Pugnela</h2>

<p class="subtitle">
Roles & Sweet ✨
</p>

<?php if(isset($_SESSION['error'])): ?>

<div class="error">

<?php
echo $_SESSION['error'];
unset($_SESSION['error']);
?>

</div>

<?php endif; ?>

<form action="index.php?action=login" method="POST">

<div class="form-group">

<label>Email:</label>

<input type="email" name="email" required value="admin@pugnela.com">

</div>

<div class="form-group">

<label>Contraseña:</label>

<input type="password" name="password" required value="Pugnela1234">

</div>

<button type="submit">Ingresar</button>

</form>

<div class="info">

<strong>Credenciales:</strong><br>

Email: admin@pugnela.com<br>

Contraseña: Pugnela1234

</div>

</div>

</body>

</html>