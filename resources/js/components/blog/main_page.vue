<template>
    <div class="body">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <router-link to="/" tag="a" class="navbar-brand"
                    >Blog</router-link
                >
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
                            <a class="nav-link" href="#"
                                >Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <!-- Blog Entries Column -->
                <div class="col-md-8">
                    <h1 class="my-4">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>

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
                                {{ post.created_at }}
                                <p style="color : green">
                                    Posted by - {{ post.username }}
                                </p>
                            </div>
                        </div>
                    </span>

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
                        v-if="paginateCordinator == 'search'"
                    >
                        <pagination
                            :data="laravelData"
                            @pagination-change-page="betResults"
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
                                />
                                <span class="input-group-btn">
                                    <button
                                        class="btn btn-secondary"
                                        type="button"
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
    </div>
</template>

<script>
export default {
    data() {
        return {
            laravelData: {},
            emittedData: "",
            paginateCordinator: ""
        };
    },
    mounted() {
        this.getResults();
    },
    methods: {
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
                this.paginateCordinator = "all";
                // console.log(this.paginateCordinator);
            });
        },

        betResults(page = 1) {
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
            this.betResults();
        }
    }
};
</script>

<style scoped>
.body {
    padding-top: 56px;
}
</style>
