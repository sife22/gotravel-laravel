(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($("#spinner").length > 0) {
                $("#spinner").removeClass("show");
            }
        }, 1);
    };
    spinner();

    // Initiate the wowjs
    new WOW().init();

    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 0) {
            $(".navbar").addClass("sticky-top shadow-sm");
        } else {
            $(".navbar").removeClass("sticky-top shadow-sm");
        }
    });

    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";

    $(window).on("load resize", function () {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
                function () {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass);
                },
                function () {
                    const $this = $(this);
                    $this.removeClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "false");
                    $this.find($dropdownMenu).removeClass(showClass);
                }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });

    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $(".back-to-top").fadeIn("slow");
        } else {
            $(".back-to-top").fadeOut("slow");
        }
    });
    $(".back-to-top").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
        return false;
    });

    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav: false,
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            992: {
                items: 3,
            },
        },
    });
})(jQuery);

// // Récupérer tous les liens de la barre de navigation
// const navLinks = document.querySelectorAll(".nav-link");
// const drops = document.querySelectorAll(".dropdown-toggle");

// // Parcourir les liens et vérifier s'ils correspondent à la page actuelle
// navLinks.forEach((link) => {
//     // Vérifier si le lien correspond à la page actuelle
//     if (link.href === window.location.href) {
//         // Ajouter la classe "active" au lien correspondant à la page actuelle
//         link.classList.add("active");
//     } else {
//         // Retirer la classe "active" des liens qui ne correspondent pas à la page actuelle
//         link.classList.remove("active");
//     });

// drops.forEach((drop) => {
//     if (window.location.href === '/connexion/client' || window.location.href === '/connexion/agence'){
//         drop.classList.add('active');
//     };
// });

// Attendez que le document soit chargé
document.addEventListener("DOMContentLoaded", function (event) {
    // Fonction de défilement automatique horizontal
    function scrollHorizontally() {
        // Définir le délai en millisecondes
        var delay = 1000; // 3 secondes

        // Utiliser setTimeout pour déclencher le défilement horizontal
        setTimeout(function () {
            // Récupérer la section des voyages
            var voyagesSection = document.querySelector(".voyage");

            // Calculer la largeur totale de la section des voyages
            var voyagesSectionWidth = voyagesSection.scrollWidth;

            // Faire défiler horizontalement la section des voyages
            voyagesSection.scrollTo({
                left: voyagesSectionWidth,
                behavior: "smooth",
            });
        }, delay);
    }

    // Appeler la fonction de défilement automatique horizontal
    scrollHorizontally();
});
