document.addEventListener('DOMContentLoaded', function () {
  const totalSpan = document.getElementById('total');
  const cartCount = document.querySelector('.cart-count');
  const pizzaCards = document.querySelectorAll('.pizza-card');
  const sideCart = document.getElementById('sideCart');
  const cartContent = document.getElementById('cartContent');
  const sideTotal = document.getElementById('sideTotal');
  const form = document.getElementById("orderForm");

  function formatYen(n) {
    return (Number(n) || 0).toLocaleString('ja-JP');
  }
  function updateCartCount() {
    const inputs = document.querySelectorAll('.qty');
    const totalQty = Array.from(inputs).reduce((sum, input) => sum + (parseInt(input.value,10) || 0), 0);
    cartCount.textContent = totalQty;
  }

  function cartTotal() {
    let total = 0;
    cartContent.innerHTML = '';
    pizzaCards.forEach(card => {
      const name = card.querySelector('.item-name').textContent;
      const price = parseInt(card.querySelector('.item-price').dataset.price, 10);
      const qty = parseInt(card.querySelector('.qty').value, 10) || 0;
      if(qty > 0){
        const itemTotal = price * qty;
        total += itemTotal;
        const div = document.createElement('div');
        div.className = 'cart-item';
        div.innerHTML = `<strong>${name}</strong> × ${qty} = ${formatYen(itemTotal)} 円`;
        cartContent.appendChild(div);
      }
    });
    sideTotal.textContent = formatYen(total);
  }

  function calculateTotal() {
    let total = 0;
    pizzaCards.forEach(card => {
      const price = parseInt(card.querySelector('.item-price').dataset.price, 10);
      const qty = parseInt(card.querySelector('.qty').value, 10) || 0;
      total += price * qty;
    });
    totalSpan.textContent = formatYen(total);
    updateCartCount();
    cartTotal();
  }

  pizzaCards.forEach(card => {
    const qtyInput = card.querySelector('.qty');
    const incBtn = card.querySelector('.inc');
    const decBtn = card.querySelector('.dec');

    if(incBtn) incBtn.addEventListener('click', () => {
      qtyInput.value = parseInt(qtyInput.value,10) + 1;
      calculateTotal();
    });

    if(decBtn) decBtn.addEventListener('click', () => {
      qtyInput.value = Math.max(0, parseInt(qtyInput.value,10) - 1);
      calculateTotal();
    });

    if(qtyInput) qtyInput.addEventListener('input', () => {
      if(qtyInput.value < 0) qtyInput.value = 0;
      calculateTotal();
    });
  });

  form.addEventListener('submit', function(e){
    e.preventDefault();
    const items = [];
    pizzaCards.forEach(card => {
      const qty = parseInt(card.querySelector('.qty').value,10) || 0;
      if(qty > 0){
        items.push({
          name: card.querySelector('.item-name').textContent,
          price: parseInt(card.querySelector('.item-price').dataset.price,10),
          quantity: qty,
          imgSrc: card.querySelector('.pizza-image').src
        });
      }
    });
    localStorage.setItem('cartItems', JSON.stringify(items));
    const total = parseInt(totalSpan.textContent.replace(/,/g,''),10);
    document.getElementById("totalPriceInput").value = total;
    location.href = 'katto.html';
  });

  calculateTotal();
});
function formatYen(n) {
  return (Number(n) || 0).toLocaleString('ja-JP');
}

function calculateTotal() {
  let total = 0;
  document.querySelectorAll('.pizza-card').forEach(card => {
    const price = parseInt(card.querySelector('.item-price').dataset.price,10);
    const qty = parseInt(card.querySelector('.qty').value,10) || 0;
    total += price * qty;
  });
  document.getElementById('total').textContent = formatYen(total); 

}
