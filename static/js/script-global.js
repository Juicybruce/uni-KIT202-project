// find the anchor with the href that matches the current url and add a styling class to it 
currentLinks = document.querySelectorAll('a');
currentLinks.forEach(function(link) {
  console.log(window.location.pathname.split("/").pop());
  if (link.getAttribute("href") == window.location.pathname.split("/").pop() && link.className == 'link') {
    link.className += ' currentPage';
    console.log("test")
  }
}); 
