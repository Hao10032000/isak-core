/**
 * Infinite Slide
 * Update Clock
 * Setting Color
 * Counter
 * Cursor Image Hover
 * Switch Mode
 * Text Rotate
 * Draw Svg
 * Active Class
 * Wrap Active
 * Animation Text Typing
 * Scroll Link
 * Handle Open Menu
 */

(function ($) {
    "use strict";
    /* Infinite Slide 
    ---------------------------------------------------------- */
    var infiniteSlide = function () {
        if ($(".infiniteSlide").length > 0) {
            $(".infiniteSlide").each(function () {
                var $this = $(this);
                var style = $this.data("style") || "left";
                var clone = $this.data("clone") || 2;
                var speed = $this.data("speed") || 50;
                $this.infiniteslide({
                    speed: speed,
                    direction: style,
                    clone: clone,
                    pauseonhover: true,
                });
            });
        }
    };

    /* Update Clock
    ---------------------------------------------------------- */
    var updateClock = () => {
        function startClocks(container = ".time-local") {
            function updateClock() {
                const now = new Date();

                const timeString = now.toLocaleTimeString("en-GB", {
                    hour: "2-digit",
                    minute: "2-digit",
                });

                const dateString = now.toLocaleDateString("en-US", {
                    weekday: "short",
                    month: "short",
                    day: "numeric",
                });

                document.querySelectorAll(container).forEach((el) => {
                    const dateEl = el.querySelector(".date");
                    const clockEl = el.querySelector(".clock");

                    if (dateEl) dateEl.textContent = dateString;
                    if (clockEl) clockEl.textContent = timeString;
                });
            }

            updateClock();
            setInterval(updateClock, 1000);
        }

        startClocks(".time-local");
    };

    /* Setting Color
    ---------------------------------------------------------- */
    const settingColor = () => {
        if (!$(".settings-color").length) return;

        const buttons = document.querySelectorAll(".choose-item");
        const body = document.body;

        buttons.forEach((btn, index) => {
            btn.addEventListener("click", () => {
                const isLight = btn.classList.contains("theme-light");
                const num = (index % 3) + 1;
                const bodyClass = `${isLight ? "body-v" : "dark-v"}${num}`;
                const sameGroupSelector = `.choose-item.${isLight ? "theme-light" : "theme-dark"}`;

                if (btn.classList.contains("active")) {
                    btn.classList.remove("active");
                    body.classList.remove(bodyClass);
                    return;
                }

                document.querySelectorAll(sameGroupSelector).forEach((b) => b.classList.remove("active"));

                btn.classList.add("active");

                body.classList.forEach((cls) => {
                    if (cls.startsWith(isLight ? "body-v" : "dark-v")) {
                        body.classList.remove(cls);
                    }
                });

                body.classList.add(bodyClass);
            });
        });
    };

    /* Counter
    ---------------------------------------------------------- */
    
    var counter = function () {
        const counters = document.querySelectorAll('.number');

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.getAttribute('data-to'));
                    const duration = parseInt(el.getAttribute('data-speed')) || 2000;

                    let startTimestamp = null;
                    const step = (timestamp) => {
                        if (!startTimestamp) startTimestamp = timestamp;
                        const progress = Math.min((timestamp - startTimestamp) / duration, 1);

                        el.innerText = Math.floor(progress * target).toLocaleString();

                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        } else {
                            el.innerText = target.toLocaleString();
                        }
                    };

                    window.requestAnimationFrame(step);
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => observer.observe(counter));
    };

    /* Cursor Image Hover
    ---------------------------------------------------------- */
    var hoverImgCursor = function () {
        let offsetX = 20;
        let offsetY = 20;
        $(".hover-cursor-img").on("mousemove", function (e) {
            let hoverImage = $(this).find(".hover-image");
            hoverImage.css({
                top: e.clientY + offsetY + "px",
                left: e.clientX + offsetX + "px",
            });
        });

        $(".hover-cursor-img").on("mouseenter", function () {
            let hoverImage = $(this).find(".hover-image");
            hoverImage.css({
                transform: "scale(1)",
                opacity: 1,
            });
        });

        $(".hover-cursor-img").on("mouseleave", function () {
            let hoverImage = $(this).find(".hover-image");
            hoverImage.css({
                transform: "scale(0)",
                opacity: 0,
            });
        });
    };

    /* Text Rotate
    ---------------------------------------------------------- */
    var textRotate = function () {
    if ($(".wg-curve-text").length > 0) {
        if ($(".text-rotate").length > 0) {
            
            $(".text-rotate .text").each(function () {
                const $circularText = $(this);
                
                // LẤY TEXT TỪ DATA ATTRIBUTE (Nếu không có thì dùng text mặc định)
                const text = $circularText.data("text") || "award winning agency - since 2022 -";
                
                const chars = text.split("");
                const degree = 360 / chars.length;

                $circularText.empty();
                chars.forEach((char, i) => {
                    const $span = $("<span></span>")
                        .text(char)
                        .css({
                            transform: `rotate(${i * degree}deg)`,
                        });
                    $circularText.append($span);
                });
            });
        }
    }
};

    /* Active Class
    ---------------------------------------------------------- */
    var activeClass = () => {
        function checkInView() {
            const elements = document.querySelectorAll(".intro-title span");

            elements.forEach((el) => {
                if (el.classList.contains("active")) return;

                const rect = el.getBoundingClientRect();
                const inView = rect.top < window.innerHeight * 0.8 && rect.bottom > 0;

                if (inView) {
                    setTimeout(() => {
                        el.classList.add("active");
                    }, 300);
                }
            });
        }

        window.addEventListener("scroll", checkInView);
        window.addEventListener("load", checkInView);
    };

    /* Wrap Active
    ---------------------------------------------------------- */
    var wrapActive = () => {
        $(window).on("scroll", function () {
            $(".wrap-hover-award").each(function () {
                let $this = $(this);
                let top = $this.offset().top;
                let bottom = top + $this.outerHeight();
                let scrollTop = $(window).scrollTop();
                let windowBottom = scrollTop + $(window).height();

                if (bottom > scrollTop && top < windowBottom) {
                    $this.addClass("active");
                } else {
                    $this.removeClass("active");
                }
            });
        });
    };

    /* Animation Text Typing
    ---------------------------------------------------------- */
    var textTyping = () => {
        if ($(".text-typing").length > 0) {
            const words = ["Isak", "Designer", "Developer"];
            const typedEl = document.getElementById("typed");

            let wordIndex = 0;
            let charIndex = 0;
            let deleting = false;

            const typeSpeed = 100;
            const deleteSpeed = 50;
            const delayBetweenWords = 1200;

            function type() {
                const currentWord = words[wordIndex];

                if (!deleting) {
                    typedEl.textContent = currentWord.slice(0, ++charIndex);

                    if (charIndex === currentWord.length) {
                        deleting = true;
                        setTimeout(type, delayBetweenWords);
                        return;
                    }
                } else {
                    typedEl.textContent = currentWord.slice(0, --charIndex);

                    if (charIndex === 0) {
                        deleting = false;
                        wordIndex = (wordIndex + 1) % words.length;
                    }
                }

                setTimeout(type, deleting ? deleteSpeed : typeSpeed);
            }

            type();
        }
    };

    /* Scroll Link
    ---------------------------------------------------------- */
    var scrollLink = function () {
        let sectionIds = $("a.scroll-link");
        $(document).on("scroll", function () {
            sectionIds.each(function () {
                let container = $(this).attr("href");

                if (!container || container === "#") return;

                if (!$(container).length) return;

                let containerOffset = $(container).offset().top;
                let containerHeight = $(container).outerHeight();
                let containerBottom = containerOffset + containerHeight;
                let scrollPosition = $(document).scrollTop();

                if (scrollPosition < containerBottom - 20 && scrollPosition >= containerOffset - 20) {
                    $(this).addClass("active");
                } else {
                    $(this).removeClass("active");
                }
            });
        });
    };

    /* Contact Form
    ---------------------------------------------------------- */

    
    // Dom Ready
    $(function () {
        scrollLink();
        textRotate();
        updateClock();
        counter();
        settingColor();
        hoverImgCursor();
        activeClass();
        wrapActive();
        textTyping();
    });

    
    $(window).on('elementor/frontend/init', function() {        
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tf-split-text.default', infiniteSlide );
    });
})(jQuery);
