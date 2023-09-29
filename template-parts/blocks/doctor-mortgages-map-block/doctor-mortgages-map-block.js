(function($){

	/**
	 * initializeBlock
	 *
	 * Adds custom JavaScript to the block HTML.
	 *
	 * @date    10/11/21
	 * @since   1.0.0
	 *
	 * @param   object $block The block jQuery element.
	 * @param   object attributes The block attributes (only available when editing).
	 * @return  void
	 */
	var initializeBlock = function( $block ) {

		if(typeof rwc_base_vars == 'undefined') return;

		if($( ".doctor-mortgages-block" ).length){
			function rwc_coalition_map_ajax(state) {
				$.ajax({
					url: rwc_base_vars.ajax_url,
					method: 'GET',
					data: { action: 'rwc_doctor_map_ajax', nonce: rwc_base_vars.nonce, state: state  }
				}).done(function( response ) {
					if( true === response.success ) {
			
						let response_json = $.parseJSON( response.data );
	
						$('.doctor-mortgages-block-results-container').html(response_json.html);
						if ( $('.doctor-mortgages-block-cta').length ) {
							$('.doctor-mortgages-block-cta').remove();
						}
						let button = '<a href="'+response_json.state.link+'" class="doctor-mortgages-block-cta">Best Physician Mortgage Loans in'+
						' '+response_json.state.name+
						'</a>';
						$('.doctor-mortgages-block-results-container').after(button);
						$('.us-state').removeClass('active');
						$('.'+response_json.state.abbreviation).addClass('active');
						$(`.doctor-mortgages-block-select option[value='${response_json.state.abbreviation}']`).prop('selected', true);

						$('.doctor-mortgages-block-results-result-tab-button').click(function(){
							var parent = $(this).parent().parent();
							$('.doctor-mortgages-block-results-result-panel',parent).toggle();
							$(this).toggleClass('active');

							var text = $('span',this).html();
							if(text == 'Open'){
								$('span',this).html('Close');
							}else if(text == 'Close'){
								$('span',this).html('Open');
							}
							
						});

						if(state != null){
							$('.doctor-mortgages-block-results-result-tab-button').first().focus();
						}
						$('.doctor-mortgages-block-results-result-tab-button').first().addClass('active');	
						$('.doctor-mortgages-block-results-result-panel').first().toggle();
	
						//console.log(response_json);
			
					} else {
						console.log(response);
					}
			
				});
	
			};

			$( ".doctor-mortgages-block-select" ).change(function() {
				var state = $('option:selected',this).val();
				rwc_coalition_map_ajax(state);
			});
	
			$('.us-state').click(function(){
				var state = null;

				if($(this).hasClass('us-state-isolabel')){
					var classList = $(this).attr('class').split(/\s+/);
					$.each(classList, function(index, item) {
						if (item != 'us-state' || item != 'us-state-isolabel' || item != 'us-territory') {
							state = item;
						}
					});
				}else{
					var state = $(this).attr('id').replace('us-state-','');
				}
				rwc_coalition_map_ajax(state);
			});
	
			rwc_coalition_map_ajax(state = null);
			// on hover on path.us-state
			$('.us-state').hover(function(){
				if ( $(this).attr('id') ) {
					let state = $(this).attr('id').replace('us-state-','');
					$('#us-state-label-'+state).addClass('hover');
				}
			});
			$('.us-state').mouseleave(function(){
				if ( $(this).attr('id') ) {
					let state = $(this).attr('id').replace('us-state-','');
					$('#us-state-label-'+state).removeClass('hover');
				}
			});
			$('.us-state-isolabel').hover(function(){
				let state = $(this).attr('class').split(/\s+/)[2];
				$('#us-state-label-'+state).addClass('hover');
			});
			$('.us-state-isolabel').mouseleave(function(){
				let state = $(this).attr('class').split(/\s+/)[2];
				$('#us-state-label-'+state).removeClass('hover');
			});
			//.us-territory
			$('.us-territory').hover(function(){
				let state = $(this).attr('class').split(/\s+/)[3];
				$('#us-state-label-'+state).addClass('hover');
			});
			$('.us-territory').mouseleave(function(){
				let state = $(this).attr('class').split(/\s+/)[3];
				$('#us-state-label-'+state).removeClass('hover');
			});
			// NH, RI, MD, NJ, MA, VT, DE, CT, DC, PR, MP, GH, AS, VI
			let rect_states = [
				'us-state-NH',
				'us-state-RI',
				'us-state-MD',
				'us-state-NJ',
				'us-state-MA',
				'us-state-VT',
				'us-state-DE',
				'us-state-CT',
				'us-state-DC',
				'us-state-PR',
				'us-state-MP',
				'us-state-GU',
				'us-state-AS',
				'us-state-VI',
				'us-state-AS',
				'us-state-GU',
				'us-state-MP',
				'us-state-PR',
				'us-state-VI',
			];
			// hover for these states
			$('.us-state').hover(function(){
				if ( $(this).attr('id') ) {
					let state = $(this).attr('id').replace('us-state-','');
					if ( rect_states.includes( $(this).attr('id') ) ) {
						$('.us-state-isolabel.'+state).addClass('hover');
					}
				}
			});
			$('.us-state').mouseleave(function(){
				if ( $(this).attr('id') ) {
					let state = $(this).attr('id').replace('us-state-','');
					if ( rect_states.includes( $(this).attr('id') ) ) {
						$('.us-state-isolabel.'+state).removeClass('hover');
					}
				}
			});
			
		}

	}

	// Initialize each block on page load (front end).
	$(document).ready(function(){
		$('.doctor-mortgages-block').each(function(){
			initializeBlock( $(this) );
		});
	});

	// Initialize dynamic block preview (editor).
	if( window.acf ) {
		window.acf.addAction( 'render_block_preview/type=doctor-mortgages-map-block', initializeBlock );
	}

})(jQuery);