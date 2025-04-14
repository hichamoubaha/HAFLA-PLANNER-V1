<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planning Website</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        /* Header */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo img {
            height: 40px;
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 20px;
        }
        
        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }
        
        .plan-btn {
            background-color: #ff6b6b;
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
        }
        
        /* Hero Section */
        .hero {
            position: relative;
            height: 400px;
            background-size: cover;
            background-position: center;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 40px;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
        }
        
        .hero-content {
            position: absolute;
            bottom: 40px;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        
        .hero-btn {
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
        }
        
        .primary-btn {
            background: linear-gradient(to right, #ff6b6b, #ff8e8e);
            color: white;
        }
        
        .secondary-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid white;
            color: white;
        }
        
        /* Category Section */
        .section-title {
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: 600;
        }
        
        .section-title span {
            color: #ff6b6b;
        }
        
        .category-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .category-card {
            position: relative;
            height: 160px;
            border-radius: 10px;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            margin-bottom: 20px;
        }
        
        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
        }
        
        .category-name {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
            font-weight: 600;
            font-size: 18px;
        }
        
        /* Social Media Section */
        .social-section {
            text-align: center;
            margin: 60px 0;
        }
        
        .social-section h2 {
            margin-bottom: 15px;
            font-size: 24px;
        }
        
        .social-section p {
            margin-bottom: 30px;
            color: #666;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .social-icons {
            display: flex;
            justify-content: center;
            gap: 30px;
        }
        
        .social-icons img {
            height: 30px;
        }
        
        /* Packages Section */
        .packages-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .see-all {
            color: #666;
            text-decoration: none;
        }
        
        .packages-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        
        .package-card {
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #eee;
        }
        
        .package-img {
            position: relative;
            height: 180px;
            background-size: cover;
            background-position: center;
        }
        
        .package-badge {
            position: absolute;
            right: 10px;
            bottom: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
        }
        
        .package-name {
            padding: 15px;
            text-align: center;
            font-weight: 600;
        }
        
        /* Footer */
        footer {
            background-color: #ff6b6b;
            color: white;
            padding: 40px 0 20px;
            margin-top: 60px;
        }
        
        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .footer-logo {
            margin-bottom: 20px;
        }
        
        .footer-logo img {
            height: 40px;
        }
        
        .subscribe {
            margin: 20px 0 40px;
            display: flex;
            max-width: 400px;
            width: 100%;
        }
        
        .subscribe input {
            flex: 1;
            padding: 10px 15px;
            border: none;
            border-radius: 5px 0 0 5px;
        }
        
        .subscribe button {
            background-color: #333;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }
        
        .footer-social {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .footer-social a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            background-color: white;
            color: #ff6b6b;
            border-radius: 50%;
            text-decoration: none;
        }
        
        .copyright {
            text-align: right;
            font-size: 12px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="{{ asset('images/hafla_logo.png') }}" alt="Event logo">
            </div>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Register</a></li>
                </ul>
            </nav>
            <a href="#" class="plan-btn">Plan Your Event</a>
        </header>
        
        <div class="hero" style="background-image: url('{{ asset('images/party.png') }}');">
            <div class="hero-content">
                <a href="#" class="hero-btn primary-btn">Get Ticket</a>
                <a href="#" class="hero-btn secondary-btn">Learn More</a>
            </div>
        </div>
        
        <h2 class="section-title">Our <span>Category</span></h2>
        <div class="category-grid">
            <div class="category-card" style="background-image: url('{{ asset('images/wedding.png') }}');">
                <div class="category-name">Weddings</div>
            </div>
            <div class="category-card" style="background-image: url('{{ asset('images/birthday.png') }}');">
                <div class="category-name">Birthdays</div>
            </div>
            <div class="category-card" style="background-image: url('{{ asset('images/together.png') }}');">
                <div class="category-name">Get Together</div>
            </div>
            <div class="category-card" style="background-image: url('{{ asset('images/promotion.png') }}');">
                <div class="category-name">Promotion</div>
            </div>
            <div class="category-card" style="background-image: url('{{ asset('images/graduation.png') }}');">
                <div class="category-name">Graduation Party</div>
            </div>
            <div class="category-card" style="background-image: url('{{ asset('images/anniv.png') }}');">
                <div class="category-name">Anniversary</div>
            </div>
        </div>
        
        <div class="social-section">
            <h2>Follow us</h2>
            <p>Don't miss out on our updates - Stay in the loop with all our latest news and updates by following us on social media!</p>
            <div class="social-icons">
                <img src="{{ asset('images/hafla_logo.png') }}" alt="Instagram">
                <img src="{{ asset('images/hafla_logo.png') }}" alt="YouTube">
                <img src="{{ asset('images/hafla_logo.png') }}" alt="Facebook">
                <img src="{{ asset('images/hafla_logo.png') }}" alt="LinkedIn">
            </div>
        </div>
        
        <div class="packages-header">
            <h2 class="section-title">Trending <span>Packages</span></h2>
            <a href="#" class="see-all">See All</a>
        </div>
        <div class="packages-grid">
            <div class="package-card">
                <div class="package-img" style="background-image: url('{{ asset('images/hafla_logo.png') }}');">
                    <div class="package-badge">Premium</div>
                </div>
                <div class="package-name">Birthday Parties</div>
            </div>
            <div class="package-card">
                <div class="package-img" style="background-image: url('{{ asset('images/hafla_logo.png') }}');">
                    <div class="package-badge">Premium</div>
                </div>
                <div class="package-name">Birthday Parties</div>
            </div>
            <div class="package-card">
                <div class="package-img" style="background-image: url('{{ asset('images/hafla_logo.png') }}');">
                    <div class="package-badge">Premium</div>
                </div>
                <div class="package-name">Birthday Parties</div>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="{{ asset('images/hafla_logo.png') }}" alt="Event logo">
                </div>
                
                <div class="subscribe">
                    <input type="email" placeholder="Enter your mail">
                    <button>Subscribe</button>
                </div>
                
                <div class="footer-social">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                </div>
                
                <div class="copyright">
                    Non Copyrighted © 2023 Upbold by habuma sahabpa
                </div>
            </div>
        </div>
    </footer>
</body>
</html>