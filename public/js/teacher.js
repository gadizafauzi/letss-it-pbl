/* ═══════════════════════════════════════
   dashboard.js  –  SIT Student Dashboard
   ═══════════════════════════════════════ */

/* ══════════════════════════════
   MODAL LOGOUT
══════════════════════════════ */
function bukaModalLogout() {
    document.getElementById('modalLogout').classList.add('open');
}

function tutupModalLogout() {
    document.getElementById('modalLogout').classList.remove('open');
}

function lakukanLogout() {
    var form    = document.createElement('form');
    form.method = 'POST';
    form.action = '/logout';

    var csrf   = document.createElement('input');
    csrf.type  = 'hidden';
    csrf.name  = '_token';
    csrf.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    form.appendChild(csrf);
    document.body.appendChild(form);
    form.submit();
}

// Tutup modal dengan tombol Escape
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') tutupModalLogout();
});

/* ══════════════════════════════
   COUNTER ANIMASI
══════════════════════════════ */
function animateCounter(el, target, decimals, duration) {
    if (!el) return;
    var start = performance.now();

    function tick(now) {
        var progress = Math.min((now - start) / duration, 1);
        var eased    = 1 - Math.pow(1 - progress, 4); // ease-out quart
        var value    = target * eased;

        el.textContent = decimals ? value.toFixed(decimals) : Math.round(value);

        if (progress < 1) requestAnimationFrame(tick);
    }

    requestAnimationFrame(tick);
}

document.addEventListener('DOMContentLoaded', function () {
    animateCounter(document.getElementById('statKelas'), 8,    0, 900);
    animateCounter(document.getElementById('statNilai'), 85.5, 1, 1200);
    animateCounter(document.getElementById('statSiswa'), 28,   0, 1000);
});
