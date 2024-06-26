/* eslint-env jquery */

// Sticky Header
jQuery(function ($) {

	function navbarheight() {
		return $('.site-header').height();
	}

	// Header Scroll
	var didScroll = false,
		lastScrollTop = 0,
		delta = 5,
		navbarHeight = navbarheight();

	$(window).scroll(function () {
		didScroll = true;
	});

	setInterval(function () {
		if (didScroll) {
			hasScrolled();
			didScroll = false;
		}
	}, 250);

	function hasScrolled() {
		var st = $(this).scrollTop();

		// Make sure they scroll more than delta
		if (Math.abs(lastScrollTop - st) <= delta)
			return;

		if (st > navbarHeight) {

			if (st > lastScrollTop && !$('.site-header .nav-menu').hasClass('active')) {
				// Scroll Down
				$('body').removeClass('nav-down').addClass('nav-up');
			} else {
				// Scroll Up
				if (st + $(window).height() < $(document).height()) {
					$('body').removeClass('nav-up').addClass('nav-down');
				}
			}

		} else {
			$('body').removeClass('nav-down').removeClass('nav-up');
		}
		lastScrollTop = st;
	}

	$('.backtotop').click(function () {
		$('body').removeClass('nav-up').removeClass('nav-down');
	});
});



window.addEventListener("load", function () {
	let firstTab = null;
	let lastTab = null;
	let currentTab = 0;
	let nextTab = 'tab-' + 0;
	// tabbed content
	const tabbedContent = document.querySelector('.tabbed-content-block');
	// Grab all buttons with the class tabbed-content__nav-item

	const tabButtons = document.querySelectorAll('.tabbed-content__nav-item button');

	if (tabbedContent) {

		tabButtons.forEach(button => {

			button.addEventListener('keydown', function (event) {

				var tgt = event.currentTarget,
					flag = false;

				switch (event.key) {
					case 'ArrowLeft':
						moveFocusToPreviousTab(button);
						flag = true;
						break;

					case 'ArrowRight':
						moveFocusToNextTab(button);
						flag = true;
						break;

					default:
						break;
				}

				if (flag) {
					event.stopPropagation();
					event.preventDefault();
				}
			});

			// Add a click event listener to each button
			button.addEventListener('click', function () {
				// Get the value of the data-target attribute
				let targetClass = button.getAttribute('data-link');

				// Remove active class from all items before adding to the new one
				tabButtons.forEach(btn => btn.classList.remove('active'));
				tabButtons.forEach(btn => btn.setAttribute('aria-selected', 'false'));
				tabButtons.forEach(btn => btn.setAttribute('tabindex', '-1'));

				let panes = document.querySelectorAll('.tabbed-content__content__pane');
				panes.forEach(element => {
					element.classList.remove('tabbed-content__content__pane--active');
				});

				// If a class that matches the data attribute exists, add the active class
				if (targetClass) {
					let targetElements = document.querySelectorAll('#' + targetClass);
					targetElements.forEach(element => {
						element.classList.add('tabbed-content__content__pane--active');
					});
				}

				// Add active class to the clicked button
				button.classList.add('active');

				button.setAttribute('aria-selected', 'true');
				button.removeAttribute('tabindex');
			});
		});
	}

	function moveFocusToPreviousTab(button) {
		if (currentTab == 0) {
			currentTab = 0
		} else {
			currentTab--;
		}

		nextTab = 'tab-' + currentTab;

		var button = document.querySelector(`button[data-link="${nextTab}"]`);
		button.focus();

	}

	function moveFocusToNextTab(button) {
		currentTab++;
		nextTab = 'tab-' + currentTab;

		var button = document.querySelector(`button[data-link="${nextTab}"]`);
		button.focus();

	}
});

