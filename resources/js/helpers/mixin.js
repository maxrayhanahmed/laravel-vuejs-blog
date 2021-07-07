import { Callbacks } from 'jquery';
import Vue from 'vue';
Vue.mixin({
    methods:{
        confirm(callbacks){
            Swal.fire({
                title: 'Are you sure delete this Category?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) callbacks();
                })
        },
        slugify() {
           // return this.form.title
            return "this is test"
                .toString()
                .trim()
                .toLowerCase()
                .replace(/\s+/g, "-")
                .replace(/[^\w\-]+/g, "")
                .replace(/\-\-+/g, "-")
                .replace(/^-+/, "")
                .replace(/-+$/, "");
            }
    }
})
