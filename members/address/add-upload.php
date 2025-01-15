<?php
# 要是管理者才可以看到這個頁面
// require __DIR__ . '/../parts/admin_required.php';

require __DIR__ . '/../parts/init.php';
$title = "新增通訊錄";
$pageName = "add-upload";


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
    <div class="row">
        <div class="col-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">新增基本資料</h5>
                    <form onsubmit="sendData(event)">
                        <div class="mb-3">
                            <img src="" alt="" class="avatar" width="200px">
                            <input type="hidden" name="avatar" value="">
                            <!-- 表單裡面 button 如果沒有設定 type 會視為 submit button -->
                            <button type="button"
                                class="btn btn-warning" onclick="document.upload_form.avatar.click()">上傳大頭貼</button>
                        </div>
                        <!-- 球類喜好 -->
                        <!-- <div class="mb-3">
              <label for="name" class="form-label">姓名 **</label>
              <input type="text" class="form-control" id="name" name="name">
              <div class="form-text"></div>
            </div> -->
                        <div class="mb-3">
                            <label for="gender" class="form-label">性別</label><br>
                            <select id="gender" name="gender" required>
                                <option value="" disabled selected>請選擇性別</option>
                                <option value="男">男</option>
                                <option value="女">女</option>
                                <option value="其他">其他</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="birthday_date" class="form-label">生日</label>
                            <input type="date" class="form-control" id="birthday_date" name="birthday_date">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">手機</label>
                            <input type="text" class="form-control" id="phone" name="phone" pattern="09\d{8}">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">地址</label>
                            <textarea class="form-control"
                                id="address" name="address"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">新增</button>
                    </form>

                    <form name="upload_form" hidden>
                        <input type="file" name="avatar" accept="image/jpeg,image/png" />
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
                <a class="btn btn-primary" href="list.php">回到列表頁</a>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../parts/html-scripts.php' ?>
<script>
    const nameField = document.querySelector('#name');
    const emailField = document.querySelector('#email');
    const myModal = new bootstrap.Modal('#exampleModal');

    function validateEmail(email) {
        // 使用 regular expression 檢查 email 格式正不正確
        const pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return pattern.test(email);
    }

    const sendData = e => {
        e.preventDefault(); // 不要讓表單以傳統的方式送出

        nameField.closest('.mb-3').classList.remove('error');
        emailField.closest('.mb-3').classList.remove('error');

        let isPass = true; // 有沒有通過檢查, 預設值是 true
        // TODO: 資料欄位的檢查

        if (nameField.value.length < 2) {
            isPass = false;
            nameField.nextElementSibling.innerHTML = "請填寫正確的姓名";
            nameField.closest('.mb-3').classList.add('error');
        }

        if (!validateEmail(emailField.value)) {
            isPass = false;
            emailField.nextElementSibling.innerHTML = "請填寫正確的 Email";
            emailField.closest('.mb-3').classList.add('error');
        }

        if (isPass) {
            const fd = new FormData(document.forms[0]);

            fetch(`add-upload-api.php`, {
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


    // ---------------- 做上傳處理 ---------------------------
    const avatar = document.upload_form.avatar; // 取得上傳的欄位

    avatar.onchange = (e) => {
        const fd = new FormData(document.upload_form);

        fetch("./../practices/upload-avatar.php", {
                method: "POST",
                body: fd,
            })
            .then((r) => r.json())
            .then((obj) => {
                console.log(obj);
                const myImg = document.querySelector('img.avatar');
                myImg.src = `./../uploads/${obj.file}`;
                document.forms[0].avatar.value = obj.file;
            })
            .catch(console.warn);
    };
</script>
<?php include __DIR__ . '/../parts/html-tail.php' ?>