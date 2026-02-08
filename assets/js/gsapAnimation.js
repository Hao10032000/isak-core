(function ($) {
    "use strict";

    // Hàm tổng hợp toàn bộ hiệu ứng GSAP
    var tf_gsap_animations = function ($scope) {
        
        // Đăng ký Plugin nội bộ (đảm bảo các biến được truyền từ script_depends)
        gsap.registerPlugin(ScrollTrigger, SplitText);

        /* 1. Animation Text 
        ---------------------------------------------------------- */
        const animation_text = function () {
            const st = $scope.find(".split-text");
            if (st.length === 0) return;

            st.each(function (index, el) {
                const $el = $(el);
                const $target = $el.find("p, a").length > 0 ? $el.find("p, a")[0] : el;
                
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

                if ($el.hasClass("effect-fade")) settings.opacity = 0;

                if ($el.hasClass("split-lines-transform") || $el.hasClass("split-lines-rotation-x")) {
                    pxl_split.split({
                        type: "lines",
                        lineThreshold: 0.5,
                        linesClass: "split-line",
                    });
                    split_type_set = pxl_split.lines;
                    settings.opacity = 0;
                    settings.stagger = 0.5;
                    if ($el.hasClass("split-lines-rotation-x")) {
                        settings.rotationX = -120;
                        settings.transformOrigin = "top center -50";
                    } else {
                        settings.yPercent = 100;
                        settings.autoAlpha = 0;
                    }
                }

                if ($el.hasClass("split-words-scale")) {
                    pxl_split.split({ type: "words" });
                    split_type_set = pxl_split.words;
                    split_type_set.forEach((elw, i) => {
                        gsap.set(elw, {
                            opacity: 0,
                            scale: i % 2 === 0 ? 0 : 2,
                            force3D: true,
                            duration: 0.1,
                            ease: "power3.out",
                            stagger: 0.02,
                        }, i * 0.01);
                    });
                    gsap.to(split_type_set, {
                        scrollTrigger: { trigger: el, start: "top 86%" },
                        rotateX: "0", scale: 1, opacity: 1,
                    });
                } else if ($el.hasClass("effect-blur-fade")) {
                    pxl_split.split({ type: "lines" });
                    split_type_set = pxl_split.lines;
                    gsap.fromTo(split_type_set, 
                        { opacity: 0, filter: "blur(10px)", y: 20 },
                        {
                            opacity: 1, filter: "blur(0px)", y: 0,
                            duration: 1, stagger: 0.1, ease: "power3.out",
                            scrollTrigger: { trigger: $target, start: "top 86%" }
                        }
                    );
                } else {
                    gsap.from(split_type_set, settings);
                }
            });
        };

        /* 2. Scrolling Effect 
        ---------------------------------------------------------- */
        const scrolling_effect = function () {
            const st = $scope.find(".scrolling-effect");
            st.each(function (index, el) {
                const $el = $(el);
                let delay = parseFloat($el.data("delay")) || 0;
                let settings = {
                    scrollTrigger: {
                        trigger: el, scrub: 3, once: true,
                        toggleActions: "play none none none",
                        start: "30px bottom", end: "bottom bottom", delay: delay,
                    },
                    duration: 0.8, ease: "power3.out",
                };

                if ($el.hasClass("effectRight")) { settings.opacity = 0; settings.x = "80"; }
                if ($el.hasClass("effectLeft")) { settings.opacity = 0; settings.x = "-80"; }
                if ($el.hasClass("effectBottom")) { settings.opacity = 0; settings.y = "100"; }
                if ($el.hasClass("effectTop")) { settings.opacity = 0; settings.y = "-80"; }
                if ($el.hasClass("effectZoomIn")) { settings.opacity = 0; settings.scale = 0.4; }

                gsap.from(el, settings);
            });
        };

        /* 3. Flip Animation (gsapA2)
        ---------------------------------------------------------- */
        const gsapA2 = () => {
            const $container = $scope.find(".gsap-anime-2");
            if (!$container.length) return;
            const cards = $container.find(".flip-image").get();

            function animate() {
                const isMobile = window.innerWidth < 575;
                const cardW = 150; const cardH = 150;
                const parent = $container[0];
                const centerX = parent.clientWidth / 2 - cardW / 2;
                const centerY = parent.clientHeight / 2 - cardH / 2;

                cards.forEach((card, i) => {
                    card.style.position = "absolute";
                    card.style.zIndex = i + 1;
                });

                const tl = gsap.timeline({
                    defaults: { ease: "power3.out" },
                    scrollTrigger: { trigger: $container[0], start: "top 80%", toggleActions: "play none none reverse" }
                });

                tl.to(cards, { x: centerX, y: centerY, opacity: 1, duration: 1, stagger: 0.1 })
                  .to(cards, {
                    x: (i) => centerX + (i === 0 ? -225 : i === 1 ? -135 : i === 2 ? -45 : i === 3 ? 45 : i === 4 ? 135 : 225) * (isMobile ? 0.6 : 1),
                    y: (i) => centerY + (i === 0 ? -150 : i === 1 ? -90 : i === 2 ? -30 : i === 3 ? 30 : i === 4 ? 90 : 150) * (isMobile ? 0.6 : 1),
                    rotation: -10, rotateX: 4, rotateY: 10, duration: 1, ease: "power2.out", delay: 0.3
                });
            }
            animate();
        };

        /* 4. Scroll Effect Fade 
        ---------------------------------------------------------- */
        const scrollEffectFade = () => {
            $scope.find(".effectFade").each(function() {
                const el = this;
                let fromVars = { autoAlpha: 0 };
                let toVars = { autoAlpha: 1, duration: 1, ease: "power3.out" };
                let delay = el.dataset.delay ? parseFloat(el.dataset.delay) : 0;
                toVars.delay = delay;

                if (el.classList.contains("fadeUp")) { fromVars.y = 50; toVars.y = 0; }
                else if (el.classList.contains("fadeDown")) { fromVars.y = -50; toVars.y = 0; }
                else if (el.classList.contains("fadeLeft")) { fromVars.x = -50; toVars.x = 0; }
                else if (el.classList.contains("fadeRight")) { fromVars.x = 50; toVars.x = 0; }
                else if (el.classList.contains("fadeZoom")) { fromVars.scale = 0.8; toVars.scale = 1; }

                gsap.set(el, fromVars);
                gsap.to(el, { ...toVars, scrollTrigger: { trigger: el, start: "top 96%", toggleActions: "play none none none" } });
            });
        };

        /* 5. Scroll Line & Progress & SVG
        ---------------------------------------------------------- */
        const scrollLine = () => {
            if ($scope.find(".scroll-down").length) {
                gsap.set(".prg-line", { height: "0%" });
                gsap.to(".prg-line", { height: "100%", ease: "none", scrollTrigger: { trigger: ".scroll-down", start: "top 40%", end: "bottom 30%", scrub: true } });
                $scope.find(".timeline-item").each(function() {
                    ScrollTrigger.create({ trigger: this, start: "top 30%", onEnter: () => this.classList.add("active"), onLeaveBack: () => this.classList.remove("active") });
                });
            }
        };

        const techProgress = () => {
            $scope.find(".progress-line").each(function() {
                gsap.fromTo(this, { width: "15%" }, {
                    width: this.dataset.progress + "%", duration: 1.5, ease: "power3.out",
                    scrollTrigger: { trigger: this, start: "top 80%", toggleActions: "play none none none" }
                });
            });
        };

        const drawSvg = () => {
            const $svg = $scope.find(".scribble");
            if ($svg.length) {
                const path = $svg.find("#scribblePath")[0];
                const len = path.getTotalLength();
                path.style.setProperty("--len", len);
                const io = new IntersectionObserver(([entry]) => {
                    if (entry.isIntersecting) { $svg.addClass("is-drawn"); io.disconnect(); }
                }, { threshold: 0.2 });
                io.observe($svg[0]);
            }
        };

        // Chạy tất cả
        animation_text();
        scrolling_effect();
        gsapA2();
        scrollEffectFade();
        scrollLine();
        techProgress();
        drawSvg();
    };

    // Đăng ký Hook cho Elementor
    $(window).on("elementor/frontend/init", function () {
        // Thay 'tf-brand' bằng widget_name thực tế của bạn
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tf-brand.default",
            tf_gsap_animations
        );
    });

})(jQuery);