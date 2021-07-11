<template>
     <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form @submit.prevent="updateCategory" id="categoryForm">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Edit Category</h3>
                      <router-link to="/category" class="btn btn-success float-right"> Category</router-link>
                    </div>
                    <div class="card-body">
                    <input id="name" class="form-control form-control-sm" type="text" placeholder="Category Name" v-model="form.name">
                    <HasError :form="form" field="name" />
                    <br>


                    <input class="" id="status" value="1" type="radio" v-model="form.status">
                    <span>Status On</span>

                    <input class="" id="status" value="0" type="radio" v-model="form.status">
                     <span>Status Off</span>
                      <HasError :form="form" field="status" />

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success" type="submit">Update</button>
                        <button class="btn btn-default float-right" type="reset">Cancel</button>

                    </div>
                    <!-- /.card-body -->
                </div>
            </form>

{{ this.$route.params.id }}
        </div>
     </div>
    <!-- /.card -->
</template>

<script>
   import Form from 'vform'

        export default {
        data: () => ({
            form: new Form({
                id: null,
                slug: null,
                name: null,
                status: null
            })
        }),
        mounted(){
            this.editCategory();
        },

        methods: {
            //async login () {
         //   const response = await this.form.post('/api/login')
            // ...

           // }
           // console.log('this is test')
           updateCategory: function(){
               let fields = this;
               this.form.post('/update-category').then(function(response){

                toastr.success('Category Update Successfully');

                fields.$router.push('/category');

               });
           },
           editCategory(){

                axios.get("/edit-category/"+ this.$route.params.slug).then((response) => {
                    this.form.fill(response.data);
                 }).catch((error)=>{
                     error;
                 })
           }


        }

        }
</script>
<style scoped>
.card .card-footer button .cancel{
        text-align: right;
    }
</style>
