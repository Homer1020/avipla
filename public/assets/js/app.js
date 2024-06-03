$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        items: 1,
        dots: false,
        nav: false
    });
});

/**
 * HEADER STICKY
 */
const $header = document.getElementById('header')

if($header) {
    const handleScroll = e => {
        if(window.scrollY >= 100) {
            $header.classList.add('fixed')
        } else if ($header.classList.contains('fixed')) {
            $header.classList.remove('fixed')
        }
    }

    document.addEventListener('DOMContentLoaded', handleScroll)
    window.addEventListener('scroll', handleScroll)
}

const $offCanvas = document.getElementById('offcanvasExample')
const $btnToggle = document.getElementById('toggle')

if($offCanvas) {

    $offCanvas.addEventListener('hide.bs.offcanvas', event => {
        $btnToggle.classList.remove('expanded')
    })
    $offCanvas.addEventListener('show.bs.offcanvas', event => {
        $btnToggle.classList.add('expanded')
    })
}