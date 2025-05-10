<?php
require __DIR__ . '/../parts/init.php';
$title = "會員基本資料";
$pageName = "add";
?>
<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/html-navbar.php' ?>



<div class="container">
 <div class="row">
    <div class="col-6">
    <div class="card" style="width: 18rem;">
  
  <div class="card-body">
    <h5 class="card-title">註冊會員</h5>
    <form onsubmit="sendData(event)">
  <div class="mb-3">
    <label for="name" class="form-label">姓名</label>
    <input type="text" class="form-control" id="name" name="name" required>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">密碼</label>
    <input type="text" class="form-control" id="password" name="password" required>
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">email</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
 
  
  <div class="mb-3">
    <label for="favorite_sport" class="form-label">球類愛好</label><br>
    <select id="favorite_sport" name="favorite_sport" multiple class="form-select" size="3" required>
    <option selected disabled>請選擇球類</option>
    <option value="籃球">籃球</option>
    <option value="羽球">羽球</option>
    <option value="排球">排球</option>
  </select>
</div>

  
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </div>
</div>
    </div>
 </>
</div>
<!-- modal -->
<div class="modal" tabindex="-1" id="exampleModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">新增結果</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
       <div  class="alert alert-success" role="alert"><p>新增成功</p></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
        <a class="btn btn-primary" href="index_.php">回到首頁頁面
        </a>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../parts/html-scripts.php' ?>

<script>
 const myModal = new bootstrap.Modal('#exampleModal');
const sendData = (e) => {
    e.preventDefault(); // 阻止表單預設行為

    const form = document.forms[0];
    const formData = new FormData(form);

    // 將多選選項轉換為逗號分隔的字串
    const sports = Array.from(formData.getAll('favorite_sport')).join(',');
    formData.set('favorite_sport', sports);

    fetch('add_api.php', {
        method: 'POST',
        body: formData,
    })
        .then((r) => r.json())
        .then((obj) => {
            console.log(obj);
            if (obj.success) {
                myModal.show(); // 顯示成功訊息
            } else {
                alert(obj.error); // 顯示錯誤訊息
            }
        })
        .catch(console.error);
};



</script>
<?php include __DIR__ . '/../parts/html-tail.php' ?>