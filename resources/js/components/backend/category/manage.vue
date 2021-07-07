<template>
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Category Table</h3>
                  <router-link to="/categoryadd" class="btn btn-success"> Category Add</router-link>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th><input type="checkbox" :disabled="isNoData()" @click="selectAll" v-model="selectAllData"></th>
                        <th style="width: 10px">#</th>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(category, index) in categories" :key="category.message">
                        <td><input type="checkbox" :value="category.id" v-model="rowSelect"></td>
                        <td>{{++index}}</td>
                        <td>{{category.name}}</td>
                        <td><span class="p-1"  :class="statusButtonColor(category.status)">{{categoryStatus(category.status)}}</span></td>
                        <td>{{category.created_at | time}}</td>

                        <td>

                            <router-link :to="'/edit-category/'+ category.slug" class="btn btn-sm btn-info"> Edit</router-link>
                            <button @click="remove(category.id)" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr v-if="!isNoData()">
                          <td colspan="6">

                        <div class="dropdown">
                        <button :disabled="!isSelect" class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button class="btn btn-default" @click="statusChange(rowSelect,1)">Active</button><br>
                            <button class="btn btn-default" @click="statusChange(rowSelect,0)">Inactive</button><br>
                            <button class="btn btn-default" @click="removeSelectData(rowSelect)">Delete</button>

                        </div>
                        </div>
                        </td>

                      </tr>
                      <tr v-if="isNoData()"><td class="text-red text-center" colspan="6">There is no Data in the table</td></tr>

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.card -->


            </div>
        </div>

</template>

<script>

export default{
    name:"manage",
    data(){
        return {
            rowSelect:[],
            selectAllData:false,
            isSelect:false
        }
    },
    mounted(){
        this.$store.dispatch('getCategoriesData');

    },

    computed:{
        categories(){
          return this.$store.getters.categories;
        }
    },
     watch:{
        rowSelect(rowSelect){
         this.isSelect = (rowSelect.length > 0);
         this.selectAllData=(rowSelect.length === this.categories.length);

        }
    },
    methods:{
        categoryStatus(status){
            let data = {0:"Inactive", 1:'Active'}
           return data[status];
        },
        statusButtonColor(status){
            let data = {0:"bg-danger", 1:'bg-success'}
           return data[status];
        },
        remove(id){

             this.confirm(()=>{

                  axios.get("/remove-category/"+ id).then((response) => {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                  this.$store.dispatch('getCategoriesData');
                 }).catch((error)=>{});

             });
        },

         isNoData(){

              return this.categories.length < 1;

        },

        selectAll: function(event){

            if(event.target.checked === false){
                this.rowSelect = [];
            }else{
                  this.categories.forEach((categories) => {
                      this.rowSelect.push(categories.id);

                  });

            }
        },
        removeSelectData(rowSelect){

            this.confirm(()=>{
                axios.post("/remove-categories/", {data:rowSelect}).then((response) => {
                  Swal.fire(
                    response.data.total+' Items Deleted!',
                    'Your file has been deleted.',
                    'success'
                    );
                    this.$store.dispatch('getCategoriesData');
                    this.rowSelect=[];
                    this.selectAllData=false;
                    this.isSelect=false;

                 }).catch((error)=>{ });

            });

        },

        statusChange(rowSelect, status){
           let message = status === 1?'Actived':'Inactived';

            axios.post("/categories/change-status/", {data:rowSelect, status:status}).then((response) => {
                    toastr.success(response.data.total+' Category has been  '+ message +' Successfully');
                    this.$store.dispatch('getCategoriesData');
                    this.rowSelect=[];
                    this.selectAllData=false;
                    this.isSelect=false;

                 }).catch((error)=>{

                      });

        }

    }



}

</script>
<style scoped>
    .card .card-header{
        text-align: right;
    }
</style>
