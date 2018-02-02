
function resizeHeaderOnScroll() {
  const distanceY = window.pageYOffset || document.documentElement.scrollTop,
  shrinkOn = 200,
  headerEl = document.getElementById('js-header');

  if (distanceY > shrinkOn) {
    headerEl.classList.add("smaller");
  } else {
    headerEl.classList.remove("smaller");
  }
}




window.addEventListener('scroll', resizeHeaderOnScroll);

// window.addEventListener('scroll', resizeImageOnScroll);

// function openNav() {
//     document.getElementById("mySidenav").style.width = "250px";
// }
//
// function closeNav() {
//     document.getElementById("mySidenav").style.width = "0";
// }
