<?php
# 要是管理者才可以看到這個頁面
require __DIR__ . '/../parts/admin-required.php';

require __DIR__ . '/../parts/init.php';
$title = "新增商品";
$pageName = "add-product";

?>
<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/html-navbar.php' ?>
<style>
  form .mb-3 .form-text {
    display: none;
  }

  form .mb-3.error input.form-control,
  form .mb-3.error textarea.form-control,
  form .mb-3.error select.form-select {
    border: 2px solid red;
  }

  form .mb-3.error .form-text {
    display: block;
    color: red;
  }

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
<div class="container my-5">
  <!-- <div class="col-6">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="">
        <div>
          <ul class="navbar-nav">
            <li class="nav-item me-3">
              <a class="btn btn-outline-primary nav-link <?= $pageName == 'list' ? 'active' : '' ?>" role="button"
                href="list.php">商品列表</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-outline-primary nav-link <?= $pageName == 'add-product' ? 'active' : '' ?>" role="button"
                href="add-upload.php">新增商品</a>
            </li>

          </ul>
        </div>

      </div>
    </nav>
  </div> -->
  <div class="row d-flex justify-content-center">
    <div class="col-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">新增商品</h5>
          <form onsubmit="sendData(event)">
            <div class="mb-3">
              <label for="image" class="form-label">商品圖片 *</label>
              <img src="" alt="" class="image" width="200px">
              <input type="hidden" name="image" id="image" value="">
              <br>
              <button type="button" class="btn btn-warning" onclick="document.upload_form.image.click()">上傳商品圖</button>
              <!-- <input type="file" class="form-control" id="product_image" name="product_image" accept="image/jpeg,image/png">
              <div class="form-text">請選擇商品圖片</div> -->
            </div>
            <!-- 顯示預覽圖片 -->
            <!-- <div class="mb-3">
              <img src="" id="image_preview" alt="商品圖片預覽" width="200px" style="display: none;">
            </div> -->

            <div class="mb-3">
              <label for="product_code" class="form-label">商品編號 *</label>
              <input type="text" class="form-control" id="product_code" name="product_code">
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="product_name" class="form-label">商品名稱 *</label>
              <input type="text" class="form-control" id="product_name" name="product_name">
              <div class="form-text"></div>
            </div>

            <div class="mb-3">
              <label for="category_id" class="form-label">商品分類 *</label>
              <select class="form-select" id="category_id" name="category_id" onchange="updateSizeOptions()">
                <option value="" selected>請選擇商品分類</option>
                <option value="1">上衣</option>
                <option value="2">褲子</option>
                <option value="3">鞋類</option>
                <option value="4">運動裝備</option>
              </select>
              <div class="form-text"></div>
            </div>

            <div class="mb-3">
              <label for="size" class="form-label">尺寸 *</label>
              <select class="form-select" id="size" name="size">
                <option value="">請先選擇尺寸</option>
                <!-- <option value="1">XS</option>
                <option value="2">S</option>
                <option value="3">M</option>
                <option value="4">L</option>
                <option value="5">XL</option> -->
              </select>
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="price" class="form-label">價格 *</label>
              <input type="number" class="form-control" id="price" name="price">
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="color" class="form-label">顏色 *</label>
              <input type="text" class="form-control" id="color" name="color">
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="inventory" class="form-label">庫存 *</label>
              <input type="number" class="form-control" id="inventory" name="inventory">
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="product_description" class="form-label">商品描述 *</label>
              <textarea class="form-control" id="product_description" name="product_description"></textarea>
              <div class="form-text"></div>
            </div>

            <button type="submit" class="btn btn-primary">新增</button>
            <a class="btn btn-secondary" href="p_list.php" role="button">取消</a>
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
        <a class="btn btn-primary" href="p_list.php">回到列表頁</a>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../parts/html-footer.php' ?>

