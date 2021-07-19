<template>
<div class="content-top">

			<div class="single">
                 <h2>{{post.title}}</h2>
				<div class="single-top">
					<img :src="'admin/media/images/post/'+post.thumbnail" class="img-responsive" alt="">

					<div> {{post.content}} </div>
				</div>
				<front-sidebar></front-sidebar>
					<div class="clearfix"> </div>
			</div>
</div>

</template>

<script>
    import sidebar from './sidebar';
    export default {
        name:"single",
        data: function () {
            return {
                post: {}
                }
            },
         components:{
        'front-sidebar': sidebar
    },
    mounted(){
        this.singlePost();
    },

    methods:{
         singlePost(){

                axios.get("/single-post/"+ this.$route.params.slug).then((response) => {
                   this.post = response.data.post[0]

                 }).catch((error)=>{

                 })
           },
    }


    }
</script>
