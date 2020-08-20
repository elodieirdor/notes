<template>
  <div id="app">
    <Navbar />
    <b-container fluid="xl" class="main-container">
      <router-view/>
    </b-container>
  </div>
</template>

<script>
import Navbar from './components/Navbar'
export default {
  name: 'App',
  components: {
    Navbar
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
.main-container{
  margin-top: 20px;
}
</style>
