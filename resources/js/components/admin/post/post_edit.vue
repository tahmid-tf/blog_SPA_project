<template>
    <div>
        <admin-index-page>
            <slot>
                <p v-if="uploadInfo">File updated successfully</p>
                <form @submit.prevent="upload" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail">Title</label>
                        <input
                            type="text"
                            class="form-control"
                            id=""
                            placeholder="Enter title"
                            name="=title"
                            required
                            v-model="title"
                        />
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail">Description</label>
                        <input
                            type="text"
                            class="form-control"
                            id=""
                            placeholder="Enter Description"
                            name="description"
                            v-model="description"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail">Category</label>
                        <input
                            type="text"
                            class="form-control"
                            id=""
                            placeholder="Enter Category"
                            name="category"
                            v-model="category"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail">Image</label>
                        <input
                            type="file"
                            @change="previewFiles"
                            name="image"
                            class="form-control-file"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
            </slot>
        </admin-index-page>
    </div>
</template>

<script>
export default {
    data() {
        return {
            image: "",
            title: "",
            description: "",
            category: "",
            uploadInfo: false
        };
    },
    methods: {
        previewFiles(event) {
            var vm = this;
            vm.image = event.target.files[0];
            // console.log(vm.image);
        },
        upload() {
            const formData = new FormData();
            formData.set("title", this.title);
            formData.set("description", this.description);
            formData.set("category", this.category);
            formData.set("image", this.image);
            formData.append("_method", "PUT");
            axios
                .post(`/api/post/${this.$route.params.id}`, formData)
                .then(response => {
                    if (response.status === 200) {
                        this.$router.push({ name: "ViewPost" });
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },

    watch: {
        uploadInfo() {
            setTimeout(() => {
                this.uploadInfo = false;
            }, 2000);
        }
    },
    mounted() {
        axios.get(`/api/posts/${this.$route.params.id}`).then(res => {
            this.title = res.data.post.title;
            this.description = res.data.post.description;
            this.category = res.data.post.category;
        });
    }
};
</script>
