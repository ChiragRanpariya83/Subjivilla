<?php
// Get current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <a class="nav-link <?= ($current_page == 'home.php') ? 'active' : '' ?>" href="home.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Products</div>
                <a class="nav-link <?= ($current_page == 'categories.php') ? 'active' : '' ?>" href="categories.php">
                    <div class="sb-nav-link-icon"><i class="fa fa-folder"></i></div>
                    Categories
                </a>
                <a class="nav-link <?= ($current_page == 'product_add.php') ? 'active' : '' ?>" href="product_add.php">
                    <div class="sb-nav-link-icon"><i class="fa fa-plus-circle"></i></div>
                    Add Products
                </a>
                <a class="nav-link <?= ($current_page == 'product_delete.php') ? 'active' : '' ?>" href="product_delete.php">
                    <div class="sb-nav-link-icon"><i class="fa fa-trash"></i></div>
                    Delete Products
                </a>
                <a class="nav-link <?= ($current_page == 'product_edit.php') ? 'active' : '' ?>" href="product_edit.php">
                    <div class="sb-nav-link-icon"><i class="far fa-edit"></i></div>
                    Edit Products
                </a>
                <a class="nav-link <?= ($current_page == 'contact.php') ? 'active' : '' ?>" href="contact.php">
                    <div class="sb-nav-link-icon"><i class="far fa-address-card"></i></div>
                    Contact
                </a>
                <a class="nav-link <?= ($current_page == 'feedback.php') ? 'active' : '' ?>" href="feedback.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Feedback
                </a>
                <a class="nav-link <?= ($current_page == 'customer.php') ? 'active' : '' ?>" href="customer.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                    Manage Customers/Orders
                </a>

                <!-- Setting Dropdown -->
                <div class="sb-sidenav-menu-heading">Settings</div>
                <a class="nav-link collapsed <?= in_array($current_page, ['about_manage.php','site_setting.php','blog.php','manage_offers.php']) ? '' : '' ?>"
                   href="#" data-bs-toggle="collapse" data-bs-target="#collapseSetting"
                   aria-expanded="<?= in_array($current_page, ['about_manage.php','site_setting.php','blog.php','manage_offers.php']) ? 'true' : 'false' ?>"
                   aria-controls="collapseSetting">
                    <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                    Setting
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= in_array($current_page, ['about_manage.php','site_setting.php','blog.php','manage_offers.php']) ? 'show' : '' ?>" id="collapseSetting" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= ($current_page == 'about_manage.php') ? 'active' : '' ?>" href="about_manage.php">About Us</a>
                        <a class="nav-link <?= ($current_page == 'site_setting.php') ? 'active' : '' ?>" href="site_setting.php">Site Settings</a>
                        <a class="nav-link <?= ($current_page == 'blog.php') ? 'active' : '' ?>" href="blog.php">blogs</a>
                        <a class="nav-link <?= ($current_page == 'manage_offers.php') ? 'active' : '' ?>" href="manage_offers.php">homepage</a>
                    </nav>
                </div>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Admin
        </div>
    </nav>
</div>
