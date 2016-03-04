  var bLazy = new Blazy({
    offset: 20,
    selector: '.blazy',
    loadInvisible: false,
    breakpoints: [{
      width: 360, // Max-width
      src: 'data-src-small'
    }],
    success: function(element) {
      $(element).parent().removeClass('loading', 500);
      updateCounter();
    },
    error: function(element, msg) {
      if (msg === 'missing') {
        $(element).parent().removeClass('loading', 500); // Data-src is missing
        console.error("bLazy: data-src is missing");
      } else if (msg === 'invalid') {
        $(element).parent().removeClass('loading', 500);
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

  // tabs(bLazy);
