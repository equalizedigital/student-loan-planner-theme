!function($){const e=$("#main-navigation"),t=$("#nav-icon");let n=$(".zight-mobile-tab-toggle");if($('a[href*="#"]').not('[href="#"]').not('[href="#0"]').not('[href="#main-content"]').not(".features_buttons_acc a").click((function(e){if(location.pathname.replace(/^\//,"")==this.pathname.replace(/^\//,"")&&location.hostname==this.hostname){var t=$(this.hash);(t=t.length?t:$("[name="+this.hash.slice(1)+"]")).length&&(e.preventDefault(),$("html, body").animate({scrollTop:t.offset().top},1e3,(function(){var e=$(t);if(e.focus(),e.is(":focus"))return!1;e.attr("tabindex","-1"),e.focus()})))}})),document.addEventListener("DOMContentLoaded",(function(){var e=document.querySelectorAll(".site-header"),t;document.querySelectorAll(".sub_menu_back").forEach((function(t){t.addEventListener("click",(function(t){t.preventDefault();var n=this.closest(".sub_menu"),i=$(n).parent().find(".menu-item-main-link");i.length&&i.focus(),n&&n.classList.remove("active"),e.forEach((function(e){e.classList.remove("site-header-active")}))}))})),$(window).innerWidth()>=1070&&($("#menu_search_btn").on("click",(function(){var e=$(".search-popup");e.length&&(e.addClass("active"),$(this).attr("aria-expanded","true"),$("#modal_search").focus())})),$("#modal_search").on("input",(function(){var e=$(".search-popup");e.length&&e.addClass("input-active")})),$("#close-search").on("click",(function(){var e=$(".search-popup");e.length&&(e.removeClass("active"),$("#menu_search_btn").attr("aria-expanded","false"),$("#menu_search_btn").focus())})))})),$(window).innerWidth()<=1070){var i=$(".menu-item-main-link"),a=$(".site-header");i.on("click",(function(e){if(e.preventDefault(),0==$(this).hasClass("menu-item-no-drop")){$(this).toggleClass("active"),$(this).parent().toggleClass("active");var t=$(this).siblings(".sub_menu");t.length&&t.toggleClass("active"),a.toggleClass("site-header-active");let e,n=$(this).siblings(".sub_menu").find(".menu-column").find("a[href], button:not([disabled])").first();n.length&&n.focus()}}))}document.querySelector(".mobile_help_btn .btn").addEventListener("keydown",(function(n){var i;"Tab"===n.key&&(n.preventDefault(),$(".site-header").removeClass("site-header-active"),$(".menu-item-main-link").removeClass("active"),$(".main-nav-link-li").removeClass("active"),document.querySelectorAll(".sub_menu.active").forEach((function(e){e.classList.remove("active")})),$(t).toggleClass("open"),"false"===$(t).attr("aria-expanded")?$(t).attr("aria-expanded","true"):$(t).attr("aria-expanded","false"),!e.hasClass("menu-mobile-open")&&e.toggleClass("menu-mobile-open"),$(window).scrollTop()>40?$("#header-top").toggle():$("#header-top").slideToggle(),$(".primary-navigation").toggleClass("active"),$("html, body").animate({scrollTop:$(window).scrollTop()},100),$("html").toggleClass("overflow-hidden"))})),t.click((function(){var t;$(".site-header").removeClass("site-header-active"),$(".menu-item-main-link").removeClass("active"),$(".main-nav-link-li").removeClass("active"),document.querySelectorAll(".sub_menu.active").forEach((function(e){e.classList.remove("active")})),$(this).toggleClass("open"),"false"===$(this).attr("aria-expanded")?$(this).attr("aria-expanded","true"):$(this).attr("aria-expanded","false"),!e.hasClass("menu-mobile-open")&&e.toggleClass("menu-mobile-open"),$(window).scrollTop()>40?$("#header-top").toggle():$("#header-top").slideToggle(),$(".primary-navigation").toggleClass("active"),$("html, body").animate({scrollTop:$(window).scrollTop()},100),$("html").toggleClass("overflow-hidden")})),$(".nav-icon").click((function(){var n;$(".site-header").removeClass("site-header-active"),$(".menu-item-main-link").removeClass("active"),$(".main-nav-link-li").removeClass("active"),document.querySelectorAll(".sub_menu.active").forEach((function(e){e.classList.remove("active")})),t.removeClass("open"),$(this).attr("aria-expanded","false"),e.removeClass("menu-mobile-open"),$(".primary-navigation").removeClass("active"),$("html, body").animate({scrollTop:$(window).scrollTop()},100),$("html").removeClass("overflow-hidden")}));var s=!0;$(window).on("resize",(function(){e.hasClass("menu-mobile-open")&&($(window).width()>1070&&s?(t.click(),e.removeClass("menu-mobile-open"),$("html").removeClass("overflow-hidden"),s=!1):$(window).width()<=1070&&!s&&(s=!0)),$(window).width()>1070&&$(".zight-tab-content-nav .ul").css("display","flex"),$(window).width()<=1070&&n.next().hide()})),$(".primary-navigation li.has-submenus button").attr("aria-expanded","false"),$(".primary-navigation li.has-submenus button").click((function(){$(this).attr("aria-expanded",(function(e,t){return"true"==t?(t="false",$(this).siblings(".sub_menu").removeClass("open")):($(".primary-navigation li.has-submenus button").each((function(e,t){"true"==$(t).attr("aria-expanded")&&($(t).attr("aria-expanded","false"),$(t).siblings(".sub_menu").removeClass("open"))})),t="true",$(this).siblings(".sub_menu").addClass("open").find(".menu-column:first-child .sub-menu li:first-child a").focus()),t}))})),$("a").keydown((function(e){13===e.keyCode&&setTimeout((function(){const e=window.innerHeight,t=document.querySelectorAll("#main-content a");for(let n=0;n<t.length;n++){const i=t[n],a=i.getBoundingClientRect().top;if(a>=0&&a<e){i.focus();break}}}),1500)}))}(jQuery),function($){$(".menu-item-has-children").attr("aria-haspopup","true"),$(".dropdown-toggle").click((function(e){$(".dropdown-toggle").not(this).each((function(){$(this).closest(".main-nav-link-li").removeClass("ada-active-menu"),$(this).removeClass("toggled-on"),$(this).closest(".sub-menu").removeClass("toggled-on"),$(this).attr("aria-expanded","false"===$(this).attr("aria-expanded")?"true":"false")})),e.preventDefault(),$(this).toggleClass("toggled-on"),$(this).closest(".has-submenus").toggleClass("ada-active-menu"),$(this).nextAll(".sub-menu").toggleClass("toggled-on"),$(this).attr("aria-expanded","false"===$(this).attr("aria-expanded")?"true":"false")})),$(".menu-item a, .dropdown-toggle, .menu-item-main-link, #close-search, #modal_search").on("keydown",(function(e){if(-1==[37,38,39,40,27,9].indexOf(e.keyCode))return;let t;switch(e.keyCode){case 9:var n='a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])',i=$(".sub_menu.active").find(n).last();if($(this).is(i)&&$(".sub_menu_back").focus(),$(this).is("#close-search")&&(e.preventDefault(),$(".under_line .input-group input").focus()),$(this).is("#modal_search")&&e.shiftKey&&e.preventDefault(),$(this).is(".menu-item a")){var a=$(this).closest(".main-nav-link-li").find(".menu-item-main-link").siblings(".sub_menu").find('a[href], button, input, select, textarea, [tabindex]:not([tabindex="-1"])');let t=$(this).closest(".main-nav-link-li").find(".menu-item-main-link");var s=a[a.length-1];e.target!==s||e.shiftKey||(e.preventDefault(),t.attr("aria-expanded","false"),t.focus(),t.siblings(".sub_menu").removeClass("open"))}break;case 27:$(this).parents("ul").first().prev(".dropdown-toggle.toggled-on").focus(),$(this).parents("ul").first().prev(".dropdown-toggle.toggled-on").click(),$(".main-nav-link-li").removeClass("ada-active-menu"),$(".dropdown-toggle.toggled-on").removeClass("toggled-on"),$(".sub-menu").removeClass("toggled-on"),$(".dropdown-toggle.toggled-on").attr("aria-expanded","false"===$(this).attr("aria-expanded")?"true":"false"),$(this).is(".menu-item a")&&$(this).closest(".main-nav-link-li").find(".menu-item-main-link")&&($(this).closest(".main-nav-link-li").find(".menu-item-main-link").attr("aria-expanded","false"),$(this).closest(".main-nav-link-li").find(".menu-item-main-link").focus(),$(this).closest(".main-nav-link-li").find(".menu-item-main-link").siblings(".sub_menu").removeClass("open"));break;case 37:e.preventDefault(),e.stopPropagation(),t=$(this).index(),$(this).is(".menu-item a")&&$(this).closest(".menu-column").prev().find("li").eq(t).find("a").focus(),$(this).is(".menu-item-main-link")&&(0!=$(this).closest(".main-nav-link-li").prev().find(".dropdown-toggle").length?$(this).closest(".main-nav-link-li").prev().find(".dropdown-toggle").focus():$(this).closest(".main-nav-link-li").prev().find(".menu-item-main-link").focus()),$(this).is(".dropdown-toggle")&&($(this).closest(".main-nav-link-li").find(".menu-item-main-link")?$(this).closest(".main-nav-link-li").find(".menu-item-main-link").focus():$(this).closest(".main-nav-link-li").prev().find(".menu-item-main-link").focus());break;case 39:e.preventDefault(),e.stopPropagation(),t=$(this).index(),$(this).is(".menu-item a")&&$(this).closest(".menu-column").next().find("li").eq(t).find("a").focus(),$(this).is(".menu-item-main-link")&&(0!=$(this).siblings(".menu-item-rel").find(".dropdown-toggle").length?$(this).siblings(".menu-item-rel").find(".dropdown-toggle").focus():$(this).closest(".main-nav-link-li").next().find(".menu-item-main-link").focus()),$(this).is(".dropdown-toggle")&&$(this).closest(".main-nav-link-li").next().find(".menu-item-main-link").focus();break;case 40:e.preventDefault(),e.stopPropagation(),$(this).next().length?$(this).next().find("li:first-child a").first().focus():$(this).parent().next().children("a").focus(),$(this).is("ul.sub-menu a")&&$(this).next("button.dropdown-toggle").length&&$(this).parent().next().children("a").focus(),$(this).is("ul.sub-menu .dropdown-toggle")&&$(this).parent().next().children(".dropdown-toggle").length&&$(this).parent().next().children(".dropdown-toggle").focus(),$(this).is(".dropdown-toggle")&&$(this).closest(".ada-active-menu")&&$(this).closest(".ada-active-menu").find(".menu-column .menu-item").first().find("a").focus(),$(this).is(".menu-item-main-link")&&$(this).closest(".ada-active-menu")&&$(this).closest(".ada-active-menu").find(".menu-column .menu-item").first().find("a").focus();break;case 38:e.preventDefault(),e.stopPropagation(),$(this).is(".menu-item a")&&(console.log($(this).parent(".menu-item").index()),0==$(this).parent(".menu-item").index()?$(this).closest(".ada-active-menu").find(".menu-item-main-link").focus():$(this).parent().prev().length?$(this).parent().prev().children("a").focus():$(this).parents("ul").first().prev(".dropdown-toggle.toggled-on").focus());break}}))}(jQuery);