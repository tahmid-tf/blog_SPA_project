<template>
    <div>
        <li class="nav-item">
            <a
                class="nav-link collapsed"
                href="#"
                data-toggle="collapse"
                data-target="#collapseThree"
                aria-expanded="true"
                aria-controls="collapseThree"
            >
                <i class="fas fa-fw fa-cog"></i>
                <span>Authorization</span>
            </a>
            <div
                id="collapseThree"
                class="collapse"
                aria-labelledby="headingTwo"
                data-parent="#accordionSidebar"
            >
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                        Authorization Components:
                    </h6>
                    <router-link
                        :to="{ name: 'CreateAdmin' }"
                        class="collapse-item"
                    >
                        Add Admin
                    </router-link>

                    <router-link
                        :to="{ name: 'ViewAdmin' }"
                        class="collapse-item"
                    >
                        Admin action
                    </router-link>

                    <!-- <router-link
                        :to="{ name: 'ViewPost' }"
                        class="collapse-item"
                    >
                        Delete account
                    </router-link> -->

                    <!-- <router-link
                        :to="{ name: 'ViewPost' }"
                        class="collapse-item"
                    >
                        Change Password
                    </router-link> -->
                </div>
            </div>
        </li>
        <hr class="sidebar-divider" />
    </div>
</template>

<script>
export default {};
</script>
