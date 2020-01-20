<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/home">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3"><?= AppName() ?> <sup>V1</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="/admin/home">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-running"></i>
    <span>Runners</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Runners:</h6>
      <a class="collapse-item" href="/admin/pending-runners">Pending Applicants</a>
      <a class="collapse-item" href="/admin/invited-applicants">Invited Applicants</a>
      <a class="collapse-item" href="/admin/approved">Approved Runners</a>
      <a class="collapse-item" href="/admin/available">Available Runners</a>
      <a class="collapse-item" href="/admin/active">Active Runners</a>
    </div>
  </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-fw fa-store"></i>
    <span>Markets</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Markets:</h6>
      <a class="collapse-item" href="#" data-toggle="modal" data-target="#createMarket">Create Market</a>
      <a class="collapse-item" href="#" data-toggle="modal" data-target="#createVendor">Create Vendor</a>
      <a class="collapse-item" href="#" data-toggle="modal" data-target="#addItem">Add Item</a>
      <!-- <a class="collapse-item" href="/items">Items</a>
      <a class="collapse-item" href="/users">Users</a> -->
    </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#users" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-fw fa-users"></i>
    <span>Users</span>
  </a>
  <div id="users" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Users:</h6>
      <a class="collapse-item" href="/admin/users">Users</a>
      <a class="collapse-item" href="/admin/orders">Orders</a>
      <!-- <a class="collapse-item" href="/items">Items</a>
      <a class="collapse-item" href="/users">Users</a> -->
    </div>
  </div>
</li>

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>