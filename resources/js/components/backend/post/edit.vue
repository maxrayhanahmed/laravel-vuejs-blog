<template>
     <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <form @submit.prevent="updatePost" id="postForm" class="form-horizontal">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Update Post</h3>
                      <router-link to="/post-list" class="btn btn-success float-right"> Post List</router-link>
                    </div>
                    <div class="card-body">

                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Title : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" placeholder="title" v-model="form.title">
                         <HasError :form="form" field="title" />
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="category_id" class="col-sm-2 col-form-label">Category : </label>
                        <div class="col-sm-10">
                            <select class="form-control" id="category_id" v-model="form.category_id">
                                <option value="" selected>Select Category</option>

                                <option v-for="category in categories"  :value="category.id">{{category.name}}</option>


                            </select>
                             <HasError :form="form" field="category_id" />

                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Content : </label>
                        <div class="col-sm-10">
                        <ckeditor :editor="editor" v-model="form.content" :config="editorConfig"></ckeditor>
                         <HasError :form="form" field="content" />
                        </div>
                    </div>


                    <div class="row">
                        <label for="thumbnail" class="col-sm-2 col-form-label">Thumbnail : </label>
                        <div class="col-sm-10">
                            <input @change="imageChange" type="file" name="thumbnail" class="" id="thumbnail">
                         <HasError :form="form" field="thumbnail" />
                         <img style="width:120px" class="float-center" :src="'admin/media/images/post/'+form.thumbnail">
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Status : </label>
                        <div class="col-sm-10">
                          <input class="" id="status" value="1" type="radio" v-model="form.status">
                          <span>Active</span>
                           <input class="" id="status" value="0" type="radio" v-model="form.status">
                          <span>Inactive</span>

                         <HasError :form="form" field="status" />
                        </div>
                    </div>


                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success" type="submit">Update</button>
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
   import Form from 'vform';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

        export default {
        data: () => ({
            form: new Form({

                id: "",
                title: "",
                slug: "",
                category_id: "",
                content: "",
                thumbnail: null,
                status: null

            }),
                editor: ClassicEditor,
                content: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                }
        }),
         mounted(){
            this.$store.dispatch('getActiveCategories');
            this.editPost();
            },

            computed:{
                categories(){
                  return this.$store.getters.categories;

                }
            },

        methods: {

           editPost(){

                axios.get("/edit-post/"+ this.$route.params.slug).then((response) => {
                    this.form.fill(response.data);
                 }).catch((error)=>{

                 })
           },
           updatePost(){

               let fields = this;
               this.form.post('/update-post').then(function(response){

                toastr.success('Post Update Successfully');
                fields.$router.push('/post-list');

               });
           },

           imageChange(event){
               let file = event.target.files[0];
               let reader = new FileReader();
               reader.onload = e => {
                 this.form.thumbnail = e.target.result;
               }
               reader.readAsDataURL(file);
           },


           resetForm(){
                this.form.title = "";
                this.form.category_id = "";
                this.form.content = "";
                this.form.thumbnail = null;
                this.form.status = null;

           }


        }

        }
</script>
<style scoped>

</style>
