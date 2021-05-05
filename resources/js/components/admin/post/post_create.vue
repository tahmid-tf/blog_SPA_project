<template>
    <div>
        <admin-index-page>
            <slot>
                <p v-if="uploadInfo">File uploaded successfully</p>
                <form @submit.prevent="upload">
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
            axios.post("/api/post", formData).then(el => {
                if (el.status === 200) {
                    this.uploadInfo = true;
                }
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
    mounted() {}
};
</script>
