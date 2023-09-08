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
		const tabButtons = document.querySelectorAll('.resource-links-container-links-link-button , .dropdown-li');

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


				let firstLink = document.getElementById(targetClass).querySelector('a');
				if (firstLink) {
					firstLink.focus();
				}

			});
		});

		document.querySelectorAll('#resource-links-dropdown').forEach(function (element) {
			element.addEventListener('click', function () {
				this.classList.toggle('active');
				var target = document.querySelector('.resource-links-dropdown-list');
				target.classList.add('active');
			});
		});

		document.querySelectorAll('.dropdown-li').forEach(function (element) {
			element.addEventListener('click', function () {
				var target = document.getElementById('resource-links-dropdown');
				var button = document.querySelector('.resource-links-dropdown-list');
				button.classList.remove('active');
				target.innerHTML = element.innerHTML;
				document.getElementById('resource-links-dropdown').classList.remove('active');
			});
		});
	}

});


document.addEventListener('DOMContentLoaded', function () {

	// Find all elements with class .widget-title
	const widgetTitles = document.querySelectorAll('.widget-title');


	widgetTitles.forEach(title => {
		title.setAttribute('tabindex', '0');
		// Add click event listener to each .widget-title

		title.addEventListener('keypress', function () {
			// Check if there's a next sibling element
			this.classList.toggle('active');
			let sibling = this.nextElementSibling;
			if (sibling) {
				// Add class to the sibling
				this.nextElementSibling.classList.toggle('active'); // Replace 'your-class-name-here' with your desired class name

			}
		});
		title.addEventListener('click', function () {
			// Check if there's a next sibling element
			this.classList.toggle('active');
			let sibling = this.nextElementSibling;
			if (sibling) {
				// Add class to the sibling
				this.nextElementSibling.classList.toggle('active'); // Replace 'your-class-name-here' with your desired class name

			}
		});
	});
});


jQuery(function ($) {

	// jQuery formatted selector to search for focusable items
	var focusableElementsString = "a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, *[tabindex], *[contenteditable]";

	// store the item that has focus before opening the modal window
	var focusedElementBeforeModal;

	$(document).ready(function () {
		jQuery('.modal-btn').click(function (event) {
			modalId = $(event.currentTarget).data('modal')
			showModal(modalId);
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
			cancelElement.click();
			evt.preventDefault();
		}

	}

	function trapTabKey(obj, evt) {

		// if tab or shift-tab pressed
		if (evt.which == 9) {
			console.log(obj)
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

		// set the focus to the first keyboard focusable item
		o.filter(focusableElementsString).filter(':visible').first().focus();
	}

	function showModal(obj) {
		jQuery('body').attr('aria-hidden', 'true'); // mark the main page as hidden
		// jQuery('.modalOverlay').css('display', 'block'); // insert an overlay to prevent clicking and make a visual change to indicate the main apge is not available
		jQuery('#' + obj).css('display', 'block'); // make the modal window visible
		jQuery('#' + obj).attr('aria-hidden', 'false'); // mark the modal window as visible

		// attach a listener to redirect the tab to the modal window if the user somehow gets out of the modal window
		jQuery('body').on('focusin', 'body', function () {
			setFocusToFirstItemInModal('#' + obj);
		})
		console.log('#' + obj)
		// save current focus
		focusedElementBeforeModal = jQuery(':focus');

		setFocusToFirstItemInModal('#' + obj);
	}

	function hideModal() {
		jQuery('.modal').css('display', 'none'); // hide the modal window
		jQuery('.modal').attr('aria-hidden', 'true'); // mark the modal window as hidden
		jQuery(' body').attr('aria-hidden', 'false'); // mark the main page as visible

		// remove the listener which redirects tab keys in the main content area to the modal
		jQuery('body').off('focusin', ' body');

		// set focus back to element that had it before the modal was opened
		focusedElementBeforeModal.focus();
	}
});