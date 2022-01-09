/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
var hamburger = document.querySelector(".hamburger");
var menuWrapper = document.querySelector(".menu-wrapper");
var overlay = document.querySelector("#dark-overlay");
hamburger.addEventListener("click", function () {
  toggleMenu();
});
overlay.addEventListener("click", function () {
  toggleMenu();
});

var toggleMenu = function toggleMenu() {
  hamburger.classList.toggle("active");
  menuWrapper.classList.toggle("show");
  overlay.classList.toggle("show");
};

var gallery = document.querySelector(".gallery-carousel");

if (gallery) {
  var flkty = new Flickity(gallery, {
    setGallerySize: true,
    adaptiveHeight: true,
    imagesLoaded: true,
    draggable: false,
    wrapAround: true,
    pageDots: false
  });
}

var brand = document.querySelector(".brand");
brand.addEventListener("click", function (e) {
  e.preventDefault();
  var path = window.location.pathname;

  if (path === "/") {
    scrollTo(0, 0);
  } else {
    window.location.href = "/";
  }
});
/******/ })()
;