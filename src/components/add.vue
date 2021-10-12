<template>
  <div class="add"  v-loading="loading" element-loading-text="拼命加载中">
    <div class="main">
      <div class="title">
        <el-page-header @back="goBack" content="添加商品"> </el-page-header>
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
            <el-input v-model="product.pic"></el-input>
          </el-form-item>
          <el-form-item>
            <el-button type="primary" @click="onSubmit('productForm')"
              >立即添加</el-button
            >
            <el-button type="error" @click="$router.back()">取消</el-button>
          </el-form-item>
        </el-form>
      </div>
    </div>
  </div>
</template>
<script>
import qs from 'qs'
export default {
  data() {
    return {
      loading: false,
      product: {
        name: '',
        pic: '',
        price: '',
        status: '新增',
      },
      rules: {
        name: {
          required: true,
          message: '请输入商品名称',
          trigger: 'blur',
        },
        price: [
          {
            required: true,
            message: '请输入商品价格',
            trigger: 'blur',
          },
          {
            type: 'number',
            message: '请输入正确的商品价格',
            trigger: 'blur',
          },
        ],
        pic: {
          required: true,
          message: '请输入商品图片路径',
          trigger: 'blur',
        },
      },
    }
  },
  methods: {
    goBack() {
      this.$router.back()
    },
    onSubmit(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.loading = true
          this.$ajax
            .post(
              'http://localhost/php/addProductInfo.php',
              qs.stringify({
                name: this.product.name,
                pic: this.product.pic,
                price: this.product.price,
                status: this.product.status,
              })
            )
            .then((res) => {
              if (res.data == 'success') {
                this.loading = false
                this.$message({
                  type: 'success',
                  message: '商品添加成功！',
                })
                this.$router.back()
              } else {
                this.$message({
                  type: 'error',
                  message: '商品添加失败！',
                })
              }
            })
            .catch((err) => {
              console.log(err)
              this.loading = false
              this.$message({
                type: 'error',
                message: '商品添加失败！',
              })
            })
        } else {
          this.loading = false
          this.$message({
            type: 'error',
            message: '请确认表单是否填写正确',
          })
          return false
        }
      })
    },
  },
}
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
