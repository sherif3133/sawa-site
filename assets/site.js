/* Sawa Site: mobile menu and the free-content filters. */
(function () {
  var btn = document.querySelector('.menu-btn'), nav = document.getElementById('site-nav');
  if (btn && nav) {
    btn.addEventListener('click', function () {
      var open = nav.classList.toggle('open');
      btn.setAttribute('aria-expanded', String(open));
    });
  }

  var grid = document.getElementById('res-grid');
  if (!grid) return;
  var state = { type: '', level: '' };
  function apply() {
    var shown = 0;
    grid.querySelectorAll('.res').forEach(function (c) {
      var ok = (!state.type || c.dataset.type === state.type) && (!state.level || c.dataset.level === state.level || c.dataset.level === 'all');
      c.hidden = !ok; if (ok) shown++;
    });
    var empty = document.getElementById('res-empty');
    if (empty) empty.hidden = shown > 0;
  }
  document.querySelectorAll('.chips[data-filter]').forEach(function (group) {
    group.addEventListener('click', function (e) {
      var b = e.target.closest('button'); if (!b) return;
      state[group.dataset.filter] = b.dataset.v;
      group.querySelectorAll('button').forEach(function (x) { x.setAttribute('aria-pressed', String(x === b)); });
      apply();
    });
  });
})();
