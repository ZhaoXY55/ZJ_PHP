<template>
  <div>
    <div class="main">
      <div class="list">
        <el-row>
          <el-col :span="24" class="title"><h1>商品列表</h1></el-col>
        </el-row>
        <el-row>
          <el-col :span="24" class="nav">
            <input type="text" placeholder="请输入想要查找的商品" />
            <button @click="$router.push({ path: '/Admin' })">商品管理</button>
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="6" class="sign"><span>名称</span></el-col>
          <el-col :span="6" class="sign"><span>图片</span></el-col>
          <el-col :span="6" class="sign"><span>价格</span></el-col>
          <el-col :span="6" class="sign"><span>状态</span></el-col>
        </el-row>
        <el-row v-for="(good, index) in goodList" :key="index">
          <div @click="goDetail">
            <el-col :span="6" class="good name"><span>{{good.name}}</span></el-col>
            <el-col :span="6" class="good pic"><span>{{good.pic}}</span></el-col>
            <el-col :span="6" class="good price"><span>{{good.price}}</span></el-col>
            <el-col :span="6" class="good status"><span>{{good.status}}</span></el-col>
          </div>
        </el-row>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "Index",
  data(){
    return {
      goodList: [
        {
          name: '宝宝精水',
          pic: '1',
          price: '￥20',
          status: '已上架'
        },
        {
          name: '沐浴露',
          pic: '8',
          price: '￥15',
          status: '已上架'
        },
        {
          name: '伟哥',
          pic: '9 ',
          price: '￥200',
          status: '未上架'
        },
      ]
    }
  },
  methods: {
    goDetail(){
      this.$router.push({path:'/Detail'})
    }
  },
};
</script>
<style scope lang="scss">
.main {
  width: 100%;
  .list {
    width: 80%;
    margin: 0 auto;
    border-left: 2px solid #e6a23c;
    border-right: 2px solid #e6a23c;
    box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);
  }
  .title {
    border-bottom: 2px solid #e6a23c;
    text-align: center;
  }
  .nav {
    display: flex;
    justify-content: space-between;
    padding: 10px;
    border-bottom: 2px solid #e6a23c;
    input {
      width: 400px;
      border-radius: 10px;
      padding: 10px;
      border: 1px solid #e6a23c;
    }
    ::-webkit-input-placeholder {
      color: #e6a23c;
    }
    button {
      width: 100px;
      height: 40px;
      cursor: pointer;
      background: #fff;
      color: #e6a23c;
      border: 1px solid #e6a23c;
      border-radius: 10px;
    }
    button:hover {
      background: #e6a23c;
      color: #fff;
    }
  }
  .sign {
    text-align: center;
    border-bottom: 2px solid #e6a23c;
    font-weight: bold;
    padding: 10px;
  }
  .good {
    height: 200px;
    text-align: center;
    border-bottom: 2px solid #e6a23c;
    cursor: pointer;
  }
}
</style>