(function ($) {
    function tf_testimonials($scope) {

        const $mainSwiperEl = $scope.find(".swiper-testimonial");
        const $thumbSwiperEl = $scope.find(".sw-main-image");

        if ($mainSwiperEl.length > 0) {
            const thumbSwiper = new Swiper($thumbSwiperEl[0], {
                slidesPerView: 1,
                spaceBetween: 10,
                centeredSlides: true,
                watchSlidesProgress: true,
            });

            const mainSwiper = new Swiper($mainSwiperEl[0], {
                slidesPerView: 1,
                pagination: {
                    el: $scope.find(".number-pagination")[0],
                    type: "fraction",
                },
                navigation: {
                    nextEl: $scope.find(".sw-nav-next")[0],
                    prevEl: $scope.find(".sw-nav-prev")[0],
                },
            });
            thumbSwiper.controller.control = mainSwiper;
            mainSwiper.controller.control = thumbSwiper;
        }
    }

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tf-testimonial.default",
            tf_testimonials
        );
    });
})(jQuery);

