<template>
  <div>
    <div class="main">
      <div class="header">
        <span>商品列表</span>
        <el-button type="primary" @click="$router.push({ path: '/Admin' })"
          >商品管理</el-button
        >
      </div>
      <el-table
        :data="productList.filter(product => !search || product.name.includes(search))"
        class="table"
        border
      >
        <el-table-column prop="name" label="名称" align="center" width="200">
        </el-table-column>
        <el-table-column prop="pic" label="图片" align="center">
          <template slot-scope="scope">
            <img :src="imgUrl(scope.row)">
          </template>
        </el-table-column>
        <el-table-column width="350" align="center">
          <template slot="header">
            <input type="text" v-model="search" class="search" placeholder="请输入关键字搜索">
          </template>
          <template slot-scope="scope">
            <span @click="goDetail(scope.row)" class="detail">详情</span>
          </template>
        </el-table-column>
      </el-table>
    </div>
  </div>
</template>
<script>
export default {
  name: "Index",
  data() {
    return {
      search: "",
      productList: "",
    };
  },
  mounted() {
    // 获取商品列表
    this.$ajax.get("http://localhost/php/getProductList.php").then((res) => {
      // 筛选已上架的商品
      this.productList = res.data.filter((obj) => {
        return obj.status == "已上架";
      });
    });
  },
  methods: {
    goDetail(obj) {
      this.$router.push({
        path: "/Detail",
        query: {
          id: obj.id,
        },
      });
    },
    imgUrl(obj) {
      return obj.pic
      // return require(obj.pic)
      // return require('../assets/img/0.jpg')
    }
  },
};
</script>
<style scoped lang="scss">
.main {
  .header {
    width: 1000px;
    margin: 10px auto;
    display: flex;
    justify-content: space-between;
    span {
      font-size: 36px;
      font-weight: bold;
    }
  }
  .table {
    width: 80%;
    margin: 0 auto;
    border: 2px solid #909399;
    box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);
    .search {
      width: 280px;
      height: 20px;
      padding: 10px;
      border-radius: 10px;
      border: 2px solid #909399;
    }
    ::-webkit-input-placeholder {
      color: #E4E7ED;
    }
    img {
      height: 150px;
    }
    .detail {
      color: #409EFF;
      cursor: pointer;
    }
  }
}
</style>