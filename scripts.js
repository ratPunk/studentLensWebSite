window.addEventListener('scroll', function() {
    var textElement = document.querySelector('.animated-text');
    var textPosition = textElement.getBoundingClientRect().top;
    var windowHeight = window.innerHeight;
    if (textPosition < windowHeight) {
      textElement.classList.add('visible');
      window.removeEventListener('scroll', arguments.callee);
    }
  });