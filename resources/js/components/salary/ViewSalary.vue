<template>
    <div>
        <div class="row">
            <router-link to="/salaries" class="btn btn-primary">Back</router-link>
        </div>
        <br>
        <input class="form-control" v-model="searchTerm" style="width: 300px;" type="text" placeholder="Search Here">
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            </div>
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Salaries details</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="salary in filterSearch" :key="salary.id">
                                    <td>{{salary.name}}</td>
                                    <td>{{salary.month}}</td>
                                    <td>{{salary.amount}}</td>
                                    <td>{{salary.date}}</td>
                                    <td>
                                        <router-link :to="{name:'edit-salary', params:{id:salary.id}}" class="btn btn-sm btn-danger">Edit Salary</router-link>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
            <!--Row-->
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        name: 'view-salary',
        created() {
            // If user is not logged in redirect to '/login'.
            if (!User.isLoggedIn()) {
                this.$router.push({ name: '/' });
            }
            this.viewSlary();
        },
        data() {
            return {
                salaries: [],
                searchTerm: ''
            }
        },
        computed: {
            filterSearch() {
                return this.salaries.filter(salary => {
                    return salary.name.match(this.searchTerm)
                })
            }
        },
        methods: {
            viewSlary() {
                let id = this.$route.params.id;
                axios.get('/api/salary/view/' + id)
                    .then(({data})=>(this.salaries = data))
                    .catch(error => this.errors = error.response.data.errors);
            },
        },
    }
</script>

<style type="text/css">
</style>
