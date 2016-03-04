// http://arresteddeveloper.net/wordpress-infinite-scroll-with-wordpress-posts-and-waypoints-js/

// Chyba z tego zrobić należy objekt

var project_status = $('#finished_projects').attr('data-projects-status');
var ajax_url = jQuery('#projects').attr('data-ajax-url');
var total_finished_projects = jQuery('#finished_projects').attr('data-total-finished-projects');
var total_in_progress_projects = jQuery('#in_progress_projects').attr('data-total-in-progress-projects');
var total_ideas_projects = jQuery('#ideas_projects').attr('data-total-ideas-projects');
var post_offset = 0;
var loaded_finished_projects = 0;

// Skrolujemy do stopki, wtedy uruchamia się funkcja loadProjects()
if (ajax_url) {
  $(window).scroll(function() {
    if ($(window).scrollTop() >= $(document).height() - $(window).height() - 100) {
      if ($('#ideas_projects').is(':visible')) {
        loaded_ideas_projects = $('#ideas_projects').children().length;
        loadProjects('ideas', total_ideas_projects, loaded_ideas_projects);
      }
      else if ($('#in_progress_projects').is(':visible')) {
        loaded_in_progress_projects = $('#in_progress_projects').children().length;
        loadProjects('in_progress', total_in_progress_projects, loaded_in_progress_projects);
      }
      else if ($('#finished_projects').is(':visible')) {
        loaded_finished_projects = $('#finished_projects').children().length;
        loadProjects('finished', total_finished_projects, loaded_finished_projects);
      }
    }
  });
}


function loadProjects(projects_status, total_projects, loaded_projects) {
  post_offset = parseInt(post_offset) + 6;
  console.info("Loaded %s projects: %d/%d",projects_status, loaded_projects, total_projects);

  if (total_projects > loaded_projects) {
    $('.loader').show();
    $.ajax({
      url: ajax_url,
      type: 'POST',
      data: {
        action: 'load_projects',
        post_offset: post_offset,
        projects_status: projects_status,
      },
      success: function(data) {
        $('#' + projects_status + '_projects').append(data);
        // $(data).hide().appendTo('#' + projects_status + '_projects').show(200);
        console.info('Ajax: Loaded more %s projects', projects_status);
        bLazy.revalidate();
        cardExcerpt();
        $('.loader').hide();
      }
    });
  } else {
    return false;
  }
}
