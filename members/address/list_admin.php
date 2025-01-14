<?php
require __DIR__ . '/../parts/init.php';
// require __DIR__ . '/../parts/admin_required.php';
$title = "會員基本資料";
$pageName = "list";
$perPage = 5; # 每一頁有幾筆



$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
  header('Location: ?page=1'); # 跳轉頁面 (後端), 也稱為 redirect (轉向)
  exit; # 離開 (結束) 程式 (以下的程式都不會執行)
  die(); # 同 exit 的功能, 但可以回傳字串或編號
}

$keyword = empty($_GET['keyword']) ? '' : $_GET['keyword'];
$birth_begin = empty($_GET['birth_begin']) ? '' : $_GET['birth_begin'];
$birth_end = empty($_GET['birth_end']) ? '' : $_GET['birth_end'];

$where = ' WHERE 1 '; # SQL 條件的開頭

if ($keyword) {
  $keyword_ = $pdo->quote("%{$keyword}%"); # 字串內容做 SQL 引號的跳脫, 同時前後標單引號
  $where .= " AND ( name LIKE $keyword_ OR mobile LIKE $keyword_ ) ";
}
if ($birth_begin) {
  $t = strtotime($birth_begin); # 把日期字串轉換成 timestamp
  if ($t !== false) {
    $where .= sprintf(" AND birthday >= '%s' ",   date('Y-m-d', $t));
  }
}
if ($birth_end) {
  $t = strtotime($birth_end); # 把日期字串轉換成 timestamp
  if ($t !== false) {
    $where .= sprintf(" AND birthday <= '%s' ",   date('Y-m-d', $t));
  }
}

$t_sql = "SELECT COUNT(1) FROM `members` $where";

# 總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
# 總頁數
$totalPages = ceil($totalRows / $perPage);
$rows = []; # 設定預設值(若無資料然可執行此變數)

if ($totalRows > 0) {
  if ($page > $totalPages) {
    # 用戶要看的頁碼超出範圍, 跳到最後一頁
    header('Location: ?page=' . $totalPages);
    exit;
  }

  # 取第一頁的資料
  $sql = sprintf(
    "SELECT * FROM members
    %s
    ORDER BY id LIMIT %s, %s",
    $where,
    ($page - 1) * $perPage,
    $perPage
  );
  $rows = $pdo->query($sql)->fetchAll(); # 取得該分頁的資料
}

?>
<?php include __DIR__ . '/../parts/html_head.php' ?>
<?php include __DIR__ . '/../parts/html_navbar.php' ?>

<div class="container">
  <div class="row mt-2">
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
  <div class="row mt-2">
    <div class="col">
      
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

          <?php for ($i = $page - 2; $i <= $page + 2; $i++):
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

  <div class="row">
    <div class="col">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th><i class="fa-solid fa-trash"></i></a></th>
            <th>#</th>
            <th>大頭貼</th>
            <th>姓名</th>
            <th>手機</th>
            <th>球類愛好</th>
            <th>電子郵件</th>
            <th>生日</th>
            <th>地址</th>
            <th><i class="fa-solid fa-pen-to-square"></i></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
            <tr>
              <td><a href="javascript:" onclick="deleteOne(event)" data-id="<?= $r['id'] ?>">
                  <i class="fa-solid fa-trash"></i>
                </a></td>
              <td><?= $r['id'] ?></td>
              <td>
                <?php if (! empty($r['avatar'])): ?>
                  <img src="./../uploads/<?= $r['avatar'] ?>" alt="" width="100px">
                <?php endif; ?>
              </td>
              <td><?= htmlentities($r['name']) ?></td>
              <td><?= htmlentities($r['phone']) ?></td>
              <td><?= $r['favorite_sport'] ?></td>
              <td><?= $r['email'] ?></td>
              <td><?= $r['birthday_date'] ?></td>
              <td><?= htmlentities($r['address']) ?></td>
              <td>
                <a href="edit.php?id=<?= $r['id'] ?>">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../parts/html_scripts.php' ?>

<script>
  
  const deleteOne = (e) => {
    e.preventDefault(); // 沒有要連到某處
    const tr = e.target.closest('tr');
    
    const [, td_id, , td_name] = tr.querySelectorAll('td');
    const id = td_id.innerHTML;
    const name = td_name.innerHTML;
    console.log([td_id.innerHTML, td_name.innerHTML]);
    if (confirm(`是否要刪除編號為 ${id} 姓名為 ${name} 的資料?`)) {
      // 使用 JS 做跳轉頁面
      location.href = `del.php?id=${id}`;
    }
  }

</script>
<?php include __DIR__ . '/../parts/html_tail.php' ?>