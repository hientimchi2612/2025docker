
<?php
session_start();
// ID người đang đăng nhập
$currentUserId = $_SESSION['user_id'] ?? 2;  // demo
$currentUserRole = $_SESSION['role'] ?? 'user'; // 'admin' hoặc 'user'

// Dữ liệu giả lập, sau này dùng DB
$users = [
    ['id'=>1,'login'=>'admin','email'=>'admin@test.com','role'=>'admin','phone'=>'090-1111-1111'],
    ['id'=>2,'login'=>'taro','email'=>'taro@test.com','role'=>'user','phone'=>'090-2222-2222'],
    ['id'=>3,'login'=>'jiro','email'=>'jiro@test.com','role'=>'user','phone'=>'090-3333-3333'],
];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ユーザー管理</title>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    background: #f4f4f4;
}
header {
    background: #35424a;
    color: #fff;
    padding: 15px;
    text-align: center;
}
.container {
    max-width: 1000px;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
}
.searchBox {
    margin-bottom: 15px;
    justify-content: center;
    display: flex;
    align-items: center;
}
.searchBox input {
    width: 300px;
    padding: 8px;
}
.link-btn {
    padding: 8px 14px;
    background: #eee;
    border-radius: 6px;
    text-decoration: none;
    color: #000;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}
th, td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: center;
}
</style>
</head>

<body>

<header>
    <h1>ユーザー管理画面</h1>
</header>

<div class="container">
    <div class="searchBox">
        <input type="text" id="searchBox" placeholder="ユーザー検索"><button class="link-btn" onclick="searchBox.value=''; searchBox.dispatchEvent(new Event('input'));">検索</button>
    </div>
        <button href="user_complete.php" class="link-btn">＋ 追加</button>


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
        <tbody id="userTable"></tbody>
    </table>

</div>

<<script>
const userTable = document.getElementById('userTable');
const searchBox = document.getElementById('searchBox');
let users = [];
async function fetchUsers() {
    const response = await fetch('/api/users.php');
    users = await response.json();
    displayUsers(users);
}   
function displayUsers(userList) {
    userTable.innerHTML = '';
    userList.forEach(user => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${user.id}</td>
            <td>${user.login}</td>
            <td>${user.email}</td>
            <td>${user.role}</td>
            <td>${user.phone}</td>
            <td>
                <a href="user_complete.php?id=${user.id}" class="link-btn">編集</a>
            </td>
        `;
        userTable.appendChild(row);
    });
}

</script>


</body>
</html>
