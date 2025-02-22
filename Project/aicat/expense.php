<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Expense Tracker</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background: linear-gradient(90deg, #0093E9, #80D0C7);
      padding: 20px;
    }

    .container {
      max-width: 1000px;
      margin: 0 auto;
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h1 {
      text-align: center;
      color: #0093E9;
      margin-bottom: 20px;
    }

    .input-row {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }

    .input-group {
      flex: 1;
    }

    input, select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 16px;
    }

    button {
      padding: 10px 20px;
      background: linear-gradient(90deg, #0093E9, #80D0C7);
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: opacity 0.3s;
    }

    button:hover {
      opacity: 0.9;
    }

    .expenses-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    .expenses-table th,
    .expenses-table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .expenses-table th {
      background-color: #f8f9fa;
    }

    .delete-btn {
      background: linear-gradient(90deg, #ff4444, #ff6666);
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 3px;
      cursor: pointer;
      transition: opacity 0.3s;
    }

    .delete-btn:hover {
      opacity: 0.9;
    }

    .total-row {
      font-weight: bold;
      background-color: #f8f9fa;
    }

    .date-input {
      position: relative;
    }

    .date-input::before {
      content: "m=/d4/yyyy";
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
      pointer-events: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Expense Tracker</h1>
    
    <!-- Input Row -->
    <div class="input-row">
      <div class="input-group">
        <select id="category">
          <option value="">Select Category</option>
          <option value="Food & Beverage">Food & Beverage</option>
          <option value="Rent">Rent</option>
          <option value="Transport">Transport</option>
          <option value="Relaxing">Relaxing</option>
        </select>
      </div>
      
      <div class="input-group">
        <input type="number" id="amount" placeholder="Amount">
      </div>
      
      <div class="input-group">
        <input type="date" id="date"> 
      </div>
      
      <button onclick="addExpense()">Add</button>
    </div>

    <!-- Expenses List -->
    <table class="expenses-table">
      <thead>
        <tr>
          <th>Category</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="expenses-body">
        <!-- Expenses will be added here dynamically -->
      </tbody>
      <tfoot>
        <tr class="total-row">
          <td>Total</td>
          <td id="total-amount">0.00</td>
          <td></td>
          <td></td>
        </tr>
      </tfoot>
    </table>
  </div>

  <script>
    let expenses = JSON.parse(localStorage.getItem('expenses')) || [];

    function addExpense() {
      const category = document.getElementById('category').value;
      const amount = parseFloat(document.getElementById('amount').value);
      const date = document.getElementById('date').value;

      if (!category || !amount || !date) {
        alert('Please fill all fields');
        return;
      }

      const expense = {
        category,
        amount,
        date,
        id: Date.now()
      };

      expenses.push(expense);
      saveToLocalStorage();
      renderExpenses();
      clearInputs();
    }

    function deleteExpense(id) {
      expenses = expenses.filter(expense => expense.id !== id);
      saveToLocalStorage();
      renderExpenses();
    }

    function renderExpenses() {
      const tbody = document.getElementById('expenses-body');
      const totalAmount = document.getElementById('total-amount');
      let total = 0;

      tbody.innerHTML = '';
      
      expenses.forEach(expense => {
        total += expense.amount;
        tbody.innerHTML += `
          <tr>
            <td>${expense.category}</td>
            <td>$${expense.amount.toFixed(2)}</td>
            <td>${expense.date}</td>
            <td>
              <button class="delete-btn" onclick="deleteExpense(${expense.id})">
                Delete
              </button>
            </td>
          </tr>
        `;
      });

      totalAmount.textContent = `$${total.toFixed(2)}`;
    }

    function clearInputs() {
      document.getElementById('category').value = '';
      document.getElementById('amount').value = '';
      document.getElementById('date').value = '';
    }

    function saveToLocalStorage() {
      localStorage.setItem('expenses', JSON.stringify(expenses));
    }

    // Initial render
    renderExpenses();
  </script>
</body>
</html>