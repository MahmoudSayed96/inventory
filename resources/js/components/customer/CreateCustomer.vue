<template>
    <div>
        <div class="row">
            <router-link to="/customers" class="btn btn-primary">All Customers</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Add Customer</h1>
                                    <hr>
                                </div>
                                <form class="user" @submit.prevent="customerInsert">
                                    <div class="form-row">
                                        <!-- Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" :class="{'is-invalid': errors.name }" id="name" 
                                                    placeholder="Enter Customer Name" required v-model="form.name">
                                                <div class="text-danger" v-if="errors.name">{{ errors.name[0] }}</div>
                                            </div>
                                        </div>
                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" :class="{'is-invalid': errors.email }" id="email" 
                                                    placeholder="Enter Customer Email" required v-model="form.email">
                                                <div class="text-danger" v-if="errors.email">{{ errors.email[0] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <!-- Address -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" :class="{'is-invalid': errors.address }" id="address" 
                                                    placeholder="Enter Customer Address" v-model="form.address">
                                                <div class="text-danger" v-if="errors.address">{{ errors.address[0] }}</div>
                                            </div>
                                        </div>
                                        <!-- Phone -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" 
                                                    :class="{'is-invalid': errors.phone }" id="phone" 
                                                    placeholder="Enter Customer Phone" required v-model="form.phone">
                                                <div class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</div>
                                            </div>
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
                email: null,
                address: null,
                phone: null,
            },
            errors: {}
        }
    },
    methods: {
        customerInsert() {     
            axios.post('/api/customers', this.form)
                .then((res) => {
                    Notification.success();
                    this.$router.push({ name: 'customers' });
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                    Notification.error(err.response.data.error);
                });
        }
    }
}
</script>