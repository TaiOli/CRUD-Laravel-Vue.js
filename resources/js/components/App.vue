<template>
  <div class="container">
    <header class="px-3 py-2 bg-white text-white">
      <div class="d-flex align-items-center justify-content-center">
        <router-link to="/" id="home" class="nav-link text-dark">Home</router-link>
        <router-link to="/usuarios/create" class="btn btn-primary ms-auto">Adicionar Usuario</router-link>
      </div>
    </header>

    <div class="card mt-3">
      <div class="card-body">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>
    
    <script>
    export default {
      name: 'App'
    }
    </script>

