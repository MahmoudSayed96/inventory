<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Register</h1>
                        </div>
                        <form @submit.prevent="register">
                            <div class="form-group">
                                <input type="text" class="form-control" :class="{'is-invalid': errors.name}" id="name"
                                    placeholder="Enter Your Full Name" v-model="form.name">
                                <div class="text-danger" v-if="errors.name">{{ errors.name[0] }}</div>
                            </div>
                            <div class="form-group">
                            <input type="email" class="form-control" :class="{'is-invalid': errors.name}" id="email"
                                placeholder="Enter Email Address" v-model="form.email">
                                <div class="text-danger" v-if="errors.email">{{ errors.email[0] }}</div>
                            </div>
                            <div class="form-group">
                            <input type="password" class="form-control" :class="{'is-invalid': errors.password}" id="password"
                             placeholder="Password" v-model="form.password">
                            <div class="text-danger" v-if="errors.password">{{ errors.password[0] }}</div>
                            </div>
                            <div class="form-group">
                            <input type="password" class="form-control" id="password_confirmation"
                                placeholder="Confirm Password" v-model="form.password_confirmation">
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                           <router-link to="/" class="font-weight-bold small">Already have an account?</router-link>
                        </div>
                        <div class="text-center">
                        </div>
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
    name: 'Register',
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null
            },
            errors: {}
        }
    },
    created() {
        // If user is logged in redirect to '/home'.
        if (User.isLoggedIn()) {
            this.$router.push({ name: 'home' });
        }
    },
    methods:{
        register() {
            axios.post('/api/auth/register', this.form)
                .then(res => {
                    User.responseAfterLogin(res);
                    Toast.fire({
                        icon: 'success',
                        title: 'Signed in successfully'
                    });
                    this.$router.push({ name: 'home' });
                })
                .catch(err => this.errors = err.response.data.errors);
        }
    }
}
</script>