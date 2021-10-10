<template>
  <div>
    <div class="main">
      <div class="header">
        <span>商品管理</span>
        <el-button type="primary" @click="$router.push({ path: '/Add' })"
          >添加商品</el-button
        >
      </div>
      <el-table
        :data="tableData"
        class="table"
        border
        style="width: 1000px; margin: 0 auto"
      >
        <el-table-column prop="id" label="id" width="100" align="center" sortable>
        </el-table-column>
        <el-table-column label="商品操作" width="100" align="center">
          <template slot-scope="scope">
            <el-dropdown class="right-operate-wrap">
              <el-button size="small">操作</el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item @click.native="goUpdate(scope.row)"
                  >编辑</el-dropdown-item
                >
                <el-dropdown-item
                  @click.native="remove(scope.row, scope.$index, tableData)"
                  >删除</el-dropdown-item
                >
              </el-dropdown-menu>
            </el-dropdown>
          </template>
        </el-table-column>
        <el-table-column prop="name" label="名称" align="center">
        </el-table-column>
        <el-table-column prop="status" label="状态" align="center" width="200">
        </el-table-column>
        <el-table-column label="状态操作" width="100" align="center">
          <template slot-scope="scope">
            <el-dropdown class="right-operate-wrap">
              <el-button size="small">操作</el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item @click.native="putOn(scope.row)"
                  >上架</el-dropdown-item
                >
                <el-dropdown-item @click.native.prevent="pullOff(scope.row)"
                  >下架</el-dropdown-item
                >
              </el-dropdown-menu>
            </el-dropdown>
          </template>
        </el-table-column>
      </el-table>
    </div>
  </div>
</template>
<script>
import qs from "qs";
export default {
  name: "Admin",
  data() {
    return {
      tableData: [],
    };
  },
  mounted() {
    // 获取商品列表
    this.$ajax.get("http://localhost/php/getProductList.php").then((res) => {
      this.tableData = res.data;
    });
  },
  methods: {
    goUpdate(obj) {
      // 编辑商品信息
      if (obj.status != "已上架") {
        localStorage.id = obj.id
        this.$router.push({
          path: "/Update",
          query: {
            id: obj.id,
          },
        });
      } else {
        this.$message({
          type: "error",
          message: "商品已上架无法编辑修改",
        });
      }
    },
    deleteRow(index, rows) {
      rows.splice(index, 1);
    },
    remove(obj, index, rows) {
      // 移除商品
      if (obj.status != "已上架") {
        this.$confirm("此操作将永久删除该商品, 是否继续?", "提示", {
          confirmButtonText: "确定",
          cancelButtonText: "取消",
          type: "warning",
        })
          .then(() => {
            this.$ajax
              .post(
                "http://localhost/php/deleteProductInfo.php",
                qs.stringify({
                  id: obj.id,
                })
              )
              .then((res) => {
                if (res.data == "success") {
                  this.$message({
                    type: "success",
                    message: "商品已删除",
                  });
                  this.deleteRow(index, rows);
                }
              });
          })
          .catch(() => {});
      } else {
        this.$message({
          type: "error",
          message: "商品已上架无法编辑修改",
        });
      }
    },
    putOn(obj) {
      // 商品上架
      if (obj.status != "已上架") {
        this.$confirm("是否上架商品?", "提示", {
          confirmButtonText: "确定",
          cancelButtonText: "取消",
        })
          .then(() => {
            obj.status = "已上架";
            this.$ajax
              .post(
                "http://localhost/php/updateProductInfo.php",
                qs.stringify({
                  type: "updateStatus",
                  id: obj.id,
                  status: obj.status,
                })
              )
              .then((res) => {
                if (res.data == "success") {
                  this.$message({
                    type: "success",
                    message: "商品已上架",
                  });
                }
              });
          })
          .catch(() => {});
      } else {
        this.$message({
          type: "warning",
          message: "商品已上架，请勿重复操作",
        });
      }
    },
    pullOff(obj) {
      // 商品下架
      if (obj.status != "已下架") {
        this.$confirm("是否下架商品?", "提示", {
          confirmButtonText: "确定",
          cancelButtonText: "取消",
        })
          .then(() => {
            obj.status = "已下架";
            this.$ajax
              .post(
                "http://localhost/php/updateProductInfo.php",
                qs.stringify({
                  type: "updateStatus",
                  id: obj.id,
                  status: obj.status,
                })
              )
              .then((res) => {
                if (res.data == "success") {
                  this.$message({
                    type: "success",
                    message: "商品已下架",
                  });
                }
              });
          })
          .catch(() => {});
      } else {
        this.$message({
          type: "warning",
          message: "商品已下架，请勿重复操作",
        });
      }
    },
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