<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-Do List</title>
  <style>
    /* Body Styles */
    body {
      font-family: 'Arial', sans-serif;
      background: linear-gradient(135deg, #00feba, #5b548a);
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      height: 100vh;
      color: white;
      text-align: center;
    }

    /* Main Container */
    .container {
      background-color: #2d2d2d;
      padding: 30px;
      width: 100%;
      max-width: 550px;
      margin-top: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
      text-align: center;
    }

    /* Heading */
    h1 {
      font-size: 32px;
      color: #00feba;
      margin-bottom: 15px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    /* Input & button container */
    .input-container {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 15px;
    }

    /* Task input field */
    #task-input {
      flex: 1;
      padding: 12px;
      font-size: 16px;
      border-radius: 8px;
      border: none;
      outline: none;
      background: #444;
      color: white;
      transition: all 0.3s ease;
    }

    #task-input:focus {
      border: 2px solid #00feba;
      box-shadow: 0 0 5px rgba(0, 254, 186, 0.6);
    }

    /* Add Task button */
    #add-task-btn {
      padding: 12px 16px;
      background: #5b548a;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    #add-task-btn:hover {
      background: #4b4478;
      transform: scale(1.05);
    }

    /* Task list */
    ul {
      list-style: none;
      padding: 0;
      max-height: 250px;
      overflow-y: auto;
      margin-top: 15px;
    }

    /* Individual task items */
    li {
      background: #393939;
      padding: 12px;
      margin: 8px 0;
      border-radius: 8px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: white;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
      transition: transform 0.2s ease;
    }

    li:hover {
      transform: translateX(5px);
    }

    /* Delete button */
    .delete-btn {
      background: #ff4d4d;
      color: white;
      padding: 6px 12px;
      font-size: 14px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .delete-btn:hover {
      background: #e03d3d;
    }

    /* Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-thumb {
      background: #5b548a;
      border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #00feba;
    }
  </style>
</head>
<body>
  <!-- Main Container -->
  <div class="container">
    <h1>To-Do List</h1>
    
    <!-- Task Input and Button -->
    <div class="input-container">
      <input type="text" id="task-input" placeholder="Add a new task">
      <button id="add-task-btn">Add</button>
    </div>

    <!-- Task List -->
    <ul id="task-list">
      <!-- Tasks will be dynamically added here -->
    </ul>
  </div>

  <script>
    const addButton = document.getElementById('add-task-btn');
    const taskInput = document.getElementById('task-input');
    const taskList = document.getElementById('task-list');

    // Load saved tasks from local storage on page load
    document.addEventListener("DOMContentLoaded", loadTasks);

    function loadTasks() {
      const tasks = JSON.parse(localStorage.getItem("tasks")) || [];
      tasks.forEach(task => addTaskToDOM(task));
    }

    function addTask() {
      const taskText = taskInput.value.trim();
      if (taskText !== "") {
        addTaskToDOM(taskText);
        saveTask(taskText);
        taskInput.value = "";
      } else {
        alert("Please enter a task!");
      }
    }

    function addTaskToDOM(taskText) {
      const li = document.createElement('li');
      li.textContent = taskText;

      // Delete button
      const deleteButton = document.createElement('button');
      deleteButton.textContent = "Delete";
      deleteButton.classList.add('delete-btn');

      deleteButton.onclick = () => {
        taskList.removeChild(li);
        removeTask(taskText);
      };

      li.appendChild(deleteButton);
      taskList.appendChild(li);
    }

    function saveTask(task) {
      let tasks = JSON.parse(localStorage.getItem("tasks")) || [];
      tasks.push(task);
      localStorage.setItem("tasks", JSON.stringify(tasks));
    }

    function removeTask(taskToRemove) {
      let tasks = JSON.parse(localStorage.getItem("tasks")) || [];
      tasks = tasks.filter(task => task !== taskToRemove);
      localStorage.setItem("tasks", JSON.stringify(tasks));
    }

    addButton.addEventListener('click', addTask);
    taskInput.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        addTask();
      }
    });
  </script>
</body>
</html>
