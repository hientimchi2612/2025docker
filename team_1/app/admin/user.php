<?php
session_start();

/* ====== LOGIN INFO (demo) ====== */
$currentUserId   = $_SESSION['user_id'] ?? 2;
$currentUserRole = $_SESSION['role'] ?? 'user';

$users = [
    ['id' => 1, 'login' => 'admin', 'email' => 'admin@test.com', 'role' => 'admin', 'phone' => '090-1111-2222'],
    ['id' => 2, 'login' => 'user1', 'email' => 'user1@test.com', 'role' => 'user', 'phone' => '080-3333-4444'],
    ['id' => 3, 'login' => 'user2', 'email' => 'user2@test.com', 'role' => 'user', 'phone' => '070-5555-6666']
];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ユーザー管理</title>
<link rel="stylesheet" href="css/user.css">

</head>

<body>

<header>
    <h1>ユーザー管理画面</h1>
</header>
<input type="submit" value="＜－戻る" onclick="location.href='admin.php'" class="back-btn">
<div class="container">

    <div class="searchBox">
        <input type="text" id="searchBox" placeholder="ユーザー検索">
        <button class="link-btn" onclick="resetSearch()">検索</button>
    </div>

    <a href="add_user.php" class="link-btn">＋ 追加</a>

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
      <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['login']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <td><?php echo htmlspecialchars($user['phone']); ?></td>
                <td>
                    <a href="add_user.php?id=<?php echo $user['id']; ?>" class="link-btn">編集</a>
                    <?php if ($currentUserRole === 'admin' && $currentUserId != $user['id']): ?>
                        <a href="user_delete.php?id=<?php echo $user['id']; ?>" class="link-btn" onclick="return confirm('本当に削除しますか？');">削除</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>

            
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchBox = document.getElementById('searchBox');
    const rows = document.querySelectorAll('#userTable tr');

    searchBox.addEventListener('input', () => {
        const filter = searchBox.value.toLowerCase();

        rows.forEach(row => {
            const login = row.cells[1].textContent.toLowerCase();
            const email = row.cells[2].textContent.toLowerCase();

            row.style.display =
                login.includes(filter) || email.includes(filter)
                ? ''
                : 'none';
        });
    });
});

function resetSearch() {
    const searchBox = document.getElementById('searchBox');
    searchBox.value = '';
    searchBox.dispatchEvent(new Event('input'));
}
</script>

</body>
</html>
