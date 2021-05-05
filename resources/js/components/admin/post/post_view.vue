<template>
    <div>
        <admin-index-page>
            <p style="color : red" v-if="refresh_status">
                Refresh this page once before every use
            </p>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
            </table>
        </admin-index-page>
    </div>
</template>

<style scoped></style>

<script>
export default {
    data() {
        return {
            refresh_status: true
        };
    },
    mounted() {
        console.log("Mounted");

        setTimeout(() => {
            this.refresh_status = false;
        }, 5000);
    }
};
</script>
