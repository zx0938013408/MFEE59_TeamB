<?php
require __DIR__.'/../parts/init.php'?>

<?php include __DIR__. '/../parts/html-head.php' ?>
<?php include __DIR__. '/../parts/html-navbar.php' ?>
<main>
<div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-brand" href="index_.php">後台</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link <?= $pageName=='list' ?'active' : '' ?>" href="list.php">管理員資料</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link <?= $pageName=='add' ?'active' : '' ?>" href="add.php">新增管理員</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <div class="container">
    <h1>首頁
    </h1>
    </div>
    </div>
    
    
</main>
<?php include __DIR__. '/../parts/html-footer.php' ?>
<?php include __DIR__. '/../parts/html-scripts.php' ?>
<?php include __DIR__. '/../parts/html-tail.php' ?>