(function ($) {
    "use strict";

    /*========== Animation Text Handler ==========*/
    var animation_text_handler = function ($scope) {
        // Sử dụng $scope.find để chỉ tác động vào widget hiện tại
        var st = $scope.find(".split-text");
        if (st.length === 0) return;

        // Đăng ký plugin một lần
        gsap.registerPlugin(SplitText, ScrollTrigger);

        st.each(function (index, el) {
            const $el = $(el);
            const $target = $el.find("p, a").length > 0 ? $el.find("p, a")[0] : el;
            const hasClass = (className) => $el.hasClass(className);

            const pxl_split = new SplitText($target, {
                type: "words, chars",
                lineThreshold: 0.5,
                linesClass: "split-line",
            });

            let split_type_set = pxl_split.chars;
            gsap.set($target, { opacity: 1, perspective: 400 });

            const settings = {
                scrollTrigger: {
                    trigger: $target,
                    start: "top 86%",
                    toggleActions: "play none none none",
                },
                duration: 0.9,
                stagger: 0.02,
                ease: "power3.out",
            };

            if (hasClass("effect-fade")) settings.opacity = 0;

            if (hasClass("split-lines-transform") || hasClass("split-lines-rotation-x")) {
                pxl_split.split({
                    type: "lines",
                    lineThreshold: 0.5,
                    linesClass: "split-line",
                });
                split_type_set = pxl_split.lines;
                settings.opacity = 0;
                settings.stagger = 0.5;
                if (hasClass("split-lines-rotation-x")) {
                    settings.rotationX = -120;
                    settings.transformOrigin = "top center -50";
                } else {
                    settings.yPercent = 100;
                    settings.autoAlpha = 0;
                }
            }

            if (hasClass("split-words-scale")) {
                pxl_split.split({ type: "words" });
                split_type_set = pxl_split.words;
                split_type_set.forEach((elw, idx) => {
                    gsap.set(elw, {
                        opacity: 0,
                        scale: idx % 2 === 0 ? 0 : 2,
                        force3D: true,
                        duration: 0.1,
                        ease: "power3.out",
                        stagger: 0.02,
                    }, idx * 0.01);
                });
                gsap.to(split_type_set, {
                    scrollTrigger: {
                        trigger: el,
                        start: "top 86%",
                    },
                    rotateX: "0",
                    scale: 1,
                    opacity: 1,
                });
            } else if (hasClass("effect-blur-fade")) {
                pxl_split.split({ type: "lines" });
                split_type_set = pxl_split.lines;
                gsap.fromTo(
                    split_type_set,
                    { opacity: 0, filter: "blur(10px)", y: 20 },
                    {
                        opacity: 1,
                        filter: "blur(0px)",
                        y: 0,
                        duration: 1,
                        stagger: 0.1,
                        ease: "power3.out",
                        scrollTrigger: {
                            trigger: $target,
                            start: "top 86%",
                            toggleActions: "play none none none",
                        },
                    }
                );
            } else {
                gsap.from(split_type_set, settings);
            }
        });

        // Gọi luôn hàm infiniteSlide cho cùng một widget nếu cần
        infiniteSlide_handler($scope);
    };

    /*========== Infinite Slide Handler ==========*/
    var infiniteSlide_handler = function ($scope) {
        var $slide = $scope.find(".infiniteSlide");
        if ($slide.length > 0) {
            $slide.each(function () {
                var $this = $(this);
                var style = $this.data("style") || "left";
                var clone = $this.data("clone") || 2;
                var speed = $this.data("speed") || 50;
                // Đảm bảo thư viện infiniteslide đã được enqueue
                if ($.isFunction($.fn.infiniteslide)) {
                    $this.infiniteslide({
                        speed: speed,
                        direction: style,
                        clone: clone,
                        pauseonhover: true,
                    });
                }
            });
        }
    };

    /*========== Register Elementor Hooks ==========*/
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tf-split-text.default",
            animation_text_handler
        );
    });

})(jQuery);

