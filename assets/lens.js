/* /lens/ guide: page title and image alt text follow the site language (SawaLang), copy buttons, and old /lens/#something links (the web app's address before /app) go on to /app/. */
(function () {
  var d = document.documentElement;
  function lang() { return d.getAttribute('data-lang') === 'ar' ? 'ar' : 'en'; }
  function apply() {
    var l = lang();
    document.title = d.getAttribute('data-title-' + l) || document.title;
    document.querySelectorAll('img[data-alt-' + l + ']').forEach(function (i) { i.alt = i.getAttribute('data-alt-' + l); });
  }
  apply();
  document.addEventListener('sawa-lang', apply); // fired by SawaLang.set() (Sawa_Lang::boot in sawa-site)

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
