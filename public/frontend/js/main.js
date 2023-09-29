$(()=>{

// start Slider
$('.owl-one').owlCarousel({
    loop:true,
    margin:0,
    rtl:true,
    nav:true,
    dots: false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:3
        }
    }
})
$('.owl-two').owlCarousel({
    items: 4,
    loop: true,
    rtl:true,
    nav: false,
    dots: true,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 2500
})

});