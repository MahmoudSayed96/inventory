<template>
    <div>
        <div class="row">
            <router-link to="/categories" class="btn btn-primary">All Categories</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Category Update</h1>
                                    <hr>
                                </div>
                                <form class="user" @submit.prevent="categoryUpdate">
                                    <!-- Name -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" :class="{'is-invalid': errors.name }" id="name" 
                                                placeholder="Enter Category Name" required v-model="form.name">
                                            <div class="text-danger" v-if="errors.name">{{ errors.name[0] }}</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>

<script>
export default {
    name: 'edit-category',
    created() {
        // If user is not logged in redirect to '/login'.
        if (!User.isLoggedIn()) {
            this.$router.push({ name: '/' });
        }
        let id = this.$route.params.id;
        axios.get('/api/categories/'+id)
            .then(({data}) => this.form = data.data)
            .catch((err) => Notification.error(err.response.data.error));
    },
    data() {
        return {
            form: {
                name: '',
            },
            errors: {}
        }
    },
    methods: {
        categoryUpdate() {
            let id = this.$route.params.id;
            axios.patch('/api/categories/'+id, this.form)
                .then((res) => {
                    Notification.success();
                    this.$router.push({ name: 'categories' });
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                    Notification.error('Something wroning');
                });
        }
    }
}
</script>