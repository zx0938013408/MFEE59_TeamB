<?php
require __DIR__ . '/../parts/init.php' ?>

<?php

# 套入資料
$sql_activity = sprintf("SELECT 
activity_list.id, 
activity_name, 
sport_name, 
areas.name as area_name, 
court_info.address,
activity_time, 
deadline, 
payment, 
need_num, 
introduction,
members.name, 
create_time,
update_time
FROM `activity_list`
JOIN sport_type on activity_list.sport_type_id = sport_type.id
JOIN areas on activity_list.area_id = areas.area_id
JOIN court_info on activity_list.court_id = court_info.id
JOIN members on activity_list.founder_id = members.id
");
$rows = $pdo->query($sql_activity)->fetchAll(PDO::FETCH_ASSOC);

$sql_registered = sprintf("SELECT registered.id, members.name, activity_name, num, notes
FROM `registered`
JOIN members on registered.member_id = members.id
JOIN activity_list on registered.activity_id = registered.id
");
$rows_R = $pdo->query($sql_registered)->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include __DIR__ . '/../parts/html-head.php' ?>
<?php include __DIR__ . '/../parts/html-navbar.php' ?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">活動列表</h1>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index_.php">主頁</a></li>
            <li class="breadcrumb-item active">活動列表</li>
          </ol>
        </div>
        <div class="col-md-2 ms-auto mb-4">
          <button type="button" class="btn btn-secondary btn-lg">
            <a class="nav-link"
              href="add-upload.php">新增活動</a>
          </button>
        </div>
      </div>



      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-table me-1"></i>
          活動列表
        </div>
        <div class="card-body">
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>編號</th>
                <th>活動名稱</th>
                <!-- <th>活動相片</th> -->
                <th>運動類型</th>
                <th>活動地址</th>
                <th>地點名稱</th>
                <th>活動時間</th>
                <th>報名期限</th>
                <th>活動費用</th>
                <th>需求人數</th>
                <th>活動簡介</th>
                <th>開團者</th>
                <th>創建時間</th>
                <th>更新時間</th>
                <th>修改</th>
                <th>刪除</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rows as $r): ?>
                <tr>
                  <td><?= $r['id'] ?></td>
                  <td><?= $r['activity_name'] ?></td>
                  <!--<td><?= $r['photo_url'] ?></td>-->
                  <td><?= $r['sport_name'] ?></td>
                  <td><?= htmlentities($r['area_name']) ?></td>
                  <td><?= $r['address'] ?></td>
                  <td><?= $r['activity_time'] ?></td>
                  <td><?= htmlentities($r['deadline']) ?></td>
                  <td><?= $r['payment'] ?></td>
                  <td><?= $r['need_num'] ?></td>
                  <td><?= $r['introduction'] ?></td>
                  <td><?= $r['name'] ?></td>
                  <td><?= $r['create_time'] ?></td>
                  <td><?= $r['update_time'] ?></td>
                  <td><a href="edit.php?id=<?= $r['id'] ?>">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </a></td>

                    <td><a href="javascript:" onclick="deleteOne(event)">
                      <i class="fa-solid fa-trash"></i>
                    </a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</main>
<?php include __DIR__ . '/../parts/html-footer.php' ?>
<?php include __DIR__ . '/../parts/html-scripts.php' ?>
<script>
  const deleteOne = e => {
    e.preventDefault(); // 沒有要連到某處
    const tr = e.target.closest('tr');
    const [td_id, td_activity_name] = tr.querySelectorAll('td');
    const id = td_id.innerHTML;
    const activity_name = td_activity_name.innerHTML;
    console.log([td_id.innerHTML, td_activity_name.innerHTML]);
    if (confirm(`是否要刪除編號為 ${id} 活動名稱為 ${activity_name} 的資料?`)) {
      // 使用 JS 做跳轉頁面
      location.href = `del.php?id=${id}`;
    }
  }
</script>
<?php include __DIR__ . '/../parts/html-tail.php' ?>