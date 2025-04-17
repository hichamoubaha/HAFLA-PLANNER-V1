<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Billing History</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }
    
    body {
      background-color: #f0f0f0;
      display: flex;
      padding: 20px;
      gap: 20px;
    }
    
    .sidebar {
      width: 260px;
      background-color: white;
      border-radius: 10px;
      padding: 20px;
    }
    
    .main-content {
      flex: 1;
      background-color: white;
      border-radius: 10px;
      padding: 20px;
    }
    
    .breadcrumb {
      font-size: 14px;
      margin-bottom: 8px;
      color: #666;
    }
    
    .breadcrumb a {
      color: #3b82f6;
      text-decoration: none;
    }
    
    h1 {
      font-size: 24px;
      margin-bottom: 20px;
      font-weight: 600;
    }
    
    h2 {
      font-size: 20px;
      margin-bottom: 20px;
      font-weight: 600;
    }
    
    .menu-item {
      display: flex;
      align-items: center;
      padding: 12px;
      border-radius: 6px;
      margin-bottom: 4px;
      color: #333;
      text-decoration: none;
    }
    
    .menu-item.active {
      background-color: #e6f0ff;
      color: #3b82f6;
    }
    
    .menu-item svg {
      margin-right: 12px;
    }
    
    .menu-item:hover {
      background-color: #f5f5f5;
    }
    
    .billing-table {
      width: 100%;
      border-collapse: collapse;
    }
    
    .billing-table th {
      text-align: left;
      padding: 12px;
      color: #6b7280;
      font-weight: 500;
      border-bottom: 1px solid #e5e7eb;
    }
    
    .billing-table td {
      padding: 12px;
      border-bottom: 1px solid #e5e7eb;
    }
    
    .status {
      padding: 6px 12px;
      border-radius: 4px;
      font-size: 14px;
      font-weight: 500;
      color: white;
      display: inline-block;
    }
    
    .status.confirmed {
      background-color: #22c55e;
    }
    
    .status.cancelled {
      background-color: #ef4444;
    }
    
    .status.pending {
      background-color: #f59e0b;
    }
    
    .btn {
      padding: 8px 12px;
      border-radius: 6px;
      border: none;
      font-size: 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .btn-view {
      background-color: white;
      border: 1px solid #d1d5db;
      color: #333;
    }
    
    .btn-export {
      background-color: #f87171;
      color: white;
    }
    
    .invoice-number {
      color: #8b5cf6;
    }
    
    .btn svg {
      margin-right: 6px;
    }
    
    .action-btns {
      display: flex;
      gap: 8px;
    }

    .logout {
      display: flex;
      align-items: center;
      margin-top: 350px;
      color: #666;
      text-decoration: none;
      padding: 12px;
    }

    .logout svg {
      margin-right: 12px;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <div class="breadcrumb">Account > Bookings</div>
    <h1>Settings</h1>
    
    <a href="#" class="menu-item">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
      </svg>
      My Profile
    </a>
    
    <a href="#" class="menu-item active">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
        <line x1="16" y1="2" x2="16" y2="6"></line>
        <line x1="8" y1="2" x2="8" y2="6"></line>
        <line x1="3" y1="10" x2="21" y2="10"></line>
      </svg>
      Bookings
    </a>
    
    <a href="#" class="menu-item">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="3"></circle>
        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
      </svg>
      Settings
    </a>
    
    <a href="#" class="menu-item">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
      </svg>
      Contact us
    </a>
    
    <a href="#" class="logout">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
        <polyline points="16 17 21 12 16 7"></polyline>
        <line x1="21" y1="12" x2="9" y2="12"></line>
      </svg>
      Logout
    </a>
  </div>
  
  <div class="main-content">
    <h2>Billing History</h2>
    
    <table class="billing-table">
      <thead>
        <tr>
          <th>DATE</th>
          <th>TYPE</th>
          <th>AMOUNT</th>
          <th>INVOICE</th>
          <th>STATUS</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>21/10/2021</td>
          <td>Basic</td>
          <td>$49.00</td>
          <td class="invoice-number">#892310</td>
          <td><span class="status confirmed">Cofirmed</span></td>
          <td>
            <div class="action-btns">
              <button class="btn btn-view">View</button>
              <button class="btn btn-export">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="7 10 12 15 17 10"></polyline>
                  <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Export Pdf
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td>21/10/2021</td>
          <td>Basic</td>
          <td>$49.00</td>
          <td class="invoice-number">#892310</td>
          <td><span class="status confirmed">Cofirmed</span></td>
          <td>
            <div class="action-btns">
              <button class="btn btn-view">View</button>
              <button class="btn btn-export">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="7 10 12 15 17 10"></polyline>
                  <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Export Pdf
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td>21/10/2021</td>
          <td>Basic</td>
          <td>$49.00</td>
          <td class="invoice-number">#892310</td>
          <td><span class="status cancelled">Cancelled</span></td>
          <td>
            <div class="action-btns">
              <button class="btn btn-view">View</button>
              <button class="btn btn-export">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="7 10 12 15 17 10"></polyline>
                  <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Export Pdf
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td>21/10/2021</td>
          <td>Basic</td>
          <td>$49.00</td>
          <td class="invoice-number">#892310</td>
          <td><span class="status confirmed">Cofirmed</span></td>
          <td>
            <div class="action-btns">
              <button class="btn btn-view">View</button>
              <button class="btn btn-export">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="7 10 12 15 17 10"></polyline>
                  <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Export Pdf
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td>21/10/2021</td>
          <td>Basic</td>
          <td>$49.00</td>
          <td class="invoice-number">#892310</td>
          <td><span class="status confirmed">Cofirmed</span></td>
          <td>
            <div class="action-btns">
              <button class="btn btn-view">View</button>
              <button class="btn btn-export">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="7 10 12 15 17 10"></polyline>
                  <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Export Pdf
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td>21/10/2021</td>
          <td>Basic</td>
          <td>$49.00</td>
          <td class="invoice-number">#892310</td>
          <td><span class="status confirmed">Cofirmed</span></td>
          <td>
            <div class="action-btns">
              <button class="btn btn-view">View</button>
              <button class="btn btn-export">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="7 10 12 15 17 10"></polyline>
                  <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Export Pdf
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td>21/10/2021</td>
          <td>Basic</td>
          <td>$49.00</td>
          <td class="invoice-number">#892310</td>
          <td><span class="status pending">Pending</span></td>
          <td>
            <div class="action-btns">
              <button class="btn btn-view">View</button>
              <button class="btn btn-export">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="7 10 12 15 17 10"></polyline>
                  <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Export Pdf
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td>21/10/2021</td>
          <td>Basic</td>
          <td>$49.00</td>
          <td class="invoice-number">#892310</td>
          <td><span class="status confirmed">Cofirmed</span></td>
          <td>
            <div class="action-btns">
              <button class="btn btn-view">View</button>
              <button class="btn btn-export">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="7 10 12 15 17 10"></polyline>
                  <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Export Pdf
              </button>
            </div>
          </td>
        </tr>
        <tr>
          <td>21/10/2021</td>
          <td>Basic</td>
          <td>$49.00</td>
          <td class="invoice-number">#892310</td>
          <td><span class="status confirmed">Cofirmed</span></td>
          <td>
            <div class="action-btns">
              <button class="btn btn-view">View</button>
              <button class="btn btn-export">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                  <polyline points="7 10 12 15 17 10"></polyline>
                  <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Export Pdf
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>