window.addEventListener("load", function () {
	// resource links
	const tabbedContent = document.querySelector('.resource-links-container');
	if (tabbedContent) {
		// Grab all buttons with the class tabbed-content__nav-item
		const tabButtons = document.querySelectorAll('button.resource-links-container-links-link-button , .dropdown-li');

		tabButtons.forEach(button => {
			// Add a click event listener to each button
			button.addEventListener('click', function (event) {
				// Get the value of the data-target attribute
				let targetClass = button.getAttribute('data-resourcelink');
				// Remove active class from all items before adding to the new one
				tabButtons.forEach(btn => btn.classList.remove('active'));

				let panes = document.querySelectorAll('.resource-links-loop-container-item');
				panes.forEach(element => {
					element.classList.remove('resource-links-loop-container-item--active');
				});

				// If a class that matches the data attribute exists, add the active class
				if (targetClass) {
					let targetElements = document.querySelectorAll('#' + targetClass);
					targetElements.forEach(element => {
						element.classList.add('resource-links-loop-container-item--active');
					});
				}

				// Add active class to the clicked button
				button.classList.add('active');
				let firstLink = document.getElementById(targetClass).querySelector('.title');
				if (firstLink) {
					firstLink.focus();
				}
			});

		});

		tabButtons.forEach(button => {
			// Add a click event listener to each button
			button.addEventListener('keydown', onKeydown);
		});

		document.querySelectorAll('#resource-links-dropdown').forEach(function (element) {
			element.addEventListener('click', function () {
				this.classList.toggle('active');
				var target = document.querySelector('.resource-links-dropdown-list');
				target.classList.toggle('active');
				target.focus();
			});
		});

		document.querySelectorAll('.dropdown-li').forEach(function (element) {
			element.addEventListener('click', function (event) {
				let target = document.getElementById('resource-links-dropdown');
				let button = document.querySelector('.resource-links-dropdown-list');

				button.classList.remove('active');
				target.innerHTML = element.innerHTML;
				target.classList.remove('active');
			});

			element.addEventListener('keydown', function (event) {
				if (event.keyCode == 13) {

					let target = document.getElementById('resource-links-dropdown');
					let dropdown = document.querySelector('.resource-links-dropdown-list');

					dropdown.classList.remove('active');
					target.innerHTML = element.innerHTML;
					target.classList.remove('active');

					// Get the value of the data-target attribute
					let targetClass = event.target.getAttribute('data-resourcelink');
					// Remove active class from all items before adding to the new one
					tabButtons.forEach(btn => btn.classList.remove('active'));

					let panes = document.querySelectorAll('.resource-links-loop-container-item');
					panes.forEach(element => {
						element.classList.remove('resource-links-loop-container-item--active');
					});

					// If a class that matches the data attribute exists, add the active class
					if (targetClass) {
						let targetElements = document.querySelectorAll('#' + targetClass);
						targetElements.forEach(element => {
							element.classList.add('resource-links-loop-container-item--active');
						});
					}

					// Add active class to the clicked button
					// button.classList.add('active');
					let firstLink = document.getElementById(targetClass).querySelector('a');
					if (firstLink) {
						firstLink.focus();
					}
				}

			});


		});

		document.querySelector('#resource-links-dropdown').addEventListener('keydown', function (event) {
			if (event.key == 'ArrowDown') {
				let firstLink = document.querySelector('.resource-links-dropdown-list .dropdown-li');
				if (firstLink) {
					firstLink.focus();
				}
			}
		});

		document.querySelectorAll('.dropdown-li').forEach(button => {
			// Add a click event listener to each button
			button.addEventListener('keydown', onKeydownDropdown);
		});


		function onKeydownDropdown(event) {

			var tgt = event.currentTarget;
			switch (event.key) {
				case 'ArrowUp':
					moveFocusToPreviousTabDropdown(tgt);
					break;

				case 'ArrowDown':
					moveFocusToNextTabDropdown(tgt);
					break;
				default:
					break;
			}

		}


		function onKeydown(event) {

			var tgt = event.currentTarget;

			switch (event.key) {
				case 'ArrowLeft':
					moveFocusToPreviousTab(tgt);
					break;

				case 'ArrowRight':
					moveFocusToNextTab(tgt);
					break;

				default:
					break;
			}

		}

		function moveFocusToNextTabDropdown(event) {
			let currentIndex = Array.from(document.querySelectorAll('.dropdown-li')).indexOf(event);
			if (currentIndex !== -1 && currentIndex < document.querySelectorAll('.dropdown-li').length - 1) {
				document.querySelectorAll('.dropdown-li')[currentIndex + 1].focus();
			}
		}

		function moveFocusToPreviousTabDropdown(event) {
			let currentIndex = Array.from(document.querySelectorAll('.dropdown-li')).indexOf(event);
			if (currentIndex !== -1 && currentIndex < document.querySelectorAll('.dropdown-li').length - 1) {
				if (currentIndex - 1 != -1) {
					document.querySelectorAll('.dropdown-li')[currentIndex - 1].focus();
				} else {
					let focusItem = document.getElementById('resource-links-dropdown')
					focusItem.focus();
				}

			}
		}

		function moveFocusToNextTab(event) {
			let currentIndex = Array.from(tabButtons).indexOf(event);
			if (currentIndex !== -1 && currentIndex < tabButtons.length - 1) {
				tabButtons[currentIndex + 1].focus();
			}
		}

		function moveFocusToPreviousTab(event) {
			let currentIndex = Array.from(tabButtons).indexOf(event);
			if (currentIndex !== -1 && currentIndex < tabButtons.length - 1) {
				tabButtons[currentIndex - 1].focus();
			}
		}
	}

});


document.addEventListener('DOMContentLoaded', function () {
	function footerMenuFunctions() {

		// Find all elements with class .widget-title
		const widgetTitles = document.querySelectorAll('.widget-title');
		// Get all sections with id pattern 'nav_menu-*'
		var sections = document.querySelectorAll('[id^="nav_menu-"]');
		// Loop through each section
		sections.forEach(function (section) {
			// Extract the current id of the section
			var sectionId = section.id;
			// Create a unique id by appending a suffix
			var uniqueId = sectionId + '_footer';
			// Get the menu-footer-container within the section
			var menuFooterContainer = section.querySelector('.menu-footer-container');
			if (menuFooterContainer) {
				// Set the unique id to the menu-footer-container
				menuFooterContainer.id = uniqueId;
			}
			menuFooterContainer = section.querySelector('.menu-home-footer-container');
			if (menuFooterContainer) {
				// Set the unique id to the menu-home-footer-container
				menuFooterContainer.id = uniqueId;
			}
			menuFooterContainer = section.querySelector('.menu-footer-privacy-container');
			if (menuFooterContainer) {
				// Set the unique id to the menu-footer-privacy-container
				menuFooterContainer.id = uniqueId;
			}
		});

		widgetTitles.forEach(function (title) {
			var menuFooterContainer = title.nextElementSibling;
			if (menuFooterContainer && menuFooterContainer.classList.contains('menu-footer-container')) {
				var containerId = menuFooterContainer.id;
				title.setAttribute('aria-controls', containerId);
			}
			if (menuFooterContainer && menuFooterContainer.classList.contains('menu-home-footer-container')) {
				var containerId = menuFooterContainer.id;
				title.setAttribute('aria-controls', containerId);
			}
			if (menuFooterContainer && menuFooterContainer.classList.contains('menu-footer-privacy-container')) {
				var containerId = menuFooterContainer.id;
				title.setAttribute('aria-controls', containerId);
			}

			title.setAttribute('tabindex', '0');
			title.setAttribute('role', 'button');
			title.setAttribute('aria-expanded', 'false');


		});
		widgetTitles.forEach(function (title) {

			title.addEventListener('click', function () {
				// Check if there's a next sibling element
				this.classList.toggle('active');
				let sibling = this.nextElementSibling;
				// if (sibling) {
				var isExpanded = title.getAttribute('aria-expanded');
				this.nextElementSibling.classList.toggle('active');
				this.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
				// }
			}, true);
		});

	}

	let widgetTitlesRespo = document.querySelectorAll('.widget-title');

	function handleTitleClick() {
		this.classList.toggle('active');
		let sibling = this.nextElementSibling;
		if (sibling) {
			var isExpanded = this.getAttribute('aria-expanded');
			sibling.classList.toggle('active');
			this.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
		}
	}

	window.addEventListener('resize', function () {
		if (window.innerWidth < 768) {
			footerMenuFunctions();
			widgetTitlesRespo.forEach(title => {
				title.addEventListener('click', handleTitleClick);
			});
		} else {
			widgetTitlesRespo.forEach(title => {
				title.removeAttribute('tabindex');
				title.removeAttribute('role');
				title.removeAttribute('aria-expanded');
				title.removeAttribute('aria-controls');
				title.removeEventListener('click', handleTitleClick);
			});
		}
	});

	if (window.innerWidth < 768) {
		footerMenuFunctions();
	}
});



