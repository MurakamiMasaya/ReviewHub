/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************!*\
  !*** ./resources/js/adjustTopMargin.js ***!
  \*****************************************/
document.addEventListener("DOMContentLoaded", function () {
  adjustTopMargin();
  window.addEventListener('resize', function () {
    adjustTopMargin();
  });
});

function adjustTopMargin() {
  var nav = document.querySelector("#nav");
  var main = document.querySelector("#main");
  navHight = nav.offsetHeight;
  main.style.marginTop = navHight + 'px';
}
/******/ })()
;