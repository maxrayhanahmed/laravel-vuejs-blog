import axios from "axios";

export default {

    state: {
        getCategories:[],
        getPosts:[]
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


        getPostsData(data){
            axios.get("/post-list").then((response) => {
                data.commit('posts', response.data.posts);
            })
        },

      },

      mutations:{
        categories(state, data){
            return state.getCategories = data;
        },

        posts(state, data){
            return state.getPosts = data;
        },


      }

}
