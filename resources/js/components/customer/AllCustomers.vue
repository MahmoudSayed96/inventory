<template>
    <div>
        <div class="row">
            <router-link to="/create-customer" class="btn btn-primary">Add Customer</router-link>
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
                  <h6 class="m-0 font-weight-bold text-primary">Customers List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="customer in searchFilter" :key="customer.id">
                        <td>{{ customer.name }}</td>
                        <td>{{ customer.email }}</td>
                        <td>{{ customer.phone }}</td>
                        <td>{{ customer.address }}</td>
                        <td>
                            <router-link :to="{name: 'edit-customer', params: {id: customer.id}}"  class="btn btn-primary">
                                <i class="fas fa-pencil-alt text-white"></i>
                            </router-link>
                            <a @click="deleteCustomer(customer.id)" class="btn btn-danger">
                                <i class="fas fa-trash text-white"></i>
                            </a>
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
    </div>
</template>

<style scoped>

</style>

<script>
export default {
    name: 'all-customers',
    created() {
        // If user is not logged in redirect to '/login'.
        if (!User.isLoggedIn()) {
            this.$router.push({ name: '/' });
        }
        this.getCustomers();
    },
    data() {
        return {
            tabledata: {},
            customers: [],
            searchTerm: ''
        }
    },
    computed: {
        searchFilter() {
            return this.customers.filter(customer => {
                return customer.name.match(this.searchTerm);
            });
        }
    },
    methods: {
        getCustomers() {
            axios.get('/api/customers')
                .then(({ data }) => {
                    this.customers = data.data;
                    this.tabledata = data;
                })
                .catch((err) => Notification.error(err.response.data.error));
        },
         //Pagination
        getResults(page = 1) {
            axios.get('/api/customers?page=' + page)
            .then(response => {
                this.tabledata = response.data;
                this.customers = response.data.data;
            });
        },
        deleteCustomer(id) {
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
                    axios.delete('/api/customers/' + id)
                        .then((res) => {
                            this.customers = this.customers.filter(customer => {
                                return customer.id != id;
                            });
                            this.$router.push({ name: 'customers' });
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