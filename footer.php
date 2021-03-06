<?php
/**
 * Footer Template
 *
 * @package WP Pro Real Estate 7
 * @subpackage Template
 */
 
global $ct_options;

$ct_footer_widget = isset( $ct_options['ct_footer_widget'] ) ? esc_attr( $ct_options['ct_footer_widget'] ) : '';
$ct_footer_text = isset( $ct_options['ct_footer_text'] ) ? esc_attr( $ct_options['ct_footer_text'] ) : '';
$ct_footer_back_to_top = isset( $ct_options['ct_footer_back_to_top'] ) ? esc_attr( $ct_options['ct_footer_back_to_top'] ) : '';
$ct_boxed = isset( $ct_options['ct_boxed'] ) ? esc_attr( $ct_options['ct_boxed'] ) : '';

if(!empty($ct_options['ct_footer_background_img']['url'])) {
    echo '<style type="text/css">';
    echo '#footer-widgets { background-image: url(' . esc_html($ct_options['ct_footer_background_img']['url']) . '); background-repeat: no-repeat; background-position: center center; background-size: cover;}';
    echo '</style>';
}

?>
            <div class="clear"></div>
            
        </section>
        <!-- //Main Content -->

        <?php do_action('before_footer_widgets'); ?>


        <?php
	   wp_reset_postdata();

	   // IDX DISCLAIMERS HERE
        // parameters:
        // none -> function will try to determine if its a single listing page or search results.
        // single = single listing page
        // search = search results page

        if(class_exists('IDX')) {
            $oIDX = new IDX();
            $disclaimer = $oIDX->ct_idx_disclaimer_text( );

            if ( $disclaimer != "" ) {
                echo '<div class="container">';
                    echo '<div id="disclaimer" class="muted col span_12 first">';
                        print $disclaimer;
                    echo '</div>';
                echo '</div>';
            }
        }
        ?>
            
        <?php if($ct_footer_widget == 'yes') {
        echo '<!-- Footer Widgets -->';
        echo '<div id="footer-widgets">';
            echo '<div class="dark-overlay">';
                echo '<div class="container">';
        				if (is_active_sidebar('footer')) {
                            dynamic_sidebar('Footer');
                        }
                        echo '<div class="clear"></div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<!-- //Footer Widgets -->';
        } ?>

        <?php do_action('before_footer'); ?>
        
        <!-- Footer -->
        <footer class="footer muted">
            <div class="container <?php if(class_exists('IDX')) { echo 'padB10'; } ?>">  

                <?php do_action('footer_before_inner'); ?>

                <?php ct_footer_nav(); ?>
                    
                <?php if($ct_footer_text) {
                    $ct_allowed_html = array(
                        'a' => array(
                            'href' => array(),
                            'title' => array()
                        ),
                        'em' => array(),
                        'strong' => array(),
                    );
                ?>
                    <p class="marB0 right"><?php echo wp_kses(stripslashes($ct_options['ct_footer_text']), $ct_allowed_html); ?>. <?php if($ct_footer_back_to_top != 'no') { echo '<a href="#top">' . esc_html( 'Back to top', 'contempo' ) . '</a>'; } ?></p>
                <?php } else { ?>
                    <p class="marB0 right">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>, <?php esc_html_e( 'All Rights Reserved.', 'contempo' ); ?> <?php if($ct_footer_back_to_top != 'no') { echo '<a id="back-to-top" href="#top">' . esc_html_e( 'Back to top ', 'contempo' ) . '</a>'; } ?></p>
                <?php } ?>
                <div class="clear"></div>

                <?php do_action('footer_after_inner'); ?>
            </div>

	<?php

	// IDX FOOTER HERE
    if(class_exists('IDX')) {
        
        $oIDX = new IDX();
        $idxFooter = $oIDX->ct_idx_footer_text( );

        if ( $idxFooter != "" ) {
            echo '<div class="container">';
                echo $idxFooter;
                echo " - By BBrands Agência";
            echo '</div>';
        }
    }
    ?>
	
</footer>
        <!-- //Footer -->
        
    <?php if($ct_boxed == "boxed") {
	echo '</div>';
    echo '<!-- //Wrapper -->';
	} ?>


    <?php do_action('after_wrapper'); ?>

    <?php wp_footer(); ?>

    <?php include 'includes/cambio.php'; ?>
    
</body>
</html>
