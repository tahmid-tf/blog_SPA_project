<template>
    <div>
        <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            <li
                                v-for="category in categoryData"
                                :key="category.id"
                            >
                                <span
                                    @click="categoryPass(category)"
                                    style="color : blue; cursor : pointer"
                                    >{{ category }}</span
                                >
                                <!-- <a href="#">{{ category }}</a> -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categoryMain: [],
            categoryData: []
        };
    },

    methods: {
        categoryPass(category) {
            this.$emit("category-data", category);
        }
    },

    mounted() {
        axios.get("/api/categories").then(el => {
            el.data.posts.forEach(element => {
                // console.log(element.category);
                this.categoryMain.push(element.category);
            });
            // console.log(this.categoryMain);
            this.categoryData = [...new Set(this.categoryMain)];

            // console.log(this.categoryData);
        });
    }
};
</script>
