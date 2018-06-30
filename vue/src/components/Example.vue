<template>
  <div class="pd-20">
    <el-button type="success" @click="showAdd">添加</el-button>
    <el-table
      :data="tableData"
      style="width: 100%">
      <el-table-column
        prop="name"
        label="姓名"
        width="180">
      </el-table-column>
      <el-table-column
        prop="sex"
        label="性别"
        width="180">
      </el-table-column>
      <el-table-column
        prop="age"
        label="年龄">
      </el-table-column>
      <el-table-column
        fixed="right"
        label="操作"
        width="100">
        <template slot-scope="scope">
          <el-button @click="del(scope.row.id)" type="text" size="small">删除</el-button>
          <el-button type="text" size="small" @click="showEdit(scope.row)">编辑</el-button>
        </template>
      </el-table-column>
    </el-table>
    <el-pagination
      background
      layout="prev, pager, next"
      :total="pagination.total"
      :current-page="pagination.current_page"
      :page-size="pagination.page_size"
      @current-change="changePage">
    </el-pagination>

    <addForm ref="addForm" :showAddForm="showAddForm"></addForm>
  </div>
</template>

<style>
  .el-table .warning-row {
    background: oldlace;
  }

  .el-table .success-row {
    background: #f0f9eb;
  }
</style>

<script>
  export default {
    components: {
      addForm: require('./ExampleAdd')
    },
    data()
    {
      return {
        tableData: [],
        showAddForm: false,
        pagination: {
          total: 0,
          page_size: 10,
          current_page: 1
        },
        params: {
          page: 1
        }
      }
    },
    mounted()
    {
      this.getTableData();
    },
    methods: {
      getTableData()
      {
        _api.get('/example/example', this.params).then(res =>{
            _g.toast(res.message);
          this.pagination.total = res.data.total;
          this.pagination.page_size = res.data.per_page;
          this.pagination.current_page = res.data.current_page;
          this.tableData = res.data.data;
        })
      },
      del(id)
      {
        _g.confirm('确定要删除该条记录吗？', '提示', () =>{
          this.doDelete(id)
        })
      },
      doDelete(id)
      {
        _api.get('/example-delete', {id}).then(res =>{
          if(res.code === 0)
          {
            _g.toast('success', 'success', 1000, this.getTableData)
            return;
          }
          _g.toast(res.message, 'error');
        })
      },
      showAdd()
      {
        this.$refs.addForm.showAddForm();
      },
      showEdit(row)
      {
        this.$refs.addForm.fillEditData(row);
        this.$refs.addForm.showAddForm();
      },
      changePage(page)
      {
        this.params.page = page;
        this.getTableData();
      }
    }
  }
</script>
<style scoped>
  .pd-20{
    margin-top: 20px;
    margin-left: 20px;
  }
</style>