jQuery(function ($) {

	// jQuery formatted selector to search for focusable items
	var focusableElementsString = "a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, video, object, embed, *[tabindex], *[contenteditable]";

	// store the item that has focus before opening the modal window
	var focusedElementBeforeModal;

	$(document).ready(function () {
		$('.iframe_capture').on('focus', function () {
			// Shift focus to another element, for example, an element with the ID 'desiredElementId'
			$(this).closest('.close-btn').focus();
		});
	});

	$(document).ready(function () {
		jQuery('.modal-btn').click(function (event) {
			var isExpanded = $(this).attr('aria-expanded') === 'true';

			modalId = $(event.currentTarget).data('modal')
			showModal(modalId);
			$(this).attr('aria-expanded', !isExpanded);
		});

		jQuery('.modal .close-btn').click(function (e) {
			hideModal();
		});

		jQuery('.modal .close-btnButton').click(function (e) {
			hideModal();
		});

		jQuery('.modal').keydown(function (event) {
			trapTabKey($(this), event);
		})

		jQuery('.modal').keydown(function (event) {
			trapEscapeKey($(this), event);
		})

	});

	function trapEscapeKey(obj, evt) {

		// if escape pressed
		if (evt.which == 27) {

			// get list of all children elements in given object
			var o = obj.find('*');

			// get list of focusable items
			var cancelElement;
			cancelElement = o.filter(".modal .close-btn")

			// close the modal window
			hideModal();
			evt.preventDefault();
		}

	}

	function trapTabKey(obj, evt) {

		// if tab or shift-tab pressed
		if (evt.which == 9) {
			// get list of all children elements in given object
			var o = obj.find('*');

			// get list of focusable items
			var focusableItems;
			focusableItems = o.filter(focusableElementsString).filter(':visible')

			// get currently focused item
			var focusedItem;
			focusedItem = jQuery(':focus');

			// get the number of focusable items
			var numberOfFocusableItems;
			numberOfFocusableItems = focusableItems.length

			// get the index of the currently focused item
			var focusedItemIndex;
			focusedItemIndex = focusableItems.index(focusedItem);
			if (evt.shiftKey) {
				//back tab
				// if focused on first item and user preses back-tab, go to the last focusable item
				if (focusedItemIndex == 0) {
					focusableItems.get(numberOfFocusableItems - 1).focus();
					evt.preventDefault();
				}

			} else {
				//forward tab

				// if focused on the last item and user preses tab, go to the first focusable item
				if (focusedItemIndex == numberOfFocusableItems - 1) {
					focusableItems.get(0).focus();
					evt.preventDefault();
				}
			}
		}

	}


	function setFocusToFirstItemInModal(obj) {
		// get list of all children elements in given object
		var o = $(obj).find('*');
		console.log(o.filter(focusableElementsString).filter(':visible'))
		// set the focus to the first keyboard focusable item
		o.filter(focusableElementsString).filter(':visible').first().focus();
	}

	function showModal(obj) {
		jQuery('body').attr('aria-hidden', 'true'); // mark the main page as hidden
		// jQuery('.modalOverlay').css('display', 'block'); // insert an overlay to prevent clicking and make a visual change to indicate the main apge is not available
		jQuery('#' + obj).css('display', 'block'); // make the modal window visible
		jQuery('#' + obj).attr('aria-hidden', 'false'); // mark the modal window as visible
		jQuery('body').addClass('modal-active');
		// attach a listener to redirect the tab to the modal window if the user somehow gets out of the modal window
		jQuery('body').on('focusin', 'body', function () {
			setFocusToFirstItemInModal('#' + obj);
		})
		// save current focus
		focusedElementBeforeModal = jQuery(':focus');
		setFocusToFirstItemInModal('#' + obj);

		var video = jQuery('#' + obj).find('.video-modal-autoplay').get(0);
		if (video) {
			video.play();
		}

	}

	function hideModal() {
		jQuery('body').removeClass('modal-active');
		jQuery('.modal').css('display', 'none'); // hide the modal window
		jQuery('.modal').attr('aria-hidden', 'true'); // mark the modal window as hidden
		jQuery(' body').attr('aria-hidden', 'false'); // mark the main page as visible

		jQuery('.modal-btn').attr('aria-expanded', false);

		// remove the listener which redirects tab keys in the main content area to the modal
		jQuery('body').off('focusin', ' body');

		jQuery('.modal').attr('aria-hidden', 'true');

		const modal_videos = document.querySelectorAll('.modal video');

		// Pause each video found
		modal_videos.forEach(function (video) {
			video.pause();
		});

		// set focus back to element that had it before the modal was opened
		focusedElementBeforeModal.focus();
	}
});

