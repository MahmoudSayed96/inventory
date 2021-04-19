<template>
    <div>
        <div class="row">
            <router-link to="/given-salaries" class="btn btn-primary">Pay Salary</router-link>
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
                            <h6 class="m-0 font-weight-bold text-primary">Salaries Details</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Month</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="salary in filterSearch" :key="salary.id">
                                    <td>{{salary.month}}</td>
                                    <td>
                                        <router-link :to="{name:'view-salary', params:{id:salary.month}}"
                                                     class="btn btn-sm btn-info">View Salary
                                        </router-link>

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
        name: 'all-salaries',
        created() {
            // If user is not logged in redirect to '/login'.
            if (!User.isLoggedIn()) {
                this.$router.push({ name: '/' });
            }
            this.getSalaries();
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
                    return salary.month.match(this.searchTerm)
                })
            }
        },
        methods: {
            getSalaries() {
                axios.get('/api/salaries')
                    .then(({data}) => (this.salaries = data))
                    .catch((err) => Notification.error('Something wrong'))
            },
        },
    }
</script>

<style type="text/css">

</style>
