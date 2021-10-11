<template>
  <div class="change">
    <div class="main">
      <div class="title">
        <el-page-header @back="goBack"
                        content="商品详情"> </el-page-header>
      </div>
      <div class="detail">
        <img :src="product.pic"
             alt="" />
        <div class="content">
          <span>名称：<span class="name content-data">{{
              product.name
            }}</span></span>
          <span>价格：<span class="price content-data">￥{{ product.price }}</span></span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import qs from "qs";
export default {
  data () {
    return {
      product: {
        name: "",
        pic: "",
        price: "",
      },
    };
  },
  mounted () {
    this.$ajax
      .post(
        "http://localhost/php/getProductInfo.php",
        qs.stringify({
          id: this.$route.query.id,
        })
      )
      .then((res) => {
        let productInfo = res.data.split(",");
        this.product.name = productInfo[0];
        this.product.pic = productInfo[1];
        this.product.price = productInfo[2];
      })
      .catch(err => {
        console.log(err)
      })
  },
  methods: {
    goBack () {
      this.$router.back();
    },
    imgUrl (obj) {
      return require(obj.pic)
    },
  },
};
</script>
<style scoped lang="scss">
.main {
  width: 1000px;
  height: 100vh;
  margin: 0 auto;
  border-left: 2px solid #909399;
  border-right: 2px solid #909399;
  .title {
    padding: 20px;
    font-weight: bold;
    border-bottom: 2px solid #909399;
  }
  .detail {
    padding: 50px;
    text-align: center;
    img {
      margin: 0 auto;
      height: 200px;
      object-fit: cover;
    }
    .content {
      margin-top: 50px;
      display: flex;
      justify-content: space-around;
      font-size: 20px;
      font-weight: bold;
      .name {
        color: blue;
      }
      .price {
        color: red;
      }
      .content-data {
        font-size: 40px;
      }
    }
  }
}
</style>