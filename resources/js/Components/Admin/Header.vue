<template>
    <header class="header">
      <h1>Admin Dashboard</h1>
      <p>{{ user.name }}</p>
      <p>Role: {{role}}</p>
    </header>
  </template>
  
  <script setup>
  const props = defineProps({
    user: Object,
    role: String
  })
  </script>
  
  <style scoped>
  .header {
    background-color: #34495e;
    color: white;
    padding: 15px;
    text-align: center;
  }
  </style>
  