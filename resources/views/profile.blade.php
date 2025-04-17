<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings - User Profile</title>
  <style>
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    body {
      background-color: #ebeef2;
      color: #333;
      display: flex;
      min-height: 100vh;
      padding: 20px;
    }

    /* Layout */
    .container {
      display: flex;
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      gap: 20px;
    }

    /* Sidebar styles */
    .sidebar {
      width: 240px;
      background-color: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      flex-shrink: 0;
    }

    .sidebar-header {
      margin-bottom: 20px;
    }

    .breadcrumb {
      font-size: 14px;
      color: #666;
      margin-bottom: 8px;
    }

    .breadcrumb a {
      color: #6366f1;
      text-decoration: none;
    }

    .page-title {
      font-size: 24px;
      font-weight: 600;
    }

    .menu {
      list-style: none;
    }

    .menu-item {
      display: flex;
      align-items: center;
      padding: 12px 0;
      color: #555;
      cursor: pointer;
      border-radius: 8px;
    }

    .menu-item.active {
      background-color: #ebf5ff;
      color: #3b82f6;
      padding: 12px;
      margin: 0 -12px;
    }

    .menu-item svg {
      margin-right: 12px;
      width: 20px;
      height: 20px;
    }

    .logout {
      display: flex;
      align-items: center;
      margin-top: auto;
      padding: 12px 0;
      color: #555;
      cursor: pointer;
      margin-top: 240px;
    }

    .logout svg {
      margin-right: 12px;
      width: 20px;
      height: 20px;
    }

    /* Main content styles */
    .main-content {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .profile-card {
      background-color: white;
      border-radius: 12px;
      padding: 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-info {
      display: flex;
      align-items: center;
    }

    .profile-avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 20px;
      background-color: #e5e7eb;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    
    .avatar-placeholder {
      color: #9ca3af;
      font-size: 24px;
    }

    .profile-name {
      font-size: 24px;
      font-weight: 600;
    }

    .edit-button {
      padding: 8px 16px;
      background-color: white;
      border: 1px solid #ff4a6c;
      color: #ff4a6c;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.2s;
    }

    .edit-button:hover {
      background-color: #fff0f3;
    }

    .profile-form {
      background-color: white;
      border-radius: 12px;
      padding: 24px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .form-row {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .form-group {
      flex: 1;
    }

    .form-label {
      display: block;
      font-size: 14px;
      color: #999;
      margin-bottom: 8px;
    }

    .form-control {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 16px;
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-header">
        <div class="breadcrumb">
          <span>Account > </span>
          <a href="#">My Profile</a>
        </div>
        <h1 class="page-title">Settings</h1>
      </div>

      <ul class="menu">
        <li class="menu-item active">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="8" r="5" />
            <path d="M20 21v-2a7 7 0 0 0-14 0v2" />
          </svg>
          My Profile
        </li>
        <li class="menu-item">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="4" width="18" height="18" rx="2" />
            <path d="M16 2v4" />
            <path d="M8 2v4" />
            <path d="M3 10h18" />
          </svg>
          Bookings
        </li>
        <li class="menu-item">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="3" />
            <path
              d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
          </svg>
          Settings
        </li>
        <li class="menu-item">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
          </svg>
          Contact us
        </li>
      </ul>

      <div class="logout">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
          <polyline points="16 17 21 12 16 7" />
          <line x1="21" y1="12" x2="9" y2="12" />
        </svg>
        Logout
      </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="profile-card">
        <div class="profile-info">
          <div class="profile-avatar">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="40" height="40">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
          </div>
          <h2 class="profile-name">Hicham Oubaha</h2>
        </div>
        <button class="edit-button">Edit Profile</button>
      </div>

      <div class="profile-form">
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" value="hicham">
          </div>
          <div class="form-group">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" value="oubaha">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group" style="flex: 1 1 100%;">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" value="hicham7">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Billing Email</label>
            <input type="email" class="form-control" value="hichamoubaha@gmail.com">
          </div>
          <div class="form-group">
            <label class="form-label">Status</label>
            <input type="text" class="form-control" value="Active">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Zip code</label>
            <input type="text" class="form-control" value="8894">
          </div>
          <div class="form-group">
            <label class="form-label">Contact</label>
            <input type="tel" class="form-control" value="+94 099 334 5422">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" value="salam 07">
          </div>
          <div class="form-group">
            <label class="form-label">City</label>
            <input type="text" class="form-control" value="casablanca">
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>