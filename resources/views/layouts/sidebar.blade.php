<nav id="sidebar" v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/forgot' ? false : true" 
style="display: none;">
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon">
                <img src="{{asset('backend/img/logo/logo2.png')}}">
            </div>
            <div class="sidebar-brand-text mx-3">RuangAdmin</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item active">
            <router-link to="/home" class="nav-link">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </router-link>
        </li>
        <hr class="sidebar-divider">
        {{-- Employees --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#employees"
                aria-expanded="true" aria-controls="employees">
                <i class="fas fa-fw fa-user-tie"></i>
                <span>Employees</span>
            </a>
            <div id="employees" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <router-link to="/create-employee" class="collapse-item">Add Employee</router-link>
                    <router-link to="/employees" class="collapse-item">All Employees</router-link>
                </div>
            </div>
        </li>
        {{-- Suppliers --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#suppliers"
                aria-expanded="true" aria-controls="suppliers">
                <i class="fas fa-fw fa-user-friends"></i>
                <span>Suppliers</span>
            </a>
            <div id="suppliers" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <router-link to="/create-supplier" class="collapse-item">Add Supplier</router-link>
                    <router-link to="/suppliers" class="collapse-item">All Suppliers</router-link>
                </div>
            </div>
        </li>
        {{-- Categories --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categories"
                aria-expanded="true" aria-controls="categories">
                <i class="fas fa-fw fa-tags"></i>
                <span>Categories</span>
            </a>
            <div id="categories" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <router-link to="/create-category" class="collapse-item">Add Category</router-link>
                    <router-link to="/categories" class="collapse-item">All Categories</router-link>
                </div>
            </div>
        </li>
        {{-- Products --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#products"
                aria-expanded="true" aria-controls="products">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Products</span>
            </a>
            <div id="products" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <router-link to="/create-product" class="collapse-item">Add Product</router-link>
                    <router-link to="/products" class="collapse-item">All Products</router-link>
                </div>
            </div>
        </li>
        {{-- Customer --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#customers"
                aria-expanded="true" aria-controls="customers">
                <i class="fas fa-fw fa-hands-helping"></i>
                <span>Customers</span>
            </a>
            <div id="customers" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <router-link to="/create-customer" class="collapse-item">Add Customer</router-link>
                    <router-link to="/customers" class="collapse-item">All Customers</router-link>
                </div>
            </div>
        </li>
        {{-- Expenses --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#expenses"
                aria-expanded="true" aria-controls="expenses">
                <i class="fas fa-fw fa-hand-holding-usd"></i>
                <span>Expenses</span>
            </a>
            <div id="expenses" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <router-link to="/create-expense" class="collapse-item">Add Expense</router-link>
                    <router-link to="/expenses" class="collapse-item">All Expenses</router-link>
                </div>
            </div>
        </li>
        {{-- Salary --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#salaries"
                aria-expanded="true" aria-controls="salaries">
                <i class="fas fa-fw fa-money-bill-alt"></i>
                <span>Salary</span>
            </a>
            <div id="salaries" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <router-link to="/given-salaries" class="collapse-item">Add Salary</router-link>
                    <router-link to="/salaries" class="collapse-item">All Salary</router-link>
                </div>
            </div>
        </li>
    </ul>
</nav>
@push('scripts')
<script>
    var token = localStorage.getItem('token');
    if (token) {
      $('#sidebar').css('display', '');
    }
  </script>
@endpush