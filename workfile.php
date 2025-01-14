<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
    }

    .invoice-container {
      width: 800px;
      margin: 20px auto;
      background: #fff;
      padding: 20px;
      border: 1px solid #ccc;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .header img {
      max-height: 100px;
    }

    .header h1 {
      margin: 10px 0;
      font-size: 24px;
    }

    .header p {
      margin: 5px 0;
    }

    .details, .table-container, .footer {
      margin-bottom: 20px;
    }

    .details table {
      width: 100%;
      border-collapse: collapse;
    }

    .details td {
      padding: 5px;
    }

    .details td.label {
      font-weight: bold;
      width: 150px;
    }

    .table-container table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    .table-container th, .table-container td {
      border: 1px solid #ccc;
      padding: 8px;
    }

    .table-container th {
      background-color: #f4f4f4;
    }

    .footer {
      font-size: 14px;
    }

    .footer p {
      margin: 5px 0;
    }

    .bank-details, .total-amount {
      margin-top: 20px;
    }

    .bank-details {
      font-size: 14px;
    }

    .total-amount {
      font-size: 18px;
      font-weight: bold;
      text-align: right;
    }
  </style>
</head>
<body>
  <div class="invoice-container">
    <div class="header">
      <img src="your-logo-url.jpg" alt="Sri Karthikeyan Textiles">
      <h1>SRI KARTHIKEYAN TEXTILES</h1>
      <p>290, Eswaran Kovil Street, Erode - 638 001, TN</p>
      <p>Phone: 90952 57075</p>
    </div>

    <div class="details">
      <table>
        <tr>
          <td class="label">To M/s:</td>
          <td>J.R. TRADERS</td>
          <td class="label">Invoice No:</td>
          <td>298</td>
        </tr>
        <tr>
          <td class="label">Address:</td>
          <td>KANNUR</td>
          <td class="label">Date:</td>
          <td>26/11/24</td>
        </tr>
        <tr>
          <td class="label">GSTIN:</td>
          <td>32ADHFJ5508N1Z3</td>
          <td class="label">State:</td>
          <td>KERALA (State Code: 32)</td>
        </tr>
      </table>
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Bale No</th>
            <th>Particulars</th>
            <th>HSN Code</th>
            <th>Pcs</th>
            <th>Metre</th>
            <th>Rate</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Diamond Meji</td>
            <td>5208</td>
            <td>10</td>
            <td>208</td>
            <td>52</td>
            <td>10816</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Diamond Pit</td>
            <td></td>
            <td>150</td>
            <td></td>
            <td>104</td>
            <td>15600</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="footer">
      <p>Invoice Amount (Before Tax): 26416</p>
      <p>IGST: 1321</p>
      <p>Total Amount (After Tax): 27737</p>
    </div>

    <div class="bank-details">
      <p><strong>Bank Details:</strong></p>
      <p>PUNJAB NATIONAL BANK, R.G. Street, Erode Branch</p>
      <p>Account No: 3616002100042786</p>
      <p>RTGS/NEFT IFSC Code: PUNB0361600</p>
    </div>

    <div class="total-amount">
      <p>Total: Rs. 27737</p>
    </div>
  </div>
</body>
</html> -->














<nav class="tabs">
  <label for="tab-content-1" class="tab-item"><span class="tab">Tab 1</span></label>
  <label for="tab-content-2" class="tab-item"><span class="tab">Tab 2</span></label>
  <label for="tab-content-3" class="tab-item"><span class="tab">Tab 3</span></label>
  <label for="tab-content-4" class="tab-item"><span class="tab">Tab 4</span></label>
  <label for="tab-content-5" class="tab-item"><span class="tab">Tab 5</span></label>
</nav>

