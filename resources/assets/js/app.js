$(function() {
  $('.close-alert').on('click', function(e) {
    e.preventDefault();
    $(this).parent().fadeOut();
  })
  $('#rightbar').on('click', '#changeclass', function(e) {
    e.preventDefault();
    var href = $(this).attr('href')+'_ajax';
    $.get(href, function(data) {
        $("#app").removeClass().addClass(data);
    })
  });
  
});