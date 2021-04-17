<template>
    <div>
        <div class="row">
            <router-link to="/products" class="btn btn-primary">All Products</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Product Update</h1>
                                    <hr>
                                </div>
                                <form class="user" @submit.prevent="productUpdate" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <!-- Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" :class="{'is-invalid': errors.name }" id="name" 
                                                    placeholder="Enter Product Name" required v-model="form.name">
                                                <div class="text-danger" v-if="errors.name">{{ errors.name[0] }}</div>
                                            </div>
                                        </div>
                                        <!-- Code -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" :class="{'is-invalid': errors.code }" id="code" 
                                                    placeholder="Enter Product Code" required v-model="form.code">
                                                <div class="text-danger" v-if="errors.code">{{ errors.code[0] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <!-- Category -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <select name="form.category_id" class="form-control" v-model="form.category_id">
                                                    <optgroup>
                                                        <option value="null"></option>
                                                        <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{cat.name}}</option>
                                                    </optgroup>
                                                </select>
                                                <div class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</div>
                                            </div>
                                        </div>
                                        <!-- Supplier -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="supplier">Supplier</label>
                                                <select name="form.supplier_id" class="form-control"  v-model="form.supplier_id">
                                                    <optgroup>
                                                        <option value="null"></option>
                                                        <option v-for="sup in suppliers" :key="sup.id" :value="sup.id">
                                                            {{sup.name}}
                                                        </option>
                                                    </optgroup>
                                                </select>
                                                <div class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <!-- Stock -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="number" min="1" step="1" class="form-control" :class="{'is-invalid': errors.stock }" id="stock" 
                                                    placeholder="Enter Product Stock" v-model="form.stock">
                                                <div class="text-danger" v-if="errors.stock">{{ errors.stock[0] }}</div>
                                            </div>
                                        </div>
                                        <!-- Quantity -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="number" min="1" step="1" class="form-control" 
                                                    :class="{'is-invalid': errors.quantity }" id="quantity" 
                                                    placeholder="Enter Product Quantity" v-model="form.quantity">
                                                <div class="text-danger" v-if="errors.quantity">{{ errors.quantity[0] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <!-- buying Price -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="number" min="0.00" step="0.01" class="form-control" 
                                                    :class="{'is-invalid': errors.buying_price }" id="buying_price" 
                                                    placeholder="Enter Buying Price" required v-model="form.buying_price">
                                                <div class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</div>
                                            </div>
                                        </div>
                                        <!-- Selling Price -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="number" min="0.00" step="0.01" class="form-control" 
                                                    :class="{'is-invalid': errors.selling_price }" id="selling_price" 
                                                    placeholder="Enter Selling Price" required v-model="form.selling_price">
                                                <div class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <!-- Buying Data -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="buying_date">Buying Date</label>
                                                <input type="date" class="form-control" :class="{'is-invalid': errors.buying_date }" id="buying_date" 
                                                    placeholder="Enter Employee Joining Date" v-model="form.buying_date">
                                                <div class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Image -->
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="file" class="custom-file-input" :class="{'is-invalid': errors.new_image }"
                                                         id="new_image" @change="onFileSelected">
                                                <label class="custom-file-label" for="new_image">Choose file</label>
                                                <div class="text-danger" v-if="errors.new_image">{{ errors.new_image[0] }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img :src="form.new_image" alt="" width="40" height="40">
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
    name: 'edit-products',
    created() {
        // If user is not logged in redirect to '/login'.
        if (!User.isLoggedIn()) {
            this.$router.push({ name: '/' });
        }
        
        this.loadCategories();
        this.loadSuppliers();

        let id = this.$route.params.id;
        axios.get('/api/products/'+id)
            .then(({data}) => this.form = data.data)
            .catch((err) => Notification.error(err.response.data.error));
            
    },
    data() {
        return {
            form: {
                name: '',
                code: '',
                category_id: '',
                supplier_id: '',
                quantity: '',
                stock: '',
                buying_price: '',
                selling_price: '',
                buying_date: '',
                image: '',
                new_image: ''
            },
            categories: {},
            suppliers: {},
            errors: {}
        }
    },
    methods: {
        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 2097540) {
                Notification.error('Image size greater than 2MB.');
            } else {
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.new_image = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        },
        productUpdate() {
            let id = this.$route.params.id;
            axios.patch('/api/products/'+id, this.form)
                .then((res) => {
                    Notification.success();
                    this.$router.push({ name: 'products' });
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                    Notification.error('Something wroning');
                });
        },
        loadCategories() {
            axios.get('/api/categories/list')
                .then(({data}) => this.categories = data.data)
                .catch((err) => Notification.error('Somthing wroning'));
        },
        loadSuppliers() {
            axios.get('/api/suppliers/list')
                .then(({data}) => this.suppliers = data.data)
                .catch((err) => Notification.error('Somthing wroning'));
        },
    }
}
</script>