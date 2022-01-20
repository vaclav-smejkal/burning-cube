/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
var menuWrapper = document.querySelector(".menu-wrapper");
var hamburger = document.querySelector(".hamburger");
var overlay = document.querySelector("#dark-overlay");
var menuItems = document.querySelectorAll(".menu a");
hamburger.addEventListener("click", function () {
  toggleMenu();
});
overlay.addEventListener("click", function () {
  toggleMenu();
});
menuItems.forEach(function (item) {
  item.addEventListener("click", function () {
    if (window.innerWidth <= 992) {
      toggleMenu();
    }
  });
});

var toggleMenu = function toggleMenu() {
  hamburger.classList.toggle("active");
  menuWrapper.classList.toggle("show");
  overlay.classList.toggle("show");
  document.querySelector("body").classList.toggle("scroll-lock");
  document.querySelector("html").classList.toggle("scroll-lock");
};

var gallery = document.querySelector(".gallery-carousel");

if (gallery) {
  var flkty = new Flickity(gallery, {
    adaptiveHeight: true,
    imagesLoaded: true,
    draggable: true,
    wrapAround: true,
    pageDots: false
  });
  flkty.on("staticClick", function (event, pointer, cellElement, cellIndex) {
    flkty.selectCell(cellElement);
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
var collapseBtns = document.querySelectorAll(".btn-collapse");

if (collapseBtns.length) {
  collapseBtns.forEach(function (btn) {
    btn.addEventListener("click", function (e) {
      btn.classList.toggle("collapsed");
      var i = e.target.dataset.cardCollapse;
      var cardCollapse = document.querySelectorAll(".card-collapse." + i);
      cardCollapse.forEach(function (collapse) {
        collapse.classList.toggle("show");
      });
    });
  });
}

var navbar = document.querySelector("#navbar");
window.addEventListener("scroll", function () {
  if (scrollY > 100) {
    navbar.classList.add("scrolling");
  } else {
    navbar.classList.remove("scrolling");
  }
});
document.querySelectorAll("a").forEach(function (a) {
  a.addEventListener("click", function () {
    document.querySelector("html").classList.add("smooth-scroll");
  });
});
/******/ })()
;