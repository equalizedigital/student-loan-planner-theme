jQuery((function($){function e(){return $(".site-header").height()}function t(){var e=$(this).scrollTop();Math.abs(o-e)<=5||(e>r?e>o&&!$(".site-header .nav-menu").hasClass("active")?$("body").removeClass("nav-down").addClass("nav-up"):e+$(window).height()<$(document).height()&&$("body").removeClass("nav-up").addClass("nav-down"):$("body").removeClass("nav-down").removeClass("nav-up"),o=e)}var n=!1,o=0,i=5,r=e();$(window).scroll((function(){n=!0})),setInterval((function(){n&&(t(),n=!1)}),250),$(".backtotop").click((function(){$("body").removeClass("nav-up").removeClass("nav-down")}))})),window.addEventListener("load",(function(){function e(e){var e;0==i?i=0:i--,r="tab-"+i,document.querySelector(`button[data-link="${r}"]`).focus()}function t(e){var e;i++,r="tab-"+i,document.querySelector(`button[data-link="${r}"]`).focus()}let n=null,o=null,i=0,r="tab-0";const a=document.querySelector(".tabbed-content-block"),c=document.querySelectorAll(".tabbed-content__nav-item button");a&&c.forEach((n=>{n.addEventListener("keydown",(function(o){var i=o.currentTarget,r=!1;switch(o.key){case"ArrowLeft":e(n),r=!0;break;case"ArrowRight":t(n),r=!0;break;default:break}r&&(o.stopPropagation(),o.preventDefault())})),n.addEventListener("click",(function(){let e=n.getAttribute("data-link"),t;if(c.forEach((e=>e.classList.remove("active"))),c.forEach((e=>e.setAttribute("aria-selected","false"))),c.forEach((e=>e.setAttribute("tabindex","-1"))),document.querySelectorAll(".tabbed-content__content__pane").forEach((e=>{e.classList.remove("tabbed-content__content__pane--active")})),e){let t;document.querySelectorAll("#"+e).forEach((e=>{e.classList.add("tabbed-content__content__pane--active")}))}n.classList.add("active"),n.setAttribute("aria-selected","true"),n.removeAttribute("tabindex")}))}))})),window.addEventListener("load",(function(){const e=undefined;if(document.querySelector(".resource-links-container")){const c=document.querySelectorAll("button.resource-links-container-links-link-button , .dropdown-li");function t(e){var t=e.currentTarget;switch(e.key){case"ArrowUp":i(t);break;case"ArrowDown":o(t);break;default:break}}function n(e){var t=e.currentTarget;switch(e.key){case"ArrowLeft":a(t);break;case"ArrowRight":r(t);break;default:break}}function o(e){let t=Array.from(document.querySelectorAll(".dropdown-li")).indexOf(e);-1!==t&&t<document.querySelectorAll(".dropdown-li").length-1&&document.querySelectorAll(".dropdown-li")[t+1].focus()}function i(e){let t=Array.from(document.querySelectorAll(".dropdown-li")).indexOf(e);if(-1!==t&&t<document.querySelectorAll(".dropdown-li").length-1)if(t-1!=-1)document.querySelectorAll(".dropdown-li")[t-1].focus();else{let e;document.getElementById("resource-links-dropdown").focus()}}function r(e){let t=Array.from(c).indexOf(e);-1!==t&&t<c.length-1&&c[t+1].focus()}function a(e){let t=Array.from(c).indexOf(e);-1!==t&&t<c.length-1&&c[t-1].focus()}c.forEach((e=>{e.addEventListener("click",(function(t){let n=e.getAttribute("data-resourcelink"),o;if(c.forEach((e=>e.classList.remove("active"))),document.querySelectorAll(".resource-links-loop-container-item").forEach((e=>{e.classList.remove("resource-links-loop-container-item--active")})),n){let e;document.querySelectorAll("#"+n).forEach((e=>{e.classList.add("resource-links-loop-container-item--active")}))}e.classList.add("active");let i=document.getElementById(n).querySelector(".title");i&&i.focus()}))})),c.forEach((e=>{e.addEventListener("keydown",n)})),document.querySelectorAll("#resource-links-dropdown").forEach((function(e){e.addEventListener("click",(function(){this.classList.toggle("active");var e=document.querySelector(".resource-links-dropdown-list");e.classList.toggle("active"),e.focus()}))})),document.querySelectorAll(".dropdown-li").forEach((function(e){e.addEventListener("click",(function(t){let n=document.getElementById("resource-links-dropdown"),o;document.querySelector(".resource-links-dropdown-list").classList.remove("active"),n.innerHTML=e.innerHTML,n.classList.remove("active")})),e.addEventListener("keydown",(function(t){if(13==t.keyCode){let n=document.getElementById("resource-links-dropdown"),o;document.querySelector(".resource-links-dropdown-list").classList.remove("active"),n.innerHTML=e.innerHTML,n.classList.remove("active");let i=t.target.getAttribute("data-resourcelink"),r;if(c.forEach((e=>e.classList.remove("active"))),document.querySelectorAll(".resource-links-loop-container-item").forEach((e=>{e.classList.remove("resource-links-loop-container-item--active")})),i){let e;document.querySelectorAll("#"+i).forEach((e=>{e.classList.add("resource-links-loop-container-item--active")}))}let a=document.getElementById(i).querySelector("a");a&&a.focus()}}))})),document.querySelector("#resource-links-dropdown").addEventListener("keydown",(function(e){if("ArrowDown"==e.key){let e=document.querySelector(".resource-links-dropdown-list .dropdown-li");e&&e.focus()}})),document.querySelectorAll(".dropdown-li").forEach((e=>{e.addEventListener("keydown",t)}))}})),document.addEventListener("DOMContentLoaded",(function(){function e(){const e=document.querySelectorAll(".widget-title");var t;document.querySelectorAll('[id^="nav_menu-"]').forEach((function(e){var t,n=e.id+"_footer",o=e.querySelector(".menu-footer-container");o&&(o.id=n),(o=e.querySelector(".menu-home-footer-container"))&&(o.id=n),(o=e.querySelector(".menu-footer-privacy-container"))&&(o.id=n)})),e.forEach((function(e){var t=e.nextElementSibling;if(t&&t.classList.contains("menu-footer-container")){var n=t.id;e.setAttribute("aria-controls",n)}if(t&&t.classList.contains("menu-home-footer-container")){var n=t.id;e.setAttribute("aria-controls",n)}if(t&&t.classList.contains("menu-footer-privacy-container")){var n=t.id;e.setAttribute("aria-controls",n)}e.setAttribute("tabindex","0"),e.setAttribute("role","button"),e.setAttribute("aria-expanded","false")})),e.forEach((function(e){e.addEventListener("click",(function(){this.classList.toggle("active");let t=this.nextElementSibling;var n=e.getAttribute("aria-expanded");this.nextElementSibling.classList.toggle("active"),this.setAttribute("aria-expanded",n?"false":"true")}),!0)}))}function t(){this.classList.toggle("active");let e=this.nextElementSibling;if(e){var t=this.getAttribute("aria-expanded");e.classList.toggle("active"),this.setAttribute("aria-expanded",t?"false":"true")}}let n=document.querySelectorAll(".widget-title");window.addEventListener("resize",(function(){window.innerWidth<768?(e(),n.forEach((e=>{e.addEventListener("click",t)}))):n.forEach((e=>{e.removeAttribute("tabindex"),e.removeAttribute("role"),e.removeAttribute("aria-expanded"),e.removeAttribute("aria-controls"),e.removeEventListener("click",t)}))})),window.innerWidth<768&&e()})),jQuery((function($){function e(e,t){var n,o;27==t.which&&(o=e.find("*").filter(".modal .close-btn"),i(),t.preventDefault())}function t(e,t){var n,o,i,a,c;9==t.which&&(o=e.find("*").filter(r).filter(":visible"),i=jQuery(":focus"),a=o.length,c=o.index(i),t.shiftKey?0==c&&(o.get(a-1).focus(),t.preventDefault()):c==a-1&&(o.get(0).focus(),t.preventDefault()))}function n(e){var t=$(e).find("*");console.log(t.filter(r).filter(":visible")),t.filter(r).filter(":visible").first().focus()}function o(e){jQuery("body").attr("aria-hidden","true"),jQuery("#"+e).css("display","block"),jQuery("#"+e).attr("aria-hidden","false"),jQuery("body").addClass("modal-active"),jQuery("body").on("focusin","body",(function(){n("#"+e)})),a=jQuery(":focus"),n("#"+e);var t=jQuery("#"+e).find(".video-modal-autoplay").get(0);t&&t.play()}function i(){jQuery("body").removeClass("modal-active"),jQuery(".modal").css("display","none"),jQuery(".modal").attr("aria-hidden","true"),jQuery(" body").attr("aria-hidden","false"),jQuery(".modal-btn").attr("aria-expanded",!1),jQuery("body").off("focusin"," body"),jQuery(".modal").attr("aria-hidden","true");const e=undefined;document.querySelectorAll(".modal video").forEach((function(e){e.pause()})),a.focus()}var r="a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, video, object, embed, *[tabindex], *[contenteditable]",a;$(document).ready((function(){$(".iframe_capture").on("focus",(function(){$(this).closest(".close-btn").focus()}))})),$(document).ready((function(){jQuery(".modal-btn").click((function(e){var t="true"===$(this).attr("aria-expanded");modalId=$(e.currentTarget).data("modal"),o(modalId),$(this).attr("aria-expanded",!t)})),jQuery(".modal .close-btn").click((function(e){i()})),jQuery(".modal .close-btnButton").click((function(e){i()})),jQuery(".modal").keydown((function(e){t($(this),e)})),jQuery(".modal").keydown((function(t){e($(this),t)}))}))})),window.addEventListener("DOMContentLoaded",(function(){let e=document.querySelectorAll(".accordion-block-container-accordion__button");e.length>0&&e.forEach((e=>{e.addEventListener("click",(()=>{const t=e.getAttribute("aria-controls"),n=document.getElementById(t);"true"===e.getAttribute("aria-expanded")?(e.setAttribute("aria-expanded","false"),n.classList.remove("active-content")):(e.setAttribute("aria-expanded","true"),n.classList.add("active-content"))}))}))}),!1),window.addEventListener("load",(function(){const e=document.querySelectorAll(".tab-block-container-tab-block_header-buttons .tab-block-container__heading__button");if(e.length){function t(){e.forEach((e=>{const t=e.getAttribute("aria-controls"),n=undefined;document.getElementById(t).classList.remove("active-content"),e.setAttribute("aria-selected","false"),e.setAttribute("tabindex","-1")}))}e.forEach(((n,o)=>{n.addEventListener("click",(function(){let e;t(),n.focus(),n.removeAttribute("tabindex"),n.setAttribute("aria-selected","true"),document.getElementById(n.getAttribute("aria-controls")).classList.add("active-content")})),n.addEventListener("keydown",(function(n){let i;if(36===n.keyCode){let o;n.preventDefault(),i=0,t(),e[i].focus(),e[i].removeAttribute("tabindex"),e[i].setAttribute("aria-selected","true"),document.getElementById(e[i].getAttribute("aria-controls")).classList.add("active-content")}else if(35===n.keyCode){let o;n.preventDefault(),i=e.length-1,t(),e[i].focus(),e[i].removeAttribute("tabindex"),e[i].setAttribute("aria-selected","true"),document.getElementById(e[i].getAttribute("aria-controls")).classList.add("active-content")}if(37===n.keyCode){let n;i=(o-1+e.length)%e.length,t(),e[i].focus(),e[i].removeAttribute("tabindex"),e[i].setAttribute("aria-selected","true"),document.getElementById(e[i].getAttribute("aria-controls")).classList.add("active-content")}else{if(39!==n.keyCode)return;{let n;i=(o+1)%e.length,t(),e[i].focus(),e[i].removeAttribute("tabindex"),e[i].setAttribute("aria-selected","true"),document.getElementById(e[i].getAttribute("aria-controls")).classList.add("active-content")}}}))}));const n=document.querySelector(".tab-block-container-tab-block_header-buttons_mobile_select");n.addEventListener("change",(function(){const e=n.options[n.selectedIndex],o=e.getAttribute("aria-controls"),i=document.getElementById(o);t(),i.classList.add("active-content"),e.setAttribute("aria-selected","true"),e.setAttribute("tabindex","0")}))}})),window.addEventListener("load",(function(){function e(){var e;t(window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth)}function t(e){let t=document.querySelector(".team-hightlight-block-container-team-hightlight__load_more button"),n=document.querySelector(".team-hightlight-block-container-team-hightlight__load_more button .text");if(t){let o=document.querySelectorAll(".team-hightlight-block-container-team-hightlight-member"),i=n.innerText,r=!1;o.length>=6&&(e<=768?(o.forEach((function(e,t){e.tabIndex=t<6?0:-1})),o[0].tabIndex=0):document.querySelector(".team-hightlight-block-styling-1")||o.forEach((function(e){e.tabIndex=0})),t.addEventListener("click",(function(){o.forEach((function(e){r?(e.classList.add("hidden"),e.classList.remove("animate"),o.forEach((function(e,t){e.tabIndex=t<6?0:-1}))):(e.classList.remove("hidden"),e.classList.add("animate"))}));var e="true"===this.getAttribute("aria-expanded");this.setAttribute("aria-expanded",e?"false":"true");for(var t=0;t<6&&t<o.length;t++)o[t].classList.remove("hidden");o[0].focus(),this.classList.add("active"),n.innerText=0==r?"Show Fewer":i,setTimeout((function(){o.forEach((function(e){r?e.classList.remove("animate"):e.classList.add("animate")}))}),500),r=!r})))}}e(),window.addEventListener("resize",e)})),document.addEventListener("DOMContentLoaded",(function(){function e(){var e;t(window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth)}function t(e){let t=document.querySelector(".refinance_lender_section__load_more button"),n=document.querySelector(".refinance_lender_section__load_more button .text");if(t){let o=document.querySelectorAll(".data-tr"),i=n,r=!1;o.length>=3&&(e<=768&&o.forEach((function(e,t){e.tabIndex=t<3?0:-1})),t.addEventListener("click",(function(){o.forEach((function(e){r?(e.classList.add("hidden"),e.classList.remove("animate")):(e.classList.remove("hidden"),e.classList.add("animate"))}));var e="true"===this.getAttribute("aria-expanded");this.setAttribute("aria-expanded",e?"false":"true");for(var t=0;t<3&&t<o.length;t++)o[t].classList.remove("hidden");o[0].focus(),this.classList.toggle("active"),n=0==r?"Show Fewer":i,r=!r})))}}e(),window.addEventListener("resize",e)})),window.addEventListener("DOMContentLoaded",(()=>{let e=document.querySelectorAll(".single .post_type_layout_standard .entry-content"),t=document.querySelectorAll(".toc_container");if(t.length>0||e.length>0){let n,o;t.length>0?(n=document.querySelector(".toc_container"),o=n.querySelectorAll("h2")):e.length>0&&(n=document.querySelector(".post_type_layout_standard .entry-content"),o=document.querySelectorAll(".post_type_layout_standard .entry-content >h2"));const i=[];o.forEach(((e,t)=>{const n=`toc_${t+1}`;e.id=n,i.push(n)}));const r=document.querySelector(".toc-nav"),a=document.createElement("ul");i.forEach((e=>{const t=document.createElement("li"),n=document.createElement("a");n.href=`#${e}`,n.textContent=document.querySelector(`#${e}`).textContent,t.appendChild(n),a.appendChild(t)})),r.appendChild(a);const c=document.querySelector(".toc-nav"),l=document.querySelector(".contents-nav-mobile-menu"),d=document.querySelector(".toc_content_load_point");if(c&&l){const e=c.cloneNode(!0);for(;e.firstChild;)l.appendChild(e.firstChild)}if(d){const e=c.cloneNode(!0);for(;e.firstChild;)d.appendChild(e.firstChild)}let s=null,u=null,m=null,f=document.querySelector(".toc_content_load_point");const v=new IntersectionObserver((e=>{e.forEach((e=>{const t=e.target.getAttribute("id");let n;if(null!=document.querySelector(".toc-nav li a")&&e.intersectionRatio>0){u&&u.classList.remove("active"),s&&s.classList.remove("active"),m&&m.classList.remove("active");const e=document.querySelector(`.toc-nav li a[href="#${t}"]`).parentElement,n=document.querySelector(`.contents-nav-mobile-menu li a[href="#${t}"]`).parentElement;if(f){const e=document.querySelector(`.toc_content_load_point li a[href="#${t}"]`).parentElement;e.classList.add("active"),m=e}e.classList.add("active"),n.classList.add("active"),s=e,u=n}}))}));let h;t.length>0?h=document.querySelectorAll(".toc_container h2"):e.length>0&&(h=document.querySelectorAll(".single .post_type_layout_standard .entry-content h2")),h.forEach((e=>{v.observe(e)})),window.addEventListener("scroll",(function(){var e=document.querySelector(".inner-hero");if(e){var t=e.getBoundingClientRect().bottom,n=document.querySelector(".contents-nav-mobile"),o=document.querySelector(".site-header");t<0?(n.classList.add("scroll_active"),o.classList.add("scroll_active")):(n.classList.remove("scroll_active"),o.classList.remove("scroll_active"))}}));const b=undefined;document.querySelectorAll(".contents-nav-mobile-menu a, .toc-nav a").forEach((e=>{e.addEventListener("click",(t=>{t.preventDefault();const n=e.getAttribute("href"),o=document.querySelector(n);if(o){let e;o.focus(),document.querySelector(".contents-nav-mobile").classList.toggle("active");const t=undefined,n=o.getBoundingClientRect().top+window.pageYOffset-100;window.scrollTo({top:n,behavior:"smooth"})}}))}));const y=document.querySelector(".contents-nav-mobile-header-dropdown-select"),p=document.querySelector(".contents-nav-mobile");y.addEventListener("click",(()=>{p.classList.toggle("active")}))}})),document.addEventListener("DOMContentLoaded",(function(){const e=document.querySelectorAll(".vendor_information_block_container_column_two_link_more_info");e.length>0&&e.forEach((e=>{e.addEventListener("click",(e=>{const t=e.target.getAttribute("aria-controls"),n=document.getElementById(t);if(n){e.target.classList.toggle("active_btn"),n.toggleAttribute("hidden");const t="true"===e.target.getAttribute("aria-expanded");e.target.setAttribute("aria-expanded",!t),e.target.innerHTML=t?'More Information <span><svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L6.50008 6.50008L12.0002 1" stroke="#82BC46"/></svg></span>':'Less Information<span><svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L6.50008 6.50008L12.0002 1" stroke="#82BC46"/></svg></span>'}}))}));const t=undefined;document.querySelectorAll(".tablet_chevron").length>0&&document.querySelector(".tablet_chevron").addEventListener("click",(function(){var e=document.querySelector(".tabbed-content__nav-list"),t=e.querySelectorAll(".tabbed-content__nav-item"),n=e.querySelector(".active"),o,i=t[Array.from(t).indexOf(n)+1]||t[0];i&&(i.scrollIntoView({behavior:"smooth",block:"nearest",inline:"start"}),n.classList.remove("active"),i.classList.add("active"))}))})),document.addEventListener("DOMContentLoaded",(function(){const e=document.querySelectorAll(".video-carousel-swiper-container");if(e.length){var t=new Swiper(".video-carousel-swiper-container",{loop:!0,spaceBetween:21,loopedSlides:4,slidesPerView:6,slidesPerGroup:3,centeredSlides:!1,initialSlide:3,watchSlidesProgress:!0,loopFillGroupWithBlank:!0,speed:800,a11y:!0,keyboard:{enabled:!0,onlyInViewport:!0},navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},breakpoints:{1:{slidesPerView:3,slidesPerGroup:1},768:{slidesPerView:4},1400:{slidesPerView:6}},on:{init:function(){this.slides.forEach((e=>{e.classList.remove("keyboard-focused")}))},slideChange:function(){this.slides.forEach((e=>{e.classList.remove("keyboard-focused")}));const e=this.slides[this.activeIndex];e&&e.classList.add("keyboard-focused")},transitionStart:function(){var e=document.querySelectorAll("video");Array.prototype.forEach.call(e,(function(e){e.pause()}))}}});function n(e){if(window.innerWidth>1){e.slides.forEach((e=>{e.classList.remove("first-visible-slide","last-visible-slide")}));const t=Array.from(e.slides).filter((e=>e.classList.contains("swiper-slide-visible")));t.length>0&&(t[0].classList.add("first-visible-slide"),t[t.length-1].classList.add("last-visible-slide"))}else e.slides.forEach((e=>{e.classList.remove("first-visible-slide","last-visible-slide")}))}let d;function o(){clearTimeout(d),d=setTimeout((function(){n(t)}),250)}t.on("init slideChange update",(function(){n(this)})),window.addEventListener("resize",o),n(t);let s=!1;function i(e){const n=e.key;let o="Tab"===n,i=e.shiftKey;("ArrowLeft"===n||"ArrowRight"===n||o&&!i||o&&i)&&(s=!0,setTimeout((()=>{s?(t.slides.forEach((e=>e.classList.add("keyboard-focused"))),s=!0):t.slides.forEach((e=>e.classList.remove("keyboard-focused")))}),50))}function r(){t.slides.forEach((e=>{e.classList.remove("keyboard-focused")})),e[0].classList.remove("keyboard-focused"),s=!1}document.addEventListener("keydown",i),document.addEventListener("click",(function(e){e.target.classList.contains("swiper-button-next")&&r(),e.target.classList.contains("swiper-button-prev")&&r()})),setTimeout((()=>{r()}),200),window.addEventListener("resize",(function(){setTimeout((()=>{r()}),200)}));const u=document.querySelector(".video-carousel-swiper-container");if(!u)return void console.warn("Swiper container not found.");function a(e){return e.classList.contains("image-placeholder-action")||"VIDEO"===e.tagName||e.classList.contains("btn")}function c(e){const t=undefined;a(e.target)&&u.classList.add("container-focused-class")}function l(e){const t=undefined;a(e.target)&&u.classList.remove("container-focused-class")}u.addEventListener("focusin",c),u.addEventListener("focusout",l)}})),document.addEventListener("DOMContentLoaded",(function(){const e=undefined;if(document.querySelectorAll(".image-placeholder-action").length){var t=document.querySelectorAll(".image-placeholder-action"),n=document.querySelectorAll(".image-placeholder"),o=document.querySelectorAll(".image-object");function i(e){o.forEach((function(e){e.classList.remove("image-hold")})),n.forEach((function(e){e.classList.remove("image-hold")}));var t=e.closest(".slide-container"),i=t.querySelector(".image-placeholder"),r=t.querySelector("video"),a=t.querySelector(".image-object");document.querySelectorAll(".slide-container").forEach((function(e){e.classList.remove("image-hold")})),document.querySelectorAll(".slide-container video").forEach((function(n){n!==e.closest(".slide-container").querySelector("video")&&(n.pause(),n.controls=!1,i.classList.remove("image-hold"),t.classList.remove("image-hold"))})),r.paused&&(i.classList.add("image-hold"),a.classList.add("image-hold"),t.classList.add("image-hold"),r.controls=!0),r.addEventListener("ended",(function(){document.querySelectorAll(".slide-container video").forEach((function(e){e!==r&&(e.pause(),e.controls=!1,i.classList.remove("image-hold"),i.classList.remove("image-hold"),a.classList.remove("image-hold"),t.classList.remove("image-hold"))}))})),r.paused?r.play():r.pause()}t.forEach((function(e){e.addEventListener("click",(function(){i(e)}))})),document.getElementById("video-placeholder").play(),jQuery(".video-placeholder").on("click",(function(){var e=jQuery("#video-placeholder").get(0);e.paused?(e.play(),jQuery(this).hide()):(e.pause(),jQuery(this).show())}));var r=document.getElementById("video-placeholder"),a=document.querySelector(".video_block_template_container_media_placeholder_action_btn"),c=document.querySelector(".video_block_template_container_media_placeholder_action_btn .text");a.addEventListener("click",(function(){r.paused?(r.play(),a.ariaPressed=!1,c.textContent="Pause Video"):(r.pause(),a.ariaPressed=!0,c.textContent="Play Video")}))}})),document.addEventListener("DOMContentLoaded",(function(){const e=undefined;if(document.querySelectorAll(".pricing_calculator_template").length){class i{constructor(e){this.rootEl=e,this.buttonEl=this.rootEl.querySelector("button[aria-expanded]");const t=this.buttonEl.getAttribute("aria-controls");this.contentEl=document.getElementById(t),this.open="true"===this.buttonEl.getAttribute("aria-expanded"),this.buttonEl.addEventListener("click",this.onButtonClick.bind(this))}onButtonClick(){this.toggle(!this.open)}toggle(e){e!==this.open&&(this.open=e,this.buttonEl.setAttribute("aria-expanded",`${e}`),e?this.contentEl.removeAttribute("hidden"):this.contentEl.setAttribute("hidden",""))}open(){this.toggle(!0)}close(){this.toggle(!1)}}const r=undefined;function t(e){var t=parseInt(e.data("price"),10),o=parseInt(e.data("enrollment"),10),i=e.data("benefits"),r=e.data("disclaimer"),a=e.data("unique-id"),c=jQuery(".large_set .price"),l=jQuery(".info_set_number"),d=jQuery(".pricing_calculator_template_container_main_info_ul ul"),s=jQuery(".pricing_calculator_template_container_main_pricing_disclaimer"),u=parseInt(c.text(),10),m=parseInt(l.text(),10);c.text(u+t),l.text(m+o),d.append(i),s.append('<span data-unique-id="'+a+'">'+r+"</span>"),n()}function n(){var e,t=document.querySelector(".pricing_calculator_template_container_main").textContent,n=document.getElementById("aria-read");n?(n.textContent="",n.textContent+=" "+t+" "):console.log('Element with ID "aria-read" not found.')}function o(e){var t=parseInt(e.data("price"),10),o=parseInt(e.data("enrollment"),10),i=e.data("benefits"),r=e.data("disclaimer"),a=e.data("unique-id"),c=jQuery(".large_set .price"),l=jQuery(".info_set_number"),d=jQuery(".pricing_calculator_template_container_main_info_ul ul"),s=jQuery(".pricing_calculator_template_container_main_pricing_disclaimer"),u=parseInt(c.text(),10),m=parseInt(l.text(),10);c.text(u-t),l.text(m-o),d.find('[data-unique-id="'+a+'"]').remove(),s.find('[data-unique-id="'+a+'"]').remove(),n()}document.querySelectorAll(".pricing_calculator_accordion .pricing_calculator_accordion_item_title").forEach((e=>{new i(e)})),jQuery(".action, .pricing_calculator_accordion_add").on("click",(function(){var e=jQuery(this),n=e.data("added"),i=e.closest(".pricing_calculator_accordion_item");n?(e.closest(".pricing_calculator_accordion_item").find(".pricing_calculator_accordion_add,.action.btn").data("added",!1).attr("data-added","false"),e.closest(".pricing_calculator_accordion_item").find(".pricing_calculator_accordion_add,.action.btn").attr("aria-pressed","false"),jQuery(i).removeClass("pricing_calculator_accordion_add_active"),o(e),e.closest(".pricing_calculator_accordion_item").find(".action").text("Add Service")):(e.closest(".pricing_calculator_accordion_item").find(".pricing_calculator_accordion_add,.action.btn").data("added",!0).attr("data-added","true"),e.closest(".pricing_calculator_accordion_item").find(".pricing_calculator_accordion_add,.action.btn").attr("aria-pressed","true"),t(e),jQuery(i).addClass("pricing_calculator_accordion_add_active"),e.closest(".pricing_calculator_accordion_item").find(".action").text("Remove Service"))}))}}));