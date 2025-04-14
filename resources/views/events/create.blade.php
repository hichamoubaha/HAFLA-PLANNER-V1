<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event - Hafla Planner</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f9f9f9;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }
        
        .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
        }
        
        .logo span {
            color: #ff6b6b;
        }
        
        .auth-buttons {
            display: flex;
            gap: 10px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .btn-outline {
            background: none;
            border: none;
        }
        
        .btn-primary {
            background-color: #ff6b6b;
            color: white;
            border: none;
        }
        
        .form-container {
            padding: 20px 0;
        }
        
        h1, h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }
        
        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        
        label {
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        input, textarea {
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
        }
        
        .image-upload {
            background-color: #eee;
            border-radius: 5px;
            height: 180px;
        }
        
        textarea {
            resize: none;
            height: 120px;
        }
        
        .submit-btn {
            background-color: #ff6b6b;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                Hafla <span>Planner</span>
            </div>
            <div class="auth-buttons">
                <button class="btn btn-outline">Login</button>
                <button class="btn btn-primary">Signup</button>
            </div>
        </header>
        
        <div class="form-container">
            <h1>Create Event</h1>
            
            <form>
                <div class="form-group">
                    <label>Event Title</label>
                    <input type="text" placeholder="Enter your mail">
                </div>
                
                <div class="form-group">
                    <label>Event Venue</label>
                    <input type="text" placeholder="Enter your mail">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Start time</label>
                        <input type="text" placeholder="Enter your mail">
                    </div>
                    
                    <div class="form-group">
                        <label>End time</label>
                        <input type="text" placeholder="Enter your mail">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Start date</label>
                        <input type="text" placeholder="Enter your mail">
                    </div>
                    
                    <div class="form-group">
                        <label>End date</label>
                        <input type="text" placeholder="Enter your mail">
                    </div>
                </div>
                
                <h2>Event Description</h2>
                
                <div class="form-group">
                    <label>Event Image</label>
                    <div class="image-upload"></div>
                </div>
                
                <div class="form-group">
                    <label>Event Description</label>
                    <textarea placeholder="Type here..."></textarea>
                </div>
                
                <button type="submit" class="submit-btn">Create event</button>
            </form>
        </div>
    </div>
</body>
</html>