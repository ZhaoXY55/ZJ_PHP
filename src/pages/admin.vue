<template>
  <div>
    <div class="main">
      <div class="header">
        <span>商品管理</span>
        <el-button type="primary" @click="$router.push({ path:'/Add' })">添加商品</el-button>
      </div>
      <el-table :data="tableData"
              class="table"
              border
              style="width: 1000px; margin: 0 auto">
      <el-table-column prop="id"
                       label="id"
                       width="100"
                       align="center">
      </el-table-column>
      <el-table-column label="商品操作"
                       width="100"
                       align="center">
        <template slot-scope="scope">
          <el-dropdown class="right-operate-wrap">
            <el-button size="small">操作</el-button>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item @click.native="goChange(scope.row)">编辑</el-dropdown-item>
              <el-dropdown-item @click.native="remove(scope.row)">删除</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </template>
      </el-table-column>
      <el-table-column prop="name"
                       label="名称"
                       align="center">
      </el-table-column>
      <el-table-column prop="status"
                       label="状态"
                       align="center"
                       width="200">
      </el-table-column>
      <el-table-column label="状态操作"
                       width="100"
                       align="center">
        <template slot-scope="scope">
          <el-dropdown class="right-operate-wrap">
            <el-button size="small">操作</el-button>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item @click.native="putOn(scope.row)">上架</el-dropdown-item>
              <el-dropdown-item @click.native="pullOff(scope.row)">下架</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </template>
      </el-table-column>
    </el-table>
    </div>
  </div>
</template>
<script>
export default {
  name: 'Admin',
  data () {
    return {
      tableData: [{
        id: '1',
        name: '王小虎',
        status: '新增'
      },
      {
        id: '2',
        name: '王小虎',
        status: '已上架'
      },
      {
        id: '3',
        name: '王小虎',
        status: '已下架'
      },
      {
        id: '4',
        name: '王小虎',
        status: '新增'
      }]
    }
  },
  methods: {
    goChange (obj) {
      // 编辑商品信息
      if (obj.status != '已上架') {
        this.$router.push({
          path: '/Change',
          query: {
            id: obj.id
          }
        })
      } else {
        this.$message({
          type: 'error',
          message: '商品已上架无法编辑修改'
        })
      }
    },
    remove (obj) {
      // 移除商品
      if (obj.status != '已上架') {
        this.$confirm('此操作将永久删除该商品, 是否继续?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          this.$message({
            type: 'success',
            message: obj.id
          })
        }).catch(() => { })
      } else {
        this.$message({
          type: 'error',
          message: '商品已上架无法编辑修改'
        })
      }
    },
    putOn (obj) {
      // 商品上架
      this.$confirm('是否上架商品?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消'
      }).then(() => {
        obj.status = '已上架'
        this.$message({
          type: 'success',
          message: '商品已上架'
        })
      }).catch(() => { })
    },
    pullOff (obj) {
      // 商品下架
      this.$confirm('是否下架商品?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消'
      }).then(() => {
        obj.status = '已下架'
        this.$message({
          type: 'success',
          message: '商品已下架'
        })
      }).catch(() => { })
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
  }
}
</style>