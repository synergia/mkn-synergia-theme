// Dropdown download button //
// http://codepen.io/georgehastings/pen/vptdb
$(".dropdown").on("click", function(event) {
  $(this).toggleClass("flip");
  event.stopPropagation();
  console.info("Dropdown-download opened");
});
$(document).on("click", function(event) {
  $(".dropdown").removeClass("flip");
  console.info("Dropdown-download closed");
});
