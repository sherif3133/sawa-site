/* /lens/ guide: copy buttons, and old /lens/#something links (the web app's address before /app) go on to /app/. */
(function () {
  var h = location.hash.replace('#', '');
  if (h && !document.getElementById(h)) { location.replace('/app/#' + h); return; }
  document.querySelectorAll('[data-copy]').forEach(function (b) {
    b.addEventListener('click', function () {
      var t = b.getAttribute('data-copy'), done = function () { var o = b.textContent; b.textContent = 'اتنسخ ✓ الصقه في شريط العنوان'; setTimeout(function () { b.textContent = o; }, 2500); };
      if (navigator.clipboard && navigator.clipboard.writeText) navigator.clipboard.writeText(t).then(done, function () {});
      else { var i = document.createElement('input'); i.value = t; document.body.appendChild(i); i.select(); try { document.execCommand('copy'); done(); } catch (e) {} i.remove(); }
    });
  });
})();
