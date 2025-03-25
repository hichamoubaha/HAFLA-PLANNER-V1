<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        
        .login-section {
            width: 50%;
            padding: 2.5vh 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
        }
        
        .logo {
            margin-bottom: -8vh;
        }
        
        .logo img {
            width: 100px;
            height: auto;
        }
        
        .form-container {
            width: 100%;
            max-width: 450px;
            padding: 1vh 0;
        }
        
        h1 {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 4vh;
        }
        
        .form-group {
            margin-bottom: 2vh;
        }
        
        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 1vh;
            color: #333;
            text-transform: uppercase;
        }
        
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .button-primary {
            width: 100%;
            padding: 12px;
            background-color: #ff5a5f;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 2vh;
        }
        
        .or-divider {
            text-align: center;
            margin-bottom: 2vh;
            color: #666;
        }
        
        .google-button {
            width: 100%;
            padding: 12px;
            background-color: white;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .google-button img {
            width: 20px;
            margin-right: 10px;
        }
        
        .image-section {
            width: 50%;
            position: relative;
            overflow: hidden;
        }
        
        .image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 0 20px;
        }
        
        .overlay h2 {
            font-size: 36px;
            margin-bottom: 2vh;
        }
        
        .overlay p {
            font-size: 16px;
            margin-bottom: 3vh;
            max-width: 80%;
        }
        
        .signup-button {
            padding: 10px 30px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        
        .login-link {
            text-align: center;
            margin-top: 2vh;
        }
        
        .login-link a {
            color: #666;
            text-decoration: none;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .login-section::-webkit-scrollbar {
            display: none;
        }
        
        /* Hide scrollbar for IE, Edge and Firefox */
        .login-section {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>
<body>
    <div class="login-section">
        <div class="logo">
            <img src="{{ asset('images/hafla_logo.png') }}" alt="Event Hive Logo">
        </div>

        <div class="form-container">
            <h1>Sign In to Hafla Planner</h1>

            @if(session('success'))
                <p style="color:green;">{{ session('success') }}</p>
            @endif

            <form action="/register" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">YOUR NAME</label>
                    <input type="text" name="name" id="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">YOUR EMAIL</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">PASSWORD</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">CONFIRM PASSWORD</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required>
                </div>
                <button type="submit" class="button-primary">S'inscrire</button>
            </form>
            
            <div class="or-divider">Or</div>
            
            <button class="google-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <path fill="#4285F4" d="M19.6 10.23c0-.82-.07-1.42-.22-2.05H10v3.72h5.5c-.15.96-.76 2.39-2.24 3.35l-.01.01 3.25 2.52c1.89-1.75 2.6-4.3 2.6-7.55z"/>
                    <path fill="#34A853" d="M10 20c2.7 0 4.96-.89 6.62-2.42l-3.25-2.52c-.89.63-2.11 1.06-3.37 1.06-2.59 0-4.79-1.75-5.57-4.14l-.01.01-3.38 2.62C1.55 17.65 5.48 20 10 20z"/>
                    <path fill="#FBBC05" d="M4.43 12.09l-3.38-2.62c-.45 1.12-.7 2.33-.7 3.59s.25 2.47.7 3.59l3.38-2.62c-.22-.65-.35-1.36-.35-2.12s.13-1.47.35-2.12z"/>
                    <path fill="#EA4335" d="M10 4.04c1.45 0 2.65.48 3.65 1.42l2.71-2.71C14.96 1.15 12.7 0 10 0 5.48 0 1.55 2.35 0 5.66l3.38 2.62c.78-2.39 3-4.24 5.62-4.24z"/>
                </svg>
                Sign up with Google
            </button>
            
            <div class="login-link">
                <p>Déjà un compte ? <a href="/login">Se connecter</a></p>
            </div>
        </div>
    </div>
    
    <div class="image-section">
        <img src="{{ asset('images/registerimage.png') }}" alt="Event audience">
        <div class="overlay">
            <h2>Hello Friend</h2>
            <p>To keep connected with us provide us with your information</p>
            <button class="signup-button">Signup</button>
        </div>
    </div>
</body>
</html>

<!--register-->