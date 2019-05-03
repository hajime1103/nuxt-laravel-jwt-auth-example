<template>
  <div class="container">
    <h1>Welcome to the dashboard</h1>
  </div>
</template>

<script>
  export default {
    middleware: 'auth',
    middleware: 'emailVerify',
  }
</script>
