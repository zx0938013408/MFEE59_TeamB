<?php
require __DIR__ . '/../parts/init.php';
$title = "登入";
$pageName = "login";

?>

<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/html-navbar.php' ?>
<style>
  form .form-text {
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
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
              <h3 class="text-center font-weight-light my-4">管理員登入</h3>
            </div>
            <div class="card-body">
              <form id="loginForm" onsubmit="sendData(event)">
              <div class="mb-3">
              <label for="email" class="form-label">電子信箱</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">密碼</label>
              <input type="password" class="form-control" id="password"
                name="password" placeholder="Password">
              <div class="form-text"></div>
            </div>
               
                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                  <a class="small" href="password.html">忘記密碼</a>
                  <button type="submit" class="btn btn-primary">登入</button>

                </div>
              </form>
            </div>
            <!-- <div class="card-footer text-center py-3">
              <div class="small"><a href="register.html">還沒註冊？註冊！</a></div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
 
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">登入結果</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          帳號或密碼錯誤
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../parts/html-footer.php' ?>
<?php include __DIR__ . '/../parts/html-scripts.php' ?>
<script>
  const emailField = document.querySelector('#email');
  const myModal = new bootstrap.Modal('#exampleModal');
  // const passwordField = document.querySelector('#password');

  function validateEmail(email) {
    // 使用 regular expression 檢查 email 格式正不正確
    const pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return pattern.test(email);
  }


  const sendData = e => {
    e.preventDefault(); // 不要讓表單以傳統的方式送出


    emailField.closest('.mb-3').classList.remove('error');

    let isPass = true; // 有沒有通過檢查, 預設值是 true
    // TODO: 資料欄位的檢查

    if (!validateEmail(emailField.value)) {
      isPass = false;
      emailField.nextElementSibling.innerHTML = "請填寫正確的 Email";
      emailField.closest('.mb-3').classList.add('error');
    }

    

    // if (passwordField.value.length < 6 || passwordField.value.length > 8) {
    //   isPass = false;
    //   passwordField.nextElementSibling.innerHTML = "密碼長度必須為 6 到 8 位數";
    //   passwordField.closest('.mb-3').classList.add('error');
    // }

    if(isPass){
      const fd = new FormData(document.getElementById('loginForm'));

      for (const [key, value] of fd.entries()) {
    console.log(key, value); 
}

      fetch(`login-api.php`, {
          method: 'POST',
          body: fd
        }).then(r => r.json())
        .then(obj => {
          console.log(obj);
          if (!obj.success) {
            myModal.show(); // 呈現 modal
          } else {
          
            location.href = "index_.php";
            
          }

        }).catch(console.warn);
    }


  }
</script>
<?php include __DIR__ . '/../parts/html-tail.php' ?>
