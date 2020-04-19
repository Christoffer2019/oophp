/**
 * Main js
 */
(function () {
    "use strict";

    var mePresentation = document.getElementById("me_presentation");
    var about = document.getElementById("about_img");

    changeImageSize();
    window.onresize = changeImageSize;
    window.onscroll = showLinkToTop;

    function changeImageSize() {
        /**
         * Change image size based on the current width of the browser window.
         */
        var width = window.innerWidth;
        var pathStart = "img/minimalistic/";
        var pathEnd = ".jpg";

        if (width >= 700) {
            if (mePresentation) {
                mePresentation.src = pathStart + "me-presentation480x539" + pathEnd;
            }
            if (about) {
                about.src = pathStart + "about600x399" + pathEnd;
            }
        } else {
            if (mePresentation) {
                mePresentation.src = pathStart + "me-presentation1080x1212" + pathEnd;
            }
            if (about) {
                about.src = pathStart + "about1080x719" + pathEnd;
            }
        }
    }

    function showLinkToTop() {
        /**
         * Hide the link to top button when the top of the page is
         * displayed.
         */
        var currentScrollPos = window.pageYOffset;
        var linkToTop = document.getElementById("link-to-top-page");

        if (currentScrollPos > 0) {
            linkToTop.style.display = "inline-block";
        } else {
            linkToTop.style.display = "none";
        }
    }
}());
