<template>
    <div>
        <div class="row">
            <router-link to="/create-employee" class="btn btn-primary">Add Employee</router-link>
        </div>
        <div class="row mt-5">
            <div class="col-4">
                <input type="text" class="form-control" v-model="searchTerm" placeholder="Search Here...">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Employees List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Phone</th>
                        <th>Salary</th>
                        <th>Joining Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="employee in searchFilter" :key="employee.id">
                        <td>{{ employee.name }}</td>
                        <td><img :src="employee.photo" class="rounded-circle" width="50" height="50" :alt="employee.name"></td>
                        <td>{{ employee.phone }}</td>
                        <td>{{ employee.salary }}</td>
                        <td>{{ employee.joining_date }}</td>
                        <td>
                            <a href="#" class="btn btn-info">
                                <i class="fas fa-eye text-white"></i>
                            </a>
                            <router-link :to="{name: 'edit-employee', params: {id: employee.id}}"  class="btn btn-primary">
                                <i class="fas fa-pencil-alt text-white"></i>
                            </router-link>
                            <a @click="deleteEmployee(employee.id)" class="btn btn-danger">
                                <i class="fas fa-trash text-white"></i>
                            </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>

<script>
export default {
    name: 'all-emplyees',
    created() {
        // If user is not logged in redirect to '/login'.
        if (!User.isLoggedIn()) {
            this.$router.push({ name: '/' });
        }
        this.getEmployees();
    },
    data() {
        return {
            employees: [],
            searchTerm: ''
        }
    },
    computed: {
        searchFilter() {
            return this.employees.filter(employee => {
                return employee.name.match(this.searchTerm);
            });
        }
    },
    methods: {
        getEmployees() {
            axios.get('/api/employees')
                .then(({ data }) => this.employees = data)
                .catch((err) => Notification.error(err.response.data.error));
        },
        deleteEmployee(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/employees/' + id)
                        .then((res) => {
                            this.employees = this.employees.filter(employee => {
                                return employee.id != id;
                            });
                            this.$router.push({ name: 'employees' });
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                        })
                        .catch((err) => Notification.error(err.response.data.error));
                }
            });
        }
    }
}
</script>