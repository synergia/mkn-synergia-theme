// http://arresteddeveloper.net/wordpress-infinite-scroll-with-wordpress-posts-and-waypoints-js/

  var project_status = jQuery('#finished_projects').attr('data-projects-status');
  var ajax_url = jQuery('#projects').attr('data-ajax-url');
  var total_finished_projects = jQuery('#finished_projects').attr('data-total-finished-projects');
  var post_offset = 0;
  var loaded_finished_projects = 0;

// Skrolujemy do stopki, wttedy uruchamia się funkcja loadProjects()
// Funkcja uruchamia się, gdy pobranych elementów jest mnniej, niż istnieje.
  $(window).scroll(function() {
    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
      loaded_finished_projects = $('#finished_projects').children().length;
      console.info("Loaded finished projects: %d/%d", loaded_finished_projects, total_finished_projects);
      if (total_finished_projects > loaded_finished_projects) {
        return loadProjects();
      } else {
        return false;
      }
    }
  });

  function loadProjects() {
    post_offset = parseInt(post_offset) + 6;

    $.ajax({
      url: ajax_url,
      type: 'POST',
      data: {
        action: 'load_projects',
        post_offset: post_offset,
      },
      success: function(data) {
        $('#finished_projects').append(data);
        console.info('Ajax: Loaded more projects');
        bLazy.revalidate();
        cardExcerpt();
      }
    });
  }
