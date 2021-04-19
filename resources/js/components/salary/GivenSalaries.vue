<template>
    <div>
        <div class="row">
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
                            <h6 class="m-0 font-weight-bold text-primary">Employees</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <!-- <th>Job</th> -->
                                    <th>Photo</th>
                                    <!-- <th>Phone No.</th> -->
                                    <th>Sallery</th>
                                    <th>Month</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="employee in filterSearch" :key="employee.id">
                                    <td>{{employee.name}}</td>
                                    <td><img :src="employee.photo" class="rounded-circle" width="50" height="50" :alt="employee.name"></td>
                                    <td>{{employee.amount}}</td>
                                    <td>{{employee.month}}</td>
                                    <td>
                                        <router-link :to="{name:'pay-salary', params:{id:employee.employee_id}}" class="btn btn-sm btn-success">Pay Salary</router-link>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <pagination :data="tabledata" @pagination-change-page="getResults"></pagination>
                        </div>
                    </div>
                </div>
            </div>
            <!--Row-->
        </div>
    </div>
</template>


<script type="text/javascript">
    export default {
        name:'all-salaries',
        created() {
            // If user is not logged in redirect to '/login'.
            if (!User.isLoggedIn()) {
                this.$router.push({ name: '/' });
            }
            this.getEmployeesSalaries();
        },
        data() {
            return {
                tabledata: {},
                employees: [],
                searchTerm: ''
            }
        },
        computed: {
            filterSearch() {
                return this.employees.filter(employee => {
                    return employee.name.match(this.searchTerm)
                })
            }
        },
        methods: {
           getEmployeesSalaries() {
            axios.get('/api/employees-salaries')
                .then(({data}) => { 
                    this.employees = data.data;
                    this.tabledata = data;
                })
                .catch((err) => Notification.error(err.response.data.error));
            },
            //Pagination
            getResults(page = 1) {
                axios.get('/api/employees?page=' + page)
                .then(response => {
                    this.tabledata = response.data;
                    this.employees = response.data.data;
                });
            },
        },
    }
</script>
<style type="text/css">
</style>
