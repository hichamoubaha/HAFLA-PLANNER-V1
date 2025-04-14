<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Hafla Event Planner</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            color: #333;
            background-color: #f5f5f5;
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
            padding: 15px 0;
            background-color: white;
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo img {
            height: 40px;
        }
        
        .auth-buttons {
            display: flex;
            gap: 10px;
        }
        
        .login-btn {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }
        
        .signup-btn {
            background-color: #ff6b6b;
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
        }
        
        /* Hero Section */
        .hero {
            position: relative;
            height: 300px;
            background-size: cover;
            background-position: center;
            margin-bottom: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 0 20px;
        }
        
        .hero h1 {
            font-size: 50px;
            margin-bottom: 20px;
        }
        
        .hero p {
            font-size: 18px;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .see-more-btn {
            background-color: #ff6b6b;
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
        }
        
        /* About Us Section */
        .section-title {
            margin: 30px 0;
            font-size: 24px;
            font-weight: 600;
        }
        
        .about-box {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 40px;
        }
        
        .about-intro {
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .flower-img {
            float: left;
            margin: 0 20px 20px 0;
            width: 150px;
        }
        
        .section-header {
            background-color: #ff6b6b;
            color: white;
            padding: 8px 15px;
            margin-bottom: 20px;
            position: relative;
        }
        
        .section-header::after {
            content: '';
            position: absolute;
            top: 0;
            right: -15px;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 18px 0 18px 15px;
            border-color: transparent transparent transparent #ff6b6b;
        }
        
        .mission-text {
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .why-us-item {
            margin-bottom: 20px;
            padding-left: 20px;
            position: relative;
            line-height: 1.6;
        }
        
        .why-us-item::before {
            content: '•';
            position: absolute;
            left: 0;
            top: 0;
            color: #ff6b6b;
            font-weight: bold;
        }
        
        .why-us-title {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .stand-out-text {
            margin-top: 20px;
            line-height: 1.6;
        }
        
        .divider {
            height: 1px;
            background-color: #ddd;
            margin: 40px 0;
        }
        
        /* Contact Section */
        .contact-us {
            margin-bottom: 40px;
        }
        
        .contact-container {
            display: flex;
            gap: 30px;
            align-items: center;
        }
        
        .contact-image {
            flex: 1;
        }
        
        .contact-image img {
            max-width: 100%;
        }
        
        .contact-form {
            flex: 1;
        }
        
        .contact-heading {
            font-size: 28px;
            margin-bottom: 20px;
        }
        
        .contact-heading span {
            color: #ff6b6b;
        }
        
        .contact-intro {
            margin-bottom: 20px;
            line-height: 1.6;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        textarea.form-control {
            height: 120px;
            resize: vertical;
        }
        
        .submit-btn {
            width: 100%;
            background-color: #ff6b6b;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            margin-top: 10px;
        }
        
        /* Footer */
        footer {
            background-color: #ff6b6b;
            color: white;
            padding: 40px 0 20px;
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
        
        .footer-nav {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        
        .footer-nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }
        
        .footer-social {
            display: flex;
            gap: 15px;
            margin: 15px 0;
        }
        
        .footer-social a {
            color: #ff6b6b;
            background: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        
        .copyright {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            justify-content: space-between;
        }
        
        .chat-bubble {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #6c5ce7;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <header>
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="logo">
                <img src="{{ asset('images/hafla_logo.png') }}" alt="Hafla logo">
            </div>
            <div class="auth-buttons">
                <a href="#" class="login-btn">Login</a>
                <a href="#" class="signup-btn">Sign up</a>
            </div>
        </div>
    </header>
    
    <div class="hero" style="background-image: url('{{ asset('images/hafla_logo.png') }}');">
        <div class="hero-content">
            <h1>About Us</h1>
            <p>Hafla planner is not just about planning events; it's about creating experiences that leave a lasting impact. We believe that every event should tell a story - your story.</p>
            <a href="#" class="see-more-btn">See More</a>
        </div>
    </div>
    
    <div class="container">
        <h2 class="section-title">About Us</h2>
        
        <div class="about-box">
            <p class="about-intro">
                At Hafla Planner, we're passionate about creating memorable events that leave a lasting impression. Our dedicated team of event specialists is committed to turning your vision into reality, whether it's a corporate conference, a wedding celebration, or a community gathering.
            </p>
            
            <div>
                <img src="{{ asset('images/hafla_logo.png') }}" alt="Decorative flower" class="flower-img">
                
                <div class="section-header">Our Mission</div>
                <p class="mission-text">
                    Our mission at Hafla Planner is not just about planning events; it's about creating experiences that leave a lasting impact. We believe that every event should tell a story - your story. That's why we're dedicated to understanding your vision, your needs, and your ambitions, so we can craft an event that reflects your personality and resonates with your guests.
                </p>
                <p class="mission-text">
                    With meticulous attention to detail and a commitment to excellence, we strive to exceed your expectations at every turn. Whether you're hosting a corporate conference, a wedding celebration, or a charity gala, we'll work tirelessly to ensure that every aspect of your event is flawless – from the initial concept to the final execution.
                </p>
            </div>
            
            <div>
                <div class="section-header">Why Choose Us</div>
                
                <div class="why-us-item">
                    <div class="why-us-title">• Expertise:</div>
                    <p>With years of experience in the industry, our team brings a wealth of knowledge and expertise to every event we manage. From small intimate gatherings to large-scale productions, we have the skills and resources to execute flawless events every time.</p>
                </div>
                
                <div class="why-us-item">
                    <div class="why-us-title">• Personalized Service:</div>
                    <p>We believe in the power of personalization. That's why we take the time to understand your unique requirements and preferences, ensuring that every aspect of your event reflects your vision and exceeds your expectations and your choice.</p>
                </div>
                
                <div class="why-us-item">
                    <div class="why-us-title">• Innovation:</div>
                    <p>At Hafla Planner, we're constantly pushing the boundaries of event design and innovation. From cutting-edge technology to creative concepts, we're always exploring new ways to elevate the event experience and create unforgettable moments for you and your guests.</p>
                </div>
            </div>
            
            <div>
                <div class="section-header">How We Stand Out</div>
                <p class="stand-out-text">
                    At Hafla Planner, we stand out through our commitment to personalized service and creative innovation, ensuring that each event is uniquely tailored to our clients' vision
                </p>
            </div>
        </div>
        
        <div class="divider"></div>
        
        <div class="contact-us">
            <h2 class="section-title">Contact Us</h2>
            
            <div class="contact-container">
                <div class="contact-image">
                    <img src="{{ asset('images/hafla_logo.png') }}" alt="Contact illustration">
                </div>
                
                <div class="contact-form">
                    <h2 class="contact-heading">Lets Get in <span>Touch!</span></h2>
                    <p class="contact-intro">
                        Have a question or need assistance? Reach out to us via email, phone, or the contact form below. We're eager to assist you.
                    </p>
                    
                    <form>
                        <div class="form-group">
                            <label class="form-label">Name :</label>
                            <input type="text" class="form-control" placeholder="Enter your name here">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Email :</label>
                            <input type="email" class="form-control" placeholder="example@gmail.com">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Message :</label>
                            <textarea class="form-control" placeholder="Enter your message"></textarea>
                        </div>
                        
                        <button type="submit" class="submit-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="{{ asset('images/hafla_logo.png') }}" alt="Hafla logo">
                </div>
                
                <div class="subscribe">
                    <input type="email" placeholder="Enter your mail">
                    <button>Subscribe</button>
                </div>
                
                <div class="footer-nav">
                    <a href="#">Home</a>
                    <a href="#">About</a>
                    <a href="#">Pricing</a>
                    <a href="#">Blog</a>
                    <a href="#">Contact us</a>
                </div>
                
                <div class="footer-social">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
                
                <div class="copyright">
                    <div>Copyright © 2024 | Powered by Bygroup</div>
                    <div>Privacy Policy</div>
                </div>
            </div>
        </div>
    </footer>
    
    <div class="chat-bubble">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"></path></svg>
    </div>
</body>
</html>