(function () {

	window.addEventListener("DOMContentLoaded", function () {
		// resource links
		let accordionButtons = document.querySelectorAll('.accordion-block-container-accordion__button');


		if (accordionButtons.length > 0) {
			// Accordion
			accordionButtons.forEach(button => {

				button.addEventListener('click', () => {
					const contentId = button.getAttribute('aria-controls');
					const content = document.getElementById(contentId);

					if (button.getAttribute('aria-expanded') === 'true') {
						button.setAttribute('aria-expanded', 'false');
						content.classList.remove('active-content');
					} else {
						button.setAttribute('aria-expanded', 'true');
						content.classList.add('active-content');
					}
				});
			});
		}
	}, false);
})();



window.addEventListener("load", function () {
	// resource links
	const podcastlinkblockButtons = document.querySelectorAll('.tab-block-container-tab-block_header-buttons .tab-block-container__heading__button');
	if (podcastlinkblockButtons.length) {
		function removeAllActiveState() {
			podcastlinkblockButtons.forEach(btn => {
				const contentId = btn.getAttribute('aria-controls');
				const content = document.getElementById(contentId);
				content.classList.remove('active-content');
				btn.setAttribute('aria-selected', 'false');
				btn.setAttribute('tabindex', '-1');
			});
		}

		podcastlinkblockButtons.forEach((button, index) => {
			// if click
			button.addEventListener('click', function () {
				removeAllActiveState();
				button.focus();
				button.removeAttribute('tabindex');
				button.setAttribute('aria-selected', 'true');
				let content = document.getElementById(button.getAttribute('aria-controls'));
				content.classList.add('active-content');
			});
			button.addEventListener('keydown', function (e) {
				let targetIndex;
				// home and end keys
				if (e.keyCode === 36) { // Home
					e.preventDefault();
					targetIndex = 0;
					removeAllActiveState();
					podcastlinkblockButtons[targetIndex].focus();
					podcastlinkblockButtons[targetIndex].removeAttribute('tabindex');
					podcastlinkblockButtons[targetIndex].setAttribute('aria-selected', 'true');
					let contentHome = document.getElementById(podcastlinkblockButtons[targetIndex].getAttribute('aria-controls'));
					contentHome.classList.add('active-content');
				} else if (e.keyCode === 35) { // End
					e.preventDefault();
					targetIndex = podcastlinkblockButtons.length - 1;
					removeAllActiveState();
					podcastlinkblockButtons[targetIndex].focus();
					podcastlinkblockButtons[targetIndex].removeAttribute('tabindex');
					podcastlinkblockButtons[targetIndex].setAttribute('aria-selected', 'true');
					let contentEnd = document.getElementById(podcastlinkblockButtons[targetIndex].getAttribute('aria-controls'));
					contentEnd.classList.add('active-content');
				}
				// Key codes for Left (37) and Right (39) arrow keys
				if (e.keyCode === 37) { // Left Arrow
					targetIndex = (index - 1 + podcastlinkblockButtons.length) % podcastlinkblockButtons.length;
					removeAllActiveState();
					podcastlinkblockButtons[targetIndex].focus();
					podcastlinkblockButtons[targetIndex].removeAttribute('tabindex');
					podcastlinkblockButtons[targetIndex].setAttribute('aria-selected', 'true');
					let contentPrev = document.getElementById(podcastlinkblockButtons[targetIndex].getAttribute('aria-controls'));
					contentPrev.classList.add('active-content');
				} else if (e.keyCode === 39) { // Right Arrow
					targetIndex = (index + 1) % podcastlinkblockButtons.length;
					removeAllActiveState();
					podcastlinkblockButtons[targetIndex].focus();
					podcastlinkblockButtons[targetIndex].removeAttribute('tabindex');
					podcastlinkblockButtons[targetIndex].setAttribute('aria-selected', 'true');
					let contentNext = document.getElementById(podcastlinkblockButtons[targetIndex].getAttribute('aria-controls'));
					contentNext.classList.add('active-content');
				} else {
					return; // If it's none of the arrow keys, exit
				}
			});
		});

		const selectElement = document.querySelector('.tab-block-container-tab-block_header-buttons_mobile_select');

		selectElement.addEventListener('change', function () {
			const selectedOption = selectElement.options[selectElement.selectedIndex];
			const ariaControlsValue = selectedOption.getAttribute('aria-controls');

			const content = document.getElementById(ariaControlsValue);

			removeAllActiveState();

			content.classList.add('active-content');
			selectedOption.setAttribute('aria-selected', 'true');
			selectedOption.setAttribute('tabindex', '0');
		});

	}
});


