var s = !1,
    hov_timeout = 0;
jQuery.fn.isMobile = function() {
    return /Android|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent || navigator.vendor || window.opera)
};

var inputElem = document.createElement("input"),
    attrs = {};

Modernizr.input = function(a) {
    for (var b = 0, c = a.length; c > b; b++) attrs[a[b]] = a[b] in inputElem;
    return attrs
}("autocomplete autofocus list placeholder max min multiple pattern required step".split(" ")), Modernizr.input.placeholder ? jQuery(document.documentElement).addClass("placeholder") : jQuery(document.documentElement).addClass("no-placeholder"),
		
function(a) {
	// Open main navigation
	a(".mobile_toggle").on("click", function(b) {
        a(document.documentElement).toggleClass("mobile_opened"), b.preventDefault()
    })
}(jQuery);;