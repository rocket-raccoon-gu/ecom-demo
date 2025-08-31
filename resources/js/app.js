import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Simple cart badge updater and add-to-cart animation
window.addEventListener('DOMContentLoaded', () => {
  const badge = document.getElementById('cart-count');
  const fetchCount = async () => {
    try {
      const res = await fetch('/cart/count', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
      const data = await res.json();
      if (badge) badge.textContent = data.count;
    } catch (_) {}
  };
  fetchCount();

  document.body.addEventListener('submit', async (e) => {
    const form = e.target;
    if (!(form instanceof HTMLFormElement)) return;
    if (!form.matches('[data-add-to-cart]')) return;
    e.preventDefault();
    const btn = form.querySelector('button');
    const overlay = form.querySelector('.addcart-overlay');
    btn && btn.setAttribute('disabled', 'true');
    try {
      const res = await fetch(form.action, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: new FormData(form)
      });
      const data = await res.json();
      if (badge) {
        badge.textContent = data.count;
        // pulse animation
        badge.classList.add('animate-ping-once');
        setTimeout(() => badge.classList.remove('animate-ping-once'), 500);
      }
      // button overlay flash
      if (overlay) {
        overlay.classList.add('show');
        setTimeout(() => overlay.classList.remove('show'), 200);
      }
    } finally {
      btn && btn.removeAttribute('disabled');
    }
  });
});