// team highlight
window.addEventListener("load", function () {

	function checkIsTabletSize() {
		var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

		teamHighlightFunctionality(windowWidth);
	}

	// Initial check on page load
	checkIsTabletSize();

	// Listen for window resize events and recheck
	window.addEventListener('resize', checkIsTabletSize);

	function teamHighlightFunctionality(windowWidth) {
		let highlightButton = document.querySelector('.team-hightlight-block-container-team-hightlight__load_more button')
		let highlightButtonText = document.querySelector('.team-hightlight-block-container-team-hightlight__load_more button .text')

		if (highlightButton) {
			let items = document.querySelectorAll('.team-hightlight-block-container-team-hightlight-member');
			let initText = highlightButtonText.innerText;
			let tabOpen = false;

			if (items.length >= 6) {

				if (windowWidth <= 768) {
					items.forEach(function (item, index) {
						if (index < 6) {
							item.tabIndex = 0;
						} else {
							item.tabIndex = -1;
						}
					});
					items[0].tabIndex = 0;
				} else {
					if (!document.querySelector('.team-hightlight-block-styling-1')) {
						items.forEach(function (item) {
							item.tabIndex = 0;
						});
					}
				}

				highlightButton.addEventListener('click', function () {
					// Remove the "hidden" class and add an "animate" class for each item
					items.forEach(function (item) {

						if (tabOpen) {
							item.classList.add('hidden');
							item.classList.remove('animate');
							items.forEach(function (item, index) {
								if (index < 6) {
									item.tabIndex = 0;
								} else {
									item.tabIndex = -1;
								}
							});

						} else {
							item.classList.remove('hidden');
							item.classList.add('animate');
						}

						// item.tabIndex = 0;
					});

					var currentState = this.getAttribute('aria-expanded') === 'true';
					this.setAttribute('aria-expanded', currentState ? 'false' : 'true');

					for (var i = 0; i < 6 && i < items.length; i++) {
						items[i].classList.remove('hidden');
					}

					items[0].focus()
					// Hide the "Show All" button with a fade-out effect
					this.classList.add('active');

					tabOpen == false ? highlightButtonText.innerText = 'Show Fewer' : highlightButtonText.innerText = initText;

					// After the animation is complete, remove the "animate" class
					setTimeout(function () {
						items.forEach(function (item) {
							tabOpen ? item.classList.remove('animate') : item.classList.add('animate');
						});
					}, 500);

					tabOpen ? tabOpen = false : tabOpen = true;
				});

			}

		}

	}
});


// Lender Table Show More
document.addEventListener('DOMContentLoaded', function () {

	function checkIsTabletSizeLender() {
		var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

		teamLenderFunctionality(windowWidth);
	}

	// Initial check on page load
	checkIsTabletSizeLender();

	// Listen for window resize events and recheck
	window.addEventListener('resize', checkIsTabletSizeLender);

	function teamLenderFunctionality(windowWidth) {
		let highlightButtonLender = document.querySelector('.refinance_lender_section__load_more button');
		let highlightButtonLenderText = document.querySelector('.refinance_lender_section__load_more button .text')

		if (highlightButtonLender) {
			let items = document.querySelectorAll('.data-tr');
			let initText = highlightButtonLenderText;
			let tabOpen = false;

			if (items.length >= 3) {

				if (windowWidth <= 768) {
					items.forEach(function (item, index) {
						if (index < 3) {
							item.tabIndex = 0;
						} else {
							item.tabIndex = -1;
						}
					});
				}

				highlightButtonLender.addEventListener('click', function () {
					items.forEach(function (item) {
						if (tabOpen) {
							item.classList.add('hidden');
							item.classList.remove('animate');
						} else {
							item.classList.remove('hidden');
							item.classList.add('animate');
						}
					});

					var currentState = this.getAttribute('aria-expanded') === 'true';
					this.setAttribute('aria-expanded', currentState ? 'false' : 'true');

					for (var i = 0; i < 3 && i < items.length; i++) {
						items[i].classList.remove('hidden');
					}

					items[0].focus();

					this.classList.toggle('active');
					tabOpen == false ? highlightButtonLenderText = 'Show Fewer' : highlightButtonLenderText = initText;


					tabOpen = !tabOpen; // Toggle the tabOpen state
				});

			}
		}
	}
});

