<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Package</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
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
    h1 {
      font-size: 24px;
      margin-bottom: 20px;
    }
    .form-container {
      max-width: 1100px;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      padding: 20px;
      background-color: #f9f9f9;
    }
    .form-row {
      display: flex;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }
    .form-group {
      flex: 1;
      min-width: 300px;
      margin-right: 20px;
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: normal;
    }
    .required::before {
      content: "* ";
      color: red;
    }
    select, input[type="text"], input[type="number"], textarea {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
      box-sizing: border-box;
    }
    textarea {
      resize: vertical;
      min-height: 100px;
    }
    .upload-section {
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      padding: 20px;
      background-color: white;
      margin-bottom: 20px;
    }
    .upload-text {
      color: #666;
      margin-bottom: 10px;
      font-size: 14px;
    }
    .no-images {
      color: #666;
      margin-top: 20px;
      text-align: center;
    }
    .upload-btn {
      background-color: white;
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 8px 15px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      font-size: 14px;
    }
    .upload-btn svg {
      margin-right: 5px;
    }
    .button-container {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 20px;
    }
    .cancel-btn {
      background-color: #ff5252;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      cursor: pointer;
    }
    .save-btn {
      background-color: #5858ff;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      cursor: pointer;
    }
    .tag-container {
      display: flex;
      flex-wrap: wrap;
      gap: 5px;
      align-items: center;
    }
    .tag {
      background-color: #f0f0f0;
      padding: 2px 8px;
      border-radius: 3px;
      font-size: 14px;
      display: flex;
      align-items: center;
    }
    .tag-close {
      margin-left: 5px;
      cursor: pointer;
      color: #666;
    }
    .plus-btn {
      background-color: #f0f0f0;
      border: 1px solid #ccc;
      width: 24px;
      height: 24px;
      border-radius: 3px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
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
  <h1>Add New Package</h1>
  
  <div class="form-container">
    <div class="form-row">
      <div class="form-group">
        <label for="package-type">Package Type</label>
        <select id="package-type">
          <option selected>Basic</option>
        </select>
      </div>
      
      <div class="form-group">
        <label class="required" for="package-image">Package Image</label>
        <div class="upload-section">
          <div class="upload-text">Supported Formats: jpg, jpeg, png</div>
          <button class="upload-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
              <polyline points="17 8 12 3 7 8"></polyline>
              <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
            Click to Upload
          </button>
          <div class="no-images">No images for this package</div>
        </div>
      </div>
    </div>
    
    <div class="form-row">
      <div class="form-group">
        <label for="event-type">Event Type</label>
        <select id="event-type">
          <option selected>Wedding</option>
        </select>
      </div>
      
      <div class="form-group">
        <label class="required" for="package-content">Package Content</label>
        <div class="upload-section">
          <div class="upload-text">Supported Formats: jpg, jpeg, png</div>
          <button class="upload-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
              <polyline points="17 8 12 3 7 8"></polyline>
              <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
            Click to Upload
          </button>
          <div class="no-images">No images for this package</div>
        </div>
      </div>
    </div>
    
    <div class="form-row">
      <div class="form-group">
        <label for="price">Price</label>
        <input type="text" id="price">
      </div>
    </div>
    
    <div class="form-row">
      <div class="form-group">
        <label for="inventories">Inventories</label>
        <div class="tag-container">
          <div class="tag">
            chair
            <span class="tag-close">×</span>
          </div>
          <div class="tag">
            tables
            <span class="tag-close">×</span>
          </div>
        </div>
      </div>
    </div>
    
    <div class="form-row">
      <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description"></textarea>
      </div>
    </div>
    
    <div class="form-row">
      <div class="form-group">
        <label for="extras">Extras</label>
        <div style="display: flex; align-items: flex-start;">
          <textarea id="extras" style="flex: 1;"></textarea>
          <div class="plus-btn">+</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="button-container">
    <button class="cancel-btn">Cancel</button>
    <button class="save-btn">Save</button>
  </div>
</body>
</html>