<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planning Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
            position: relative;
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo img {
            height: 50px;
        }
        
        nav ul {
            display: flex;
            list-style: none;
            position: relative;
        }
        
        .mobile-menu {
            display: none;
            cursor: pointer;
            font-size: 24px;
        }
        
        .mobile-menu.active {
            display: block;
        }
        
        .mobile-nav {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        
        .mobile-nav.active {
            display: block;
        }
        
        .mobile-nav ul {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        @media (max-width: 768px) {
            .mobile-menu {
                display: block;
            }
            
            nav ul {
                display: none;
            }
            
            .mobile-nav {
                display: none;
            }
            
            .mobile-nav.active {
                display: block;
            }
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
            top: 50%;
            left: 0;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            transform: translateY(-50%);
        }
        
        .hero-title {
            color: white;
            font-size: 48px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .hero-description {
            color: white;
            font-size: 18px;
            text-align: center;
            max-width: 600px;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            line-height: 1.5;
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

        /* Responsive Design */
        @media (max-width: 1200px) {
            .container {
                padding: 0 10px;
            }
        }

        @media (max-width: 992px) {
            .category-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .hero-title {
                font-size: 36px;
            }
            
            .hero-description {
                font-size: 16px;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 15px;
            }
            
            .category-grid {
                grid-template-columns: 1fr;
            }
            
            header {
                flex-direction: column;
                gap: 20px;
                padding: 15px 0;
            }
            
            nav ul {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
            
            .hero-title {
                font-size: 32px;
            }
            
            .hero-description {
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 28px;
            }
            
            .hero-description {
                font-size: 12px;
            }
            
            .hero-content {
                padding: 0 20px;
            }
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
            text-decoration: none;
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
            text-decoration: none;
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
            width: 40px;
            height: 40px;
            background-color: white;
            color: #ff6b6b;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .package-card a {
            text-decoration: none;
        }
        
        .footer-social a:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .footer-social i {
            font-size: 20px;
        }
        
        .copyright {
            text-align: right;
            font-size: 12px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.querySelector('.mobile-menu');
            const mobileNav = document.querySelector('.mobile-nav');
            mobileMenu.classList.toggle('active');
            mobileNav.classList.toggle('active');
        }
    </script>
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
                    <li><a href="{{ route('events.index') }}">Categories</></li>
                    <li><a href="{{ route('events.index') }}">Packages</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
            </nav>
            <a href="{{ route('login') }}" class="plan-btn">Login</a>
            <div class="mobile-menu" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </div>
            <div class="mobile-nav">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="{{ route('events.index') }}">Categories</></li>
                    <li><a href="#">Packages</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <a href="{{ route('login') }}" class="plan-btn">Login</a>
            </div>
        </header>
        
        <div class="hero" style="background-image: url('{{ asset('images/party.png') }}');">
            <div class="hero-content">
                <h1 class="hero-title">Welcome to Hafla Planner</h1>
                <p class="hero-description">Your ultimate event management platform for creating unforgettable moments. From weddings to corporate events, we help you plan, organize, and execute perfect events with ease.</p>
                <div style="display: flex; gap: 20px;">
                    <a href="#" class="hero-btn primary-btn">Get Ticket</a>
                    <a href="#" class="hero-btn secondary-btn">Learn More</a>
                </div>
            </div>
        </div>
        
        <h2 class="section-title">Our <span>Category</span></h2>
        <div class="category-grid">
            <a href="{{ route('events.index') }}" class="category-card" style="background-image: url('{{ asset('images/wedd.png') }}');">
                <div class="category-name">Weddings</div>
            </a>
            <a href="{{ route('events.index') }}" class="category-card" style="background-image: url('{{ asset('images/birth.png') }}');">
                <div class="category-name">Birthdays</div>
            </a>
            <a href="{{ route('events.index') }}" class="category-card" style="background-image: url('{{ asset('images/toghe.png') }}');">
                <div class="category-name">Get Together</div>
            </a>
            <a href="{{ route('events.index') }}" class="category-card" style="background-image: url('{{ asset('images/promotion.png') }}');">
                <div class="category-name">Promotion</div>
            </a>
            <a href="{{ route('events.index') }}" class="category-card" style="background-image: url('{{ asset('images/graduation.png') }}');">
                <div class="category-name">Graduation Party</div>
            </a>
            <a href="{{ route('events.index') }}" class="category-card" style="background-image: url('{{ asset('images/anniv.png') }}');">
                <div class="category-name">Anniversary</div>
            </a>
        </div>
        
        <div class="social-section">
            <h2>Follow us</h2>
            <p>Don't miss out on our updates - Stay in the loop with all our latest news and updates by following us on social media!</p>
            <div class="social-icons">
                <img src="{{ asset('images/instagram_2.png') }}" alt="Instagram">
                <img src="{{ asset('images/youtube_2.png') }}" alt="YouTube">
                <img src="{{ asset('images/facebook_2.png') }}" alt="Facebook">
                <img src="{{ asset('images/linkdin_2.png') }}" alt="LinkedIn">
            </div>
        </div>
        
        <div class="packages-header">
            <h2 class="section-title">Trending <span>Packages</span></h2>
            <a href="#" class="see-all">See All</a>
        </div>
        <div class="packages-grid">
            <a href="{{ route('events.index') }}" class="package-card">
                <div class="package-img" style="background-image: url('{{ asset('images/b-card.png') }}');">
                    <div class="package-badge">Premium</div>
                </div>
                <div class="package-name">Birthday Parties</div>
            </a>
            <a href="{{ route('events.index') }}" class="package-card">
                <div class="package-img" style="background-image: url('{{ asset('images/b-card-2.png') }}');">
                    <div class="package-badge">Premium</div>
                </div>
                <div class="package-name">Birthday Parties</div>
            </a>
            <a href="{{ route('events.index') }}" class="package-card">
                <div class="package-img" style="background-image: url('{{ asset('images/b-card-3.png') }}');">
                    <div class="package-badge">Premium</div>
                </div>
                <div class="package-name">Birthday Parties</div>
            </a>
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
                    <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
                
                <div class="copyright">
                    Non Copyrighted © 2025 Upbold by hicham oubaha
                </div>
            </div>
        </div>
    </footer>
</body>
</html>