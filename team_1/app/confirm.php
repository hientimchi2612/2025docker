<?php
session_start();

$user = $_SESSION['order']['user'] ?? null;
$address = $_SESSION['order']['address'] ?? null;

if (!$user || !$address) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>Pizza Match | ご注文内容の確認</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
/* ===== RESET ===== */
* { box-sizing: border-box; }
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: #f5f5f5;
  text-align: center;
}

/* ===== HEADER ===== */
.header {
  background: #ff6f00;
  color: #fff;
  padding: 12px 0;
}
.header-content {
  display: flex;
  justify-content: center;
  align-items: center;
}
.logo {
  background: rgba(255,255,255,.2);
  padding: 6px 10px;
  border-radius: 8px;
  font-weight: bold;
  margin-right: 10px;
}
.header-title {
  font-size: 1.6em;
  margin: 0;
}

/* ===== CONTAINER ===== */
.container {
  max-width: 720px;
  margin: 16px auto;
  background: #fff;
  border-radius: 16px;
  padding: 16px;
  box-shadow: 0 4px 16px rgba(0,0,0,.08);
}

/* ===== SECTION ===== */
h2 {
  text-align: center;
  margin-top: 0;
}
h3 {
  border-bottom: 1px solid #ddd;
  padding-bottom: 6px;
}

/* ===== ITEMS ===== */
.item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 0;
  border-bottom: 1px solid #eee;
}
.item-img {
  width: 56px;
  height: 56px;
  border-radius: 8px;
  object-fit: cover;
  background: #eee;
}
.item-info {
  flex: 1;
}
.item-info .name {
  font-weight: bold;
}
.item-info .price {
  font-size: .9em;
  color: #666;
}
.item-actions {
  display: flex;
  align-items: center;
  gap: 6px;
}
.item-actions button {
  border: none;
  background: #f0f0f0;
  padding: 6px 10px;
  border-radius: 6px;
  cursor: pointer;
}
.item-actions span {
  min-width: 20px;
  text-align: center;
}

/* ===== TOTAL ===== */
.total {
  text-align: right;
  font-size: 1.2em;
  font-weight: bold;
  margin-top: 10px;
}

/* ===== TEXT ===== */
.muted {
  font-size: .85em;
  color: #666;
}
.empty {
  color: #999;
  font-style: italic;
}

/* ===== BUTTON ===== */
#submitBtn {
  width: 100%;
  margin-top: 20px;
  padding: 14px;
  font-size: 1.1em;
  background: #e85a00;
  color: #cfb1b1;
  border: none;
  border-radius: 12px;
  cursor: pointer;
}
#submitBtn:disabled {
  background: #cfb1b1;
}
.back {
  text-align: center;
  margin-top: 10px;
}

/* ===== MOBILE ===== */
@media (max-width:600px) {
  .item {
    align-items: flex-start;
  }
}
/* ===== SECTION BOX ===== */
.section-box {
  background: #fafafa;
  border-radius: 14px;
  padding: 14px;
  margin-bottom: 16px;
  box-shadow: 0 2px 8px #000;
}

.section-box h3 {
  margin-top: 0;
  margin-bottom: 10px;
  border-bottom: 1px solid #e2dcdc;
  padding-bottom: 6px;
  font-size: 1.1em;
}
.section-box p {
  margin: 6px 0;
}
</style>
</head>

<body>

<header class="header">
  <div class="header-content">
    <div class="logo">PM</div>
    <h1 class="header-title">Pizza Match</h1>
  </div>
</header>

<div class="container">

<h2>ご注文内容の確認</h2>
<p>ご注文内容をご確認の上、「注文を確定する」ボタンを押してください。</p>
<div class="section-box">
<h3>ご注文商品（編集可）</h3>
<div id="items"></div>
<p class="muted">※ 数量変更・削除はこの画面でできます。</p>
</div>
<div class="section-box">
<h3>お客様情報</h3>
<p>お名前：<?= htmlspecialchars($user['name']) ?></p>
<p>メール：<?= htmlspecialchars($user['email']) ?></p>
<p>電話：<?= htmlspecialchars($user['phone']) ?></p>
</div>
<div class="section-box">
<h3>配送先住所</h3>
<p>
〒<?= htmlspecialchars($address['zip']) ?><br>
<?= htmlspecialchars($address['pref']) ?>
<?= htmlspecialchars($address['city']) ?>
<?= htmlspecialchars($address['street']) ?><br>
<?= htmlspecialchars($address['comment']) ?>
</p>
<p><a href="address.php">住所を変更</a></p>
</div>
<div class="section-box">
<h3>配達時間</h3>
<p id="delivery-time-display">
    <?php
    $deliveryTime = $_SESSION['delivery_time'] ?? 'ASAP';
    if ($deliveryTime === 'ASAP') {
        echo 'できるだけ早く（最短30分後）';
    } else {
        echo '指定時間: ' . htmlspecialchars($deliveryTime);
    }
    ?>
</p>
<p><a href="cart.php">配達時間を変更</a></p>


<form method="post" action="order_create.php" id="orderForm">
  <input type="hidden" name="cart_json" id="cartJson">
  </div>
  <button type="submit" id="submitBtn">注文を確定する</button>
</form>

<div class="back">
  <a href="cart.php">← カートへ戻る</a>
</div>

</div>

<script>
const CART_KEY = 'cart';
let cart = JSON.parse(localStorage.getItem(CART_KEY) || '{}');

const itemsEl = document.getElementById('items');
const cartJsonEl = document.getElementById('cartJson');
const submitBtn = document.getElementById('submitBtn');

function saveCart() {
  localStorage.setItem(CART_KEY, JSON.stringify(cart));
}

function render() {
  itemsEl.innerHTML = '';
  let total = 0;
  const keys = Object.keys(cart);

  if (keys.length === 0) {
    itemsEl.innerHTML = '<p class="empty">カートに商品がありません。</p>';
    submitBtn.disabled = true;
    cartJsonEl.value = '{}';
    return;
  }

  submitBtn.disabled = false;

  keys.forEach(key => {
    const item = cart[key];

    const div = document.createElement('div');
    div.className = 'item';

    const img = document.createElement('img');
    img.className = 'item-img';
    img.src = item.image || './assets/img/noimage.png';

    const info = document.createElement('div');
    info.className = 'item-info';
    info.innerHTML = `
      <div class="name">${item.name}</div>
      <div class="price">¥${Number(item.price).toLocaleString()}</div>
    `;

    const actions = document.createElement('div');
    actions.className = 'item-actions';

    const minus = document.createElement('button');
    minus.textContent = '−';
    minus.onclick = () => changeQty(key, -1);

    const qty = document.createElement('span');
    qty.textContent = item.qty;

    const plus = document.createElement('button');
    plus.textContent = '＋';
    plus.onclick = () => changeQty(key, 1);

    const del = document.createElement('button');
    del.textContent = '削除';
    del.onclick = () => removeItem(key);

    actions.append(minus, qty, plus, del);
    div.append(img, info, actions);
    itemsEl.appendChild(div);

    total += item.price * item.qty;
  });

  const totalEl = document.createElement('div');
  totalEl.className = 'total';
  totalEl.textContent = `合計金額：¥${total.toLocaleString()}`;
  itemsEl.appendChild(totalEl);

  cartJsonEl.value = JSON.stringify(cart);
}

function changeQty(key, diff) {
  cart[key].qty += diff;
  if (cart[key].qty <= 0) delete cart[key];
  saveCart();
  render();
}

function removeItem(key) {
  delete cart[key];
  saveCart();
  render();
}

render();
</script>

</body>
</html>
