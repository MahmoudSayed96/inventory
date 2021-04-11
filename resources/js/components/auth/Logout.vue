<template>
    <div>

    </div>
</template>
<style scoped>

</style>
<script>
import AppStorage from '../../Helpers/AppStorage';

export default {
    name: 'logout',
    created() {
        AppStorage.clear();
        Toast.fire({
            icon: 'success',
            title: 'Logged out successfully'
        });
        this.$router.push({ name: '/' });
    }
}
</script>