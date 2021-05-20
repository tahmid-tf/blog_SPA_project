<template>
    <div class="body">
        <!-- Navigation -->
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
                <!-- Post Content Column -->
                <div class="col-lg-12">
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
                        class="img img-fluid"
                        :src="'/storage/' + postData.image"
                        alt="Card image cap"
                    />

                    <hr />

                    <!-- Post Content -->
                    <p class="lead">
                        {{ postData.description }}
                    </p>

                    <hr />
                </div>

                <div class="col-lg-12">
                    <!-- Comments Form -->
                    <div class="card my-4">
                        <h5 class="card-header">Leave a Comment:</h5>
                        <div class="card-body">
                            <form @submit.prevent="sendComment">
                                <div class="form-group">
                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        placeholder="Enter your name"
                                        v-model="username"
                                    />
                                </div>
                                <div class="form-group">
                                    <textarea
                                        class="form-control"
                                        rows="3"
                                        v-model="commentLine"
                                        placeholder="Enter comment"
                                    ></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Single Comment -->
                    <div
                        class="media mb-4"
                        v-for="comment in comments"
                        :key="comment.id"
                    >
                        <img
                            class="d-flex mr-3 rounded-circle"
                            src="http://placehold.it/50x50"
                            alt=""
                        />
                        <div class="media-body">
                            <h5 class="mt-0">{{ comment.name }} says,</h5>
                            {{ comment.description }}
                            <hr />
                        </div>
                        <button
                            class="btn btn-outline-danger"
                            v-if="buttonStatus"
                            @click.prevent="removeComment(comment.id)"
                        >
                            Remove comment
                        </button>
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
            img: "/storage/images/DJ3GMrjjbedI10W7IpbZgZEvfhZHPWl0aqRHOMMJ.png",
            commentLine: "",
            post_id: 0,
            username: "",
            comments: "",
            buttonStatus: false
        };
    },
    mounted() {
        axios.get(`/api/posts/${this.$route.params.id}`).then(response => {
            let id = response.data.post.user_id;
            let post_id = response.data.post.id;
            this.post_id = post_id;
            // console.log(id);
            response.data.users.forEach(element => {
                if (element.id === id) {
                    response.data.post.username = element.name;
                    this.postData = response.data.post;
                    // console.log(this.postData);
                }
            });
        });

        this.viewComment();
        this.buttonStatusMethohd();
    },
    methods: {
        sendComment() {
            axios
                .post("/api/comment", {
                    name: this.username,
                    description: this.commentLine,
                    id: this.post_id
                })
                .then(res => {
                    if (res.status === 200) {
                        alert("comment addedd successfully");
                        this.username = null;
                        this.commentLine = null;
                    }
                });
            this.viewComment();
        },

        viewComment() {
            // console.log(this.$route.params.id);
            axios
                .get(`/api/comment/show/${this.$route.params.id}`)
                .then(res => {
                    this.comments = res.data.comments;
                    // console.log(this.comments);
                });
        },
        buttonStatusMethohd() {
            axios.get("/api/user").then(el => {
                if (el.status === 200) {
                    this.buttonStatus = true;
                }
            });
        },
        removeComment(id) {
            const confirmation = confirm("Are you sure?");

            if (confirmation) {
                axios
                    .get(`/api/comment/delete/${id}`)
                    .then(res => console.log(res));
                this.viewComment();
            }
        },
        returnToHome() {
            this.$router.push("/");
        }
    }
};
</script>

<style scoped>
.body {
    padding-top: 56px;
}
</style>
