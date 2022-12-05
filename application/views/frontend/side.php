<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>STP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SaiTech</b>POS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url() ?>assets/media/img_user/<?= $sess['picture'] ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $sess['name'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url() ?>assets/media/img_user/<?= $sess['picture'] ?>" class="img-circle" alt="User Image">
                <p>
                  <?= $sess['name'] ?> - <?= $sess['role'] ?> Toko SaiTech
                  <small>Opening since Nov. 2019</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?= site_url('auth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url() ?>assets/media/img_user/<?= $sess['picture'] ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $sess['name'] ?></p>
          <a href="#"><i class="fa fa-circle text-primary"></i> <?= $sess['role'] ?></a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li <?= ($title == 'Dashboard') ? 'class="active"' : 'class=""' ?>>
          <a href="<?= site_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li <?= ($title == 'Suppliers') ? 'class="active"' : 'class=""' ?>>
          <a href="<?= site_url('suppliers') ?>">
            <i class="fa fa-truck"></i> <span>Suppliers</span>
          </a>
        </li>
        <li <?= ($title == 'Customers') ? 'class="active"' : 'class=""' ?>>
          <a href="<?= site_url('customers') ?>">
            <i class="fa fa-users"></i> <span>Customers</span>
          </a>
        </li>
        <li class="treeview <?= ($icon == 'archive') ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-archive"></i> <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?= ($title == 'Product Categories') ? 'class="active"' : 'class=""' ?>><a href="<?= site_url('categories') ?>"><i class="fa fa-circle-o"></i> Categories</a></li>
            <li <?= ($title == 'Product Units') ? 'class="active"' : 'class=""' ?>><a href="<?= site_url('units') ?>"><i class="fa fa-circle-o"></i> Units</a></li>
            <li <?= ($title == 'Product Items') ? 'class="active"' : 'class=""' ?>><a href="<?= site_url('items') ?>"><i class="fa fa-circle-o"></i> Items</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>Transaction</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Sale</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Stock in / Purchases</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Stock Out</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Stock Opname</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Item Return</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Sale</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Stock in/out</a></li>
          </ul>
        </li>
        <?php if($this->session->userdata('role') == 'Admin') { ?>
        <li class="header">SETTING</li>
        <li <?= ($title == 'Manage User Accounts') ? 'class="active"' : 'class=""' ?>>
          <a href="<?= site_url('manage_users') ?>"><i class="fa fa-user"></i> <span>Users</span></a>
        </li>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $title ?>
        <small><?= $text ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-<?= $icon ?>"></i> <?= $title ?></a></li>
      </ol>
    </section>