<template>
    <div>
        <div class="row">
            <router-link to="/create-product" class="btn btn-primary">Add Stock</router-link>
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
                            <h6 class="m-0 font-weight-bold text-primary">Stock</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Code</th>
                                    <th>Category</th>
                                    <th>Quant.</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Buying Price.</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="product in filterSearch" :key="product.id">
                                    <td>{{product.name}}</td>
                                    <td><img :src="product.image" style="width: 70px; height: 70px;"> </td>
                                    <td>{{product.code}}</td>
                                    <td>{{product.category}}</td>
                                    <td>{{product.quantity}}</td>
                                    <td v-if="product.quantity > 10">
                                        <span class="badge badge-success">Available</span>
                                    </td>
                                    <td v-else-if="product.quantity >= 1 && product.quantity < 5">
                                        <span class="badge badge-warning">Low</span>
                                    </td>
                                    <td v-else>
                                        <span class="badge badge-danger">Stock Out</span>
                                    </td>
                                    <td>{{product.buying_price}}</td>
                                    <td>
                                        <router-link :to="{name:'edit-stock', params:{id:product.id}}"
                                                     class="btn btn-sm btn-info">
                                            <i class="fas fa-pencil-alt text-white"></i>
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
        name: 'stock',
        created() {
            // If user is not logged in redirect to '/login'.
            if (!User.isLoggedIn()) {
                this.$router.push({ name: '/' });
            }
            this.getProducts();
        },
        data() {
            return {
                products: [],
                categories: [],
                suppliers: [],
                searchTerm: ''
            }
        },
        computed: {
            filterSearch() {
                return this.products.filter(product => {
                    return product.name.match(this.searchTerm)
                })
            }
        },
        methods: {
            getProducts() {
                axios.get('/api/products/')
                    .then(({data}) => {
                        this.products = data.data;
                    })
                    .catch((err) => {Notification.error('Something wrong')});
            },
        },
    }
</script>

<style type="text/css">
</style>