<?php include __DIR__ . '/../parts/html-scripts.php' ?>
<script>
  // 檢視圖片上傳欄位的變化
  document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0]; // 獲取用戶選擇的檔案
    if (file) {
      const reader = new FileReader();
      reader.onload = function(event) {
        // 當檔案讀取完後，顯示圖片
        const preview = document.getElementById('image_preview');
        preview.src = event.target.result; // 設定圖片的來源
        preview.style.display = 'block'; // 顯示圖片
      };
      reader.readAsDataURL(file); // 以 Data URL 的方式讀取圖片檔案
    }
  });

  //綁定分類編號和尺寸 讓尺寸可以按照選擇的商品編號不同出現不同的選項
  const updateSizeOptions = () => {
    const category = document.getElementById('category_id').value;
    const sizeSelect = document.getElementById('size');
    sizeSelect.innerHTML = '';

    let sizeOptions = [];
    if (category == 1 || category == 2) {
      sizeOptions = ['S', 'M', 'L', 'XL', '2XL'];
    } else if (category == 3) {
      sizeOptions = ['36', '37', '38', '39', '40', '41', '42', '43', '44'];
    } else if (category == 4) {
      sizeOptions = ['-'];
    }

    sizeOptions.forEach(size => {
      const option = document.createElement('option');
      option.value = size;
      option.textContent = size;
      sizeSelect.appendChild(option);
    });

    if (!sizeOptions.length) {
      const defaultOption = document.createElement('option');
      defaultOption.value = '';
      defaultOption.textContent = '請先選擇商品分類';
      sizeSelect.appendChild(defaultOption);
    }
  };

  //圖片編號送到資料庫
  document.upload_form.image.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(event) {
        document.querySelector('.image').src = event.target.result;
        document.getElementById('image').value = event.target.result;
      };
      reader.readAsDataURL(file);
    }
  });

  // 送出表單時 欄位格式驗證

  const product_codeField = document.querySelector('#product_code');
  const myModal = new bootstrap.Modal('#exampleModal');

  //驗證 商品編號 格式
  function validateCode(product_code) {
    // 使用 regular expression 檢查 product_code 格式正不正確
    const pattern = /^[A-D][0-9]{4}$/;
    return pattern.test(product_code);
  }

  const sendData = e => {
    e.preventDefault(); // 不要讓表單以傳統的方式送出

    product_codeField.closest('.mb-3').classList.remove('error');
    // product_nameField.closest('.mb-3').classList.remove('error');



    let isPass = true; // 有沒有通過檢查, 預設值是 true
    // TODO: 資料欄位的檢查

    // 商品編號驗證
    // const codeField = document.getElementById("product_code");
    // if (product_codeField.value.trim() === "") {
    //   isPass = false;
    //   product_codeField.closest(".mb-3").classList.add("error");
    //   product_codeField.nextElementSibling.innerHTML = "請填寫商品編號";
    // } else {
    //   product_codeField.closest(".mb-3").classList.remove("error");
    //   product_codeField.nextElementSibling.innerHTML = "";
    // }

    // /檢查 商品編號 是否符合正規表達式
    if (!validateCode(product_code.value)) {
      isPass = false;
      product_codeField.nextElementSibling.innerHTML = "請填寫正確的商品編號 例：A0000";
      product_codeField.closest('.mb-3').classList.add('error');
    }

    // 檢查 商品名稱 是否大於二個字元
    // const product_nameField = document.getElementById('product_name');
    // if (product_nameField.value.length < 2) {
    //   isPass = false;
    //   product_nameField.nextElementSibling.innerHTML = "請填寫正確的商品名稱";
    //   product_nameField.closest('.mb-3').classList.add('error');
    // }

    //商品名稱驗證
    const nameField = document.getElementById("product_name");
    if (nameField.value.length < 2) {
      isPass = false;
      nameField.nextElementSibling.innerHTML = "請填寫正確的商品名稱";
      nameField.closest('.mb-3').classList.add('error');
    } else {
      nameField.closest(".mb-3").classList.remove("error");
      nameField.nextElementSibling.innerHTML = "";
    }

    // 商品分類驗證
    const categoryField = document.getElementById("category_id");
    if (categoryField.value === "") {
      isPass = false;
      categoryField.closest(".mb-3").classList.add("error");
      categoryField.nextElementSibling.innerHTML = "請選擇商品分類";
    } else {
      categoryField.closest(".mb-3").classList.remove("error");
      categoryField.nextElementSibling.innerHTML = "";
    }

    // 價格驗證
    const priceField = document.getElementById("price");
    if (priceField.value <= 0) {
      isPass = false;
      priceField.closest(".mb-3").classList.add("error");
      priceField.nextElementSibling.innerHTML = "價格必須大於 0";
    } else {
      priceField.closest(".mb-3").classList.remove("error");
      priceField.nextElementSibling.innerHTML = "";
    }

    // 顏色驗證
    const colorField = document.getElementById("color");
    if (colorField.value === "") {
      isPass = false;
      colorField.closest(".mb-3").classList.add("error");
      colorField.nextElementSibling.innerHTML = "請填寫顏色";
    } else {
      colorField.closest(".mb-3").classList.remove("error");
      colorField.nextElementSibling.innerHTML = "";
    }

    // 庫存驗證
    const inventoryField = document.getElementById("inventory");
    if (inventoryField.value < 0 || inventoryField.value.trim() === "") {
      isPass = false;
      inventoryField.closest(".mb-3").classList.add("error");
      inventoryField.nextElementSibling.innerHTML = "庫存不可為空或負數";
    } else {
      inventoryField.closest(".mb-3").classList.remove("error");
      inventoryField.nextElementSibling.innerHTML = "";
    }

    // 商品描述驗證
    const descriptionField = document.getElementById("product_description");
    if (descriptionField.value < 0 || descriptionField.value.trim() === "") {
      isPass = false;
      descriptionField.closest(".mb-3").classList.add("error");
      descriptionField.nextElementSibling.innerHTML = "請填寫商品描述";
    } else {
      descriptionField.closest(".mb-3").classList.remove("error");
      descriptionField.nextElementSibling.innerHTML = "";
    }

    // 送出表單
    if (isPass) {
      const fd = new FormData(document.forms[1]);

      fetch(`p_add-upload-api.php`, {
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
  };
  // ---------------- 做上傳處理 ---------------------------
  const avatar = document.upload_form.image; // 取得上傳的欄位

  avatar.onchange = (e) => {
    const fd = new FormData(document.upload_form);

    //上傳圖片到資料夾
    fetch("p_upload-avatar.php", {
        method: "POST",
        body: fd,
      })
      .then((r) => r.json())
      .then((obj) => {
        console.log(obj);
        const myImg = document.querySelector('img.image');
        myImg.src = `../p_uploads/${obj.file}`;
        document.forms[0].avatar.value = obj.file;
      })
      .catch(console.warn);
  };
</script>
<?php include __DIR__ . '/../parts/html-tail.php' ?>