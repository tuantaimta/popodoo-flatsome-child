// Simple lazy background loader for elements with data-bg attribute
document.addEventListener('DOMContentLoaded', function(){
  var els = [].slice.call(document.querySelectorAll('[data-bg]'));
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if (entry.isIntersecting) {
          var el = entry.target;
          var src = el.getAttribute('data-bg');
          if (src) {
            el.style.backgroundImage = 'url("' + src + '")';
            el.removeAttribute('data-bg');
            io.unobserve(el);
          }
        }
      });
    }, {rootMargin: '200px'});
    els.forEach(function(el){ io.observe(el); });
  } else {
    // fallback: load all
    els.forEach(function(el){
      var src = el.getAttribute('data-bg');
      if (src) el.style.backgroundImage = 'url("' + src + '")';
      el.removeAttribute('data-bg');
    });
  }
});
