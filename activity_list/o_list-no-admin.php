<?php
require __DIR__ . '/../parts/init.php';
$title = "訂單列表";
$pageName = "list";

$perPage = 10; # 每一頁有幾筆

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
  header('Location: ?page=1'); # 跳轉頁面 (後端), 也稱為 redirect (轉向)
  exit; # 離開 (結束) 程式 (以下的程式都不會執行)
  # die(); # 同 exit 的功能, 但可以回傳字串或編號
}

$keyword = empty($_GET['keyword']) ? '' : $_GET['keyword'];


$where = ' WHERE 1 '; # SQL 條件的開頭

if ($keyword) {
  $keyword_ = $pdo->quote("%{$keyword}%"); # 字串內容做 SQL 引號的跳脫, 同時前後標單引號
  $where .= " AND (Order_id LIKE $keyword_  OR members.name LIKE $keyword_  OR PaymentStatus LIKE $keyword_ OR OrderStatus LIKE $keyword_ OR TotalPrice LIKE $keyword_ OR OrderDate LIKE $keyword_) ";
}

$t_sql = "SELECT COUNT(1) FROM orders 
          JOIN members ON orders.MemberID = members.id
          $where";

# 總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
# 總頁數
$totalPages = ceil($totalRows / $perPage);
$rows = []; # 設定預設值
if ($totalRows > 0) {
  if ($page > $totalPages) {
    # 用戶要看的頁碼超出範圍, 跳到最後一頁
    header('Location: ?page=' . $totalPages);
    exit;
  }

# 取第一頁的資料
$sql = sprintf(
  "SELECT Order_id, members.name, PaymentStatus, OrderStatus, TotalPrice, OrderDate
  from Orders
  join members
  on MemberID=members.id
  %s
  ORDER BY Order_id  LIMIT %s, %s",
  $where,
  ($page - 1) * $perPage,
  $perPage
);
$rows = $pdo->query($sql)->fetchAll(); # 取得該分頁的資料
}


?>
<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/html-navbar.php' ?>

<style>
  nav.navbar a.nav-link.active {
    color: white;
    background-color: #0d6efd;
    border-radius: 6px;
  }

  nav.nav-item a:hover {
    color: white;
    background-color: #0d6efd;
    border-radius: 6px;
  }
</style>

<div class="container">
<div class="row mt-3 d-flex align-items-center">
    <div class="col-6">
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="">
          <!-- RWD漢堡按鈕 -->
          <!-- <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> -->
          <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->

          <div>
            <ul class="navbar-nav">
              <li class="nav-item me-3">
                <a class="btn nav-link <?= $pageName == 'list' ? 'active' : '' ?>" role="button"
                  href="o_list.php">訂單列表</a>
              </li>
              <!-- <li class="nav-item"> 
                <a class="btn btn-outline-primary nav-link <?= $pageName == 'add-product' ? 'active' : '' ?>" role="button"
                  href="add-upload.php">新增訂單</a>
              </li>
              -->
            </ul>
          </div>

        </div>
      </nav>
    </div>

    <!-- 搜尋bar -->
    <div class="col-6">
      <form class="d-flex" role="search">
        <input class="form-control me-2"
          name="keyword"
          value="<?= empty($_GET['keyword']) ? '' : htmlentities($_GET['keyword']) ?>"
          type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>

  <!-- 中間表單 -->
  <div class="row mt-4">
    <div class="col">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>訂單編號</th>
            <th>會員名稱</th>
            <th>付款狀態</th>
            <th>訂單狀態</th>
            <th>訂單總金額</th>
            <th>訂單成立日期</th>
            <th><i class="fa-solid fa-list text-primary"></i></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
            <tr>
            <td><?= $r['Order_id'] ?></td>
              <td><?= $r['name'] ?></td>
              <td><?= $r['PaymentStatus'] ?></td>
              <td><?= $r['OrderStatus'] ?></td>
              <td><?= $r['TotalPrice'] ?></td>
              <td><?= $r['OrderDate'] ?></td>
              <td>
                <a href="o_detail.php?id=<?= $r['Order_id'] ?>">
                  <i class="fa-solid fa-list"></i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

  <!-- 頁數按鈕 -->
  <div class="d-flex justify-content-center">
    <?php
    $qs = array_filter($_GET); # 去除值是空字串的項目
    ?>
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
          <a class="page-link" href="?<?php $qs['page'] = 1;
                                      echo http_build_query($qs) ?>">
            <i class="fa-solid fa-angles-left"></i>
          </a>
        </li>
        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
          <a class="page-link" href="?<?php $qs['page'] = $page - 1;
                                      echo http_build_query($qs) ?>">
            <i class="fa-solid fa-angle-left"></i>
          </a>
        </li>

        <?php for ($i = $page - 5; $i <= $page + 5; $i++):
          if ($i >= 1 and $i <= $totalPages):
            # $qs = array_filter($_GET); # 去除值是空字串的項目
            $qs['page'] = $i;
        ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
              <a class="page-link" href="?<?= http_build_query($qs) ?>"><?= $i ?></a>
            </li>
        <?php endif;
        endfor; ?>

        <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
          <a class="page-link" href="?<?php $qs['page'] = $page + 1;
                                      echo http_build_query($qs) ?>">
            <i class="fa-solid fa-angle-right"></i>
          </a>
        </li>
        <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
          <a class="page-link" href="?<?php $qs['page'] = $totalPages;
                                      echo http_build_query($qs) ?>">
            <i class="fa-solid fa-angles-right"></i>
          </a>
        </li>

      </ul>
    </nav>
  </div>
<?php include __DIR__. '/../parts/html-footer.php' ?>

<?php include __DIR__ . '/../parts/html-scripts.php' ?>
<?php include __DIR__ . '/../parts/html-tail.php' ?>