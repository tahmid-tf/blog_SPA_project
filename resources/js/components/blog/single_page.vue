<template>
    <div class="body">
        <!-- Navigation -->
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
                <!-- Post Content Column -->
                <div class="col-lg-8">
                    <!-- Title -->
                    <h1 class="mt-4">{{ postData.title }}</h1>

                    <!-- Author -->
                    <p class="lead">
                        by
                        <a href="#">{{ postData.username }}</a>
                    </p>

                    <hr />

                    <!-- Date/Time -->
                    <p>{{ postData.created_at }}</p>

                    <hr />

                    <!-- Preview Image -->
                    <img
                        class="card-img-top"
                        :src="'/storage/' + postData.image"
                        alt="Card image cap"
                    />

                    <hr />

                    <!-- Post Content -->
                    <p class="lead">
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Ducimus, vero, obcaecati, aut, error quam sapiente
                        nemo saepe quibusdam sit excepturi nam quia corporis
                        eligendi eos magni recusandae laborum minus inventore?
                    </p>

                    <hr />
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
                    <div class="card my-4">
                        <h5 class="card-header">Categories</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <a href="#">Web Design</a>
                                        </li>
                                        <li>
                                            <a href="#">HTML</a>
                                        </li>
                                        <li>
                                            <a href="#">Freebies</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <a href="#">JavaScript</a>
                                        </li>
                                        <li>
                                            <a href="#">CSS</a>
                                        </li>
                                        <li>
                                            <a href="#">Tutorials</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

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

<style></style>

<script>
import "../../../../public/vendor/jquery/jquery.min.js";
import "../../../../public/vendor/bootstrap/js/bootstrap.bundle.min.js";
export default {
    data() {
        return {
            postData: "",
            img: "/storage/images/DJ3GMrjjbedI10W7IpbZgZEvfhZHPWl0aqRHOMMJ.png"
        };
    },
    mounted() {
        axios.get(`/api/posts/${this.$route.params.id}`).then(response => {
            let id = response.data.post.user_id;
            console.log(id);
            response.data.users.forEach(element => {
                if (element.id === id) {
                    response.data.post.username = element.name;
                    this.postData = response.data.post;
                    console.log(this.postData);
                }
            });
        });
    }
};
</script>

<style scoped>
.body {
    padding-top: 56px;
}
</style>
