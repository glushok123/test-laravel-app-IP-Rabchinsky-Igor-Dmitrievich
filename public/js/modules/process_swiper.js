var swiperOnMain = new Swiper("#banner-on-main", {
    cssMode: true,
    slidesPerView: 'auto',
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
    },
    autoplay: {
        delay: 5000,
    },
    loop: true,
    mousewheel: true,
    keyboard: true,
});