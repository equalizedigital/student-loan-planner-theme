<?php

/**
 * accordion Block Template.
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
$id = 'accordion-block-' . $block['id'];
if (!empty($block['anchor'])) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block accordion-block';
if (!empty($block['className'])) :
	$className .= ' ' . $block['className'];
endif;

if (!empty($block['align'])) :
	$className .= ' align' . $block['align'];
endif;

$className = apply_filters( 'loader_block_class', $className, $block, $post_id );

// Load values and assing defaults.
$title = get_field('title');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="accordion-block-container">
		<h2 class="accordion-block-container__title"><?php echo $title; ?></h2>

		
		<h3 class="site-preview-heading">Borderless</h3>
				
		<div class="usa-accordion">
		<h4 class="usa-accordion__heading">
			<button
			type="button"
			class="usa-accordion__button"
			aria-expanded="true"
			aria-controls="a1"
			>
			First Amendment
			</button>
		</h4>
		<div id="a1" class="usa-accordion__content usa-prose">
			<p>
			Congress shall make no law respecting an establishment of religion, or
			prohibiting the free exercise thereof; or abridging the freedom of speech,
			or of the press; or the right of the people peaceably to assemble, and to
			petition the Government for a redress of grievances.
			</p>
		</div>
		<h4 class="usa-accordion__heading">
			<button
			type="button"
			class="usa-accordion__button"
			aria-expanded="false"
			aria-controls="a2"
			>
			Second Amendment
			</button>
		</h4>
		<div id="a2" class="usa-accordion__content usa-prose">
			<p>
			A well regulated Militia, being necessary to the security of a free State,
			the right of the people to keep and bear Arms, shall not be infringed.
			</p>
			<ul>
			<li>This is a list item</li>
			<li>Another list item</li>
			</ul>
		</div>
		<h4 class="usa-accordion__heading">
			<button
			type="button"
			class="usa-accordion__button"
			aria-expanded="false"
			aria-controls="a3"
			>
			Third Amendment
			</button>
		</h4>
		<div id="a3" class="usa-accordion__content usa-prose">
			<p>
			No Soldier shall, in time of peace be quartered in any house, without the
			consent of the Owner, nor in time of war, but in a manner to be prescribed
			by law.
			</p>
		</div>
		<h4 class="usa-accordion__heading">
			<button
			type="button"
			class="usa-accordion__button"
			aria-expanded="false"
			aria-controls="a4"
			>
			Fourth Amendment
			</button>
		</h4>
		<div id="a4" class="usa-accordion__content usa-prose">
			<p>
			The right of the people to be secure in their persons, houses, papers, and
			effects, against unreasonable searches and seizures, shall not be
			violated, and no Warrants shall issue, but upon probable cause, supported
			by Oath or affirmation, and particularly describing the place to be
			searched, and the persons or things to be seized.
			</p>
		</div>
		<h4 class="usa-accordion__heading">
			<button
			type="button"
			class="usa-accordion__button"
			aria-expanded="false"
			aria-controls="a5"
			>
			Fifth Amendment
			</button>
		</h4>
		<div id="a5" class="usa-accordion__content usa-prose">
			<p>
			No person shall be held to answer for a capital, or otherwise infamous
			crime, unless on a presentment or indictment of a Grand Jury, except in
			cases arising in the land or naval forces, or in the Militia, when in
			actual service in time of War or public danger; nor shall any person be
			subject for the same offence to be twice put in jeopardy of life or limb;
			nor shall be compelled in any criminal case to be a witness against
			himself, nor be deprived of life, liberty, or property, without due
			process of law; nor shall private property be taken for public use,
			without just compensation.
			</p>
		</div>
		</div>

		<h3 class="site-preview-heading">Bordered</h3>

		<div class="usa-accordion usa-accordion--bordered">
		<h4 class="usa-accordion__heading">
			<button
			type="button"
			class="usa-accordion__button"
			aria-expanded="true"
			aria-controls="b-a1"
			>
			First Amendment
			</button>
		</h4>
		<div id="b-a1" class="usa-accordion__content usa-prose">
			<p>
			Congress shall make no law respecting an establishment of religion, or
			prohibiting the free exercise thereof; or abridging the freedom of speech,
			or of the press; or the right of the people peaceably to assemble, and to
			petition the Government for a redress of grievances.
			</p>
		</div>
		<h4 class="usa-accordion__heading">
			<button
			type="button"
			class="usa-accordion__button"
			aria-expanded="false"
			aria-controls="b-a2"
			>
			Second Amendment
			</button>
		</h4>
		<div id="b-a2" class="usa-accordion__content usa-prose">
			<p>
			A well regulated Militia, being necessary to the security of a free State,
			the right of the people to keep and bear Arms, shall not be infringed.
			</p>
			<ul>
			<li>This is a list item</li>
			<li>Another list item</li>
			</ul>
		</div>
		<h4 class="usa-accordion__heading">
			<button
			type="button"
			class="usa-accordion__button"
			aria-expanded="false"
			aria-controls="b-a3"
			>
			Third Amendment
			</button>
		</h4>
		<div id="b-a3" class="usa-accordion__content usa-prose">
			<p>
			No Soldier shall, in time of peace be quartered in any house, without the
			consent of the Owner, nor in time of war, but in a manner to be prescribed
			by law.
			</p>
		</div>
		<h4 class="usa-accordion__heading">
			<button
			type="button"
			class="usa-accordion__button"
			aria-expanded="false"
			aria-controls="b-a4"
			>
			Fourth Amendment
			</button>
		</h4>
		<div id="b-a4" class="usa-accordion__content usa-prose">
			<p>
			The right of the people to be secure in their persons, houses, papers, and
			effects, against unreasonable searches and seizures, shall not be
			violated, and no Warrants shall issue, but upon probable cause, supported
			by Oath or affirmation, and particularly describing the place to be
			searched, and the persons or things to be seized.
			</p>
		</div>
		<h4 class="usa-accordion__heading">
			<button
			type="button"
			class="usa-accordion__button"
			aria-expanded="false"
			aria-controls="b-a5"
			>
			Fifth Amendment
			</button>
		</h4>
		<div id="b-a5" class="usa-accordion__content usa-prose">
			<p>
			No person shall be held to answer for a capital, or otherwise infamous
			crime, unless on a presentment or indictment of a Grand Jury, except in
			cases arising in the land or naval forces, or in the Militia, when in
			actual service in time of War or public danger; nor shall any person be
			subject for the same offence to be twice put in jeopardy of life or limb;
			nor shall be compelled in any criminal case to be a witness against
			himself, nor be deprived of life, liberty, or property, without due
			process of law; nor shall private property be taken for public use,
			without just compensation.
			</p>
		</div>
		</div>

		<h3 class="site-preview-heading">Multiselectable</h3>

		<div class="usa-accordion usa-accordion--multiselectable" data-allow-multiple>
		<h4 class="usa-accordion__heading">
			<button
			type="button"
			class="usa-accordion__button"
			aria-expanded="true"
			aria-controls="m-a1"
			>
			First Amendment
			</button>
		</h4>
		<div id="m-a1" class="usa-accordion__content usa-prose">
			<p>
			Congress shall make no law respecting an establishment of religion, or
			prohibiting the free exercise thereof; or abridging the freedom of speech,
			or of the press; or the right of the people peaceably to assemble, and to
			petition the Government for a redress of grievances.
			</p>
		</div>
		<h4 class="usa-accordion__heading">
			<button
			type="button"
			class="usa-accordion__button"
			aria-expanded="false"
			aria-controls="m-a2"
			>
			Second Amendment
			</button>
		</h4>
		<div id="m-a2" class="usa-accordion__content usa-prose">
			<p>
			A well regulated Militia, being necessary to the security of a free State,
			the right of the people to keep and bear Arms, shall not be infringed.
			</p>
			<ul>
			<li>This is a list item</li>
			<li>Another list item</li>
			</ul>
		</div>
		<h4 class="usa-accordion__heading">
			<button
			type="button"
			class="usa-accordion__button"
			aria-expanded="false"
			aria-controls="m-a3"
			>
			Third Amendment
			</button>
		</h4>
		<div id="m-a3" class="usa-accordion__content usa-prose">
			<p>
			No Soldier shall, in time of peace be quartered in any house, without the
			consent of the Owner, nor in time of war, but in a manner to be prescribed
			by law.
			</p>
		</div>
		<h4 class="usa-accordion__heading">
			<button
			type="button"
			class="usa-accordion__button"
			aria-expanded="false"
			aria-controls="m-a4"
			>
			Fourth Amendment
			</button>
		</h4>
		<div id="m-a4" class="usa-accordion__content usa-prose">
			<p>
			The right of the people to be secure in their persons, houses, papers, and
			effects, against unreasonable searches and seizures, shall not be
			violated, and no Warrants shall issue, but upon probable cause, supported
			by Oath or affirmation, and particularly describing the place to be
			searched, and the persons or things to be seized.
			</p>
		</div>
		<h4 class="usa-accordion__heading">
			<button
			type="button"
			class="usa-accordion__button"
			aria-expanded="false"
			aria-controls="m-a5"
			>
			Fifth Amendment
			</button>
		</h4>
		<div id="m-a5" class="usa-accordion__content usa-prose">
			<p>
			No person shall be held to answer for a capital, or otherwise infamous
			crime, unless on a presentment or indictment of a Grand Jury, except in
			cases arising in the land or naval forces, or in the Militia, when in
			actual service in time of War or public danger; nor shall any person be
			subject for the same offence to be twice put in jeopardy of life or limb;
			nor shall be compelled in any criminal case to be a witness against
			himself, nor be deprived of life, liberty, or property, without due
			process of law; nor shall private property be taken for public use,
			without just compensation.
			</p>
		</div>
		</div>

		
	</div>
</section>


<style>
        /* Add your custom CSS styles here if needed */
        .usa-accordion__content {
            display: none;
        }
        .active-content {
            display: block;
        }
    </style>
<script>
        const accordionButtons = document.querySelectorAll('.usa-accordion__button');

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
    </script>