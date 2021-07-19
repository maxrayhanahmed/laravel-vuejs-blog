import axios from "axios";

export default {

    state: {
        getCategories:[],
        getPosts:[],
      },
      getters: {
        categories(state){
            return state.getCategories;
         },

         posts(state){
            return state.getPosts;
         }

      },

      actions:{
        getCategoriesData(data){
            axios.get("/category").then((response) => {
                data.commit('categories', response.data.categories);
            })
        },
        getActiveCategories(data){
            axios.get("/active-category").then((response) => {
                data.commit('categories', response.data.categories);
            })
        },

        getActiveFrontCategories(data){
            axios.get('/front-active-category').then((response)=>{
                data.commit('categories', response.data.categories);
            }).catch((error)=>{

            });
        },
        // categoryFrontPost(data){
        //     axios.get('/category-post/'+this.state.catSlug).then((response)=>{
        //         data.commit('categoryPosts', response.data.category.posts);
        //         //console.log(response.data.category);

        //     }).catch((error)=>{

        //     });
        // },


        getPostsData(data){
            axios.get("/post-list").then((response) => {
                data.commit('posts', response.data.posts);
            })
        },
        // getFrontPosts(data){
        //     axios.get("/front-posts").then((response) => {
        //         data.commit('posts', response.data.posts);
        //         //console.log(response.data.posts);
        //     })
        // },

      },

      mutations:{
        categories(state, data){
            return state.getCategories = data;
        },

        categoryPosts(state, data){
            return state.getPosts = data;
        },

        posts(state, data){
            return state.getPosts = data;
        },


      }

}
