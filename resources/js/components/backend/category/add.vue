<template>
     <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form @submit.prevent="addCategory" id="categoryForm">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Add Category</h3>
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
                        <button class="btn btn-success" type="submit">Save</button>
                        <button class="btn btn-default float-right" type="reset" @click="resetForm">Cancel</button>

                    </div>
                    <!-- /.card-body -->
                </div>
            </form>


        </div>
     </div>
    <!-- /.card -->
</template>

<script>
   import Form from 'vform'

        export default {
        data: () => ({
            form: new Form({
                name: "",
                status: null
            })
        }),

        methods: {

           addCategory: function(){
               this.form.post('/add-category').then((data)=>{
                toastr.success('Category Add Successfully');
                this.resetForm();
               });
           },
            resetForm(){
                this.form.name = "",
                this.form.status = null
           }
        }

        }
</script>
<style scoped>
.card .card-footer button .cancel{
        text-align: right;
    }
</style>
