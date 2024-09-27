<template>
    <div class="sidebar">
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/admin">Dashboard</a></li>
        <li><a href="/users">Users</a></li>
        <li><a href="/settings">Settings</a></li>
      </ul>
    </div>
  </template>
  
  <script setup>
  </script>
  
  <style scoped>
  .sidebar {
    width: 200px;
    background-color: #2c3e50;
    height: 100vh;
    color: white;
  }
  
  ul {
    list-style-type: none;
    padding: 0;
  }
  
  li {
    padding: 15px;
  }
  
  li a {
    color: white;
    text-decoration: none;
  }
  </style>
  