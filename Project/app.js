document.addEventListener('DOMContentLoaded', () => {
    const category = document.getElementById('category');
    const amount = document.getElementById('amount');
    const date = document.getElementById('date');
    const addButton = document.getElementById('addButton');
    const expensesTable = document.getElementById('expensesTable').getElementsByTagName('tbody')[0];
    const totalAmount = document.getElementById('totalAmount');
  
    let expenses = [];
  
    // Load expenses from localStorage
    if (localStorage.getItem('expenses')) {
      expenses = JSON.parse(localStorage.getItem('expenses'));
      updateUI();
    }
  
    // Add expense
    addButton.addEventListener('click', () => {
      const categoryValue = category.value;
      const amountValue = parseFloat(amount.value);
      const dateValue = date.value;
  
      if (categoryValue && amountValue && dateValue) {
        const expense = { category: categoryValue, amount: amountValue, date: dateValue };
        expenses.push(expense);
        updateUI();
        saveToLocalStorage();
        // Clear inputs
        amount.value = '';
        date.value = '';
      } else {
        alert('Please fill in all fields.');
      }
    });
  
    // Update UI
    function updateUI() {
      expensesTable.innerHTML = '';
      let total = 0;
  
      expenses.forEach((expense, index) => {
        const row = expensesTable.insertRow();
        row.innerHTML = `
          <td>${expense.category}</td>
          <td>$${expense.amount.toFixed(2)}</td>
          <td>${expense.date}</td>
          <td><button class="deleteButton" onclick="deleteExpense(${index})">Delete</button></td>
        `;
        total += expense.amount;
      });
  
      totalAmount.textContent = `$${total.toFixed(2)}`;
    }
  
    // Delete expense
    window.deleteExpense = (index) => {
      expenses.splice(index, 1);
      updateUI();
      saveToLocalStorage();
    };
  
    // Save to localStorage
    function saveToLocalStorage() {
      localStorage.setItem('expenses', JSON.stringify(expenses));
    }
  });