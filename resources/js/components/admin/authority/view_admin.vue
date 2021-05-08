<template>
    <div>
        <admin-index-page>
            <slot>
                <table width="100%">
                    <thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Authority</th>
                        <th>Created_at</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr v-for="(admin, index) in adminList" :key="admin.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ admin.name }}</td>
                            <td>{{ admin.email }}</td>
                            <td>{{ admin.authority }}</td>
                            <td>{{ admin.created_at }}</td>
                            <td>
                                <button
                                    class="btn btn-danger"
                                    @click="deleteAdmin(admin.id)"
                                >
                                    Delete Admin
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </slot>
        </admin-index-page>
    </div>
</template>

<script>
export default {
    data() {
        return {
            adminList: [],
            adminLevel: ""
        };
    },

    mounted() {
        this.mountedData();
    },

    methods: {
        deleteAdmin(id) {
            if (this.adminLevel === "super_admin") {
                // console.log("Access granted");
                const confirmation = confirm("Are you sure?");
                if (confirmation) {
                    axios.get(`/api/admins/delete/${id}`).then(el => {
                        if (el.status === 200) {
                            this.mountedData();
                        }
                    });
                }
            } else {
                alert("Option available only for super admins");
            }
        },
        mountedData() {
            axios.get("/api/admins").then(el => {
                this.adminList = el.data.users;
                this.adminLevel = el.data.admin.authority;
                // console.log(this.adminList);
            });
        }
    }
};
</script>
