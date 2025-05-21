<?Php
session_start();
require_once 'local-shop11\Controller\loginC.php';
require_once 'local-shop11\Models\connect.php';
require_once 'local-shop11\Models\user.php';
require_once 'local-shop11\Controller\session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | LOCAL SHOP</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Segoe UI", sans-serif;
      background: rgb(102, 131, 193);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background-color: rgb(246, 246, 246);
      padding: 40px 30px;
      border-radius: 20px;
      border:10px;
      border-color: #031b43;
      box-shadow: 0 10px 25px rgba(21, 45, 139, 0.2);
      width: 100%;
      max-width: 400px;
    }

    .login-container h2 {
      margin-bottom: 20px;
      text-align: center;
      color: #333;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
      color: #444;
    }

    .form-group input {
      width: 100%;
      padding: 10px 14px;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 16px;
    }

    .login-btn {
      width: 100%;
      padding: 12px;
      border: none;
      background-color: #031b43;
      color: white;
      font-size: 16px;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .login-btn:hover {
      background-color: #1a5fd2;
    }

    .signup-link {
      margin-top: 20px;
      text-align: center;
      font-size: 14px;
    }

    .signup-link a {
      color: #041635;
      text-decoration: none;
      font-weight: bold;
    }

    .signup-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2><i class="fa-solid fa-circle-user"></i> Login</h2>

    <form action="/local-shop11/Controller/loginC.php" method="POST">
      <div class="form-group">
        <label for="email">Email or Username</label>
        <input type="text" id="email" name="email" required />
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
      </div>

      <button type="submit" class="login-btn">Login</button>
    </form>

    <div class="signup-link">
      Don't have an account?
      <a href="Csign_up.html">Sign Up</a>
    </div>
  </div>

</body>
</html>
