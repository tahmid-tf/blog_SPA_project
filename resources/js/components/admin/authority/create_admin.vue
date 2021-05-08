<template>
    <div>
        <admin-index-page>
            <slot>
                <p v-if="confirmation" style="color : red">
                    Admin register successfully done
                </p>
                <form @submit.prevent="registerAdmin()">
                    <div class="form-group">
                        <label for="exampleInputEmail">Name</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Enter name"
                            name="=name"
                            required
                            v-model="name"
                        />
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail">E-mail</label>
                        <input
                            type="email"
                            class="form-control"
                            placeholder="Enter email address"
                            name="email"
                            v-model="email"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            placeholder="Enter Password"
                            name="password"
                            v-model="password"
                            required
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
            name: "",
            email: "",
            password: "",
            confirmation: false
        };
    },
    methods: {
        registerAdmin() {
            axios
                .post("/api/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password
                })
                .then(el => {
                    if (el.status === 201) {
                        this.confirmation = true;

                        this.name = "";
                        this.email = "";
                        this.password = "";

                        setTimeout(() => {
                            this.confirmation = false;
                        }, 5000);
                    }
                });
        }
    }
};
</script>
