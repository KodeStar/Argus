$(function() {
  $('.close-alert').on('click', function(e) {
    e.preventDefault();
    $(this).parent().fadeOut();
  })
});