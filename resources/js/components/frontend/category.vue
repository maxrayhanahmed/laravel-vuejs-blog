<template>
<div class="blog">

		<div class="blog-content">
					<div class="blog-content-left">
						<div class="blog-articals">
						 <div class="blog-artical" style="margin:5px" v-for="post in posts.data" v-bind:key="post.id">
                        <div class="blog-artical-info">
                            <div class="blog-artical-info-img">
                                <router-link :to="`/post/${post.slug}`"><img :src="'admin/media/images/post/'+post.thumbnail" :title="post.title"></router-link>
                            </div>
                            <div class="blog-artical-info-head">
                                <h2><router-link :to="`/post/${post.slug}`">{{post.title}}</router-link></h2>
                                <h6>Posted on, {{post.created_at | time}} by <a href="#"> rayhan </a></h6>

                            </div>
                            <div class="blog-artical-info-text">
                                <div v-html="readMoreWithMethod(post.content,200,'...')"></div>

                            </div>

                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div v-if="!posts.data.length" class="text-center">No item found</div>

					</div>
					<!--start-blog-pagenate-->
                    <nav>
                        <pagination :data="posts" @pagination-change-page="categoryPosts"></pagination>
                    </nav>
				<!--//End-blog-pagenate-->
					</div>

                <!--site component include-->
				<front-sidebar></front-sidebar>

					<div class="clearfix"> </div>

				</div>
		</div>
		<!-- /Blog -->
</template>


    <script>
    import sidebar from './sidebar';
        export default{
        name:"Category-page",
        data(){
            return{
                posts:{},

            }
        },
        components:{
            'front-sidebar': sidebar
        },
        mounted(){
            this.categoryPosts();
        },

        watch:{
            $route(){
               this.categoryPosts();
            }
        },

        methods:{

            categoryPosts(page = 1){

                axios.get('/category-post/'+ this.$route.params.slug + '?page=' + page ).then((response) => {
                   console.log(this.$route.params.slug);
                   this.posts = response.data.posts;
                 }).catch((error)=>{
                     error;
                 })

           }


        }


        }
</script>


