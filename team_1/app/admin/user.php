<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ユーザー管理</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/user.css">
</head>

<body>

<header class="header">
    <h1>ユーザー管理画面</h1>
    <button class="admin" onclick="location.href='admin.php'">戻る</button>
</header>

<div class="container">

    <!-- Search -->
    <div class="action-bar">
        <div class="searchBox">
            <input type="text" id="searchBox" placeholder="ユーザー検索">
            <button onclick="searchUser()">検索</button>
        </div>

        <a href="add_user.php" class="add-btn">＋ 追加</a>
    </div>

    <!-- User table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>メール</th>
                <th>ロール</th>
                <th>電話</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody id="userTable">
            <!-- data -->
        </tbody>
    </table>

</div>

<script>
function searchUser() {
    const keyword = document.getElementById('searchBox').value.toLowerCase().trim();
    const rows = document.querySelectorAll('#userTable tr');

    rows.forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(keyword)
            ? ''
            : 'none';
    });
}
</script>

</body>
</html>
