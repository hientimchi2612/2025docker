
<?php

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
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    align-items: center;
    gap: 10px;
   ;

}

.searchBox {
    margin-bottom: 15px;
     justify-content: center;
    display: flex;
    gap: 10px;

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
@media (max-width: 600px) {
    .searchBox {
        flex-direction: column;
        align-items: stretch;
    }
    .searchBox input {
        width: 100%;
    }
}
</style>
</head>

<body>

<header>
    <h1>ユーザー管理画面</h1>
</header>

<div class="container">


    <div class="searchBox">
        <input type="text" id="searchBox" placeholder="ユーザー検索"><button onclick="searchBox.value=''; searchBox.dispatchEvent(new Event('input'));">検索</button>
    </div>
    <button onclick="location.href='./user_complete.php'" class="link-btn">＋追加</button>

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

<script>
const userTable = document.getElementById("userTable");
const searchBox = document.getElementById("searchBox");

function renderTable(list) {
    userTable.innerHTML = "";
    list.forEach(u => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td>${u.id}</td>
            <td>${u.login}</td>
            <td>${u.email}</td>
            <td>${u.role}</td>
            <td>${u.phone}</td>
            <td>
                <a href="./user_complete.php?id=${u.id}" class="link-btn">編集</a>
            </td>
        `;
        userTable.appendChild(tr);
    });
}

/* ===== SEARCH ===== */
searchBox.addEventListener("input", function () {
    const q = this.value.toLowerCase();
    const filtered = users.filter(u =>
        u.login.toLowerCase().includes(q) ||
        u.email.toLowerCase().includes(q)
    );
    renderTable(filtered);
});

/* ===== INIT ===== */
renderTable(users);
</script>

</body>
</html>
