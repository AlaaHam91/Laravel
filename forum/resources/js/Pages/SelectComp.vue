<template>
<div>
<h1>hello</h1>
        <select class="form_control">
            <option>Select a category</option>
            <!-- <option
                v-for="category in categories"
                :key="category.id"
                :value="category.id"
                >{{ category.name }}</option -->
            > 
       <!-- </select>
           <select v-if="items.length">
              <option v-for="item in items" :key="item.id">{{ item.label }}</option>
           </select> -->
           <router-view></router-view>
      
</div>
</template>

<script>
import axios from "axios";
import Vue from "vue";

export default {
name:"SelectComp",
    data() {
        return {
            categories: [],
            selectedOption:'',
            items:[]
        };
    },
    methods: {
        loadData() {
            axios
                .get("/ChildrenCategories")
                .then(({ data }) => {
                    this.items=data;
                })
                .catch((error) => {
               this.categories=error.message;

                });
        },
    },
    mounted:function(){
      //full first select
         axios
                .get("/allcategories")
                .then(({ data }) => {
                    console.log(data);
                    this.categories=data;
                    this.items=[];
                })
                .catch((error) => {
               this.categories=error.message;
                });
      
    }
};
</script>
