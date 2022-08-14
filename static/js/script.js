console.log("Script loaded!");
console.log(window.location.pathname)

// find the anchor with the href that matches the current url and add a styling class to it 
currentLinks = document.querySelectorAll('a');
currentLinks.forEach(function(link) {
  if ('/' + link.getAttribute("href") == window.location.pathname && link.className == 'link') {
    link.className += ' currentPage';
  }
}); 

// event handler for clicking to expand an archive 
function showContent (event) {
  if(event.target.classList.contains("expand")){
    content = event.target.parentNode.querySelector('.post-content');
    arrow = event.target.querySelector('i');

    content.classList.toggle("hidden");

    arrow.classList.toggle("fa-angle-down");
    arrow.classList.toggle("fa-angle-up");
  }

}
if (window.location.pathname == '/archive.html') {
  console.log(document.querySelectorAll(".expand"));
  document.querySelectorAll(".expand").forEach( item => { 
    console.log(item);
    item.addEventListener("click", showContent);
  })
}