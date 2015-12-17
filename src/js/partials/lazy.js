$(document).ready(function bLazy_f() {
  var bLazy = new Blazy({
    offset: 20,
    selector: '.blazy',
    loadInvisible: false,
    success: function() {
      updateCounter();
    },
    error: function(ele, msg) {
      if (msg === 'missing') {
        // Data-src is missing
        console.error("bLazy: data-src is missing");
      } else if (msg === 'invalid') {
        // Data-src is invalid
        console.error("bLazy: data-src is invalid");

      }
    }
  });
  // not needed, only here to illustrate amount of loaded images
  var imageLoaded = 0;
  function updateCounter() {
    imageLoaded++;
    console.info("bLazy: Images loaded: %d", imageLoaded);
  }

  tabs(bLazy);
});