// Table of Contents.
window.addEventListener('DOMContentLoaded', () => {

	let toc_container_entry_content = document.querySelectorAll('.single .post_type_layout_standard .entry-content');
	let toc_container = document.querySelectorAll('.toc_container');

	if (toc_container.length > 0 || toc_container_entry_content.length > 0) {

		// Get all <h2> elements within .toc_container
		let tocContainer;
		let h2Elements;
		if (toc_container.length > 0) {
			tocContainer = document.querySelector('.toc_container');
			h2Elements = tocContainer.querySelectorAll('h2');
		} else if (toc_container_entry_content.length > 0) {
			tocContainer = document.querySelector('.post_type_layout_standard .entry-content');
			h2Elements = document.querySelectorAll('.post_type_layout_standard .entry-content >h2');
		}

		// Create an empty array to store the IDs
		const uniqueIds = [];

		// Iterate through <h2> elements and add unique ids
		h2Elements.forEach((h2Element, index) => {
			// Generate a unique id based on the index
			const uniqueId = `toc_${index + 1}`;

			// Add the unique id as the id attribute of the <h2> element
			h2Element.id = uniqueId;
			// h2Element.setAttribute('tabindex', '0');

			// Push the unique ID into the array
			uniqueIds.push(uniqueId);
		});

		// Create a navigation menu
		const nav = document.querySelector('.toc-nav');
		const ul = document.createElement('ul');

		// Create links to the unique IDs
		uniqueIds.forEach((uniqueId) => {
			const li = document.createElement('li');
			const a = document.createElement('a');

			// Set the link's href attribute to point to the corresponding ID
			a.href = `#${uniqueId}`;
			a.textContent = document.querySelector(`#${uniqueId}`).textContent;

			// Append the link to the list item and the list item to the navigation menu
			li.appendChild(a);
			ul.appendChild(li);
		});

		// Append the navigation menu to the page
		nav.appendChild(ul);

		const tocNav = document.querySelector('.toc-nav');
		const contentsNavMobile = document.querySelector('.contents-nav-mobile-menu');
		const contentsNavSidebar = document.querySelector('.toc_content_load_point');

		// Check if both elements exist before appending
		if (tocNav && contentsNavMobile) {
			// Create a clone of the .toc-nav element without moving it
			const tocNavClone = tocNav.cloneNode(true);

			// Append the inner contents of the clone to the .contents-nav-mobile-menu element
			while (tocNavClone.firstChild) {
				contentsNavMobile.appendChild(tocNavClone.firstChild);
			}
		}

		// Check if both elements exist before appending
		if (contentsNavSidebar) {
			// Create a clone of the .toc-nav element without moving it
			const tocNavClone = tocNav.cloneNode(true);

			// Append the inner contents of the clone to the .contents-nav-mobile-menu element
			while (tocNavClone.firstChild) {
				contentsNavSidebar.appendChild(tocNavClone.firstChild);
			}
		}

		let activeListItem = null;
		let activeListItemMobile = null;
		let activeListItemSidebar = null;
		let toc_content_load_point = document.querySelector('.toc_content_load_point');

		const observer = new IntersectionObserver(entries => {
			entries.forEach(entry => {
				const id = entry.target.getAttribute('id');
				let listItemCheck = document.querySelector(`.toc-nav li a`);
				if (listItemCheck == null) {
					return;
				}
				if (entry.intersectionRatio > 0) {
					// Remove 'active' class from the currently active list item
					if (activeListItemMobile) {
						activeListItemMobile.classList.remove('active');
					}
					if (activeListItem) {
						activeListItem.classList.remove('active');
					}
					if (activeListItemSidebar) {
						activeListItemSidebar.classList.remove('active');
					}

					// Add 'active' class to the one corresponding to the current entry
					const listItem = document.querySelector(`.toc-nav li a[href="#${id}"]`).parentElement;
					const listItemMobile = document.querySelector(`.contents-nav-mobile-menu li a[href="#${id}"]`).parentElement;

					if (toc_content_load_point) {
						const listItemSidebar = document.querySelector(`.toc_content_load_point li a[href="#${id}"]`).parentElement;

						listItemSidebar.classList.add('active');
						activeListItemSidebar = listItemSidebar;
					}

					listItem.classList.add('active');
					listItemMobile.classList.add('active');

					// Set the current list item as the active one
					activeListItem = listItem;
					activeListItemMobile = listItemMobile;

				}
			});

		});


		// Track all sections that have an `id` applied
		let targetElements;
		if (toc_container.length > 0) {
			targetElements = document.querySelectorAll('.toc_container h2');
		} else if (toc_container_entry_content.length > 0) {
			targetElements = document.querySelectorAll('.single .post_type_layout_standard .entry-content h2');
		}

		targetElements.forEach(element => {
			observer.observe(element);
		});

		window.addEventListener('scroll', function () {
			// Get the .inner-hero element and its bottom position relative to the viewport
			var heroElement = document.querySelector('.inner-hero');
			if (heroElement) {
				var heroBottom = heroElement.getBoundingClientRect().bottom;
				// Get the .contents-nav-mobile element
				var navElement = document.querySelector('.contents-nav-mobile');
				var siteHeader = document.querySelector('.site-header');

				// Check if the scroll is past the .inner-hero
				if (heroBottom < 0) {
					navElement.classList.add('scroll_active');
					siteHeader.classList.add('scroll_active');
				} else {
					navElement.classList.remove('scroll_active');
					siteHeader.classList.remove('scroll_active');
				}
			}

		});

		// click toc menu links
		const elementsWithHref = document.querySelectorAll('.contents-nav-mobile-menu a, .toc-nav a');

		// Add a click event listener to each element
		elementsWithHref.forEach(element => {
			element.addEventListener('click', event => {
				event.preventDefault(); // Prevent the default anchor behavior

				// Get the href value
				const hrefValue = element.getAttribute('href');

				// Find the target element using the href value
				const targetElement = document.querySelector(hrefValue);

				// Check if the target element exists
				if (targetElement) {
					// Set the focus on the target element
					targetElement.focus();

					// Toggle the contents-nav-mobile class
					let contentsNavMobileClicker = document.querySelector('.contents-nav-mobile');
					contentsNavMobileClicker.classList.toggle('active');

					// Calculate the position to scroll to
					const elementTop = targetElement.getBoundingClientRect().top + window.pageYOffset;
					const offsetPosition = elementTop - 100;

					// Scroll to the desired position
					window.scrollTo({
						top: offsetPosition,
						behavior: 'smooth'
					});
				}
			});
		});

		// Get a reference to the elements
		const dropdownSelect = document.querySelector('.contents-nav-mobile-header-dropdown-select');
		const contentsNavMobileClicker = document.querySelector('.contents-nav-mobile');

		// Add a click event listener to toggle the class
		dropdownSelect.addEventListener('click', () => {
			contentsNavMobileClicker.classList.toggle('active');
		});
	}

});

