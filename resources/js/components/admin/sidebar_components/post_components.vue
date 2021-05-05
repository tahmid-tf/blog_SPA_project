<template>
    <div>
        <li class="nav-item">
            <a
                class="nav-link collapsed"
                href="#"
                data-toggle="collapse"
                data-target="#collapseTwo"
                aria-expanded="true"
                aria-controls="collapseTwo"
            >
                <i class="fas fa-fw fa-cog"></i>
                <span>Post</span>
            </a>
            <div
                id="collapseTwo"
                class="collapse"
                aria-labelledby="headingTwo"
                data-parent="#accordionSidebar"
            >
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">
                        Post Components:
                    </h6>
                    <router-link
                        :to="{ name: 'CreatePost' }"
                        class="collapse-item"
                    >
                        Create Post
                    </router-link>

                    <router-link
                        :to="{ name: 'ViewPost' }"
                        class="collapse-item"
                    >
                        View all Post
                    </router-link>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider" />
    </div>
</template>

<script>
export default {};
</script>
