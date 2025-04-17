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
  </style>
</head>
<body>
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
        <input type="text" id="price" value="Rs.1000.00">
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
        <textarea id="description">We offer an hourly rate and are adaptable to your needs. We truly value the importance of creating a warm atmosphere, especially for intimate cozy weddings!</textarea>
      </div>
    </div>
    
    <div class="form-row">
      <div class="form-group">
        <label for="extras">Extras</label>
        <div style="display: flex; align-items: flex-start;">
          <textarea id="extras" style="flex: 1;">We offer an hourly rate and are adaptable to your needs.</textarea>
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