// vendor information block
document.addEventListener('DOMContentLoaded', function () {

	const accordionButton = document.querySelectorAll('.vendor_information_block_container_column_two_link_more_info');
	if (accordionButton.length > 0) {

		accordionButton.forEach(element => {

			element.addEventListener('click', event => {
				const controlledElementId = event.target.getAttribute('aria-controls');
				const targetElement = document.getElementById(controlledElementId);
				if (targetElement) {
					event.target.classList.toggle('active_btn');
					targetElement.toggleAttribute('hidden');
					const isExpanded = event.target.getAttribute('aria-expanded') === 'true';
					event.target.setAttribute('aria-expanded', !isExpanded);
					event.target.innerHTML = isExpanded ? 'More Information <span><svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L6.50008 6.50008L12.0002 1" stroke="#82BC46"/></svg></span>' : 'Less Information<span><svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L6.50008 6.50008L12.0002 1" stroke="#82BC46"/></svg></span>';
				}
			});

		});

	}

	const tabletChevron = document.querySelectorAll('.tablet_chevron');
	if (tabletChevron.length > 0) {

		document.querySelector('.tablet_chevron').addEventListener('click', function () {
			var list = document.querySelector('.tabbed-content__nav-list');
			var items = list.querySelectorAll('.tabbed-content__nav-item');

			// Find the currently active item
			var activeItem = list.querySelector('.active');
			var activeIndex = Array.from(items).indexOf(activeItem);

			// Determine the next item to scroll into view
			var nextItem = items[activeIndex + 1] || items[0]; // Loop back to first if at the end

			if (nextItem) {
				// Scroll the next item into view
				nextItem.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });

				// Update the active class if needed
				activeItem.classList.remove('active');
				nextItem.classList.add('active');
			}
		});
	}

});

// Video Block.
document.addEventListener('DOMContentLoaded', function () {

	const videoBlockElement = document.querySelectorAll('.image-placeholder-action');
	if (videoBlockElement.length) {

		// Select all play buttons
		var playButtons = document.querySelectorAll('.image-placeholder-action');
		var allimageObject = document.querySelectorAll('.image-placeholder');
		var documentimageobject = document.querySelectorAll('.image-object');


		function videoFunctionality(button) {
			documentimageobject.forEach(function (image) {
				image.classList.remove('image-hold');
			})

			allimageObject.forEach(function (image) {
				image.classList.remove('image-hold');
			})

			var slideContainer = button.closest('.slide-container');
			var currentImagePlaceholder = slideContainer.querySelector('.image-placeholder');
			var video = slideContainer.querySelector('video');
			var currentimageobject = slideContainer.querySelector('.image-object');

			document.querySelectorAll('.slide-container').forEach(function (container) {
				container.classList.remove('image-hold');
			})

			// Pause all videos and remove the class from all .image-object elements except the current
			document.querySelectorAll('.slide-container video').forEach(function (video) {
				if (video !== button.closest('.slide-container').querySelector('video')) {
					video.pause();
					video.controls = false; // Hide controls
					currentImagePlaceholder.classList.remove('image-hold');
					slideContainer.classList.remove('image-hold');
				}
			});

			// Toggle the class for the current .image-object
			if (video.paused) {
				currentImagePlaceholder.classList.add('image-hold');
				currentimageobject.classList.add('image-hold');
				slideContainer.classList.add('image-hold');
				video.controls = true; // Show controls when video plays
			}

			video.addEventListener('ended', function () {
				// The code you want to execute when the video ends
				document.querySelectorAll('.slide-container video').forEach(function (otherVideo) {
					if (otherVideo !== video) { // Ensure we're not pausing or altering the video that just ended
						otherVideo.pause();
						otherVideo.controls = false; // Hide controls
						// Assuming 'currentImagePlaceholder' is defined in your broader script context
						currentImagePlaceholder.classList.remove('image-hold');
						currentImagePlaceholder.classList.remove('image-hold');
						currentimageobject.classList.remove('image-hold');
						slideContainer.classList.remove('image-hold');
					}
				});
			});

			// Play or pause the current video
			video.paused ? video.play() : video.pause();
		}


		playButtons.forEach(function (button) {
			// Add click event listener to each button
			button.addEventListener('click', function () {
				videoFunctionality(button)
			});
		});




		document.getElementById('video-placeholder').play();

		jQuery('.video-placeholder').on('click', function () {
			var videoElement = jQuery('#video-placeholder').get(0); // Get the native video element

			if (!videoElement.paused) {
				videoElement.pause();
				jQuery(this).show(); // Show the placeholder when the video is paused
			} else {
				videoElement.play();
				jQuery(this).hide(); // Hide the placeholder when the video is playing
			}
		});


		// Correct the element ID to point to the video element, not the placeholder
		var videoElement = document.getElementById('video-placeholder');
		var videoPlaceholderPause = document.querySelector('.video_block_template_container_media_placeholder_action_btn');
		var buttonText = document.querySelector('.video_block_template_container_media_placeholder_action_btn .text'); // Get the span that contains the text

		videoPlaceholderPause.addEventListener('click', function () {
			if (!videoElement.paused) {
				videoElement.pause();
				videoPlaceholderPause.ariaPressed = true;
				buttonText.textContent = 'Play Video'; // Change the text to 'Play Video'
			} else {
				videoElement.play();
				videoPlaceholderPause.ariaPressed = false;
				buttonText.textContent = 'Pause Video'; // Change the text to 'Pause Video'
			}
		});

	}
});

