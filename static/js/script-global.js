// find the anchor with the href that matches the current url and add a styling class to it 
currentLinks = document.querySelectorAll('a');
currentLinks.forEach(function(link) {
  if ('/' + link.getAttribute("href") == window.location.pathname && link.className == 'link') {
    link.className += ' currentPage';
  }
}); 