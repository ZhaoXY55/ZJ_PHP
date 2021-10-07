<template>
  <div>
    <div class="main">
      <div class="nav">
        <el-row>
          <el-col :span="8" class="sign">
            <router-link :to="{ path: '/Add' }" replace active-class="active">
              新增商品
            </router-link>
          </el-col>
          <el-col :span="8" class="sign">
            <router-link :to="{ path: '/Change' }" replace active-class="active">
              修改信息
            </router-link>
          </el-col>
          <el-col :span="8" class="sign">
            <router-link :to="{ path: '/Delete' }" replace active-class="active">
              删除商品
            </router-link>
          </el-col>
        </el-row>
      </div>
      <div class="content">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "Admin"
};
</script>
<style scoped lang="scss">
.main {
  width: 80%;
  margin: 0 auto;
  border-left: 2px solid #e6a23c;
  border-right: 2px solid #e6a23c;
  box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);
  .nav {
    width: 60%;
    margin: 0 auto;
    text-align: center;
    font-weight: bold;
    padding: 20px;
    a {
      text-decoration: none;
      color: black;
    }
    .active {
      color: #e6a23c;
      text-decoration: underline;
    }
  }
  .content {
    border-top: 2px solid #e6a23c;
  }
}
</style>