// Pricing Block
document.addEventListener('DOMContentLoaded', function () {

	const pricingCalculator = document.querySelectorAll('.pricing_calculator_template');
	if (pricingCalculator.length) {

		class PricingAccordion {
			constructor(domNode) {
				this.rootEl = domNode;
				this.buttonEl = this.rootEl.querySelector('button[aria-expanded]');

				const controlsId = this.buttonEl.getAttribute('aria-controls');
				this.contentEl = document.getElementById(controlsId);

				this.open = this.buttonEl.getAttribute('aria-expanded') === 'true';

				// add event listeners
				this.buttonEl.addEventListener('click', this.onButtonClick.bind(this));
			}

			onButtonClick() {
				this.toggle(!this.open);
			}

			toggle(open) {
				// don't do anything if the open state doesn't change
				if (open === this.open) {
					return;
				}

				// update the internal state
				this.open = open;

				// handle DOM updates
				this.buttonEl.setAttribute('aria-expanded', `${open}`);
				if (open) {
					this.contentEl.removeAttribute('hidden');
				} else {
					this.contentEl.setAttribute('hidden', '');
				}
			}

			// Add public open and close methods for convenience
			open() {
				this.toggle(true);
			}

			close() {
				this.toggle(false);
			}
		}

		// init accordions
		const accordions = document.querySelectorAll('.pricing_calculator_accordion .pricing_calculator_accordion_item_title');
		accordions.forEach((accordionEl) => {
			new PricingAccordion(accordionEl);
		});

		function addData($this) {
			var dataprice = parseInt($this.data('price'), 10);
			var dataenrollment = parseInt($this.data('enrollment'), 10);
			var dataBenefits = $this.data('benefits');
			var dataDisclaimer = $this.data('disclaimer');
			var uniqueId = $this.data('unique-id');

			var $targetPrice = jQuery('.large_set .price');
			var $targetenrollment = jQuery('.info_set_number');
			var benefitsData = jQuery('.pricing_calculator_template_container_main_info_ul ul');
			var disclaimerData = jQuery('.pricing_calculator_template_container_main_pricing_disclaimer');

			var currentPrice = parseInt($targetPrice.text(), 10);
			var currentEnrollment = parseInt($targetenrollment.text(), 10);

			$targetPrice.text(currentPrice + dataprice);
			$targetenrollment.text(currentEnrollment + dataenrollment);
			benefitsData.append(dataBenefits);
			disclaimerData.append('<span data-unique-id="' + uniqueId + '">' + dataDisclaimer + '</span>');

			collectAndAppendText();


		}
		// Function to collect and append text
		function collectAndAppendText() {
			var container = document.querySelector('.pricing_calculator_template_container_main');

			// Function to recursively grab text content from nodes
			function getTextWithSpacing(node) {
				let text = '';
				node.childNodes.forEach(function (child) {
					if (child.nodeType === Node.TEXT_NODE) {
						// For text nodes, trim and add space to avoid extra whitespace issues
						text += child.textContent.trim() + ' ';
					} else if (child.nodeType === Node.ELEMENT_NODE) {
						// For element nodes, recurse
						text += getTextWithSpacing(child);
					}
				});
				return text;
			}

			var textContent = getTextWithSpacing(container).trim(); // Trim the final string to remove any leading/trailing spaces

			var ariaReadElement = document.getElementById('aria-read');
			if (ariaReadElement) {
				ariaReadElement.textContent = textContent; // Set the collected text
			} else {
				console.log('Element with ID "aria-read" not found.');
			}
		}



		function removeData($this) {
			var dataprice = parseInt($this.data('price'), 10);
			var dataenrollment = parseInt($this.data('enrollment'), 10);
			var dataBenefits = $this.data('benefits');
			var dataDisclaimer = $this.data('disclaimer');
			var uniqueId = $this.data('unique-id');

			var $targetPrice = jQuery('.large_set .price');
			var $targetenrollment = jQuery('.info_set_number');
			var benefitsData = jQuery('.pricing_calculator_template_container_main_info_ul ul');
			var disclaimerData = jQuery('.pricing_calculator_template_container_main_pricing_disclaimer');

			var currentPrice = parseInt($targetPrice.text(), 10);
			var currentEnrollment = parseInt($targetenrollment.text(), 10);

			$targetPrice.text(currentPrice - dataprice);
			$targetenrollment.text(currentEnrollment - dataenrollment);

			benefitsData.find('[data-unique-id="' + uniqueId + '"]').remove();
			disclaimerData.find('[data-unique-id="' + uniqueId + '"]').remove();

			collectAndAppendText();
		}

		jQuery('.action, .pricing_calculator_accordion_add').on('click', function () {
			var $this = jQuery(this);
			var dataAdded = $this.data('added');
			var pricing_calculator_accordion_item = $this.closest('.pricing_calculator_accordion_item');

			if (dataAdded) {
				// $this.data('added', false).attr('data-added', 'false');
				$this.closest('.pricing_calculator_accordion_item').find('.pricing_calculator_accordion_add,.action.btn').data('added', false).attr('data-added', 'false');
				$this.closest('.pricing_calculator_accordion_item').find('.pricing_calculator_accordion_add,.action.btn').attr('aria-pressed', 'false');
				jQuery(pricing_calculator_accordion_item).removeClass('pricing_calculator_accordion_add_active');
				removeData($this);

				$this.closest('.pricing_calculator_accordion_item').find('.action').text('Add Service');
			} else {
				// $this.data('added', true).attr('data-added', 'true');
				$this.closest('.pricing_calculator_accordion_item').find('.pricing_calculator_accordion_add,.action.btn').data('added', true).attr('data-added', 'true');
				$this.closest('.pricing_calculator_accordion_item').find('.pricing_calculator_accordion_add,.action.btn').attr('aria-pressed', 'true');
				addData($this);
				jQuery(pricing_calculator_accordion_item).addClass('pricing_calculator_accordion_add_active');
				$this.closest('.pricing_calculator_accordion_item').find('.action').text('Remove Service');
			}

		});
	}
});
