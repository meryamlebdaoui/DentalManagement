<template>
  <nav>
    <NavBar />
  </nav>
  <router-view/>
</template>

<script>
import NavBar from "./components/NavBar.vue";
import Cookies from 'js-cookie';

export default {
  name: "App",
  components: {
    NavBar
  },
  beforeCreate() {
   
    this.$store.commit('setUser', Cookies.get('user'));
    this.$store.commit('setAuthIsReady', Cookies.get('authIsReady'));
  }
};

</script>


<style>

body {
  background-color: #dfd5dd;
}


button{
border-color: #2F327D;
} 

button:hover {
    box-shadow:inset -10.5rem 0 0 0 #2F327D ,inset 10.5rem 0 0 0 #2F327D;
    color: white;

}



</style>
