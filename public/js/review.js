/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/review.js ***!
  \********************************/
document.addEventListener("DOMContentLoaded", function () {
  var reviewIcon = document.querySelector("#review-icon");
  var reviewOpen = document.querySelector('#review-open');
  var reviewArea = document.querySelector('#review-area');
  reviewIcon.addEventListener('click', function () {
    if (reviewOpen.className !== 'hidden') {
      reviewOpen.classList.add('hidden');
      reviewArea.classList.remove('hidden');
    } else {
      reviewOpen.classList.remove('hidden');
      reviewArea.classList.add('hidden');
    }
  });
  reviewOpen.addEventListener('click', function () {
    reviewArea.classList.remove('hidden');
    reviewOpen.classList.add('hidden');
  });
});
/******/ })()
;