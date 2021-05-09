<template>
    <div>
        <admin-index-page>
            <slot>
                <h3>Change Password</h3>
                <hr />
                <form>
                    <div class="form-group">
                        <label for="">Enter current password :</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder=""
                            name="current_password"
                            required
                            v-model="oldPass"
                        />
                    </div>

                    <div class="form-group">
                        <label for="">Enter new password :</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder=""
                            name="new_password"
                            required
                            v-model="newPass"
                        />
                    </div>

                    <div class="form-group">
                        <label for="">Type again new password :</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder=""
                            name="verify_password"
                            required
                            v-model="retypePass"
                        />
                    </div>

                    <div class="form-group">
                        <input
                            type="submit"
                            value="Confirm"
                            class="btn btn-outline-danger"
                            :disabled="newPass != retypePass"
                            @click.prevent="changePassword()"
                        />
                    </div>
                </form>
            </slot>
        </admin-index-page>
    </div>
</template>

<script>
export default {
    data() {
        return {
            oldPass: "",
            newPass: "",
            retypePass: "",
            notice: ""
        };
    },

    methods: {
        changePassword() {
            axios
                .post("/api/admins/loggedin/change-pass", {
                    current_password: this.oldPass,
                    new_password: this.newPass,
                    verify_password: this.retypePass
                })
                .then(el => {
                    if (el.data.message) {
                        alert("Password Changed Successfully");
                        this.$router.push({ name: "ViewPost" });
                    } else {
                        alert("Check input fields again");
                    }
                });
        }
    }
};
</script>
