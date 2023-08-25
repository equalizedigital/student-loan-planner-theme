<?php

/**
 * tabbed-content block Block Template.
 *
 * @param	 array $block The block settings and attributes.
 * @param	 string $content The block inner HTML (empty).
 * @param	 bool $is_preview True during AJAX preview.
 * @param	 (int|string) $post_id The post ID this block is saved to.
 */

if( isset( $block['data']['preview_image_help'] )  ) :
	echo Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$id = 'tabbed-content-block-' . $block['id'];
if (!empty($block['anchor'])) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block tabbed-content-block';
if (!empty($block['className'])) :
	$className .= ' ' . $block['className'];
endif;

if (!empty($block['align'])) :
	$className .= ' align' . $block['align'];
endif;

$className = apply_filters( 'loader_block_class', $className, $block, $post_id );
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="tabbed-content__container">
        <div class="tabbed-content__tabs">
            <div class="tabbed-content__row">
				<div class="tabbed-content__row_container">
				<?php 
				$rows = get_field('tab_content');
				if( $rows ) {
					echo '<ul class="tabbed-content__nav-list">';
					foreach( $rows as $key => $row ) {
							echo '<li class="tabbed-content__nav-item">';
							?>
							<button data-link="tab-<?php echo $key; ?>" class="<?php if($key == 0){echo 'active'; } ?> ">
								<span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/icons/utility/tab-icons/fax.png" alt=""></span>
								<div class="text"><?php echo $row['tab_title']; ?></div>
							</button>
							<?php
						echo '</li>';
					}
					echo '</ul>';
				}
				?>
				</div>
				
                <div class="tabbed-content__content">

					<?php 
					$tabbed_content = get_field('tab_content');
					if( $tabbed_content ) {
						foreach( $tabbed_content as $key => $row ) {
							$link = $row['link'];
							?>
							<div id="tab-<?php echo $key; ?>" class="tabbed-content__content__pane <?php if($key == 0){echo 'tabbed-content__content__pane--active'; } ?>">

								<span class="tabbed-content__content__text">
									<h3>
										<?php echo $row['title']; ?>
									</h3>

									<?php echo $row['text']; ?>

									<div class="link">
										<?php if(!empty($link)): ?>
											<a href="<?php echo $link; ?>"><?php echo $link["title"]; ?></a>
										<?php endif; ?>
									</div>
									<div class="review"><?php echo $row['rating']; ?></div>
								</span>
								<div class="tabbed-content__content__image">
									<figure>
										<img src="<?php echo $row['image']['url']; ?>" alt="">
									</figure>
									<div class="image_name">
										<div class="title"><?php echo $row['name']; ?></div>
										<div class="occupation"><?php echo $row['occupation']; ?></div>
									</div>
									<div class="image_info">
										<?php 
										$ctas = $row['ctas'];
										if( $ctas ) {
											foreach( $ctas as $row ) {
												?>
												<div class="image_info_item">
													<div class="image_info_item_icon">
														<img src="<?php echo get_template_directory_uri(); ?>/assets/icons/utility/icon-checkmark.svg" alt="check">
													</div>
													<div class="image_info_item_text"><?php echo $row['text']; ?></div>
												</div>
												<?php
											}
										}
										?>
										
										
									</div>
								</div>
							</div>
						<?php
						}
					}
					?>
                </div>
            </div>
        </div>
    </div>
</section>
