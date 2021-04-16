<template>
    <div>
        <div class="row">
            <router-link to="/create-supplier" class="btn btn-primary">Add Supplier</router-link>
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
                  <h6 class="m-0 font-weight-bold text-primary">Suppliers List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Shop Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="supplier in searchFilter" :key="supplier.id">
                        <td>{{ supplier.name }}</td>
                        <td><img :src="supplier.photo" class="rounded-circle" width="50" height="50" :alt="supplier.name"></td>
                        <td>{{ supplier.email }}</td>
                        <td>{{ supplier.phone }}</td>
                        <td>{{ supplier.shop_name }}</td>
                        <td>
                            <a href="#" class="btn btn-info">
                                <i class="fas fa-eye text-white"></i>
                            </a>
                            <router-link :to="{name: 'edit-supplier', params: {id: supplier.id}}"  class="btn btn-primary">
                                <i class="fas fa-pencil-alt text-white"></i>
                            </router-link>
                            <a @click="deleteSupplier(supplier.id)" class="btn btn-danger">
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
    name: 'all-suppliers',
    created() {
        // If user is not logged in redirect to '/login'.
        if (!User.isLoggedIn()) {
            this.$router.push({ name: '/' });
        }
        this.getSuppliers();
    },
    data() {
        return {
            tabledata: {},
            suppliers: [],
            searchTerm: ''
        }
    },
    computed: {
        searchFilter() {
            return this.suppliers.filter(supplier => {
                return supplier.name.match(this.searchTerm);
            });
        }
    },
    methods: {
        getSuppliers() {
            axios.get('/api/suppliers')
                .then(({ data }) => {
                    this.suppliers = data.data;
                    this.tabledata = data;
                })
                .catch((err) => Notification.error(err.response.data.error));
        },
         //Pagination
        getResults(page = 1) {
            axios.get('/api/suppliers?page=' + page)
            .then(response => {
                this.tabledata = response.data;
                this.suppliers = response.data.data;
            });
        },
        deleteSupplier(id) {
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
                    axios.delete('/api/suppliers/' + id)
                        .then((res) => {
                            this.suppliers = this.suppliers.filter(supplier => {
                                return supplier.id != id;
                            });
                            this.$router.push({ name: 'suppliers' });
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