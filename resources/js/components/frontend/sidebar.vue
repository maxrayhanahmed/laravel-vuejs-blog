<template>
          <div class="blog-content-right">
						<div class="b-search">
							<form>
								<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
								<input type="submit" value="">
							</form>
						</div>

						<!-- start-tag-weight-->
						<div class="b-tag-weight">
							<h3>Category Weight</h3>
							<ul>

								<li v-for="category in categories" :key="category.id"><a href="#">{{category.name}}</a></li>

							</ul>
						</div>
						<!---- //End-tag-weight---->
					</div>
</template>
<script>
export default{
    name:"sidebar",
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
