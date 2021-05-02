<template>
    <div>
        <admin-index>
            <slot>
                <h1>Dashboard</h1>
            </slot>
        </admin-index>
    </div>
</template>

<script>
import AdminIndex from "../admin_index.vue";

export default {
    components: {
        AdminIndex
    }
};
</script>
