/* /lens/ guide: language switch (English | العربية), copy buttons, and old /lens/#something links (the web app's address before /app) go on to /app/.
   The language is set before paint by the inline script in the page head; this file handles the toggle:
   sawaSetLang('en'|'ar') changes html[data-lang], lang, dir, the title, image alt text, and remembers it in localStorage "sawa_lang". */
(function () {
  var d = document.documentElement;
  function lang() { return d.getAttribute('data-lang') === 'ar' ? 'ar' : 'en'; }
  function apply(l) {
    d.setAttribute('data-lang', l); d.lang = l; d.dir = l === 'ar' ? 'rtl' : 'ltr';
    document.title = d.getAttribute('data-title-' + l) || document.title;
    document.querySelectorAll('img[data-alt-' + l + ']').forEach(function (i) { i.alt = i.getAttribute('data-alt-' + l); });
    document.querySelectorAll('[data-set-lang]').forEach(function (b) { b.setAttribute('aria-pressed', String(b.getAttribute('data-set-lang') === l)); });
  }
  window.sawaSetLang = function (l) {
    if (l !== 'ar') l = 'en';
    try { localStorage.setItem('sawa_lang', l); } catch (e) {}
    apply(l);
  };
  apply(lang());
  document.querySelectorAll('[data-set-lang]').forEach(function (b) {
    b.addEventListener('click', function () { window.sawaSetLang(b.getAttribute('data-set-lang')); });
  });

  var h = location.hash.replace('#', '');
  if (h && !document.getElementById(h)) { location.replace('/app/#' + h); return; }

  document.querySelectorAll('[data-copy]').forEach(function (b) {
    b.addEventListener('click', function () {
      var t = b.getAttribute('data-copy'), orig = b.innerHTML;
      var done = function () { b.textContent = b.getAttribute('data-done-' + lang()) || 'Copied ✓'; setTimeout(function () { b.innerHTML = orig; }, 2500); };
      if (navigator.clipboard && navigator.clipboard.writeText) navigator.clipboard.writeText(t).then(done, function () {});
      else { var i = document.createElement('input'); i.value = t; document.body.appendChild(i); i.select(); try { document.execCommand('copy'); done(); } catch (e) {} i.remove(); }
    });
  });
})();
