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
                                    <h1 class="h4 text-gray-900 mb-4">Add Category</h1>
                                    <hr>
                                </div>
                                <form class="user" @submit.prevent="categoryInsert">
                                     <!-- Name -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" :class="{'is-invalid': errors.name }" id="name" 
                                                placeholder="Enter Supplier Name" required v-model="form.name">
                                            <div class="text-danger" v-if="errors.name">{{ errors.name[0] }}</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
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
    name: 'create-supplier',
    created() {
        // If user is not logged in redirect to '/login'.
        if (!User.isLoggedIn()) {
            this.$router.push({ name: '/' });
        }
    },
    data() {
        return {
            form: {
                name: null,
            },
            errors: {}
        }
    },
    methods: {
        categoryInsert() {     
            axios.post('/api/categories', this.form)
                .then((res) => {
                    Notification.success();
                    this.$router.push({ name: 'categories' });
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                    Notification.error(err.response.data.error);
                });
        }
    }
}
</script>