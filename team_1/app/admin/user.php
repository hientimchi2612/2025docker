<?php
// =========================
// KẾT NỐI SQLITE
// =========================
try {
    $db = new PDO('sqlite:../../data/database.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->query('SELECT name, email FROM users ORDER BY id ASC');
    $users = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $initial = mb_substr($row['name'], 0, 1);
        $users[] = [
            'name'    => $row['name'],
            'email'   => $row['email'],
            'initial' => mb_strtoupper($initial),
        ];
    }

} catch (PDOException $e) {
    die('DBエラー: ' . htmlspecialchars($e->getMessage()));
}

$totalUsers = count($users);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ユーザー管理</title>

<style>
*{box-sizing:border-box}
body{margin:0;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;background:#f6f7f9;color:#333}
header{background:#fff;height:64px;display:flex;align-items:center;justify-content:space-between;padding:0 32px;border-bottom:1px solid #eee}
.logo{display:flex;align-items:center;gap:10px;font-weight:600}
.main{max-width:1200px;margin:32px auto}
h1{font-size:28px;margin:0}
.sub{color:#777;margin:6px 0 24px}
.total{background:#eef2ff;color:#4f6ef7;padding:6px 14px;border-radius:20px;font-size:14px;display:inline-block;margin-bottom:16px}
.table-wrap{background:#fff;border-radius:16px;overflow:hidden;border:1px solid #eee}
table{width:100%;border-collapse:collapse}
th{background:#fafafa;text-align:left;font-weight:600;padding:14px 16px;border-bottom:1px solid #eee}
td{padding:16px;border-bottom:1px solid #f0f0f0}
.name{display:flex;align-items:center;gap:12px}
.avatar{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:600;background:#e8edff;color:#4f6ef7}
.empty{text-align:center;color:#888;padding:24px}
</style>
</head>

<body>

<header>
    <div class="logo">🍕 Pizza Admin</div>
</header>

<div class="main">
    <h1>ユーザー管理</h1>
    <div class="sub">登録済みユーザー一覧</div>

    <div class="total">Total: <?= $totalUsers ?></div>

    <div class="table-wrap">
        <table id="userTable">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>メールアドレス</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
const users = <?= json_encode(
    $users,
    JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
) ?>;

const table = document.getElementById('userTable');
const tbody = document.createElement('tbody');

if (users.length === 0) {
    const tr = document.createElement('tr');
    const td = document.createElement('td');
    td.colSpan = 2;
    td.className = 'empty';
    td.textContent = 'ユーザーが登録されていません';
    tr.appendChild(td);
    tbody.appendChild(tr);
} else {
    users.forEach(user => {
        const tr = document.createElement('tr');

        const nameTd = document.createElement('td');
        const nameWrap = document.createElement('div');
        nameWrap.className = 'name';

        const avatar = document.createElement('div');
        avatar.className = 'avatar';
        avatar.textContent = user.initial;

        const nameText = document.createElement('span');
        nameText.textContent = user.name;

        nameWrap.appendChild(avatar);
        nameWrap.appendChild(nameText);
        nameTd.appendChild(nameWrap);

        const emailTd = document.createElement('td');
        emailTd.textContent = user.email;

        tr.appendChild(nameTd);
        tr.appendChild(emailTd);
        tbody.appendChild(tr);
    });
}

table.appendChild(tbody);
</script>

</body>
</html>
