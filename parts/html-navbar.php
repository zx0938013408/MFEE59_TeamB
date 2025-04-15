<?php
if (! isset($pageName)) {
  $pageName = '';
}
?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <!-- Navbar Brand-->
  <a class="navbar-brand ps-3" href="index_.php">MFEE59 TeamB</a>
  <!-- Sidebar Toggle-->
  <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
  <!-- Navbar Search-->
  <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    <div class="input-group">
      <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
      <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
    </div>
  </form>
  <!-- Navbar-->
  <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="#!">會員資料</a></li>
        <li><a class="dropdown-item" href="#!">註冊會員</a></li>
        <li>
          <hr class="dropdown-divider" />
        </li>
        <?php if (isset($_SESSION['admin'])): ?>
          <li class="dropdown-item">
            <a class=""><?= $_SESSION['admin']['nickname'] ?></a>
          </li>
          <li class="dropdown-item">
            <a class=""
              href="logout.php">登出</a>
          </li>

        <?php else: ?>
          <li class="dropdown-item">
            <a class=" <?= $pageName == 'login' ? 'active' : '' ?>"
              href="login.php">登入</a>
          </li>
        <?php endif; ?>
      </ul>
    </li>
  </ul>
</nav>
<!-- nav-bar選單 -->
<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <div class="sb-sidenav-menu-heading">Core</div>
          <a class="nav-link" href="index_.php">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            主頁
          </a>
          <div class="sb-sidenav-menu-heading">商品</div>
          <a class="nav-link" href="p_list-admin.php">
            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            商品管理
          </a>
          <a class="nav-link" href="o_list-admin.php">
            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            訂單管理
          </a>
          <div class="sb-sidenav-menu-heading">活動</div>
          <a class="nav-link" href="list-admin.php">
            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            活動列表管理
          </a>
          <a class="nav-link" href="r_tables.php">
            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            人員管理
          </a>
          <div class="sb-sidenav-menu-heading">會員</div>
          <a class="nav-link" href="wlist-admin.php">
            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            會員管理
          </a>
          <a class="nav-link" href="a-list-admin.php">
            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            後台管理員
          </a>
        </div>
      </div>
    </nav>
  </div>
  <div id="layoutSidenav_content">