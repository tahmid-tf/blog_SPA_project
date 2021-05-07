<template>
    <div>
        <admin-index-page>
            <table style="width : 100%; text-align: center">
                <thead>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Posted By</th>
                    <th>Created At</th>
                    <th>Update</th>
                    <th>Delete</th>
                </thead>
                <div style="margin-top : 20px"></div>
                <tbody>
                    <tr v-for="(post, index) in postData.data" :key="post.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ post.title }}</td>
                        <td>{{ post.description }}</td>
                        <td style="width : 200px">
                            <img
                                class="card-img-top"
                                :src="'/storage/' + post.image"
                                alt="Card image cap"
                            />
                        </td>
                        <td>{{ post.category }}</td>
                        <td>{{ post.username }}</td>
                        <td>{{ post.created_at }}</td>
                        <td>
                            <button
                                class="btn btn-info"
                                @click="editPost(post.id)"
                            >
                                Update Post
                            </button>
                        </td>
                        <td>
                            <button
                                class="btn btn-danger"
                                @click="deletePost(post.id)"
                            >
                                Delete Post
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div
                style="display : flex; justify-content : center; margin-top : 30px"
            >
                <pagination
                    :data="postData"
                    @pagination-change-page="getResults"
                ></pagination>
            </div>
        </admin-index-page>
    </div>
</template>

<style scoped></style>

<script>
export default {
    data() {
        return {
            refresh_status: true,
            postData: {}
        };
    },
    methods: {
        // Our method to GET results from a Laravel endpoint
        getResults(page = 1) {
            axios.get("/api/post?page=" + page).then(response => {
                response.data.posts.data.forEach(element => {
                    let id = element.user_id;
                    response.data.users.forEach(el => {
                        if (el.id === id) {
                            element.username = el.name;
                        }
                    });
                });
                this.postData = response.data.posts;
            });
        },
        deletePost(id) {
            let confirmation = confirm("Are you sure to delete post?");
            if (confirmation) {
                axios.delete(`/api/post/${id}`).then(el => {
                    if (el.status === 200) {
                        this.getResults();
                    }
                });
            }
        },
        editPost(id) {
            this.$router.push({ name: "EditPost", params: { id } });
        }
    },
    mounted() {
        console.log("Mounted");
        this.getResults();
    }
};
</script>
