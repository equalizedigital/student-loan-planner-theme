!function($){const e=$("#main-navigation"),t=$("#nav-icon");let n=$(".zight-mobile-tab-toggle");$('a[href*="#"]').not('[href="#"]').not('[href="#0"]').not('[href="#main-content"]').not(".features_buttons_acc a").click((function(e){if(location.pathname.replace(/^\//,"")==this.pathname.replace(/^\//,"")&&location.hostname==this.hostname){var t=$(this.hash);(t=t.length?t:$("[name="+this.hash.slice(1)+"]")).length&&(e.preventDefault(),$("html, body").animate({scrollTop:t.offset().top},1e3,(function(){var e=$(t);if(e.focus(),e.is(":focus"))return!1;e.attr("tabindex","-1"),e.focus()})))}})),document.addEventListener("DOMContentLoaded",(function(){if(window.innerWidth<=768){var e=document.querySelectorAll(".menu-item-main-link"),t=document.querySelectorAll(".site-header");e.forEach((function(e){e.addEventListener("click",(function(e){e.preventDefault(),this.classList.toggle("active"),this.parentNode.classList.toggle("active");var n=this.nextElementSibling;n&&n.classList.contains("sub_menu")&&n.classList.toggle("active"),t.forEach((function(e){e.classList.toggle("site-header-active")}))}))}))}var n;document.querySelectorAll(".sub_menu_back").forEach((function(e){e.addEventListener("click",(function(e){e.preventDefault();var n=this.closest(".sub_menu");n&&n.classList.remove("active"),t.forEach((function(e){e.classList.remove("site-header-active")}))}))})),window.innerWidth>=768&&(document.getElementById("menu_search_btn").addEventListener("click",(function(){var e=document.querySelector(".search-popup");e&&e.classList.add("active")})),document.querySelector("#search").addEventListener("input",(function(){var e=document.querySelector(".search-popup");e&&e.classList.add("input-active")})),document.getElementById("close-search").addEventListener("click",(function(){var e=document.querySelector(".search-popup");e&&e.classList.remove("active")})))})),t.click((function(){$(this).toggleClass("open"),"false"===$(this).attr("aria-expanded")?$(this).attr("aria-expanded","true"):$(this).attr("aria-expanded","false"),!e.hasClass("menu-mobile-open")&&e.toggleClass("menu-mobile-open"),$(window).scrollTop()>40?$("#header-top").toggle():$("#header-top").slideToggle(),$(".primary-navigation").slideToggle(),$("html, body").animate({scrollTop:$(window).scrollTop()},100),$("html").toggleClass("overflow-hidden")})),t.focusout((function(){$(".primary-navigation>ul>li:first-child button").focus()}));var i=!0;$(window).on("resize",(function(){e.hasClass("menu-mobile-open")&&($(window).width()>880&&i?(t.click(),e.removeClass("menu-mobile-open"),$("html").removeClass("overflow-hidden"),i=!1):$(window).width()<=880&&!i&&(i=!0)),$(window).width()>768&&$(".zight-tab-content-nav .ul").css("display","flex"),$(window).width()<=768&&n.next().hide()})),$(".primary-navigation li.has-submenus button").attr("aria-expanded","false"),$(".primary-navigation li.has-submenus button").click((function(){$(this).attr("aria-expanded",(function(e,t){return"true"==t?(t="false",$(this).siblings(".sub_menu").removeClass("open")):($(".primary-navigation li.has-submenus button").each((function(e,t){"true"==$(t).attr("aria-expanded")&&($(t).attr("aria-expanded","false"),$(t).siblings(".sub_menu").removeClass("open"))})),t="true",$(this).siblings(".sub_menu").addClass("open").find(".menu-column:first-child .sub-menu li:first-child a").focus()),t}))})),$(document).keyup((function(e){27==e.keyCode&&$(".primary-navigation li.has-submenus button").each((function(e,t){"true"==$(t).attr("aria-expanded")&&($(t).attr("aria-expanded","false"),$(t).siblings(".sub_menu").removeClass("open"),$(t).focus())}))})),$(document).click((function(e){$(e.target).closest(".primary-navigation li.has-submenus button").length||$(".primary-navigation li.has-submenus button").each((function(e,t){"true"==$(t).attr("aria-expanded")&&($(t).attr("aria-expanded","false"),$(t).siblings(".sub_menu").removeClass("open"))}))})),window.matchMedia("(min-width: 768px)").matches&&$(".primary-navigation li.has-submenus").hover((function(){$(".primary-navigation li.has-submenus button").each((function(e,t){"true"==$(t).attr("aria-expanded")&&($(t).attr("aria-expanded","false"),$(t).siblings(".sub_menu").removeClass("open"))})),$(this).find("button").attr("aria-expanded","true")}),(function(){$(this).find("button").attr("aria-expanded","false")})),$("#top-search input").focus((function(){$(this).siblings("label").css({top:"-5px","font-size":"14px"})})),$("#top-search input").focusout((function(){""===$(this).val()&&$(this).siblings("label").css({top:"10px","font-size":"18px"})})),$("#top-search input").each((function(){$(this).hasClass("active-input")&&$(this).siblings("label").css({top:"-5px","font-size":"14px"})})),$("a").keydown((function(e){13===e.keyCode&&setTimeout((function(){const e=window.innerHeight,t=document.querySelectorAll("#main-content a");for(let n=0;n<t.length;n++){const i=t[n],a=i.getBoundingClientRect().top;if(a>=0&&a<e){i.focus();break}}}),1500)}))}(jQuery);