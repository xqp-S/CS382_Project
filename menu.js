const $hamburger = $('.hamburger');
const $navLinks = $('.nav-links');
const $search = $('Search');
let menuOpen = false;

$hamburger.on('click', () => {
    menuOpen = !menuOpen;
    $navLinks.css('display', menuOpen ? 'block' : 'none');
    $search.css('display', menuOpen ? 'none' : 'block');
});
