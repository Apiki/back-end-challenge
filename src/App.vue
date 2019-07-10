<template>
  <div id="app">
    <h1 class="text-center">Conversor de Moedas</h1>
      <div class="linha">
        <Conversor moeda-a="BRL" moeda-b="USD"/>
        <Conversor moeda-a="USD" moeda-b="BRL"/>
      </div>
      <div class="linha">
        <Conversor moeda-a="BRL" moeda-b="EUR"/>
        <Conversor moeda-a="EUR" moeda-b="BRL"/>
      </div>
  </div>
</template>

<script>
import Conversor from "/var/www/html/back-end-challenge/src/components/Conversor.vue";

export default {
    name:"app",
    components: {
      Conversor  
    }  

};
</script>

<style>

#app{
  margin:auto;
  max-width: 900px;
  font-family:"Avenir",Arial, Helvetica, sans-serif;
  -webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;
  color: #2c3e50;
  margin-top: 60px;
}
.linha{

  margin-top:40px;
  display:flex;
  justify-content:space-around;
}
.text-center{
  text-align:center;
}
</style>
