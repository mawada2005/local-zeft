<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us - Local Shop</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
    }

    .navbar {
      background-color: #888;
      padding: 20px 40px;
      display: flex;
      align-items: center;
      color: white;
      position: relative;
    }

    .logo {
      font-size: 28px;
      font-weight: bold;
      font-family: 'Courier New', Courier, monospace;
      color: #fff;
      letter-spacing: 2px;
      text-shadow: 2px 2px 5px #333;
      flex: 1;
    }

    .logo span {
      color:rgb(232, 223, 186);
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 25px;
      margin: 0;
      padding: 0;
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
    }

    .nav-links li a {
      color: white;
      text-decoration: none;
      font-size: 18px;
      font-weight: bold;
    }

    .nav-links li a:hover,
    .nav-links li a.active {
      text-decoration: underline;
    }

    .icons {
      display: flex;
      gap: 20px;
      align-items: center;
    }

    .icons a {
      color: white;
      text-decoration: none;
      font-size: 20px;
    }

    .icons a:hover {
      color: #ccc;
    }

    .container {
      background-color: white;
      max-width: 900px;
      margin: 50px auto;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
      margin-bottom: 25px;
      font-size: 32px;
      color: #333;
    }

    p {
      line-height: 1.9;
      font-size: 18px;
      color: #444;
      margin-bottom: 20px;
    }

    img {
      max-width: 100%;
      border-radius: 10px;
      margin: 30px 0;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <div class="logo">LOCAL <span>SHOP</span></div>

    <ul class="nav-links">
      <li><a href="index.php">HOME</a></li>
      <li><a class="active" href="aboutus.php">ABOUT US</a></li>
      <li><a href="brands.php">BRANDS</a></li>
      <li><a href="contact.php">CONTACT US</a></li>
    </ul>

    <div class="icons">
      <a href="notifications.php"><i class="fas fa-bell"></i></a>
      <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
      <a href="login.php"><i class="fas fa-user"></i></a>
    </div>
  </div>

  <div class="container">
    <h2>About Us</h2>
    <p>
      At <strong>Local Shop</strong>, we believe shopping should be simple, fast, and tailored to your needs. We are an online store that offers a variety of products from trusted brands at fair prices and guaranteed quality.
    </p>

    <img src="https://via.placeholder.com/800x300?text=Welcome+to+Local+Shop" alt="Local Shop Banner">

    <p>
      Our goal is to provide a smooth and secure shopping experience from the comfort of your home. With our user-friendly interface and efficient order system, you can browse, choose, and place your order in just minutes.
    </p>

    <p>
      We care deeply about customer service and continuously strive to enhance your experience. Whether you’re looking for a specific product or need help placing an order, our team is always here to assist you.
    </p>

    <p>
      Thank you for choosing <strong>Local Shop</strong>. We’re proud to serve you and make local online shopping easier than ever.
    </p>
  </div>

</body>
</html>
