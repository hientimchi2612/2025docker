<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Admin - Shift Management</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        @media (prefers-color-scheme: dark) {
            body {
                background-color: #121212;
                color: #e0e0e0;
            }
            table, th, td {
                border-color: #444;
            }
            th {
                background-color: #1e1e1e;
            }
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"],
        input[type="date"] {
            width: 95%;
            padding: 6px;
        }

        #add-shift-btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        #add-shift-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

<h1>シフト管理</h1>

<table>
    <thead>
        <tr>
            <th>従業員名</th>
            <th>役割</th>
            <th>シフト希望</th>
            <th>日付</th>
        </tr>
    </thead>

    <tbody>
        <!-- INPUT ROW (đúng thứ tự theo header) -->
        <tr>
            <td><input type="text" id="employee-name"></td>
            <td><input type="text" id="role"></td>
            <td><input type="text" id="shift-preference"></td>
            <td><input type="date" id="shift-date"></td>
        </tr>

        <!-- BUTTON ROW -->
        <tr>
            <td colspan="4" style="text-align:center;">
                <button id="add-shift-btn">シフト提出</button>
            </td>
        </tr>
    </tbody>
</table>

<h2>スケジュール</h2>
<div id="schedule-view"></div>

<script>
document.getElementById('add-shift-btn').addEventListener('click', function () {

    const name = document.getElementById('employee-name').value;
    const role = document.getElementById('role').value;
    const preference = document.getElementById('shift-preference').value;
    const date = document.getElementById('shift-date').value;

    if (!name || !role || !preference || !date) {
        alert('全てのフィールドを入力してください。');
        return;
    }

    const div = document.createElement('div');
    div.textContent =
        `従業員名: ${name} ｜ 役割: ${role} ｜ 希望: ${preference} ｜ 日付: ${date}`;

    document.getElementById('schedule-view').appendChild(div);

    // reset
    document.getElementById('employee-name').value = '';
    document.getElementById('role').value = '';
    document.getElementById('shift-preference').value = '';
    document.getElementById('shift-date').value = '';
});
</script>

</body>
</html>
