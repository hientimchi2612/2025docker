<?php
$dbh = new PDO('mysql:host=db;dbname=pizza_shop;charset=utf8', 'root', 'rootpassword'); 

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>管理パネル</title>
<link rel="stylesheet" href="kanri.css">
</head>
<body>

<div class="layout">

    

        <h2 class="logo">◆ 管理パネル</h2>
    <!-- Main -->
    <main class="content">
        <h1>設定</h1>

        <!-- 営業時間 -->
        <section class="card">
            <h2>営業時間・ラストオーダー設定</h2>

            <div class="row">
                <div>
                    <label>開店時間</label>
                    <input type="time" value="11:00">
                </div>
                <div>
                    <label>閉店時間</label>
                    <input type="time" value="22:00">
                </div>
                <div>
                    <label>ラストオーダー</label>
                    <input type="time" value="21:30">
                </div>
            </div>

            <div class="form-footer">
                <button class="btn-save">保存</button>
            </div>
        </section>

        <!-- シフト -->
        <section class="card">
            <h2>シフト時間設定</h2>

            <h3>🌞 早番</h3>
            <div class="row">
                <input type="time" value="09:00">
                <input type="time" value="13:00">
            </div>

            <h3>🌙 遅番</h3>
            <div class="row">
                <input type="time" value="14:00">
                <input type="time" value="23:00">
            </div>

            <div class="form-footer">
                <button class="btn-save">保存</button>
            </div>
        </section>

        <!-- ピザ価格 -->
        <section class="card">
            <h2>ピザ価格設定</h2>

            <table>
                <thead>
                    <tr>
                        <th>ピザ</th>
                        <th>Sサイズ</th>
                        <th>Mサイズ</th>
                        <th>Lサイズ</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" value=" "></td>
                        <td><input class="price" value=" "></td>
                        <td><input class="price" value=" "></td>
                        <td><input class="price" value=" "></td>
                         <td class="actions">
        <button class="btn-save-mini">保存</button>
        <button class="btn-delete">削除</button>
            </td>
                        
                    </tr>
                    <tr>
                        <td><input type="text" value=" "></td>
                        <td><input class="price" value=" "></td>
                        <td><input class="price" value=" "></td>
                        <td><input class="price" value=" "></td>
                        <td class="actions">
        <button class="btn-save-mini">保存</button>
        <button class="btn-delete">削除</button>
            </td>
                    </tr>
                </tbody>
            </table>

            <button class="btn-add">＋ 追加</button>

            <div class="form-footer">
                <button class="btn-save">保存</button>
            </div>
        </section>

    </main>
</div>
<script>
    document.querySelector('.btn-add').addEventListener('click', function() {
        const tbody = document.querySelector('table tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" value=" "></td>
            <td><input class="price" value=" "></td>
            <td><input class="price" value=" "></td>
            <td><input class="price" value=" "></td>
            <td class="actions">
                <button class="btn-save-mini">保存</button>
                <button class="btn-delete">削除</button>
            </td>
        `;
        tbody.appendChild(newRow);
    });
    document.querySelector('table tbody').addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-delete')) {
            const row = e.target.closest('tr');
            row.remove();
        }
    });
    document.querySelectorAll('.btn-save-mini').forEach(function(button) {
        button.addEventListener('click', function() {
            alert('保存されました');
        });
    });
    document.querySelectorAll('.btn-save').forEach(function(button) {
        button.addEventListener('click', function() {
            alert('保存されました');
        });
    });
</script>
</body>
</html>
