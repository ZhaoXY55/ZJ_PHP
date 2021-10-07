<template>
  <div class="add">
    <div class="form">
      <input type="text">
      <input type="text">
      <input type="text">

    </div>
  </div>
</template>
<script>
export default {
  data(){
    return{
      product: {
        name: '',
        pic: '',
        price: '',
        state: ''
      }
    }
  },
  methods: {

  }
}
</script>
<style scoped lang="scss">
.form {
  display: flex;
  padding: 50px;
}
</style>