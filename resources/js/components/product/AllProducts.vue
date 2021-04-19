<template>
    <div>
        <div class="row">
            <router-link to="/create-product" class="btn btn-primary">Add Product</router-link>
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
                  <h6 class="m-0 font-weight-bold text-primary">Products List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Category</th>
                        <th>Buying Price</th>
                        <th>Selling Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in searchFilter" :key="product.id">
                        <td>{{ product.code }}</td>
                        <td>{{ product.name }}</td>
                        <td><img :src="product.image" width="70" height="70" :alt="product.name"></td>
                        <td>{{ product.category }}</td>
                        <td>{{ product.buying_price }}</td>
                        <td>{{ product.selling_price }}</td>
                        <td>{{ product.stock }}</td>
                        <td>
                            <a href="#" class="btn btn-info">
                                <i class="fas fa-eye text-white"></i>
                            </a>
                            <router-link :to="{name: 'edit-product', params: {id: product.id}}"  class="btn btn-primary">
                                <i class="fas fa-pencil-alt text-white"></i>
                            </router-link>
                            <a @click="deleteProduct(product.id)" class="btn btn-danger">
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
    name: 'all-products',
    created() {
        // If user is not logged in redirect to '/login'.
        if (!User.isLoggedIn()) {
            this.$router.push({ name: '/' });
        }
        this.getProducts();
    },
    data() {
        return {
            tabledata: {},
            products: [],
            searchTerm: ''
        }
    },
    computed: {
        searchFilter() {
            return this.products.filter(product => {
                return product.name.match(this.searchTerm);
            });
        }
    },
    methods: {
        getProducts() {
            axios.get('/api/products')
                .then(({ data }) => {
                    this.products = data.data;
                    this.tabledata = data;
                })
                .catch((err) => Notification.error(err.response.data.error));
        },
         //Pagination
        getResults(page = 1) {
            axios.get('/api/products?page=' + page)
            .then(response => {
                this.tabledata = response.data;
                this.products = response.data.data;
            });
        },
        deleteProduct(id) {
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
                    axios.delete('/api/products/' + id)
                        .then((res) => {
                            this.products = this.products.filter(product => {
                                return product.id != id;
                            });
                            this.$router.push({ name: 'products' });
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