jQuery((function($){function e(){return $(".site-header").height()}function t(){var e=$(this).scrollTop();Math.abs(o-e)<=5||(e>i?e>o&&!$(".site-header .nav-menu").hasClass("active")?$("body").removeClass("nav-down").addClass("nav-up"):e+$(window).height()<$(document).height()&&$("body").removeClass("nav-up").addClass("nav-down"):$("body").removeClass("nav-down").removeClass("nav-up"),o=e)}var n=!1,o=0,r=5,i=e();$(window).scroll((function(){n=!0})),setInterval((function(){n&&(t(),n=!1)}),250),$(".backtotop").click((function(){$("body").removeClass("nav-up").removeClass("nav-down")}))})),window.addEventListener("load",(function(){function e(e){var e;0==r?r=0:r--,i="tab-"+r,document.querySelector(`button[data-link="${i}"]`).focus()}function t(e){var e;r++,i="tab-"+r,document.querySelector(`button[data-link="${i}"]`).focus()}let n=null,o=null,r=0,i="tab-0";const c=document.querySelector(".tabbed-content-block"),a=document.querySelectorAll(".tabbed-content__nav-item button");c&&a.forEach((n=>{n.addEventListener("keydown",(function(o){var r=o.currentTarget,i=!1;switch(o.key){case"ArrowLeft":e(n),i=!0;break;case"ArrowRight":t(n),i=!0;break;default:break}i&&(o.stopPropagation(),o.preventDefault())})),n.addEventListener("click",(function(){let e=n.getAttribute("data-link"),t;if(a.forEach((e=>e.classList.remove("active"))),a.forEach((e=>e.setAttribute("aria-selected","false"))),a.forEach((e=>e.setAttribute("tabindex","-1"))),document.querySelectorAll(".tabbed-content__content__pane").forEach((e=>{e.classList.remove("tabbed-content__content__pane--active")})),e){let t;document.querySelectorAll("#"+e).forEach((e=>{e.classList.add("tabbed-content__content__pane--active")}))}n.classList.add("active"),n.setAttribute("aria-selected","true"),n.removeAttribute("tabindex")}))}))})),window.addEventListener("load",(function(){const e=undefined;if(document.querySelector(".resource-links-container")){const a=document.querySelectorAll("button.resource-links-container-links-link-button , .dropdown-li");function t(e){var t=e.currentTarget;switch(e.key){case"ArrowUp":r(t);break;case"ArrowDown":o(t);break;default:break}}function n(e){var t=e.currentTarget;switch(e.key){case"ArrowLeft":c(t);break;case"ArrowRight":i(t);break;default:break}}function o(e){let t=Array.from(document.querySelectorAll(".dropdown-li")).indexOf(e);-1!==t&&t<document.querySelectorAll(".dropdown-li").length-1&&document.querySelectorAll(".dropdown-li")[t+1].focus()}function r(e){let t=Array.from(document.querySelectorAll(".dropdown-li")).indexOf(e);if(-1!==t&&t<document.querySelectorAll(".dropdown-li").length-1)if(t-1!=-1)document.querySelectorAll(".dropdown-li")[t-1].focus();else{let e;document.getElementById("resource-links-dropdown").focus()}}function i(e){let t=Array.from(a).indexOf(e);-1!==t&&t<a.length-1&&a[t+1].focus()}function c(e){let t=Array.from(a).indexOf(e);-1!==t&&t<a.length-1&&a[t-1].focus()}a.forEach((e=>{e.addEventListener("click",(function(t){let n=e.getAttribute("data-resourcelink"),o;if(a.forEach((e=>e.classList.remove("active"))),document.querySelectorAll(".resource-links-loop-container-item").forEach((e=>{e.classList.remove("resource-links-loop-container-item--active")})),n){let e;document.querySelectorAll("#"+n).forEach((e=>{e.classList.add("resource-links-loop-container-item--active")}))}e.classList.add("active");let r=document.getElementById(n).querySelector(".title");r&&r.focus()}))})),a.forEach((e=>{e.addEventListener("keydown",n)})),document.querySelectorAll("#resource-links-dropdown").forEach((function(e){e.addEventListener("click",(function(){this.classList.toggle("active");var e=document.querySelector(".resource-links-dropdown-list");e.classList.toggle("active"),e.focus()}))})),document.querySelectorAll(".dropdown-li").forEach((function(e){e.addEventListener("click",(function(t){let n=document.getElementById("resource-links-dropdown"),o;document.querySelector(".resource-links-dropdown-list").classList.remove("active"),n.innerHTML=e.innerHTML,n.classList.remove("active")})),e.addEventListener("keydown",(function(t){if(13==t.keyCode){let n=document.getElementById("resource-links-dropdown"),o;document.querySelector(".resource-links-dropdown-list").classList.remove("active"),n.innerHTML=e.innerHTML,n.classList.remove("active");let r=t.target.getAttribute("data-resourcelink"),i;if(a.forEach((e=>e.classList.remove("active"))),document.querySelectorAll(".resource-links-loop-container-item").forEach((e=>{e.classList.remove("resource-links-loop-container-item--active")})),r){let e;document.querySelectorAll("#"+r).forEach((e=>{e.classList.add("resource-links-loop-container-item--active")}))}let c=document.getElementById(r).querySelector("a");c&&c.focus()}}))})),document.querySelector("#resource-links-dropdown").addEventListener("keydown",(function(e){if("ArrowDown"==e.key){let e=document.querySelector(".resource-links-dropdown-list .dropdown-li");e&&e.focus()}})),document.querySelectorAll(".dropdown-li").forEach((e=>{e.addEventListener("keydown",t)}))}})),document.addEventListener("DOMContentLoaded",(function(){function e(){const e=document.querySelectorAll(".widget-title");var t;document.querySelectorAll('[id^="nav_menu-"]').forEach((function(e){var t,n=e.id+"_footer",o=e.querySelector(".menu-footer-container");o&&(o.id=n),(o=e.querySelector(".menu-home-footer-container"))&&(o.id=n),(o=e.querySelector(".menu-footer-privacy-container"))&&(o.id=n)})),e.forEach((function(e){var t=e.nextElementSibling;if(t&&t.classList.contains("menu-footer-container")){var n=t.id;e.setAttribute("aria-controls",n)}if(t&&t.classList.contains("menu-home-footer-container")){var n=t.id;e.setAttribute("aria-controls",n)}if(t&&t.classList.contains("menu-footer-privacy-container")){var n=t.id;e.setAttribute("aria-controls",n)}e.setAttribute("tabindex","0"),e.setAttribute("role","button"),e.setAttribute("aria-expanded","false")})),e.forEach((function(e){e.addEventListener("click",(function(){this.classList.toggle("active");let t=this.nextElementSibling;var n=e.getAttribute("aria-expanded");this.nextElementSibling.classList.toggle("active"),this.setAttribute("aria-expanded",n?"false":"true")}),!0)}))}function t(){this.classList.toggle("active");let e=this.nextElementSibling;if(e){var t=this.getAttribute("aria-expanded");e.classList.toggle("active"),this.setAttribute("aria-expanded",t?"false":"true")}}let n=document.querySelectorAll(".widget-title");window.addEventListener("resize",(function(){window.innerWidth<768?(e(),n.forEach((e=>{e.addEventListener("click",t)}))):n.forEach((e=>{e.removeAttribute("tabindex"),e.removeAttribute("role"),e.removeAttribute("aria-expanded"),e.removeAttribute("aria-controls"),e.removeEventListener("click",t)}))})),window.innerWidth<768&&e()})),jQuery((function($){function e(e,t){var n,o;27==t.which&&(o=e.find("*").filter(".modal .close-btn"),r(),t.preventDefault())}function t(e,t){var n,o,r,c,a;9==t.which&&(o=e.find("*").filter(i).filter(":visible"),r=jQuery(":focus"),c=o.length,a=o.index(r),t.shiftKey?0==a&&(o.get(c-1).focus(),t.preventDefault()):a==c-1&&(o.get(0).focus(),t.preventDefault()))}function n(e){var t;$(e).find("*").filter(i).filter(":visible").first().focus()}function o(e){jQuery("body").attr("aria-hidden","true"),jQuery("#"+e).css("display","block"),jQuery("#"+e).attr("aria-hidden","false"),jQuery("body").on("focusin","body",(function(){n("#"+e)})),c=jQuery(":focus"),n("#"+e)}function r(){jQuery(".modal").css("display","none"),jQuery(".modal").attr("aria-hidden","true"),jQuery(" body").attr("aria-hidden","false"),jQuery("body").off("focusin"," body"),jQuery(".modal").attr("aria-hidden","true"),c.focus()}var i="a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, *[tabindex], *[contenteditable]",c;$(document).ready((function(){$(".iframe_capture").on("focus",(function(){$(this).closest(".close-btn").focus()}))})),$(document).ready((function(){jQuery(".modal-btn").click((function(e){var t="true"===$(this).attr("aria-expanded");modalId=$(e.currentTarget).data("modal"),o(modalId),$(this).attr("aria-expanded",!t)})),jQuery(".modal .close-btn").click((function(e){r()})),jQuery(".modal .close-btnButton").click((function(e){r()})),jQuery(".modal").keydown((function(e){t($(this),e)})),jQuery(".modal").keydown((function(t){e($(this),t)}))}))})),window.addEventListener("DOMContentLoaded",(function(){let e=document.querySelectorAll(".accordion-block-container-accordion__button");e.length>0&&e.forEach((e=>{e.addEventListener("click",(()=>{const t=e.getAttribute("aria-controls"),n=document.getElementById(t);"true"===e.getAttribute("aria-expanded")?(e.setAttribute("aria-expanded","false"),n.classList.remove("active-content")):(e.setAttribute("aria-expanded","true"),n.classList.add("active-content"))}))}))}),!1),window.addEventListener("load",(function(){const e=document.querySelectorAll(".tab-block-container-tab-block_header-buttons .tab-block-container__heading__button");if(e.length){function t(){e.forEach((e=>{const t=e.getAttribute("aria-controls"),n=undefined;document.getElementById(t).classList.remove("active-content"),e.setAttribute("aria-selected","false"),e.setAttribute("tabindex","-1")}))}e.forEach(((n,o)=>{n.addEventListener("click",(function(){let e;t(),n.focus(),n.removeAttribute("tabindex"),n.setAttribute("aria-selected","true"),document.getElementById(n.getAttribute("aria-controls")).classList.add("active-content")})),n.addEventListener("keydown",(function(n){let r;if(36===n.keyCode){let o;n.preventDefault(),r=0,t(),e[r].focus(),e[r].removeAttribute("tabindex"),e[r].setAttribute("aria-selected","true"),document.getElementById(e[r].getAttribute("aria-controls")).classList.add("active-content")}else if(35===n.keyCode){let o;n.preventDefault(),r=e.length-1,t(),e[r].focus(),e[r].removeAttribute("tabindex"),e[r].setAttribute("aria-selected","true"),document.getElementById(e[r].getAttribute("aria-controls")).classList.add("active-content")}if(37===n.keyCode){let n;r=(o-1+e.length)%e.length,t(),e[r].focus(),e[r].removeAttribute("tabindex"),e[r].setAttribute("aria-selected","true"),document.getElementById(e[r].getAttribute("aria-controls")).classList.add("active-content")}else{if(39!==n.keyCode)return;{let n;r=(o+1)%e.length,t(),e[r].focus(),e[r].removeAttribute("tabindex"),e[r].setAttribute("aria-selected","true"),document.getElementById(e[r].getAttribute("aria-controls")).classList.add("active-content")}}}))}));const n=document.querySelector(".tab-block-container-tab-block_header-buttons_mobile_select");n.addEventListener("change",(function(){const e=n.options[n.selectedIndex],o=e.getAttribute("aria-controls"),r=document.getElementById(o);t(),r.classList.add("active-content"),e.setAttribute("aria-selected","true"),e.setAttribute("tabindex","0")}))}})),window.addEventListener("load",(function(){function e(){var e;t(window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth)}function t(e){let t=document.querySelector(".team-hightlight-block-container-team-hightlight__load_more button"),n=document.querySelector(".team-hightlight-block-container-team-hightlight__load_more button .text");if(t){let o=document.querySelectorAll(".team-hightlight-block-container-team-hightlight-member"),r=n.innerText,i=!1;o.length>=6&&(e<=768?(o.forEach((function(e,t){e.tabIndex=t<6?0:-1})),o[0].tabIndex=0):document.querySelector(".team-hightlight-block-styling-1")||o.forEach((function(e){e.tabIndex=0})),t.addEventListener("click",(function(){o.forEach((function(e){i?(e.classList.add("hidden"),e.classList.remove("animate"),o.forEach((function(e,t){e.tabIndex=t<6?0:-1}))):(e.classList.remove("hidden"),e.classList.add("animate"))}));var e="true"===this.getAttribute("aria-expanded");this.setAttribute("aria-expanded",e?"false":"true");for(var t=0;t<6&&t<o.length;t++)o[t].classList.remove("hidden");o[0].focus(),this.classList.add("active"),n.innerText=0==i?"Show Fewer":r,setTimeout((function(){o.forEach((function(e){i?e.classList.remove("animate"):e.classList.add("animate")}))}),500),i=!i})))}}e(),window.addEventListener("resize",e)})),document.addEventListener("DOMContentLoaded",(function(){function e(){var e;t(window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth)}function t(e){let t=document.querySelector(".refinance_lender_section__load_more button"),n=document.querySelector(".refinance_lender_section__load_more button .text");if(t){let o=document.querySelectorAll(".data-tr"),r=n,i=!1;o.length>=3&&(e<=768&&o.forEach((function(e,t){e.tabIndex=t<3?0:-1})),t.addEventListener("click",(function(){o.forEach((function(e){i?(e.classList.add("hidden"),e.classList.remove("animate")):(e.classList.remove("hidden"),e.classList.add("animate"))}));var e="true"===this.getAttribute("aria-expanded");this.setAttribute("aria-expanded",e?"false":"true");for(var t=0;t<3&&t<o.length;t++)o[t].classList.remove("hidden");o[0].focus(),this.classList.toggle("active"),n=0==i?"Show Fewer":r,i=!i})))}}e(),window.addEventListener("resize",e)})),window.addEventListener("DOMContentLoaded",(()=>{let e=document.querySelectorAll(".single .post_type_layout_standard .entry-content"),t=document.querySelectorAll(".toc_container");if(t.length>0||e.length>0){let n,o;t.length>0?(n=document.querySelector(".toc_container"),o=n.querySelectorAll("h2")):e.length>0&&(n=document.querySelector(".post_type_layout_standard .entry-content"),o=document.querySelectorAll(".post_type_layout_standard .entry-content >h2"));const r=[];o.forEach(((e,t)=>{const n=`toc_${t+1}`;e.id=n,r.push(n)}));const i=document.querySelector(".toc-nav"),c=document.createElement("ul");r.forEach((e=>{const t=document.createElement("li"),n=document.createElement("a");n.href=`#${e}`,n.textContent=document.querySelector(`#${e}`).textContent,t.appendChild(n),c.appendChild(t)})),i.appendChild(c);const a=document.querySelector(".toc-nav"),l=document.querySelector(".contents-nav-mobile-menu"),d=document.querySelector(".toc_content_load_point");if(a&&l){const e=a.cloneNode(!0);for(;e.firstChild;)l.appendChild(e.firstChild)}if(d){const e=a.cloneNode(!0);for(;e.firstChild;)d.appendChild(e.firstChild)}let s=null,u=null,m=null,f=document.querySelector(".toc_content_load_point");const v=new IntersectionObserver((e=>{e.forEach((e=>{const t=e.target.getAttribute("id");let n;if(null!=document.querySelector(".toc-nav li a")&&e.intersectionRatio>0){u&&u.classList.remove("active"),s&&s.classList.remove("active"),m&&m.classList.remove("active");const e=document.querySelector(`.toc-nav li a[href="#${t}"]`).parentElement,n=document.querySelector(`.contents-nav-mobile-menu li a[href="#${t}"]`).parentElement;if(f){const e=document.querySelector(`.toc_content_load_point li a[href="#${t}"]`).parentElement;e.classList.add("active"),m=e}e.classList.add("active"),n.classList.add("active"),s=e,u=n}}))}));let h;t.length>0?h=document.querySelectorAll(".toc_container h2"):e.length>0&&(h=document.querySelectorAll(".single .post_type_layout_standard .entry-content h2")),h.forEach((e=>{v.observe(e)})),window.addEventListener("scroll",(function(){var e=document.querySelector(".inner-hero");if(e){var t=e.getBoundingClientRect().bottom,n=document.querySelector(".contents-nav-mobile"),o=document.querySelector(".site-header");t<0?(n.classList.add("scroll_active"),o.classList.add("scroll_active")):(n.classList.remove("scroll_active"),o.classList.remove("scroll_active"))}}));const b=undefined;document.querySelectorAll(".contents-nav-mobile-menu a, .toc-nav a").forEach((e=>{e.addEventListener("click",(t=>{t.preventDefault();const n=e.getAttribute("href"),o=document.querySelector(n);if(o){let e;o.focus(),document.querySelector(".contents-nav-mobile").classList.toggle("active");const t=undefined,n=o.getBoundingClientRect().top+window.pageYOffset-100;window.scrollTo({top:n,behavior:"smooth"})}}))}));const y=document.querySelector(".contents-nav-mobile-header-dropdown-select"),g=document.querySelector(".contents-nav-mobile");y.addEventListener("click",(()=>{g.classList.toggle("active")}))}})),document.addEventListener("DOMContentLoaded",(function(){const e=document.querySelectorAll(".vendor_information_block_container_column_two_link_more_info");e.length>0&&e.forEach((e=>{e.addEventListener("click",(e=>{const t=e.target.getAttribute("aria-controls"),n=document.getElementById(t);if(n){e.target.classList.toggle("active_btn"),n.toggleAttribute("hidden");const t="true"===e.target.getAttribute("aria-expanded");e.target.setAttribute("aria-expanded",!t),e.target.innerHTML=t?'More Information <span><svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L6.50008 6.50008L12.0002 1" stroke="#82BC46"/></svg></span>':'Less Information<span><svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L6.50008 6.50008L12.0002 1" stroke="#82BC46"/></svg></span>'}}))}));const t=undefined;document.querySelectorAll(".tablet_chevron").length>0&&document.querySelector(".tablet_chevron").addEventListener("click",(function(){var e=document.querySelector(".tabbed-content__nav-list"),t=e.querySelectorAll(".tabbed-content__nav-item"),n=e.querySelector(".active"),o,r=t[Array.from(t).indexOf(n)+1]||t[0];r&&(r.scrollIntoView({behavior:"smooth",block:"nearest",inline:"start"}),n.classList.remove("active"),r.classList.add("active"))}))}));var mySwiper=new Swiper(".swiper-container",{loop:!0,slidesPerView:4,spaceBetween:30,centeredSlides:!0,pagination:{el:".swiper-pagination",clickable:!0},breakpoints:{640:{slidesPerView:2,spaceBetween:20},768:{slidesPerView:3,spaceBetween:30},1024:{slidesPerView:4,spaceBetween:30,centeredSlides:!0}},navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},on:{transitionStart:function(){var e=document.querySelectorAll("video");Array.prototype.forEach.call(e,(function(e){e.pause()}))},transitionEnd:function(){var e=this.activeIndex,t,n;document.getElementsByClassName("swiper-slide")[e].getElementsByTagName("video")[0].play()}}});jQuery(".video-placeholder").on("click",(function(){var e=jQuery("#video-placeholder").get(0);e.paused?(e.play(),jQuery(this).hide()):(e.pause(),jQuery(this).show())})),document.addEventListener("DOMContentLoaded",(function(){var e=document.getElementById("video-placeholder"),t=document.querySelector(".video_block_template_container_media_placeholder_action_btn"),n=document.querySelector(".video_block_template_container_media_placeholder_action_btn .text");t.addEventListener("click",(function(){e.paused?(e.play(),n.textContent="Pause Video"):(e.pause(),n.textContent="Play Video")}))}));