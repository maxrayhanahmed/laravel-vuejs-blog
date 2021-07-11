
import home from "../components/backend/home.vue";
import categorycomponent from "../components/backend/category/manage.vue";
import categoryadd  from "../components/backend/category/add.vue";
import categoryedit  from "../components/backend/category/edit.vue";

import postadd  from "../components/backend/post/add.vue";
import postlist  from "../components/backend/post/manage.vue";
import postedit  from "../components/backend/post/edit.vue";


export const routes = [
 { path: '/home', component: home },
 { path: '/category', component: categorycomponent },
 { path: '/categoryadd', component: categoryadd },
 { path: '/edit-category/:slug', component: categoryedit },

 { path: '/add-post', component: postadd },
 { path: '/post-list', component: postlist },
 { path: '/edit-post/:slug', component: postedit }
   ]
