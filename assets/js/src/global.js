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
	// tabbed content
	const tabbedContent = document.querySelector('.tabbed-content-block');
	if (tabbedContent) {
		// Grab all buttons with the class tabbed-content__nav-item
		const tabButtons = document.querySelectorAll('.tabbed-content__nav-item button');

		tabButtons.forEach(button => {
			// Add a click event listener to each button
			button.addEventListener('click', function () {
				// Get the value of the data-target attribute
				let targetClass = button.getAttribute('data-link');

				// Remove active class from all items before adding to the new one
				tabButtons.forEach(btn => btn.classList.remove('active'));

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
			});
		});
	}

});

window.addEventListener("load", function () {
	// resource links
	const tabbedContent = document.querySelector('.resource-links-container');
	if (tabbedContent) {
		// Grab all buttons with the class tabbed-content__nav-item
		const tabButtons = document.querySelectorAll('.resource-links-container-links-button,.dropdown-li');

		tabButtons.forEach(button => {
			// Add a click event listener to each button
			button.addEventListener('click', function () {
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

		document.querySelectorAll('#resource-links-dropdown').forEach(function(element) {
			element.addEventListener('click', function() {
				this.classList.toggle('active');
				var target = document.querySelector('.resource-links-dropdown-list');
				target.classList.add('active');
			});
		});
		
		document.querySelectorAll('.dropdown-li').forEach(function(element) {
			element.addEventListener('click', function() {
				var target = document.getElementById('resource-links-dropdown');
				var button = document.querySelector('.resource-links-dropdown-list');
				button.classList.remove('active');
				target.innerHTML = element.innerHTML;
				document.getElementById('resource-links-dropdown').classList.remove('active');
			});
		});
	}

});


document.addEventListener('DOMContentLoaded', function() {

    // Find all elements with class .widget-title
    const widgetTitles = document.querySelectorAll('.widget-title');
	
    widgetTitles.forEach(title => {
        // Add click event listener to each .widget-title
        title.addEventListener('click', function() {
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



// Function to open a modal
function openModal(modalId) {
	var modal = document.getElementById(modalId);
	if (modal) {
	  modal.style.display = "block";
	}
  }
  
  // Function to close a modal
  function closeModal(modalId) {
	var modal = document.getElementById(modalId);
	if (modal) {
	  modal.style.display = "none";
	}
  }
  
  // Add click event to each modal button
  var modalButtons = document.querySelectorAll('.modal-btn');
  modalButtons.forEach(function(button) {
	button.addEventListener('click', function() {
	  var modalId = button.getAttribute('data-modal');
	  openModal(modalId);
	});
  });
  
  // Add click event to each close button
  var closeButtons = document.querySelectorAll('.close-btn');
  closeButtons.forEach(function(button) {
	button.addEventListener('click', function() {
	  var modal = button.closest('.modal');
	  if (modal) {
		closeModal(modal.id);
	  }
	});
  });
  
  // Close the modal if the user clicks outside of it
  window.addEventListener('click', function(event) {
	var modals = document.querySelectorAll('.modal');
	modals.forEach(function(modal) {
	  if (event.target === modal) {
		closeModal(modal.id);
	  }
	});
  });
  