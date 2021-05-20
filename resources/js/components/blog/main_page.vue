<template>
    <div class="body">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <span
                    class="navbar-brand"
                    style="cursor : pointer"
                    @click="returnToHome()"
                >
                    TF Blog
                </span>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarResponsive"
                    aria-controls="navbarResponsive"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <!-- <a class="nav-link" href="#"
                                >Home
                                <span class="sr-only">(current)</span>
                            </a> -->

                            <router-link
                                :to="{ name: 'ViewPost' }"
                                class="nav-link"
                                >Admin Panel</router-link
                            >
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <!-- Blog Entries Column -->
                <div class="col-md-8">
                    <p></p>
                    <!-- <h1 class="my-4">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1> -->

                    <div v-if="dataLength">
                        <span v-for="post in laravelData.data" :key="post.id">
                            <!-- Blog Post -->
                            <div class="card mb-4">
                                <img
                                    class="card-img-top"
                                    :src="'storage/' + post.image"
                                    alt="Card image cap"
                                />
                                <div class="card-body">
                                    <h2 class="card-title">{{ post.title }}</h2>
                                    <p class="card-text">
                                        {{ post.description }}
                                    </p>

                                    <router-link
                                        :to="{
                                            name: 'Single',
                                            params: { id: post.id }
                                        }"
                                        class="btn btn-primary"
                                        tag="a"
                                        >Read More &rarr;</router-link
                                    >
                                </div>
                                <div class="card-footer text-muted">
                                    {{ new Date(post.created_at) }}
                                    <p style="color : green">
                                        Posted by - {{ post.username }}
                                    </p>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div v-else>
                        <p>Search result not found</p>
                    </div>

                    <!-- Pagination for main page -->
                    <div
                        style="display : flex; justify-content : center"
                        v-if="paginateCordinator == 'all'"
                    >
                        <pagination
                            :data="laravelData"
                            @pagination-change-page="getResults"
                        ></pagination>
                    </div>

                    <!-- Pagination for category page -->
                    <div
                        style="display : flex; justify-content : center"
                        v-if="paginateCordinator == 'category'"
                    >
                        <pagination
                            :data="laravelData"
                            @pagination-change-page="categoryResults"
                        ></pagination>
                    </div>

                    <!-- Pagination for category page -->
                    <div
                        style="display : flex; justify-content : center"
                        v-if="paginateCordinator == 'search'"
                    >
                        <pagination
                            :data="laravelData"
                            @pagination-change-page="searchResults"
                        ></pagination>
                    </div>
                    <!-- Navigation -->
                </div>

                <!-- Sidebar Widgets Column -->
                <div class="col-md-4">
                    <!-- Search Widget -->
                    <div class="card my-4">
                        <h5 class="card-header">Search</h5>
                        <div class="card-body">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Search for..."
                                    v-model="searchPost"
                                />
                                <span class="input-group-btn">
                                    <button
                                        class="btn btn-secondary"
                                        type="button"
                                        @click="searchForPost"
                                    >
                                        Go!
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Categories Widget -->
                    <category-component
                        @category-data="categoryData"
                    ></category-component>

                    <!-- Side Widget -->
                    <div class="card my-4">
                        <h5 class="card-header">Side Widget</h5>
                        <div class="card-body">
                            You can put anything you want inside of these side
                            widgets. They are easy to use, and feature the new
                            Bootstrap 4 card containers!
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->

        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">
                    Copyright &copy; Your Website 2019
                </p>
            </div>
            <!-- /.container -->
        </footer>
        <!-- <button @click="lengthTest">Length</button> -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            laravelData: {},
            emittedData: "",
            paginateCordinator: "",
            searchPost: "",
            dataLength: false
        };
    },
    mounted() {
        this.getResults();
    },

    methods: {
        lengthTest() {
            console.log(this.laravelData.length);
            return Object.keys(this.laravelData.data).length > 0 ? true : false;
        },

        searchForPost() {
            // console.log(this.searchPost);
            this.laravelData = {};
            this.searchResults();
        },
        returnToHome() {
            this.laravelData = {};
            this.getResults();
        },
        // Our method to GET results from a Laravel endpoint
        getResults(page = 1) {
            axios.get("/api/posts?page=" + page).then(response => {
                response.data.posts.data.forEach(element => {
                    let id = element.user_id;
                    response.data.users.forEach(el => {
                        if (el.id === id) {
                            element.username = el.name;
                        }
                    });
                });
                this.laravelData = response.data.posts;

                this.laravelData.data.length > 0
                    ? (this.dataLength = true)
                    : (this.dataLength = false);
                this.paginateCordinator = "all";
                // console.log(this.paginateCordinator);
                // console.log(this.dataLength);
            });
        },

        categoryResults(page = 1) {
            var vm = this.emittedData;
            axios.get(`/api/categories/${vm}?page=` + page).then(response => {
                response.data.posts.data.forEach(element => {
                    let id = element.user_id;
                    response.data.users.forEach(el => {
                        if (el.id === id) {
                            element.username = el.name;
                        }
                    });
                });
                this.laravelData = response.data.posts;
                this.laravelData.data.length > 0
                    ? (this.dataLength = true)
                    : (this.dataLength = false);
                // console.log(this.laravelData);
                this.paginateCordinator = "category";
                // console.log(this.paginateCordinator);
            });
        },

        searchResults(page = 1) {
            const vm = this.searchPost;
            axios
                .get(`/api/categories/search/${vm}?page=` + page)
                .then(response => {
                    response.data.posts.data.forEach(element => {
                        let id = element.user_id;
                        response.data.users.forEach(el => {
                            if (el.id === id) {
                                element.username = el.name;
                            }
                        });
                    });
                    this.laravelData = response.data.posts;
                    this.laravelData.data.length > 0
                        ? (this.dataLength = true)
                        : (this.dataLength = false);
                    // console.log(this.laravelData);
                    this.paginateCordinator = "search";
                    // console.log(this.paginateCordinator);
                });
        },

        categoryData(e) {
            // console.log(e);
            this.emittedData = e;
            // console.log(this.emittedData);
            this.laravelData = {};
            this.categoryResults();
        }
    }
};
</script>

<style scoped>
.body {
    padding-top: 56px;
}
</style>