<main>
  <content><input type="radio" name="tab-content" id="tab-content-1" checked>
    <span>Tab Content 1</span>
    <p>Click other tabs to change the contents</p>
  </content>
  <content><input type="radio" name="tab-content" id="tab-content-2">
    <span>Tab Content 2</span>
    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis illo necessitatibus quod, at corrupti et? Repudiandae, ipsum quis voluptatibus maxime deleniti sit, dolore illo, fugiat eum reprehenderit officia nulla maiores?</p>  
  </content>
  <content><input type="radio" name="tab-content" id="tab-content-3"><span>Tab Content 3</span></content>
  <content><input type="radio" name="tab-content" id="tab-content-4"><span>Tab Content 4</span></content>
  <content><input type="radio" name="tab-content" id="tab-content-5"><span>Tab Content 5</span></content>
</main>



<style>

.tabs {
  display: flex;
  padding: 0 8px;
  overflow: hidden;
  & .tab-item {
    flex-grow: 1;
    max-width: 200px;
    padding: 4px 3px;
    position: relative;
    & .tab {
      flex-grow: 1;
      display: flex;
      align-items: center;
      position: relative;
      padding: 4px 8px;
      border-radius: 8px;
      white-space: nowrap;
      transition: background-color 300ms;
    }
    &:not(:last-child) .tab::after {
      content: '';
      position: absolute;
      right: -4px;
      display: block;
      width: 2px;
      height: 1em;
      background-color: #555;
      transition: opacity 100ms;
    }
    &:hover .tab {
      background-color: #555;
    }
    &:has(+ :hover) .tab::after,
    &:hover .tab::after {
      opacity: 0;
    }
  }
}
/* Style active tab */
body:has(input[name=tab-content][id=tab-content-2]:checked) label[for=tab-content-1].tab-item,
body:has(input[name=tab-content][id=tab-content-3]:checked) label[for=tab-content-2].tab-item,
body:has(input[name=tab-content][id=tab-content-4]:checked) label[for=tab-content-3].tab-item,
body:has(input[name=tab-content][id=tab-content-5]:checked) label[for=tab-content-4].tab-item {
  & .tab::after {
    opacity: 0;
  }
}
body:has(input[name=tab-content][id=tab-content-1]:checked) label[for=tab-content-1].tab-item,
body:has(input[name=tab-content][id=tab-content-2]:checked) label[for=tab-content-2].tab-item,
body:has(input[name=tab-content][id=tab-content-3]:checked) label[for=tab-content-3].tab-item,
body:has(input[name=tab-content][id=tab-content-4]:checked) label[for=tab-content-4].tab-item,
body:has(input[name=tab-content][id=tab-content-5]:checked) label[for=tab-content-5].tab-item {
  & .tab {
    background-color: #555;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    height: 100%;
    align-items: start;
    &::after {
      opacity: 0;
    }
  }
  &::before, &::after {
    content: '';
    position: absolute;
    bottom: 0;
    display: block;
    width: 16px;
    height: 16px;
    background-color: #555;
  }
  &::before {
    transform: translateX(-100%);
    border-bottom-right-radius: 8px;
    background-color: #222;
    box-shadow: 8px 0 0 0 #555;
    z-index: -1;
  }
  &::after {
    right: 3px;
    transform: translateX(100%);
    border-bottom-left-radius: 50%;
    background-color: #222;
    box-shadow: -8px 0 0 0 #555;
    z-index: -1;
  }
}

/* System display content */
content {
  display: none;
  &:has(input[name=tab-content]:checked) {
    display: block;
  }
}
content > input[name=tab-content] {
  display: none;
}

/* Base UI */
body {
  background-color: #222;
  color: #fff;
  margin: 0;padding: 0;
  display: flex;
  flex-direction: column;
  height: 100vh;
}
main {
  flex-grow: 1;
  display: block;
  background-color: #555;
  color: #fff;
  width: 100%;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
  & content {
    padding: 10vmin 0;
    text-align: center;
    & span {
      font-weight: bold;
      font-size: 2rem;
    }
  }
}
</style>