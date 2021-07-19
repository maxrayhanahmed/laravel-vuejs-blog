<template>
<div class="blog">

		<div class="blog-content">
            <div class="blog-content-left">
                <div class="blog-articals">
                    <div class="blog-artical" style="margin:5px" v-for="post in posts.data " v-bind:key="post.id">
                        <div class="blog-artical-info">
                            <div class="blog-artical-info-img">
                                <router-link :to="`/post/${post.slug}`"><img :src="'admin/media/images/post/'+post.thumbnail" :title="post.title"></router-link>
                            </div>
                            <div class="blog-artical-info-head">
                                <h2><router-link :to="`/post/${post.slug}`">{{post.title}}</router-link></h2>
                                <h6>Posted on, {{post.created_at | time}} by <a href="#"> {{post.user.name}}</a></h6>

                            </div>
                            <div class="blog-artical-info-text">
                                <div v-html="readMoreWithMethod(post.content,200,'...')"></div>

                            </div>

                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <br/>
                </div>
               <!--start-blog-pagenate-->
                    <nav>


                        <pagination :data="posts" @pagination-change-page="getFrontPosts"></pagination>
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
    name:"home",
    data(){
        return{
            posts:{}
        }
    },
    components:{
        'front-sidebar': sidebar
    },

    mounted(){
        this.getFrontPosts();
    },

      methods: {
        getFrontPosts(page = 1) {
            axios.get('/front-posts?page=' + page).then((response) => {

                 this.posts = response.data.posts;
             })
        },


    }
}


</script>
