<template>
    <div>
        <div class="row">
            <router-link to="/given-salaries" class="btn btn-primary">Employee Salaries</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Pay Salary</h1>
                                    </div>
                                    <form class="user" @submit.prevent="SalaryPaid">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect"> Name</label>
                                                    <input type="text" class="form-control"
                                                           placeholder=" Full Name" v-model="form.name" readonly>
                                                    <small class="text-danger"
                                                           v-if="errors.name">{{errors.name[0]}}</small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1"> Email</label>
                                                    <input type="email" class="form-control"
                                                        v-model="form.email" readonly>
                                                    <small class="text-danger"
                                                        v-if="errors.email">{{errors.email[0]}}</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect2">Month</label>
                                                    <select v-model="form.month" class="form-control">
                                                        <option value="January">January</option>
                                                        <option value="February">February</option>
                                                        <option value="February">February</option>
                                                        <option value="March">March</option>
                                                        <option value="April">April</option>
                                                        <option value="May">May</option>
                                                        <option value="June">June</option>
                                                        <option value="July">July</option>
                                                        <option value="August">August</option>
                                                        <option value="September">September</option>
                                                        <option value="October">October</option>
                                                        <option value="November">November</option>
                                                        <option value="December">December</option>
                                                    </select>
                                                    <small class="text-danger"
                                                        v-if="errors.month">{{errors.month[0]}}</small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect3">Salary</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Salery" v-model="form.amount">
                                                    <small class="text-danger" v-if="errors.amount">{{errors.amount[0]}}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Pay</button>
                                        </div>
                                        <hr>
                                    </form>
                                    <hr>
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

<script type="text/javascript">
    export default {
        name:'pay-salary',
        created() {
             // If user is not logged in redirect to '/login'.
            if (!User.isLoggedIn()) {
                this.$router.push({ name: '/' });
            }
            
            let id = this.$route.params.id;
            axios.get('/api/employees/'+id)
                .then(({data}) => this.form = data.data)
                .catch((err) => Notification.error(err.response.data.error));
        },
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    amount: '',
                    month: ''
                },
                errors: {}
            }
        },
        methods: {
            SalaryPaid() {
                let id = this.$route.params.id;
                axios.post('/api/salary/paid/' + id, this.form)
                    .then(() => {
                        this.$router.push({name: 'given-salaries'})
                        Notification.success()
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                        Notification.error(err.response.data.error);
                    });
            },
        }
    }
</script>
<style type="text/css">
</style>
<!---->