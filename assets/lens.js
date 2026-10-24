/* /lens/ guide: page title and image alt text follow the site language (SawaLang), copy buttons, the step-by-step guide
   (one step per screen, Back / Next, progress bar, the step in the URL hash), and old /lens/#something links:
   old guide anchors go to the matching step, the web app's old addresses (before /app) go on to /app/. */
(function () {
  var d = document.documentElement;
  function lang() { return d.getAttribute('data-lang') === 'ar' ? 'ar' : 'en'; }
  function store(k, v) { try { if (v === undefined) return localStorage.getItem(k); localStorage.setItem(k, v); } catch (e) {} return null; }

  // ---- step-by-step guide ----
  var steps = [].slice.call(document.querySelectorAll('.wz-step'));
  var byPath = {};
  steps.forEach(function (s) { (byPath[s.dataset.path] = byPath[s.dataset.path] || []).push(s.id); });
  var OLD = { install: 'pc-1', pin: 'pc-6', edge: 'pc-3', firefox: 'pc-1', android: 'an-1', features: byPath.tour ? 'tour-1' : 'start', use: byPath.tour ? 'tour-1' : 'start' };
  var count = document.querySelector('.wz-count'), bar = document.querySelector('.wz-bar i');
  var back = document.querySelector('.wz-back'), next = document.querySelector('.wz-next');
  var cur = 'start';

  function setDev(dev) {
    if (dev !== 'pc' && dev !== 'phone') return;
    d.classList.remove('dev-pc', 'dev-phone'); d.classList.add('dev-' + dev); store('lg-dev', dev);
  }
  setDev(store('lg-dev') || (window.matchMedia && matchMedia('(pointer: coarse)').matches ? 'phone' : 'pc'));

  function isStep(id) { return !!id && steps.some(function (s) { return s.id === id; }); }
  function pathOf(id) { var s = document.getElementById(id); return s && s.dataset.path ? s.dataset.path : 'start'; }
  function num(n) { return lang() === 'ar' ? String(n).replace(/\d/g, function (c) { return '٠١٢٣٤٥٦٧٨٩'[c]; }) : n; }

  /** Where Next and Back go from a step: through the chosen setup path, then into the feature tour. */
  function nextOf(id) {
    var p = pathOf(id), list = byPath[p] || [], i = list.indexOf(id);
    if (p === 'start') return '';
    if (i < list.length - 1) return list[i + 1];
    return p === 'tour' || !byPath.tour ? '' : 'tour-1'; // the tour can be switched off in the template ($tour)
  }
  function backOf(id) {
    var p = pathOf(id), list = byPath[p] || [], i = list.indexOf(id);
    if (p === 'start') return '';
    if (i > 0) return list[i - 1];
    if (p === 'tour') { var last = store('lg-path'); return last && byPath[last] ? byPath[last][byPath[last].length - 1] : 'start'; }
    return 'start';
  }

  function render() {
    steps.forEach(function (s) { s.classList.toggle('on', s.id === cur); });
    var p = pathOf(cur), list = byPath[p] || [], i = list.indexOf(cur) + 1, ar = lang() === 'ar';
    if (p === 'an') setDev('phone'); else if (p === 'pc' || p === 'ip') setDev('pc');
    if (p !== 'start' && p !== 'tour') store('lg-path', p);
    var label = { pc: ar ? 'تثبيت على الكمبيوتر' : 'Computer setup', an: ar ? 'تثبيت على أندرويد' : 'Android setup', ip: ar ? 'أيفون' : 'iPhone', tour: ar ? 'المميزات' : 'What you can do' }[p];
    if (count) count.innerHTML = p === 'start' ? (ar ? 'ابدأ هنا' : 'Start here')
      : label + ' · ' + (p === 'tour' ? (ar ? 'ميزة ' : 'Feature ') : (ar ? 'خطوة ' : 'Step ')) + '<b>' + num(i) + '</b>' + (ar ? ' من ' : ' of ') + '<b>' + num(list.length) + '</b>';
    if (bar) bar.style.width = (p === 'start' ? 0 : Math.round(i / list.length * 100)) + '%';
    if (back) back.hidden = !backOf(cur);
    if (next) {
      var n = nextOf(cur), toTour = n === 'tour-1' && p !== 'tour';
      next.hidden = !n;
      next.textContent = ar ? (toTour ? 'شوف المميزات ←' : 'التالي ←') : (toTour ? 'See the features →' : 'Next →');
    }
  }

  function go(id, push) {
    if (!isStep(id)) return;
    cur = id;
    if (push) history.pushState(null, '', '#' + id);
    render();
    var g = document.getElementById('guide');
    if (!g || (!push && id === 'start')) return;
    var head = document.querySelector('.site-head');
    var to = function (how) { window.scrollTo({ top: g.getBoundingClientRect().top + window.pageYOffset - (head ? head.offsetHeight : 0), behavior: how }); };
    to(push ? 'smooth' : 'instant');
    if (!push && document.readyState !== 'complete') window.addEventListener('load', function () { to('instant'); }, { once: true }); // pictures above can move it while loading
  }

  function fromHash(initial) {
    var h = decodeURIComponent(location.hash.replace('#', ''));
    if (OLD[h]) { history.replaceState(null, '', '#' + OLD[h]); h = OLD[h]; }
    if (isStep(h)) { go(h, false); return true; }
    if (h === 'update') { var u = document.getElementById('update'); if (u) u.open = true; }
    if (initial) { cur = 'start'; render(); }
    return false;
  }

  var h0 = location.hash.replace('#', '');
  if (h0 && !OLD[h0] && !document.getElementById(h0)) { location.replace('/app/#' + h0); return; }

  if (steps.length) {
    if (back) back.addEventListener('click', function () { go(backOf(cur), true); });
    if (next) next.addEventListener('click', function () { go(nextOf(cur), true); });
    document.addEventListener('click', function (e) {
      var a = e.target.closest && e.target.closest('a[href^="#"]');
      if (!a) return;
      var id = a.getAttribute('href').slice(1);
      if (a.dataset.dev) setDev(a.dataset.dev);
      if (isStep(id)) { e.preventDefault(); go(id, true); }
    });
    window.addEventListener('popstate', function () { if (!fromHash(false)) { cur = 'start'; render(); } });
    fromHash(true);
  }

  function apply() {
    var l = lang();
    document.title = d.getAttribute('data-title-' + l) || document.title;
    document.querySelectorAll('img[data-alt-' + l + ']').forEach(function (i) { i.alt = i.getAttribute('data-alt-' + l); });
    if (steps.length) render();
  }
  apply();
  document.addEventListener('sawa-lang', apply); // fired by SawaLang.set() (Sawa_Lang::boot in sawa-site)

  document.querySelectorAll('[data-copy]').forEach(function (b) {
    b.addEventListener('click', function () {
      var t = b.getAttribute('data-copy'), orig = b.innerHTML;
      var done = function () { b.textContent = b.getAttribute('data-done-' + lang()) || 'Copied ✓'; setTimeout(function () { b.innerHTML = orig; }, 2500); };
      if (navigator.clipboard && navigator.clipboard.writeText) navigator.clipboard.writeText(t).then(done, function () {});
      else { var i = document.createElement('input'); i.value = t; document.body.appendChild(i); i.select(); try { document.execCommand('copy'); done(); } catch (e) {} i.remove(); }
    });
  });
})();
