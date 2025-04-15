<?php
require __DIR__ . '/../parts/init.php';
$title = "商品列表";
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
  $where .= " AND ( products.id LIKE $keyword_ OR product_code LIKE $keyword_ OR product_name LIKE $keyword_ OR product_description LIKE $keyword_ OR price LIKE $keyword_ OR size LIKE $keyword_  OR color LIKE $keyword_ OR inventory LIKE $keyword_ OR created_at LIKE $keyword_) ";
}


$t_sql = "SELECT COUNT(1) FROM `products` $where";

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
    "SELECT products.id, image, product_code, product_name, categories_name, product_description, price, size, color, inventory, created_at 
    FROM products
    JOIN categories 
    ON products.category_id = categories.id
    %s
    ORDER BY id LIMIT %s, %s",
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

  nav.navbar a.nav-link:hover {
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
                <a class="btn btn-outline-primary nav-link <?= $pageName == 'list' ? 'active' : '' ?>" role="button"
                  href="p_list.php">商品列表</a>
              </li>
              <li class="nav-item">
                <a class="btn btn-outline-primary nav-link <?= $pageName == 'add-product' ? 'active' : '' ?>" role="button"
                  href="p_add-upload.php">新增商品</a>
              </li>

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
  <div class="row mt-3">
    <div class="col">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>序號</th>
            <th>商品圖</th>
            <th>商品編號</th>
            <th>商品名稱</th>
            <th>商品分類</th>
            <th>商品描述</th>
            <th>價格</th>
            <th>尺寸</th>
            <th>顏色</th>
            <th>庫存</th>
            <th>建立日期</th>
            <th><i class="fa-solid fa-pen-to-square"></i></th>
            <th><i class="fa-solid fa-trash"></i></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
            <tr>
              <td><?= $r['id'] ?></td>
              <td>
                <!-- <?= $r['image'] ?> -->
                <img src="<?= $r['image'] ?>" alt="Base64 Img" width="100px">
                <!-- <?php if (! empty($r['image'])): ?> 
                  <img src="/../p_uploads/<?= $r['image'] ?>" alt="" width="100px">
                <?php endif; ?> -->
              </td>
              <td><?= $r['product_code'] ?></td>
              <td><?= htmlentities($r['product_name']) ?></td>
              <td><?= $r['categories_name'] ?></td>
              <td><?= $r['product_description'] ?></td>
              <td><?= $r['price'] ?></td>
              <td><?= $r['size'] ?></td>
              <td><?= $r['color'] ?></td>
              <td><?= $r['inventory'] ?></td>
              <td><?= $r['created_at'] ?></td>

              <td>
                <a href="p_edit.php?id=<?= $r['id'] ?>">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
              </td>
              <td>
                <a href="javascript:" onclick="deleteOne(event)">
                  <i class="fa-solid fa-trash"></i>
                </a>
              </td>

              <!-- <td> 
                <?php if (! empty($r['avatar'])): ?>
                  <img src="./../p_uploads/<?= $r['avatar'] ?>" alt="" width="100px">
                <?php endif; ?>
              </td> -->
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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
</div>

<?php include __DIR__ . '/../parts/html-footer.php' ?>

<?php include __DIR__ . '/../parts/html-scripts.php' ?>
<script>
  const deleteOne = e => {
    e.preventDefault(); // 沒有要連到某處
    const tr = e.target.closest('tr');
    const [td_ab_id, , , td_name] = tr.querySelectorAll('td');
    const ab_id = td_ab_id.innerHTML;
    const name = td_name.innerHTML;
    console.log([td_ab_id.innerHTML, td_name.innerHTML]);
    if (confirm(`是否要刪除序號為 ${ab_id} 商品名稱為 ${name} 的資料?`)) {
      // 使用 JS 做跳轉頁面
      location.href = `p_del.php?id=${ab_id}`;
    }
  }
</script>
<?php include __DIR__ . '/../parts/html-tail.php' ?>