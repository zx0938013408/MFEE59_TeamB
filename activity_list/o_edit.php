<?php
# 要是管理者才可以看到這個頁面
require __DIR__ . '/../parts/admin-required.php';

require __DIR__ . '/../parts/init.php';
$title = "訂單修改";
$pageName = "edit";

# 取得指定的 PK
$id = empty($_GET['id']) ? 0 : intval($_GET['id']);


#沒拿到id就不做，直接跳轉
if (empty($id)) {
  header('Location: list.php');
  exit;
}

# 讀取該筆資料
$sql = " SELECT 
        Orders.Order_id, 
        members.name, 
        Orders.PaymentStatus, 
        Orders.OrderStatus, 
        Orders.TotalPrice, 
        Orders.OrderDate,
        order_items.item_id,
        order_items.quantity,
        order_items.price,
        products.product_name,
        products.price 
    FROM Orders
    JOIN members ON Orders.MemberID = members.id
    JOIN order_items ON Orders.Order_id = order_items.order_id
    JOIN products ON order_items.item_id = products.id
    WHERE Orders.Order_id = $id";
$r = $pdo->query($sql)->fetch();
if (empty($r)) {
  # 如果沒有對應的資料, 就跳走
  header('Location: list.php');
  exit;
}
# 讀取訂單項目資料
$sql_items = " SELECT 
        order_items.item_id,
        order_items.quantity,
        order_items.price,
        products.product_name,
        products.price 
    FROM order_items
    JOIN products ON order_items.item_id = products.id
    WHERE order_items.order_id = $id";
$items = $pdo->query($sql_items)->fetchAll(PDO::FETCH_ASSOC); // 查詢訂單項目資料

/*session_start(); // 確保開啟 session
$totalPrice = isset($_SESSION['totalPrice']) ? $_SESSION['totalPrice'] : 0;
?>*/
?>

<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/html-navbar.php' ?>
<style>
  form .mb-3 .form-text {
    display: none;
    /* color: red; */
  }

  form .mb-3.error input.form-control {
    border: 2px solid red;
  }

  form .mb-3.error .form-text {
    display: block;
    color: red;
  }
</style>
<div class="container my-5">
  <div class="row d-flex justify-content-center">
    <div class="col-8">
      <div class="card">

        <div class="card-body">
          <h5 class="card-title text-center">修改訂單</h5>
          <form onsubmit="sendData(event)">
            <input type="hidden" name="Order_id" value="<?= $r['Order_id'] ?>">
            <div class="mb-3">
              <label for="Order_id" class="form-label">訂單編號</label>
              <input type="text" class="form-control" disabled
                value="<?= $r['Order_id'] ?>">
            </div>



            <div class="mb-3">
              <label for="OrderDate " class="form-label">訂單成立日期</label>
              <input type="text" class="form-control" disabled id="OrderDate " name="OrderDate " value="<?= $r['OrderDate'] ?>">
              <div class="form-text"></div>
            </div>

            <div class="mb-3">
              <label for="name" class="form-label">會員名稱</label>
              <input type="text" class="form-control" disabled id="name" name="name" value="<?= $r['name'] ?>">
              <div class="form-text"></div>
            </div>

            <div class="mb-3">
              <label for="PaymentStatus" class="form-label">付款狀態</label>
              <select class="form-select" id="PaymentStatus" name="PaymentStatus">
                <option value="" selected><?= $r['PaymentStatus'] ?></option>
                <option value="已付款">已付款</option>
                <option value="未付款">未付款</option>
              </select>
              <div class="form-text"></div>
            </div>

            <div class="mb-3">
              <label for="OrderStatus" class="form-label">訂單狀態</label>
              <select class="form-select" id="OrderStatus" name="OrderStatus">
                <option value="" selected><?= $r['OrderStatus'] ?></option>
                <option value="處理中">處理中</option>
                <option value="已完成">已完成</option>
                <option value="已取消">已取消</option>
              </select>
              <div class="form-text"></div>
            </div>
           
            <div class="mb-3">
              <label for="TotalPrice" class="form-label">訂單總金額</label>
              <input type="number" class="form-control" id="TotalPrice" name="TotalPrice" value="<?= $r['TotalPrice'] ?>">
              <div class="form-text"></div>
            </div>
            <button type="submit" class="btn btn-primary">修改</button>
          </form>

          <form name="upload_form" hidden>
            <input type="file" name="image" accept="image/jpeg,image/png" />
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">編輯結果</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          資料編輯成功
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
        <a class="btn btn-primary" href="o_list.php">回到列表頁</a>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../parts/html-footer.php' ?>

<?php include __DIR__ . '/../parts/html-scripts.php' ?>
<script>
  const myModal = new bootstrap.Modal('#exampleModal');

  const sendData = e => {
    e.preventDefault(); // 不要讓表單以傳統的方式送出

    let isPass = true; // 有沒有通過檢查, 預設值是 true
    // TODO: 資料欄位的檢查

    const PaymentStatusField = document.getElementById("PaymentStatus");
    if (!PaymentStatusField.value) {
      isPass = false;
      PaymentStatusField.closest(".mb-3").classList.add("error");
      PaymentStatusField.nextElementSibling.innerHTML = "請選擇付款狀態";
    } else {
      PaymentStatusField.closest(".mb-3").classList.remove("error");
      PaymentStatusField.nextElementSibling.innerHTML = "";
    }

    const OrderStatusField = document.getElementById("OrderStatus");
    if (!OrderStatusField.value) {
      isPass = false;
      OrderStatusField.closest(".mb-3").classList.add("error");
      OrderStatusField.nextElementSibling.innerHTML = "請選擇訂單狀態";
    } else {
      OrderStatusField.closest(".mb-3").classList.remove("error");
      OrderStatusField.nextElementSibling.innerHTML = "";
    }


    // 價格驗證
    const TotalPriceField = document.getElementById("TotalPrice");
    if (TotalPriceField.value <= 0 || TotalPriceField.value.trim() === "") {
      isPass = false;
      TotalPriceField.closest(".mb-3").classList.add("error");
      TotalPriceField.nextElementSibling.innerHTML = "價格必須大於 0";
    } else {
      TotalPriceField.closest(".mb-3").classList.remove("error");
      TotalPriceField.nextElementSibling.innerHTML = "";
    }



    if (isPass) {
      const fd = new FormData(document.forms[1]);





      fetch(`o_edit-api.php`, {
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
    }
  }
</script>
<?php include __DIR__ . '/../parts/html-tail.php' ?>