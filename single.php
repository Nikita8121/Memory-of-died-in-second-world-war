<?php

/**
 * @author: VLThemes
 * @version: 1.0
 */

get_header();

get_template_part( 'template-parts/page-title/page-title', 'single' );

?>

<main class="vlt-main vlt-main--padding">

	<?php

		// Elementor `single` location
		if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
			get_template_part( 'template-parts/single' );
		}

	?>

</main>
<!-- /.vlt-main -->

<?php get_footer(); ?>