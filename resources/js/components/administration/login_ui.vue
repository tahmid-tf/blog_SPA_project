<template>
    <div>
        <div class="container siginin-container">
            <div class="row">
                <div class="col"></div>
                <div class="col-sm-12 col-md-8">
                    <div class="card signin-card">
                        <div class="card-body">
                            <!--                            <img-->
                            <!--                                src="layout_images/devlops.png"-->
                            <!--                                class="img-fluid signin-img"-->
                            <!--                            />-->
                            <h4 style="text-align: center">Admin Panel</h4>
                            <form class="signin-form" @submit.prevent="logIn">
                                <div class="form-group">
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="emailInput"
                                        placeholder="Email"
                                        v-model="email"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="passwordInput"
                                        placeholder="Password"
                                        v-model="password"
                                    />
                                </div>

                                <button
                                    type="submit"
                                    class="btn signIn-btn btn-lg"
                                    :disabled="disabled_status"
                                >
                                    Log in
                                </button>

                                <!-- <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="gridCheck">
                              <label class="form-check-label" for="gridCheck">
                                 Remember Me<a href="#"> Need Help?</a>
                              </label>
                            </div> -->
                            </form>
                        </div>
                    </div>

                    <router-link to="/" class="create-new-account"
                        >Home</router-link
                    >
                </div>
                <div class="col"></div>
            </div>
        </div>
    </div>
</template>

<script>
import "../../../../public/css/style.css";
export default {
    data() {
        return {
            email: "",
            password: "",
            disabled_status: false
        };
    },
    methods: {
        logIn() {
            axios
                .post("/api/login", {
                    email: this.email,
                    password: this.password
                })
                .then(el => {
                    if (el.status === 200) {
                        this.$router.push({ name: "ViewPost" });
                    }
                });
        }
    },

    mounted() {
        axios.get("/api/user").then(el => {
            if (el.status === 200) {
                this.disabled_status = true;
            } else {
                this.state_status = false;
            }
        });
    }

    // beforeRouteEnter(to, from, next) {
    //     axios.get("/api/user").then(el => {
    //         if (el.status === 200) {
    //             next(false);
    //         } else {
    //             next(true);
    //         }
    //     });
    // }
};
</script>
