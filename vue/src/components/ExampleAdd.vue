<template>
  <el-dialog title="表单" :visible.sync="show" @close="resetForm()">
    <el-form :model="addForm" status-icon :rules="rules" ref="form" label-width="100px" class="demo-ruleForm">
      <el-form-item label="姓名" prop="name">
        <el-input type="text" v-model="addForm.name"></el-input>
      </el-form-item>
      <el-form-item label="性别" prop="sex">
        <el-input type="text" v-model="addForm.sex"></el-input>
      </el-form-item>
      <el-form-item label="年龄" prop="age">
        <el-input v-model.number="addForm.age"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="submitForm()">提交</el-button>
        <el-button @click="resetForm()">重置</el-button>
      </el-form-item>
    </el-form>
  </el-dialog>
</template>
<script>
  export default {
    data()
    {
      var checkAge = (rule, value, callback) =>{
        if(!value)
        {
          return callback(new Error('年龄不能为空'));
        }
        if(!Number.isInteger(value))
        {
          callback(new Error('请输入数字值'));
        }
        else
        {
          if(value < 18)
          {
            callback(new Error('必须年满18岁'));
          }
          else
          {
            callback();
          }
        }
      };
      return {
        addForm: {
          name: '',
          sex: '',
          age: '',
          id: 0
        },
        rules: {
          name: [{required: true, message: '请输入姓名', trigger: 'blur'}],
          sex: [{required: true, message: '请输入性别', trigger: 'blur'}],
          age: [
            {validator: checkAge, trigger: 'blur'}
          ]
        },
        show: false,
        apiUrl: '/example-add'
      };
    },
    methods: {
      fillEditData(data)
      {
        this.addForm.id = data.id;
        this.addForm.name = data.name;
        this.addForm.sex = data.sex;
        this.addForm.age = data.age;
        this.apiUrl = '/example-edit';
      },
      submitForm()
      {
        this.$refs.form.validate((valid) =>{
          if(valid)
          {
            _api.post(this.apiUrl, this.addForm).then(res =>{
              if(res.code === 0)
              {
                _g.toast('success', 'success', 1000, this.$parent.getTableData);
                this.show = false;
                return;
              }
              _g.toast(res.message, 'error');
            })
          }
          else
          {
            return false;
          }
        });
      },
      resetForm()
      {
        this.$refs.form.resetFields();
      },
      showAddForm()
      {
        this.show = true;
      }
    },
    watch: {
      show(val)
      {
        if(!val)
        {
          this.$refs.form.resetFields();
        }
      }
    }
  }
</script>