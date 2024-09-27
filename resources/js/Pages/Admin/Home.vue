<template>
    <div class="admin-container">
      <Sidebar />
      <div class="main-content">
        <Header :user="user" />
        <div class="content">
          <h2>Welcome to the Admin Dashboard</h2>
          <p>Current User: {{ user.name }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import Sidebar from '@/Components/Admin/Sidebar.vue'
  import Header from '@/Components/Admin/Header.vue'
  import { usePage } from '@inertiajs/vue3'
  const { props } = usePage()
  const user = ref(props.user)
  </script>
  
  <style>
  .admin-container {
    display: flex;
  }
  
  .main-content {
    flex: 1;
    padding: 20px;
  }
  
  .content {
    padding: 20px;
  }
  </style>