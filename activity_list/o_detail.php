<?php
# 要是管理者才可以看到這個頁面
require __DIR__ . '/../parts/admin-required.php';
require __DIR__ . '/../parts/init.php';

$title = "訂單明細";
$pageName = "detail";

# 取得指定的 PK
$id = empty($_GET['id']) ? 0 : intval($_GET['id']);

# 沒拿到 id 就不做，直接跳轉
if (empty($id)) {
    header('Location: o_list.php');
    exit;
}

# 讀取該筆資料
$sql = "SELECT 
            orders.Order_id, 
            products.product_code, 
            products.product_name, 
            products.price, 
            products.size, 
            products.color, 
            order_items.quantity
        FROM 
            orders
        JOIN 
            order_items ON orders.Order_id = order_items.order_id
        JOIN 
            products ON products.id = order_items.item_id
        WHERE 
            orders.Order_id = :order_id";

$stmt = $pdo->prepare($sql); // 使用 prepare()
$stmt->execute(['order_id' => $id]); // 傳入參數
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($rows)) {
    echo "查無訂單的商品資料。";
    exit;
};

session_start(); // 開啟 session
$totalPrice = 0; // 初始化總金額

foreach ($rows as $r) {
    $totalPrice += $r['price'] * $r['quantity']; // 計算總金額
}

// 儲存總金額到 session
$_SESSION['totalPrice'] = $totalPrice;

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
<!-- 中間表單 -->

<div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="o_list-admin.php">訂單管理</a></li>
    <li class="breadcrumb-item active" aria-current="page">訂單明細</li>
  </ol>
</nav>
    <div class="row mt-3">
        <div class="col">
            <h3>訂單編號: <?= htmlspecialchars($rows[0]['Order_id']) ?></h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>商品編號</th>
                        <th>商品名稱</th>
                        <th>尺寸</th>
                        <th>顏色</th>
                        <th>數量</th>
                        <th>單價</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r): ?>
                        <tr>
                            <td><?= htmlspecialchars($r['product_code']) ?></td>
                            <td><?= htmlspecialchars($r['product_name']) ?></td>
                            <td><?= htmlspecialchars($r['size']) ?></td>
                            <td><?= htmlspecialchars($r['color']) ?></td>
                            <td><?= htmlspecialchars($r['quantity']) ?></td>
                            <td><?= htmlspecialchars($r['price']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3 class="text-end text-danger">總金額: <?= number_format($totalPrice) ?> 元</h3>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../parts/html-footer.php' ?>
<?php include __DIR__ . '/../parts/html-scripts.php' ?>
<script>
    fetch(`o_detail-api.php`, {
          method: 'POST',
          body: fd
        }).then(r => r.json())
        .then(obj => {


          console.log(obj);
          if (!obj.success && obj.error) {
            alert(obj.error)
          }
          if (obj.success) {
            myModal.show(); // 呈現 modal
          }

        }).catch(err => {
          // 詳細顯示錯誤資訊
          console.error('Fetch 發生錯誤：', err);
          alert(`發生錯誤：${err.message}`);
        });
</script>
<?php include __DIR__ . '/../parts/html-tail.php' ?>