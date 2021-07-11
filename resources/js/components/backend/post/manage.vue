<template>
        <div class="row justify-content-center mt-5">
            <div class="col-md-10">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Post Table</h3>
                  <router-link to="/add-post" class="btn btn-success float-right"> Post Add</router-link>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table class="table table-bordered table-hover table-head-fixed">
                    <thead>
                      <tr>
                        <th><input type="checkbox" :disabled="isNoData()" @click="selectAll" v-model="selectAllData"></th>
                        <th style="width: 10px">#</th>
                        <th style="">Title</th>
                        <th style="">Content</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Created By</th>

                        <th style="width: 10%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(post, index) in posts" :key="post.message">
                        <td><input type="checkbox" :value="post.id" v-model="rowSelect"></td>
                        <td>{{++index}}</td>
                        <td>{{post.title | readMore(20,"....")}}</td>
                        <td>{{post.content | readMore(20,"....")}}</td>
                        <td>{{post.category.name}}</td>
                        <td><img width="60px" :src="'admin/media/images/post/'+post.thumbnail" :alt="post.title"></td>
                        <td><span class="p-1"  :class="statusButtonColor(post.status)">{{status(post.status)}}</span></td>
                        <td>{{post.created_at | time}}</td>
                        <td>{{post.user.name}}</td>

                        <td>

                            <router-link :to="'/edit-post/'+ post.slug" class="btn btn-sm btn-info"> Edit</router-link>
                            <button @click="remove(post.slug)" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                      </tr>
                       <tr v-if="!isNoData()">
                          <td colspan="10">

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
                      <tr v-if="isNoData()"><td class="text-red text-center" colspan="9">There is no Data in the table</td></tr>

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
        this.$store.dispatch('getPostsData');

    },
     watch:{
        rowSelect(rowSelect){
         this.isSelect = (rowSelect.length > 0);
         this.selectAllData=(rowSelect.length === this.posts.length);

        }
    },

    computed:{

         posts(){
          return this.$store.getters.posts;

        }
    },

    methods:{
        status(status){
            let data = {0:"Inactive", 1:'Active'}
           return data[status];
        },
        statusButtonColor(status){
            let data = {0:"bg-danger", 1:'bg-success'}
           return data[status];
        },
        remove(slug){

             this.confirm(()=>{

                    axios.get("/remove-post/"+ slug).then((response) => {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                    this.$store.dispatch('getPostsData');

                 }).catch((error)=>{

                 });
             });
        },

         isNoData(){

             return this.posts.length <1;
        },

        selectAll: function(event){

            if(event.target.checked === false){
                this.rowSelect = [];
            }else{
                  this.posts.forEach((posts) => {
                      this.rowSelect.push(posts.id);

                  });
            }
        },
        removeSelectData: function(rowSelect){
            this.confirm(()=>{
                axios.post("/remove-posts/", {data:rowSelect}).then((response) => {
                  Swal.fire(
                    response.data.total+' Items Deleted!',
                    'Your file has been deleted.',
                    'success'
                    );
                    this.$store.dispatch('getPostsData');
                    this.rowSelect=[];
                    this.selectAllData=false;
                    this.isSelect=false;

                 }).catch((error)=>{ });
            });
        },

        statusChange: function(rowSelect, status){
           let message = status === 1?'Actived':'Inactived';

            axios.post("/posts/change-status/", {data:rowSelect, status:status}).then((response) => {
                    toastr.success(response.data.total+' Post has been  '+ message +' Successfully');
                    this.$store.dispatch('getPostsData');
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

</style>
