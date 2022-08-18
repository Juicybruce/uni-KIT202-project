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

document.querySelectorAll(".expand").forEach( item => { 
  item.addEventListener("click", showContent);
})