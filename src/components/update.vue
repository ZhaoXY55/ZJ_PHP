<template>
  <div class="change">
    <div class="main">
      <div class="title">
        <el-page-header @back="goBack" content="商品编辑"> </el-page-header>
      </div>
      <div class="form">
        <el-form
          label-position="top"
          label-width="120px"
          :model="product"
          :rules="rules"
          ref="productForm"
        >
          <el-form-item label="名称：" prop="name">
            <el-input v-model="product.name"></el-input>
          </el-form-item>
          <el-form-item label="价格：" prop="price">
            <el-input v-model.number="product.price"></el-input>
          </el-form-item>
          <el-form-item label="图片路径：" prop="pic">
            <el-input v-model.number="product.pic"></el-input>
          </el-form-item>
          <el-form-item>
            <el-button type="primary" @click="onSubmit('productForm')"
              >修改</el-button
            >
            <el-button @click="$router.back()">取消</el-button>
          </el-form-item>
        </el-form>
      </div>
    </div>
  </div>
</template>
<script>
import qs from "qs";
export default {
  data() {
    return {
      product: {
        name: "",
        pic: "",
        price: "",
      },
      rules: {
        name: {
          required: true,
          message: "请输入商品名称",
          trigger: "blur",
        },
        price: [
          {
            required: true,
            message: "请输入商品价格",
            trigger: "blur",
          },
          {
            pattern: /^\d+$/,
            message: "请输入正确的商品价格",
            trigger: "blur",
          },
        ],
        pic: {
          required: true,
          message: "请输入商品图片路径",
          trigger: "blur",
        },
      },
    };
  },
  mounted() {
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
      });
  },
  methods: {
    goBack() {
      this.$router.back();
    },
    onSubmit(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.$ajax
            .post(
              "http://localhost/php/updateProductInfo.php",
              qs.stringify({
                type: "updateAll",
                id: localStorage.id,
                name: this.product.name,
                pic: this.product.pic,
                price: this.product.price,
              })
            )
            .then((res) => {
              if (res.data == "success") {
                this.$message({
                  type: "success",
                  message: "修改成功！",
                });
                this.$router.back();
              } else {
                this.$message({
                  type: "error",
                  message: "修改失败！",
                });
              }
            });
        } else {
          alert("请确认表单是否填写正确");
          return false;
        }
      });
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
  .form {
    display: flex;
    padding: 50px;
    .el-input {
      width: 400px;
    }
    .el-form {
      margin: 0 auto;
    }
  }
}
</style>