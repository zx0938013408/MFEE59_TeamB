<?php
require __DIR__ . '/../parts/init.php';
$title = "會員基本資料";
$pageName = "add";
?>
<?php include __DIR__ . '/../parts/html_head.php' ?>
<?php include __DIR__ . '/../parts/html_navbar.php' ?>



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
 

  <!-- <div class="mb-3">
    <label for="gender" class="form-label">性別</label><br>
    <select id="gender" name="gender" required>
    <option value="" disabled selected>請選擇性別</option>
    <option value="男">男</option>
    <option value="女">女</option>
    <option value="其他">其他</option>
  </select>
  </div> -->
  <div class="mb-3">
    <label for="favorite_sport" class="form-label">球類愛好</label><br>
    <select id="favorite_sport" name="favorite_sport" required>
    <option value="" disabled selected>請選擇球類</option>
    <option value="籃球">籃球</option>
    <option value="羽球">羽球</option>
    <option value="排球">排球</option>
  </select>
</div>

  
  <!-- <div class="mb-3">
    <label for="phone" class="form-label">手機</label>
    <input type="text" class="form-control" id="phone" name="phone" required pattern="09\d{8}">
  </div>
  <div class="mb-3">
    <label for="birthday_date" class="form-label">生日</label>
    <input type="date" class="form-control" id="birthday_date" name="birthday_date">
  </div>
  <div class="mb-3">
    <label for="address" class="form-label">地址</label>
    <input type="text" class="form-control" id="address" name="address">
  </div>
   -->
  <!-- <div class="mb-3">
    <label for="photo" class="form-label">大頭貼</label>
    <div class="input-group mb-3">
    <input type="file" class="form-control" id="photo" name="photo">
    <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('photo').click();">選擇檔案</button>
    </div>
  </div> -->
  
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
      < class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
        <a class="btn btn-primary" href="index_.php">回到首頁頁面
        </a>
      </>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../parts/html_scripts.php' ?>

<script>
 const myModal = new bootstrap.Modal('#exampleModal');
const sendData = e =>{
  e.preventDefault();//阻止表單預設提交行為


  //TODO: 資料欄位檢查
  const fd = new FormData(document.forms[0]);

  fetch(`add_api.php`,{
    method: 'POST',
    body: fd
  }).then(r => r.json())
  .then(obj =>{
    console.log(obj);
    if(obj.success){
      myModal.show();//呈現modal
    }
  }).catch(console.warn);
}



</script>
<?php include __DIR__ . '/../parts/html_tail.php' ?>