jQuery((function(e){var t=!1,n=0,o=e(".site-header").height();e(window).scroll((function(){t=!0})),setInterval((function(){t&&(!function(){var t=e(this).scrollTop();if(Math.abs(n-t)<=5)return;t>o?t>n&&!e(".site-header .nav-menu").hasClass("active")?e("body").removeClass("nav-down").addClass("nav-up"):t+e(window).height()<e(document).height()&&e("body").removeClass("nav-up").addClass("nav-down"):e("body").removeClass("nav-down").removeClass("nav-up");n=t}(),t=!1)}),250),e(".backtotop").click((function(){e("body").removeClass("nav-up").removeClass("nav-down")}))})),window.addEventListener("load",(function(){let e=0,t="tab-0";const n=document.querySelector(".tabbed-content-block"),o=document.querySelectorAll(".tabbed-content__nav-item button");n&&o.forEach((n=>{n.addEventListener("keydown",(function(o){o.currentTarget;var c=!1;switch(o.key){case"ArrowLeft":!function(n){0==e?e=0:e--;t="tab-"+e;n=document.querySelector(`button[data-link="${t}"]`);n.focus()}(n),c=!0;break;case"ArrowRight":!function(n){e++,t="tab-"+e;n=document.querySelector(`button[data-link="${t}"]`);n.focus()}(n),c=!0}c&&(o.stopPropagation(),o.preventDefault())})),n.addEventListener("click",(function(){let e=n.getAttribute("data-link");if(o.forEach((e=>e.classList.remove("active"))),o.forEach((e=>e.setAttribute("aria-selected","false"))),o.forEach((e=>e.setAttribute("tabindex","-1"))),document.querySelectorAll(".tabbed-content__content__pane").forEach((e=>{e.classList.remove("tabbed-content__content__pane--active")})),e){document.querySelectorAll("#"+e).forEach((e=>{e.classList.add("tabbed-content__content__pane--active")}))}n.classList.add("active"),n.setAttribute("aria-selected","true"),n.removeAttribute("tabindex")}))}))})),window.addEventListener("load",(function(){if(document.querySelector(".resource-links-container")){const n=document.querySelectorAll(".resource-links-container-links-link-button , .dropdown-li");function e(e){var t=e.currentTarget;switch(console.log(t),e.key){case"ArrowUp":!function(e){let t=Array.from(document.querySelectorAll(".dropdown-li")).indexOf(e);if(-1!==t&&t<document.querySelectorAll(".dropdown-li").length-1)if(t-1!=-1)document.querySelectorAll(".dropdown-li")[t-1].focus();else{document.getElementById("resource-links-dropdown").focus()}}(t);break;case"ArrowDown":!function(e){console.log(Array.from(document.querySelectorAll(".dropdown-li")).indexOf(e));let t=Array.from(document.querySelectorAll(".dropdown-li")).indexOf(e);-1!==t&&t<document.querySelectorAll(".dropdown-li").length-1&&document.querySelectorAll(".dropdown-li")[t+1].focus()}(t)}}function t(e){var t=e.currentTarget;switch(e.key){case"ArrowLeft":!function(e){let t=Array.from(n).indexOf(e);-1!==t&&t<n.length-1&&n[t-1].focus()}(t);break;case"ArrowRight":!function(e){let t=Array.from(n).indexOf(e);-1!==t&&t<n.length-1&&n[t+1].focus()}(t)}}n.forEach((e=>{e.addEventListener("click",(function(t){let o=e.getAttribute("data-resourcelink");if(n.forEach((e=>e.classList.remove("active"))),document.querySelectorAll(".resource-links-loop-container-item").forEach((e=>{e.classList.remove("resource-links-loop-container-item--active")})),o){document.querySelectorAll("#"+o).forEach((e=>{e.classList.add("resource-links-loop-container-item--active")}))}e.classList.add("active");let c=document.getElementById(o).querySelector(".title");c&&c.focus()}))})),n.forEach((e=>{e.addEventListener("keydown",t)})),document.querySelectorAll("#resource-links-dropdown").forEach((function(e){e.addEventListener("click",(function(){this.classList.toggle("active");var e=document.querySelector(".resource-links-dropdown-list");e.classList.toggle("active"),e.focus()}))})),document.querySelectorAll(".dropdown-li").forEach((function(e){e.addEventListener("click",(function(t){let n=document.getElementById("resource-links-dropdown");document.querySelector(".resource-links-dropdown-list").classList.remove("active"),n.innerHTML=e.innerHTML,n.classList.remove("active")})),e.addEventListener("keydown",(function(t){if(13==t.keyCode){let o=document.getElementById("resource-links-dropdown");document.querySelector(".resource-links-dropdown-list").classList.remove("active"),o.innerHTML=e.innerHTML,o.classList.remove("active");let c=t.target.getAttribute("data-resourcelink");if(n.forEach((e=>e.classList.remove("active"))),document.querySelectorAll(".resource-links-loop-container-item").forEach((e=>{e.classList.remove("resource-links-loop-container-item--active")})),c){document.querySelectorAll("#"+c).forEach((e=>{e.classList.add("resource-links-loop-container-item--active")}))}let r=document.getElementById(c).querySelector("a");r&&r.focus()}}))})),document.querySelector("#resource-links-dropdown").addEventListener("keydown",(function(e){if("ArrowDown"==e.key){let e=document.querySelector(".resource-links-dropdown-list .dropdown-li");e&&e.focus()}})),document.querySelectorAll(".dropdown-li").forEach((t=>{t.addEventListener("keydown",e)}))}})),document.addEventListener("DOMContentLoaded",(function(){document.querySelectorAll(".widget-title").forEach((e=>{e.setAttribute("tabindex","0"),e.addEventListener("keypress",(function(){this.classList.toggle("active"),this.nextElementSibling&&this.nextElementSibling.classList.toggle("active")})),e.addEventListener("click",(function(){this.classList.toggle("active"),this.nextElementSibling&&this.nextElementSibling.classList.toggle("active")}))}))})),jQuery((function(e){var t,n="a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, *[tabindex], *[contenteditable]";function o(t){e(t).find("*").filter(n).filter(":visible").first().focus()}function c(){jQuery(".modal").css("display","none"),jQuery(".modal").attr("aria-hidden","true"),jQuery(" body").attr("aria-hidden","false"),jQuery("body").off("focusin"," body"),jQuery(".modal").attr("aria-hidden","true"),t.focus()}e(document).ready((function(){e(".iframe_capture").on("focus",(function(){e(this).closest(".close-btn").focus()}))})),e(document).ready((function(){jQuery(".modal-btn").click((function(n){var c,r="true"===e(this).attr("aria-expanded");modalId=e(n.currentTarget).data("modal"),c=modalId,jQuery("body").attr("aria-hidden","true"),jQuery("#"+c).css("display","block"),jQuery("#"+c).attr("aria-hidden","false"),jQuery("body").on("focusin","body",(function(){o("#"+c)})),t=jQuery(":focus"),o("#"+c),e(this).attr("aria-expanded",!r)})),jQuery(".modal .close-btn").click((function(e){c()})),jQuery(".modal .close-btnButton").click((function(e){c()})),jQuery(".modal").keydown((function(t){!function(e,t){if(9==t.which){var o,c,r,i;console.log(e),o=e.find("*").filter(n).filter(":visible"),c=jQuery(":focus"),r=o.length,i=o.index(c),t.shiftKey?0==i&&(o.get(r-1).focus(),t.preventDefault()):i==r-1&&(o.get(0).focus(),t.preventDefault())}}(e(this),t)})),jQuery(".modal").keydown((function(t){!function(e,t){if(27==t.which){e.find("*").filter(".modal .close-btn"),c(),t.preventDefault()}}(e(this),t)}))}))})),window.addEventListener("load",(function(){const e=document.querySelectorAll(".accordion-block-container-accordion__button");e&&e.forEach((e=>{e.addEventListener("click",(()=>{const t=e.getAttribute("aria-controls"),n=document.getElementById(t);"true"===e.getAttribute("aria-expanded")?(e.setAttribute("aria-expanded","false"),n.classList.remove("active-content")):(e.setAttribute("aria-expanded","true"),n.classList.add("active-content"))}))}))})),window.addEventListener("load",(function(){const e=document.querySelectorAll(".tab-block-container__heading__button");if(e){function t(){e.forEach((e=>{const t=e.getAttribute("aria-controls");document.getElementById(t).classList.remove("active-content"),e.setAttribute("aria-expanded","false")}))}e.forEach((e=>{e.addEventListener("click",(()=>{const n=e.getAttribute("aria-controls"),o=document.getElementById(n);t(),"true"===e.getAttribute("aria-expanded")?(e.setAttribute("aria-expanded","false"),o.classList.remove("active-content")):(e.setAttribute("aria-expanded","true"),o.classList.add("active-content"))}))})),e.forEach(((t,n)=>{t.addEventListener("keydown",(function(o){let c;if(console.log(o.keyCode),40===o.keyCode){const e=t.getAttribute("aria-controls"),n=document.getElementById(e);n&&n.focus()}if(37===o.keyCode)c=(n-1+e.length)%e.length,e[c].focus();else{if(39!==o.keyCode)return;c=(n+1)%e.length,e[c].focus()}}))}));const n=document.querySelector(".tab-block-container-tab-block_header-buttons_mobile_select");n.addEventListener("change",(function(){const e=n.options[n.selectedIndex].getAttribute("aria-controls"),o=document.getElementById(e);t(),o.classList.add("active-content")}))}})),window.addEventListener("load",(function(){function e(){!function(e){let t=document.querySelector(".team-hightlight-block-container-team-hightlight__load_more button"),n=document.querySelector(".team-hightlight-block-container-team-hightlight__load_more button .text");if(t){let o=document.querySelectorAll(".team-hightlight-block-container-team-hightlight-member"),c=n.innerText;if(o.length>=4){let r=!1;e<=768?(o.forEach((function(e,t){e.tabIndex=t<4?0:-1})),o[0].tabIndex=0):document.querySelector(".team-hightlight-block-styling-1")||o.forEach((function(e){e.tabIndex=0})),t.addEventListener("click",(function(){o.forEach((function(e){r?(e.classList.add("hidden"),e.classList.remove("animate"),o.forEach((function(e,t){e.tabIndex=t<4?0:-1}))):(e.classList.remove("hidden"),e.classList.add("animate"))}));var e="true"===this.getAttribute("aria-expanded");this.setAttribute("aria-expanded",e?"false":"true");for(var t=0;t<4&&t<o.length;t++)o[t].classList.remove("hidden");o[0].focus(),this.classList.add("active"),n.innerText=0==r?"Show Less":c,setTimeout((function(){o.forEach((function(e){r?e.classList.remove("animate"):e.classList.add("animate")}))}),500),r=!r}))}}}(window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth)}e(),window.addEventListener("resize",e)})),window.addEventListener("DOMContentLoaded",(()=>{if(document.querySelectorAll(".toc_container").length>0){let e=document.querySelector(".toc_container").querySelectorAll("h2");const t=[];e.forEach(((e,n)=>{const o=`toc_${n+1}`;e.id=o,t.push(o)}));const n=document.querySelector(".toc-nav"),o=document.createElement("ul");t.forEach((e=>{const t=document.createElement("li"),n=document.createElement("a");n.href=`#${e}`,n.textContent=document.querySelector(`#${e}`).textContent,t.appendChild(n),o.appendChild(t)})),n.appendChild(o);const c=document.querySelector(".toc-nav"),r=document.querySelector(".contents-nav-mobile-menu"),i=document.querySelector(".toc_content_load_point");if(c&&r){const e=c.cloneNode(!0);for(;e.firstChild;)r.appendChild(e.firstChild)}if(i){const e=c.cloneNode(!0);for(;e.firstChild;)i.appendChild(e.firstChild)}let a=null,l=null,d=null,s=document.querySelector(".toc_content_load_point");const u=new IntersectionObserver((e=>{e.forEach((e=>{const t=e.target.getAttribute("id");if(e.intersectionRatio>0){l&&l.classList.remove("active"),a&&a.classList.remove("active"),d&&d.classList.remove("active");const e=document.querySelector(`.toc-nav li a[href="#${t}"]`).parentElement,n=document.querySelector(`.contents-nav-mobile-menu li a[href="#${t}"]`).parentElement;if(s){const e=document.querySelector(`.toc_content_load_point li a[href="#${t}"]`).parentElement;e.classList.add("active"),d=e}e.classList.add("active"),n.classList.add("active"),a=e,l=n}}))}));document.querySelectorAll(".toc_container h2").forEach((e=>{u.observe(e)})),window.addEventListener("scroll",(function(){var e=document.querySelector(".inner-hero");if(e){var t=e.getBoundingClientRect().bottom,n=document.querySelector(".contents-nav-mobile"),o=document.querySelector(".site-header");t<0?(n.classList.add("scroll_active"),o.classList.add("scroll_active")):(n.classList.remove("scroll_active"),o.classList.remove("scroll_active"))}}));document.querySelectorAll(".contents-nav-mobile-menu a, .toc-nav a").forEach((e=>{e.addEventListener("click",(t=>{const n=e.getAttribute("href"),o=document.querySelector(n);if(o){o.focus(),document.querySelector(".contents-nav-mobile").classList.toggle("active")}}))}));const f=document.querySelector(".contents-nav-mobile-header-dropdown-select"),m=document.querySelector(".contents-nav-mobile");f.addEventListener("click",(()=>{m.classList.toggle("active")}))}})),document.addEventListener("DOMContentLoaded",(function(){const e=document.querySelectorAll(".vendor_information_block_container_column_two_link_more_info");e.length>0&&e.forEach((e=>{e.addEventListener("click",(e=>{const t=e.target.getAttribute("aria-controls"),n=document.getElementById(t);if(n){e.target.classList.toggle("active_btn"),n.toggleAttribute("hidden");const t="true"===e.target.getAttribute("aria-expanded");e.target.setAttribute("aria-expanded",!t),e.target.innerHTML=t?'More Information <span><svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L6.50008 6.50008L12.0002 1" stroke="#82BC46"/></svg></span>':'Less Information<span><svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L6.50008 6.50008L12.0002 1" stroke="#82BC46"/></svg></span>'}}))}))}));