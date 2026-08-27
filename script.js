document.addEventListener('DOMContentLoaded', function () {
 
  var toggle = document.querySelector('.nav-toggle');
  var links = document.querySelector('.nav-links');
  if (toggle && links) {
    toggle.addEventListener('click', function () {
      links.classList.toggle('aberto');
    });
    links.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () { links.classList.remove('aberto'); });
    });
  }

  
  var alvos = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window && alvos.length) {
    var observer = new IntersectionObserver(function (entradas) {
      entradas.forEach(function (entrada) {
        if (entrada.isIntersecting) {
          entrada.target.classList.add('visivel');
          observer.unobserve(entrada.target);
        }
      });
    }, { threshold: 0.15 });
    alvos.forEach(function (el) { observer.observe(el); });
  } else {
    alvos.forEach(function (el) { el.classList.add('visivel'); });
  }
});
