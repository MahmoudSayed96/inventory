<template>
    <div>
        <div class="row">
            <router-link to="/expenses" class="btn btn-primary">All Expenses</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Expense Update</h1>
                                        <hr>
                                    </div>
                                    <form class="user" @submit.prevent="expenseUpdate">
                                        <div class="form-row">
                                            <!-- Amount -->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="amount">Expense Amount</label>
                                                    <input type="number" min="0.00" step="0.01" class="form-control" :class="{'is-invalid': errors.amount }" id="amount" 
                                                        placeholder="Enter Expense Amount" required v-model="form.amount">
                                                    <div class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="details">Details</label>
                                                    <textarea class="form-control" v-model="form.details" id="dtails" rows="5" :class="{'is-invalid': errors.details }"></textarea>
                                                    <div class="text-danger" v-if="errors.details">{{ errors.details[0] }}</div>
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
    name: 'edit-expense',
    created() {
        // If user is not logged in redirect to '/login'.
        if (!User.isLoggedIn()) {
            this.$router.push({ name: '/' });
        }
        let id = this.$route.params.id;
        axios.get('/api/expenses/'+id)
            .then(({data}) => this.form = data.data)
            .catch((err) => Notification.error(err.response.data.error));
    },
    data() {
        return {
            form: {
                amount: '',
                details: '',
            },
            errors: {}
        }
    },
    methods: {
        expenseUpdate() {
            let id = this.$route.params.id;
            axios.patch('/api/expenses/'+id, this.form)
                .then((res) => {
                    Notification.success();
                    this.$router.push({ name: 'expenses' });
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                    Notification.error('Something wroning');
                });
        }
    }
}
</script>