<template>
  <div class="Conversor">
    <h2>{{moedaA}} Para {{moedaB}}</h2>
    <input type="text" v-model="moedaA_value" v-bin:placeholder="moedaA">
    <input type="button" value="Converter" v-on:click="converter">
    <h2>{{moedaB_value}} </h2>
  </div>
</template>

<script>
export default {
  name: "Conversor",
  props:["moedaA","moedaB"],
  data(){
    return {
      moedaA_value: "",
      moedaB_value: 0
    };
  },

  methods:{
    converter() {
      const de_para = this.moedaA + "_" + this.moedaB;

      const url ="https://free.currconv.com/api/v7/convert?q="+ 
      de_para + 
      "&compact=ultra&apiKey=a882188cd69d395d41b4";

      fetch(url)
        .then(res=> {
          return res.json();
        })
        .then(json=>{
          const cotacao = json[de_para];
          this.moedaB_value = (cotacao * parseFloat(this.moedaA_value)).toFixed(                         
            2
          );
        });
    }
  }
};
</script>

<style scoped>
.Conversor {
  padding: 20px;
  max-width: 300px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.9);
};
</style>





