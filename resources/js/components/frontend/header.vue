<template>
 <div class="header">
                <div class="logo">
                    <a href="index.html"><img src="images/logo.png" class="img-responsive" alt=""></a>
                </div>

                    <div class="head-nav">
                        <span class="menu"> </span>
                            <ul class="cl-effect-1">
                                <li><router-link to="/">Home</router-link></li>
                                <li><router-link  to="/about">about</router-link></li>
                                <li v-for="category in categories" :key="category.id">
                                    <router-link  :to="/category/+category.slug">{{category.name}}</router-link>
                                </li>

                                <div class="clearfix"></div>
                            </ul>
                    </div>
                                <!-- <script>
                                    $( "span.menu" ).click(function() {
                                    $( ".head-nav ul" ).slideToggle(300, function() {
                                        // Animation complete.
                                    });
                                    });
                                </script>
                            -->


                        <div class="clearfix"> </div>
            </div>

</template>

<script>
export default{
name:"Header",
 mounted(){
        this.$store.dispatch('getActiveFrontCategories');

    },

    computed:{
        categories(){
          return this.$store.getters.categories;
        }
    },
}
</script>
