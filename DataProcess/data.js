
let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e) => {
    let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
    arrowParent.classList.toggle("showMenu");
  });
}
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});
$('.nav-link').on('click', function() {
  $('.nav-link').removeClass('active');
  $(this).addClass('active');
});
$('a[data-url]').on('click', function(e) {
  e.preventDefault(); // prevent the link from reloading the page
  var url = $(this).data('url'); // get the URL from the data-url attribute
  $.ajax({
    url: url,
    type: 'GET',
    dataType: 'html',
    success: function(data) {
      // display the table data in a container element
      $('#main-content').html(data);
    },
    error: function(xhr, status, error) {
      // handle any errors that occur during the AJAX request
      console.log(xhr);
      console.log(status);
      console.log(error);
    }
  });
});