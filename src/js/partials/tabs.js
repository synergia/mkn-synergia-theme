function tabs(bLazy) {
  // set active radio to address bar
  $(document).on('click', '.tabs .tabs-nav label', function() {
    var tab_nr = $(this).attr('for');
    var hash = '#' + tab_nr;
    window.history.replaceState('', '', hash);
    if(tab_nr === 'tab-1'){
      bLazy.load($('.tab:nth-of-type(1) .blazy'), true);
    } else if (tab_nr === 'tab-2') {
      bLazy.load($('.tab:nth-of-type(2) .blazy'), true);
    }else if (tab_nr === 'tab-3') {
      bLazy.load($('.tab:nth-of-type(3) .blazy'), true);
    }

  });
  // select active radio based on hash
  $(document.location.hash).prop('checked', true);
}
