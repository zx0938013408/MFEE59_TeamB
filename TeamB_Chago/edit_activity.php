<?php
# 要是管理者才可以看到這個頁面
// require __DIR__ . '/../parts/admin-required.php';

require __DIR__ . '/../parts/init.php';
$title = "活動修改";
$pageName = "edit";

# 取得指定的 PK
$id = empty($_GET['id']) ? 0 : intval($_GET['id']);


if (empty($id)) {
    header('Location: list.php');
    exit;
}

# 讀取該筆資料
$sql = "SELECT * FROM `activity_list` WHERE id={$id} ";
$r = $pdo->query($sql)->fetch();
if (empty($r)) {
    # 如果沒有對應的資料, 就跳走
    header('Location: tables.php');
    exit;
}

?>
<?php include __DIR__ . '/../parts/html-header.php' ?>
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
                    <h5 class="card-title">修改通訊錄</h5>
                    <form onsubmit="sendData(event)">
                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">編號</label>
                            <input type="text" class="form-control" disabled
                                value="<?= $r['id'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">姓名 **</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="<?= $r['name'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">電郵 **</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= $r['email'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">手機</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" pattern="09\d{8}"
                                value="<?= $r['mobile'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">生日</label>
                            <input type="date" class="form-control" id="birthday" name="birthday"
                                value="<?= $r['birthday'] ?>">

                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">地址</label>
                            <textarea class="form-control"
                                id="address" name="address"><?= $r['address'] ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">修改</button>
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

            fetch(`edit-api-ac.php`, {
                    method: 'POST',
                    body: fd
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        myModal.show(); // 呈現 modal
                    } else {
                        alert('資料沒有修改')
                    }

                }).catch(console.warn);
        }


    }
</script>
<?php include __DIR__ . '/../parts/html-tail.php' ?>