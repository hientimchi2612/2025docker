<!DOCTYPE html>
<html lang="ja">
<head>
<<<<<<< HEAD
<meta charset="UTF-8">
<title>シフトページ</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
/* ====== BASIC ====== */
body{
  font-family: Arial, sans-serif;
    background:grey;
  padding: 20px;
}
.box{
  max-width:1100px;
  margin:auto;
  background:#fff;
  border-radius:16px;
  padding:24px;
}
h1{
  margin:0 0 20px;
  border-bottom:2px solid #eee;
  padding-bottom:10px;
}

/* ====== FORM ====== */
.form{
  display:grid;
  grid-template-columns:1.2fr 1fr 1fr 1fr auto;
  gap:10px;
  margin-bottom:24px;
}
input,select,button{
  padding:10px;
  border-radius:8px;
  border:1px solid #ddd;
}
button{
  background:#5b6dff;
  color:#fff;
  border:none;
  cursor:pointer;
}
button:hover{opacity:.9}

/* ====== TABLE ====== */
table{
  width:100%;
  border-collapse:collapse;
  font-size:14px;
}
th,td{
  border-bottom:1px solid #eee;
  padding:10px;
  text-align:center;
}
th{
  background:#f5f7fb;
}
.time{
  font-weight:bold;
  color:#4f46e5;
  white-space:nowrap;
}
.empty{
  color: #aa1106;
  font-style:italic;
}
</style>
</head>

<body>
<div class="box">
  <h1>シフトページ</h1>

  <!-- ===== FORM ===== -->
  <div class="form">
    <input id="name" placeholder="名前を入力">
    <select id="role">
      <option>キッチン</option>
      <option>ドライバー</option>
    </select>
    <select id="time">
      <option>9:00-15:00</option>
      <option>15:00-23:00</option>
    </select>
    <select id="day">
      <option value="0">月</option>
  <option value="1">火</option>
  <option value="2">水</option>
  <option value="3">木</option>
  <option value="4">金</option>
  <option value="5">土</option>
  <option value="6">日</option>
</select>
    <button onclick="addShift()">シフトを提出</button>
  </div>

  <!-- ===== TABLE ===== -->
   <h2>週間のスケージュール</h2>
  <table>
<tr>
  <th>時間</th><th>役割</th>
  <th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th><th>日</th>
</tr>

<tr>
  <td class="time" rowspan="2">9:00-15:00</td>
  <th>キッチン</th>
  <td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td>
</tr>
<tr>
  <th>ドライバー</th>
  <td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td>
</tr>

<tr>
  <td class="time" rowspan="2">15:00-23:00</td>
  <th>キッチン</th>
  <td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td>
</tr>
<tr>
  <th>ドライバー</th>
  <td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td><td class="cell"></td>
</tr>
</table>

</div>

<script>
/* ===== row mapping ===== */
const rowMap = {
  "9:00-15:00キッチン": 1,
  "9:00-15:00ドライバー": 2,
  "15:00-23:00キッチン": 3,
  "15:00-23:00ドライバー": 4
};

/* ===== fill 空 ===== */
document.querySelectorAll(".cell").forEach(cell => {
  cell.innerHTML = '<span class="empty">空</span>';
});

/* ===== add shift ===== */
function addShift(){
  const name = document.getElementById("name").value.trim();
  const role = document.getElementById("role").value;
  const time = document.getElementById("time").value;
  const dayIndex = Number(document.getElementById("day").value); // 0~6

  if(!name){
    alert("名前を入力してください");
    return;
  }

  const table = document.querySelector(".box table");
  const rowIndex = rowMap[time + role];
  const row = table.rows[rowIndex];

  const cells = row.querySelectorAll(".cell");
  const cell = cells[dayIndex];

  if(!cell){
    alert("セル取得エラー");
    return;
  }

  if(!cell.querySelector(".empty")){
    alert("そのシフトは既に埋まっています");
    return;
  }

  cell.textContent = name;
  cell.onclick = () => removeShift(cell);
  document.getElementById("name").value = "";
}
</script>


=======
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

>>>>>>> 93d2f4b4b7c79934a0df5d128d24cd59a4d4e6ee
</body>
</html>
