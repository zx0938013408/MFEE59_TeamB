<?php
require __DIR__ . "/../parts/admin-required.php";
require __DIR__ . "/../parts/init.php";
$title = "新增管理員";
$pageName = "add";

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
            <a class="nav-link <?= $pageName == 'list' ? 'active' : '' ?>" href="a-list.php">管理員資料</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $pageName == 'add' ? 'active' : '' ?>" href="a-add.php">新增管理員</a>
          </li>


        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-6">
        <div class="card">

          <div class="card-body">
            <h5 class="card-title">新增管理員</h5>
            <form onsubmit="sendData(event)">
              <div class="mb-3">
                <label for="name" class="form-label">姓名</label>
                <input type="text" class="form-control" id="name" name="name">
                <div class="form-text"></div>
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">手機</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="09-xx-xxx-xxx" pattern="09\d{8}">
                <div class="form-text"></div>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">電子信箱</label>
                <input type="email" class="form-control" id="email" name="email">
                <div class="form-text"></div>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">密碼</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="至少6-8碼">
                <div class="form-text"></div>
              </div>



              <button type="submit" class="btn btn-primary">新增</button>
            </form>
          </div>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">新增結果</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          資料新增成功
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
        <a class="btn btn-primary" href="a-list.php">回到列表頁</a>
      </div>
    </div>
  </div>
</div>


<?php include __DIR__ . "/../parts/html-scripts.php" ?>
<script>
  const nameField = document.querySelector('#name');
  const emailField = document.querySelector('#email');
  const myModal = new bootstrap.Modal('#exampleModal');
  const phoneField = document.querySelector('#phone');
  const passwordField = document.querySelector('#password');




  function sendData(event) {
    event.preventDefault(); // 防止表單預設行為

    nameField.closest('.mb-3').classList.remove('error');
    emailField.closest('.mb-3').classList.remove('error');
    //phoneField.closest('.mb-3').classList.remove('error');
    passwordField.closest('.mb-3').classList.remove('error');
    // nameField.style.border ="1px solid #ccc";
    // nameField.nextElementSibling.innerHTML="";

    function validateEmail(email) {
      // 使用 regular expression 檢查 email 格式正不正確
      const pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return pattern.test(email);
    }


    let isPass = true; //有沒有通過檢查,預設值true

    if (nameField.value.length < 2) {
      isPass = false;
      nameField.nextElementSibling.innerHTML = "請填寫正確姓名";
      nameField.closest('.mb-3').classList.add('error');

    }

    if (!validateEmail(emailField.value)) {
      isPass = false;
      emailField.nextElementSibling.innerHTML = "請填寫正確的 Email";
      emailField.closest('.mb-3').classList.add('error');

    }

    if (passwordField.value.length < 6) {
      isPass = false;
      passwordField.closest('.mb-3').classList.add('error');
    }

    // if(phoneField){
    //   isPass=false;
    //   phoneField.closest('.mb-3').classList.add('error');
    // }




    if (isPass) {
      const fd = new FormData(event.target);

      // 檢查 FormData 的內容
      for (const [key, value] of fd.entries()) {
        console.log(key, value); // 確保 "email" 鍵存在
      }

      fetch(`a-add-api.php`, {
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

        }).catch(console.warn);
    }


  }
</script>
<?php include __DIR__ . '/../parts/html-tail.php' ?>