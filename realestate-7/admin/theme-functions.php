<?php
/**
 * Theme Functions
 *
 * @package WP Pro Real Estate 7
 * @subpackage Admin
 */

global $ct_options;

function custom_author_archive( &$query ) {
    if ($query->is_author)
        $query->set( 'post_type', array( 'listings' ) );
}
add_action( 'pre_get_posts', 'custom_author_archive' );

/*-----------------------------------------------------------------------------------*/
/* Redirect to Getting Started page on theme activation */
/*-----------------------------------------------------------------------------------*/

if(is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'])) {
	wp_redirect(admin_url('themes.php?page=merlin'));
}

/*-----------------------------------------------------------------------------------*/
/* Display Admin Notice if PHP version isn't 5.6+ (recommended requirement from
/* WordPress.org (https://wordpress.org/about/requirements/)) otherwise some
/* custom Visual Composer modules won't be available for use */
/*
/* Conditionals have also been added to the includes for the VC modules that require
/* it so if they don't upgrade there's no issues, they just won't be available for use
/*-----------------------------------------------------------------------------------*/

if (version_compare(phpversion(), '5.6.0', '<=')) { 
	// Display Notice
	function ct_vc_admin_notices() {
		global $current_user;
		$user_id = $current_user->ID;

		if(!get_user_meta($user_id, 'ct_re7_php_nag_ignore')) {
			
			$ct_re7_php_kb_article_link = 'https://contempo.ticksy.com/article/8877/';

			echo '<div class="updated notice is-dismissible">';
		        echo '<h3><strong>' . __('Please Update Your PHP Version to the Recommended 5.6+', 'contempo') . '</strong></h3>';
		        echo '<p>' . __('Otherwise some of the Theme Functions and Custom Visual Composer modules won\'t be available for use, or cause issues with your site display.', 'contempo') . '</p>';
		        echo '<p>' . __('Its a quick and simple process (no more than a couple minutes), please refer to this knowledgebase article below.', 'contempo') . '</p>';
		        echo '<p><a href="' . esc_url($ct_re7_php_kb_article_link) . '" target="_blank">' . __('Minimum PHP Version 5.6+ and How to Update to It', 'contempo') . '</a></p>';
		        echo '<p><strong><a class="dismiss-notice" href="' . site_url() . '/wp-admin/admin.php?ct_re7_php_nag_ignore=0" target="_parent">' . __('Dismiss this notice', 'contempo') . '</a></strong></p>';
		    echo '</div>';

		}
	}

	// Set Dismiss Referer
	function ct_vc_admin_notices_init() {
	    if ( isset($_GET['ct_re7_php_nag_ignore']) && '0' == $_GET['ct_re7_php_nag_ignore'] ) {
	        $user_id = get_current_user_id();
	        add_user_meta($user_id, 'ct_re7_php_nag_ignore', 'true', true);
	        if (wp_get_referer()) {
	            /* Redirects user to where they were before */
	            wp_safe_redirect(wp_get_referer());
	        } else {
	            /* if there is no referrer you redirect to home */
	            wp_safe_redirect(home_url());
	        }
	    }
	}
	
	add_action('admin_init', 'ct_vc_admin_notices_init');
	add_action( 'admin_notices', 'ct_vc_admin_notices' );
}

/*-----------------------------------------------------------------------------------*/
/* Display admin notice when WP Favortie Posts plugin is activated
/*-----------------------------------------------------------------------------------*/

if (function_exists('wp_favorite_posts')) { 
	// Display Notice
	function ct_wpfav_admin_notices() {
		global $current_user;
		$user_id = $current_user->ID;

		if(!get_user_meta($user_id, 'ct_re7_wpfav_nag_ignore')) {
			
			$ct_re7_wpfav_doc_link = 'http://contempothemes.com/wp-real-estate-7/documentation/#wpfavorites';

			echo '<div class="updated notice is-dismissible">';
		        echo '<h3><strong>' . __('WP Favorite Posts Needs to be Setup', 'contempo') . '</strong></h3>';
		        echo '<p>' . __('Just takes a few seconds to setup the plugin properly please see the ', 'contempo') . '<a href="' . esc_url($ct_re7_wpfav_doc_link) . '" target="_blank">' . __('documentation', 'contempo') . '</a>, if you\'ve already done this just dismiss the notice below.</p>';
		        echo '<p><strong><a class="dismiss-notice" href="' . site_url() . '/wp-admin/admin.php?ct_re7_wpfav_nag_ignore=0" target="_parent">' . __('Dismiss this notice', 'contempo') . '</a></strong></p>';
		    echo '</div>';

		}
	}

	// Set Dismiss Referer
	function ct_wpfav_admin_notices_init() {
	    if ( isset($_GET['ct_re7_wpfav_nag_ignore']) && '0' == $_GET['ct_re7_wpfav_nag_ignore'] ) {
	        $user_id = get_current_user_id();
	        add_user_meta($user_id, 'ct_re7_wpfav_nag_ignore', 'true', true);
	        if (wp_get_referer()) {
	            /* Redirects user to where they were before */
	            wp_safe_redirect(wp_get_referer());
	        } else {
	            /* if there is no referrer you redirect to home */
	            wp_safe_redirect(home_url());
	        }
	    }
	}
	
	add_action('admin_init', 'ct_wpfav_admin_notices_init');
	add_action( 'admin_notices', 'ct_wpfav_admin_notices' );
}

/*-----------------------------------------------------------------------------------*/
/* Display admin notice when Contempo Compare Listings plugin is activated
/*-----------------------------------------------------------------------------------*/

if (class_exists('Redq_Alike')) { 
	// Display Notice
	function ct_compare_admin_notices() {
		global $current_user;
		$user_id = $current_user->ID;

		if(!get_user_meta($user_id, 'ct_re7_compare_nag_ignore')) {
			
			$ct_re7_compare_doc_link = 'http://contempothemes.com/wp-real-estate-7/documentation/#compare';

			echo '<div class="updated notice is-dismissible">';
		        echo '<h3><strong>' . __('Contempo Compare Listings Needs to be Setup', 'contempo') . '</strong></h3>';
		        echo '<p>' . __('Just takes a few seconds to setup the plugin properly please see the ', 'contempo') . '<a href="' . esc_url($ct_re7_compare_doc_link) . '" target="_blank">' . __('documentation', 'contempo') . '</a>, if you\'ve already done this just dismiss the notice below.</p>';
		        echo '<p><strong><a class="dismiss-notice" href="' . site_url() . '/wp-admin/admin.php?ct_re7_compare_nag_ignore=0" target="_parent">' . __('Dismiss this notice', 'contempo') . '</a></strong></p>';
		    echo '</div>';

		}
	}

	// Set Dismiss Referer
	function ct_compare_admin_notices_init() {
	    if ( isset($_GET['ct_re7_compare_nag_ignore']) && '0' == $_GET['ct_re7_compare_nag_ignore'] ) {
	        $user_id = get_current_user_id();
	        add_user_meta($user_id, 'ct_re7_compare_nag_ignore', 'true', true);
	        if (wp_get_referer()) {
	            /* Redirects user to where they were before */
	            wp_safe_redirect(wp_get_referer());
	        } else {
	            /* if there is no referrer you redirect to home */
	            wp_safe_redirect(home_url());
	        }
	    }
	}
	
	add_action('admin_init', 'ct_compare_admin_notices_init');
	add_action( 'admin_notices', 'ct_compare_admin_notices' );
}

/*-----------------------------------------------------------------------------------*/
/* Display admin notice when WP Social Login plugin is activated
/*-----------------------------------------------------------------------------------*/

if (function_exists('wsl_activate')) { 
	// Display Notice
	function ct_social_login_admin_notices() {
		global $current_user;
		$user_id = $current_user->ID;

		if(!get_user_meta($user_id, 'ct_re7_social_login_nag_ignore')) {
			
			$ct_re7_compare_doc_link = 'http://contempothemes.com/wp-real-estate-7/documentation/#sociallogin';

			echo '<div class="updated notice is-dismissible">';
		        echo '<h3><strong>' . __('WordPress Social Login Needs to be Setup', 'contempo') . '</strong></h3>';
		        echo '<p>' . __('Just takes a few seconds to setup the plugin properly please see the ', 'contempo') . '<a href="' . esc_url($ct_re7_compare_doc_link) . '" target="_blank">' . __('documentation', 'contempo') . '</a>, if you\'ve already done this just dismiss the notice below.</p>';
		        echo '<p><strong><a class="dismiss-notice" href="' . site_url() . '/wp-admin/admin.php?ct_re7_social_login_nag_ignore=0" target="_parent">' . __('Dismiss this notice', 'contempo') . '</a></strong></p>';
		    echo '</div>';

		}
	}

	// Set Dismiss Referer
	function ct_social_login_admin_notices_init() {
	    if ( isset($_GET['ct_re7_social_login_nag_ignore']) && '0' == $_GET['ct_re7_social_login_nag_ignore'] ) {
	        $user_id = get_current_user_id();
	        add_user_meta($user_id, 'ct_re7_social_login_nag_ignore', 'true', true);
	        if (wp_get_referer()) {
	            /* Redirects user to where they were before */
	            wp_safe_redirect(wp_get_referer());
	        } else {
	            /* if there is no referrer you redirect to home */
	            wp_safe_redirect(home_url());
	        }
	    }
	}
	
	add_action('admin_init', 'ct_social_login_admin_notices_init');
	add_action( 'admin_notices', 'ct_social_login_admin_notices' );
}

/*-----------------------------------------------------------------------------------*/
/* Display admin notice to Update Listings if they exist
/*-----------------------------------------------------------------------------------

$check_listings = get_posts('post_type=listings');

if(!empty($check_listings)) { 
	// Display Notice
	function ct_update_listings_admin_notices() {
		global $current_user;
		$user_id = $current_user->ID;

		if(!get_user_meta($user_id, 'ct_re7_update_listings_nag_ignore')) {
			
			$ct_re7_video_link = 'https://cl.ly/1894b8177872';

			echo '<div class="updated notice is-dismissible">';
		        echo '<h3><strong>' . __('IMPORTANT: You need to Update a Single Listing', 'contempo') . '</strong></h3>';
		        echo '<p>' . __('In order for the new listings search to operate properly you need to go into Listings > choose any published Listing > Edit > Click Update, and you\'ll be all set.', 'contempo');
		        echo '<p>' . __('Here\'s a ', 'contempo') . '<a href="' . esc_url($ct_re7_video_link) . '" target="_blank">' . __('quick video', 'contempo') . '</a>' . __(' on how to do that, once complete you can dismiss this notice', 'contempo') . '</p>';
		        echo '<p><strong><a class="dismiss-notice" href="' . site_url() . '/wp-admin/admin.php?ct_re7_social_login_nag_ignore=0" target="_parent">' . __('Dismiss this notice', 'contempo') . '</a></strong></p>';
		    echo '</div>';

		}
	}

	// Set Dismiss Referer
	function ct_update_listings_admin_notices_init() {
	    if ( isset($_GET['ct_re7_update_listings_nag_ignore']) && '0' == $_GET['ct_re7_update_listings_nag_ignore'] ) {
	        $user_id = get_current_user_id();
	        add_user_meta($user_id, 'ct_re7_update_listings_nag_ignore', 'true', true);
	        if (wp_get_referer()) {
	            wp_safe_redirect(wp_get_referer());
	        } else {
	            wp_safe_redirect(home_url());
	        }
	    }
	}
	
	add_action('admin_init', 'ct_update_listings_admin_notices_init');
	add_action( 'admin_notices', 'ct_update_listings_admin_notices' );
}

/*-----------------------------------------------------------------------------------*/
/* Remove Demo Mode for Redux Framework */
/*-----------------------------------------------------------------------------------*/

function ct_remove_redux_demo_link() {
    if(class_exists('ReduxFrameworkPlugin')) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2);
    }
    if(class_exists('ReduxFrameworkPlugin')) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices'));
    }

    delete_transient( 'elementor_activation_redirect' );
}
add_action('init', 'ct_remove_redux_demo_link');

/*-----------------------------------------------------------------------------------*/
/* Admin CSS */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_admin_css')) {
	function ct_admin_css() {
		echo '<style>';
			echo 'tr[data-slug="slider-revolution"] + .plugin-update-tr, .vc_license-activation-notice, .rs-update-notice-wrap, tr.plugin-update-tr.active#js_composer-update, .updated.vc_updater-result-message { display: none;}, a[aria-label="More information about Contempo Mortgage Calculator Widget"], .wrap.vc_settings a.nav-tab:nth-child(3) { display: none !important;}';
			echo '.redux-message.redux-notice { display: none !important;}';
			echo '.theme-browser .theme.wrap-importer .theme-actions, .theme-browser .theme.active.wrap-importer .theme-actions { bottom: -24px !important; top: inherit !important;}';
			echo '.package-status { display: block; padding: 6px 10px; color: #fff; font-size: 10px; border-radius: 3px; text-transform: uppercase; text-align: center; background: #29333d;}';
			echo '#package-active { background: #7faf1b;}';
			echo '#package-limit-reached { background: #bc0000;}';
			echo '#package-expired { background: #bc0000;}';
		echo '</style>';
	}
}
add_action('admin_head', 'ct_admin_css');

/*-----------------------------------------------------------------------------------*/
/* Redirect to Theme Options on Activate */
/*-----------------------------------------------------------------------------------

if(is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" && !is_child_theme()) {
	add_action('admin_head','ct_option_setup');
	header( 'Location: '.admin_url().'admin.php?page=WPProRealEstate7&tab=45' );
}

/*-----------------------------------------------------------------------------------*/
/* Body IDs */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_body_id')) {
	function ct_body_id() {
		if (is_home() || is_front_page()) {
			echo ' id="home"';
		} elseif (is_single()) {
			echo ' id="single"';
		} elseif (is_page()) {
			echo ' id="page"';
		} elseif (is_search()) {
			echo ' id="search"';
		} elseif (is_archive()) {
			echo ' id="archive"';
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Body Classes */
/*-----------------------------------------------------------------------------------*/

function ct_body_classes($classes) {

	global $ct_options;

	$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	$ct_listing_single_layout = isset( $ct_options['ct_listing_single_layout'] ) ? esc_html( $ct_options['ct_listing_single_layout'] ) : '';
 	
 	// Listing Single Layout
    if(is_singular('listings')) {
        $classes[] = $ct_listing_single_layout;
    }

    // Listings Search
	if (strpos($url,'search-listings=true') !== false) {
	    $classes[] = 'search-listings';
	}

    return $classes;    
}
add_filter( 'body_class','ct_body_classes' );

/*-----------------------------------------------------------------------------------*/
/* Add Automatic Feed Links */
/*-----------------------------------------------------------------------------------*/

add_theme_support( 'automatic-feed-links' );

/*-----------------------------------------------------------------------------------*/
/* Add Title Tag Support */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_title_tag')) {
	function ct_title_tag() {
	   add_theme_support( 'title-tag' );
	}
}
add_action( 'after_setup_theme', 'ct_title_tag' );

/*-----------------------------------------------------------------------------------*/
/* Add Editor Stylesheet Support */
/*-----------------------------------------------------------------------------------*/

if ( function_exists('add_editor_style') ) {
	add_editor_style();
}

/*-----------------------------------------------------------------------------------*/
/* Add Post Thumbnail Support */
/*-----------------------------------------------------------------------------------*/

add_theme_support('post-thumbnails'); 

/*-----------------------------------------------------------------------------------*/
/* Set Content Width */
/*-----------------------------------------------------------------------------------*/

if(!isset($content_width)) $content_width = 1100;

/*-----------------------------------------------------------------------------------*/
/* Remove Default Image Sizes */
/*-----------------------------------------------------------------------------------*/

function ct_remove_default_images( $sizes ) {
	unset($sizes['small']); // 150px
	unset($sizes['medium']); // 300px
	unset($sizes['large']); // 1024px
	unset($sizes['medium_large']); // 768px
	return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'ct_remove_default_images' );

/*-----------------------------------------------------------------------------------*/
/* Add Image Sizes */
/*-----------------------------------------------------------------------------------*/

add_image_size('listings-featured-image', 818, 540, true);
add_image_size('listings-slider-image', 1200, 1000, true);

/* Add Custom Sizes to Attachment Display Settings */
if(!function_exists('ct_custom_image_sizes')) {
	function ct_custom_image_sizes( $sizes ) {
	    return array_merge( $sizes, array(
	        'listings-featured-image' => __('Listing Large', 'contempo'),
	    ) );
	}
}
add_filter( 'image_size_names_choose', 'ct_custom_image_sizes' );

/*-----------------------------------------------------------------------------------*/
/* Add WordPress 3.0 Menu Support */
/*-----------------------------------------------------------------------------------*/

if (function_exists('register_nav_menu')) {
	register_nav_menus( array( 'primary_left' => __( 'Primary Left Menu', 'contempo' ) ) );
	register_nav_menus( array( 'primary_right' => __( 'Primary Right Menu', 'contempo' ) ) );
	register_nav_menus( array( 'primary_full_width' => __( 'Primary Full Width', 'contempo' ) ) );
	register_nav_menus( array( 'footer' => __( 'Footer Menu', 'contempo' ) ) );
}

/*-----------------------------------------------------------------------------------*/
/* Enqueue Admin Scripts */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_enqueue_admin_scripts')) {
	function ct_enqueue_admin_scripts() {
		wp_enqueue_script('megaMenu', get_template_directory_uri() . '/js/ct.megamenu.js', '', '1.0', true);
	}
	add_action('admin_enqueue_scripts', 'ct_enqueue_admin_scripts');
}

/*-----------------------------------------------------------------------------------*/
/* Custom Nav Fallback */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_nav_fallback')) {
	function ct_nav_fallback() {
		$ct_admin_url = admin_url();
		if(!has_nav_menu( 'primary_left' ) || !has_nav_menu( 'primary_right' || !has_nav_menu('primary_full_width')) ) {
			echo '<nav class="right">';
				echo '<ul id="ct-menu" class="ct-menu">';
					echo '<li><a href="' . esc_url($ct_admin_url) . 'nav-menus.php">' . __('Menu doesn\'t exist, please create one by clicking here.', 'contempo') . '</a></li>';
				echo '</ul>';
			echo '</nav>';
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Mega Menu Walker */
/*-----------------------------------------------------------------------------------*/

class CT_Menu_Class_Walker extends Walker_Nav_Menu {
	/**
	 * Start the element output.
	 *
	 * @param  string $output Passed by reference. Used to append additional content.
	 * @param  object $item   Menu item data object.
	 * @param  int $depth     Depth of menu item. May be used for padding.
	 * @param  array $args    Additional strings.
	 * @return void
	 */
	
	
	function start_el(&$output, $item, $depth=0, $args =array(), $id = 0) {
		if( ! is_object( $args )) { 
			return ;
		}

		global $first_item_counter; 
		if( !isset ($first_item_counter) ) $first_item_counter = 0; 
		
		$classes     = empty ( $item->classes ) ? array () : (array) $item->classes;

		$class_names = join(
			' '
		,   apply_filters(
				'nav_menu_css_class'
			,   array_filter( $classes ), $item
			)
		);

		// find multi column class name and find the column count		
		$re = '/(multicolumn-)+(\d)/U'; 
		$matches  = preg_grep ($re, $classes); 

		$column_count = isset( $matches ) && is_array( $matches ) && count( $matches ) > 0 ? explode("-", reset( $matches ) ) : array(1=>0); 
		$column_count = is_array( $column_count ) ? $column_count[1] : $column_count;

		if( $depth == 0 ){
			$class_names = ( 0 < $column_count ) ? $class_names.' multicolumn ': $class_names;	
		}

		$sub_title = esc_attr( $item->description ); 
		$title = apply_filters( 'the_title', $item->title, $item->ID );


		//add class name to li if item has description 
		$class_names .= ! empty( $sub_title ) ? " has-sub-title" : "";

		//find if an icon used as class name - remove from li - use for a 
		if( ! empty ( $class_names ) ){ 
 
			if ( strpos( $class_names, "icon-" ) !== false ) { 
  
				$new_class_names = "";
				$icon_name = "";

				foreach (explode(" ", $class_names) as $value) {
					if ( strpos(  $value, "icon-" ) === false ) {
						$new_class_names .= " ". $value ;
					}else{
						$icon_name = $value;
					}
				}

				$class_names = ' class="'. esc_attr( $new_class_names ) . '"';

			}else{
				$class_names = ' class="'. esc_attr( $class_names ) . '"';
			}
		} 

		$output .= "<li id='menu-item-$item->ID' $class_names data-depth='$depth' data-column-size='$column_count'>";
 
		$attributes  = '';  

		! empty( $icon_name )
			and $attributes .= ' class="'  . esc_attr( $icon_name ) .'"'; 
 
		! empty( $item->attr_title )
			and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';				 

		! empty( $item->target )
			and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';

		! empty( $item->xfn )
			and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';

		! empty( $item->url )
			and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

			if( ! empty($sub_title) ){			
				$item_output = $args->before
					. "<a $attributes>"
					. $args->link_before
					. $title
					//. '<span>'.$sub_title.'</span>'
					. '</a> '
					. $args->link_after 
					. $args->after;				
			}else{
				$item_output = $args->before
					. "<a $attributes>"
					. $args->link_before
					. $title                
					. '</a> '
					. $args->link_after 
					. $args->after;               
			} 
	 
			// Since $output is called by reference we don't need to return anything.
			$output .= apply_filters(
				'walker_nav_menu_start_el'
			,   $item_output
			,   $item
			,   $depth
			,   $args
			);
			 
	} 
	
}

/*-----------------------------------------------------------------------------------*/
/* Main Navigation
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_nav_left')) {
	function ct_nav_left() { ?>
		<nav class="left">
	    	<?php wp_nav_menu (
	    		array(
					'menu'            => "primary-left",
					'menu_id'         => "ct-menu",
					'menu_class'      => "ct-menu",
					'echo'            => true,
					'container'       => '', 
					'container_class' => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'container_id'    => 'nav-left', 
					'theme_location'  => 'primary_left',
					'fallback_cb'	  => false,
					'walker'          => new CT_Menu_Class_Walker
				)
			); ?>
	    </nav>
	<?php }
}

if(!function_exists('ct_nav_right')) {
	function ct_nav_right() { ?>
		<nav class="right">
	    	<?php wp_nav_menu (
	    		array(
					'menu'            => "primary-right",
					'menu_id'         => "ct-menu",
					'menu_class'      => "ct-menu",
					'echo'            => true,
					'container'       => '', 
					'container_class' => '',
					'container_id'    => 'nav-left',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'container_id'    => 'nav-right', 
					'theme_location'  => 'primary_right',
					'fallback_cb'	  => false,
					'walker'          => new CT_Menu_Class_Walker
				)
	    	); ?>
	    </nav>
	<?php }
}

if(!function_exists('ct_nav_full_width')) {
	function ct_nav_full_width() { ?>
		<nav>
	    	<?php wp_nav_menu (
	    		array(
					'menu'            => "primary-full-width",
					'menu_id'         => "ct-menu",
					'menu_class'      => "ct-menu",
					'echo'            => true,
					'container'       => '', 
					'container_class' => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'container_id'    => 'nav-full-width', 
					'theme_location'  => 'primary_full_width',
					'fallback_cb'	  => false,
					'walker'          => new CT_Menu_Class_Walker
				)
			); ?>
	    </nav>
	<?php }
}

if(!function_exists('ct_footer_nav')) {
	function ct_footer_nav() { ?>
	    <nav class="left">
			<?php wp_nav_menu( array( 'container_id' => 'footer-nav', 'theme_location' => 'footer', 'fallback_cb' => false) ); ?>
	    </nav>
	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Mobile Header
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_mobile_header')) {
	function ct_mobile_header() { 
		global $ct_options;
		$header_layout = isset( $ct_options['ct_header_layout'] ) ? esc_html( $ct_options['ct_header_layout'] ) : '';

		?>
		        
	    <div id="cbp-spmenu" class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right">

	    	<?php if($header_layout == "left") { ?>

		        <?php wp_nav_menu( array( 'theme_location' => 'primary_right', 'fallback_cb' => false) ); ?>
	        
	        <?php } elseif($header_layout  == "center") { ?>
		    
		        <?php wp_nav_menu( array( 'theme_location' => 'primary_left', 'fallback_cb' => false) ); ?>
		        <?php wp_nav_menu( array( 'theme_location' => 'primary_right', 'fallback_cb' => false) ); ?>
	        
	        <?php } elseif($header_layout  == "right") { ?>
		    
		        <?php wp_nav_menu( array( 'theme_location' => 'primary_right', 'fallback_cb' => false) ); ?>
	        
	        <?php } elseif($header_layout  == "none") { ?>
		        
		        <?php //No Nav ?>
	        
	        <?php } ?>
	    
	    </div>

	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* DNS Prefetch
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_dns_prefetch')) {
	function ct_dns_prefetch() {

	echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">';
	echo '<link rel="dns-prefetch" href="//maps.google.com">';

	}
}
add_action('wp_enqueue_scripts', 'ct_dns_prefetch');

/*-----------------------------------------------------------------------------------*/
/* Google Fonts
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_heading_fonts_url')) {
	function ct_heading_fonts_url() {
		global $ct_options;

	    $font_url = '';
	    $ct_heading_font = isset( $ct_options['ct_heading_font'] ) ? esc_attr( $ct_options['ct_heading_font'] ) : '';	
		$ct_heading_font = str_replace(' ','+', $ct_heading_font);

	    $font_url = add_query_arg( 'family', esc_html($ct_heading_font) . ':300,400,700', "//fonts.googleapis.com/css" );

	    return $font_url;
	}
}

if(!function_exists('ct_body_fonts_url')) {
	function ct_body_fonts_url() {
		global $ct_options;

	    $font_url = '';
		$ct_body_font = isset( $ct_options['ct_body_font'] ) ? esc_attr( $ct_options['ct_body_font'] ) : '';
		$ct_body_font = str_replace(' ','+', $ct_body_font);

	    $font_url = add_query_arg( 'family', esc_html($ct_body_font) . ':300,400,700', "//fonts.googleapis.com/css" );

	    return $font_url;
	}
}

if(!function_exists('getPostIdsFromCoords')) {
	function getPostIdsFromCoords( $swLat, $swLng, $neLat, $neLng )	{

		//$sql = "SELECT a.post_id FROM wp_posts, wp_postmeta a, wp_postmeta b WHERE ( (".$swLat." < ".$neLat." AND a.meta_value BETWEEN ".$swLat." AND ".$neLat.") OR (".$swLat." > ".$neLat." AND (a.meta_value BETWEEN ".$swLat." AND 180 OR a.meta_value BETWEEN -180 AND ".$neLat.")) and (".$swLng." < ".$neLng." AND b.meta_value BETWEEN ".$swLng." AND ".$neLng.") OR (".$swLng." > ".$neLng." AND (b.meta_value BETWEEN ".$swLng." AND 180 OR b.meta_value BETWEEN -180 AND ".$neLng.")) ) and a.post_id = wp_posts.ID AND wp_posts.post_status = 'publish' AND a.post_id = b.post_id and a.meta_key = 'lat' and b.meta_key = 'lng';";


		/*
		$sql = "SELECT a.post_id FROM wp_posts, wp_postmeta a, wp_postmeta b 
		WHERE (CASE WHEN ".$neLat." < ".$swLat."
		    THEN a.meta_value BETWEEN ".$neLat." AND ".$swLat."
		    ELSE a.meta_value BETWEEN ".$swLat." AND ".$neLat."
		END) 
		AND
		(CASE WHEN ".$neLng." < ".$swLng."
			THEN b.meta_value BETWEEN ".$neLng." AND ".$swLng."
			ELSE b.meta_value BETWEEN ".$swLng." AND ".$neLng."
		END)  
		AND a.post_id = wp_posts.ID 
		AND wp_posts.post_status = 'publish' 
		AND wp_posts.post_type = 'listings' 
		AND a.post_id = b.post_id
		AND a.meta_key = 'lat'
		AND b.meta_key = 'lng';";
		*/



		global $wpdb;
		
		$lngCase = "";

		if ( ($neLng > 0 && $swLng > 0 ) && ($swLng > $neLng) ) {
			$lngCase = " b.meta_value BETWEEN 0 AND ".$neLng." OR b.meta_value BETWEEN ".$swLng." AND 180 OR b.meta_value BETWEEN -180 AND 0";
		} else if ( $neLng > 0 && $swLng > 0 ) {
			$lngCase = " b.meta_value BETWEEN ".$swLng." AND ".$neLng;
		} else if ( $neLng < 0 && $swLng > 0 ) {
			$lngCase = " b.meta_value BETWEEN -180 AND ".$neLng." OR b.meta_value BETWEEN ".$swLng." AND 180";
		} else if ( $neLng < 0 && $swLng < 0 ) {
			$lngCase = " b.meta_value BETWEEN ".$swLng." AND ".$neLng;
		} else if ( $neLng > 0 && $swLng < 0 ) {
			$lngCase = " b.meta_value BETWEEN 0 AND ".$neLng." OR b.meta_value BETWEEN ".$swLng." AND 0";
		}

		$sql = "SELECT a.post_id FROM ".$wpdb->prefix ."posts, ".$wpdb->prefix ."postmeta a, ".$wpdb->prefix ."postmeta b 
		WHERE (CASE WHEN ".$neLat." < ".$swLat."
		    THEN a.meta_value BETWEEN ".$neLat." AND ".$swLat."
		    ELSE a.meta_value BETWEEN ".$swLat." AND ".$neLat."
		END) 
		AND (
		".$lngCase."
		)
		AND a.post_id = ".$wpdb->prefix ."posts.ID 
		AND ".$wpdb->prefix ."posts.post_status = 'publish' 
		AND ".$wpdb->prefix ."posts.post_type = 'listings' 
		AND a.post_id = b.post_id
		AND a.meta_key = 'lat'
		AND b.meta_key = 'lng';";

		$postIds = $wpdb->get_col( $sql );

		return $postIds;

	}
}

if(!function_exists('map_listing_update')) {
	function map_listing_update() {
		global $page;
		global $post;
		global $ct_options;
		global $ajaxArgs;

		$drawing_mode = false;
		$draw_markers = array();
		$ne           = "";
		$neLat        = "";
		$neLng        = "";

		//Check if is the Drawing mode
		if ( isset( $_POST["drawMode"] ) ) {
			$drawing_mode = true;

			if ( isset( $_POST["drawMarkers"] ) ) {
				$draw_markers = json_decode( $_POST["drawMarkers"] );
			}
		}

		if ( isset( $_POST["ne"] ) ) {
			$ne    = filter_var( $_POST["ne"], FILTER_SANITIZE_STRING );
			$neLat = trim( substr( $ne, 1, strpos( $ne, ", " ) - 1 ) );
			$neLng = substr( $ne, strpos( $ne, "," ) + 1 );
			$neLng = trim( substr( $neLng, 0, strlen( $neLng ) - 1 ) );
		}
		
		
		$sw    = "";
		$swLat = "";
		$swLng = "";

		if ( isset( $_POST["sw"] ) ) {
			$sw    = filter_var( $_POST["sw"], FILTER_SANITIZE_STRING );
			$swLat = trim( substr( $sw, 1, strpos( $sw, ", " ) - 1 ) );
			$swLng = substr( $sw, strpos( $sw, "," ) + 1 );
			$swLng = trim( substr( $swLng, 0, strlen( $swLng ) - 1 ) );
		}
		
		$ct_search_results_listing_style = isset( $ct_options['ct_search_results_listing_style'] ) ? $ct_options['ct_search_results_listing_style'] : '';

		$count = 0;
		

		$search_num = $ct_options['ct_listing_search_num'];


		//file_put_contents(dirname(__FILE__)."/log.theme-functions", "calling getSearchArgs\r\n", FILE_APPEND);

		$args = getSearchArgs(true);

		//file_put_contents(dirname(__FILE__)."/log.theme-functions", "done calling getSearchArgs\r\n", FILE_APPEND);
		if ( $drawing_mode ) {
			$args["post__in"] = $draw_markers;
		} else {
			$args["post__in"] = getPostIdsFromCoords( $swLat, $swLng, $neLat, $neLng  );
		} 
		
		$return["coords"] = "swLat: ".$swLat."; swLng: ".$swLng."; neLat: ".$neLat."; neLng: ".$neLng;
		//$return["post__in"] = print_r($args["post__in"], true);


		//file_put_contents(dirname(__FILE__)."/log.theme-functions", "one\r\n", FILE_APPEND);

		//$count = count( $args["post__in"] );
		
		if ( empty( $args["post__in"] ) ) {
			$args["post__in"] = [1];  // Do this so we get a no result instead of an all result
			$count = 0;
		} 
		$args["post_type"] = "listings";
		$args["showposts"] = -1; //$search_num;

		global $wp_query;


		$wp_query = new wp_query( $args );


		//file_put_contents(dirname(__FILE__)."/log.theme-functions", "two\r\n", FILE_APPEND);



		$ajaxArgs = $args;
		//$return["args"] = print_r($args, true);
		//$return["wp_query"] = print_r($wp_query, true);
		
		$count = 0;
		if ( isset($wp_query->post_count) ) {
			$count = intVal( $wp_query->post_count );
		}
		
		$map = "";
		ob_start();
		
		$newMarkers = "";
		$latlngs = array();
		$siteUrl = ct_theme_directory_uri();
		$ct_use_propinfo_icons = isset( $ct_options['ct_use_propinfo_icons'] ) ? $ct_options['ct_use_propinfo_icons'] : '';

		//$count = 0;
		if ( have_posts() ) : while ( have_posts() ) : the_post();

			$lat = get_post_meta( $post->ID, "lat", true );
			$lng = get_post_meta( $post->ID, "lng", true );
			
			if ( $lat == "" || $lng == "" ) {
				continue;
			}

			$property = [
				'thumb' => ct_first_image_map_tn( false ),
				'title' => ct_listing_title( false ),
				'fullPrice' => ct_listing_price( false ),
				'bed' => ct_taxonomy_return( 'beds' ),
				'bath' => ct_taxonomy_return( 'baths' ),
				'size' => get_post_meta( $post->ID, "_ct_sqft", true )." ".ct_sqftsqm(),
				'parking' => get_post_meta( $post->ID, "_ct_parking", true ),
				'street' => get_the_title( ),
				'city' => ct_taxonomy_return( 'city' ),
				'state' => ct_taxonomy_return( 'state' ),
				'zip' => ct_taxonomy_return( 'zipcode' ),
				//'latlong' => get_post_meta(get_the_ID(), "_ct_latlng", true),
				'permalink' => get_the_permalink(),
				'isHome' => is_home()?"false":"true",
				'commercial' => ct_has_type('commercial')?'commercial':'',
				'land' => ct_has_type('land')?'land':'',
				'siteURL' => $siteUrl,
				'useIcons' => $ct_use_propinfo_icons,
				'listingID' => $post->ID,
			];
				 
		
			$latlngs[] = ["lat"=>$lat, "lng"=>$lng, "property"=>$property];
			//$count++;
			
		endwhile; endif;
		ob_end_clean();


		$args['paged'] = 1;
		if ( isset( $_POST["paged"] ) ) {
			$args["paged"] = intVal( $_POST["paged"] );
		}
		
		$page = $args["paged"] + 1;

		$args["showposts"] = $search_num;

		//$return["paged"] = $args['paged'];
		//$return["showposts"] = $search_num;
		if ( class_exists( "IDX_Query" ) ) {
			$idx_query = new IDX_Query( $args );
		}

		$wp_query = new wp_query( $args );
		
		ob_start();
		
		if($ct_search_results_listing_style == 'list') {
			get_template_part( 'layouts/list');
		} else {
			get_template_part( 'layouts/grid');
		}

		$listings = ob_get_clean();
		
		$return["siteURL"]  = $siteUrl;
		$return["listings"] = $listings;
		$return["count"]    = $count;
		$return["latlngs"]  = $latlngs;
		
		
		//$return["postIds"]  = $args["post__in"];

		print json_encode( $return );
		wp_die();

	}
}
add_action( "wp_ajax_map_listing_update", "map_listing_update" );
add_action( "wp_ajax_nopriv_map_listing_update", "map_listing_update" );


if(!function_exists('ct_init_scripts')) {
	function ct_init_scripts() {
		
		global $ct_options, $post;

		/*-----------------------------------------------------------------------------------*/
		/* Enqueue Styles */
		/*-----------------------------------------------------------------------------------*/

		wp_enqueue_style('base', get_template_directory_uri() . '/css/base.css', '', '1.0.2', 'screen, projection');
		wp_enqueue_style('headingFont', ct_heading_fonts_url(), array(), '1.0.0' );
		wp_enqueue_style('bodyFont', ct_body_fonts_url(), array(), '1.0.0' );
		wp_enqueue_style('framework', get_template_directory_uri() . '/css/responsive-gs-12col.css', '', '', 'screen, projection');
		wp_enqueue_style('ie', get_template_directory_uri() . '/css/ie.css', '', '', 'screen, projection');
		wp_enqueue_style('layout', get_template_directory_uri() . '/css/layout.css', '', '1.1.9', 'screen, projection');
		wp_enqueue_style('ctFlexslider', get_template_directory_uri() . '/css/flexslider.css', '', '', 'screen, projection');
		wp_enqueue_style('ctFlexsliderNav', get_template_directory_uri() . '/css/flexslider-direction-nav.css', '', '', 'screen, projection');
		wp_enqueue_style('fontawesome', get_template_directory_uri() . '/css/all.min.css', '', '1.0.1', 'screen, projection');
		wp_enqueue_style('fontawesomeShim', get_template_directory_uri() . '/css/v4-shims.min.css', '', '1.0.1', 'screen, projection');
		wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.min.css', '', '', 'screen, projection');
		wp_enqueue_style('ctModal', get_template_directory_uri() . '/css/ct-modal-overlay.css', '', '', 'screen, projection');
		wp_enqueue_style('ctSlidePush', get_template_directory_uri() . '/css/ct-sp-menu.css', '', '', 'screen, projection');

		if(function_exists('dsIDXload')) {
			wp_enqueue_style('dsidxpress', get_template_directory_uri() . '/css/dsidxpress.css', '', '', 'screen, projection');
		}

		if(function_exists('Vc_Base')) {
			wp_enqueue_style('ctVisualComposer', get_template_directory_uri() . '/css/ct-visual-composer.css', '', '', 'screen, projection');
		}

		$mode = isset( $ct_options['ct_mode'] ) ? esc_html( $ct_options['ct_mode'] ) : '';
	    if(is_singular('listings') || $mode == "single-listing") {
			wp_enqueue_style('print', get_template_directory_uri() . '/css/listing-print.css', '', '', 'print');
			wp_enqueue_style('ctLightbox', get_template_directory_uri() . '/css/ct-lightbox.css', '', '', 'screen, projection');
		}

		wp_enqueue_style('owlCarousel', get_template_directory_uri() . '/css/owl-carousel.css', '', '', 'screen, projection');
		
		if(is_single() || is_page()) {
			wp_enqueue_style('comments', get_template_directory_uri() . '/css/comments.css', '', '', 'screen, projection');
		}
		
		if(is_single() || is_author() || is_page_template('template-contact.php') || is_page_template('template-favorite-listings.php') || is_page_template('template-submit-listing.php') || is_front_page() || is_page_template('template-agents.php') || is_page_template('template-brokerages.php')) {
			wp_enqueue_style('validationEngine', get_template_directory_uri() . '/css/validationEngine.jquery.css', '', '', 'screen, projection');
		}

		if(is_page_template('template-edit-profile.php')) {
			wp_enqueue_style('ctFPE', get_template_directory_uri() . '/css/ct-fpe.css', '', '', 'screen, projection');
		}

		wp_enqueue_style('dropdowns', get_template_directory_uri() . '/css/ct-dropdowns.css', '', '', 'screen, projection');
		
		if ($ct_options['ct_skin'] == 'minimal') {
			wp_enqueue_style('minimalSkin', get_template_directory_uri() . '/css/minimal-skin.css', '', '1.0.3', 'screen, projection');
		}

		if ($ct_options['ct_rtl'] == 'yes') {
			wp_enqueue_style('rtl', get_template_directory_uri() . '/rtl.css', '', '', 'screen, projection');
		}
		
		/*-----------------------------------------------------------------------------------*/
		/* Enqueue Scripts */
		/*-----------------------------------------------------------------------------------*/

		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script('touchPunch', get_template_directory_uri() . '/js/jquery.ui.touch-punch.min.js', array('jquery'), '1.0', true);
		
		wp_enqueue_script('mobileMenu', get_template_directory_uri() . '/js/ct.mobile.menu.js', array('jquery'), '1.0', true);

		wp_enqueue_script('advSearch', get_template_directory_uri() . '/js/ct.advanced.search.js', array('jquery'), '1.0', false );

		$mode = isset( $ct_options['ct_mode'] ) ? esc_html( $ct_options['ct_mode'] ) : '';
	    if(is_singular('listings') || $mode == "single-listing") {
			wp_enqueue_script('ctLightbox', get_template_directory_uri() . '/js/ct.lightbox.min.js', 'jquery', '1.0', false);
		}

		wp_enqueue_script('owlCarousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '1.0', false);

		if(is_page_template('template-edit-profile.php')) {
			wp_enqueue_script( 'password-strength-meter' );
			wp_enqueue_script('ctPassStrength', get_template_directory_uri() . '/js/ct.passwordstrength.js', array('jquery'), '1.0', false);
		}

		if(!is_page_template('template-idx.php') || !is_page_template('template-idx-full-width.php')) {
	        wp_enqueue_script('ctNiceSelect', get_template_directory_uri() . '/js/jquery.nice-select.min.js', array('jquery'), '1.0', false);
	        wp_enqueue_style('ctNiceSelect', get_template_directory_uri() . '/css/nice-select.css', '', '', 'screen, projection');
	        wp_enqueue_script('ctSelect', get_template_directory_uri() . '/js/ct.select.js', array('jquery'), '1.0', false);
		}

		if(function_exists('wp_favorite_posts')) {
			wp_enqueue_script('ctWPFP', get_template_directory_uri() . '/js/ct.wpfp.js', array('jquery'), '1.0', true);
		}

		$ct_header_currency_switcher = isset( $ct_options['ct_header_currency_switcher'] ) ? esc_html( $ct_options['ct_header_currency_switcher'] ) : '';
		if($ct_header_currency_switcher == 'yes') {
			wp_enqueue_script('currencyConvert', get_template_directory_uri() . '/js/curry.js', array('jquery'), '1.0', true);
			
			$ct_fixer_access_key = isset( $ct_options['ct_fixer_access_key'] ) ? stripslashes( $ct_options['ct_fixer_access_key'] ) : '';
			wp_localize_script( 'currencyConvert', 'ct_fixer_access_key', $ct_fixer_access_key );
		}	

		wp_enqueue_script('jsCookie', get_template_directory_uri() . '/js/js.cookie.js', array('jquery'), '1.0', true);
		wp_enqueue_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '1.0', true);

		if(!function_exists('optima_express_register_widgets')) {
			wp_enqueue_script('cycle', get_template_directory_uri() . '/js/jquery.cycle.lite.js', array('jquery'), '1.0', true);
		}

		wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '1.0', true);

		if(is_page_template('template-submit-listing.php') || (is_page_template('template-edit-listing.php'))) {
			//Do nothing
		} else {
			$google_maps_api_key = isset( $ct_options['ct_google_maps_api_key'] ) ? stripslashes( $ct_options['ct_google_maps_api_key'] ) : '';
			if($google_maps_api_key != '') {
				$google_maps_api_key_output = '?key=' . $google_maps_api_key;
			} else {
				$google_maps_api_key_output = '';
			}
			if($google_maps_api_key != '') {
				wp_enqueue_script('gmaps', '//maps.google.com/maps/api/js' . $google_maps_api_key_output . '&v=3.37', '', '1.0', false);
			}
		}

		if(is_singular('listings')) {
			$google_maps_api_key = isset( $ct_options['ct_google_maps_api_key'] ) ? stripslashes( $ct_options['ct_google_maps_api_key'] ) : '';
			if($google_maps_api_key != '') {
				$google_maps_api_key_output = '&key=' . $google_maps_api_key;
			} else {
				$google_maps_api_key_output = '';
			}
			wp_deregister_script('gmaps');
			if($google_maps_api_key != '') {
				wp_enqueue_script('gmapsPlaces', '//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places' . $google_maps_api_key_output, '', '1.0', false);
			}
		}
		
		if(is_page_template('template-submit-listing.php')){
			$google_maps_api_key = isset( $ct_options['ct_google_maps_api_key'] ) ? stripslashes( $ct_options['ct_google_maps_api_key'] ) : '';
			if($google_maps_api_key != '') {
				$google_maps_api_key_output = '&key=' . $google_maps_api_key;
			} else {
				$google_maps_api_key_output = '';
			}
			if($google_maps_api_key != '') {
				wp_enqueue_script('gmapsPlaces', '//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places' . $google_maps_api_key_output, '', '1.0', false);
			}
			wp_enqueue_script('geoComplete', get_template_directory_uri() . '/js/jquery.geocomplete.js', array('jquery'), '1.0', false);
			wp_enqueue_script('parsley', get_template_directory_uri() . '/js/parsley.js', array('jquery'), '1.0', false);
			wp_enqueue_script('multiStepForm', get_template_directory_uri() . '/js/ct.multi.step.form.js', array('jquery'), '1.0', false);
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('plUpload', get_template_directory_uri() . '/js/plupload.full.min.js', array('jquery'), '1.0', false);
			wp_enqueue_script('plupload-handlers');
			wp_enqueue_script('wp-plupload');
			wp_enqueue_script('submit-listing', get_template_directory_uri() . '/js/ct.submit.listing.js', array('jquery'), '1.0', false);	 
			$admin_url = array( 'ajaxUrl' => admin_url( 'admin-ajax.php' ) );
			$template_url = array( 'templateUrl' => get_stylesheet_directory_uri() );
			wp_localize_script( 'submit-listing', 'PostID' , array( 'post_id'=>(isset($_GET['listings'])? $_GET['listings'] : $post->ID) ) );
			wp_localize_script( 'submit-listing', 'AdminURL', $admin_url  );
			wp_localize_script( 'submit-listing', 'TemplatePath', $template_url );				
		}

		if(is_page_template('template-edit-listing.php')){
			$google_maps_api_key = isset( $ct_options['ct_google_maps_api_key'] ) ? stripslashes( $ct_options['ct_google_maps_api_key'] ) : '';
			if($google_maps_api_key != '') {
				$google_maps_api_key_output = '&key=' . $google_maps_api_key;
			} else {
				$google_maps_api_key_output = '';
			}
			if($google_maps_api_key != '') {
				wp_enqueue_script('gmapsPlaces', '//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places' . $google_maps_api_key_output, '', '1.0', false);
			}
			wp_enqueue_script('geoComplete', get_template_directory_uri() . '/js/jquery.geocomplete.js', array('jquery'), '1.0', false);
			wp_enqueue_script('parsley', get_template_directory_uri() . '/js/parsley.js', array('jquery'), '1.0', false);
			wp_enqueue_script('multiStepForm', get_template_directory_uri() . '/js/ct.multi.step.form.js', array('jquery'), '1.0', false);
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('plupload');
			wp_enqueue_script('plupload-handlers');
			wp_enqueue_script('wp-plupload');
			wp_enqueue_script('edit-listing', get_template_directory_uri() . '/js/ct.edit.listing.js', array('jquery'), '1.0', false);
			$admin_url = array( 'ajaxUrl' => admin_url( 'admin-ajax.php' ) );
			$template_url = array( 'templateUrl' => get_stylesheet_directory_uri() );
			wp_localize_script( 'edit-listing', 'PostID' , array( 'post_id'=>(isset($_GET['listings'])? $_GET['listings'] : $post->ID) ) );	
			wp_localize_script( 'edit-listing', 'AdminURL', $admin_url  );
			wp_localize_script( 'edit-listing', 'TemplatePath', $template_url );			
		}

		$ct_home_layout = isset( $ct_options['ct_home_layout']['enabled'] ) ? $ct_options['ct_home_layout']['enabled'] : '';
		$ct_home_layout_array = (array) $ct_home_layout;

		//if(is_post_type_archive('listings') ||  is_page_template('search-listings.php') || is_page_template('template-contact.php') || is_page_template('template-contact-no-form.php') || is_page_template('template-big-map.php') || is_page_template('template-demo-home-map.php') || is_page_template('template-home.php') && in_array('Featured Map', $ct_home_layout_array)) {

			$google_maps_api_key = isset( $ct_options['ct_google_maps_api_key'] ) ? stripslashes( $ct_options['ct_google_maps_api_key'] ) : '';
			if($google_maps_api_key != '') {
				wp_enqueue_script('infobox', get_template_directory_uri() . '/js/ct.infobox.js', array('gmaps'), '1.0', true);
				wp_enqueue_script('marker', get_template_directory_uri() . '/js/markerwithlabel.js', array('gmaps'), '1.0', true);
				wp_enqueue_script('markerCluster', get_template_directory_uri() . '/js/markerclusterer.js', array('gmaps'), '1.0', true);
				wp_enqueue_script('mapping', get_template_directory_uri() . '/js/ct.mapping.js', array('gmaps'), '1.2.2', true);
			
				wp_localize_script( "mapping", "mapping_ajax_object",
					array(
						"ajax_url" => admin_url( "admin-ajax.php" )
					)
				);
			}
		
		//}

		$ct_sticky_header = isset( $ct_options['ct_sticky_header'] ) ? esc_attr( $ct_options['ct_sticky_header'] ) : '';
		if($ct_sticky_header == 'yes') { 
			wp_enqueue_script('waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'), '1.0', true);
		}

		wp_enqueue_script('modernizer', get_template_directory_uri() . '/js/modernizr.custom.js', array('jquery'), '1.0', true);
		wp_enqueue_script('classie', get_template_directory_uri() . '/js/classie.js', array('jquery'), '1.0', true);
		wp_enqueue_script('hammer', get_template_directory_uri() . '/js/jquery.hammer.min.js', array('jquery'), '1.0', true);
		wp_enqueue_script('touchEffects', get_template_directory_uri() . '/js/toucheffects.js', array('jquery'), '1.0', true);
		wp_enqueue_script('base', get_template_directory_uri() . '/js/base.js', array('jquery'), '1.1', true);
		wp_enqueue_script('ctaccount', get_template_directory_uri() . '/js/ct.account.js', array('jquery'), '1.0', true);

		// Sticky Sidebar
		$ct_listing_single_sticky_sidebar = isset( $ct_options['ct_listing_single_sticky_sidebar'] ) ? $ct_options['ct_listing_single_sticky_sidebar'] : '';
        if($ct_listing_single_sticky_sidebar == 'yes') { 
        	//wp_enqueue_script('resizeSensor', get_template_directory_uri() . '/js/ResizeSensor.js', array('jquery'), '1.0', false);
			//wp_enqueue_script('stickySidebar', get_template_directory_uri() . '/js/sticky-sidebar.js', array('jquery'), '1.0', false);
			//wp_enqueue_script('stickyjQuerySidebar', get_template_directory_uri() . '/js/jquery.sticky-sidebar.js', array('jquery'), '1.0', false);
		}

		// Localize the script with new data
		$translation_array = array(
			'close_map' => __( 'Close Map', 'contempo' ),
			'open_map' => __( 'Open Map', 'contempo' ),
			'close_search' => __( 'Close Search', 'contempo' ),
			'open_search' => __( 'Open Search', 'contempo' ),
			'close_tools' => __( 'Close', 'contempo' ),
			'open_tools' => __( 'Open', 'contempo' ),
			'search_saved' => __( 'Search Saved', 'contempo'),
			'a_value' => '10',
			'ct_ajax_url' => admin_url( 'admin-ajax.php' )
		);
		wp_localize_script( 'base', 'object_name', $translation_array );

		// Localize Advanced Search
		$ct_city_town_or_village = isset( $ct_options['ct_city_town_or_village'] ) ? $ct_options['ct_city_town_or_village'] : '';
		$ct_state_or_area = isset( $ct_options['ct_state_or_area'] ) ? $ct_options['ct_state_or_area'] : '';
		$ct_zip_or_post = isset( $ct_options['ct_zip_or_post'] ) ? $ct_options['ct_zip_or_post'] : '';

	    if($ct_city_town_or_village == 'town') {
			$ct_city = __('All Towns', 'contempo');
		} elseif($ct_city_town_or_village == 'village') {
			$ct_city = __('All Villages', 'contempo');
		} else {
			$ct_city = __('All Cities', 'contempo');
		}

		if($ct_state_or_area == 'area') {
			$ct_state = __('All Areas', 'contempo');
		} elseif($ct_state_or_area == 'suburb') {
			$ct_state = __('All Suburbs', 'contempo');
		} elseif($ct_state_or_area == 'province') {
			$ct_state = __('All Provinces', 'contempo');
		} elseif($ct_state_or_area == 'region') {
			$ct_state = __('All Regions', 'contempo');
		} elseif($ct_state_or_area == 'parish') {
			$ct_state = __('All Parishes', 'contempo');
		} else {
			$ct_state = __('All States', 'contempo');
		}

		if($ct_zip_or_post == 'postcode') {
			$ct_zip_post = __('All Postcodes', 'contempo');
		} elseif($ct_zip_or_post == 'postalcode') {
			$ct_zip_post = __('All Postal Codes', 'contempo');
		} else {
			$ct_zip_post = __('All Zipcodes', 'contempo');
		}

	    $ct_advanced_search_translation_array = array(
			'all_cities' => $ct_city,
			'all_states' => $ct_state,
			'all_zip_post' => $ct_zip_post
		);
		wp_localize_script( 'advSearch', 'searchLabel', $ct_advanced_search_translation_array );
		
		// Localize Validation Errors
		if(is_single() || is_author() || is_page_template('template-contact.php') || is_page_template('template-favorite-listings.php') || is_page_template('template-submit-listing.php') || is_front_page() || is_page_template('template-agents.php') || is_page_template('template-brokerages.php')) {
			wp_enqueue_script('validationEngine', get_template_directory_uri() . '/js/jquery.validationEngine.js', array('jquery'), '1.0', true);
			// Localize the script with new data
			$ct_validationEngine_errors = array(
				'required' => __('* This field is required', 'contempo'),
				'requiredCheckboxMulti' => __('* Please select an option', 'contempo'),
				'requiredCheckbox' => __('* This checkbox is required', 'contempo'),
				'invalidTelephone' => __('* Invalid phone number', 'contempo'),
				'invalidEmail' => __('* Invalid email address', 'contempo'),
				'invalidDate' => __('* Invalid date, must be in YYYY-MM-DD format', 'contempo'),
				'numbersOnly' => __('* Numbers only', 'contempo'),
				'noSpecialChar' => __('* No special caracters allowed', 'contempo'),
				'letterOnly' => __('* Letters only', 'contempo'),
			);
			wp_localize_script('validationEngine', 'validationError', $ct_validationEngine_errors);
		}
	}
}
add_action('wp_enqueue_scripts', 'ct_init_scripts');

/*-----------------------------------------------------------------------------------*/
/* Enqueue main stylesheet
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_theme_style')) {
	function ct_theme_style() {
	    wp_enqueue_style( 'ct-theme-style', get_bloginfo( 'stylesheet_url' ), array(), '1.0', 'screen, projection', 99 );
	}
}
add_action( 'wp_enqueue_scripts', 'ct_theme_style' );

/*-----------------------------------------------------------------------------------*/
/* CT Head */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_wp_head')) {
	function ct_wp_head() {
		
		global $ct_options;

		$ct_adv_search_price_slider_min_value = isset( $ct_options['ct_adv_search_price_slider_min_value'] ) ? $ct_options['ct_adv_search_price_slider_min_value'] : '';
		$ct_adv_search_price_slider_max_value = isset( $ct_options['ct_adv_search_price_slider_max_value'] ) ? $ct_options['ct_adv_search_price_slider_max_value'] : '';

		$ct_adv_search_size_slider_min_value = isset( $ct_options['ct_adv_search_size_slider_min_value'] ) ? $ct_options['ct_adv_search_size_slider_min_value'] : '';
		$ct_adv_search_size_slider_max_value = isset( $ct_options['ct_adv_search_size_slider_max_value'] ) ? $ct_options['ct_adv_search_size_slider_max_value'] : '';

		$ct_adv_search_lot_size_slider_min_value = isset( $ct_options['ct_adv_search_lot_size_slider_min_value'] ) ? $ct_options['ct_adv_search_lot_size_slider_min_value'] : '';
		$ct_adv_search_lot_size_slider_max_value = isset( $ct_options['ct_adv_search_lot_size_slider_max_value'] ) ? $ct_options['ct_adv_search_lot_size_slider_max_value'] : '';

		?>
	    
	    <!--[if lt IE 9]>
	    <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
	    <![endif]-->

	    <?php
        
        $ct_listing_single_sticky_sidebar = isset( $ct_options['ct_listing_single_sticky_sidebar'] ) ? $ct_options['ct_listing_single_sticky_sidebar'] : '';
        if($ct_listing_single_sticky_sidebar == 'yes') { ?>
	        <script>
	        	jQuery(function() {
					jQuery('.single-listings #sidebar').StickySidebar({
				       // Settings
				       additionalMarginTop: 150
				     });
				});

				(function ($) {
				    $.fn.StickySidebar = function (options) {
				        var defaults = {
				            'containerSelector': '',
				            'additionalMarginTop': 0,
				            'additionalMarginBottom': 0,
				            'updateSidebarHeight': true,
				            'minWidth': 0,
				            'disableOnResponsiveLayouts': true,
				            'sidebarBehavior': 'modern'
				        };
				        options = $.extend(defaults, options);

				        // Validate options
				        options.additionalMarginTop = parseInt(options.additionalMarginTop) || 0;
				        options.additionalMarginBottom = parseInt(options.additionalMarginBottom) || 0;

				        tryInitOrHookIntoEvents(options, this);

				        // Try doing init, otherwise hook into window.resize and document.scroll and try again then.
				        function tryInitOrHookIntoEvents(options, $that) {
				            var success = tryInit(options, $that);

				            if (!success) {
				                console.log('TST: Body width smaller than options.minWidth. Init is delayed.');

				                $(document).scroll(function (options, $that) {
				                    return function (evt) {
				                        var success = tryInit(options, $that);

				                        if (success) {
				                            $(this).unbind(evt);
				                        }
				                    };
				                }(options, $that));
				                $(window).resize(function (options, $that) {
				                    return function (evt) {
				                        var success = tryInit(options, $that);

				                        if (success) {
				                            $(this).unbind(evt);
				                        }
				                    };
				                }(options, $that))
				            }
				        }

				        // Try doing init if proper conditions are met.
				        function tryInit(options, $that) {
				            if (options.initialized === true) {
				                return true;
				            }

				            if ($('body').width() < options.minWidth) {
				                return false;
				            }

				            init(options, $that);

				            return true;
				        }

				        // Init the sticky sidebar(s).
				        function init(options, $that) {
				            options.initialized = true;

				            // Add CSS
				            $('head').append($('<style>.StickySidebar:after {content: ""; display: table; clear: both;}</style>'));

				            $that.each(function () {
				                var o = {};

				                o.sidebar = $(this);

				                // Save options
				                o.options = options || {};

				                // Get container
				                o.container = $(o.options.containerSelector);
				                if (o.container.length == 0) {
				                    o.container = o.sidebar.parent();
				                }

				                // Create sticky sidebar
				                o.sidebar.parents().css('-webkit-transform', 'none'); // Fix for WebKit bug - https://code.google.com/p/chromium/issues/detail?id=20574
				                o.sidebar.css({
				                    'position': 'relative',
				                    'overflow': 'visible',
				                    // The "box-sizing" must be set to "content-box" because we set a fixed height to this element when the sticky sidebar has a fixed position.
				                    '-webkit-box-sizing': 'border-box',
				                    '-moz-box-sizing': 'border-box',
				                    'box-sizing': 'border-box'
				                });

				                // Get the sticky sidebar element. If none has been found, then create one.
				                o.stickySidebar = o.sidebar.find('.StickySidebar');
				                if (o.stickySidebar.length == 0) {
				                    o.sidebar.find('script').remove(); // Remove <script> tags, otherwise they will be run again on the next line.
				                    o.stickySidebar = $('<div>').addClass('StickySidebar').append(o.sidebar.children());
				                    o.sidebar.append(o.stickySidebar);
				                }

				                // Get existing top and bottom margins and paddings
				                o.marginTop = parseInt(o.sidebar.css('margin-top'));
				                o.marginBottom = parseInt(o.sidebar.css('margin-bottom'));
				                o.paddingTop = parseInt(o.sidebar.css('padding-top'));
				                o.paddingBottom = parseInt(o.sidebar.css('padding-bottom'));

				                // Add a temporary padding rule to check for collapsable margins.
				                var collapsedTopHeight = o.stickySidebar.offset().top;
				                var collapsedBottomHeight = o.stickySidebar.outerHeight();
				                o.stickySidebar.css('padding-top', 1);
				                o.stickySidebar.css('padding-bottom', 1);
				                collapsedTopHeight -= o.stickySidebar.offset().top;
				                collapsedBottomHeight = o.stickySidebar.outerHeight() - collapsedBottomHeight - collapsedTopHeight;
				                if (collapsedTopHeight == 0) {
				                    o.stickySidebar.css('padding-top', 0);
				                    o.stickySidebarPaddingTop = 0;
				                }
				                else {
				                    o.stickySidebarPaddingTop = 1;
				                }

				                if (collapsedBottomHeight == 0) {
				                    o.stickySidebar.css('padding-bottom', 0);
				                    o.stickySidebarPaddingBottom = 0;
				                }
				                else {
				                    o.stickySidebarPaddingBottom = 1;
				                }

				                // We use this to know whether the user is scrolling up or down.
				                o.previousScrollTop = null;

				                // Scroll top (value) when the sidebar has fixed position.
				                o.fixedScrollTop = 0;

				                // Set sidebar to default values.
				                resetSidebar();

				                o.onScroll = function (o) {
				                    // Stop if the sidebar isn't visible.
				                    if (!o.stickySidebar.is(":visible")) {
				                        return;
				                    }

				                    // Stop if the window is too small.
				                    if ($('body').width() < o.options.minWidth) {
				                        resetSidebar();
				                        return;
				                    }

				                    // Stop if the sidebar width is larger than the container width (e.g. the theme is responsive and the sidebar is now below the content)
				                    if (o.options.disableOnResponsiveLayouts) {
				                        var sidebarWidth = o.sidebar.outerWidth(o.sidebar.css('float') == 'none');

				                        if (sidebarWidth + 50 > o.container.width()) {
				                            resetSidebar();
				                            return;
				                        }
				                    }

				                    var scrollTop = $(document).scrollTop();
				                    var position = 'static';

				                    // If the user has scrolled down enough for the sidebar to be clipped at the top, then we can consider changing its position.
				                    if (scrollTop >= o.container.offset().top + (o.paddingTop + o.marginTop - o.options.additionalMarginTop)) {
				                        // The top and bottom offsets, used in various calculations.
				                        var offsetTop = o.paddingTop + o.marginTop + options.additionalMarginTop;
				                        var offsetBottom = o.paddingBottom + o.marginBottom + options.additionalMarginBottom;

				                        // All top and bottom positions are relative to the window, not to the parent elemnts.
				                        var containerTop = o.container.offset().top;
				                        var containerBottom = o.container.offset().top + getClearedHeight(o.container);

				                        // The top and bottom offsets relative to the window screen top (zero) and bottom (window height).
				                        var windowOffsetTop = 0 + options.additionalMarginTop;
				                        var windowOffsetBottom;

				                        var sidebarSmallerThanWindow = (o.stickySidebar.outerHeight() + offsetTop + offsetBottom) < $(window).height();
				                        if (sidebarSmallerThanWindow) {
				                            windowOffsetBottom = windowOffsetTop + o.stickySidebar.outerHeight();
				                        }
				                        else {
				                            windowOffsetBottom = $(window).height() - o.marginBottom - o.paddingBottom - options.additionalMarginBottom;
				                        }

				                        var staticLimitTop = containerTop - scrollTop + o.paddingTop + o.marginTop;
				                        var staticLimitBottom = containerBottom - scrollTop - o.paddingBottom - o.marginBottom;

				                        var top = o.stickySidebar.offset().top - scrollTop;
				                        var scrollTopDiff = o.previousScrollTop - scrollTop;

				                        // If the sidebar position is fixed, then it won't move up or down by itself. So, we manually adjust the top coordinate.
				                        if (o.stickySidebar.css('position') == 'fixed') {
				                            if (o.options.sidebarBehavior == 'modern') {
				                                top += scrollTopDiff;
				                            }
				                        }

				                        if (o.options.sidebarBehavior == 'stick-to-top') {
				                            top = options.additionalMarginTop;
				                        }

				                        if (o.options.sidebarBehavior == 'stick-to-bottom') {
				                            top = windowOffsetBottom - o.stickySidebar.outerHeight();
				                        }

				                        if (scrollTopDiff > 0) { // If the user is scrolling up.
				                            top = Math.min(top, windowOffsetTop);
				                        }
				                        else { // If the user is scrolling down.
				                            top = Math.max(top, windowOffsetBottom - o.stickySidebar.outerHeight());
				                        }

				                        top = Math.max(top, staticLimitTop);

				                        top = Math.min(top, staticLimitBottom - o.stickySidebar.outerHeight());

				                        // If the sidebar is the same height as the container, we won't use fixed positioning.
				                        var sidebarSameHeightAsContainer = o.container.height() == o.stickySidebar.outerHeight();

				                        if (!sidebarSameHeightAsContainer && top == windowOffsetTop) {
				                            position = 'fixed';
				                        }
				                        else if (!sidebarSameHeightAsContainer && top == windowOffsetBottom - o.stickySidebar.outerHeight()) {
				                            position = 'fixed';
				                        }
				                        else if (scrollTop + top - o.sidebar.offset().top - o.paddingTop <= options.additionalMarginTop) {
				                            // Stuck to the top of the page. No special behavior.
				                            position = 'static';
				                        }
				                        else {
				                            // Stuck to the bottom of the page.
				                            position = 'absolute';
				                        }
				                    }

				                    /*
				                     * Performance notice: It's OK to set these CSS values at each resize/scroll, even if they don't change.
				                     * It's way slower to first check if the values have changed.
				                     */
				                    if (position == 'fixed') {
				                        o.stickySidebar.css({
				                            'position': 'fixed',
				                            'width': o.sidebar.width(),
				                            'top': top,
				                            'left': o.sidebar.offset().left + parseInt(o.sidebar.css('padding-left'))
				                        });
				                    }
				                    else if (position == 'absolute') {
				                        var css = {};

				                        if (o.stickySidebar.css('position') != 'absolute') {
				                            css.position = 'absolute';
				                            css.top = scrollTop + top - o.sidebar.offset().top - o.stickySidebarPaddingTop - o.stickySidebarPaddingBottom;
				                        }

				                        css.width = o.sidebar.width();
				                        css.left = '';

				                        o.stickySidebar.css(css);
				                    }
				                    else if (position == 'static') {
				                        resetSidebar();
				                    }

				                    if (position != 'static') {
				                        if (o.options.updateSidebarHeight == true) {
				                            o.sidebar.css({
				                                'min-height': o.stickySidebar.outerHeight() + o.stickySidebar.offset().top - o.sidebar.offset().top + o.paddingBottom
				                            });
				                        }
				                    }

				                    o.previousScrollTop = scrollTop;
				                };

				                // Initialize the sidebar's position.
				                o.onScroll(o);

				                // Recalculate the sidebar's position on every scroll and resize.
				                $(document).scroll(function (o) {
				                    return function () {
				                        o.onScroll(o);
				                    };
				                }(o));
				                $(window).resize(function (o) {
				                    return function () {
				                        o.stickySidebar.css({'position': 'static'});
				                        o.onScroll(o);
				                    };
				                }(o));

				                // Reset the sidebar to its default state
				                function resetSidebar() {
				                    o.fixedScrollTop = 0;
				                    o.sidebar.css({
				                        'min-height': '1px'
				                    });
				                    o.stickySidebar.css({
				                        'position': 'static',
				                        'width': ''
				                    });
				                }

				                // Get the height of a div as if its floated children were cleared. Note that this function fails if the floats are more than one level deep.
				                function getClearedHeight(e) {
				                    var height = e.height();

				                    e.children().each(function () {
				                        height = Math.max(height, $(this).height());
				                    });

				                    return height;
				                }
				            });
				        }
				    }
				})(jQuery);
	        </script>
        <?php } ?>
	    
		<script> 
			function numberWithCommas(x) {
			    if (x !== null) {
			        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			    }
			}

			jQuery(function($) {
				
				var $currency = "<?php ct_currency(); ?>";
				var $sqftsm = "<?php ct_sqftsqm(); ?>";
				var $acres = "<?php ct_acres(); ?>";

			    // Price From / To
			    $( "#slider-range" ).slider({
			        range: true,
			        min: <?php if(!empty($ct_adv_search_price_slider_min_value)) { echo $ct_adv_search_price_slider_min_value; } else { echo '100000'; } ?>,
			        step: 10000,
			        max: <?php if(!empty($ct_adv_search_price_slider_max_value)) { echo $ct_adv_search_price_slider_max_value; } else { echo '5000000'; } ?>,
			        values: [ <?php if(!empty($ct_adv_search_price_slider_min_value)) { echo $ct_adv_search_price_slider_min_value; } else { echo '100000'; } ?>, <?php if(!empty($ct_adv_search_price_slider_max_value)) { echo $ct_adv_search_price_slider_max_value; } else { echo '5000000'; } ?> ],
			        slide: function( event, ui ) {
			            $( "#slider-range #min" ).html(numberWithCommas(ui.values[ 0 ]) );
			            $( "#slider-range #max" ).html(numberWithCommas(ui.values[ 1 ]) );
			            $( "#price-from-to-slider .min-range" ).html( $currency + numberWithCommas($( "#slider-range" ).slider( "values", 0 )) );
			            $( "#price-from-to-slider .max-range" ).html( $currency + numberWithCommas($( "#slider-range" ).slider( "values", 1 )) );
			            $( "#ct_price_from" ).val(ui.values[ 0 ]);
			            $( "#ct_price_to" ).val(ui.values[ 1 ]);
			        }
			    });
			  
			    // slider range data tooltip set
			    var $handler = $("#slider-range .ui-slider-handle");

			    $( "#price-from-to-slider .min-range" ).prepend( $currency );
			    $( "#price-from-to-slider .max-range" ).prepend( $currency );
			  
			    $handler.eq(0).append("<b class='amount'>" +$currency+ "<span id='min'>"+numberWithCommas($( "#slider-range" ).slider( "values", 0 )) +"</span></b>");
			    $handler.eq(1).append("<b class='amount'>" +$currency+ "<span id='max'>"+numberWithCommas($( "#slider-range" ).slider( "values", 1 )) +"</span></b>");

			    // slider range pointer mousedown event
			    $handler.on("mousedown",function(e){
			        e.preventDefault();
			        $(this).children(".amount").fadeIn(300);
			    });

			    // slider range pointer mouseup event
			    $handler.on("mouseup",function(e){
			        e.preventDefault();
			        $(this).children(".amount").fadeOut(300);
			    });

			    // Size From / To
			    $( "#slider-range-two" ).slider({
			        range: true,
			        min: <?php if(!empty($ct_adv_search_size_slider_min_value)) { echo $ct_adv_search_size_slider_min_value; } else { echo '100'; } ?>,
			        step: 100,
			        max: <?php if(!empty($ct_adv_search_size_slider_max_value)) { echo $ct_adv_search_size_slider_max_value; } else { echo '1000'; } ?>,
			        values: [ <?php if(!empty($ct_adv_search_size_slider_min_value)) { echo $ct_adv_search_size_slider_min_value; } else { echo '100'; } ?>, <?php if(!empty($ct_adv_search_size_slider_max_value)) { echo $ct_adv_search_size_slider_max_value; } else { echo '10000'; } ?> ],
			        slide: function( event, ui ) {
			            $( "#slider-range-two #min" ).html(numberWithCommas(ui.values[ 0 ]) );
			            $( "#slider-range-two #max" ).html(numberWithCommas(ui.values[ 1 ]) );
			            $( "#size-from-to-slider .min-range" ).html( numberWithCommas($( "#slider-range-two" ).slider( "values", 0 )) + $sqftsm);
			            $( "#size-from-to-slider .max-range" ).html( numberWithCommas($( "#slider-range-two" ).slider( "values", 1 )) + $sqftsm);
			            $( "#ct_sqft_from" ).val(ui.values[ 0 ]);
			            $( "#ct_sqft_to" ).val(ui.values[ 1 ]);
			        }
			    });
			  
			    // slider range data tooltip set
			    var $handlertwo = $("#slider-range-two .ui-slider-handle");

			    $( "#size-from-to-slider .min-range" ).append( $sqftsm );
			    $( "#size-from-to-slider .max-range" ).append( $sqftsm );
			  
			    $handlertwo.eq(0).append("<b class='amount'><span id='min'>"+numberWithCommas($( "#slider-range-two" ).slider( "values", 0 )) +"</span>" +$sqftsm+ "</b>");
			    $handlertwo.eq(1).append("<b class='amount'><span id='max'>"+numberWithCommas($( "#slider-range-two" ).slider( "values", 1 )) +"</span>" +$sqftsm+ "</b>");

			    // slider range pointer mousedown event
			    $handlertwo.on("mousedown",function(e){
			        e.preventDefault();
			        $(this).children(".amount").fadeIn(300);
			    });

			    // slider range pointer mouseup event
			    $handlertwo.on("mouseup",function(e){
			        e.preventDefault();
			        $(this).children(".amount").fadeOut(300);
			    });

			    // Lotsize From / To
			    $( "#slider-range-three" ).slider({
			        range: true,
			        min: <?php if(!empty($ct_adv_search_lot_size_slider_min_value)) { echo $ct_adv_search_lot_size_slider_min_value; } else { echo '0'; } ?>,
			        step: 1,
			        max: <?php if(!empty($ct_adv_search_lot_size_slider_max_value)) { echo $ct_adv_search_lot_size_slider_max_value; } else { echo '100'; } ?>,
			        values: [ <?php if(!empty($ct_adv_search_lot_size_slider_min_value)) { echo $ct_adv_search_lot_size_slider_min_value; } else { echo '0'; } ?>, <?php if(!empty($ct_adv_search_lot_size_slider_max_value)) { echo $ct_adv_search_lot_size_slider_max_value; } else { echo '100'; } ?> ],
			        slide: function( event, ui ) {
			            $( "#slider-range-three #min" ).html(numberWithCommas(ui.values[ 0 ]) );
			            $( "#slider-range-three #max" ).html(numberWithCommas(ui.values[ 1 ]) );
			            $( "#lotsize-from-to-slider .min-range" ).html( numberWithCommas($( "#slider-range-three" ).slider( "values", 0 )) + " " +$acres);
			            $( "#lotsize-from-to-slider .max-range" ).html( numberWithCommas($( "#slider-range-three" ).slider( "values", 1 )) + " " +$acres);
			            $( "#ct_lotsize_from" ).val(ui.values[ 0 ]);
			            $( "#ct_lotsize_to" ).val(ui.values[ 1 ]);
			        }
			    });
			  
			    // slider range data tooltip set
			    var $handlerthree = $("#slider-range-three .ui-slider-handle");

			    $( "#lotsize-from-to-slider .min-range" ).append( " " + $acres );
			    $( "#lotsize-from-to-slider .max-range" ).append( " " + $acres );

			    $( "#lotsize-from-to-slider .min-range" ).replaceWith( "<span class='min-range'>" + numberWithCommas($( "#slider-range-three" ).slider( "values", 0 )) + " " + $acres + "</span>" );
			  
			    $handlerthree.eq(0).append("<b class='amount'><span id='min'>"+numberWithCommas($( "#slider-range-three" ).slider( "values", 0 )) +"</span> " +$acres+ "</b>");
			    $handlerthree.eq(1).append("<b class='amount'><span id='max'>"+numberWithCommas($( "#slider-range-three" ).slider( "values", 1 )) +"</span> " +$acres+ "</b>");

			    // slider range pointer mousedown event
			    $handlerthree.on("mousedown",function(e){
			        e.preventDefault();
			        $(this).children(".amount").fadeIn(300);
			    });

			    // slider range pointer mouseup event
			    $handlerthree.on("mouseup",function(e){
			        e.preventDefault();
			        $(this).children(".amount").fadeOut(300);
			    });

			});

	        jQuery(window).load(function() {

				<?php
				/*-----------------------------------------------------------------------------------*/
				/* Custom JS */
				/*-----------------------------------------------------------------------------------*/

				if(!empty($ct_options['ct_custom_js'])) {
					echo $ct_options['ct_custom_js']; 
				} ?>

				<?php if($ct_options['ct_sticky_header'] == 'yes' && $ct_options['ct_mode'] != 'single-listing') { ?>
					var masthead_anim_to;
					var masthead = jQuery('#header-wrap'),
						masthead_h = masthead.height();
						masthead_anim_to = (jQuery('body').hasClass('admin-bar')) ? '32px' : '0px';
					masthead.waypoint(function(direction) {
							if(direction == 'down') {
								masthead.css('top', '-'+masthead_h+'px').addClass('sticky').animate({'top': masthead_anim_to});
							}
							if(direction == 'up') {
								masthead.removeClass('sticky').css('top', '');
							}
					}, {
						offset: function() { return -jQuery(this).height(); }
					});
				<?php } ?>

				<?php
				$ct_listing_single_layout = isset( $ct_options['ct_listing_single_layout'] ) ? esc_html( $ct_options['ct_listing_single_layout'] ) : '';
				if($ct_listing_single_layout == 'listings-two' && is_singular( 'listings' )) { ?>
					// Single Listing Carousel
					var owl = jQuery('.owl-carousel');
					owl.owlCarousel({
					    items: 3,
					    loop: true,
					    margin: 0,
					    nav: false,
					    dots: false,
					    autoplay: true,
					    autoplayTimeout: 4000,
					    autoplayHoverPause: true,
					    responsive:{
					        0:{
					            items: 1,
					            nav: false
					        },
					        600:{
					            items: 2,
					            nav: false
					        },
					        1000:{
					            items: 3,
					            nav: false,
					            loop: false
					        }
					    }
					});
				<?php } ?>

				<?php
				// Featured Listings Carousel
				if(is_home() || is_front_page() || is_page_template('template-demo-home-map.php') || is_page_template('template-demo-home-video.php') || is_page_template('template-demo-home-listings-slider.php')) { ?>
					var owl = jQuery('#owl-featured-carousel');
					owl.owlCarousel({
					    items: 3,
					    loop: true,
					    margin: 20,
					    nav: true,
					    navContainer: '#featured-listings-nav',
					    navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
					    dots: false,
					    autoplay: true,
					    autoplayTimeout: 4000,
					    autoplayHoverPause: true,
					    responsive:{
					        0:{
					            items: 1,
					            nav: false
					        },
					        600:{
					            items: 2,
					            nav: false
					        },
					        1000:{
					            items: 3,
					            nav: true,
					            loop: false
					        }
					    }
					});
				<?php } ?>

				<?php
				$ct_home_layout = isset( $ct_options['ct_home_layout']['enabled'] ) ? $ct_options['ct_home_layout']['enabled'] : '';
				$ct_home_layout_array = (array) $ct_home_layout;
				if(in_array('Listings Carousel', $ct_home_layout_array)) { ?>
					// Single Listing Carousel
					var owl = jQuery('#home .owl-carousel');
					owl.owlCarousel({
					    items: 3,
					    loop: true,
					    margin: 0,
					    nav: false,
					    dots: false,
					    autoplay: false,
					    autoplayTimeout: 4000,
					    autoplayHoverPause: false,
					    responsive:{
					        0:{
					            items: 1,
					            nav: false
					        },
					        480:{
					            items: 1,
					            nav: false
					        },
					        768:{
					            items: 2,
					            nav: false,
					            loop: false
					        },
					        1440:{
					            items: 3,
					            nav: false,
					            loop: false
					        }
					    }
					});
				<?php } ?>

		        <?php
		        $ct_listing_single_sticky_sidebar = isset( $ct_options['ct_listing_single_sticky_sidebar'] ) ? $ct_options['ct_listing_single_sticky_sidebar'] : '';
		        if(!is_singular('listings') && $ct_options['ct_mode'] != "single-listing") { ?>

		        /*if($ct_listing_single_sticky_sidebar == 'yes') {
		        	var a = new StickySidebar('#sidebar', {
						topSpacing: 110,
						bottomSpacing: 20,
						containerSelector: '.container',
						innerWrapperSelector: '#sidebar-inner'
					});
		        }*/
		        		
	            jQuery('.flexslider').flexslider({
	                animation: "<?php echo strtolower($ct_options['ct_flex_animation']); ?>",
	                slideDirection: "<?php echo strtolower($ct_options['ct_flex_direction']); ?>",
	                <?php if(!empty($ct_options['ct_flex_autoplay'])) { ?>
	                slideshow: "<?php echo strtolower($ct_options['ct_flex_autoplay']); ?>",
	                <?php } else { ?>
                	slideshow: true,
                	<?php } ?>
	                <?php if(!empty($ct_options['ct_flex_speed'])) { ?>
	                slideshowSpeed: <?php echo esc_html($ct_options['ct_flex_speed']); ?>,
		            <?php } ?>
		            <?php if(!empty($ct_options['ct_flex_duration'])) { ?>
	                animationDuration: <?php echo esc_html($ct_options['ct_flex_duration']); ?>,  
	                <?php } ?>
	                controlNav: false,
	            	directionNav: true,
	                keyboardNav: true,
	                <?php if(!empty($ct_options['ct_flex_randomize'])) { ?>
	                randomize: <?php echo esc_html($ct_options['ct_flex_randomize']); ?>,
	                <?php } ?>
	                pauseOnAction: true,
	                pauseOnHover: false,	 				
	                animationLoop: true,
	                smoothHeight: true,
	            });
	            <?php } ?>
	        });
	    </script>
	    
	    <?php if(is_page_template('template-contact.php')) { ?>
			<script>
			jQuery(document).ready(function() {
				jQuery("#contactform").validationEngine({
					ajaxSubmit: true,
					ajaxSubmitFile: "<?php echo get_template_directory_uri(); ?>/includes/ajax-submit-contact.php",
					ajaxSubmitMessage: "<?php $contact_success = str_replace(array("\r\n", "\r", "\n"), " ", $ct_options['ct_contact_success']); echo esc_html($contact_success); ?>",
					success :  false,
					failure : function() {}
				});
			});
			</script>
		<?php } ?>
	    
	    <?php
	    $mode = isset( $ct_options['ct_mode'] ) ? esc_html( $ct_options['ct_mode'] ) : '';
	    if(is_singular('listings') || $mode == "single-listing") { ?>
			<script>
				jQuery(window).load(function() {
					jQuery('#carousel').flexslider({
						animation: "slide",
						controlNav: false,
						animateHeight: true,
						directionNav: true,
						animationLoop: false,
						<?php if(!empty($ct_options['ct_flex_autoplay'])) { ?>
		                slideshow: "<?php echo strtolower($ct_options['ct_flex_autoplay']); ?>",
		                <?php } else { ?>
	                	slideshow: true,
	                	<?php } ?>
						<?php if(!empty($ct_options['ct_flex_speed'])) { ?>
						slideshowSpeed: <?php echo esc_html($ct_options['ct_flex_speed']); ?>,
						<?php } ?>
						<?php if(!empty($ct_options['ct_flex_duration'])) { ?>
						animationDuration: <?php echo esc_html($ct_options['ct_flex_duration']); ?>,
						<?php } ?>
						<?php if($ct_options['ct_mode'] == "single-listing") { ?>
						itemWidth: 200,
						<?php } else { ?>
						itemWidth: 120,
						<?php } ?>
						itemMargin: 0,
						asNavFor: '#slider'
					});
				   
					jQuery('#slider').flexslider({
						<?php if(!empty($ct_options['ct_flex_animation'])) { ?>
		                animation: "<?php echo strtolower($ct_options['ct_flex_animation']); ?>",
		                <?php } ?>
		                <?php if(!empty($ct_options['ct_flex_direction'])) { ?>
		                slideDirection: "<?php echo strtolower($ct_options['ct_flex_direction']); ?>",
		                <?php } ?>
		                <?php if(!empty($ct_options['ct_flex_autoplay'])) { ?>
		                slideshow: "<?php echo strtolower($ct_options['ct_flex_autoplay']); ?>",
		                <?php } else { ?>
	                	slideshow: true,
	                	<?php } ?>
		                <?php if(!empty($ct_options['ct_flex_speed'])) { ?>
		                slideshowSpeed: <?php echo esc_html($ct_options['ct_flex_speed']); ?>,
		                <?php } ?>
		                <?php if(!empty($ct_options['ct_flex_duration'])) { ?>
		                animationDuration: <?php echo esc_html($ct_options['ct_flex_duration']); ?>,  
		                <?php } ?>
						smoothHeight: true,
						controlNav: false,
						animationLoop: false,
						slideshow: false,
						sync: "#carousel"
					});

					// Slider for Testimonails			
		            jQuery('.flexslider').flexslider({
		            	<?php if(!empty($ct_options['ct_flex_animation'])) { ?>
		                animation: "<?php echo strtolower($ct_options['ct_flex_animation']); ?>",
		                <?php } ?>
		                <?php if(!empty($ct_options['ct_flex_direction'])) { ?>
		                slideDirection: "<?php echo strtolower($ct_options['ct_flex_direction']); ?>",
		                <?php } ?>
		                <?php if(!empty($ct_options['ct_flex_autoplay'])) { ?>
		                slideshow: "<?php echo strtolower($ct_options['ct_flex_autoplay']); ?>",
		                <?php } else { ?>
	                	slideshow: true,
	                	<?php } ?>
		                <?php if(!empty($ct_options['ct_flex_speed'])) { ?>
		                slideshowSpeed: <?php echo esc_html($ct_options['ct_flex_speed']); ?>,
		                <?php } ?>
		                <?php if(!empty($ct_options['ct_flex_duration'])) { ?>
		                animationDuration: <?php echo esc_html($ct_options['ct_flex_duration']); ?>,  
		                <?php } ?>
		                controlNav: false,
		                directionNav: true,
		                keyboardNav: true,
		                <?php if(!empty($ct_options['ct_flex_randomize'])) { ?>
		                randomize: <?php echo esc_html($ct_options['ct_flex_randomize']); ?>,
		                <?php } ?>
		                pauseOnAction: true,
		                pauseOnHover: false,	 				
		                animationLoop: true	
		            });
				});
				
				jQuery(document).ready(function() {
					jQuery("#listingscontact").validationEngine({
						ajaxSubmit: true,
						ajaxSubmitFile: "<?php echo get_template_directory_uri(); ?>/includes/ajax-submit-listings.php",
						ajaxSubmitMessage: "<?php $contact_success = str_replace(array("\r\n", "\r", "\n"), " ", $ct_options['ct_contact_success']); echo esc_html($contact_success); ?>",
						success :  false,
						failure : function() {}
					});
					jQuery('.gallery-item').magnificPopup({
						type: 'image',
						gallery:{
							enabled:true
						}
					});
				});
			</script>
	    <?php } ?>

	    <?php if(is_page_template('template-submit-listing.php') || is_page_template('template-edit-listing.php')) { ?>
			<script>
				jQuery(function() {
					   
					function Onnextload(){
					var customcords = jQuery('#customMetaLatLng').val();
					var ccords=customcords.split(",");
					var mlat=ccords[0];
					var mlng=ccords[1];
					jQuery("#pac-input").geocomplete({
						map: "#map-canvas",
						details: "form",
						zoom:10,
						location: [mlat, mlng], 
						markerOptions: {
				            draggable: true
				        },
						types: ["geocode", "establishment"],
					}); 
					jQuery("#pac-input").geocomplete("find", jQuery("input[name=customMetaLatLng]").val());

					setTimeout(function(){ 
						jQuery(".pac-container").prependTo("#autocomplete-results");
					}, 300); 
					   }
					   
					
					var customcords=jQuery('#customMetaLatLng').val();
					var ccords=customcords.split(",");
					var mlat=ccords[0];
					var mlng=ccords[1];
					jQuery("#pac-input").geocomplete({
						map: "#map-canvas",
						details: "form",
						zoom:10,
						location: [mlat, mlng], 
						markerOptions: {
				            draggable: true
				        },
						types: ["geocode", "establishment"],
					}); 
					jQuery("#pac-input").geocomplete("find", jQuery("input[name=customMetaLatLng]").val());

					setTimeout(function(){ 
						jQuery(".pac-container").prependTo("#autocomplete-results");
					}, 300); 

					/* jQuery("#pac-input").bind("geocode:dragged", function(event, latLng){
						var latitude = latLng.lat();
						var longitude = latLng.lng();
						var latlong = latitude + ', ' + longitude;
						jQuery("input[name=customMetaLatLng]").val(latlong);
						
			        }); */

					jQuery("#pac-input").bind("geocode:dragged", function(event, latLng){	
					$("input[name=lat]").val(latLng.lat());
					$("input[name=lng]").val(latLng.lng()); 
					$("#pac-input").geocomplete("find", latLng.toString());
						var latlong = latLng.lat() + ', ' + latLng.lng();
						jQuery("input[name=customMetaLatLng]").val(latlong);
							var options = {
							map: "#map-canvas",
							mapOptions: {
								streetViewControl: false,
								mapTypeId : google.maps.MapTypeId.HYBRID
							},
							markerOptions: {
								draggable: true
							}
						};
					var map = $("#pac-input").geocomplete("map");
				    map.panTo(latLng);
				    var geocoder = new google.maps.Geocoder();
				    geocoder.geocode({'latLng': latLng }, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							if (results[0]) {				
								//$('#pac-input').val(results[0].formatted_address);
								//var zipcode = results[0].address_components[0].long_name;
								//$('#customTaxZip').val(zipcode);				
							}
						}
					});
					//google.maps.event.addListener(autocomplete, 'place_changed', function() {});
					
					 });
									
					jQuery("#pac-input").click(function(){
							jQuery("#pac-input").trigger("geocode");
						});
					});
					</script>
	    <?php } ?>

		<?php		
		$ct_header_listing_search = isset( $ct_options['ct_header_listing_search'] ) ? esc_html( $ct_options['ct_header_listing_search'] ) : '';
		$ct_hero_search_bg = isset( $ct_options['ct_hero_search_bg']['url'] ) ? esc_html( $ct_options['ct_hero_search_bg']['url'] ) : '';
		$ct_hero_search_top_pad = isset( $ct_options['ct_hero_search_top_pad'] ) ? esc_html( $ct_options['ct_hero_search_top_pad'] ) : '';
		$ct_hero_search_btm_pad = isset( $ct_options['ct_hero_search_btm_pad'] ) ? esc_html( $ct_options['ct_hero_search_btm_pad'] ) : '';
		$ct_use_propinfo_icons = isset( $ct_options['ct_use_propinfo_icons'] ) ? esc_html( $ct_options['ct_use_propinfo_icons'] ) : '';
		$ct_home_testimonials_style = isset( $ct_options['ct_home_testimonials_style'] ) ? esc_html( $ct_options['ct_home_testimonials_style'] ) : '';

		/*-----------------------------------------------------------------------------------*/
		/* Custom Google Fonts & iHomeFinder CSS & IDX Broker */
		/*-----------------------------------------------------------------------------------*/
	    
		echo '<style type="text/css">';
			echo 'h1, h2, h3, h4, h5, h6 { font-family: "' . esc_html($ct_options['ct_heading_font']) . '";}';
			echo 'body, .slider-wrap, input[type="submit"].btn { font-family: "' . esc_html($ct_options['ct_body_font']) . '";}';
			echo '.fa-close:before { content: "\f00d";}';
			if($ct_hero_search_bg != '' || $ct_hero_search_top_pad != '' || $ct_hero_search_btm_pad != '') { echo '.hero-search { background: url(' . $ct_hero_search_bg . ') no-repeat center center; background-size: cover; padding-top:' . $ct_hero_search_top_pad . '%; padding-bottom:' . $ct_hero_search_btm_pad . '%;}';}
			if($ct_hero_search_top_pad || $ct_hero_search_btm_pad != '') { }
			if($ct_header_listing_search == 'yes') { echo '.search-listings #map-wrap { margin-bottom: 0; background-color: #fff;} span.map-toggle, span.search-toggle { border-bottom-right-radius: 3px;} span.searching { border-bottom-left-radius: 3px;}'; }
			if($ct_use_propinfo_icons == 'icons') { echo '.propinfo li { line-height: 2.35em;} .row.baths svg { position: relative; top: 3px; left: -2px;} .row.sqft svg { position: relative; top: 3px;}'; }
			if($ct_home_testimonials_style == 'testimonials-style-two') {
				echo '.aq-block-aq_testimonial_block figure { width: 30%;} .aq-block-aq_testimonial_block .flexslider .slides img { top: 50%; left: 25%; height: 260px; width: 260px; border-radius: 240px;}';
				echo '@media only screen and (max-width: 959px) { .aq-block-aq_testimonial_block .flexslider .slides img { height: 180px; width: 180px; border-radius: 180px;} }';
				echo '@media only screen and (max-width: 767px) { .aq-block-aq_testimonial_block .flexslider .slides img { height: 130px; width: 130px; border-radius: 130px;} }';
				echo '@media only screen and (max-width: 479px) { .aq-block-aq_testimonial_block .flexslider .slides img { height: 80px; width: 80px; border-radius: 80px;} }';
			}
			// Custom Styles for iHomeFinder Homepage Search Widget
			if(function_exists('optima_express_register_widgets')) {
				echo '.advanced-search.idx, .home .widget_ihomefinderquicksearchwidget { overflow: visible;}';
				echo '.home .widget_ihomefinderquicksearchwidget .ihf-widget { padding: 0; border: 1px solid #d5d9dd; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px;}';
				echo '.home .widget_ihomefinderquicksearchwidget, .home #ihf-main-container .mb-25 { margin-bottom: 0;}';
				echo '.home #searchProfile select { z-index: 99;}';
				echo '.ihf-widget { padding: 20px; overflow: visible;}';
				echo '.widget.widget_ihomefinderpropertiesgallery .gallery-prop-info { padding: 20px;}';
				echo '#ihf-main-container .modal { z-index: 9999999;}';
				echo '.ihf-container-modal .modal-backdrop { z-index: 999999;}';
				echo '#ihf-main-container .modal.in .modal-dialog { transform: translate(0,260px);}';
				echo '#ihf-main-container .customSelect.form-control { display: none !important;}';
				echo '#ihf-main-container .carousel-control { height: auto; background: none; border: none;}';
				echo '#ihf-main-container .carousel-caption { background: none;}';
				echo '#ihf-main-container .modal { width: auto; margin-left: 0; background-color: transparent; border: 0;}';
				echo '.ihf-results-links > a:nth-child(1) { display: none;}';
				echo '#ihf-main-container .btn { height: initial !important; line-height: initial !important;}';
				echo '#ihf-main-container .ihf-social-share .btn { height: 24px !important;}';
				echo '.widget .dsidx-resp-search-form { padding: 20px 20px 0 20px;}';
				echo '.widget .dsidx-resp-area input[type="text"], .dsidx-resp-area select { position: relative !important; opacity: 100 !important;}';
				echo '.widget .dsidx-resp-search-form .dsidx-resp-area .customSelect { display: none !important;}';
			}
			if(class_exists('Idx_Broker_Plugin')) {
				//echo '.idx-omnibar-form { display: none;}';
				echo '.idx-omnibar-form input { line-height: 2em;}';
				echo '.idx-omnibar-form button.idx-omnibar-extra-button { height: auto; margin-bottom: 10px; padding: 1% 0; font-size: .9em; background: #29333d; color: #fff; vertical-align: initial; border: none;}';
				echo '.home .advanced-search.idx .IDX-quicksearchWrapper { box-shadow: none !important; -webkit-box-shadow: none !important; border: none !important;}';
				echo '.home .advanced-search.idx .IDX-quicksearchWrapper form { background: #fff !important;}';
				echo '.home .advanced-search.idx .IDX-quicksearchWrapper label { display: block !important; float: none !important; margin: 0 !important;}';
				echo '.IDX-qsFieldWrap { float: left !important; padding: 0 !important; margin: 0 20px 20px 0 !important; text-align: left !important;}';
				echo '.IDX-quicksearchWrapper input, .IDX-quicksearchWrapper select { width: auto !important;}';
			}
			echo '.form-group { width: 49.0%;}';
		echo '</style>';

		if(function_exists('optima_express_register_widgets')) {
			echo '<script>';
			echo '(function () {';
			    echo '"use strict";';
			    echo 'jQuery.getScript("/wp-content/plugins/optima-express/js/bootstrap-libs/bootstrap.min.js");';
			echo '}());';
			echo '</script>';
		}
		
		/*-----------------------------------------------------------------------------------*/
		/* Custom Stylesheet */
		/*-----------------------------------------------------------------------------------*/

		$ct_use_styles = isset( $ct_options['ct_use_styles'] ) ? esc_attr( $ct_options['ct_use_styles'] ) : '';
		if($ct_use_styles == "yes") {
			include(TEMPLATEPATH . '/includes/custom-stylesheet.php');
	    }  

	    /*-----------------------------------------------------------------------------------*/
		/* Custom CSS */
		/*-----------------------------------------------------------------------------------*/

		if(!empty($ct_options['ct_custom_css'])) {
			echo '<style type="text/css">';
				echo $ct_options['ct_custom_css']; 
			echo '</style>';
		}

		/*-----------------------------------------------------------------------------------*/
		/* Boxed Layout */
		/*-----------------------------------------------------------------------------------*/
		
		$ct_boxed = isset( $ct_options['ct_boxed'] ) ? esc_attr( $ct_options['ct_boxed'] ) : '';
		if($ct_boxed == "boxed") {
			echo '<style type="text/css">';
			echo 'body { background-color: #ececec;} #wrapper { background: #fff;} .container { padding-right: 20px !important; padding-left: 20px !important;} #top #top-inner { width: 1020px;} footer { padding-left: 0; padding-right: 0;}';
			echo '</style>';
		}

		/*-----------------------------------------------------------------------------------*/
		/* Full Width Two Layout */
		/*-----------------------------------------------------------------------------------*/
		
		$ct_boxed = isset( $ct_options['ct_boxed'] ) ? esc_attr( $ct_options['ct_boxed'] ) : '';
		if($ct_boxed == "full-width-two") {
			echo '<style type="text/css">';
			echo '.container { max-width: 90%;}';
			echo '.listing.idx-listing figure img { width: 600px;';
			echo '</style>';
		}

	}
}
add_action('wp_head', 'ct_wp_head');

/*-----------------------------------------------------------------------------------*/
/* CT Footer */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_wp_footer')) {
	function ct_wp_footer() {
		
		global $ct_options;

		$ct_search_results_listing_style = isset( $ct_options['ct_search_results_listing_style'] ) ? $ct_options['ct_search_results_listing_style'] : '';
		$ct_header_currency_switcher = isset( $ct_options['ct_header_currency_switcher'] ) ? esc_html( $ct_options['ct_header_currency_switcher'] ) : '';

		if($ct_header_currency_switcher == 'yes') { ?>
		<script>
	    jQuery(window).load(function($) {
	    	<?php if($ct_header_currency_switcher == 'yes') { ?>

	    		var savedRate, savedCurrency;

		    	jQuery('#ct-currency-switch').curry({
				    change: true,
				    target: '.listing-price',
				    base: savedCurrency
				 }).change(function(){
				    var selected = jQuery(this).find(':selected'), // get selected currency
				    rate = selected.data('rate'), // get currency rate
				    currency = selected.val(); // get currency name
				    Cookies.remove('site_currency', { path: '' }); 
				    Cookies.remove('site_rate', { path: '' }); 
				    Cookies.set('site_currency', currency, { expires: 7, path: '' });
				    Cookies.set('site_rate', rate, { expires: 7, path: '' });
				    //console.log( currency, rate );
				 });
				 var CookieSet = Cookies.get('site_currency')
				 
				 if (CookieSet == 'undefined') {
					savedRate = 1;
					savedCurrency = '$ USD';
					//console.log('CookieSet Empty. Set to '+savedCurrency);
				 } else {
					savedRate = Cookies.get('site_rate');
					savedCurrency = Cookies.get('site_currency');
					//console.log('CookieSet read from cookie. Saved Rate: '+savedRate+' Saved currency: '+savedCurrency);
				 }
				 
				 jQuery('#ct-currency-switch').val( savedCurrency );
				 jQuery('#ct-currency-switch').show();
		    <?php } ?>
			jQuery('.idx-omnibar-form').show();
	    });
	    </script>
	    <?php }

	    if(function_exists('cpg_load_scripts')) {
	    	echo '<script src="//www.paypalobjects.com/api/checkout.js" async></script>';
	    }

	}
}
add_action('wp_footer', 'ct_wp_footer');

/*-----------------------------------------------------------------------------------*/
/* Disable Visual Composer Updater */
/*-----------------------------------------------------------------------------------*/

if(function_exists('Vc_Base')) {
	if ( function_exists( 'vc_set_as_theme' ) ) {
		vc_set_as_theme( $disable_updater = true );
	}
}

/*-----------------------------------------------------------------------------------*/
/* Visual Composer Pagintion - Not Used */
/*-----------------------------------------------------------------------------------

function ct_vc_pagination($pages = '', $range = 2) {

	$showitems = ($range * 2)+1;
	$paginationData = '';

	global $paged;
	if(empty($paged)) $paged = 1;

	if($pages == '') {
	    global $wp_query;
	    $pages = $wp_query->max_num_pages;
	    if(!$pages) {
	        $pages = 1;
	    }
	}

	if(1 != $pages) {
	    $paginationData = '<div class="pagination">';
	    if($paged > 2 && $paged > $range+1 && $showitems < $pages) {
	        $paginationData .= '<a href="' .get_pagenum_link(1). '">&laquo;</a>';
	    }
	    if($paged > 1 && $showitems < $pages) {
	        $paginationData .= '<a href="' .get_pagenum_link($paged - 1). '">&laquo;</a>';
	    }

	    for ($i=1; $i <= $pages; $i++) {
	        if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
	            if($paged == $i){
	                $paginationData .= "<span class='current'>".$i."</span>";
	            } else {
	                $paginationData .= "<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
	            }
	        }
	    }

	    if ($paged < $pages && $showitems < $pages) {
	        $paginationData .= "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
	    }
	    if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
	        $paginationData .= "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
	    }
	    $paginationData .= '</div>';
	}

	return $paginationData;
}

/*-----------------------------------------------------------------------------------*/
/* Add Buyer User Role */
/*-----------------------------------------------------------------------------------*/

$ct_add_buyer_role = add_role(
	'buyer',
	__('Buyer', 'contempo'),
	array(
		'read'						=> true,
	)
);

/*-----------------------------------------------------------------------------------*/
/* Add Seller User Role */
/*-----------------------------------------------------------------------------------*/

$ct_add_seller_role = add_role(
	'seller',
	__('Seller', 'contempo'),
	array(
		'delete_posts'				=> true,
        'delete_published_posts'	=> true,
        'edit_posts'				=> true,
        'edit_published_posts'		=> true,
        'edit_others_posts'			=> false,
        'publish_posts'				=> true,
		'read'						=> true,
        'upload_files'				=> true,
	)
);

/*-----------------------------------------------------------------------------------*/
/* Add Agent User Role */
/*-----------------------------------------------------------------------------------*/

$ct_add_agent_role = add_role(
	'agent',
	__('Agent', 'contempo'),
	array(
		'delete_posts'				=> true,
        'delete_published_posts'	=> true,
        'edit_posts'				=> true,
        'edit_published_posts'		=> true,
        'edit_others_posts'			=> false,
        'publish_posts'				=> true,
		'read'						=> true,
        'upload_files'				=> true,
	)
);

/*-----------------------------------------------------------------------------------*/
/* Add Broker User Role */
/*-----------------------------------------------------------------------------------*/

$ct_add_broker_role = add_role(
	'broker',
	__('Broker', 'contempo'),
	array(
		'delete_posts'				=> true,
        'delete_published_posts'	=> true,
        'edit_posts'				=> true,
        'edit_published_posts'		=> true,
        'edit_others_posts'			=> false,
        'publish_posts'				=> true,
		'read'						=> true,
        'upload_files'				=> true,
	)
);

/*-----------------------------------------------------------------------------------*/
/* Delete uploaded files from Edit listing page */
/*-----------------------------------------------------------------------------------*/

add_action('wp_ajax_delete_files', 'ct_delete_files_callback');
add_action('wp_ajax_nopriv_delete_files', 'ct_delete_files_callback');

if(!function_exists('ct_delete_files_callback')) {
	function ct_delete_files_callback(){
		
		$file_id = $_POST['old_field'];
		if(!empty($file_id)){
		$current_post_id = $_POST['current_post'];		
		$current_post_meta = get_post_meta($current_post_id, '_ct_files', true);		
		unset($current_post_meta[$file_id]);
		$update_files_data = update_post_meta($current_post_id, '_ct_files', $current_post_meta);		
			if(!empty($update_files_data)){
				echo "true";
			} else {
				echo "false";
			}
		}
		die;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Ajax Listing Suggest Search with Keyword */
/*-----------------------------------------------------------------------------------*/

add_action('wp_ajax_street_keyword_search', 'ct_street_keyword_search_callback');
add_action('wp_ajax_nopriv_street_keyword_search', 'ct_street_keyword_search_callback');

if(!function_exists('ct_street_keyword_search_callback')) {
	function ct_street_keyword_search_callback(){
		global $wpdb;
		
		$post_keyword = $_POST['keyword_value'];
			
		if(!empty($post_keyword)){
			
			$posts_data = $wpdb->get_results ("SELECT * FROM ".$wpdb->prefix ."posts WHERE post_type= 'listings' AND post_status= 'publish' AND (post_content like '%" .$post_keyword. "%' OR post_title like '%".$post_keyword. "%') ORDER BY post_title" ); 
		
			$post_meta_data = $wpdb->get_results ("SELECT * FROM ".$wpdb->prefix ."posts WHERE ".$wpdb->prefix ."posts.post_status ='publish' AND ".$wpdb->prefix ."posts.post_type= 'listings' AND ".$wpdb->prefix ."posts.ID = (SELECT ".$wpdb->prefix ."postmeta.post_id  FROM ".$wpdb->prefix ."postmeta  WHERE ".$wpdb->prefix ."postmeta.meta_key = '_ct_listing_alt_title'  AND ".$wpdb->prefix ."postmeta.meta_value LIKE '%".$post_keyword. "%' OR ".$wpdb->prefix ."postmeta.meta_key = '_ct_rental_title'  AND ".$wpdb->prefix ."postmeta.meta_value LIKE '%".$post_keyword. "%' )");
	
			$post_terms = get_posts(array(
				'showposts' => -1,
				'post_type' => 'listings',
				'post_status' => 'publish',
				'tax_query' => array(
				'relation' => 'OR',
					array(
						'taxonomy' => 'city',
						'field' => 'name',
						'terms' => array($post_keyword)
					),
					 array(
						'taxonomy' => 'zipcode',
						'field' => 'name',
						'terms' => array($post_keyword)
					),
					array(
						'taxonomy' => 'country',
						'field' => 'name',
						'terms' => array($post_keyword)
					),
					array(
						'taxonomy' => 'state',
						'field' => 'name',
						'terms' => array($post_keyword)
					),
					array(
						'taxonomy' => 'community',
						'field' => 'name',
						'terms' => array($post_keyword)
					),
				))
			);
			
			if(!empty($posts_data)) {	
				$html .= '<ul class="listing-records">';
				 foreach($posts_data as $records){
					$img_src = wp_get_attachment_image_src( get_post_thumbnail_id($records->ID), 'thumbnail_size' );	

					$out = "";
					$source = get_post_meta( $records->ID, "source", true );
					
					if($source == "idx-api") {

						$photos = get_post_meta($records->ID, "_ct_slider", true);
						
						if(!empty($photos)) {

							foreach($photos as $attachment_id => $attachment_url) {
								$out = '<img src="' . esc_url($attachment_url) . '" width="50" />';
								break;
							}
						}
					}
					
					if($out == "") {
						$thumb_id = get_post_thumbnail_id($records->ID);
						$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($records->ID),'medium', true);
						if(!empty($thumb_id)) {
							$out = '<img src="' . $thumb_url[0] . '" width="50" />';
						} else {
							$out = '<img src="' . get_template_directory_uri() . '/images/no-image.png" srcset="' . get_template_directory_uri() . '/images/no-image@2x.png 2x" width="50" />';
						}
					}

					$beds = strip_tags( get_the_term_list( $records->ID, 'beds', '', ', ', '' ) );
					if(!empty($beds)){ $list_beds = $beds;}	else { $list_beds = 'N/A'; }		
					
					$baths = strip_tags( get_the_term_list( $records->ID, 'baths', '', ', ', '' ) );
					if(!empty($baths)){ $list_baths = $baths;}	else { $list_baths = 'N/A'; }
					
					$sqft = get_post_meta($records->ID, "_ct_sqft",true);
					if(!empty($sqft)){ $list_sqft = $sqft;}	else { $list_sqft = 'N/A'; }	
					
					$html .= '<li class="listing_media" att_id ="' . $records->post_title . '">
                            <div class="media-left">
                                <a class="media-object" href="' . get_permalink($records->ID) . '">' . $out . '</a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="' . get_permalink($records->ID) . '">' . $records->post_title . '</a></h4> 
								<ul class="amenities"> 
									<li><strong>'. __('Beds: ', 'contempo') . '</strong>' . $list_beds.'</li>
									<li><strong>'. __('Baths: ', 'contempo') . '</strong>' . $list_baths . '</li>
									<li><strong>' . __('Sq Ft: ', 'contempo') . '</strong>' . $list_sqft . '</li>
								</ul>								
                            </div>
                        </li>';
			
				} 
				$html .= '</ul>';
				$html .= '<div class="search-listingfooter">';
				if(count($posts_data) == 1){
					$html .= '<span class="search-listingcount">' . __('1 Listing found', 'contempo') . '</span>';
				} else {
					$html .= '<span class="search-listingcount">' . count($posts_data) . __(' Listings found', 'contempo') . '</span>';
				}
				$html .= '</div>';	
			} elseif(!empty($post_meta_data)) {			
				$html .= '<ul>';
				 foreach($post_meta_data as $metarecords){
					
					$img_src = wp_get_attachment_image_src( get_post_thumbnail_id($metarecords->ID), 'thumbnail_size' );	

					$out = "";
					$source = get_post_meta( $metarecords->ID, "source", true );
					
					if($source == "idx-api") {

						$photos = get_post_meta($metarecords->ID, "_ct_slider", true);
						
						if(!empty($photos)) {

							foreach($photos as $attachment_id => $attachment_url) {
								$out = '<img src="' . esc_url($attachment_url) . '" width="50" />';
								break;
							}
						}
					}
					
					if($out == "") {
						$thumb_id = get_post_thumbnail_id($metarecords->ID);
						$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($metarecords->ID),'medium', true);
						if(!empty($thumb_id)) {
							$out = '<img src="' . $thumb_url[0] . '" width="50" />';
						} else {
							$out = '<img src="' . get_template_directory_uri() . '/images/no-image.png" srcset="' . get_template_directory_uri() . '/images/no-image@2x.png 2x" width="50" />';
						}
					}

					$beds = strip_tags( get_the_term_list( $metarecords->ID, 'beds', '', ', ', '' ) );
					if(!empty($beds)){ $list_beds = $beds;}	else { $list_beds = 'N/A'; }		
					
					$baths = strip_tags( get_the_term_list($metarecords->ID, 'baths', '', ', ', '' ) );
					if(!empty($baths)){ $list_baths = $baths;}	else { $list_baths = 'N/A'; }
					
					$sqft = get_post_meta($metarecords->ID, "_ct_sqft",true);
					if(!empty($sqft)){ $list_sqft = $sqft;}	else { $list_sqft = 'N/A'; }
					
					$html .= '<li class="listing_media" att_id ="' . get_the_title($metarecords->ID) . '">
                            <div class="media-left">
                                <a class="media-object" href="' . get_permalink($metarecords->ID) . '">' . $out . '</a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="'.get_permalink($metarecords->ID).'">' . get_post_meta( $metarecords->ID, '_ct_listing_alt_title', true ) . '</a></h4> 
								<ul class="amenities"> 
									<li><strong>'. __('Beds: ', 'contempo') . '</strong>' . $list_beds.'</li>
									<li><strong>'. __('Baths: ', 'contempo') . '</strong>' . $list_baths . '</li>
									<li><strong>' . __('Sq Ft: ', 'contempo') . '</strong>' . $list_sqft . '</li>
								</ul>								
                            </div>
                        </li>';
			
				} 
				$html .= '</ul>';
				$html .= '<div class="search-listingfooter">';
				if(count($post_meta_data) == 1){
					$html .= '<span class="search-listingcount">' . __('1 Listing found', 'contempo') . '</span>';
				} else {
					$html .= '<span class="search-listingcount">' . count($post_meta_data) . __(' Listings found', 'contempo') . '</span>';
				}
				$html .= '</div>';				
			} elseif(!empty($post_terms)) {	
				$html .= '<ul class="listing-records">';
				 foreach($post_terms as $terms_records){
					$img_src = wp_get_attachment_image_src( get_post_thumbnail_id($terms_records->ID), 'thumbnail_size' );		

					$out = "";
					$source = get_post_meta( $terms_records->ID, "source", true );
					
					if($source == "idx-api") {

						$photos = get_post_meta($terms_records->ID, "_ct_slider", true);
						
						if(!empty($photos)) {

							foreach($photos as $attachment_id => $attachment_url) {
								$out = '<img src="' . esc_url($attachment_url) . '" width="50" />';
								break;
							}
						}
					}
					
					if($out == "") {
						$thumb_id = get_post_thumbnail_id($terms_records->ID);
						$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($terms_records->ID),'medium', true);
						if(!empty($thumb_id)) {
							$out = '<img src="' . $thumb_url[0] . '" width="50" />';
						} else {
							$out = '<img src="' . get_template_directory_uri() . '/images/no-image.png" srcset="' . get_template_directory_uri() . '/images/no-image@2x.png 2x" width="50"/>';
						}
					}

					$beds = strip_tags( get_the_term_list( $terms_records->ID, 'beds', '', ', ', '' ) );
					if(!empty($beds)){ $list_beds = $beds;}	else { $list_beds = 'N/A'; }		
					
					$baths = strip_tags( get_the_term_list( $terms_records->ID, 'baths', '', ', ', '' ) );
					if(!empty($baths)){ $list_baths = $baths;}	else{  $list_baths = 'N/A'; }
					
					$sqft = get_post_meta($terms_records->ID, "_ct_sqft",true);
					if(!empty($sqft)){ $list_sqft = $sqft;}	else { $list_sqft = 'N/A'; }	
					
					$html .= '<li class="listing_media" att_id ="' . $terms_records->post_title . '">
                            <div class="media-left">
                                <a class="media-object" href="' . get_permalink($terms_records->ID) . '">' . $out .'</a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="' . get_permalink($terms_records->ID) .'">' . $terms_records->post_title . '</a></h4> 
								<ul class="amenities"> 
									<li><strong>'. __('Beds: ', 'contempo') . '</strong>' . $list_beds.'</li>
									<li><strong>'. __('Baths: ', 'contempo') . '</strong>' . $list_baths . '</li>
									<li><strong>' . __('Sq Ft: ', 'contempo') . '</strong>' . $list_sqft . '</li>
								</ul>								
                            </div>
                        </li>';
				} 
				$html .= '</ul>';
				$html .= '<div class="search-listingfooter">';
				if(count($post_terms) == 1) {
					$html .= '<span class="search-listingcount">' . __('1 Listing found', 'contempo') . '</span>';
				} else {
					$html .= '<span class="search-listingcount">' . count($post_terms) . __(' Listings found', 'contempo') . '</span>';
				}
				$html .= '</div>';	
				
			} else {
				$html .= '<ul><li id="no-listings-found">' . __('No Listings Found', 'contempo') . '</li></ul>';
			}
		}
		echo $html;
		die;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Add Option to Disable Admin Bar for non-Admins Only */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_disable_admin_bar')) {
	function ct_disable_admin_bar() {
		global $ct_options;

		$ct_disable_admin_bar = isset( $ct_options['ct_disable_admin_bar'] ) ? esc_attr( $ct_options['ct_disable_admin_bar'] ) : '';
		
		if(!current_user_can('administrator') && !is_admin() && $ct_disable_admin_bar == 'yes') {
			show_admin_bar(false);
		}
	}
	add_action('after_setup_theme', 'ct_disable_admin_bar');
}

/*-----------------------------------------------------------------------------------*/
/* Add Listing Search to Admin */
/*-----------------------------------------------------------------------------------*/

if(is_admin()) {
	function listing_search_where($where){

	    if(isset($_GET['post_type']) && $_GET['post_type'] == 'listings') {
	        //I overwrite the where clause
	        $where = str_replace("AND wp_posts.post_type IN ('post', 'page')", "AND wp_posts.post_type IN ('post', 'page', 'listings')", $where);    
	    }
	    
	    return $where;
	}
	add_filter( 'posts_where', 'listing_search_where');
}

/*-----------------------------------------------------------------------------------*/
/* Expire Listing after X Days */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_expire_listings')) {
	function ct_expire_listings() {
		global $ct_options, $wpdb, $post, $wp_query;

		if(!is_object($post)) 
	        return;

		$author_level = get_the_author_meta('user_level');

		$ct_enable_front_end_paid = isset( $ct_options['ct_enable_front_end_paid'] ) ? esc_attr( $ct_options['ct_enable_front_end_paid'] ) : '';
		$ct_registered_user_role = isset( $ct_options['ct_registered_user_role'] ) ? esc_attr( $ct_options['ct_registered_user_role'] ) : '';
		$ct_listing_trans_id = get_post_meta($post->ID, "_ct_listing_paid_transaction_id", true);
		$ct_listing_expiration = isset( $ct_options['ct_listing_expiration'] ) ? esc_attr( $ct_options['ct_listing_expiration'] ) : '';

		if($ct_registered_user_role == 'subscriber' || $ct_registered_user_role == 'buyer') {
			$ct_user_level = '1';
		} elseif($ct_registered_user_role == 'contributor') {
			$ct_user_level = '2';
		} elseif($ct_registered_user_role == 'author' || $ct_registered_user_role == 'seller' || $ct_registered_user_role == 'agent' || $ct_registered_user_role == 'broker') {
			$ct_user_level = '4';
		} elseif($ct_registered_user_role == 'editor') {
			$ct_user_level = '5';
		}

		if($ct_enable_front_end_paid == 'yes' && $author_level <= $ct_user_level && $ct_listing_expiration != '') {

			$ct_daystogo = $ct_listing_expiration;

			$sql =
			"UPDATE {$wpdb->posts}
			SET post_status = 'pending'
			WHERE (post_type = 'listings' AND post_status = 'publish')
			AND DATEDIFF(NOW(), post_date) > %d";

			$wpdb->query( $wpdb->prepare( $sql, $ct_daystogo ) );
		}

	}
	add_action('wp_head', 'ct_expire_listings');
}

/*-----------------------------------------------------------------------------------*/
/* Add Agent User Role */
/*-----------------------------------------------------------------------------------

$ct_add_agent_role = add_role(
	'agent',
	__('Agent', 'contempo'),
	array(
		'read'						=> true,
		'publish_posts'				=> true,
        'edit_posts'				=> true,
        'edit_published_posts'		=> true,
        'delete_posts'				=> true,
        'delete_published_posts'	=> true,
        'upload_files'				=> true,
	)
);

/*-----------------------------------------------------------------------------------*/
/* Remove Metaboxes on CPTs */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_remove_meta_boxes')) {
	if(is_admin()) {
		function ct_remove_meta_boxes() {
			//remove_meta_box( 'mymetabox_revslider_0', 'page', 'normal' );
			//remove_meta_box( 'mymetabox_revslider_0', 'post', 'normal' );
			remove_meta_box( 'mymetabox_revslider_0', 'listings', 'normal' );
			remove_meta_box( 'mymetabox_revslider_0', 'packages', 'normal' );
			remove_meta_box( 'mymetabox_revslider_0', 'package_order', 'normal' );
			remove_meta_box( 'postcustom', 'packages', 'normal' );
			remove_meta_box( 'commentstatusdiv', 'packages', 'normal' );
			remove_meta_box( 'commentstatusdiv', 'package_order', 'normal' );
			remove_meta_box( 'commentsdiv', 'packages', 'normal' );
			remove_meta_box( 'commentsdiv', 'package_order', 'normal' );

			remove_meta_box( 'icl_div_config', 'package_order', 'normal' );
		}
		add_action('do_meta_boxes', 'ct_remove_meta_boxes');
	}
}

if(function_exists('icl_object_id')) {
	function ct_remove_wpml_icl_metabox() {
		remove_meta_box('icl_div_config','packages','normal');
		remove_meta_box('icl_div_config','package_order','normal');
	}
	add_action('admin_head', 'ct_remove_wpml_icl_metabox', 99);
}

/*-----------------------------------------------------------------------------------*/
/* WPML Language Switcher */
/*-----------------------------------------------------------------------------------*/

if(class_exists('SitePress')) {
    add_filter('icl_ls_languages', 'wpml_ls_filter');
    function wpml_ls_filter($languages) {
        global $sitepress;

        // If a query variable is in the URL
        if(strpos(basename($_SERVER['REQUEST_URI']), '?') !== false){
            foreach($languages as $lang_code => $language){
                $orig_url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                $languages[$lang_code]['url'] = $sitepress->convert_url($orig_url, $language['language_code']);
            }
        }
        return $languages;
    }
}

/*-----------------------------------------------------------------------------------*/
/* Blur Agent Details for Non Logged In Users */
/*-----------------------------------------------------------------------------------*/

function ct_blur_agent_details() {
	
	global $ct_options;
	$ct_listing_agent_contact_logged_in = isset( $ct_options['ct_listing_agent_contact_logged_in'] ) ? $ct_options['ct_listing_agent_contact_logged_in'] : '';

	if($ct_listing_agent_contact_logged_in == 'yes') {
		if(!is_user_logged_in()) {
			echo 'blur';
		}
	} 
	
}

/*-----------------------------------------------------------------------------------*/
/* Get translated slugs for WPML */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_get_taxo_translated')) {
	function ct_get_taxo_translated() {
		$get_term = get_term_by( 'name', 'featured', 'ct_status' );
		$get_term_id = apply_filters( 'wpml_object_id', $get_term->term_id, 'category', true );
		$real_term = get_term_by( 'id', $get_term_id, 'ct_status' );
		return $real_term->slug;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Get Current Page */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_currentPage')) {
	function ct_currentPage() {
		global $page;
		return $page ? $page : 1;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Custom Excerpt Length */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_excerpt')) {
	function ct_excerpt() {
		global $ct_options;
		$limit = $ct_options['ct_excerpt_length'];
		$excerpt = explode(' ', get_the_excerpt(), $limit);

		if (count($excerpt)>=$limit && $limit != 0) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		} elseif($limit == 0) {
			$excerpt = '';
		} else {
			$excerpt = implode(" ",$excerpt);
		}
		$excerpt = preg_replace('`[[^]]*]`','',$excerpt);

		return $excerpt;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Sort By */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_sort_by')) {
	function ct_sort_by() { ?>

		<form action="<?php get_site_url(); ?>"  name="order "class="formsrch right col span_12 first marB0" method="get">
		    <?php 
			    $extraVars = '';
				foreach($_GET AS $key=>$value) {
					echo '<input type="hidden" name="' . (int)$key . '" value="' . (int)$value . '" />';
				}
		    ?>
		    <select class="ct_orderby" id="ct_orderby" name="ct_orderby">
			    <option value=""><?php esc_html_e('Sort By', 'contempo'); ?></option>
			    <option value="&nbsp;" <?php if(isset($_GET['ct_orderby']) && $_GET['ct_orderby'] == ''){ ?> selected="selected" <?php } ?>><?php esc_html_e('Default Order', 'contempo'); ?></option>
			    <option value="priceASC" <?php if(isset($_GET['ct_orderby']) && $_GET['ct_orderby'] == 'priceASC'){ ?> selected="selected" <?php } ?>><?php esc_html_e('Price - Low to High', 'contempo'); ?></option>
		        <option value="priceDESC" <?php if(isset($_GET['ct_orderby']) && $_GET['ct_orderby'] == 'priceDESC'){ ?> selected="selected" <?php } ?>><?php esc_html_e('Price - High to Low', 'contempo'); ?></option>
		        <option value="dateASC" <?php if(isset($_GET['ct_orderby']) && $_GET['ct_orderby'] == 'dateASC'){ ?> selected="selected" <?php } ?>><?php esc_html_e('Date - Old to New', 'contempo'); ?></option>
		        <option value="dateDESC" <?php if(isset($_GET['ct_orderby']) && $_GET['ct_orderby'] == 'dateDESC'){ ?> selected="selected" <?php } ?>><?php esc_html_e('Date - New to Old', 'contempo'); ?></option>
		    </select>
		</form>

	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Theme Directory URI */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_theme_directory_uri')) {
	function ct_theme_directory_uri() {

		$images = get_stylesheet_directory() . '/images/';

		if(is_child_theme() && file_exists($images)) {
			return get_stylesheet_directory_uri();
		} else {
			return get_template_directory_uri();
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Geocode Address */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_geocode_address')) {
	function ct_geocode_address($post_id) {

		global $ct_options;

		$ct_google_maps_api_key = isset($ct_options['ct_google_maps_api_key'] ) ? stripslashes( $ct_options['ct_google_maps_api_key']) : '';

		if($ct_options['ct_listing_lat_long'] == "on") {

			global $post;
			global $wp_query;


			if (!isset($post->post_type) ) {
				return;
			}

			
			if($post->post_type == 'listings'){

			    if(isset( $_POST['post_type'] ) && $_POST['post_type'] != 'listings')
			        return;

				$city = wp_get_post_terms($post_id, 'city');
				
				if ( isset($city[0])) {
					$city = $city[0];
					$city = $city->name;
				}

				$state = wp_get_post_terms($post_id, 'state');
					
				if ( isset($state[0])) {
					$state = $state[0];
					$state = $state->name;
				}

				$zip = wp_get_post_terms($post_id, 'zipcode');
				
				if ( isset($zip[0])) {
					$zip = $zip[0];
					$zip = $zip->name;
				}

			    $street = get_the_title($post_id);
				
			    if($street && $city) {
			        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($street . ' ' . $city . ', ' . $state . ' ' . $zip) . '&key=' . $ct_google_maps_api_key;
			        $resp = wp_remote_get($url);
			        if ( 200 == $resp['response']['code'] ) {
			            $body = $resp['body'];
			            $data = json_decode($body);
			            if($data->status=="OK"){
			                $latitude = $data->results[0]->geometry->location->lat;
			                $longitude = $data->results[0]->geometry->location->lng;
							update_post_meta($post_id, "_ct_latlng", $latitude.','.$longitude);
							update_post_meta($post_id, "lat", $latitude);
							update_post_meta($post_id, "lng", $longitude);	
							
			            }
			        }
			    }
			}

		}

		updateLatLngsForAllListings();
	}
	add_action('save_post', 'ct_geocode_address', 999);
}

/*-----------------------------------------------------------------------------------*/
/* Remove Open House Status if Date has Passed */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_update_open_house_status')) {
	function ct_update_open_house_status($post_id) {

		global $post;

		$ct_open_house_entries = get_post_meta( $post_id, '_ct_open_house', true );
		$ct_todays_date = date("mdY");
		$ct_open_house_date_formatted = '';

		foreach ( (array) $ct_open_house_entries as $key => $entry ) {

			if ( isset( $entry['_ct_open_house_date'] ) ) {
		        $ct_open_house_date = esc_html( $entry['_ct_open_house_date'] );
		        $ct_open_house_date_formatted = strftime('%m%d%Y', $ct_open_house_date);
		    }

		    if(isset( $entry['_ct_open_house_date'] ) && $ct_open_house_date_formatted < $ct_todays_date) {

			    $remove_tag = 'open-house';
			    $total_tags = get_the_terms($post_id, 'ct_status');

			    foreach($total_tags as $tag){
			        if($tag->slug != $remove_tag) {
			            $updated_tags[] = $tag->slug;
			        }
			    }
			    wp_set_post_terms( $post_id, $updated_tags, 'ct_status', false);
			    wp_set_post_terms( $post_id, 'For Sale', 'ct_status', false);
			}

		}

	}
	add_action('save_post', 'ct_update_open_house_status', 999);
}


/*-----------------------------------------------------------------------------------*/
/* Update lat longs for all previous listings */
/*-----------------------------------------------------------------------------------*/

function updateLatLngsForAllListings()
{

	if( ! is_admin() ) {
		return;
	}
	
	$args = array( 
		"posts_per_page" 	=> -1,
		"post_type" 		=> "listings",
		"post_status" 		=> "publish"
	);
	
	$listings = get_posts( $args );
	
	foreach( $listings as $listing ) {
		$lat = get_post_meta( $listing->ID, "lat", true );
		if ( $lat == "" ) {
		
			$latLng = get_post_meta( $listing->ID, "_ct_latlng", true );
			if ( $latLng != "" ) {
				$lat = trim( substr( $latLng, 0, strpos( $latLng, "," ) ) );
				$lng = trim( substr( $latLng, strpos( $latLng, "," ) + 1 ) );
				
				update_post_meta( $listing->ID, "lat", $lat );
				update_post_meta( $listing->ID, "lng", $lng );
				
			}
		}
	}
	
}

/*-----------------------------------------------------------------------------------*/
/* Notify user of new listing sending then an email (modded - ignore) */
/*-----------------------------------------------------------------------------------

if(!function_exists('ct_admin_notify_new_listing')) {
	function ct_admin_notify_new_listing($post_ID) {

		$get_user = wp_get_current_user();

		// Only send notifications to Subscriber, Renter, Tenant or Buyer user roles
		//if(in_array('subscriber', (array) $get_user->roles) || in_array('renter', (array) $get_user->roles) || in_array('tenant', (array) $get_user->roles) || in_array('buyer', (array) $get_user->roles)) {
		    $url = get_permalink($post_ID);

		    $search_cities = wp_get_post_terms($post_ID, 'city', array("fields" => "names"));
		    $search_city = $search_cities[0];
			
			$search_states = wp_get_post_terms($post_ID, 'state', array("fields" => "names"));
			$search_state = $search_states[0];

			$admin_email = get_option('admin_email');
			$blogname = get_option('blogname');
			
			$lh_users = get_users(
				array(
					"meta_key" => "city",
					"meta_value" => $search_city,
					"fields" => "ID",
				)
			);

			foreach($lh_users as $user_id){		
				$state_user = get_user_meta($user_id, "state", true); 
				$message = "";
				
				if($state_user == $search_state){
					$user = get_user_by('id',$user_id);
					$to = $user->user_email;
				 	$header .= "MIME-Version: 1.0\n";
					$header .= "Content-Type: text/html; charset=utf-8\n";
					$header .= 'From: ' . $blogname . ' < ' . $admin_email . ' >';
					$header .= 'Reply-To: ' . $admin_email;
					
					$subject = __('New submission in', 'contempo') . ' ' . $search_city . ', ' . $search_state;
					
					$message .= __('Hi!', 'contempo') . ' ' . $user->display_name . "\r\n";
					$message .= __('We have a new submission in', 'contempo') . ' ' . $search_city . ', ' . $search_state . "\r\n";
					$message .= __('Check it out', 'contempo') . ' ' . $url; 
								
					$mail = wp_mail( $to, $subject, $message, $headers );
				}
			}
		//}

	}
}
add_action('publish_listings', 'ct_admin_notify_new_listing');

/*-----------------------------------------------------------------------------------*/
/* Notify user of new listing sending then an email */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_admin_notify_new_listing')) {
	function ct_admin_notify_new_listing($post_ID, $scity='', $sstate='') {
		global $ct_options;
		$ct_enable_front_end_email_notification = isset( $ct_options['ct_enable_front_end_email_notification'] ) ? esc_html( $ct_options['ct_enable_front_end_email_notification'] ) : '';
		if($ct_enable_front_end_email_notification != 'no') {
		    $url = get_permalink($post_ID);
		    $search_city = $scity;
			$search_state = $sstate;
			$admin_email = get_option('admin_email');
			$blogname = get_option('blogname'); 
					
			$search_cities = wp_get_post_terms($post_ID, 'city', array("fields" => "names"));
			$search_city = $search_cities[0];
			$scity = $search_city;
				
			$search_states = wp_get_post_terms($post_ID, 'state', array("fields" => "names"));
			$search_state = $search_states[0];
			$sstate = $search_state;
			
			$lh_users = get_users(
				array( 
					"meta_key" => "city",
					"meta_value" => $search_city,
					"fields" => "ID",
				)
			);

			foreach($lh_users as $user_id){		
				$state_user = get_user_meta($user_id, "state", true); 
				$message = "";
				
				if($state_user == $sstate){
					$user = get_user_by('id',$user_id);
					$user_meta = get_userdata($user_id);
					$user_roles=$user_meta->roles;

					if(in_array("subscriber", $user_roles) || in_array("renter", $user_roles) || in_array("tenant", $user_roles) || in_array("buyer", $user_roles)) {
						$to = $user->user_email;
					 	$header .= "MIME-Version: 1.0\n";
						$header .= "Content-Type: text/html; charset=utf-8\n";
						$header .= 'From: ' . $blogname . ' < ' . $admin_email . ' >';
						$header .= 'Reply-To: ' . $admin_email;
						
						$subject = __('New submission in', 'contempo') . ' ' . $search_city . ', ' . $search_state;
						
						$message .= __('Hi!', 'contempo') . ' ' . $user->display_name . "\r\n";
						$message .= __('We have a new submission in', 'contempo') . ' ' . $search_city . ', ' . $search_state . "\r\n";
						$message .= __('Check it out', 'contempo') . ' ' . $url; 
									
						$mail = wp_mail( $to, $subject, $message, $headers );
					}
				}
			}
		}
	}
}
add_action('publish_listings', 'ct_admin_notify_new_listing');

/*-----------------------------------------------------------------------------------*/
/* Display Login/Register after X amount of Views */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_display_login_register_after_x_views')) {
	function ct_display_login_register_after_x_views() {
		global $ct_options;
		$ct_listings_login_register_after_x_views = isset( $ct_options['ct_listings_login_register_after_x_views'] ) ? esc_html( $ct_options['ct_listings_login_register_after_x_views'] ) : '';
		$ct_listings_login_register_after_x_views_num = isset( $ct_options['ct_listings_login_register_after_x_views_num'] ) ? esc_html( $ct_options['ct_listings_login_register_after_x_views_num'] ) : '';

		if($ct_listings_login_register_after_x_views) { ?>
			<script>
			jQuery(document).ready(function() {

			  var VisitedSet = Cookies.get('visited');

				if(!VisitedSet) {
					Cookies.set('visited', '0');
					VisitedSet = 0;
				}
			  
				VisitedSet++;

				if(VisitedSet == <?php echo esc_html($ct_listings_login_register_after_x_views_num); ?>) {
					jQuery(window).load(function() {
						jQuery('#overlay').addClass('open');
						jQuery('html, body').animate({scrollTop : 0},800);
						return false;
					});
				} else {
					Cookies.set('visited', VisitedSet, {
					expires: 1
				});

					//console.log('Page Views: ' + VisitedSet);

					return false;
				}
			});

			(function($){
			  $("#resetCounter").click(function(){
			    Cookies.set('visited', '0');
			    location.reload();
			  });
			})( jQuery );
			</script>
		<?php }
	}
}

/*-----------------------------------------------------------------------------------*/
/* Contact Us Map */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_contact_us_map')) {
	function ct_contact_us_map() {
		global $ct_options;
		$google_maps_api_key = isset( $ct_options['ct_google_maps_api_key'] ) ? stripslashes( $ct_options['ct_google_maps_api_key'] ) : '';
		if($ct_options['ct_contact_map'] =="yes") { ?>
			<script>
	        function setMapAddress(address) {
	            var geocoder = new google.maps.Geocoder();
	            var mapPin = {
					url: '<?php echo get_template_directory_uri(); ?>/images/map-pin-com.png',
					size: new google.maps.Size(40, 46),
				    scaledSize: new google.maps.Size(40, 46)
				};
	            geocoder.geocode( { address : address }, function( results, status ) {
	                if( status == google.maps.GeocoderStatus.OK ) {
	                    var location = results[0].geometry.location;
	                    var options = {
	                        zoom: 15,
	                        center: location,
	                        mapTypeId: google.maps.MapTypeId.<?php echo esc_html(strtoupper($ct_options['ct_contact_map_type'])); ?>, 
	                        streetViewControl: true,
							scrollwheel: false,
							draggable: false,
							<?php 
							$ct_gmap_style = isset( $ct_options['ct_google_maps_style'] ) ? $ct_options['ct_google_maps_style']: '';    
							$ct_gmap_snazzy_style = isset( $ct_options['ct_google_maps_snazzy_style'] ) ? $ct_options['ct_google_maps_snazzy_style']: '';
							if($ct_gmap_snazzy_style != '') { ?>
								styles: <?php echo $ct_gmap_snazzy_style; ?>,
							<?php } ?>
	                    };
	                    var mymap = new google.maps.Map( document.getElementById( 'map' ), options );   
	                    var marker = new google.maps.Marker({
	                    	map: mymap, 
	                    	animation: google.maps.Animation.DROP,
							flat: true,
							icon: mapPin,   
							position: results[0].geometry.location
	                	});		
	            	}
	        	});
	        }
	        setMapAddress( "<?php echo esc_html($ct_options['ct_contact_map_location']); ?>" );
	        </script>

	       <?php if(empty($google_maps_api_key)) { ?>

				<div id="map-wrap" class="no-google-api-key">
					<h5><?php _e('You need to setup the Google Maps API.', 'contempo'); ?></h5>
			        <p class="marB0"><?php _e('Go into Admin > Real Estate 7 Options > Google Maps', 'contempo'); ?></p>
		        </div>

			<?php } else { ?>

			    <div id="location" class="marB18">
			       <div id="map" style="height: 300px;"></div>
			    </div>
		    
		    <?php } ?>

	    <?php }
	}
}

/*-----------------------------------------------------------------------------------*/
/* Brokerage Single Map */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_brokerage_single_map')) {
	function ct_brokerage_single_map($brokerage_address) {
		global $ct_options;
		$google_maps_api_key = isset( $ct_options['ct_google_maps_api_key'] ) ? stripslashes( $ct_options['ct_google_maps_api_key'] ) : '';
		?>
		<script>
        function setMapAddress(address) {
            var geocoder = new google.maps.Geocoder();
            var mapPin = {
					url: '<?php echo get_template_directory_uri(); ?>/images/map-pin-com.png',
					size: new google.maps.Size(40, 46),
				    scaledSize: new google.maps.Size(40, 46)
				};
            geocoder.geocode( { address : address }, function( results, status ) {
                if( status == google.maps.GeocoderStatus.OK ) {
                    var location = results[0].geometry.location;
                    var options = {
                        zoom: 15,
                        center: location,
                        mapTypeId: google.maps.MapTypeId.<?php echo esc_html(strtoupper($ct_options['ct_contact_map_type'])); ?>, 
                        streetViewControl: true,
						scrollwheel: false,
						draggable: false,
						<?php 
						$ct_gmap_style = isset( $ct_options['ct_google_maps_style'] ) ? $ct_options['ct_google_maps_style']: '';    
						$ct_gmap_snazzy_style = isset( $ct_options['ct_google_maps_snazzy_style'] ) ? $ct_options['ct_google_maps_snazzy_style']: '';
						if($ct_gmap_snazzy_style != '') { ?>
							styles: <?php echo $ct_gmap_snazzy_style; ?>,
						<?php } ?>
                    };
                    
                	jQuery('ul.tabs li.brokerage-map').click(function(e) {
						setTimeout(function() {
							var mymap = new google.maps.Map( document.getElementById( 'map' ), options );   
                    
		                    var marker = new google.maps.Marker({
		                    	map: mymap, 
		                    	animation: google.maps.Animation.DROP,
								flat: true,
								icon: mapPin,   
								position: results[0].geometry.location
		                	});		
				            google.maps.event.trigger(mymap, "resize");
				            marker.setMap(mymap);
				        }, 1000);
					});
            	}
        	});
        }
        setMapAddress( "<?php echo esc_html($brokerage_address); ?>" );
        </script>

        <?php if(empty($google_maps_api_key)) { ?>

			<div id="map-wrap" class="no-google-api-key">
				<h5><?php _e('You need to setup the Google Maps API.', 'contempo'); ?></h5>
		        <p class="marB0"><?php _e('Go into Admin > Real Estate 7 Options > Google Maps', 'contempo'); ?></p>
	        </div>

		<?php } else { ?>

		    <div id="location" class="marB18">
		       <div id="map" style="height: 500px;"></div>
		    </div>
	    
	    <?php } ?>

	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Multi Location Contact Us Map */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_multi_contact_us_map')) {
	function ct_multi_contact_us_map() { 
	    global $ct_options;
	    $count = 0;

	    $google_maps_api_key = isset( $ct_options['ct_google_maps_api_key'] ) ? stripslashes( $ct_options['ct_google_maps_api_key'] ) : '';
	    $ct_gmap_style = isset( $ct_options['ct_google_maps_style'] ) ? $ct_options['ct_google_maps_style']: '';
	    $ct_gmap_snazzy_style = isset( $ct_options['ct_google_maps_snazzy_style'] ) ? $ct_options['ct_google_maps_snazzy_style']: '';
	    $ct_gmap_type = isset( $ct_options['ct_contact_map_type'] ) ? $ct_options['ct_contact_map_type']: '';

	    $location_one = isset( $ct_options['ct_contact_map_location_one'] ) ? esc_html( $ct_options['ct_contact_map_location_one'] ) : '';
	    $location_one_img = isset( $ct_options['ct_contact_map_location_image']['url'] ) ? esc_html( $ct_options['ct_contact_map_location_image']['url'] ) : '';

	    $location_two = isset( $ct_options['ct_contact_map_location_two'] ) ? esc_html( $ct_options['ct_contact_map_location_two'] ) : '';
	    $location_two_img = isset( $ct_options['ct_contact_map_location_two_image']['url'] ) ? esc_html( $ct_options['ct_contact_map_location_two_image']['url'] ) : '';

	    $location_three = isset( $ct_options['ct_contact_map_location_three'] ) ? esc_html( $ct_options['ct_contact_map_location_three'] ) : '';
	    $location_three_img = isset( $ct_options['ct_contact_map_location_three_image']['url'] ) ? esc_html( $ct_options['ct_contact_map_location_three_image']['url'] ) : '';

	    $location_four = isset( $ct_options['ct_contact_map_location_four'] ) ? esc_html( $ct_options['ct_contact_map_location_four'] ) : '';
	    $location_four_img = isset( $ct_options['ct_contact_map_location_four_image']['url'] ) ? esc_html( $ct_options['ct_contact_map_location_four_image']['url'] ) : '';

	    $map_locations = array(
	    	0 => array( 
	    		'address' => $location_one,
	    		'image' => $location_one_img
	    	),
	    	1 => array( 
	    		'address' => $location_two,
	    		'image' => $location_two_img
	    	),
	    	2 => array( 
	    		'address' => $location_three,
	    		'image' => $location_three_img
	    	),
	    	3 => array( 
	    		'address' => $location_four,
	    		'image' => $location_four_img
	    	),
	    );
	    ?>
	    
	    <script>
	    var property_list = [];
		var default_mapcenter = [];
		var ctMapGlobal = {
			<?php if($ct_gmap_snazzy_style != '') { ?>mapCustomStyles: '<?php echo $ct_gmap_snazzy_style; ?>',<?php } ?>
			mapStyle: '<?php echo esc_html($ct_gmap_style); ?>',
			mapType: '<?php echo esc_html($ct_gmap_type); ?>'
		}
	    
	    <?php if($map_locations) {

			for($i = 0; $i < count($map_locations); $i++) {
		
			$count++; ?>
	    
	        var property = {
	        	thumb: "<?php echo esc_url($map_locations[$i]['image']); ?>",
	            street: "<?php echo esc_html($map_locations[$i]['address']); ?>",
				commercial: "commercial",
				contactpage: "contactpage",
				siteURL: "<?php echo ct_theme_directory_uri(); ?>"
	        }
	        property_list.push(property);
	    
		<?php
				}    
		    }
		?>
	    </script>
		<script>
		var defaultmapcenter = {mapcenter: ""}; 
		google.maps.event.addDomListener(window, 'load', function() { 
			
			estateMapping.init_property_map(property_list, defaultmapcenter, "<?php echo ct_theme_directory_uri(); ?>"); 
		});
		</script>

		<?php if(empty($google_maps_api_key)) { ?>

			<div id="map-wrap" class="no-google-api-key">
				<h5><?php _e('You need to setup the Google Maps API.', 'contempo'); ?></h5>
		        <p class="marB0"><?php _e('Go into Admin > Real Estate 7 Options > Google Maps', 'contempo'); ?></p>
	        </div>

		<?php } else { ?>

		    <div id="location" class="marB18">
		        <div id="map" style="height: 460px;"></div>
		    </div>
	    
	    <?php } ?>
	    
	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Single Listing Map */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_listing_map')) {
	function ct_listing_map() {
			global $ct_options;
			$google_maps_api_key = isset( $ct_options['ct_google_maps_api_key'] ) ? stripslashes( $ct_options['ct_google_maps_api_key'] ) : '';
			$ct_single_listing_content_layout_type = isset( $ct_options['ct_single_listing_content_layout_type'] ) ? $ct_options['ct_single_listing_content_layout_type'] : '';
			?>
			<script>
	        function setMapAddress(address) {
	            var geocoder = new google.maps.Geocoder();
	            <?php if(ct_has_type('commercial')) { ?>
					var mapPin = {
						url: '<?php echo ct_theme_directory_uri(); ?>/images/map-pin-com.png',
						size: new google.maps.Size(40, 46),
					    scaledSize: new google.maps.Size(40, 46)
					};
				<?php } elseif(ct_has_type('land')) { ?>
					var mapPin = {
						url: '<?php echo ct_theme_directory_uri(); ?>/images/map-pin-land.png',
						size: new google.maps.Size(40, 46),
					    scaledSize: new google.maps.Size(40, 46)
					};
				<?php } elseif(ct_has_type('lot')) { ?>
					var mapPin = {
						url: '<?php echo ct_theme_directory_uri(); ?>/images/map-pin-land.png',
						size: new google.maps.Size(40, 46),
					    scaledSize: new google.maps.Size(40, 46)
					};
				<?php } else { ?>	
					var mapPin = {
						url: '<?php echo ct_theme_directory_uri(); ?>/images/map-pin-res.png',
						size: new google.maps.Size(40, 46),
					    scaledSize: new google.maps.Size(40, 46)
					};
				<?php } ?>
	            geocoder.geocode( { address : address }, function( results, status ) {
	                if( status == google.maps.GeocoderStatus.OK ) {
						<?php  if((get_post_meta(get_the_ID(), "_ct_latlng", true))) { ?>
	                    var location = new google.maps.LatLng(<?php echo get_post_meta(get_the_ID(), "_ct_latlng", true); ?>);
						<?php } else { ?>
						var location = results[0].geometry.location;
						<?php } ?>
	                    var options = {
	                        zoom: 15,
	                        center: location,
							scrollwheel: false,
	                        mapTypeId: google.maps.MapTypeId.<?php echo esc_html(strtoupper($ct_options['ct_contact_map_type'])); ?>, 
	                        streetViewControl: true,
	                        <?php 
							$ct_gmap_style = isset( $ct_options['ct_google_maps_style'] ) ? $ct_options['ct_google_maps_style']: '';    
							$ct_gmap_snazzy_style = isset( $ct_options['ct_google_maps_snazzy_style'] ) ? $ct_options['ct_google_maps_snazzy_style']: '';
							if($ct_gmap_snazzy_style != '') { ?>
								styles: <?php echo $ct_gmap_snazzy_style; ?>,
							<?php } ?>
	                    };
	                    var mymap = new google.maps.Map( document.getElementById( 'map' ), options );   
	                    var marker = new google.maps.Marker({
	                    	map: mymap, 
	                    	animation: google.maps.Animation.DROP,
	                   		draggable: false,
							flat: true,
							icon: mapPin,
							<?php  if((get_post_meta(get_the_ID(), "_ct_latlng", true))) { ?>  
							position: new google.maps.LatLng(<?php echo get_post_meta(get_the_ID(), "_ct_latlng", true); ?>)
							<?php } else { ?>
							position: results[0].geometry.location
							<?php } ?>
	                	});		
	            	}
	        	});
	        }

	        <?php if($ct_single_listing_content_layout_type == 'tabbed') { ?>
	        // Trigger map function on opening location tab
	        jQuery('a[href=#listing-location]').on('click', function() {
		        setTimeout(function(){
		        	var listingMap = document.getElementById("map");
		        	setMapAddress();
		            google.maps.event.trigger(listingMap, 'resize');
		            map.panTo(google.maps.Marker);
		        }, 50);
		    });
		    <?php } ?>

	        <?php if((get_post_meta(get_the_ID(), "_ct_latlng", true))) { ?>  
		        setMapAddress( "<?php echo esc_html(get_post_meta(get_the_ID(), "_ct_latlng", true)); ?>" );
			<?php } elseif(is_page_template('template-edit-listing.php')) { ?>
				setMapAddress( "<?php esc_html($title); ?> <?php esc_html($city); ?> <?php esc_html($state); ?> <?php esc_html($zipcode); ?>" );
			<?php } else { ?>
				setMapAddress( "<?php the_title(); ?> <?php ct_taxonomy('city'); ?> <?php ct_taxonomy('state'); ?> <?php ct_taxonomy('zipcode'); ?>" );
			<?php } ?>
	        
	        </script>

			<?php if(empty($google_maps_api_key)) { ?>

				<div id="map-wrap" class="no-google-api-key">
					<h5><?php _e('You need to setup the Google Maps API.', 'contempo'); ?></h5>
			        <p class="marB0"><?php _e('Go into Admin > Real Estate 7 Options > Google Maps', 'contempo'); ?></p>
		        </div>

			<?php } else { ?>

			    <div id="map"></div>
		    
		    <?php } ?>

	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Multi Marker Map */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_multi_marker_map')) {
	function ct_multi_marker_map() { 
	    global $ct_options;
	    global $post;
	    $count = 0;

	    $google_maps_api_key = isset( $ct_options['ct_google_maps_api_key'] ) ? stripslashes( $ct_options['ct_google_maps_api_key'] ) : '';
	    $ct_gmap_style = isset( $ct_options['ct_google_maps_style'] ) ? $ct_options['ct_google_maps_style']: '';
	    $ct_gmap_snazzy_style = isset( $ct_options['ct_google_maps_snazzy_style'] ) ? $ct_options['ct_google_maps_snazzy_style']: '';
	    $ct_gmap_type = isset( $ct_options['ct_contact_map_type'] ) ? $ct_options['ct_contact_map_type']: '';
	    $ct_exclude_sold_listing_search = isset( $ct_options['ct_exclude_sold_listing_search'] ) ? $ct_options['ct_exclude_sold_listing_search']: '';

	    if($ct_exclude_sold_listing_search == 'yes') {
		    query_posts(array(
				'post_type' => 'listings',
		        'posts_per_page' => 1000,
		        'tax_query' => array(
					array(
					    'taxonomy'  => 'ct_status',
					    'field'     => 'slug',
					    'terms'     => 'sold',
					    'operator'  => 'NOT IN'
				    ),
			    ),
		        'tax_query' => array(
					array(
					    'taxonomy'  => 'ct_status',
					    'field'     => 'slug',
					    'terms'     => 'ghost',
					    'operator'  => 'NOT IN'
				    ),
			    ),
		        'order' => 'DSC'
		    ));
		} else {
			query_posts(array(
				'post_type' => 'listings',
		        'posts_per_page' => 1000,
		        'tax_query' => array(
					array(
					    'taxonomy'  => 'ct_status',
					    'field'     => 'slug',
					    'terms'     => 'ghost',
					    'operator'  => 'NOT IN'
				    ),
			    ),
		        'order' => 'DSC'
		    ));
		}

	    ?>
	    
	    <script>
	    var property_list = [];
		var default_mapcenter = [];
		var ctMapGlobal = {
			<?php if($ct_gmap_snazzy_style != '') { ?>mapCustomStyles: '<?php echo $ct_gmap_snazzy_style; ?>',<?php } ?>
			mapStyle: '<?php echo esc_html($ct_gmap_style); ?>',
			mapType: '<?php echo esc_html($ct_gmap_type); ?>'
		}
	    
	    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		
			$count++; ?>
	    
	        var property = {
	            thumb: '<?php ct_first_image_map_tn(); ?>',
	            title: '<?php ct_listing_title(); ?>',
	            fullPrice: "<?php ct_listing_price(); ?>",
	            bed: "<?php ct_taxonomy('beds'); ?>",
	            bath: "<?php ct_taxonomy('baths'); ?>",
	            size: "<?php echo get_post_meta($post->ID, "_ct_sqft", true); ?> <?php ct_sqftsqm(); ?>",
	            street: "<?php the_title(); ?>",
	            city: "<?php ct_taxonomy('city'); ?>",
	            state: "<?php ct_taxonomy('state'); ?>",
	            zip: "<?php ct_taxonomy('zipcode'); ?>",
				latlong: "<?php echo get_post_meta(get_the_ID(), "_ct_latlng", true); ?>",
	            permalink: "<?php the_permalink(); ?>",
	            //agentThumb: "<?php the_author_meta('ct_profile_url'); ?>",
	            //agentName: "<?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?>",
	            //agentTagline: "<?php if(get_the_author_meta('tagline')) { the_author_meta('tagline'); } ?>",
	            //agentPhone: "<?php if(get_the_author_meta('office')) { the_author_meta('office'); } ?>",
	            //agentEmail: "<?php if(get_the_author_meta('email')) { the_author_meta('email'); } ?>",
				isHome: "<?php if(is_home()) { echo "false"; } else { echo "true"; } ?>",
				commercial: "<?php if(ct_has_type('commercial')) { echo 'commercial'; } ?>",
				land: "<?php if(ct_has_type('land')) { echo 'land'; } ?>",
				siteURL: "<?php echo ct_theme_directory_uri(); ?>",
				listingID: "<?php echo get_the_ID(); ?>",
	        }
	        property_list.push(property);
	    
	<?php     
	    endwhile; endif;
		wp_reset_query();
	?>
	    </script>
	    <script>var defaultmapcenter = {mapcenter: ""}; google.maps.event.addDomListener(window, 'load', function(){ estateMapping.init_property_map(property_list, defaultmapcenter, "<?php echo ct_theme_directory_uri(); ?>"); });</script>
	    <div id="map-wrap" <?php if(empty($google_maps_api_key)) { echo 'class="no-google-api-key"'; } ?>>

			<?php if(empty($google_maps_api_key)) { ?>

				<h5><?php _e('You need to setup the Google Maps API.', 'contempo'); ?></h5>
		        <p class="marB0"><?php _e('Go into Admin > Real Estate 7 Options > Google Maps', 'contempo'); ?></p>

			<?php } else { ?>

		    	<?php ct_search_results_map_navigation(); ?>
			    <div id="map"></div>
		    
		    <?php } ?>
		    
	    </div>
	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Featured Listings Map */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_featured_listings_map')) {
	function ct_featured_listings_map() { 
	    global $ct_options;
	    global $post;
	    $count = 0;

	    $google_maps_api_key = isset( $ct_options['ct_google_maps_api_key'] ) ? stripslashes( $ct_options['ct_google_maps_api_key'] ) : '';
	    $ct_gmap_style = isset( $ct_options['ct_google_maps_style'] ) ? $ct_options['ct_google_maps_style']: '';
	    $ct_gmap_snazzy_style = isset( $ct_options['ct_google_maps_snazzy_style'] ) ? $ct_options['ct_google_maps_snazzy_style']: '';
	    $ct_gmap_type = isset( $ct_options['ct_contact_map_type'] ) ? $ct_options['ct_contact_map_type']: '';

	    query_posts(array(
			'post_type' 		=> 'listings',
			'status' 			=> 'featured',
	        'posts_per_page' 	=> 1000,
	        'order' 			=> 'DESC'
	    )); ?>
	    
	    <script>
	    var property_list = [];
		var default_mapcenter = [];
		var ctMapGlobal = {
			<?php if($ct_gmap_snazzy_style != '') { ?>mapCustomStyles: '<?php echo $ct_gmap_snazzy_style; ?>',<?php } ?>
			mapStyle: '<?php echo esc_html($ct_gmap_style); ?>',
			mapType: '<?php echo esc_html($ct_gmap_type); ?>'
		}
	    
	    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		
			$count++; ?>
	    
	        var property = {
	            thumb: '<?php ct_first_image_map_tn(); ?>',
	            title: '<?php ct_listing_title(); ?>',
				fullPrice: "<?php ct_listing_price(); ?>",
	            bed: "<?php ct_taxonomy('beds'); ?>",
	            bath: "<?php ct_taxonomy('baths'); ?>",
	            size: "<?php echo get_post_meta($post->ID, "_ct_sqft", true); ?> <?php ct_sqftsqm(); ?>",
	            street: "<?php the_title(); ?>",
	            city: "<?php ct_taxonomy('city'); ?>",
	            state: "<?php ct_taxonomy('state'); ?>",
	            zip: "<?php ct_taxonomy('zipcode'); ?>",
				latlong: "<?php echo get_post_meta(get_the_ID(), "_ct_latlng", true); ?>",
	            permalink: "<?php the_permalink(); ?>",
	            //agentThumb: "<?php the_author_meta('ct_profile_url'); ?>",
	            //agentName: "<?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?>",
	            //agentTagline: "<?php if(get_the_author_meta('tagline')) { the_author_meta('tagline'); } ?>",
	            //agentPhone: "<?php if(get_the_author_meta('office')) { the_author_meta('office'); } ?>",
	            //agentEmail: "<?php if(get_the_author_meta('email')) { the_author_meta('email'); } ?>",
				isHome: "<?php if(is_home()) { echo "false"; } else { echo "true"; } ?>",
				commercial: "<?php if(ct_has_type('commercial')) { echo 'commercial'; } ?>",
				land: "<?php if(ct_has_type('land')) { echo 'land'; } ?>",
				siteURL: "<?php echo ct_theme_directory_uri(); ?>",
				listingID: "<?php echo get_the_ID(); ?>",
	        }
	        property_list.push(property);
	    
	<?php     
	    endwhile; endif;
		wp_reset_query();
	?>
	    </script>
	    
	    <?php if(!empty($google_maps_api_key)) { ?>
		    <script>var defaultmapcenter = {mapcenter: ""}; google.maps.event.addDomListener(window, 'load', function(){ estateMapping.init_property_map(property_list, defaultmapcenter, "<?php echo ct_theme_directory_uri(); ?>"); });</script>
		<?php } ?>

	    <div id="map-wrap" <?php if(empty($google_maps_api_key)) { echo 'class="no-google-api-key"'; } ?>>

			<?php if(empty($google_maps_api_key)) { ?>

				<h5><?php _e('You need to setup the Google Maps API.', 'contempo'); ?></h5>
		        <p class="marB0"><?php _e('Go into Admin > Real Estate 7 Options > Google Maps', 'contempo'); ?></p>

			<?php } else { ?>

		    	<?php ct_search_results_map_navigation(); ?>
			    <div id="map"></div>
		    
		    <?php } ?>

	    </div>
	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Search Results Map */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_search_results_map')) {
	function ct_search_results_map($pageLoaded=false) { 
		
	   global $wp_query;
	    global $ct_options;
	    global $post;
	    $count = 0;

	    $google_maps_api_key = isset( $ct_options['ct_google_maps_api_key'] ) ? stripslashes( $ct_options['ct_google_maps_api_key'] ) : '';
	    $ct_gmap_style = isset( $ct_options['ct_google_maps_style'] ) ? $ct_options['ct_google_maps_style']: '';
	    $ct_gmap_snazzy_style = isset( $ct_options['ct_google_maps_snazzy_style'] ) ? $ct_options['ct_google_maps_snazzy_style']: '';
		$ct_gmap_type = isset( $ct_options['ct_contact_map_type'] ) ? $ct_options['ct_contact_map_type']: '';
		
		
		if ( $pageLoaded === false ) {		
	    	echo "<script>";
		}

		?>

	    var property_list = [];
		var default_mapcenter = [];
		var ctMapGlobal = {
			<?php if($ct_gmap_snazzy_style != '') { ?>mapCustomStyles: '<?php echo $ct_gmap_snazzy_style; ?>',<?php } ?>
			mapStyle: '<?php echo esc_html($ct_gmap_style); ?>',
			mapType: '<?php echo esc_html($ct_gmap_type); ?>'
		}
	    
	    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		
			$count++; ?>
	    
	        var property = {
	            thumb: '<?php ct_first_image_map_tn(); ?>',
	            title: '<?php ct_listing_title(); ?>',
	            fullPrice: "<?php ct_listing_price(); ?>",
	            bed: "<?php ct_taxonomy('beds'); ?>",
	            bath: "<?php ct_taxonomy('baths'); ?>",
	            size: "<?php echo get_post_meta($post->ID, "_ct_sqft", true); ?> <?php ct_sqftsqm(); ?>",
	            street: "<?php the_title(); ?>",
	            city: "<?php ct_taxonomy('city'); ?>",
	            state: "<?php ct_taxonomy('state'); ?>",
	            zip: "<?php ct_taxonomy('zipcode'); ?>",
				latlong: "<?php echo get_post_meta(get_the_ID(), "_ct_latlng", true); ?>",
	            permalink: "<?php the_permalink(); ?>",
	            //agentThumb: "<?php the_author_meta('ct_profile_url'); ?>",
	            //agentName: "<?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?>",
	            //agentTagline: "<?php if(get_the_author_meta('tagline')) { the_author_meta('tagline'); } ?>",
	            //agentPhone: "<?php if(get_the_author_meta('office')) { the_author_meta('office'); } ?>",
	            //agentEmail: "<?php if(get_the_author_meta('email')) { the_author_meta('email'); } ?>",
				isHome: "<?php if(is_home()) { echo "false"; } else { echo "true"; } ?>",
				commercial: "<?php if(ct_has_type('commercial')) { echo 'commercial'; } ?>",
				land: "<?php if(ct_has_type('land')) { echo 'land'; } ?>",
				siteURL: "<?php echo ct_theme_directory_uri(); ?>",
				listingID: "<?php echo $post->ID; ?>",
	        }
	        property_list.push(property);
	    
		<?php     
		endwhile; endif;
		if ( $pageLoaded == false ) {
			wp_reset_query();
		}
		
		if ( $pageLoaded === false ) {
			echo "</script>";
			echo "<script>";
		}
		?>

		var defaultmapcenter = {mapcenter: ""}; 
		
		<?php
		if ( $pageLoaded == false ) {
			?>
			google.maps.event.addDomListener(window, 'load', function() { 
				estateMapping.init_property_map(property_list, defaultmapcenter, "<?php echo ct_theme_directory_uri(); ?>"); 
			});
			<?php
		} else {
			?>
			alert(200);
			estateMapping.init_property_map(property_list, null, "<?php echo ct_theme_directory_uri(); ?>"); 
			<?php
		}
		
		if ( $pageLoaded === false ) {

			echo "</script>";
			
			if(empty($google_maps_api_key)) {
				echo '<div id="map-wrap" class="no-google-api-key">';
					echo '<h5>' . __('You need to setup the Google Maps API.', 'contempo') . '</h5>';
			        echo '<p class="marB0">' . __('Go into Admin > Real Estate 7 Options > Google Maps', 'contempo') . '</p>';
			    echo '</div>';
			} else {

				    echo '<div id="map"></div>';
			    
			}

		}
	    
	}
}

/*-----------------------------------------------------------------------------------*/
/* Search Results Map Navigation */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_search_results_map_navigation')) {
	function ct_search_results_map_navigation() { 
		echo '<div id="ct-map-navigation">';
		echo '<button id="search-by-user-location-2" class="map-btn" style="display:none"><i class="fa fa-crosshairs"></i> </button>';
		echo '<button id="ct-gmap-draw" class="map-btn"><span>' . __('Draw', 'contempo') . '</span> <i class="fa fa-pencil"></i></button>';
		echo '<button id="ct-gmap-prev" class="map-btn"><i class="fa fa-chevron-left"></i> <span>' . __('Prev', 'contempo') . '</span></button>';
		echo '<button id="ct-gmap-next" class="map-btn"><span>' . __('Next', 'contempo') . '</span> <i class="fa fa-chevron-right"></i></button>';
		echo '</div>';
	}
}

/*-----------------------------------------------------------------------------------*/
/* Homepage Slider */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_slider')) {
	function ct_slider() {
		global $ct_options;
		global $post;
		$slides = $ct_options['ct_flex_slider'];
		if($slides > 1) { ?>
	        <div id="slider" class="flexslider">
	            <ul class="slides">
	    
	                <?php 
	                    foreach ($slides as $slide => $value) {
	                        $imgURL = $value['url'];
	                        $imgID = ct_get_attachment_id_from_src($imgURL);
	                ?>
		                <li>
		    				<div class="flex-container">	    
			                    <?php if(!empty ($value['title']) || !empty ($value['description'])) { ?>
			                        <div class="flex-caption">
				                        <div class="flex-inner">
					                        <?php if(!empty ($value['title'])) { ?>
					                        	<h3><?php echo esc_html($value['title']); ?></h3>
				                                <?php if(!empty ($value['description'])) { ?>
					                                <p><?php echo esc_html($value['description']); ?></p>
				                                <?php } ?>	   
					                        <?php } ?>
				                        </div>
				                        <div class="clear"></div>
			                        </div>
			                    <?php } ?>
		                    </div>
		                    <?php if(!empty ($value['url'])) { ?>
		                    	<a href="<?php echo esc_url($value['url']); ?>">
									<img src="<?php echo esc_url($value['image']); ?>" />                                              
								</a>
	                        <?php } else { ?>
			                    <img src="<?php echo esc_url($value['image']); ?>" />
		                    <?php } ?>
		                </li>
	                <?php } ?>
	            </ul>
	        </div>
	            <div class="clear"></div>

		<?php }
	}
}

/*-----------------------------------------------------------------------------------*/
/* Front End Featured Image Uploads */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_insert_attachment')) {
	function ct_insert_attachment($file_handler,$post_id,$setthumb='false') {
		// check to make sure its a successful upload
		if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/media.php');

		$attach_id = media_handle_upload( $file_handler, $post_id );

		if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);
		return $attach_id;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Front End Delete Attachment */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_delete_attachment')) {
	function ct_delete_attachment( $post ) {
	    if( wp_delete_attachment( $_POST['att_ID'], true )) {
	        echo 'Attachment ID [' . $_POST['att_ID'] . '] has been deleted!';
	    }
	    die();
	}
}
add_action( 'wp_ajax_delete_attachment', 'ct_delete_attachment' );

/*-----------------------------------------------------------------------------------*/
/* User Listing Post Count */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_listing_post_count')) {
	function ct_listing_post_count( $userid, $post_type ) {
		if( empty( $userid ) )
		   return false;
		 
		$args = array(
		    'post_type'		=> $post_type,
		    'author'		=> $userid,
		    'meta_query' => array(
			    array(
			        'key' => 'source',
			        'value' => 'idx-api',
			    	'compare' => 'NOT EXISTS'
			    )
			),
		    'post_status'	=> array('draft', 'pending', 'publish')
		);
		    
		$the_query = new WP_Query( $args );
		$user_post_count = $the_query->found_posts;
		 
		return $user_post_count;
	}
}

/*-----------------------------------------------------------------------------------*/
/* User Listing Featured Post Count */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_listing_featured_post_count')) {
	function ct_listing_featured_post_count( $userid, $post_type ) {
		if( empty( $userid ) )
		   return false;
		 
		$args = array(
		    'post_type'		=> $post_type,
		    'author'		=> $userid,
		    'ct_status'		=> 'featured',
		    'post_status'	=> array('draft', 'pending', 'publish')
		);
		    
		$the_query = new WP_Query( $args );
		$user_post_count = $the_query->found_posts;
		 
		return $user_post_count;
	}
}

/*-----------------------------------------------------------------------------------*/
/* User Listing Pending Post Count */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_listing_pending_post_count')) {
	function ct_listing_pending_post_count( $userid, $post_type ) {
		if( empty( $userid ) )
		   return false;
		 
		$args = array(
		    'post_type'		=> $post_type,
		    'author'		=> $userid,
		    'post_status'	=> array('draft', 'pending')
		);
		    
		$the_query = new WP_Query( $args );
		$user_post_count = $the_query->found_posts;
		 
		return $user_post_count;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Front End Delete Post */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_delete_post_link')) {
	function ct_delete_post_link($link = 'Delete This', $before = '', $after = '') {
	    global $post;
	    $message = 'Are you sure you want to delete ' . get_the_title($post->ID) .' ?';
	    $delLink = wp_nonce_url( esc_url( home_url() ) . '/wp-admin/post.php?action=delete&amp;post=' . $post->ID, 'delete-post_' . $post->ID);
	    $htmllink = '<a class="btn delete-listing" href="' . $delLink . '" data-tooltip="' . __('Delete','contempo') . '" onclick = "if ( confirm(\'' . $message . '\' ) ) { execute(); return true; } return false;" />' . $link . '</a>';
	    echo $before . $htmllink . $after;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Submit Listing from Front End */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_submit_listing')) {
	function ct_submit_listing() {

		global $ct_options;
		$view = $ct_options['ct_view'];
		$ct_auto_publish = $ct_options['ct_auto_publish'];

		if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {

			if(trim($_POST['postTitle']) === '') {
				$postTitleError = 'Please enter an address.';
				$hasError = true;
			} else {
				$postTitle = trim($_POST['postTitle']);
			}

			$post_information = array(
			    'post_title' => wp_strip_all_tags( $_POST['postTitle'] ),
			    'post_content' => $_POST['postContent'],
			    'post_type' => 'listings',
			    'post_status' => $ct_auto_publish
			);

			$post_id = wp_insert_post($post_information);

			if ($_FILES) {
				foreach ($_FILES as $file => $array) {
					$newupload = ct_insert_attachment($file,$post_id);
				}
			}

			if($post_id) {

				// Update Custom Meta
				update_post_meta($post_id, '_ct_listing_alt_title', esc_attr(strip_tags($_POST['customMetaAltTitle'])));
		        update_post_meta($post_id, '_ct_price', esc_attr(strip_tags($_POST['customMetaPrice'])));
				update_post_meta($post_id, '_ct_price_prefix', esc_attr(strip_tags($_POST['customMetaPricePrefix'])));
				update_post_meta($post_id, '_ct_price_postfix', esc_attr(strip_tags($_POST['customMetaPricePostfix'])));
				update_post_meta($post_id, '_ct_sqft', esc_attr(strip_tags($_POST['customMetaSqFt'])));
				update_post_meta($post_id, '_ct_video', esc_attr(strip_tags($_POST['customMetaVideoURL'])));
		        update_post_meta($post_id, '_ct_mls', esc_attr(strip_tags($_POST['customMetaMLS'])));
		        update_post_meta($post_id, '_ct_rental_guests', esc_attr(strip_tags($_POST['customMetaMaxGuests'])));
		        update_post_meta($post_id, '_ct_rental_min_stay', esc_attr(strip_tags($_POST['customMetaMinStay'])));
		        update_post_meta($post_id, '_ct_rental_checkin', esc_attr(strip_tags($_POST['customMetaCheckIn'])));
		        update_post_meta($post_id, '_ct_rental_checkout', esc_attr(strip_tags($_POST['customMetaCheckOut'])));
		        update_post_meta($post_id, '_ct_rental_extra_people', esc_attr(strip_tags($_POST['customMetaExtraPerson'])));
		        update_post_meta($post_id, '_ct_rental_cleaning', esc_attr(strip_tags($_POST['customMetaCleaningFee'])));
		        update_post_meta($post_id, '_ct_rental_cancellation', esc_attr(strip_tags($_POST['customMetaCancellationFee'])));
		        update_post_meta($post_id, '_ct_rental_deposit', esc_attr(strip_tags($_POST['customMetaSecurityDeposit'])));

				//Update Custom Taxonomies
				wp_set_post_terms($post_id,array($_POST['ct_property_type']),'property_type',true);
				wp_set_post_terms($post_id,array($_POST['customTaxBeds']),'beds',true);
				wp_set_post_terms($post_id,array($_POST['customTaxBaths']),'baths',true);
				wp_set_post_terms($post_id,array($_POST['ct_ct_status']),'ct_status',true);
				wp_set_post_terms($post_id,array($_POST['customTaxCity']),'city',true);
				wp_set_post_terms($post_id,array($_POST['customTaxState']),'state',true);
				wp_set_post_terms($post_id,array($_POST['customTaxZip']),'zipcode',true);
				wp_set_post_terms($post_id,array($_POST['customTaxFeat']),'additional_features',true);

				// Redirect
				$the_page_url = home_url('/?page_id=' . $view);
				wp_redirect( $the_page_url ); exit;
			}
		}

	}
}

/*-----------------------------------------------------------------------------------*/
/* Login & Registration */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_registration_form')) {
	function ct_registration_form() {

		global $ct_options;
		
		// only show the registration form to non-logged-in members
		if(!is_user_logged_in()) {
			
			// check to make sure user registration is enabled
			$registration_enabled = get_option('users_can_register');
			$ct_enable_front_end_registration = isset( $ct_options['ct_enable_front_end_registration'] ) ? esc_html( $ct_options['ct_enable_front_end_registration'] ) : '';
		
			// only show the registration form if allowed
			if($ct_enable_front_end_registration != 'no') {
				$output = ct_registration_form_fields();
			} else {
				$output = '<p class="no-registration">' . __('User registration is not enabled', 'contempo') . '</p>';
			}
			return $output;
		}
	}
}

// User login form
if(!function_exists('ct_login_form')) {
	function ct_login_form() {
		
		if(!is_user_logged_in()) {
			$output = ct_login_form_fields();
		} else {
			// could show some logged in user info here
			$output = '<!-- logged in -->';
		}
		return $output;
	}
}

// Login Form Fields
if(!function_exists('ct_login_form_fields')) {
	function ct_login_form_fields() {
		
		global $ct_options;

		$ct_enable_front_end_registration = isset( $ct_options['ct_enable_front_end_registration'] ) ? esc_html( $ct_options['ct_enable_front_end_registration'] ) : '';
			
		ob_start(); ?>
			<h4 class="marB20"><?php esc_html_e('Log in', 'contempo'); ?></h4>
			<?php if($ct_enable_front_end_registration != 'no') { ?>
			<p class="muted marB20"><?php esc_html_e('Don\'t have an account?', 'contempo'); ?> <a class="ct-registration" href="#"><?php esc_html_e('Create your account,', 'contempo'); ?></a> <?php esc_html_e('it takes less than a minute.', 'contempo'); ?></p>
			<?php } ?>
				<div class="clear"></div>

			<div id="ct_account_errors">
			<?php
			// show any error messages after form submission
			ct_show_error_messages(); ?>
			</div>
			
			<form id="ct_login_form"  class="ct_form" action="" method="post">
				<fieldset>
					<label for="ct_user_Login"><?php esc_html_e('Username', 'contempo'); ?></label>
					<input name="ct_user_login" id="ct_user_login" class="required" type="text" required />

					<label for="ct_user_pass"><?php esc_html_e('Password', 'contempo'); ?></label>
					<input name="ct_user_pass" id="ct_user_pass" class="required" type="password" required />

						<div class="clear"></div>
					<input type="hidden" name="ct_login_nonce" value="<?php echo wp_create_nonce('ct-login-nonce'); ?>"/>
					<input type="hidden" name="action" value="ct_login_member_ajax"/>
					<button class="btn marT10" id="ct_login_submit" type="submit" value="Login"><i id="login-register-progress" class="fa fa-spinner fa-spin fa-fw"></i><?php _e('Login', 'contempo'); ?></button>

				</fieldset>
			</form>
			<?php
				if(function_exists('wsl_install')) {
					do_action('wordpress_social_login');
				}
			?>
			<p class="marB0"><small><a class="muted ct-lost-password" href="#" title="Lost your password?"><?php _e('Lost your password?', 'contempo'); ?></a></small></p>
		<?php
		return ob_get_clean();
	}
}

// Lost Password Fields
if(!function_exists('ct_lost_password_fields')) {
	function ct_lost_password_fields() { ?>

		<h4 class="marB20"><?php esc_html_e('Lost Password?', 'contempo'); ?></h4>
		<p class="muted"><?php _e('Enter your email address and we\'ll send you a link you can use to pick a new password.', 'contempo'); ?></p>
		<form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
            <label for="user_login"><?php _e( 'Username or Email', 'contempo' ); ?>
            <input type="text" name="user_login" id="user_login">
            <input type="submit" name="user-submit" class="btn marT10" value="<?php _e( 'Get New Password', 'contempo' ); ?>"/>
	        </p>
	    </form>
	<?php }
}

if(!function_exists('ct_password_lost')) {
	function ct_password_lost() {
		if('POST' == $_SERVER['REQUEST_METHOD']) {
		    $errors = retrieve_password();
		    if ( is_wp_error( $errors ) ) {
		        // Errors found
		        $redirect_url = home_url();
		        $redirect_url = add_query_arg( 'errors', join( ',', $errors->get_error_codes() ), $redirect_url );
		    } else {
		        // Email sent
		        $redirect_url = home_url();
		        $redirect_url = add_query_arg( 'checkemail', 'confirm', $redirect_url );
		    }

		    wp_redirect( $redirect_url );
		    exit;
		}
	}
}

// Registration form fields
if(!function_exists('ct_registration_form_fields')) {
	function ct_registration_form_fields() {

		global $ct_options;

		$ct_enable_front_end = isset( $ct_options['ct_enable_front_end'] ) ? esc_attr( $ct_options['ct_enable_front_end'] ) : '';
		$ct_registration_terms_conditions_page = isset( $ct_options['ct_registration_terms_conditions_page'] ) ? esc_attr( $ct_options['ct_registration_terms_conditions_page'] ) : '';
		
		ob_start(); ?>	
			<h4 class="marB20"><?php esc_html_e('Create an account', 'contempo'); ?></h4>
			<p class="muted marB20"><?php esc_html_e('It takes less than a minute. If you already have an account ', 'contempo'); ?><a class="ct-login" href="#"><?php esc_html_e('login', 'contempo'); ?></a>.</p>
			
			<div id="ct_account_errors">
				<?php ct_show_error_messages(); ?>
			</div>
			
			<form id="ct_registration_form" class="ct_form" action="" method="POST">
				<fieldset>
					<div id="register_user_login">
						<label for="ct_user_Login"><?php esc_html_e('Username', 'contempo'); ?></label>
						<input name="ct_user_login" id="ct_user_login" class="required" type="text"/>
					</div>

					<div id="register_user_email">
						<label for="ct_user_email"><?php esc_html_e('Email', 'contempo'); ?></label>
						<input name="ct_user_email" id="ct_user_email" class="required" type="email"/>
					</div>

					<div id="register_user_firstname" class="col span_6 first">
						<label for="ct_user_first"><?php esc_html_e('First Name', 'contempo'); ?></label>
						<input name="ct_user_first" id="ct_user_first" type="text"/>
					</div>

					<div id="register_user_lastname" class="col span_6">
						<label for="ct_user_last"><?php esc_html_e('Last Name', 'contempo'); ?></label>
						<input name="ct_user_last" id="ct_user_last" type="text"/>
					</div>

					<div id="register_user_website" class="col span_12 first">
						<label for="ct_user_website"><?php esc_html_e('Website', 'contempo'); ?></label>
						<input name="ct_user_website" id="ct_user_website" type="text" />
					</div>

					<?php if($ct_enable_front_end == 'yes') { ?>
					<div id="register_user_role" class="col span_12 first">
						<label for="ct_user_role"><?php esc_html_e('Buyer, Seller or Agent?', 'contempo'); ?></label>
						<select name="ct_user_role" id="ct_user_role">
							<option value=""><?php _e('Please choose', 'contempo'); ?></option>
							<option value="buyer"><?php _e('Buyer', 'contempo'); ?></option>
							<option value="seller"><?php _e('Seller', 'contempo'); ?></option>
							<option value="agent"><?php _e('Agent', 'contempo'); ?></option>
						</select>
					</div>
					<?php } ?>

					<div id="register_user_password" class="col span_6 first">
						<label for="password"><?php esc_html_e('Password', 'contempo'); ?></label>
						<input name="ct_user_pass" id="password" class="required" type="password"/>
					</div>

					<div id="register_user_password_confirm" class="col span_6">
						<label for="password_again"><?php esc_html_e('Password Again', 'contempo'); ?></label>
						<input name="ct_user_pass_confirm" id="password_again" class="required" type="password"/>
					</div>

					<?php if(!empty($ct_registration_terms_conditions_page)) { ?>
					<div id="register_user_terms" class="col span_12 marB20">
						<input id="ct_user_terms" class="marR10" name="ct_user_terms" type="checkbox" /><small><span class="muted"><?php _e('I accept the', 'contempo'); ?></span> <a href="<?php echo get_page_link($ct_registration_terms_conditions_page); ?>" target="_blank"><?php _e('Terms &amp; Conditions', 'contempo'); ?></a></small>
					</div>
					<?php } ?>

					<input type="hidden" name="ct_register_nonce" value="<?php echo wp_create_nonce('ct-register-nonce'); ?>"/>
					<button id="ct_register_submit" class="btn marT10" type="submit" value="<?php esc_html_e('Register', 'contempo'); ?>"><i id="register-progress" class="fa fa-spinner fa-spin fa-fw"></i><?php esc_html_e('Register', 'contempo'); ?></i></button>
				</fieldset>
			</form>
		<?php
		return ob_get_clean();
	}
}

// Register a new user
if(!function_exists('ct_add_new_member')) {
	function ct_add_new_member() {
		
		global $ct_options;

		$ct_registration_redirect_page = isset( $ct_options['ct_registration_redirect_page'] ) ? esc_attr( $ct_options['ct_registration_redirect_page'] ) : '';
		$ct_registration_terms_conditions_page = isset( $ct_options['ct_registration_terms_conditions_page'] ) ? esc_attr( $ct_options['ct_registration_terms_conditions_page'] ) : '';
		$ct_registered_user_role = isset( $ct_options['ct_registered_user_role'] ) ? esc_attr( $ct_options['ct_registered_user_role'] ) : 'contributor';

	  	if (isset( $_POST["ct_user_login"] ) && wp_verify_nonce($_POST['ct_register_nonce'], 'ct-register-nonce')) {

			$user_login		= $_POST["ct_user_login"];	
			$user_email		= $_POST["ct_user_email"];
			$user_first 	= $_POST["ct_user_first"];
			$user_last	 	= $_POST["ct_user_last"];
			$user_website   = $_POST["ct_user_website"];
			$user_role   	= $_POST["ct_user_role"];
			$user_pass		= $_POST["ct_user_pass"];
			$pass_confirm 	= $_POST["ct_user_pass_confirm"];
			$user_terms     = $_POST["ct_user_terms"];
			
			// this is required for username checks
			require_once(ABSPATH . WPINC . '/registration.php');
			
			if(username_exists($user_login)) {
				// Username already registered
				ct_errors()->add('username_unavailable', __('Username already taken', 'contempo'));
			}
			if(!validate_username($user_login)) {
				// invalid username
				ct_errors()->add('username_invalid', __('Invalid username', 'contempo'));
			}
			if($user_login == '') {
				// empty username
				ct_errors()->add('username_empty', __('Please enter a username', 'contempo'));
			}
			if(!is_email($user_email)) {
				//invalid email
				ct_errors()->add('email_invalid', __('Invalid email', 'contempo'));
			}
			if(email_exists($user_email)) {
				//Email address already registered
				ct_errors()->add('email_used', __('Email already registered', 'contempo'));
			}
			if($user_pass == '') {
				// passwords do not match
				ct_errors()->add('password_empty', __('Please enter a password', 'contempo'));
			}
			if($user_pass != $pass_confirm) {
				// passwords do not match
				ct_errors()->add('password_mismatch', __('Passwords do not match', 'contempo'));
			}

			if($ct_registration_terms_conditions_page != '' && $user_terms == '') {
				ct_errors()->add('user_terms_empty', __('Terms & Conditions must be checked', 'contempo'));
			}
			
			$errors = ct_errors()->get_error_messages();
			
			// only create the user in if there are no errors
			if(!empty($user_role)) {
				if(!empty($ct_registration_terms_conditions_page)) {
					if(empty($user_website)) {
						if(empty($errors) && isset($user_terms)) {
							
							$new_user_id = wp_insert_user(array(
									'user_login'		=> $user_login,
									'user_pass'	 		=> $user_pass,
									'user_email'		=> $user_email,
									'first_name'		=> $user_first,
									'last_name'			=> $user_last,
									'user_registered'	=> date('Y-m-d H:i:s'),
									'role'				=> $user_role
								)
							);
							if($new_user_id) {
								// send an email to the admin alerting them of the registration
								wp_new_user_notification($new_user_id);
								
								// log the new user in
								wp_setcookie($user_login, $user_pass, true);
								wp_set_current_user($new_user_id, $user_login);	
								do_action('wp_login', $user_login);
								
								if($ct_registration_redirect_page) {
									$the_page_url = home_url('/?page_id=' . $ct_registration_redirect_page);
									wp_redirect( $the_page_url ); exit;
								} else {
									wp_redirect(home_url()); exit;
								}
							}
							
						}
					}
				} else {
					if(empty($user_website)) {
						if(empty($errors) && isset($user_terms)) {
							
							$new_user_id = wp_insert_user(array(
									'user_login'		=> $user_login,
									'user_pass'	 		=> $user_pass,
									'user_email'		=> $user_email,
									'first_name'		=> $user_first,
									'last_name'			=> $user_last,
									'user_registered'	=> date('Y-m-d H:i:s'),
									'role'				=> $user_role
								)
							);
							if($new_user_id) {
								// send an email to the admin alerting them of the registration
								wp_new_user_notification($new_user_id);
								
								// log the new user in
								wp_setcookie($user_login, $user_pass, true);
								wp_set_current_user($new_user_id, $user_login);	
								do_action('wp_login', $user_login);
								
								if($ct_registration_redirect_page) {
									$the_page_url = home_url('/?page_id=' . $ct_registration_redirect_page);
									wp_redirect( $the_page_url ); exit;
								} else {
									wp_redirect(home_url()); exit;
								}
							}
							
						}
					}
				}
			} else {
				if(!empty($ct_registration_terms_conditions_page)) {
					if(empty($user_website)) {
						if(empty($errors) && isset($user_terms)) {
							
							$new_user_id = wp_insert_user(array(
									'user_login'		=> $user_login,
									'user_pass'	 		=> $user_pass,
									'user_email'		=> $user_email,
									'first_name'		=> $user_first,
									'last_name'			=> $user_last,
									'user_registered'	=> date('Y-m-d H:i:s'),
									'role'				=> $ct_registered_user_role
								)
							);
							if($new_user_id) {
								// send an email to the admin alerting them of the registration
								wp_new_user_notification($new_user_id);
								
								// log the new user in
								wp_setcookie($user_login, $user_pass, true);
								wp_set_current_user($new_user_id, $user_login);	
								do_action('wp_login', $user_login);
								
								if($ct_registration_redirect_page) {
									$the_page_url = home_url('/?page_id=' . $ct_registration_redirect_page);
									wp_redirect( $the_page_url ); exit;
								} else {
									wp_redirect(home_url()); exit;
								}
							}
							
						}
					}
				} else {
					if(empty($user_website)) {
						if(empty($errors) && isset($user_terms)) {
							
							$new_user_id = wp_insert_user(array(
									'user_login'		=> $user_login,
									'user_pass'	 		=> $user_pass,
									'user_email'		=> $user_email,
									'first_name'		=> $user_first,
									'last_name'			=> $user_last,
									'user_registered'	=> date('Y-m-d H:i:s'),
									'role'				=> $ct_registered_user_role
								)
							);
							if($new_user_id) {
								// send an email to the admin alerting them of the registration
								wp_new_user_notification($new_user_id);
								
								// log the new user in
								wp_setcookie($user_login, $user_pass, true);
								wp_set_current_user($new_user_id, $user_login);	
								do_action('wp_login', $user_login);
								
								if($ct_registration_redirect_page) {
									$the_page_url = home_url('/?page_id=' . $ct_registration_redirect_page);
									wp_redirect( $the_page_url ); exit;
								} else {
									wp_redirect(home_url()); exit;
								}
							}
							
						}
					}
				}
			}
		
		}
	}
}
add_action('init', 'ct_add_new_member');

// Logs a member in after submitting a form
if(!function_exists('ct_login_member')) {
	function ct_login_member() {

		global $ct_options;

		$ct_login_redirect_page = isset( $ct_options['ct_login_redirect_page'] ) ? esc_attr( $ct_options['ct_login_redirect_page'] ) : '';
			
		if(isset($_POST['ct_user_login']) && wp_verify_nonce($_POST['ct_login_nonce'], 'ct-login-nonce')) {
					
			// this returns the user ID and other info from the user name
			$user = get_userdatabylogin($_POST['ct_user_login']);
			
			if(!$user) {
				// if the user name doesn't exist
				ct_errors()->add('empty_username', __('Invalid username', 'contempo'));
			}
			
			if(!isset($_POST['ct_user_pass']) || $_POST['ct_user_pass'] == '') {
				// if no password was entered
				ct_errors()->add('empty_password', __('Please enter a password', 'contempo'));
			}
					
			// check the user's login with their password
			if(!wp_check_password($_POST['ct_user_pass'], $user->user_pass, $user->ID)) {
				// if the password is incorrect for the specified user
				ct_errors()->add('empty_password', __('Incorrect password', 'contempo'));
			}
			
			// retrieve all error messages
			$errors = ct_errors()->get_error_messages();
			
			// only log the user in if there are no errors
			if(empty($errors)) {
				
				wp_setcookie($_POST['ct_user_login'], $_POST['ct_user_pass'], true);
				wp_set_current_user($user->ID, $_POST['ct_user_login']);	
				do_action('wp_login', $_POST['ct_user_login']);
				
				if(!empty($ct_login_redirect_page)) {
					$the_page_id = $ct_login_redirect_page;
					$url = get_permalink( $the_page_id );
					wp_redirect( $url ); exit;
				} else {
					wp_redirect(home_url()); exit;
				}
			}
		}
	}
}
add_action('init', 'ct_login_member');

if(!function_exists('ct_login_member_ajax')) {
	function ct_login_member_ajax() {

		if(isset($_POST['ct_user_login']) && wp_verify_nonce($_POST['ct_login_nonce'], 'ct-login-nonce')) {
					
			// this returns the user ID and other info from the user name
			$user = get_userdatabylogin($_POST['ct_user_login']);
			
			if(!$user) {
				// if the user name doesn't exist
				ct_errors()->add('empty_username', __('Invalid username', 'contempo'));
			}
			
			if(!isset($_POST['ct_user_pass']) || $_POST['ct_user_pass'] == '') {
				// if no password was entered
				ct_errors()->add('empty_password', __('Please enter a password', 'contempo'));
			}
					
			// check the user's login with their password
			if(!wp_check_password($_POST['ct_user_pass'], $user->user_pass, $user->ID)) {
				// if the password is incorrect for the specified user
				ct_errors()->add('empty_password', __('Incorrect password', 'contempo'));
			}
			
			// retrieve all error messages
			$errors = ct_errors()->get_error_messages();
			
			// only log the user in if there are no errors
			if(empty($errors)) {
				
				$creds = array();
				$creds['user_login'] = $_POST['ct_user_login'];
				$creds['user_password'] = $_POST['ct_user_pass'];
				$creds['remember'] = true;
				$user = wp_signon( $creds, false );
				
				wp_send_json(array('success'=>true, 'redirect'=>home_url()));
			} else {
				wp_send_json(array('success'=>false, 'errors'=>ct_get_errors()));
			}
		} else {
			wp_send_json(array('success'=>false, 'errors'=>array('Invalid session')));
		}
	}
}
add_action( 'wp_ajax_nopriv_ct_login_member_ajax', 'ct_login_member_ajax' );

// displays error messages from form submissions
if(!function_exists('ct_show_error_messages')) {
	function ct_show_error_messages() {
		if($codes = ct_errors()->get_error_codes()) {
			echo '<div class="ct_errors">';
			    // Loop error codes and display errors
			   foreach($codes as $code){
			        $message = ct_errors()->get_error_message($code);
			        echo '<span class="error"><strong>' . __('Error', 'contempo') . '</strong>: ' . $message . '</span><br/>';
			    }
			echo '</div>';
		}	
	}
}

if(!function_exists('ct_get_errors')) {
	function ct_get_errors() {
		$errors = array();
		if($codes = ct_errors()->get_error_codes()) {
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = ct_errors()->get_error_message($code);
		        array_push($errors, $message);
		    }
		}
		return $errors;
	}
}

// used for tracking error messages
if(!function_exists('ct_errors')) {
	function ct_errors(){
	    static $wp_error; // Will hold global variable safely
	    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
	} 
}

/*-----------------------------------------------------------------------------------*/
/* Delete User Front End */
/*-----------------------------------------------------------------------------------*/

function ct_delete_user() {
	if(isset($_REQUEST['action']) && $_REQUEST['action']=='ct_delete_user') {
		include("./wp-admin/includes/user.php" );
		
		$current_user_id = get_current_user_id();
		$user_id = intval($_REQUEST['user_id']);

		if($current_user_id->ID == $user_id) {
			wp_delete_user($user_id);
			wp_redirect(home_url());
			exit();
		} else {
			wp_redirect(home_url());
		}
	}
}
add_action('init','ct_delete_user');

/*-----------------------------------------------------------------------------------*/
/* MailChimp CURL Connect */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_mailchimp_curl_connect')) {
	function ct_mailchimp_curl_connect( $url, $request_type, $api_key, $data = array() ) {
		if( $request_type == 'GET' )
			$url .= '?' . http_build_query($data);
	 
		$mch = curl_init();
		$headers = array(
			'Content-Type: application/json',
			'Authorization: Basic '.base64_encode( 'user:'. $api_key )
		);
		curl_setopt($mch, CURLOPT_URL, $url );
		curl_setopt($mch, CURLOPT_HTTPHEADER, $headers);
		//curl_setopt($mch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
		curl_setopt($mch, CURLOPT_RETURNTRANSFER, true); // do not echo the result, write it into variable
		curl_setopt($mch, CURLOPT_CUSTOMREQUEST, $request_type); // according to MailChimp API: POST/GET/PATCH/PUT/DELETE
		curl_setopt($mch, CURLOPT_TIMEOUT, 10);
		curl_setopt($mch, CURLOPT_SSL_VERIFYPEER, false); // certificate verification for TLS/SSL connection
	 
		if( $request_type != 'GET' ) {
			curl_setopt($mch, CURLOPT_POST, true);
			curl_setopt($mch, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json
		}
	 
		return curl_exec($mch);
	}
}

/*-----------------------------------------------------------------------------------*/
/* MailChimp Subscribe/Unsubscribe Users */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_mailchimp_subscribe_unsubscribe')) {
	function ct_mailchimp_subscribe_unsubscribe( $email, $status, $merge_fields = array( 'FNAME' => '', 'LNAME' => '' ) ){
		global $ct_options;

		$ct_mailchimp_apikey = isset( $ct_options['ct_mailchimp_apikey'] ) ? esc_attr( $ct_options['ct_mailchimp_apikey'] ) : '';
		$ct_mailchimp_list_id = isset( $ct_options['ct_mailchimp_list_id'] ) ? esc_attr( $ct_options['ct_mailchimp_list_id'] ) : '';
	 
		/* MailChimp API URL */
		$url = 'https://' . substr($ct_mailchimp_apikey,strpos($ct_mailchimp_apikey,'-')+1) . '.api.mailchimp.com/3.0/lists/' . $ct_mailchimp_list_id . '/members/' . md5(strtolower($email));
		/* MailChimp POST data */
		$data = array(
			'apikey'        => $ct_mailchimp_apikey,
	    	'email_address' => $email,
			'status'        => $status, // in this post we will use only 'subscribed' and 'unsubscribed'
			'merge_fields'  => $merge_fields // in this post we will use only FNAME and LNAME
		);
		return json_decode( ct_mailchimp_curl_connect( $url, 'PUT', $ct_mailchimp_apikey, $data ) );
	}
}

if(!function_exists('ct_user_register_hook')) {
	function ct_user_register_hook( $user_id ){

		global $ct_options;

		$ct_enable_mailchimp = isset( $ct_options['ct_enable_mailchimp'] ) ? esc_attr( $ct_options['ct_enable_mailchimp'] ) : '';
	 
		$user = get_user_by('id', $user_id ); // feel free to use get_userdata() instead
	 	
	 	if($ct_enable_mailchimp == 'yes') {
			$subscription = ct_mailchimp_subscribe_unsubscribe( $user->user_email, 'subscribed', array( 'FNAME' => $user->first_name,'LNAME' => $user->last_name ) );
		}
	 
		/*
		 * if user subscription was failed you can try to store the errors the following way
		 */
		if( $subscription->status != 'subscribed' )
			update_user_meta( $user_id, '_subscription_error', 'User was not subscribed because:' . $subscription->detail );
	 
	}
}
add_action('user_register', 'ct_user_register_hook', 20, 1 );
 
function ct_user_delete_hook( $user_id ){
	$user = get_user_by( 'id', $user_id );
	$subscription = ct_mailchimp_subscribe_unsubscribe( $user->user_email, 'unsubscribed', array( 'FNAME' => $user->first_name,'LNAME' => $user->last_name ) );
}
add_action( 'delete_user', 'ct_user_delete_hook', 20, 1 );

/*-----------------------------------------------------------------------------------*/
/* MailChimp Batch Subscribe Previously Registered Users */
/*-----------------------------------------------------------------------------------

function ct_batch_wp_users_subscribe() {
	$api_key = 'YOUR API KEY SHOULD BE HERE';
	$list_id = 'YOUR LIST ID HERE';
 
	// MailChimp API URL
	$url = 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/batches';
 
	// "Schema describes object"? Not a problem
	$data = new stdClass();
	// all the batch operations will be stored in this array
	$data->operations = array();
 
	$wordpress_users_all = get_users( 'exclude=1' ); // if you do not want to subscribe yourself (but maybe you have another user ID)
	// loop all WP users
	foreach ( $wordpress_users_all as $user ) {
		// a single batch operation object for each user
		$batch =  new stdClass();
		$batch->method = 'POST';
		$batch->path = 'lists/' . $list_id . '/members';
		$batch->body = json_encode( array(
			'email_address' => $user->user_email,
			'status'        => 'subscribed',
			'merge_fields'  => array( 
				'FNAME' => $user->first_name,
				'LNAME' => $user->last_name
			)
		) );
		$data->operations[] = $batch;
	}
 
	return json_decode( ct_mailchimp_curl_connect( $url, 'POST', $api_key, $data ) );
}

/*-----------------------------------------------------------------------------------*/
/* WPML Flags */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_language_selector_flags')) {
	function ct_language_selector_flags(){
	    $languages = icl_get_languages('skip_missing=0&orderby=code');
	    if(!empty($languages)){
			echo '<ul>';
				foreach($languages as $l){
					echo '<li>';
						if(!$l['active']) echo '<a href="'.$l['url'].'">';
							echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
						if(!$l['active']) echo '</a>';
					echo '</li>';
				}
			echo '</ul>';
	    }
	}
}

/*-----------------------------------------------------------------------------------*/
/* WPML Lang */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_language_selector_lang')) {
	function ct_language_selector_lang(){
	    $languages = icl_get_languages('skip_missing=0&orderby=code');
	    if(!empty($languages)){
			echo '<ul>';
				foreach($languages as $l){
					echo '<li>';
						if(!$l['active']) echo '<a href="'.$l['url'].'">';
							echo esc_html($l['language_code']);
						if(!$l['active']) echo '</a>';
					echo '</li>';
				}
			echo '</ul>';
	    }
	}
}

/*-----------------------------------------------------------------------------------*/
/* Remove CPTs from Blog Search */
/*-----------------------------------------------------------------------------------

if(!function_exists('ct_searchfilter')) {
	//if(!is_admin()) {
		function ct_searchfilter($query) {
			if ($query->is_search) {
				$query->set('post_type',array('post','page'));
			}
			return $query;
		}
	//}
}
add_filter('pre_get_posts','ct_searchfilter');

/*-----------------------------------------------------------------------------------*/
/* Disable Gutenberg for Everything Except Posts */
/*-----------------------------------------------------------------------------------*/

add_filter('use_block_editor_for_page', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);

/*-----------------------------------------------------------------------------------*/
/* Deregister Visual Composer Flexslider CSS */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_remove_vc_styles')) {
	function ct_remove_vc_styles() {
	    wp_deregister_style( 'flexslider' );
	}
}
add_action( 'wp_enqueue_scripts', 'ct_remove_vc_styles', 99 );

/*-----------------------------------------------------------------------------------*/
/* Deregister Mortgage Calc Plugin CSS */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_deregister_styles')) {
	function ct_deregister_styles() {
		wp_deregister_style( 'ct_mortgage_calc' );
	}
}
add_action( 'wp_print_styles', 'ct_deregister_styles', 100 );

/*-----------------------------------------------------------------------------------*/
/* Move Featured Image Meta Box To The Top */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_move_meta_box')) {
	function ct_move_meta_box() {
		remove_meta_box( 'postimagediv', 'listings', 'side' );
		add_meta_box('postimagediv', __('Featured Image', 'contempo'), 'post_thumbnail_meta_box', 'listings', 'side', 'high');
		remove_meta_box( 'postimagediv', 'Brokerages', 'side' );
		add_meta_box('postimagediv', __('Brokerage Logo', 'contempo'), 'post_thumbnail_meta_box', 'brokerage', 'side', 'high');
		remove_meta_box( 'postimagediv', 'testimonials', 'side' );
		add_meta_box('postimagediv', __('Featured Image', 'contempo'), 'post_thumbnail_meta_box', 'testimonials', 'side', 'high');
	}
}
add_action('do_meta_boxes', 'ct_move_meta_box');

/*-----------------------------------------------------------------------------------*/
/* Membership Package Status Meta Box */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_add_package_status_metabox')) {
	function ct_add_package_status_metabox() {
		global $ct_options;
		
		$ct_enable_front_end_paid = isset( $ct_options['ct_enable_front_end_paid'] ) ? esc_attr( $ct_options['ct_enable_front_end_paid'] ) : '';
		$ct_enable_front_end_paid_per_listing_or_mebership_packages = isset( $ct_options['ct_enable_front_end_paid_per_listing_or_mebership_packages'] ) ? esc_attr( $ct_options['ct_enable_front_end_paid_per_listing_or_mebership_packages'] ) : '';

		if($ct_enable_front_end_paid == 'yes' && $ct_enable_front_end_paid_per_listing_or_mebership_packages == 'membership-packages'){
			/*add_meta_box(
				'ct_package_status',
				'User Membership Info',
				'ct_package_status',
				'listings',
				'side',
				'high'
			);*/
		}
	}
}
add_action( 'add_meta_boxes', 'ct_add_package_status_metabox' );

if(!function_exists('ct_package_status')) {
	function ct_package_status() {
		global $post;
		global $wpdb;
		
		$uid = $post->post_author;
		$today = strtotime(date("Y-m-d"));
		$ct_user_listings_count = ct_listing_post_count($post->post_author, 'listings');
		
		$events = $wpdb->get_results ("SELECT * FROM ".$wpdb->prefix."posts WHERE post_author = $uid AND post_type = 'package_order' order by id" );

		foreach($events as $data){	
			$post_id = $data->ID;
		}
		
		$package_orders = array(
			'post_type' => 'package_order',
			'post_status' => 'any',
			'posts_per_page' => -1,
			'author' =>  $uid		
		);
			
	    $package_order_loop = new WP_Query($package_orders);

	    //print_r($package_order_loop);

		$post_listing = array(
			'post_type' => 'listings',
			'post_status' => 'any',
			'posts_per_page' => -1,
			'author' =>  $uid		
		);
			
	    $post_loop = new WP_Query($post_listing);
		
		$post_listing_count = $post_loop->post_count;

		//Featured listings	
		$featured_listing = array(
			'post_type' => 'listings',
			'post_status' => 'any',
			'posts_per_page' => -1,
			'author' =>  $uid,
			'tax_query' => array(
				array(
					'taxonomy' => 'ct_status',
					'field' => 'slug',
					'terms' => 'featured'
				)
			)
		);
			
	    $loop = new WP_Query($featured_listing);
		
		$featured_listing_count = $loop->post_count;

		if(empty($post_id)) { ?>
			
			<h4 id="no-package" class="marB20"><?php esc_html_e('User hasn\'t chosen a package yet…', 'contempo'); ?></h4>
		
		<?php } 
		
		if(!empty($package_order_loop)){	
			$purchased_date = get_post_meta($post_id,'package_current_date',true);
			$expiration_date = get_post_meta($post_id,'package_expire_date',true);
			$post_meta_id = get_post_meta($post_id,'packageID',true);
			$post_data = get_post($post_meta_id);
			$package_name = $post_data->post_title;
			$package_id = $post_data->ID;
			$listing_included = get_post_meta($package_id,'listing',true);
			$listing_remaining = $listing_included - $post_listing_count;
			$featured_listing = get_post_meta($package_id,'featured_listing',true);
			$featured_listing_remaining = $featured_listing - $featured_listing_count; 
		
		?>

		<?php if($post_listing_count >= $listing_included) {?>	
			<div id="package-limit-reached" class="package-status"><?php _e('Limit Reached', 'contempo'); ?></div>
		<?php } ?>
		
		<?php if($today >= strtotime($expiration_date) && !empty($expiration_date)) {?>
			<div id="package-expired" class="package-status"><?php _e('Expired', 'contempo'); ?></div>
		<?php } ?>

		<?php if(empty($expiration_date)) { ?>
			<h4 class="marB20"><?php esc_html_e('User hasn\'t chosen a package yet…', 'contempo'); ?></h4>
		<?php } ?>

		<?php if(!empty($expiration_date)) { ?>

	        <h3 class="marT0 marB0"><?php _e('Current Package Details', 'contempo'); ?> </h3>
			<p class="muted"><?php _e('Overview of users existing membership & package information.', 'contempo'); ?></p>

			<div id="package-active" class="package-status"><?php _e('Active', 'contempo'); ?></div>

			<ul id="membership-package-information">
				<li id="package-name" class="clr"><strong><?php _e('Package Name:', 'contempo'); ?> <?php echo esc_html($package_name); ?></li>
				<li id="listings-remaining" class="clr muted"><span class="left"><strong><?php _e('Listings Remaining:', 'contempo'); ?></strong></span> <span class="right"><?php echo esc_html($listing_remaining); ?></span></li>
				<li id="featured-remaining" class="clr muted"><span class="left"><strong><?php _e('Featured Listings Remaining:', 'contempo'); ?></strong></span> <span class="right"><?php echo esc_html($featured_listing_remaining); ?></span></li>
			</ul>
			<?php }

		} ?>
			
	<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/* Fix Pagination on Search Results */
/*-----------------------------------------------------------------------------------

if(!function_exists('ct_fix_query')) {
	function ct_fix_query($query) {
		global $paged;
		if( $query->is_main_query() && $query->is_home() ) {
			$query->set('post_type', array('post', 'listings'));
		}
	}
}
add_action('pre_get_posts', 'ct_fix_query');

/*-----------------------------------------------------------------------------------*/
/* Filter "Enter title here" with custom text */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_change_default_title')) {
	function ct_change_default_title($title){
	     $screen = get_current_screen();
	 
	     if ('listings' == $screen->post_type) {
	          $title = __('Enter the listing street address here', 'contempo');
	     }
	 
	     return $title;
	}
}
add_filter( 'enter_title_here', 'ct_change_default_title' );

/*-----------------------------------------------------------------------------------*/
/* Add note under Listing Title */
/*-----------------------------------------------------------------------------------*/

function ct_edit_form_after_title() {
	$screen = get_current_screen();
	 
    if  ( 'listings' == $screen->post_type ) {
		echo '<p class="cmb2-metabox-description">' . __('NOTE: The Listing Title needs to be <strong>only the Street Address</strong> (e.g. 123 Somewhere St.) otherwise the mapping won\'t work properly, use the Alternate Title field below for Listing Names, etc…the Alt Title field will override the street address on the front end of your site.', 'contempo') . '</p>';
	}

}
add_action( 'edit_form_after_title', 'ct_edit_form_after_title' );

/*-----------------------------------------------------------------------------------*/
/* Progress Bar for Front End Listing Submit & Edit */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_listings_progress_bar')) {
	function ct_listings_progress_bar() {

		global $ct_options;

		$ct_submit_rental_info = isset( $ct_options['ct_submit_rental_info'] ) ? esc_attr( $ct_options['ct_submit_rental_info'] ) : '';
        $ct_rentals_booking = isset( $ct_options['ct_rentals_booking'] ) ? esc_html( $ct_options['ct_rentals_booking'] ) : '';

		echo '<ul id="progress-bar" class="col span_12 first">';
			echo '<li>' . __('Price & Description', 'contempo') . '</li>';
			echo '<li>' . __('Photos & Files', 'contempo') . '</li>';
			echo '<li>' . __('Details', 'contempo') . '</li>';
			if($ct_rentals_booking == 'yes' || class_exists('Booking_Calendar') && $ct_submit_rental_info == 'yes') {
				echo '<li>' . __('Rental Info', 'contempo') . '</li>';
			}
			echo '<li>' . __('Location', 'contempo') . '</li>';
			echo '<li>' . __('Private Notes', 'contempo') . '</li>';
		echo '</ul>';

	}
}

/*-----------------------------------------------------------------------------------*/
/* Listing Title */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_listing_title')) {
	function ct_listing_title( $echo=true) {
		global $post;
		global $ct_options;
		
		$ct_listings_title_formatting = isset( $ct_options['ct_listings_title_formatting'] ) ? esc_html( $ct_options['ct_listings_title_formatting'] ) : '';
		$ct_rentals_booking = isset( $ct_options['ct_rentals_booking'] ) ? esc_html( $ct_options['ct_rentals_booking'] ) : '';

		$title = '';

		if($ct_rentals_booking == 'yes' || class_exists('Booking_Calendar')) {

			$listing_alt_title = get_post_meta($post->ID, "_ct_listing_alt_title", true);
			$rental_title = get_post_meta($post->ID, "_ct_rental_title", true);

			if(!empty($listing_alt_title)) {
			    $title = esc_html($listing_alt_title);
			} elseif(!empty($rental_title)) {
			    $title = esc_html($rental_title);
			} else {
				$title = get_the_title();
			}
		
		} else {

			$listing_alt_title = get_post_meta($post->ID, "_ct_listing_alt_title", true);

			if(!empty($listing_alt_title)) {
			    $title = esc_html($listing_alt_title);
			} else {
				$title = get_the_title();
			}
		}

		if($ct_listings_title_formatting == 'yes') {
			if($echo) {
				echo $title;
			} else {
				return $title;
			}
		} else {
			if($echo) {
				echo ucwords(strtolower($title));
			} else {
				return ucwords(strtolower($title));
			}
		}

	}
}

/*-----------------------------------------------------------------------------------*/
/* Listing Permalink */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_listing_permalink')) {
	function ct_listing_permalink() {
		global $ct_options;

		$ct_listings_login_register = isset( $ct_options['ct_listings_login_register'] ) ? $ct_options['ct_listings_login_register'] : '';

		if($ct_listings_login_register == 'yes' && !is_user_logged_in()) {
			echo 'class="login-register"';
		} else {
			echo 'href="';
				the_permalink();
			echo '"';
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Add meta_value_num parameter for User Query Orderby */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_pre_user_query')) {
	function ct_pre_user_query( &$query ) {
	    global $wpdb;

	    if ( isset( $query->query_vars['orderby'] ) && 'meta_value_num' == $query->query_vars['orderby'] )
	        $query->query_orderby = str_replace( 'user_login', "$wpdb->usermeta.meta_value+0", $query->query_orderby );
	}
}
add_action( 'pre_user_query', 'ct_pre_user_query' );

/*-----------------------------------------------------------------------------------*/
/* Favorite Listings */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_fav_listing')) {
	function ct_fav_listing() {
		global $ct_options;
		$ct_fav_only_reg_users = isset( $ct_options['ct_fav_only_reg_users'] ) ? esc_html( $ct_options['ct_fav_only_reg_users'] ) : '';

		if (function_exists('wpfp_link')) {

			if($ct_fav_only_reg_users == 'yes') {
				if(is_user_logged_in()) {
					echo '<span class="save-this">';
						wpfp_link();
					echo '</span>';
				} else {
					echo '<span class="login-register save-this" data-tooltip="' . __('Add to Favorites', 'contempo') . '">';
						echo '<a href="#"><i class="fa fa-heart-o"></i></a>';
					echo '</span>';
				}
			} else {
				echo '<span class="save-this" data-tooltip="' . __('Favorite', 'contempo') . '">';
					wpfp_link();
				echo '</span>';
			}

		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Output All Favorite Listings Permalinks */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_fav_listings_permalinks')) {
	function ct_fav_listings_permalinks() {

		$favorite_post_ids = wpfp_get_users_favorites();

        if($favorite_post_ids) {
	        foreach($favorite_post_ids as $o) {

	            echo get_permalink($o) . ', ';

		    }
		}

	}
}

/*-----------------------------------------------------------------------------------*/
/* Compare Listings */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_compare_listing')) {
	function ct_compare_listing() {

		if(class_exists('Redq_Alike')) {
			echo '<span class="compare-this" data-tooltip="' . __('Compare','contempo') . '">';
				echo do_shortcode('[alike_link vlaue="compare" show_icon="true" icon_class="fa fa-plus-square-o"]');
			echo '</span>';
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Listing Views */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_get_listing_views')) {
	function ct_get_listing_views($postID){
	    $count_key = 'post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count == ''){
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	        return "0";
	    }
	    return $count;
	}
}

if(!function_exists('ct_set_listing_views')) {
	function ct_set_listing_views($postID) {

		if(!isset($_SESSION)) { 
	        session_start(); 
	    } 
		
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);

		if($count=='') {
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		} else {
			if(!isset($_SESSION['post_views_count-'. $postID])){
				$_SESSION['post_views_count-'. $postID]="si";
				$count++;
				update_post_meta($postID, $count_key, $count);
			}
		} 
	}
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/*-----------------------------------------------------------------------------------*/
/* Listing Actions */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_listing_actions')) {
	function ct_listing_actions() {
		
		global $post, $ct_options;

		$ct_listing_stats_on_off = isset( $ct_options['ct_listing_stats_on_off'] ) ? esc_attr( $ct_options['ct_listing_stats_on_off'] ) : '';

		// Count Total images
        $attachments = get_children(
            array(
                'post_type' => 'attachment',
                'post_mime_type' => 'image',
                'post_parent' => get_the_ID()
            )
        );

        $img_count = count($attachments);

        $total_imgs = $img_count;

		echo '<ul class="listing-actions">';

			if(get_post_meta($post->ID, "source", true) != 'idx-api') { 
				echo '<li>';
					if($total_imgs === 1) {
						echo '<span class="listing-images-count" data-tooltip="' . $total_imgs . __(' Photo','contempo') . '">';
					} else {
						echo '<span class="listing-images-count" data-tooltip="' . $total_imgs . __(' Photos','contempo') . '">';
					}
						echo '<i class="fa fa-image"></i>';
					echo '</span>';
				echo '</li>';
			}
			
			if(function_exists('wpfp_link')) {
				echo '<li>';
					ct_fav_listing();
				echo '</li>';
			}

			if(class_exists('Redq_Alike')) {
				echo '<li>';
					ct_compare_listing();
				echo '</li>';
			}

			if(function_exists('ct_get_listing_views') && $ct_listing_stats_on_off != 'no') {
				echo '<li>';
					echo '<span class="listing-views" data-tooltip="' . ct_get_listing_views(get_the_ID()) . __(' Views','contempo') . '">';
						echo '<i class="fa fa-bar-chart"></i>';
					echo '</span>';
				echo '</li>';
			}

		echo '</ul>';
	}
}

/*-----------------------------------------------------------------------------------*/
/* Listing Actions - Favorite Remove */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_listing_actions_fav_remove')) {
	function ct_listing_actions_fav_remove() {
		
		global $post, $ct_options;

		$ct_listing_stats_on_off = isset( $ct_options['ct_listing_stats_on_off'] ) ? esc_attr( $ct_options['ct_listing_stats_on_off'] ) : '';

		// Count Total images
        $attachments = get_children(
            array(
                'post_type' => 'attachment',
                'post_mime_type' => 'image',
                'post_parent' => get_the_ID()
            )
        );

        $img_count = count($attachments);

        $total_imgs = $img_count;

		echo '<ul class="listing-actions">';
			
			if(function_exists('wpfp_link')) {
				echo '<li>';
					echo '<span class="save-this" data-tooltip="' . __('Remove', 'contempo') . '">';
						wpfp_remove_favorite_link(get_the_ID());
					echo '</span>';
				echo '</li>';
			}

		echo '</ul>';
	}
}

/*-----------------------------------------------------------------------------------*/
/* Return Taxonomy */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_taxonomy_return')) {
	function ct_taxonomy_return( $name ){
		global $post;
		global $wp_query;
		if(taxonomy_exists($name)){
			$terms_as_text = strip_tags( get_the_term_list( $wp_query->post->ID, $name, '', ', ', '' ) );
			if($terms_as_text != '') {
				return esc_html($terms_as_text);
			}
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Bath SVG Icon (left for backwards compatibility, not used in v2.5.7+) */
/*-----------------------------------------------------------------------------------*/

function ct_bath_icon() { ?>
	<svg class="muted" style="width: 25px;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="-240.6 138.8 142.1 107.1" enable-background="new -240.6 138.8 142.1 107.1" xml:space="preserve">
		<g>
			<path fill="#878c92" d="M-121.3,188.2c0,0,0-17.3,0-33.6c0-16.3-17.8-14.6-17.8-14.6c-12.5,0-13.3,10.7-13.4,12.5
				c-9.2,3.7-8.7,11.5-8.7,11.5h24c0-7.3-5.5-10.1-7.6-11.1c1.5-4.9,4.6-4.6,4.6-4.6c0.3,0,1.3,0,4.6,0c5.7,0,6.5,6.5,6.5,6.5v33.5
				h-89.2c-3.8,0-3.7,3.7-3.7,3.7s0,0.5,0,4.3c0,3.7,4.1,4.1,4.1,4.1s0.2,1.1,0.2,14.3c0,13.2,12.2,16.5,15.8,17.6
				c0.2,4.3-3.3,4.7-3.3,4.7c-4.2-0.1-4.6,2.5-4.6,3.7c0.2,3.7,3.3,4.1,3.3,4.1h2.1c9.9,0,10.3-11.9,10.3-11.9s39.6,0,49.1,0
				c1.8,11.7,10.1,12.1,11.3,12.1c1.2,0,4.6-0.6,4.6-4.2c0-3.6-3.3-3.7-4.6-3.7c-2.3-0.3-3.3-3.5-3.5-4.9
				c16.9-4.1,16.2-17.5,16.2-17.5v-14.3c3.8,0,4.1-3.7,4.1-3.7s0-0.4,0-4.2S-121.3,188.2-121.3,188.2z M-140.3,224.7
				c-11.2,0-57.8,0-57.8,0S-210,224.8-210,213s0-12.5,0-12.5h80.6v13.3C-129.3,213.8-129.2,224.7-140.3,224.7z"/>
			<circle fill="#878c92" cx="-157.8" cy="168.4" r="2.2"/>
			<circle fill="#878c92" cx="-159.6" cy="176.1" r="2.6"/>
			<circle fill="#878c92" cx="-161.5" cy="183.6" r="2.8"/>
			<circle fill="#878c92" cx="-141.1" cy="168.4" r="2.2"/>
			<circle fill="#878c92" cx="-149.4" cy="168.4" r="2.2"/>
			<circle fill="#878c92" cx="-139.2" cy="176.1" r="2.6"/>
			<circle fill="#878c92" cx="-149.5" cy="176.1" r="2.6"/>
			<circle fill="#878c92" cx="-137.3" cy="183.6" r="2.8"/>
			<circle fill="#878c92" cx="-149.2" cy="183.6" r="2.8"/>
		</g>
	</svg>
<?php }

/*-----------------------------------------------------------------------------------*/
/* Listing Size SVG Icon */
/*-----------------------------------------------------------------------------------*/

function ct_listing_size_icon() { ?>
	<svg class="muted" style="width: 17px;" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
	<style type="text/css">
		.st0{fill:#878C92;stroke:#878C92;stroke-width:36;stroke-miterlimit:10;}
	</style>
	<path class="st0" d="M492.1,10H19.9c-5.5,0-9.9,4.4-9.9,9.9v472.2c0,5.5,4.4,9.9,9.9,9.9h288c5.5,0,9.9-4.4,9.9-9.9
		s-4.4-9.9-9.9-9.9H29.8V251.8h137.9v94.8c0,5.5,4.4,9.9,9.9,9.9c5.5,0,9.9-4.4,9.9-9.9v-207c0-5.5-4.4-9.9-9.9-9.9
		c-5.5,0-9.9,4.4-9.9,9.9V232H29.8V29.8H298v123.8c0,5.5,4.4,9.9,9.9,9.9h104.5c5.5,0,9.9-4.4,9.9-9.9s-4.4-9.9-9.9-9.9h-94.7V29.8
		h164.4v306.9H307.9c-5.5,0-9.9,4.4-9.9,9.9s4.4,9.9,9.9,9.9h174.3v125.8h-69.8c-5.5,0-9.9,4.4-9.9,9.9s4.4,9.9,9.9,9.9h79.7
		c5.5,0,9.9-4.4,9.9-9.9V19.9C502,14.4,497.6,10,492.1,10z"/>
	</svg>
<?php }

/*-----------------------------------------------------------------------------------*/
/* Listing Property Info */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_propinfo')) {
	function ct_propinfo() {
	    global $post;
	    global $wp_query;
	    global $ct_options;

	    $ct_use_propinfo_icons = isset( $ct_options['ct_use_propinfo_icons'] ) ? esc_html( $ct_options['ct_use_propinfo_icons'] ) : '';
	    $ct_listings_propinfo_property_type = isset( $ct_options['ct_listings_propinfo_property_type'] ) ? esc_html( $ct_options['ct_listings_propinfo_property_type'] ) : '';
	    $ct_listings_propinfo_price_per = isset( $ct_options['ct_listings_propinfo_price_per'] ) ? esc_html( $ct_options['ct_listings_propinfo_price_per'] ) : '';
	    $ct_bed_beds_or_bedrooms = isset( $ct_options['ct_bed_beds_or_bedrooms'] ) ? esc_html( $ct_options['ct_bed_beds_or_bedrooms'] ) : '';
	    $ct_bath_baths_or_bathrooms = isset( $ct_options['ct_bath_baths_or_bathrooms'] ) ? esc_html( $ct_options['ct_bath_baths_or_bathrooms'] ) : '';
	    $ct_listings_lotsize_format = isset( $ct_options['ct_listings_lotsize_format'] ) ? esc_html( $ct_options['ct_listings_lotsize_format'] ) : '';

	    $ct_property_type = strip_tags( get_the_term_list( $wp_query->post->ID, 'property_type', '', ', ', '' ) );
	    $beds = strip_tags( get_the_term_list( $wp_query->post->ID, 'beds', '', ', ', '' ) );
	    $baths = strip_tags( get_the_term_list( $wp_query->post->ID, 'baths', '', ', ', '' ) );
	    $ct_community = strip_tags( get_the_term_list( $wp_query->post->ID, 'community', '', ', ', '' ) );
	    
	    $ct_walkscore = isset( $ct_options['ct_enable_walkscore'] ) ? esc_html( $ct_options['ct_enable_walkscore'] ) : '';
	    $ct_rentals_booking = isset( $ct_options['ct_rentals_booking'] ) ? esc_html( $ct_options['ct_rentals_booking'] ) : '';
	    $ct_listing_reviews = isset( $ct_options['ct_listing_reviews'] ) ? esc_html( $ct_options['ct_listing_reviews'] ) : '';

	    if($ct_walkscore == 'yes') {
		    /* Walk Score */
		   	$latlong = get_post_meta($post->ID, "_ct_latlng", true);
		   	$ct_trans_name = uniqid('ct_');

		   	if($latlong != '' && false === ( $ct_ws = get_transient( $ct_trans_name . '_walkscore_data' ) )) {
				list($lat, $long) = explode(',',$latlong,2);
				$address = get_the_title() . ct_taxonomy_return('city') . ct_taxonomy_return('state') . ct_taxonomy_return('zipcode');
				$json = ct_get_walkscore($lat,$long,$address);

				$ct_ws = json_decode($json, true);		

				set_transient( $ct_trans_name . '_walkscore_data', $ct_ws, 7 * DAY_IN_SECONDS );
			}
		}

	    if(ct_has_type('commercial') || ct_has_type('lot') || ct_has_type('land')) { 
	        // Dont Display Bed/Bath
	    } else {
	    	if(!empty($beds)) {
		    	echo '<li class="row beds">';
		    		echo '<span class="muted left">';
		    			if($ct_use_propinfo_icons != 'icons') {
		    				if($ct_bed_beds_or_bedrooms == 'rooms') {
				    			_e('Rooms', 'contempo');
				    		} elseif($ct_bed_beds_or_bedrooms == 'bedrooms') {
				    			_e('Bedrooms', 'contempo');
				    		} elseif($ct_bed_beds_or_bedrooms == 'beds') {
				    			_e('Beds', 'contempo');
					    	} else {
					    		_e('Bed', 'contempo');
					    	}
			    		} else {
			    			echo '<i class="fa fa-bed"></i>';
			    		}
		    		echo '</span>';
		    		echo '<span class="right">';
		               echo esc_html($beds);
		            echo '</span>';
		        echo '</li>';
		    }	
		    if(!empty($baths)) {
		        echo '<li class="row baths">';
		            echo '<span class="muted left">';
		    			if($ct_use_propinfo_icons != 'icons') {
			    			if($ct_bath_baths_or_bathrooms == 'bathrooms') {
				    			_e('Bathrooms', 'contempo');
				    		} elseif($ct_bath_baths_or_bathrooms == 'baths') {
				    			_e('Baths', 'contempo');
				    		} else {
					    		_e('Bath', 'contempo');
					    	}
			    		} else {
			    			echo '<i class="fa fa-bath"></i>';
			    		}
		    		echo '</span>';
		    		echo '<span class="right">';
		               echo esc_html($baths);
		            echo '</span>';
		        echo '</li>';
		    }
	    }
	    
	    if(get_post_meta($post->ID, "_ct_pets", true)) {
		    echo '<li class="row pets">';
				echo '<span class="muted left">';
					if($ct_use_propinfo_icons != 'icons') {
		    			_e('Pets', 'contempo');
		    		} else {
		    			echo '<i class="fa fa-paw"></i>';
		    		}
				echo '</span>';
				echo '<span class="right">';
					echo get_post_meta($post->ID, "_ct_pets", true);
		        echo '</span>';
		    echo '</li>';
		}

		if(get_post_meta($post->ID, "_ct_parking", true)) {
		    echo '<li class="row parking">';
				echo '<span class="muted left">';
					if($ct_use_propinfo_icons != 'icons') {
		    			_e('Parking', 'contempo');
		    		} else {
		    			echo '<i class="fa fa-car"></i>';
		    		}
				echo '</span>';
				echo '<span class="right">';
					echo get_post_meta($post->ID, "_ct_parking", true);
		        echo '</span>';
		    echo '</li>';
		}

		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		if(function_exists('pixreviews_init_plugin') && $ct_listing_reviews == 'yes') {
			global $pixreviews_plugin;
			$ct_rating_avg = $pixreviews_plugin->get_average_rating();
			if($ct_rating_avg != '') {
				echo '<li class="row rating">';
		            echo '<span class="muted left">';
		                if($ct_use_propinfo_icons != 'icons') {
			    			_e('Rating', 'contempo');
			    		} else {
			    			echo '<i class="fa fa-star"></i>';
			    		}
		            echo '</span>';
		            echo '<span class="right">';
		                 echo esc_html($pixreviews_plugin->get_average_rating());
		            echo '</span>';
		        echo '</li>';
		    }
		}

	    if($ct_rentals_booking == 'yes' || class_exists('Booking_Calendar')) {
		    if(get_post_meta($post->ID, "_ct_rental_guests", true)) {
		        echo '<li class="row guests">';
		            echo '<span class="muted left">';
		                if($ct_use_propinfo_icons != 'icons') {
			    			_e('Guests', 'contempo');
			    		} else {
			    			echo '<i class="fa fa-group"></i>';
			    		}
		            echo '</span>';
		            echo '<span class="right">';
		                 echo get_post_meta($post->ID, "_ct_rental_guests", true);
		            echo '</span>';
		        echo '</li>';
		    }

		    if(get_post_meta($post->ID, "_ct_rental_min_stay", true)) {
		        echo '<li class="row min-stay">';
		            echo '<span class="muted left">';
		                if($ct_use_propinfo_icons != 'icons') {
			    			_e('Min Stay', 'contempo');
			    		} else {
			    			echo '<i class="fa fa-calendar"></i>';
			    		}
		            echo '</span>';
		            echo '<span class="right">';
		                 echo get_post_meta($post->ID, "_ct_rental_min_stay", true);
		            echo '</span>';
		        echo '</li>';
		    }
		}
	    
	    if(get_post_meta($post->ID, "_ct_sqft", true)) {
	    	if($ct_use_propinfo_icons != 'icons') {
		        echo '<li class="row sqft">';
		            echo '<span class="muted left">';
		    			ct_sqftsqm();
		    		echo '</span>';
					echo '<span class="right">';
						 $value = get_post_meta($post->ID, "_ct_sqft", true);
						 if(is_numeric($value)) {
							 echo number_format_i18n($value, 0);
						 } else {
						 	echo esc_html($value);
						 }
		            echo '</span>';
		        echo '</li>';
		    } else {
		    	echo '<li class="row sqft">';
		            echo '<span class="muted left">';
			            echo '<i class="fa fa-ruler-combined"></i>';
		    		echo '</span>';
		    		echo '<span class="right">';
		                 echo number_format_i18n(get_post_meta($post->ID, "_ct_sqft", true), 0);
		                 echo ' ' . ct_sqftsqm();
		            echo '</span>';
		        echo '</li>';
		    }
	    }

	    $price_meta = get_post_meta(get_the_ID(), '_ct_price', true);
		$price_meta= preg_replace('/[\$,]/', '', $price_meta);

		$ct_sqft = get_post_meta(get_the_ID(), '_ct_sqft', true);

	    if(has_term('for-rent', 'ct_status') || has_term('rental', 'ct_status') || has_term('leased', 'ct_status') || has_term('lease', 'ct_status') || has_term('let', 'ct_status') || has_term('sold', 'ct_status')) {
	    	// Do Nothing
	    } elseif($ct_listings_propinfo_price_per != 'yes' && !empty($price_meta) && !empty($ct_sqft)) {
		    echo '<li class="row price-per">';
				echo '<span class="muted left">';
					_e('Price Per', 'contempo');
					ct_sqftsqm();
				echo '</span>';
				echo '<span class="right">';
					ct_listing_price_per_sqft();
		        echo '</span>';
		    echo '</li>';
		}
	    
	    if(get_post_meta($post->ID, "_ct_lotsize", true)) {
	        if(get_post_meta($post->ID, "_ct_lotsize", true)) {
	            echo '<li class="row lotsize">';
	        }
	            echo '<span class="muted left">';
	    			if($ct_use_propinfo_icons != 'icons') {
		    			_e('Lot Size', 'contempo');
		    		} else {
		    			echo '<i class="fa fa-arrows-alt"></i>';
		    		}
	    		echo '</span>';
	    		echo '<span class="right">';
	    			if($ct_listings_lotsize_format == 'yes') {
		                 echo number_format_i18n(get_post_meta($post->ID, "_ct_lotsize", true), 0) . ' ';
		            } else {
		             	echo get_post_meta($post->ID, "_ct_lotsize", true) . ' ';
		            }
	                ct_acres();
	            echo '</span>';
	            
	        if((get_post_meta($post->ID, "_ct_lotsize", true))) {
	            echo '</li>';
	        }
	    }

	    if($ct_walkscore == 'yes' && $ct_ws['status'] == 1) {
			echo '<li class="row walkscore">';
	            echo '<span class="muted left">';
	                if($ct_use_propinfo_icons != 'icons') {
		    			_e('Walk Score&reg;', 'contempo');
		    		}
	            echo '</span>';
	            echo '<span class="right" data-tooltip="' . $ct_ws['description'] . '">';
					echo '<a href="' . $ct_ws['ws_link'] . '" target="_blank">';
						echo esc_html($ct_ws['walkscore']);
					echo '</a>';
	            echo '</span>';
	        echo '</li>';
		}

		if(!empty($ct_community)) {
	    	echo '<li class="row community">';
	    		echo '<span class="muted left">';
	    			if($ct_use_propinfo_icons != 'icons') {
		    			ct_community_neighborhood_or_district();
		    		} else {
		    			echo '<i class="fa fa-users"></i>';
		    		}
	    		echo '</span>';
	    		echo '<span class="right">';
	               echo esc_html($ct_community);
	            echo '</span>';
	        echo '</li>';
	    }

	    if(!empty($ct_property_type) && $ct_listings_propinfo_property_type != 'yes') {
	        echo '<li class="row property-type">';
	            echo '<span class="muted left">';
	    			if($ct_use_propinfo_icons != 'icons') {
		    			_e('Type', 'contempo');
		    		} else {
		    			if(ct_has_type('commercial')) { 
							echo '<i class="fa fa-building-o"></i>';
						} elseif(ct_has_type('land') || ct_has_type('lot')) { 
							echo '<i class="fa fa-tree"></i>';
						} else {
							echo '<i class="fa fa-home"></i>';
						}
		    		}
	    		echo '</span>';
	    		echo '<span class="right">';
	               echo esc_html($ct_property_type);
	            echo '</span>';
	        echo '</li>';
	    }
	}
}

/*-----------------------------------------------------------------------------------*/
/* Listing Rental Info */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_rental_info')) {
	function ct_rental_info() {
		global $post;
		if(get_post_meta($post->ID, "_ct_rental_checkin", true)) {
	        echo '<li class="row rental-checkin">';
	            echo '<span class="muted left"><strong>';
	                esc_html_e('Check In', 'contempo');
	            echo '</strong></span>';
	            echo '<span class="right">';
		            $checkin = get_post_meta(get_the_ID(), '_ct_rental_checkin', true);
		            echo date("g:i A", strtotime($checkin));
	            echo '</span>';
	        echo '</li>';
	    }
	    if(get_post_meta($post->ID, "_ct_rental_checkout", true)) {
	        echo '<li class="row rental-checkout">';
	            echo '<span class="muted left"><strong>';
	                esc_html_e('Check Out', 'contempo');
	            echo '</strong></span>';
	            echo '<span class="right">';
	            	$checkout = get_post_meta(get_the_ID(), '_ct_rental_checkout', true);
		            echo date("g:i A", strtotime($checkout));
	            echo '</span>';
	        echo '</li>';
	    }
	    if(get_post_meta($post->ID, "_ct_rental_guests", true)) {
	        echo '<li class="row rental-max-guests">';
	            echo '<span class="muted left"><strong>';
	                esc_html_e('Max Guests', 'contempo');
	            echo '</strong></span>';
	            echo '<span class="right">';
	            	$ct_rental_guests = get_post_meta(get_the_ID(), '_ct_rental_guests', true);
		            echo esc_html($ct_rental_guests);
	            echo '</span>';
	        echo '</li>';
	    }
	    if(get_post_meta($post->ID, "_ct_rental_min_stay", true)) {
	        echo '<li class="row rental-min-stay">';
	            echo '<span class="muted left"><strong>';
	                esc_html_e('Min Stay', 'contempo');
	            echo '</strong></span>';
	            echo '<span class="right">';
	            	$ct_rental_min_stay = get_post_meta(get_the_ID(), '_ct_rental_min_stay', true);
		            echo esc_html($ct_rental_min_stay);
	            echo '</span>';
	        echo '</li>';
	    }
	}
}

/*-----------------------------------------------------------------------------------*/
/* Listing Rental Costs */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_rental_costs')) {
	function ct_rental_costs() {
		global $post;
		if((get_post_meta($post->ID, "_ct_rental_extra_people", true))) {
	        echo '<li class="row rental-cancel">';
	            echo '<span class="muted left">';
	                esc_html_e('Extra People', 'contempo');
	            echo '</span>';
	            echo '<span class="right">';
	                ct_currency();
	                echo get_post_meta($post->ID, "_ct_rental_extra_people", true);
	            echo '</span>';
	        echo '</li>';
	    }
	    if((get_post_meta($post->ID, "_ct_rental_cleaning", true))) {
	        echo '<li class="row cleaning-fee">';
	            echo '<span class="muted left">';
	                esc_html_e('Cleaning Fee', 'contempo');
	            echo '</span>';
	            echo '<span class="right">';
	                ct_currency();
	                echo get_post_meta($post->ID, "_ct_rental_cleaning", true);
	            echo '</span>';
	        echo '</li>';
	    }
	    if((get_post_meta($post->ID, "_ct_rental_cancellation", true))) {
	        echo '<li class="row cleaning-fee">';
	            echo '<span class="muted left">';
	                esc_html_e('Cancellation Fee', 'contempo');
	            echo '</span>';
	            echo '<span class="right">';
	                ct_currency();
	                echo get_post_meta($post->ID, "_ct_rental_cancellation", true);
	            echo '</span>';
	        echo '</li>';
	    } 
	    if((get_post_meta($post->ID, "_ct_rental_deposit", true))) {
	        echo '<li class="row rental-deposit">';
	            echo '<span class="muted left">';
	                esc_html_e('Security Deposit', 'contempo');
	            echo '</span>';
	            echo '<span class="right">';
		            ct_currency();
	                echo get_post_meta($post->ID, "_ct_rental_deposit", true);
	            echo '</span>';
	        echo '</li>';
	    }
	}
}

/*-----------------------------------------------------------------------------------*/
/* Brokerage Address */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_brokerage_address')) {
	function ct_brokerage_address($postID) {

		global $post;

		$brokerage = new WP_Query(array(
            'post_type' => 'brokerage',
            'p' => $postID,
            'nopaging' => true
        ));

        if ( $brokerage->have_posts() ) : while ( $brokerage->have_posts() ) : $brokerage->the_post();

        $ct_brokerage_street_address = get_post_meta($post->ID, "_ct_brokerage_street_address", true);
		$ct_brokerage_address_two = get_post_meta($post->ID, "_ct_brokerage_address_two", true);
		$ct_brokerage_city = get_post_meta($post->ID, "_ct_brokerage_city", true);
		$ct_brokerage_state = get_post_meta($post->ID, "_ct_brokerage_state", true);
		$ct_brokerage_zip = get_post_meta($post->ID, "_ct_brokerage_zip", true);
		$ct_brokerage_country = get_post_meta($post->ID, "_ct_brokerage_country", true);

        ?>
            <?php 
            	if($ct_brokerage_street_address != '') {
		            echo esc_html($ct_brokerage_street_address) . ', ';
		        }
		        if($ct_brokerage_address_two != '') {
		            echo esc_html($ct_brokerage_address_two) . ', ';
		        }
		        if($ct_brokerage_city != '') {
		            echo esc_html($ct_brokerage_city) . ', ';
		        }
		        if($ct_brokerage_state != '') {
		            echo esc_html($ct_brokerage_state) . ', ';
		        }
		        if($ct_brokerage_zip != '') {
		            echo esc_html($ct_brokerage_zip) . ' ';
		        }
		        if($ct_brokerage_country != '') {
		            echo esc_html($ct_brokerage_country);
		        }
            ?>
        <?php endwhile; endif; wp_reset_postdata();

	}
}

/*-----------------------------------------------------------------------------------*/
/* Listing Creation Date */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_listing_grid_agent_info')) {
	function ct_listing_grid_agent_info() {

		global $ct_options, $post;

		$author_id = get_the_author_meta('ID');
        $first_name = get_the_author_meta('first_name');
        $last_name = get_the_author_meta('last_name');

        $ct_listing_agent_contact_logged_in = isset( $ct_options['ct_listing_agent_contact_logged_in'] ) ? $ct_options['ct_listing_agent_contact_logged_in'] : '';
        $ct_listing_agent_grid_information = isset( $ct_options['ct_listing_agent_grid_information'] ) ? $ct_options['ct_listing_agent_grid_information'] : '';
		
		if($ct_listing_agent_grid_information == 'yes') {
	        echo '<div class="grid-agent-info col span_12 first">';
		        
		        echo '<div class="left">';
			        if($ct_listing_agent_contact_logged_in == 'yes') {
			        	if(!is_user_logged_in()) {
				            echo '<p class="marB0">' . esc_html($first_name) . ' ' . esc_html($last_name) . '</p>';
				        } else {
				        	echo '<p class="marB0"><a href="' . get_author_posts_url($author_id) . '">' . esc_html($first_name) . ' ' . esc_html($last_name) . '</a></p>';
				        }
				    } else {
				    	echo '<p class="marB0"><a href="' . get_author_posts_url($author_id) . '">' . esc_html($first_name) . ' ' . esc_html($last_name) . '</a></p>';
				    }
		        echo '</div>';
		        echo '<div class="right">';
			        echo '<figure class="grid-agent-image">';
			        	if($ct_listing_agent_contact_logged_in == 'yes') {
				        	if(!is_user_logged_in()) {
				               if(get_the_author_meta('ct_profile_url')) {  
				                    echo '<img src="';
				                        echo the_author_meta('ct_profile_url');
				                    echo '" />';
				                } else {
				                    echo '<img src="' . get_template_directory_uri() . '/images/user-default.png' . '" />';
				                }
					        } else {
					        	echo '<a href="' . get_author_posts_url($author_id) . '">';
					               if(get_the_author_meta('ct_profile_url')) {  
					                    echo '<img src="';
					                        echo the_author_meta('ct_profile_url');
					                    echo '" />';
					                } else {
					                    echo '<img src="' . get_template_directory_uri() . '/images/user-default.png' . '" />';
					                }
					            echo '</a>';
					        }
					    } else {
					    	echo '<a href="' . get_author_posts_url($author_id) . '">';
				               if(get_the_author_meta('ct_profile_url')) {  
				                    echo '<img src="';
				                        echo the_author_meta('ct_profile_url');
				                    echo '" />';
				                } else {
				                    echo '<img src="' . get_template_directory_uri() . '/images/user-default.png' . '" />';
				                }
				            echo '</a>';
					    }
			        echo '</figure>';
			    echo '</div>';

		    echo '</div>';
		}
    }
}

/*-----------------------------------------------------------------------------------*/
/* Listing Creation Date */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_listing_creation_date')) {
	function ct_listing_creation_date() {
		global $ct_options, $post;

		$ct_listing_creation_date = isset( $ct_options['ct_listing_creation_date'] ) ? $ct_options['ct_listing_creation_date'] : '';

		if($ct_listing_creation_date == 'yes') {
			echo '<div class="creation-date col span_12 first">';
				echo '<span class="left muted">';
					echo '<i class="fa fa-calendar"></i>';
				echo '</span>';
				echo '<span class="right">';
					printf( __( '%s ago', 'contempo' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );
				echo '</span>';
					echo '<div class="clear"></div>';
			echo '</div>';
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Listing Updated Time */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_listing_updated_time')) {
	function ct_listing_updated_time() {
		global $ct_options, $post;
		$ct_listing_updated_time = isset( $ct_options['ct_listing_updated_time'] ) ? $ct_options['ct_listing_updated_time'] : '';

		if($ct_listing_updated_time == 'yes') {

			echo '<p class="listing-updated muted">';
				echo __( 'Updated on', 'contempo' ) . ' ';
					the_modified_time('F j, Y');
				echo ' ' . __( 'at', 'contempo' ) . ' ';
					the_modified_time('g:i a');
			echo '</p>';

		}	
	}
}

/*-----------------------------------------------------------------------------------*/
/* Open House */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_upcoming_open_house')) {
	function ct_upcoming_open_house() {
		global $ct_options, $post;
		$ct_listing_upcoming_open_house = isset( $ct_options['ct_listing_upcoming_open_house'] ) ? $ct_options['ct_listing_upcoming_open_house'] : '';

		if($ct_listing_upcoming_open_house != 'no') {

			$ct_open_house_entries = get_post_meta( get_the_ID(), '_ct_open_house', true );
			$ct_todays_date = date("mdY");

			foreach ( (array) $ct_open_house_entries as $key => $entry ) {
			    $ct_open_house_date = '';
			    if ( isset( $entry['_ct_open_house_date'] ) )
			        $ct_open_house_date = esc_html( $entry['_ct_open_house_date'] );
			}

			if($ct_open_house_entries != '' && $ct_open_house_date != '') {

				foreach ( (array) $ct_open_house_entries as $key => $entry ) {
					
					reset($ct_open_house_entries);

					$ct_open_house_date = $ct_open_house_start_time = $ct_open_house_end_time = '';

		            if ( isset( $entry['_ct_open_house_date'] ) )
		                $ct_open_house_date = esc_html( $entry['_ct_open_house_date'] );
			            $ct_open_house_date_formatted = strftime('%m%d%Y', $ct_open_house_date);

		            if ( isset( $entry['_ct_open_house_start_time'] ) )
		                $ct_open_house_start_time = esc_html( $entry['_ct_open_house_start_time'] );

		            if ( isset( $entry['_ct_open_house_end_time'] ) )
		                $ct_open_house_end_time = esc_html( $entry['_ct_open_house_end_time'] );

					if($ct_open_house_date_formatted >= $ct_todays_date) {
						echo '<div class="upcoming-open-house">';

							echo '<span class="left muted">';
								_e('Open House', 'contempo');
							echo '</span>';

							echo '<span class="right">';

				                if($ct_open_house_date != '') {
				                    echo strftime('%b %e', $ct_open_house_date);
				                }

				                if($ct_open_house_start_time != '') {
		                            echo ', ' . $ct_open_house_start_time;  
		                        }
		                        if($ct_open_house_end_time != '') {
		                            echo ' - ';
		                            echo esc_html($ct_open_house_end_time);  
		                        }

							echo '</span>';

								echo '<div class="clear"></div>';

						echo '</div>';

						end($ct_open_house_entries);
					    if($key === key($ct_open_house_entries)) {

							echo '<div class="upcoming-open-house hosted-by">';

	                            echo '<span class="muted left">';
	                                _e('Hosted By', 'contempo');
	                            echo '</span>';

	                            echo '<span class="right">';
	                                $first_name = get_the_author_meta('first_name');
	                                $last_name = get_the_author_meta('last_name');
	                                $mobile = get_the_author_meta('mobile');
	                                echo esc_html($first_name) . ' ' . esc_html($last_name) . ' ' . esc_html($mobile);
	                            echo '</span>';

	                                echo '<div class="clear"></div>';

	                        echo '</div>';
	                    }

					}

				}

			}

		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Broker Info */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_brokered_by')) {
	function ct_brokered_by() {
		global $ct_options, $post;
		$ct_listing_brokerage_name = isset( $ct_options['ct_listing_brokerage_name'] ) ? $ct_options['ct_listing_brokerage_name'] : '';
		$ct_user_meta_brokerage = get_the_author_meta( 'brokerage' );
		$ct_cpt_brokerage = get_post_meta( get_the_ID(), '_ct_brokerage', true );

		if($ct_listing_brokerage_name == 'yes' && $ct_cpt_brokerage != 0) {

			$brokerage = new WP_Query(array(
	            'post_type' => 'brokerage',
	            'p' => $ct_cpt_brokerage,
	            'nopaging' => true
	        ));

	        if ( $brokerage->have_posts() ) : while ( $brokerage->have_posts() ) : $brokerage->the_post(); ?>
	            <?php 
		            $ct_brokerage_permalink = get_permalink();
	            	$ct_brokerage_name = strtolower(get_the_title());
	            ?>
	        <?php endwhile; endif; wp_reset_postdata();

			?>

			<div class="brokerage col span_12 first">
				<p class="muted marB0">
					<small>
					<?php if(get_post_meta($post->ID, "source", true) == 'idx-api') { 
						_e('Listing Courtesy of', 'contempo');
					} else {
						_e('Brokered by', 'contempo');
					} ?>
					</small>
				</p>
				<?php if(get_post_meta($post->ID, "source", true) == 'idx-api') { ?>
					<p class="marB0"><?php echo ucwords($ct_brokerage_name); ?></p>
				<?php } else { ?>
					<p class="marB0"><a href="<?php echo esc_url($ct_brokerage_permalink); ?>"><?php echo ucwords($ct_brokerage_name); ?></a></p>
				<?php } ?>
			</div>
		<?php } elseif($ct_listing_brokerage_name == 'yes' && $ct_user_meta_brokerage != '') { ?>
			<div class="brokerage col span_12 first">
				<p class="muted marB0">
					<small>
						<?php if(get_post_meta($post->ID, "source", true) == 'idx-api') { 
							_e('Listing Courtesy of', 'contempo');
						} else {
							_e('Brokered by', 'contempo');
						} ?>
					</small>
				</p>
				<p class="marB0"><?php ucwords(the_author_meta( 'brokerage' )); ?></p>
			</div>
		<?php }
	}
}

/*-----------------------------------------------------------------------------------*/
/* Display Brokerage Logo */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_brokerage_logo')) {
	function ct_brokerage_logo($postID) {

		$brokerage = new WP_Query(array(
            'post_type' => 'brokerage',
            'p' => $postID,
            'nopaging' => true
        ));

        if ( $brokerage->have_posts() ) : while ( $brokerage->have_posts() ) : $brokerage->the_post(); ?>
            <?php if(has_post_thumbnail()) {
                the_post_thumbnail('thumb');
            } ?>
        <?php endwhile; endif; wp_reset_postdata();

	}
}

/*-----------------------------------------------------------------------------------*/
/* Display Brokerage Name */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_brokerage_name')) {
	function ct_brokerage_name($postID) {

		$brokerage = new WP_Query(array(
            'post_type' => 'brokerage',
            'p' => $postID,
            'nopaging' => true
        ));

        if ( $brokerage->have_posts() ) : while ( $brokerage->have_posts() ) : $brokerage->the_post(); ?>
            <?php the_title(); ?>
        <?php endwhile; endif; wp_reset_postdata();

	}
}

/*-----------------------------------------------------------------------------------*/
/* Status Snipes */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_has_status')) {
	function ct_has_status( $status, $_post = null ) {
		if ( empty( $status ) )
			return false;

		if ( $_post )
			$_post = get_post( $_post );
		else
			$_post =& $GLOBALS['post'];

		if ( !$_post )
			return false;

		$r = is_object_in_term( $_post->ID, 'ct_status', $status );

		if ( is_wp_error( $r ) )
			return false;

		return $r;
	}
}

if(!function_exists('ct_status_slug')) {
	function ct_status_slug() {

		global $post;
		global $wp_query;

		$status_terms = strip_tags( get_modified_term_list_slug( $wp_query->post->ID, 'ct_status', '', ' ', '', array('featured') ) );

		if ( ! empty( $status_terms ) && ! is_wp_error( $status_terms ) ){
		    echo esc_html($status_terms) . ' ';
		 }
	}
}

if(!function_exists('ct_status')) {
	function ct_status() {

		global $post;
		global $wp_query;

		$status_tags = strip_tags( get_modified_term_list_name( $wp_query->post->ID, 'ct_status', '', ' ', '', array('featured') ) );
		$status_tags_stripped = str_replace('_', ' ', $status_tags);
		$status_tags_stripped = str_replace('-', ' ', $status_tags_stripped);
		
		if($status_tags != '') {
			echo '<h6 class="snipe status ';
					ct_status_slug();
				echo '">';
				echo '<span>';
					echo ucwords($status_tags_stripped);
				echo '</span>';
			echo '</h6>';
		}
	}
}

if(!function_exists('ct_status_featured')) {
	function ct_status_featured() {

		global $post;
		global $wp_query;

		if(has_term( 'featured', 'ct_status' ) ) {
			echo '<h6 class="snipe featured">';
				echo '<span>';
					echo __('Featured', 'contempo');
				echo '</span>';
			echo '</h6>';
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Property Type Icon */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_property_type_icon')) {
	function ct_property_type_icon() {
		global $post;

		if(ct_has_type('commercial')) { 
			echo '<span class="prop-type-icon"><i class="fa fa-building-o"></i></span>';
		} elseif(ct_has_type('land') || ct_has_type('lot')) { 
			echo '<span class="prop-type-icon"><i class="fa fa-tree"></i></span>';
		} else {
			echo '<span class="prop-type-icon"><i class="fa fa-home"></i></span>';
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Currency */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_currency')) {
	function ct_currency( $echo=true ) {
		global $ct_options;
		$currency = "$";

		if($ct_options['ct_currency']) {
			$currency = esc_html($ct_options['ct_currency']);
		}

		if($echo) {
			echo esc_html($currency);
		} else {
			return $currency;
		}
		
	}
}

/*-----------------------------------------------------------------------------------*/
/* Listing Price */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_listing_price')) {
	function ct_listing_price( $echo=true ) {
		global $post;
		global $ct_options;

		$price = "";

		$var_attCurrencyName = htmlspecialchars("data-currencyname='BRL' data-value=''");

		$ct_currency_placement = $ct_options['ct_currency_placement'];
		$ct_currency_decimal = isset( $ct_options['ct_currency_decimal'] ) ? esc_attr( $ct_options['ct_currency_decimal'] ) : '';
		
		$price_prefix = get_post_meta(get_the_ID(), '_ct_price_prefix', true);
		$price_postfix = get_post_meta(get_the_ID(), '_ct_price_postfix', true);

		$price_meta = get_post_meta(get_the_ID(), '_ct_price', true);
		$price_meta = preg_replace('/[\$,]/', '', $price_meta);

		$ct_display_listing_price = get_post_meta(get_the_ID(), '_ct_display_listing_price', true);

		if($ct_currency_placement == 'after') {
			if(!empty($price_prefix)) {
				$price = $price. "<span class='listing-price-prefix currency'$var_attCurrencyName]>";
				$price = $price. esc_html($price_prefix) . ' ';
				$price = $price. '</span>';
			}
			if(!empty($price_meta) && $ct_display_listing_price != 'no') {
				$price = $price. "<span class='listing-price currency' $var_attCurrencyName>";
				$price = $price. number_format_i18n($price_meta, $ct_currency_decimal);
				$price = $price.ct_currency( false );
				$price = $price. '</span>';
			} 
			if(!empty($price_postfix)) {
				$price = $price. "<span class='listing-price-postfix currency' $var_attCurrencyName>";
				$price = $price.  ' ' . esc_html($price_postfix);
				$price = $price. '</span>';
			}
		} else {
			if(!empty($price_prefix)) {
				$price = $price. "<span class='listing-price-prefix currency' $var_attCurrencyName>";
				$price = $price. esc_html($price_prefix) . ' ';
				$price = $price. '</span>';
			}
			if(!empty($price_meta) && $ct_display_listing_price != 'no') {
				$price = $price. "<span class='listing-price currency'$var_attCurrencyName>";
				$price = $price.ct_currency( false );
					$price = $price. number_format_i18n($price_meta, $ct_currency_decimal);
					$price = $price. '</span>';
			}
			if(!empty($price_postfix)) {
				$price = $price. "<span class='listing-price-postfix currency' $var_attCurrencyName>";
				$price = $price.  ' ' . esc_html($price_postfix);
				$price = $price. '</span>';
			}
		}

		if($echo) {
			echo $price;
		} else {
			return $price;
		}

	}
}

/*-----------------------------------------------------------------------------------*/
/* Listing Price Per Sq Ft/Meter */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_listing_price_per_sqft')) {
	function ct_listing_price_per_sqft() {
		global $post;
		global $ct_options;

		$ct_currency_placement = $ct_options['ct_currency_placement'];
		$ct_currency_decimal = isset( $ct_options['ct_currency_decimal'] ) ? esc_attr( $ct_options['ct_currency_decimal'] ) : '';

		$price_meta = get_post_meta(get_the_ID(), '_ct_price', true);
		$price_meta= preg_replace('/[\$,]/', '', $price_meta);

		$ct_sqft = get_post_meta(get_the_ID(), '_ct_sqft', true);
		
		if(!empty($price_meta) && !empty($ct_sqft)) {
			$ct_price_per_sqft = $price_meta / $ct_sqft;
		
			if($ct_currency_placement == 'after') {
				echo number_format_i18n($ct_price_per_sqft, 2);
				ct_currency();
			} else {
				ct_currency();
				echo number_format_i18n($ct_price_per_sqft, 2);
			}
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Sq Ft or Sq Meters */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_sqftsqm')) {
	function ct_sqftsqm() {
		global $ct_options;
		if($ct_options['ct_sq'] == "sqft") {
			_e(' Sq Ft', 'contempo');
		} else if($ct_options['ct_sq'] == "sqmeters") {
			_e(' m²', 'contempo');
		} else if($ct_options['ct_sq'] == "area") {
			_e('Area', 'contempo');
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Acres or Sq Meters */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_acres')) {
	function ct_acres() {
		global $ct_options;
		if($ct_options['ct_acres'] == "acres") {
			_e('Acres', 'contempo');
		} elseif($ct_options['ct_acres'] == "sqft") {
			_e('Sq Ft', 'contempo');
		} elseif($ct_options['ct_acres'] == "sqmeters") {
			_e('m²', 'contempo');
		} elseif($ct_options['ct_acres'] == "area") {
			_e('Area', 'contempo');
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Bed, Beds, Bedrooms or Rooms */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_bed_beds_or_bedrooms')) {
	function ct_bed_beds_or_bedrooms() {
		global $ct_options;
		$ct_bed_beds_or_bedrooms = isset( $ct_options['ct_bed_beds_or_bedrooms'] ) ? $ct_options['ct_bed_beds_or_bedrooms'] : '';

        if($ct_bed_beds_or_bedrooms == 'rooms') {
			_e('Rooms', 'contempo');
		} elseif($ct_bed_beds_or_bedrooms == 'bedrooms') {
			_e('Bedrooms', 'contempo');
		} elseif($ct_bed_beds_or_bedrooms == 'beds') {
			_e('Beds', 'contempo');
    	} else {
    		_e('Bed', 'contempo');
    	}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Bath, Baths or Bathrooms */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_bath_baths_or_bathrooms')) {
	function ct_bath_baths_or_bathrooms() {
		global $ct_options;
		$ct_bath_baths_or_bathrooms = isset( $ct_options['ct_bath_baths_or_bathrooms'] ) ? $ct_options['ct_bath_baths_or_bathrooms'] : '';

        if($ct_bath_baths_or_bathrooms == 'bathrooms') {
			_e('Bathrooms', 'contempo');
		} elseif($ct_bath_baths_or_bathrooms == 'baths') {
			_e('Baths', 'contempo');
		} else {
    		_e('Bath', 'contempo');
    	}
	}
}

/*-----------------------------------------------------------------------------------*/
/* City, Town or Village */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_city_town_or_village')) {
	function ct_city_town_or_village() {
		global $ct_options;
		$ct_city_town_or_village = isset( $ct_options['ct_city_town_or_village'] ) ? $ct_options['ct_city_town_or_village'] : '';

        if($ct_city_town_or_village == 'village') {
			_e('Village', 'contempo');
		} elseif($ct_city_town_or_village == 'town') {
			_e('Town', 'contempo');
		} else {
    		_e('City', 'contempo');
    	}
	}
}

/*-----------------------------------------------------------------------------------*/
/* State, Area, Suburb, Province, Region or Parish */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_state_or_area')) {
	function ct_state_or_area() {
		global $ct_options;
		$ct_state_or_area = isset( $ct_options['ct_state_or_area'] ) ? $ct_options['ct_state_or_area'] : '';

        if($ct_state_or_area == 'parish') {
			_e('Parish', 'contempo');
		} elseif($ct_state_or_area == 'region') {
			_e('Region', 'contempo');
		} elseif($ct_state_or_area == 'province') {
			_e('Province', 'contempo');
		} elseif($ct_state_or_area == 'suburb') {
			_e('Suburb', 'contempo');
		} elseif($ct_state_or_area == 'area') {
			_e('Area', 'contempo');
		} else {
    		_e('State', 'contempo');
    	}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Zip or Postcode */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_zip_or_post')) {
	function ct_zip_or_post() {
		global $ct_options;
		$ct_zip_or_post = isset( $ct_options['ct_zip_or_post'] ) ? esc_html( $ct_options['ct_zip_or_post'] ) : '';

        if($ct_zip_or_post == 'postalcode') {
        	_e('Postal Code', 'contempo');
        } elseif($ct_zip_or_post == 'postcode') {
        	_e('Postcode', 'contempo');
        } else {
        	_e('Zipcode', 'contempo');
        }
	}
}

/*-----------------------------------------------------------------------------------*/
/* Community, Neighborhood or District */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_community_neighborhood_or_district')) {
	function ct_community_neighborhood_or_district() {
		global $ct_options;
		$ct_community_neighborhood_or_district = isset( $ct_options['ct_community_neighborhood_or_district'] ) ? esc_html( $ct_options['ct_community_neighborhood_or_district'] ) : '';

        if($ct_community_neighborhood_or_district == 'neighborhood') {
        	_e('Neighborhood', 'contempo');
        } elseif($ct_community_neighborhood_or_district == 'suburb') {
        	_e('Suburb', 'contempo');
        } elseif($ct_community_neighborhood_or_district == 'district') {
        	_e('District', 'contempo');
        } elseif($ct_community_neighborhood_or_district == 'schooldistrict') {
        	_e('School District', 'contempo');
        } elseif($ct_community_neighborhood_or_district == 'building') {
        	_e('Building', 'contempo');
        } elseif($ct_community_neighborhood_or_district == 'borough') {
        	_e('Borough', 'contempo');
        } elseif($ct_community_neighborhood_or_district == 'sector') {
        	_e('Sector', 'contempo');
        } else {
        	_e('Community', 'contempo');
        }

	}
}

/*-----------------------------------------------------------------------------------*/
/* Property Type Tags */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_has_type')) {
	function ct_has_type( $type, $_post = null ) {
		if ( empty( $type ) )
			return false;

		if ( $_post )
			$_post = get_post( $_post );
		else
			$_post =& $GLOBALS['post'];

		if ( !$_post )
			return false;

		$r = is_object_in_term( $_post->ID, 'property_type', $type );

		if ( is_wp_error( $r ) )
			return false;

		return $r;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Order Beds by Number */
/*-----------------------------------------------------------------------------------

if(!function_exists('beds_terms_order_as_number')) {
	function beds_terms_order_as_number($order_by, $args, $taxonomies){

	    $taxonomy_to_sort = "beds";

	    if(in_array($taxonomy_to_sort, $taxonomies)){
	        $order_by .=  " * 1";
	    }

	    return $order_by;
	}
}
add_filter( 'get_terms_orderby', 'beds_terms_order_as_number', 10,  3);

/*-----------------------------------------------------------------------------------*/
/* Order Baths by Number */
/*-----------------------------------------------------------------------------------

if(!function_exists('baths_terms_order_as_number')) {
	function baths_terms_order_as_number($order_by, $args, $taxonomies){

	    $taxonomy_to_sort = "baths";

	    if(in_array($taxonomy_to_sort, $taxonomies)){
	        $order_by .=  " * 1";
	    }

	    return $order_by;
	}
}
add_filter( 'get_terms_orderby', 'baths_terms_order_as_number', 10,  3);

/*-----------------------------------------------------------------------------------*/
/* Generate Random Listing ID */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_generate_listing_id')) {
	function ct_generate_listing_id() {
		
		$ct_listing_id = mt_rand(10000000, 99999999);
		echo esc_html($ct_listing_id);
		
	}
}

/*-----------------------------------------------------------------------------------*/
/* Agents Search Field First */
/*-----------------------------------------------------------------------------------*/

function ct_agents_search_fields_first() {
    global $ct_options;
    
    $ct_agents_search_fields = isset( $ct_options['ct_agents_search_fields']['enabled'] ) ? $ct_options['ct_agents_search_fields']['enabled'] : '';

    if(current($ct_agents_search_fields) == $ct_agents_search_fields[0]) {
        echo 'first';
    }
}

/*-----------------------------------------------------------------------------------*/
/* Agents Search Field Span */
/*-----------------------------------------------------------------------------------*/

function ct_agents_search_fields_span() {
    global $ct_options;
    
    $ct_agents_search_fields = isset( $ct_options['ct_agents_search_fields']['enabled'] ) ? $ct_options['ct_agents_search_fields']['enabled'] : '';
    $ct_agents_search_fields_count = count($ct_agents_search_fields);

    if($ct_agents_search_fields_count == 4) {
        echo 'span_3';
    } elseif($ct_agents_search_fields_count == 3) { 
        echo 'span_5';
    } elseif($ct_agents_search_fields_count == 2) { 
        echo 'span_9';
    }
}

/*-----------------------------------------------------------------------------------*/
/* Agents Search Input Span */
/*-----------------------------------------------------------------------------------*/

function ct_agents_search_button_span() {
    global $ct_options;
    
    $ct_agents_search_fields = isset( $ct_options['ct_agents_search_fields']['enabled'] ) ? $ct_options['ct_agents_search_fields']['enabled'] : '';
    $ct_agents_search_fields_count = count($ct_agents_search_fields);

    if($ct_agents_search_fields_count == 4) {
        echo 'span_3';
    } elseif($ct_agents_search_fields_count == 3) { 
        echo 'span_2';
    } elseif($ct_agents_search_fields_count == 2) { 
        echo 'span_3';
    }
}

/*-----------------------------------------------------------------------------------*/
/* Advanced Search Select */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_search_form_select')) {
	function ct_search_form_select($name, $taxonomy_name = null) {

		if ( class_exists("WPDevCache") ) {

			global $oWPDevCache;

			$cache = $oWPDevCache->get( "ct_search_form_select_".$name, false ); // use the ID as part of the cache name to make a per page cache
		
			if($cache !== false) {
				echo $cache;
				return;
			}
		
		} 

		global $search_values;
		global $ct_options;

	    $ct_bed_beds_or_bedrooms = isset( $ct_options['ct_bed_beds_or_bedrooms'] ) ? $ct_options['ct_bed_beds_or_bedrooms'] : '';
	    $ct_bath_baths_or_bathrooms = isset( $ct_options['ct_bath_baths_or_bathrooms'] ) ? $ct_options['ct_bath_baths_or_bathrooms'] : '';
	    $ct_zip_or_post = isset( $ct_options['ct_zip_or_post'] ) ? $ct_options['ct_zip_or_post'] : '';
	    $ct_city_town_or_village = isset( $ct_options['ct_city_town_or_village'] ) ? $ct_options['ct_city_town_or_village'] : '';
	    $ct_state_or_area = isset( $ct_options['ct_state_or_area'] ) ? $ct_options['ct_state_or_area'] : '';
	    $ct_community_neighborhood_or_district = isset( $ct_options['ct_community_neighborhood_or_district'] ) ? $ct_options['ct_community_neighborhood_or_district'] : '';
		
		if(!$taxonomy_name) {
			$taxonomy_name = $name;
			$tax_label = str_replace('_', ' ', $name);
			$tax_name_stripped = str_replace('ct ', '', $tax_label);

			if($tax_name_stripped == 'property type') {
				$tax_name = __('All Property Types', 'contempo');
			} elseif($tax_name_stripped == 'country') {
				$tax_name = __('All Countries', 'contempo');
			} elseif($tax_name_stripped == 'county') {
				$tax_name = __('All Counties', 'contempo');
			} elseif($tax_name_stripped == 'city' && $ct_city_town_or_village == 'town') {
				$tax_name = __('All Towns', 'contempo');
			} elseif($tax_name_stripped == 'city' && $ct_city_town_or_village == 'village') {
				$tax_name = __('All Villages', 'contempo');
			} elseif($tax_name_stripped == 'city') {
				$tax_name = __('All Cities', 'contempo');
			} elseif($tax_name_stripped == 'state' && $ct_state_or_area == 'area') {
				$tax_name = __('All Areas', 'contempo');
			} elseif($tax_name_stripped == 'state' && $ct_state_or_area == 'suburb') {
				$tax_name = __('All Suburbs', 'contempo');
			} elseif($tax_name_stripped == 'state' && $ct_state_or_area == 'province') {
				$tax_name = __('All Provinces', 'contempo');
			} elseif($tax_name_stripped == 'state' && $ct_state_or_area == 'region') {
				$tax_name = __('All Regions', 'contempo');
			} elseif($tax_name_stripped == 'state' && $ct_state_or_area == 'parish') {
				$tax_name = __('All Parishes', 'contempo');
			} elseif($tax_name_stripped == 'state') {
				$tax_name = __('All States', 'contempo');
			} elseif($tax_name_stripped == 'beds' && $ct_bed_beds_or_bedrooms == 'rooms') {
				$tax_name = __('Rooms', 'contempo');
			} elseif($tax_name_stripped == 'beds' && $ct_bed_beds_or_bedrooms == 'bedrooms') {
				$tax_name = __('Bedrooms', 'contempo');
			} elseif($tax_name_stripped == 'beds' && $ct_bed_beds_or_bedrooms == 'bed') {
				$tax_name = __('Bed', 'contempo');
			} elseif($tax_name_stripped == 'beds') {
				$tax_name = __('Beds', 'contempo');
			} elseif($tax_name_stripped == 'baths' && $ct_bath_baths_or_bathrooms == 'bathrooms') {
				$tax_name = __('Bathrooms', 'contempo');
			} elseif($tax_name_stripped == 'baths' && $ct_bath_baths_or_bathrooms == 'bath') {
				$tax_name = __('Bath', 'contempo');
			} elseif($tax_name_stripped == 'baths') {
				$tax_name = __('Baths', 'contempo');
			} elseif($tax_name_stripped == 'status') {
				$tax_name = __('All Statuses', 'contempo');
			} elseif($tax_name_stripped == 'additional features') {
				$tax_name = __('All Additional Features', 'contempo');
			} elseif($tax_name_stripped == 'community' && $ct_community_neighborhood_or_district == 'neighborhood') {
				$tax_name = __('All Neighborhoods', 'contempo');
			} elseif($tax_name_stripped == 'community' && $ct_community_neighborhood_or_district == 'district') {
				$tax_name = __('All Districts', 'contempo');
			} elseif($tax_name_stripped == 'community' && $ct_community_neighborhood_or_district == 'schooldistrict') {
				$tax_name = __('All School Districts', 'contempo');
			} elseif($tax_name_stripped == 'community' && $ct_community_neighborhood_or_district == 'suburb') {
				$tax_name = __('All Suburbs', 'contempo');
			} elseif($tax_name_stripped == 'community' && $ct_community_neighborhood_or_district == 'building') {
				$tax_name = __('All Buildings', 'contempo');
			} elseif($tax_name_stripped == 'community' && $ct_community_neighborhood_or_district == 'sector') {
				$tax_name = __('All Sectors', 'contempo');
			} elseif($tax_name_stripped == 'community') {
				$tax_name = __('All Communities', 'contempo');
			} elseif($tax_name_stripped == 'zipcode' && $ct_zip_or_post == 'postcode') {
				$tax_name = __('All Postcodes', 'contempo');
			} elseif($tax_name_stripped == 'zipcode' && $ct_zip_or_post == 'postalcode') {
				$tax_name = __('All Postal Codes', 'contempo');
			} elseif($tax_name_stripped == 'zipcode') {
				$tax_name = __('All Zipcodes', 'contempo');
			} elseif($tax_name_stripped == 'pet friendly') {
				$tax_name = __('Pet Friendly?', 'contempo');
			} elseif($tax_name_stripped == 'furnished unfurnished') {
				$tax_name = __('Furnished/Unfurnished?', 'contempo');
			}
		} 

		$ct_header_listing_search_ajaxify_country_state_city = isset( $ct_options['ct_header_listing_search_ajaxify_country_state_city'] ) ? esc_html( $ct_options['ct_header_listing_search_ajaxify_country_state_city'] ) : '';

		$class = "";
		if ( $ct_header_listing_search_ajaxify_country_state_city == "yes" ) {

			//$ct_home_adv_search_fields = isset( $ct_options['ct_home_adv_search_fields']['enabled'] ) ? $ct_options['ct_home_adv_search_fields']['enabled'] : '';
			$ct_header_adv_search_fields = isset( $ct_options['ct_header_adv_search_fields']['enabled'] ) ? $ct_options['ct_header_adv_search_fields']['enabled'] : '';
			
		
			if ( $name == "state" && array_key_exists( "header_country", $ct_header_adv_search_fields ) ) {
				$class = " disabled ";
			} else if ( $name == "city" && array_key_exists( "header_state", $ct_header_adv_search_fields ) ) {
				$class = " disabled ";
			} else if ( $name == "zipcode" && array_key_exists( "header_city", $ct_header_adv_search_fields ) ) {
				$class = " disabled ";
			}

		}
		
		$cache = '<select class="'.$class.'" id="ct_'.esc_html($name).'" name="ct_'.esc_html($name).'">
			<option value="">'.esc_html(ucfirst($tax_name)).'</option>';
		
		if ( $class == "" ) {
			foreach( get_terms($taxonomy_name, 'hide_empty=true') as $t ) :
			
				if ( isset( $_GET['ct_' . $name] ) && $_GET['ct_' . $name] == $t->slug ) { 
					$selected = 'selected=selected '; 
				} else { 
					$selected = ''; 
				}

				$tax_name = str_replace('-', ' ', $t->name);
				$tax_name = strtolower($t->name);

				if($name == 'state') {
					$cache = $cache.'<option '.esc_html($selected).' value="'.esc_attr($t->slug).'">'.strtoupper($tax_name).'</option>';
				} else {
					$cache = $cache.'<option '.esc_html($selected).' value="'.esc_attr($t->slug).'">'.ucwords($tax_name).'</option>';
				}

				$childterms = get_terms($taxonomy_name, array("orderby" => "slug", "parent" => $t->term_id));

	            if($childterms) :
                    foreach($childterms as $key => $childterm) :
	                    $childterm_name = str_replace('-', ' ', $childterm->name);
                        $cache = $cache.'<option '.esc_html($selected). ' value="' . esc_attr($childterm->slug). '"> — ' . ucwords($childterm_name) . '</option>';
                    endforeach;
	            endif;

	            //print_r($loterms);
			
			endforeach; 
		}

		$cache = $cache.'</select>';
	

		if ( class_exists("WPDevCache") ) {
			$oWPDevCache->set( "ct_search_form_select_".$name, $cache, 900 ); // expire in 15 minutes
		} 

		echo $cache;

	}
}

/*-----------------------------------------------------------------------------------*/
/* Advanced Search Brokerage Select */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_search_form_brokerage_select')) {
	function ct_search_form_brokerage_select() {

		global $post;

		$brokerage = new WP_Query(array(
	        'post_type' => 'brokerage',
	        'posts_per_page' => -1,
	    )); ?>

		<select class="" id="ct_brokerage" name="ct_brokerage">
        	<option value="0"><?php _e('All Brokerages', 'contempo'); ?></option>
		    
		    <?php if($brokerage->have_posts()) : while($brokerage->have_posts()) : $brokerage->the_post(); ?>
		        <?php 
		            $ct_brokerage_id = get_the_ID();
		            $ct_brokerage_permalink = get_permalink();
		        	$ct_brokerage_name = strtolower(get_the_title());

		        	if(isset($_GET['ct_brokerage']) && $_GET['ct_brokerage'] == $ct_brokerage_id) { 
						$selected = 'selected=selected '; 
					} else { 
						$selected = ''; 
					}
		        ?>

		        <option value="<?php echo esc_attr($ct_brokerage_id); ?>" <?php echo esc_html($selected); ?>><?php echo ucwords($ct_brokerage_name); ?></option>
		        
		    <?php endwhile; endif; wp_reset_postdata();

	    echo '</select>';
	}
}

/*-----------------------------------------------------------------------------------*/
/* Advanced Search Checkboxes - Header */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_search_form_checkboxes_header')) {
	function ct_search_form_checkboxes_header($name, $taxonomy_name = null) {
		global $search_values;
		global $ct_options;

		if(!$taxonomy_name) {
			$taxonomy_name = $name;
		}
		?>
		<ul class="check-list">
			<?php $count = 0; foreach( get_terms($taxonomy_name, 'hide_empty=true') as $t ) : ?>
				<?php if ($search_values[$name] == $t->slug) { $checked = 'checked'; } else { $checked = ''; } ?>
				<li class="col span_3 <?php if($count % 4 == 0) { echo 'first'; } ?>">
					<input class="custom-select" type="checkbox" class="ct_<?php echo esc_html($name); ?>" name="ct_<?php echo esc_html($name); ?>[]" value="<?php echo esc_attr($t->slug); ?>" <?php echo esc_html($checked); ?>><span><?php echo esc_html($t->name); ?></span>
				</li>
				<?php
				$count++;
		
				if($count % 4 == 0) {
					echo '<div class="clear"></div>';
				} ?>
			<?php endforeach; ?>
		</ul>
		<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/* Advanced Search Checkboxes */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_search_form_checkboxes')) {
	function ct_search_form_checkboxes($name, $taxonomy_name = null) {
		global $search_values;
		global $ct_options;

		if(!$taxonomy_name) {
			$taxonomy_name = $name;
		}
		?>
		<ul class="check-list">
			<?php $count = 0; foreach( get_terms($taxonomy_name, 'hide_empty=true') as $t ) : ?>
				<?php if ($search_values[$name] == $t->slug) { $checked = 'checked'; } else { $checked = ''; } ?>
				<li class="col span_4 <?php if($count % 3 == 0) { echo 'first'; } ?>">
					<input type="checkbox" id="ct_<?php echo esc_html($name); ?>" name="ct_<?php echo esc_html($name); ?>[]" value="<?php echo esc_attr($t->slug); ?>" <?php echo esc_html($checked); ?>><span><?php echo esc_html($t->name); ?></span>
				</li>
				<?php
				$count++;
		
				if($count % 3 == 0) {
					echo '<div class="clear"></div>';
				} ?>
			<?php endforeach; ?>
		</ul>
		<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/* Edit Listings Select */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_edit_listing_form_select')) {
	function ct_edit_listing_form_select($name, $taxonomy_name = null) {
		global $search_values;
		
		if(!$taxonomy_name) {
			$taxonomy_name = $name;
		}
		?>
		<select id="ct_<?php echo esc_html($name); ?>" name="ct_<?php echo esc_html($name); ?>">
			<option value="0"><?php esc_html_e('Any', 'contempo'); ?></option>
			<?php foreach( get_terms($taxonomy_name, 'hide_empty=true') as $t ) : ?>
				<?php if ($ct_property_type == $t->slug) { $selected = 'selected="selected" '; } else { $selected = ''; } ?>
				<option <?php echo esc_html($selected); ?>value="<?php echo esc_attr($t->slug); ?>"><?php echo esc_html($t->name); ?></option>
			<?php endforeach; ?>
		</select>
		<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/* Submit Listings Select */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_submit_listing_form_select')) {
	function ct_submit_listing_form_select($name, $taxonomy_name = null) {
		global $ct_options, $search_values;

		$ct_front_submit_type = isset( $ct_options['ct_front_submit_type'] ) ? esc_html( $ct_options['ct_front_submit_type'] ) : '';
		$ct_front_submit_status = isset( $ct_options['ct_front_submit_status'] ) ? esc_html( $ct_options['ct_front_submit_status'] ) : '';

		$ct_property_type = '';
		
		if(!$taxonomy_name) {
			$taxonomy_name = $name;
		}
		?>
		<select id="ct_<?php echo esc_html($name); ?>" name="ct_<?php echo esc_html($name); ?>" <?php if($ct_front_submit_type == 'required' && $name == 'property_type' || $ct_front_submit_status == 'required' && $name == 'ct_status') { echo 'required'; } ?>>
			<option value="0"><?php esc_html_e('Any', 'contempo'); ?></option>
			<?php foreach( get_terms($taxonomy_name, 'hide_empty=0') as $t ) : ?>
				<?php if ($ct_property_type == $t->slug) { $selected = 'selected="selected" '; } else { $selected = ''; } ?>
				<option <?php echo esc_html($selected); ?> value="<?php echo esc_attr($t->slug); ?>"><?php echo esc_html($t->name); ?></option>
			<?php endforeach; ?>
		</select>
		<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/* Submit Listings Select - Show All */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_submit_listing_form_select_show_all')) {
	function ct_submit_listing_form_select_show_all($name, $taxonomy_name = null) {
		global $ct_options, $search_values;

		$ct_front_submit_type = isset( $ct_options['ct_front_submit_type'] ) ? esc_html( $ct_options['ct_front_submit_type'] ) : '';
		$ct_front_submit_status = isset( $ct_options['ct_front_submit_status'] ) ? esc_html( $ct_options['ct_front_submit_status'] ) : '';

		$ct_property_type = '';
		
		if(!$taxonomy_name) {
			$taxonomy_name = $name;
		}
		?>
		<select id="ct_<?php echo esc_html($name); ?>" name="ct_<?php echo esc_html($name); ?>" <?php if($ct_front_submit_type == 'required' && $name == 'property_type' || $ct_front_submit_status == 'required' && $name == 'ct_status') { echo 'required'; } ?>>
			<option value="0"><?php esc_html_e('Any', 'contempo'); ?></option>
			<?php foreach( get_terms($taxonomy_name, 'hide_empty=1') as $t ) : ?>
				<?php if ($ct_property_type == $t->slug) { $selected = 'selected="selected" '; } else { $selected = ''; } ?>
				<option <?php echo esc_html($selected); ?> value="<?php echo esc_attr($t->slug); ?>"><?php echo esc_html($t->name); ?></option>
			<?php endforeach; ?>
		</select>
		<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/* Yelp Fusion API */
/*-----------------------------------------------------------------------------------*/

// API constants
$API_HOST = "https://api.yelp.com";
$SEARCH_PATH = "/v3/businesses/search";
$BUSINESS_PATH = "/v3/businesses/";  // Business ID will come after slash.

/** 
 * Makes a request to the Yelp API and returns the response
 * 
 * @param    $host    The domain host of the API 
 * @param    $path    The path of the API after the domain.
 * @param    $url_params    Array of query-string parameters.
 * @return   The JSON response from the request      
 */
function request($host, $path, $url_params = array()) {

	global $ct_options;
	$API_KEY = isset( $ct_options['ct_yelp_api_key'] ) ? esc_html( $ct_options['ct_yelp_api_key'] ) : '';

    // Send Yelp API Call
    try {
        $curl = curl_init();
        if (FALSE === $curl)
            throw new Exception('Failed to initialize');
        $url = $host . $path . "?" . http_build_query($url_params);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,  // Capture response.
            CURLOPT_ENCODING => "",  // Accept gzip/deflate/whatever.
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $API_KEY,
                "cache-control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        if (FALSE === $response)
            throw new Exception(curl_error($curl), curl_errno($curl));
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (200 != $http_status)
            throw new Exception($response, $http_status);
        curl_close($curl);
    } catch(Exception $e) {
    	echo '<div class="nomatches">';
    		if($e->getCode() == '401') {
    			echo '<h5>' . __('You need to setup the Yelp Fusion API.', 'contempo') . '</h5>';
		        echo '<p class="marB0">' . __('Go into Admin > Real Estate 7 Options > What\'s Nearby? > Create App', 'contempo') . '</p>';
    		} elseif($e->getCode() == '429') {
    			echo '<h5>' . __('You\'ve reached the daily Yelp Fusion API limit.', 'contempo') . '</h5>';
		        echo '<p class="marB0">' . __('Please visit https://www.yelp.com/developers/v3/manage_app', 'contempo') . '</p>';
		    } elseif($e->getCode() == '502') {
    			echo '<h5>' . __('General 502 Error from Yelp Fusion API', 'contempo') . '</h5>';
		        echo '<p class="marB0">' . __('Please check your server error logs.', 'contempo') . '</p>';
		    } elseif($e->getCode() == '500') {
    			echo '<h5>' . __('General 500 Error from Yelp Fusion API', 'contempo') . '</h5>';
		        echo '<p class="marB0">' . __('Please check your server error logs.', 'contempo') . '</p>';
	        } else {
	        	echo '<h5>' . __('General Error from Yelp Fusion API', 'contempo') . '</h5>';
		        echo '<p class="marB0">' . sprintf(
		            'Curl failed with error #%d: %s',
		            $e->getCode(), $e->getMessage()),
		            E_USER_ERROR . '</p>';
	        }
	    echo '</div>';
    }
    return $response;
}

/**
 * Query the Search API by a search term and location 
 * 
 * @param    $term        The search term passed to the API 
 * @param    $location    The search location passed to the API 
 * @return   The JSON response from the request 
 */

function search($term, $location, $limit) {
    global $ct_options;
    $radius = isset($ct_options['ct_google_places_radius'] ) ? esc_html( $ct_options['ct_google_places_radius']) : '';

    $url_params = array();
    
    $url_params['term'] = $term;
    $url_params['location'] = $location;
    $url_params['limit'] = $limit;
  
    return request($GLOBALS['API_HOST'], $GLOBALS['SEARCH_PATH'], $url_params);
}

/**
 * Query the Business API by business_id
 * 
 * @param    $business_id    The ID of the business to query
 * @return   The JSON response from the request 
 */

function get_business($business_id) {
    $business_path = $GLOBALS['BUSINESS_PATH'] . urlencode($business_id);
    
    return request($GLOBALS['API_HOST'], $business_path);
}

/**
 * Queries the API by the input values from the user 
 * 
 * @param    $term        The search term to query
 * @param    $location    The location of the business to query
 * @param    $limit    	  The number of the businesses to query
 */

if(!function_exists('ct_query_yelp_api')) {
	function ct_query_yelp_api($term, $location, $limit) {     
	    $response = json_decode(search($term, $location, $limit));

	    if(!empty($response)){
		    $business_id = $response->businesses[0]->id;

		    global $ct_options;

			$ct_yelp_miles_kilometers = isset($ct_options['ct_yelp_miles_kilometers'] ) ? esc_html( $ct_options['ct_yelp_miles_kilometers'] ) : '';
			$ct_yelp_links = isset($ct_options['ct_yelp_links'] ) ? esc_html( $ct_options['ct_yelp_links'] ) : '';
			$ct_yelp_cc = isset($ct_options['ct_yelp_cc'] ) ? esc_html( $ct_options['ct_yelp_cc'] ) : '';

		    if($response != '') {
			    echo '<ul class="marB20 yelp-nearby">';
				    $i = 0;
			    	foreach($response->businesses as $business) {

			    		$business_distance_meters = $response->businesses[$i]->distance;

			    		if($ct_yelp_miles_kilometers == 'kilometers') {
				    		$business_distance_miles = $business_distance_meters*0.001;
				    	} else {
				    		$business_distance_miles = $business_distance_meters*0.000621371192;
				    	}
			    		
					    echo '<li>';
					    	echo '<div class="col span_9 first">';
						    	echo '<a href="' . $response->businesses[$i]->url . '" target="' . $ct_yelp_links . '">' . $response->businesses[$i]->name . '</a> <span class="business-distance muted">(' . round($business_distance_miles, 2);
						    	 if($ct_yelp_miles_kilometers == 'km') {
						    	 	_e(' km', 'contempo');
						    	 } else {
						    	 	_e(' mi', 'contempo');
						    	 }
						    	 echo ')</span>';
					    	echo '</div>';
					    	echo '<div class="col span_3">';
						    	echo '<span class="yelp-rating left">';
						    		$float_rating = (float)$response->businesses[$i]->rating;
									$has_half_star = ($float_rating * 10) % 10;
									$star_count = (int)$float_rating;
									if($has_half_star) {
									    echo '<img src="' . get_template_directory_uri() . '/images/stars/small_' . $star_count . '_half.png" srcset="' . get_template_directory_uri() . '/images/stars/small_' . $star_count . '_half@2x.png 2x" />';
									} else {
									    echo '<img src="' . get_template_directory_uri() . '/images/stars/small_' . $star_count . '.png" srcset="' . get_template_directory_uri() . '/images/stars/small_' . $star_count . '@2x.png 2x" />';
									}
							   	echo '</span>';
						    	echo '<span class="review-count muted right">' . $response->businesses[$i]->review_count . ' ' . __('reviews', 'contempo') . '</span></a>';
						    echo '</div>';
						    	echo '<div class="clear"></div>';
					    echo '</li>';
					    $i++;
					}
			    echo '</ul>';
			}
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Google Places API */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_google_places_nearby')) {
	function ct_google_places_nearby($type,$location) {
		global $ct_options;
		$ct_google_maps_api_key = isset($ct_options['ct_google_maps_api_key'] ) ? stripslashes( $ct_options['ct_google_maps_api_key']) : '';
		$ct_google_places_radius = isset($ct_options['ct_google_places_radius'] ) ? esc_html( $ct_options['ct_google_places_radius']) : '';
		$ct_google_places_limit = isset($ct_options['ct_yelp_limit'] ) ? esc_html( $ct_options['ct_yelp_limit']) : '';
		$ct_google_places_individual_link = isset( $ct_options['ct_google_places_individual_link'] ) ? stripslashes( $ct_options['ct_google_places_individual_link'] ) : '';
		$ct_google_places_links = isset($ct_options['ct_yelp_links'] ) ? esc_html( $ct_options['ct_yelp_links']) : '';

		$google_places = new joshtronic\GooglePlaces($ct_google_maps_api_key);

		$google_places->location = $location;
		$google_places->radius   = $ct_google_places_radius;
		//$google_places->rankby   = 'distance';
		$google_places->types    = $type;
		$results                 = $google_places->nearbySearch();

		//print_r($results);

		if($results['status'] == 'OK' && $results && !empty($results['results']) && is_array($results['results'])) {
			$i = 0;
			echo '<ul class="marB20 places-nearby">';
		    	foreach($results['results'] as $result){
		    		$ct_result_link = preg_replace('/\s+/', '+', $result['name']);
				    echo '<li>';
				    	echo '<div class="col span_9 first">';
				    		if($ct_google_places_individual_link != 'no') {
						    	echo '<a href="https://www.google.com/maps/place/' . strtolower($ct_result_link) . '" target="' . $ct_google_places_links . '">' . $result['name'] . '</a>';
						    } else {
						    	echo esc_html($result['name']);
						    }
				    	echo '</div>';
				    	echo '<div class="col span_3">';
				    	echo '<span class="places-rating right">';
				    		if(!empty($result['rating'])) {
					    		$float_rating = (float)$result['rating'];
					    	} else {
					    		$float_rating = 0;
					    	}
							$has_half_star = ($float_rating * 10) % 10;
							$star_count = (int)$float_rating;
							if($has_half_star) {
							    echo '<img src="' . get_template_directory_uri() . '/images/stars/small_' . $star_count . '_half.png" srcset="' . get_template_directory_uri() . '/images/stars/small_' . $star_count . '_half@2x.png 2x" />';
							} else {
							    echo '<img src="' . get_template_directory_uri() . '/images/stars/small_' . $star_count . '.png" srcset="' . get_template_directory_uri() . '/images/stars/small_' . $star_count . '@2x.png 2x" />';
							}
					   	echo '</span>';
				    echo '</div>';
				    	echo '<div class="clear"></div>';
				    echo '</li>';
				    $i++;
				    if($i == $ct_google_places_limit) break;
				}
		    echo '</ul>';
		} elseif($results['status'] == 'OVER_QUERY_LIMIT') {
			echo '<ul class="marB20 places-nearby">';
				echo '<li class="nearby-no-results nomatches muted">';
			    		_e('Unfortunately, your API key is over its quota.', 'contempo');
				echo '</li>';
			echo '</ul>';
		} elseif($results['status'] == 'ZERO_RESULTS') {
			echo '<ul class="marB20 places-nearby">';
				echo '<li class="nearby-no-results nomatches muted">';
			    		_e('Unfortunately, there\'s no results nearby for this listing.', 'contempo');
				echo '</li>';
			echo '</ul>';
		} elseif($results['status'] == 'REQUEST_DENIED') {
			echo '<ul class="marB20 places-nearby">';
				echo '<li class="nearby-no-results nomatches muted">';
			    		_e('Unfortunately, your request was denied, generally because of lack of an invalid key parameter.', 'contempo');
				echo '</li>';
			echo '</ul>';
		} elseif($results['status'] == 'INVALID_REQUEST') {
			echo '<ul class="marB20 places-nearby">';
				echo '<li class="nearby-no-results nomatches muted">';
			    		_e('Unfortunately, your request was invalid, generally due to wrong address information or lat/long coordinates.', 'contempo');
				echo '</li>';
			echo '</ul>';
		} elseif($results['status'] == 'UNKNOWN_ERROR') {
			echo '<ul class="marB20 places-nearby">';
				echo '<li class="nearby-no-results nomatches muted">';
			    		_e('A server-side error happened trying again may be successful, please shift+refresh the page.', 'contempo');
				echo '</li>';
			echo '</ul>';
		}
		//sleep(2);
	}
}

/*-----------------------------------------------------------------------------------*/
/* Walk Score */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_get_walkscore')) {
	function ct_get_walkscore($lat, $lon, $address) {
		global $ct_options;
		$ct_walkscore_api_key = isset( $ct_options['ct_walkscore_apikey'] ) ? esc_html( $ct_options['ct_walkscore_apikey'] ) : '';

		$address = urlencode($address);
		$url = "http://api.walkscore.com/score?format=json&address=$address";
		$url .= "&lat=$lat&lon=$lon&wsapikey=$ct_walkscore_api_key";
		$str = @file_get_contents($url); 
		return $str; 
	} 
}

/*-----------------------------------------------------------------------------------*/
/* Numeric Pagination */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_numeric_pagination')) {
	function ct_numeric_pagination() {

		if( is_singular() )
			return;

		
		global $wp_query;

		/** Stop execution if there's only 1 page */
		if( $wp_query->max_num_pages <= 1 )
			return;
		global $paged;
		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	
		$max   = intval( $wp_query->max_num_pages );

		/**	Add current page to the array */
		if ( $paged >= 1 )
			$links[] = $paged;

		/**	Add the pages around the current page to the array */
		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		echo '<div class="pagination"><ul>' . "\n";

		/**	Previous Post Link */
		if ( get_previous_posts_link() )
			printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

		/**	Link to first page, plus ellipses if necessary */
		if ( ! in_array( 1, $links ) ) {
			$class = 1 == $paged ? ' class="current"' : '';

			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

			if ( ! in_array( 2, $links ) )
				echo '<li>…</li>';
		}

		/**	Link to current page, plus 2 pages in either direction if necessary */
		sort( $links );
		foreach ( (array) $links as $link ) {
			$class = $paged == $link ? ' class="current"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		}

		/**	Link to last page, plus ellipses if necessary */
		if ( ! in_array( $max, $links ) ) {
			if ( ! in_array( $max - 1, $links ) )
				echo '<li>…</li>' . "\n";

			$class = $paged == $max ? ' class="current"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		}
		


		/**	Next Post Link */
		if ( get_next_posts_link() )
			printf( '<li id="next-page-link">%s</li>' . "\n", get_next_posts_link() );
		echo '<div class="clear"></div>';
		echo '</ul></div>' . "\n";

	}
}

/*-----------------------------------------------------------------------------------*/
/* Pagination */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_pagination')) {
	function ct_pagination($pages = '', $range = 2) {  
	     $showitems = ($range * 2)+1;  

	     global $paged;
	     if(empty($paged)) $paged = 1;

	     if($pages == '') {
	         global $wp_query;
	         $pages = $wp_query->max_num_pages;
	         if(!$pages) {
	             $pages = 1;
	         }
	     }   

	     if(1 != $pages) {
	         echo "<div class='pagination'>";
	         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
	         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

	         for ($i=1; $i <= $pages; $i++)
	         {
	             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
	             {
	             	if($paged == $i){
		                 echo "<span class='current'>".$i."</span>";
		             } else {
		             	echo "<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
	             	}
	             }
	         }

	         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
	         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
			 echo "<div class='clear'></div>\n";
	         echo "</div>\n";
	     }
	}
}

/*-----------------------------------------------------------------------------------*/
/* Get the Slug */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_the_slug')) {
	function ct_the_slug() {
	    $post_data = get_post($post->ID, ARRAY_A);
	    $slug = $post_data['post_name'];
	    return $slug; 
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Get image ID from URL
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_get_attachment_id_from_src')) {
	function ct_get_attachment_id_from_src($image_src) {
		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
		$id = $wpdb->get_var($query);
		return $id;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Read More Link */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_read_more_link')) {
	function ct_read_more_link() {
		global $ct_options;
		$ct_read_more = $ct_options['ct_read_more']; ?>
		<a class="read-more right" href="<?php the_permalink(); ?>'">
			<?php if($ct_read_more) {
				echo esc_html($ct_read_more);
			} else {
				echo "Read more <em>&rarr;</em>";
			} ?>
		</a>
	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Custom Author */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_author')) {
	function ct_author() {
		global $post;
		if(get_post_meta($post->ID, "_ct_custom_author", true)) {
			echo get_post_meta($post->ID, "_ct_custom_author", true);
		} else {
			the_author_meta('display_name');
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Archive & Search Header */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_archive_header')) {
	function ct_archive_header() {

		global $post;

		if ( is_category() ) :
			single_cat_title();

		elseif(is_home() || is_front_page() ) :
			_e('Home', 'contempo');
		elseif(is_search() ) :
			printf( __( 'Search Results for: %s', 'contempo' ), '<span>' . get_search_query() . '</span>' );

		elseif ( is_tag() ) :
			single_tag_title();

		elseif ( is_author() ) :
			printf( __( 'Author: %s', 'contempo' ), '<span class="vcard">' . get_the_author() . '</span>' );

		elseif ( is_day() ) :
			printf( __( 'Day: %s', 'contempo' ), '<span>' . get_the_date() . '</span>' );

		elseif ( is_month() ) :
			printf( __( 'Month: %s', 'contempo' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'contempo' ) ) . '</span>' );

		elseif ( is_year() ) :
			printf( __( 'Year: %s', 'contempo' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'contempo' ) ) . '</span>' );

		else :
			_e('Archives', 'contempo');

		endif;

	}
}

/*-----------------------------------------------------------------------------------*/
/* Add Categories to Attachments */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_add_categories_to_attachments')) {
	function ct_add_categories_to_attachments() {
	      register_taxonomy_for_object_type( 'category', 'attachment' );  
	}  
}
add_action( 'init' , 'ct_add_categories_to_attachments' ); 

/*-----------------------------------------------------------------------------------*/
/* Display Featured Category Image */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_display_category_image')) {
	function ct_display_category_image() {

		global $post;
		global $wp_query;

		$args = null;

		if( !is_object($post) ) 
        return;

		if(is_archive()) {
			$currentcat = get_queried_object();			
			if(!empty($currentcat)) {

				$currentcatname = $currentcat->slug;

				$args = array(
					'post_type' => 'attachment',
					'post_status'=>'inherit',
					'category_name' => $currentcatname,
				);
			}
		} elseif(is_search()) {
			$args = array(
				'post_type' => 'attachment',
				'post_status'=>'inherit'
			);
		}
		$query = new WP_Query( $args );

		while ( $query->have_posts() ) : $query->the_post();

			echo'<style type="text/css">';
			echo '#archive-header { background: url(';
				echo wp_get_attachment_url( $post->ID, 'large' );
			echo ') no-repeat center center; background-size: cover;}';
			echo '</style>';

		endwhile;

		wp_reset_postdata();
	}
}

/*-----------------------------------------------------------------------------------*/
/* Post Social */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_post_social')) {
	function ct_post_social() { ?>

		<div class="col span_12 first post-social">
			<h6><?php esc_html_e('Share This', 'contempo'); ?></h6>

			<ul class="social">
		        <li class="facebook"><a href="javascript:void(0);" onclick="popup('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php esc_html_e('Check out this great article on', 'contempo'); ?> <?php bloginfo('name'); ?> &mdash; <?php the_title(); ?>', 'facebook',658,225);"><i class="fa fa-facebook"></i></a></li>
		        <li class="twitter"><a href="javascript:void(0);" onclick="popup('http://twitter.com/home/?status=<?php esc_html_e('Check out this great article on', 'contempo'); ?> <?php bloginfo('name'); ?> &mdash; <?php the_title(); ?> &mdash; <?php the_permalink(); ?>', 'twitter',500,260);"><i class="fa fa-twitter"></i></a></li>
		        <li class="linkedin"><a href="javascript:void(0);" onclick="popup('http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php esc_html_e('Check out this great article on', 'contempo'); ?> <?php bloginfo('name'); ?> &mdash; <?php the_title(); ?>&summary=&source=<?php bloginfo('name'); ?>', 'linkedin',560,400);"><i class="fa fa-linkedin"></i></a></li>
		    </ul>
	    </div>
	    	<div class="clear"></div>

	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Post Tags */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_post_tags')) {
	function ct_post_tags() {
		if(get_the_tag_list()) {
		    echo get_the_tag_list('<ul class="tags"><li><i class="fa fa-tag"></i></li><li>',',</li><li> ','</li></ul>');
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Author Info */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_author_info')) {
	function ct_author_info() {

		global $ct_options;

		$ct_author_img = isset( $ct_options['ct_author_img'] ) ? $ct_options['ct_author_img'] : '';
		$facebookurl = get_the_author_meta('facebookurl');
		$twitterhandle = get_the_author_meta('twitterhandle');
		$linkedinurl = get_the_author_meta('linkedinurl');
		$gplus = get_the_author_meta('gplus');

		?>

		<div id="authorinfo">
			<?php if($ct_author_img == 'yes') { ?>
				<h5 class="marB30"><?php esc_html_e('About The Author', 'contempo'); ?></h5>
				<div class="col span_3 first">
			       <?php if(get_the_author_meta('ct_profile_url')) {				
						echo '<a href="';
							echo site_url() . '/?author=';
							echo the_author_meta('ID');
						echo '">';
							echo '<img class="authorimg" src="';
								echo the_author_meta('ct_profile_url');
							echo '" />';
						echo '</a>';
					} else {
						echo '<a href="';
							echo site_url() . '/?author=';
							echo the_author_meta('ID');
						echo '">';
						echo get_avatar( get_the_author_meta('email'), '80' );
						echo '</a>';
					} ?>
		        </div>
	        <?php } ?>

		    <div class="col <?php if($ct_author_img == 'yes') { echo 'span_9'; } else { echo 'span_12 first'; } ?>">
			    <div class="author-inner <?php if($ct_author_img == 'no') { echo 'pad0'; } ?>">
			        <h5 class="the-author marB10"><a href="<?php the_author_meta('url'); ?>"><?php the_author(); ?></a></h5>
			        <p><?php the_author_meta('description'); ?></p>
			        <ul class="social">
			            <?php if($facebookurl != '') { ?>
			                <li class="facebook"><a href="<?php echo esc_url($facebookurl); ?>"><i class="fa fa-facebook"></i></a></li>
			            <?php } ?>
			            <?php if($twitterhandle != '') { ?>
			                <li class="twitter"><a href="https://twitter.com/<?php echo esc_url($twitterhandle); ?>"><i class="fa fa-twitter"></i></a></li>
			            <?php } ?>
			            <?php if($linkedinurl != '') { ?>
			                <li class="linkedin"><a href="<?php echo esc_url($linkedinurl); ?>"><i class="fa fa-linkedin"></i></a></li>
			            <?php } ?>
			            <?php if($gplus != '') { ?>
			                <li class="google"><a href="<?php echo esc_url($gplus); ?>"><i class="fa fa-google-plus"></i></a></li>
			            <?php } ?>
			        </ul>
		        </div>
		    </div>
		        <div class="clear"></div>
		</div>

	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Related Posts */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_related_posts')) {
	function ct_related_posts() {
		global $post;
		$tags = wp_get_post_tags($post->ID);
		if ($tags) {
		  echo '<h5 class="related-title marT40">' . __('Related Posts', 'contempo') . '</h5>';
		  echo '<ul class="related">';
		  $first_tag = $tags[0]->term_id;
		  $args=array(
			'tag__in' => array($first_tag),
			'post__not_in' => array($post->ID),
			'showposts'=>3,
			'ignore_sticky_posts'=>1
		   );
		  $my_query = new WP_Query($args);
		  if( $my_query->have_posts() ) {
			while ($my_query->have_posts()) : $my_query->the_post(); ?>

				<li class="col span_4">
					<figure>
						<a href="<?php the_permalink() ?>">
							<?php the_post_thumbnail(); ?>
						</a>
					</figure>
	                <h6><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
	                <?php ct_custom_length_excerpt(12); ?>
	            </li>

			  <?php
			endwhile; wp_reset_query();
		  }
		  echo '</ul>';
			  echo '<div class="clear"></div>';
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Custom Length Excerpt */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_custom_length_excerpt')) {
	function ct_custom_length_excerpt($word_count_limit) {
	    echo '<p>' . wp_trim_words(get_the_content(), $word_count_limit) . '</p>';
	}
}

/*-----------------------------------------------------------------------------------*/
/* Content Navigation */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_content_nav')) {
	function ct_content_nav() { ?>
	        <div class="clear"></div>
	    <nav class="content-nav">
	        <div class="nav-prev left"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older', 'contempo' ) ); ?></div>
	        <div class="nav-next right"><?php previous_posts_link( __( 'Newer <span class="meta-nav">&rarr;</span>', 'contempo' ) ); ?></div>
	    </nav>
	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Post Navigation */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_post_nav')) {
	function ct_post_nav() { ?>
	    <nav class="post-nav">
	        <div class="nav-prev left"><?php next_post_link('%link', '<i class="fa fa-chevron-left"></i> %title'); ?></div>
	        <div class="nav-next right"><?php previous_post_link('%link', '%title <i class="fa fa-chevron-right"></i>'); ?></div>
	            <div class="clear"></div>
	    </nav>
	        <div class="clear"></div>
	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Allow Shortcodes to be used in widgets */
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/* Get the Attachment MIME Type */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_get_mime_for_attachment')) {
	function ct_get_mime_for_attachment( $attID ) {
		global $wp_query;

	    $type = get_post_mime_type( $attID );

	    if( ! $type )
	        return '';

	    switch( $type ) {

	        case 'application/doc':
	        case 'application/msword':
	            return "word";

	        case 'application/excel':
	        case 'application/x-excel':
	        case 'application/x-msexcel':
	        case 'application/vnd.ms-excel':
	            return "excel";

	        case 'application/powerpoint':
	        case 'application/mspowerpoint':
	        case 'application/vnd.ms-powerpoint':
	        return "powerpoint";

	        case 'application/pdf':
	            return "pdf";

	        case 'application/zip':
		        return "zip";

	        default:
	            return "text";
	    }
	}
}

/*-----------------------------------------------------------------------------------*/
/* Remove height & width from post thumbnails */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_remove_thumbnail_dimensions')) {
	function ct_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
	    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	    return $html;
	}
}
add_filter( 'post_thumbnail_html', 'ct_remove_thumbnail_dimensions', 10, 3 );

/*-----------------------------------------------------------------------------------*/
/* Get all of the images attached to the current post */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_get_images')) {
	function ct_get_images($size = 'full') {
		global $post;
		$photos = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
		$results = array();
		if ($photos) {
			foreach ($photos as $photo) {
				// get the correct image html for the selected size
				$results[$photo->ID] = wp_get_attachment_url($photo->ID);
			}
		}
		return $results;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Display all images attached to post - detail */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_gallery_images')) {
	function ct_gallery_images() {
		$photos = ct_get_images('full');
		if ($photos) {
			foreach ($photos as $photo) { ?>
	            <img class="marB18" src="<?php echo esc_url($photo); ?>" />
			<?php }
		}	
	}
}

/*-----------------------------------------------------------------------------------*/
/* Display all images attached to post - thumbs */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_gallery_images_thumb')) {
	function ct_gallery_images_thumb() {
		$photos = ct_get_images('full');
		if ($photos) {
			foreach ($photos as $photo) { ?>
				<figure class="col span_3 gallery-thumb">
		            <img src="<?php echo esc_url($photo); ?>" />
	            </figure>
			<?php }
		}	
	}
}

/*-----------------------------------------------------------------------------------*/
/* Display first image thumbnail - float right */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_first_image_tn_right')) {
	function ct_first_image_tn_right() {
		global $post;
		if(has_post_thumbnail()) { ?>
	        <div class="tn">
	            <a href="<?php the_permalink(); ?>">
	                <?php the_post_thumbnail(69,40); ?>
	            </a>
	        </div>
	    <?php }
	}
}

/*-----------------------------------------------------------------------------------*/
/* Get the first image attached to the current post */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_get_post_image')) {
	function ct_get_post_image() {
		global $post;
		$photos = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID'));
		if ($photos) {
			$photo = array_shift($photos);
			return wp_get_attachment_url($photo->ID);
		}
		return false;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Display first image thumb */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_first_image_tn')) {
	function ct_first_image_tn() { ?>
	    <a href="<?php the_permalink(); ?>">
	        <?php the_post_thumbnail(array(150,150)); ?>
	    </a>
	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Display first image thumb */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_first_image_lrg')) {
	function ct_first_image_lrg() {
		
	
		global $ct_options;
		global $post;

		$source = get_post_meta( $post->ID, "source", true );
		$photos = get_post_meta($post->ID, "_ct_slider", true);

		$ct_listing_featured_image_cropping = isset( $ct_options['ct_listing_featured_image_cropping'] ) ? $ct_options['ct_listing_featured_image_cropping'] : '';
		$ct_listing_single_layout = isset( $ct_options['ct_listing_single_layout'] ) ? $ct_options['ct_listing_single_layout'] : '';
		$ct_listing_single_content_layout = isset( $ct_options['ct_listing_single_content_layout'] ) ? $ct_options['ct_listing_single_content_layout'] : '';

		if( $source == "idx-api" ) {
			
			foreach($photos as $attachment_id => $attachment_url ) {

				echo '<img src="'.esc_url($attachment_url).'"  title="'.get_the_title().'" />';

			}

		} else {
				
			if(has_post_thumbnail()) {
				if($ct_listing_single_layout == 'listings-three' || $ct_listing_single_content_layout == 'full-width') {
					the_post_thumbnail('full');	
				} elseif($ct_listing_featured_image_cropping != 'no') {
					the_post_thumbnail('listings-featured-image');
				} else {
					the_post_thumbnail('full');
				}
			} else {
				echo '<img src="' . get_stylesheet_directory_uri() . '/images/no-image.png" srcset=" ' . get_template_directory_uri() . '/images/no-image@2x.png 2x" />';
			}
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Display all images attached to post */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_slider_images')) {
	function ct_slider_images() {
		global $post;

		$photos = ct_get_images('listings-featured-image');
		$position = get_post_meta($post->ID, '_ct_images_position', true);

		if($position = "") {
			if($photos) {
				foreach($photos as $attachment_id => $attachment_url ) {
					$alt_text = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
				?>
					<li data-thumb="<?php echo esc_url($attachment_url); ?>">
						<a href="<?php echo esc_url($attachment_url); ?>" class="gallery-item">
			                <?php echo wp_get_attachment_image( $attachment_id, '', '', array('class' => 'listings-slider-image', 'alt' => $alt_text) ); ?>
		                </a>
					</li>
				<?php }
			}	
		}
		else {
			$position = explode(',', $position);
	       	foreach($position as $pos) {
	       		if($pos!="" && isset($photos[$pos])) {
	       			$photo=$photos[$pos];
	       			unset($photos[$pos]);
	       		?>
		       		<li data-thumb="<?php echo esc_url($photo); ?>">
			       		<a href="<?php echo esc_url($photo); ?>" class="gallery-item">
			                <img src="<?php echo esc_url($photo); ?>" title="<?php the_title(); ?>" />
		                </a>
					</li>
			<?php }
			}
			
			foreach($photos as $attachment_id => $attachment_url ) { ?>
	       		<li data-thumb="<?php echo esc_url($attachment_url); ?>">
		       		<a href="<?php echo esc_url($attachment_url); ?>" class="gallery-item">
		                <?php echo wp_get_attachment_image( $attachment_id, 'listings-slider-image' ); ?>
	                </a>
				</li>
			<?php }
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Display all images uploaded to slides custom field */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_slider_field_images')) {
	function ct_slider_field_images() {

		global $post;

		$source = get_post_meta( $post->ID, "source", true );
		$photos = get_post_meta($post->ID, "_ct_slider", true);
		$position = get_post_meta($post->ID, '_ct_images_position', true);

		if($position = "") {
			if($photos) {
				foreach($photos as $attachment_id => $attachment_url ) {
					$alt_text = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
				?>
					<li data-thumb="<?php echo esc_url($attachment_url); ?>">
						<a href="<?php echo esc_url($attachment_url); ?>" class="gallery-item">
			                <?php echo wp_get_attachment_image( $attachment_id, 'listings-slider-image', '', array('class' => 'listings-slider-image', 'alt' => $alt_text) ); ?>
		                </a>
					</li>
				<?php }
			}	
		}
		else {
			$position = explode(',', $position);
	       	foreach($position as $pos) {
	       		if($pos != "" && isset($photos[$pos])) {
	       			$photo = $photos[$pos];
	       			unset($photos[$pos]);
	       		?>
		       		<li data-thumb="<?php echo esc_url($photo); ?>">
			       		<a href="<?php echo esc_url($photo); ?>" class="gallery-item">
			                <img src="<?php echo esc_url($photo); ?>" title="<?php the_title(); ?>" />
		                </a>
					</li>
			<?php }
			}
			
			foreach($photos as $attachment_id => $attachment_url ) {
				$alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
			?>
						<?php 
							if( $source == "idx-api" ) {
								?>
								<li style="max-height: 460px !important" data-thumb="<?php echo esc_url($attachment_url); ?>">
									<a href="<?php echo esc_url($attachment_url); ?>" class="gallery-item">
										<?php
										echo '<img style="max-height: 460px !important" class="attachment-listings-slider-image size-listings-slider-image" src="'.esc_url($attachment_url).'" title="'.get_the_title().'" />';
							} else {
								?>
								<li data-thumb="<?php echo esc_url($attachment_url); ?>">
									<a href="<?php echo esc_url($attachment_url); ?>" class="gallery-item">
									<?php
										echo wp_get_attachment_image( $attachment_id, 'listings-slider-image', '', array('class' => 'listings-slider-image', 'alt' => $alt_text) );
							}
						?>
	                </a>
				</li>
			<?php }
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Display all images attached to post - Single Home Layout */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_sh_slider_images')) {
	function ct_sh_slider_images() {
		$photos = ct_get_images('full');
		if ($photos) {
			foreach($photos as $attachment_id => $attachment_url ) { ?>
				<li data-thumb="<?php echo esc_url($attachment_url); ?>">
					<a href="<?php echo esc_url($attachment_url); ?>" class="gallery-item">
		                <?php echo wp_get_attachment_image( $attachment_id, 'listings-slider-image' ); ?>
	                </a>
				</li>
			<?php }
		}	
	}
}

/*-----------------------------------------------------------------------------------*/
/* Display all images attached to post */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_slider_carousel_images')) {
	function ct_slider_carousel_images() {
		global $post;

		$photos = ct_get_images('listings-featured-image');
		$position = get_post_meta($post->ID, '_ct_images_position', true);

		if($position=="") {
			if($photos) {
				foreach($photos as $attachment_id => $attachment_url ) { ?>
					<li data-thumb="<?php echo esc_url($attachment_url); ?>">
		                <?php echo wp_get_attachment_image( $attachment_id, 'listings-featured-image' ); ?>
					</li>
				<?php }
			}	
		}
		else{
			$position = explode(',',$position);
	       	foreach ($position as $pos) {
	       		if($pos != "" && isset($photos[$pos])) {
	       			$photo=$photos[$pos];
	       			unset($photos[$pos]);
	       		?>
		       		<li data-thumb="<?php echo esc_url($photo); ?>">
		                <img src="<?php echo esc_url($photo); ?>" title="<?php the_title(); ?>" />
					</li>
			<?php }
			}
			
			foreach($photos as $attachment_id => $attachment_url ) { ?>
	       		<li data-thumb="<?php echo esc_url($attachment_url); ?>">
	                <?php echo wp_get_attachment_image( $attachment_id, 'listings-featured-image' ); ?>
				</li>
			<?php }
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Display all images uploaded to slides custom field */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_slider_field_carousel_images')) {
	function ct_slider_field_carousel_images() {
		global $post;

		$source = get_post_meta( $post->ID, "source", true );
		$photos = get_post_meta($post->ID, "_ct_slider", true);
		$position = get_post_meta($post->ID, '_ct_images_position', true);

		if($position = "") {
			if($photos) {
				foreach($photos as $attachment_id => $attachment_url ) { ?>
					<li data-thumb="<?php echo esc_url($attachment_url); ?>">
		               <?php echo wp_get_attachment_image( $attachment_id, 'listings-featured-image' ); ?>
					</li>
				<?php }
			}	
		}
		else {
			$position = explode(',',$position);
	       	foreach ($position as $pos) {
	       		if($pos != "" && isset($photos[$pos])) {
	       			$photo=$photos[$pos];
	       			unset($photos[$pos]);
	       		?>
		       		<li data-thumb="<?php echo esc_url($photo); ?>">
		                <img src="<?php echo esc_url($photo); ?>" title="<?php the_title(); ?>" />
					</li>
			<?php }
			}
			
			foreach($photos as $attachment_id => $attachment_url ) { ?>
				   <li data-thumb="<?php echo esc_url($attachment_url); ?>">
					<?php 
					if( $source == "idx-api" ) {
						echo "<img class=\"attachment-listings-featured-image size-listings-featured-image\" src=\"".esc_url($attachment_url)."\" title=\"".get_the_title()."\" />";
					} else {
						echo wp_get_attachment_image( $attachment_id, 'listings-featured-image' );
					}
					?>
				</li>
			<?php }
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Display first image linked */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_first_image_linked')) {
	function ct_first_image_linked() {
		global $post;

		$source = get_post_meta( $post->ID, "source", true );

		if ( $source == "idx-api" ) {
			$imageUrl = "";
			$images = get_post_meta( $post->ID, "_ct_slider" );
			if ( !empty( $images[0] ) && is_array( $images[0] ) ) {
				foreach( $images[0] as $key => $value ) {
					$imageUrl = $value;
					break;
				}
			}

			if ( $imageUrl != "" ) {
				?>
				<a class="listing-featured-image" <?php ct_listing_permalink(); ?>><img src='<?php print $imageUrl; ?>' class='listings-featured-image'></a>
				<?php
			} else {
				?>
				<a <?php ct_listing_permalink(); ?>><img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" srcset=" ' . get_template_directory_uri() . '/images/no-image@2x.png 2x" /></a>
				<?php	
			}
		} else {
			global $ct_options;
			$ct_listing_featured_image_cropping = isset( $ct_options['ct_listing_featured_image_cropping'] ) ? $ct_options['ct_listing_featured_image_cropping'] : '';


			if(has_post_thumbnail()) {
				if($ct_listing_featured_image_cropping != 'no') { ?>
					<a class="listing-featured-image" <?php ct_listing_permalink(); ?>><?php the_post_thumbnail('listings-featured-image'); ?></a>
				<?php } else { ?>
					<a <?php ct_listing_permalink(); ?>><?php the_post_thumbnail('large'); ?></a>
				<?php } ?>
			<?php } else { ?>
				<a <?php ct_listing_permalink(); ?>><img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" srcset=" ' . get_template_directory_uri() . '/images/no-image@2x.png 2x" /></a>
			<?php }
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Display first image linked widget */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_first_image_linked_widget')) {
	function ct_first_image_linked_widget() {

		global $ct_options;
		$ct_listing_featured_image_cropping = isset( $ct_options['ct_listing_featured_image_cropping'] ) ? $ct_options['ct_listing_featured_image_cropping'] : '';

		if($ct_listing_featured_image_cropping != 'no') { ?>
			<a <?php ct_listing_permalink(); ?>><?php the_post_thumbnail('listings-featured-image'); ?></a>
		<?php } else { ?>
			<a <?php ct_listing_permalink(); ?>><?php the_post_thumbnail('large'); ?></a>
	<?php }
	
	}
}

/*-----------------------------------------------------------------------------------*/
/* Display first image map thumb */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_first_image_map_tn')) {
	function ct_first_image_map_tn($echo=true) {

		global $post;

		$out = "";

		$source = get_post_meta( $post->ID, "source", true );
		
		if( $source == "idx-api" ) {

			$photos = get_post_meta($post->ID, "_ct_slider", true);
			
			if ( !empty( $photos ) ) {

				foreach($photos as $attachment_id => $attachment_url ) {
					$out = '<img src="' . esc_url( $attachment_url ) . '" width="250" />';
					break;
				}
			}
		}
		
		if ( $out == "" ) {
			$thumb_id = get_post_thumbnail_id();
			$thumb_url = wp_get_attachment_image_src($thumb_id,'medium', true);
			if(!empty($thumb_id)) {
				$out = '<img src="' . $thumb_url[0] . '" width="250" />';
			} else {

				$out = '<img src="' . get_template_directory_uri() . '/images/no-image.png" srcset="' . get_template_directory_uri() . '/images/no-image@2x.png 2x" width="250"/>';

			}
		}

		if($echo) {
			echo $out;
		} else {
			return $out;
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* Get users */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_get_users')) {
	function ct_get_users($users_per_page = 10, $paged = 1, $role = '', $orderby = 'login', $order = 'ASC', $usersearch = '' ) {

		global $blog_id;
			
		$args = array(
				'number' => $users_per_page,
				'offset' => ( $paged-1 ) * $users_per_page,
				'role' => $role,
				'search' => $usersearch,
				'fields' => 'all_with_meta',
				'blog_id' => $blog_id,
				'orderby' => $orderby,
				'order' => $order
			);

		$wp_user_search = new WP_User_Query( $args );
		$user_results = $wp_user_search->get_results();
		
		return $user_results;
		
	}
}

/*-----------------------------------------------------------------------------------*/
/* Listings Navigation */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_listings_nav')) {
	function ct_listings_nav() { ?>
	        <div class="clear"></div>
	    <nav class="content-nav marB30">
	        <div class="nav-previous left"><?php next_posts_link( __( '<span class="meta-nav"><i class="fa fa-chevron-left"></i></span> Older listings', 'contempo' ) ); ?></div>
	        <div class="nav-next right"><?php previous_posts_link( __( 'Newer listings <span class="meta-nav"><i class="fa fa-chevron-right"></i></span>', 'contempo' ) ); ?></div>
	            <div class="clear"></div>
	    </nav>
	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Content Navigation */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_archive_content_nav')) {
	function ct_archive_content_nav() { ?>

	        <div class="nav-previous"><?php previous_posts_link('Previous') ?></div>
	        <div class="nav-next"><?php next_posts_link('Next','') ?></div>

	<?php }
}

if(!function_exists('ct_single_content_nav')) {
	function ct_single_content_nav() { ?>

		<div class="nav-previous"><?php previous_post_link( __( '%link', 'contempo' ) ); ?></div>
	    <div class="nav-next"><?php next_post_link( __( '%link', 'contempo' ) ); ?></div>

	<?php }
}

/*-----------------------------------------------------------------------------------*/
/* Browser Detection */
/*-----------------------------------------------------------------------------------*/

class Browser {
 
  private static $known_browsers = array(
      'msie', 'firefox', 'safari',
      'webkit', 'opera', 'netscape',
      'konqueror', 'gecko', 'chrome'
  );
 
  private function __construct() {}
 
  static public function get_info ($agent = null) {
    // Clean up agent and build regex that matches phrases for known browsers
    // (e.g. "Firefox/2.0" or "MSIE 6.0" (This only matches the major and minor
    // version numbers.  E.g. "2.0.0.6" is parsed as simply "2.0"
    $agent = strtolower($agent ? $agent : $_SERVER['HTTP_USER_AGENT']);
 
    // This pattern throws an exception if server is not up to date on regex lib
    //$pattern = '#(?<browser>' . join('|', $known) .
    //           ')[/ ]+(?<version>[0-9]+(?:.[0-9]+)?)#';
    // So we use this one
    $pattern = '#(' . join('|',self::$known_browsers) .
               ')[/ ]+([0-9]+(?:.[0-9]+)?)#';
 
    // Find all phrases (or return empty array if none found)
    if(!preg_match_all($pattern, $agent, $matches)) return array();
 
    // Since some UAs have more than one phrase (e.g Firefox has a Gecko phrase,
    // Opera 7,8 have a MSIE phrase), use the last two found (the right-most one
    // in the UA).  That's usually the most correct.
 
    $i = count($matches[1])-1;
    $r = array($matches[1][$i] => $matches[2][$i]);
    if ($i) $r[$matches[1][$i-1]] = $matches[2][$i-1];
 
    return $r;
  }
 
/******************************************************************************/
 
  /**
   * Is the user's browser that %#$@! of IE ?
   * @return boolean
   */
  static public function isIE () {
    $bi = self::get_info();
    return (!empty($bi['msie']));
  }
  static public function isIE6 () {
    $bi = self::get_info();
    return (!empty($bi['msie']) && $bi['msie'] == 6.0);
  }
  static public function isIE7 () {
    $bi = self::get_info();
    return (!empty($bi['msie']) && $bi['msie'] == 7.0);
  }
  static public function isIE8 () {
    $bi = self::get_info();
    return (!empty($bi['msie']) && $bi['msie'] == 8.0);
  }
  static public function isIE9 () {
    $bi = self::get_info();
    return (!empty($bi['msie']) && $bi['msie'] == 9.0);
  }
 
  /**
   * Is the user's browser da good ol' Firefox ?
   * @return boolean
   */
  static public function isFirefox () {
    return (strpos ($_SERVER['HTTP_USER_AGENT'], "Firefox") !== false);
  }
 
  /**
   * Is the user's browser the shiny Chrome ?
   * @return boolean
   */
  static public function isChrome () {
    $bi = self::get_info();
    return (!empty($bi['chrome']));
  }
 
  /**
   * Is the user's browser Safari ?
   * @return boolean
   */
  static public function isSafari () {
    $bi = self::get_info();
    return (!empty($bi['safari']) && !empty($bi['webkit']));
  }
 
  /**
   * Is the user's browser the almighty Opera ?
   * @return boolean
   */
  static public function isOpera () {
    $bi = self::get_info();
    return ( strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera') !== false );
  }
 
  /**
   * Is the user's platform iPhone ?
   * @return boolean
   */
  static public function isIphone () {
    return ( strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'iphone') !== false );
  }
 
  /**
   * Is the user's platform iPad ?
   * @return boolean
   */
  static public function isIpad () {
    return ( strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'ipad') !== false );
  }
 
  /**
   * Is the user's platform the awesome Android ?
   * @return boolean
   */
  static public function isAndroid () {
    return ( strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'android') !== false );
  }
 
}

/**
 * The code below is inspired by Justin Tadlock's Hybrid Core.
 *
 * ct_breadcrumbs() shows a breadcrumb for all types of pages.  Themes and plugins can filter $args or input directly.
 * Allow filtering of only the $args using get_the_breadcrumb_args.
 *
 * @since 3.7.0
 * @param array $args Mixed arguments for the menu.
 * @return string Output of the breadcrumb menu.
 */

if(!function_exists('ct_breadcrumbs')) {
	function ct_breadcrumbs( $args = array() ) {
		global $wp_query, $wp_rewrite;

		/* Create an empty variable for the breadcrumb. */
		$breadcrumb = '';

		/* Create an empty array for the trail. */
		$trail = array();
		$path = '';

		/* Set up the default arguments for the breadcrumb. */
		$defaults = array(
			'separator' => '<i class="fa fa-angle-right"></i>',
			'before' => '<span class="breadcrumb-title"></span>',
			'after' => false,
			'front_page' => true,
			'show_home' => __( 'Home', 'contempo' ),
			'echo' => true
		);

		/* Allow singular post views to have a taxonomy's terms prefixing the trail. */
		if ( is_singular() )
			$defaults["singular_{$wp_query->post->post_type}_taxonomy"] = false;

		/* Apply filters to the arguments. */
		$args = apply_filters( 'ct_breadcrumbs_args', $args );

		/* Parse the arguments and extract them for easy variable naming. */
		extract( wp_parse_args( $args, $defaults ) );

		/* If $show_home is set and we're not on the front page of the site, link to the home page. */
		if ( !is_front_page() && $show_home )
			$trail[] = '<a id="bread-home" href="' . home_url() . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home" class="trail-begin">' . $show_home . '</a>';

		/* If viewing the front page of the site. */
		if ( is_front_page() ) {
			if ( !$front_page )
				$trail = false;
			elseif ( $show_home )
				$trail['trail_end'] = "{$show_home}";
		}

		/* If viewing the "home"/posts page. */
		elseif ( is_home() ) {
			$home_page = get_page( $wp_query->get_queried_object_id() );
			$trail = array_merge( $trail, ct_breadcrumbs_get_parents( $home_page->post_parent, '' ) );
			$trail['trail_end'] = get_the_title( $home_page->ID );
		}

		/* If viewing a singular post (page, attachment, etc.). */
		elseif ( is_singular() ) {

			/* Get singular post variables needed. */
			$post = $wp_query->get_queried_object();
			$post_id = absint( $wp_query->get_queried_object_id() );
			$post_type = $post->post_type;
			$parent = $post->post_parent;

			/* If a custom post type, check if there are any pages in its hierarchy based on the slug. */
			if ( 'page' !== $post_type ) {

				$post_type_object = get_post_type_object( $post_type );

				$rewrite['with_front'] = isset( $rewrite['with_front'] ) ? $rewrite['with_front'] : '';

				/* If $front has been set, add it to the $path. */
				if ( 'post' == $post_type || 'attachment' == $post_type || ( /*$post_type_object->rewrite['with_front'] &&*/ $wp_rewrite->front ) )
					$path .= trailingslashit( $wp_rewrite->front );

				/* If there's a slug, add it to the $path. */
				if ( !empty( $post_type_object->rewrite['slug'] ) )
					$path .= $post_type_object->rewrite['slug'];

				/* If there's a path, check for parents. */
				if ( !empty( $path ) )
					$trail = array_merge( $trail, ct_breadcrumbs_get_parents( '', $path ) );

				/* If there's an archive page, add it to the trail. */
				if ( !empty( $post_type_object->rewrite['archive'] ) && function_exists( 'get_post_type_archive_link' ) )
					$trail[] = '<a href="' . get_post_type_archive_link( $post_type ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . $post_type_object->labels->name . '</a>';
			}

			/* If the post type path returns nothing and there is a parent, get its parents. */
			if ( empty( $path ) && 0 !== $parent || 'attachment' == $post_type )
				$trail = array_merge( $trail, ct_breadcrumbs_get_parents( $parent, '' ) );

			/* Display terms for specific post type taxonomy if requested. */
			if ( isset( $args["singular_{$post_type}_taxonomy"] ) && $terms = get_the_term_list( $post_id, $args["singular_{$post_type}_taxonomy"], '', ', ', '' ) )
				$trail[] = $terms;

			/* End with the post title. */
			$post_title = get_the_title( $post_id ); // Force the post_id to make sure we get the correct page title.
			if ( !empty( $post_title ) )
				$trail['trail_end'] = $post_title;
		}

		/* If we're viewing any type of archive. */
		elseif ( is_archive() ) {

			/* If viewing a taxonomy term archive. */
			if ( is_tax() || is_category() || is_tag() ) {

				/* Get some taxonomy and term variables. */
				$term = $wp_query->get_queried_object();
				$taxonomy = get_taxonomy( $term->taxonomy );

				/* Get the path to the term archive. Use this to determine if a page is present with it. */
				if ( is_category() )
					$path = get_option( 'category_base' );
				elseif ( is_tag() )
					$path = get_option( 'tag_base' );
				else {
					if ( $taxonomy->rewrite['with_front'] && $wp_rewrite->front )
						$path = trailingslashit( $wp_rewrite->front );
					$path .= $taxonomy->rewrite['slug'];
				}

				/* Get parent pages by path if they exist. */
				if ( $path )
					$trail = array_merge( $trail, ct_breadcrumbs_get_parents( '', $path ) );

				/* If the taxonomy is hierarchical, list its parent terms. */
				if ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent )
					$trail = array_merge( $trail, ct_breadcrumbs_get_term_parents( $term->parent, $term->taxonomy ) );

				/* Add the term name to the trail end. */
				$trail['trail_end'] = $term->name;
			}

			/* If viewing a post type archive. */
			elseif ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {

				/* Get the post type object. */
				$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );

				/* If $front has been set, add it to the $path. */
				if ( $post_type_object->rewrite['with_front'] && $wp_rewrite->front )
					$path .= trailingslashit( $wp_rewrite->front );

				/* If there's a slug, add it to the $path. */
				if ( !empty( $post_type_object->rewrite['archive'] ) )
					$path .= $post_type_object->rewrite['archive'];

				/* If there's a path, check for parents. */
				if ( !empty( $path ) )
					$trail = array_merge( $trail, ct_breadcrumbs_get_parents( '', $path ) );

				/* Add the post type [plural] name to the trail end. */
				$trail['trail_end'] = $post_type_object->labels->name;
			}

			/* If viewing an author archive. */
			elseif ( is_author() ) {

				/* If $front has been set, add it to $path. */
				if ( !empty( $wp_rewrite->front ) )
					$path .= trailingslashit( $wp_rewrite->front );

				/* If an $author_base exists, add it to $path. */
				if ( !empty( $wp_rewrite->author_base ) )
					$path .= $wp_rewrite->author_base;

				/* If $path exists, check for parent pages. */
				if ( !empty( $path ) )
					$trail = array_merge( $trail, ct_breadcrumbs_get_parents( '', $path ) );

				/* Add the author's display name to the trail end. */
				$trail['trail_end'] = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
			}

			/* If viewing a time-based archive. */
			elseif ( is_time() ) {

				if ( get_query_var( 'minute' ) && get_query_var( 'hour' ) )
					$trail['trail_end'] = get_the_time( __( 'g:i a', 'contempo' ) );

				elseif ( get_query_var( 'minute' ) )
					$trail['trail_end'] = sprintf( __( 'Minute %1$s', 'contempo' ), get_the_time( __( 'i', 'contempo' ) ) );

				elseif ( get_query_var( 'hour' ) )
					$trail['trail_end'] = get_the_time( __( 'g a', 'contempo' ) );
			}

			/* If viewing a date-based archive. */
			elseif ( is_date() ) {

				/* If $front has been set, check for parent pages. */
				if ( $wp_rewrite->front )
					$trail = array_merge( $trail, ct_breadcrumbs_get_parents( '', $wp_rewrite->front ) );

				if ( is_day() ) {
					$trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'contempo' ) ) . '">' . get_the_time( __( 'Y', 'contempo' ) ) . '</a>';
					$trail[] = '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . get_the_time( esc_attr__( 'F', 'contempo' ) ) . '">' . get_the_time( __( 'F', 'contempo' ) ) . '</a>';
					$trail['trail_end'] = get_the_time( __( 'j', 'contempo' ) );
				}

				elseif ( get_query_var( 'w' ) ) {
					$trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'contempo' ) ) . '">' . get_the_time( __( 'Y', 'contempo' ) ) . '</a>';
					$trail['trail_end'] = sprintf( __( 'Week %1$s', 'contempo' ), get_the_time( esc_attr__( 'W', 'contempo' ) ) );
				}

				elseif ( is_month() ) {
					$trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'contempo' ) ) . '">' . get_the_time( __( 'Y', 'contempo' ) ) . '</a>';
					$trail['trail_end'] = get_the_time( __( 'F', 'contempo' ) );
				}

				elseif ( is_year() ) {
					$trail['trail_end'] = get_the_time( __( 'Y', 'contempo' ) );
				}
			}
		}

		/* If viewing search results. */
		elseif ( is_search() )
			$trail['trail_end'] = sprintf( __( 'Search results for &quot;%1$s&quot;', 'contempo' ), esc_attr( get_search_query() ) );

		/* If viewing a 404 error page. */
		elseif ( is_404() )
			$trail['trail_end'] = __( '404 Not Found', 'contempo' );

		/* Connect the breadcrumb trail if there are items in the trail. */
		if ( is_array( $trail ) ) {

			/* Open the breadcrumb trail containers. */
			$breadcrumb = '<div class="breadcrumb breadcrumbs ct-breadcrumbs right muted"><div class="breadcrumb-trail">';

			/* If $before was set, wrap it in a container. */
			if ( !empty( $before ) )
				$breadcrumb .= '<span class="trail-before">' . $before . '</span> ';

			/* Wrap the $trail['trail_end'] value in a container. */
			if ( !empty( $trail['trail_end'] ) )
				$trail['trail_end'] = '<span class="trail-end">' . $trail['trail_end'] . '</span>';

			/* Format the separator. */
			if ( !empty( $separator ) )
				$separator = '<span class="sep">' . $separator . '</span>';

			/* Join the individual trail items into a single string. */
			$breadcrumb .= join( " {$separator} ", $trail );

			/* If $after was set, wrap it in a container. */
			if ( !empty( $after ) )
				$breadcrumb .= ' <span class="trail-after">' . $after . '</span>';

			/* Close the breadcrumb trail containers. */
			$breadcrumb .= '</div></div>';
		}

		/* Allow developers to filter the breadcrumb trail HTML. */
		$breadcrumb = apply_filters( 'ct_breadcrumbs', $breadcrumb );

		/* Output the breadcrumb. */
		if ( $echo )
			echo $breadcrumb;
		else
			return $breadcrumb;

	}
}

/*-----------------------------------------------------------------------------------*/
/* Get parents */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_breadcrumbs_get_parents')) {
	function ct_breadcrumbs_get_parents( $post_id = '', $path = '' ) {

		/* Set up an empty trail array. */
		$trail = array();

		/* If neither a post ID nor path set, return an empty array. */
		if ( empty( $post_id ) && empty( $path ) )
			return $trail;

		/* If the post ID is empty, use the path to get the ID. */
		if ( empty( $post_id ) ) {

			/* Get parent post by the path. */
			$parent_page = get_page_by_path( $path );

			if( empty( $parent_page ) )
			        // search on page name (single word)
				$parent_page = get_page_by_title ( $path );

			if( empty( $parent_page ) )
				// search on page title (multiple words)
				$parent_page = get_page_by_title ( str_replace( array('-', '_'), ' ', $path ) );

			/* End Modification */

			/* If a parent post is found, set the $post_id variable to it. */
			if ( !empty( $parent_page ) )
				$post_id = $parent_page->ID;
		}

		/* If a post ID and path is set, search for a post by the given path. */
		if ( $post_id == 0 && !empty( $path ) ) {

			/* Separate post names into separate paths by '/'. */
			$path = trim( $path, '/' );
			preg_match_all( "/\/.*?\z/", $path, $matches );

			/* If matches are found for the path. */
			if ( isset( $matches ) ) {

				/* Reverse the array of matches to search for posts in the proper order. */
				$matches = array_reverse( $matches );

				/* Loop through each of the path matches. */
				foreach ( $matches as $match ) {

					/* If a match is found. */
					if ( isset( $match[0] ) ) {

						/* Get the parent post by the given path. */
						$path = str_replace( $match[0], '', $path );
						$parent_page = get_page_by_path( trim( $path, '/' ) );

						/* If a parent post is found, set the $post_id and break out of the loop. */
						if ( !empty( $parent_page ) && $parent_page->ID > 0 ) {
							$post_id = $parent_page->ID;
							break;
						}
					}
				}
			}
		}

		/* While there's a post ID, add the post link to the $parents array. */
		while ( $post_id ) {

			/* Get the post by ID. */
			$page = get_page( $post_id );

			/* Add the formatted post link to the array of parents. */
			$parents[]  = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . get_the_title( $post_id ) . '</a>';

			/* Set the parent post's parent to the post ID. */
			$post_id = $page->post_parent;
		}

		/* If we have parent posts, reverse the array to put them in the proper order for the trail. */
		if ( isset( $parents ) )
			$trail = array_reverse( $parents );

		/* Return the trail of parent posts. */
		return $trail;

	}
}

/*-----------------------------------------------------------------------------------*/
/* Get term parents */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_breadcrumbs_get_term_parents')) {
	function ct_breadcrumbs_get_term_parents( $parent_id = '', $taxonomy = '' ) {

		/* Set up some default arrays. */
		$trail = array();
		$parents = array();

		/* If no term parent ID or taxonomy is given, return an empty array. */
		if ( empty( $parent_id ) || empty( $taxonomy ) )
			return $trail;

		/* While there is a parent ID, add the parent term link to the $parents array. */
		while ( $parent_id ) {

			/* Get the parent term. */
			$parent = get_term( $parent_id, $taxonomy );

			/* Add the formatted term link to the array of parent terms. */
			$parents[] = '<a href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '">' . $parent->name . '</a>';

			/* Set the parent term's parent as the parent ID. */
			$parent_id = $parent->parent;
		}

		/* If we have parent terms, reverse the array to put them in the proper order for the trail. */
		if ( !empty( $parents ) )
			$trail = array_reverse( $parents );

		/* Return the trail of parent terms. */
		return $trail;
	} 
}

/*-----------------------------------------------------------------------------------*/
/* Front End Set Attachment As Featured */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_set_attachment_featured')) {
	function ct_set_attachment_featured( $post ) {
	    $msg = 'Attachment ID [' . $_POST['att_ID'] . '] set as featured!';
	    if( set_post_thumbnail($_POST['post_ID'], $_POST['att_ID'])) {
	        echo esc_html($msg);
	    }
	    die();
	}
}
add_action( 'wp_ajax_ct_set_attachment_featured', 'ct_set_attachment_featured' );

/*-----------------------------------------------------------------------------------*/
/* Front End Image Upload */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_front_img_upload')) {
	function ct_front_img_upload( $post ) {
		if (empty($_FILES) || $_FILES['file']['error']) { die('{"OK": 0, "info": "Failed to move uploaded file."}'); }
		 
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
		 
		$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : $_FILES["file"]["name"];
		$wp_upload_dir = wp_upload_dir();
		$filePath = $wp_upload_dir['path'].'/'.$fileName;
		$filePath2 = $wp_upload_dir['url'].'/'.$fileName;
		 
		 
		// Open temp file
		$out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
		if ($out) {
		  $in = @fopen($_FILES['file']['tmp_name'], "rb");
		 
		  if ($in) {
		    while ($buff = fread($in, 4096))
		      fwrite($out, $buff);
		  } else
		    die('{"OK": 0, "info": "Failed to open input stream."}');
		 
		  @fclose($in);
		  @fclose($out);
		 
		  @unlink($_FILES['file']['tmp_name']);
		} else
		  die('{"OK": 0, "info": "Failed to open output stream."}');
		 
		$name=$filePath2.'.part';
		if(!$chunks || $chunk == $chunks - 1) {
		  $name=$filePath;
		  rename($filePath.".part", $filePath);

			$filename2 = $filePath;
			$filetype = wp_check_filetype( basename( $filename2 ), null );
			$wp_upload_dir = wp_upload_dir();
			$attachment = array(
				'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename2 ), 
				'post_mime_type' => $filetype['type'],
				'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename2 ) ),
				'post_content'   => '',
				'post_status'    => 'inherit'
			);
			if(isset($_GET['postid'])) $attach_id = wp_insert_attachment( $attachment, $filename2, $_GET['postid'] );
			else $attach_id = wp_insert_attachment( $attachment, $filename2 );
			$attach_data = wp_generate_attachment_metadata( $attach_id, $filename2 );
			wp_update_attachment_metadata( $attach_id, $attach_data );
			
			if(is_int($attach_id)){
				$link=wp_get_attachment_url($attach_id);
				die('{"jsonrpc" : "2.0", "success" : true, "id" : "id", "id_att" : "'.$attach_id.'", "link" : "'.$link.'"}');
			}
			else die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Error uplaoding file."}, "id" : "id"}');
		}
		 
		die('{"OK": 1, "info": "Upload successful.", "link": "'.$name.'"}');
	}
}
add_action( 'wp_ajax_ct_front_img_upload', 'ct_front_img_upload' );

/*-----------------------------------------------------------------------------------*/
/* Front End Delete Attachment */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_delete_attachment_edit')) {
	function ct_delete_attachment_edit( $post ) {
	    if( wp_delete_attachment( $_POST['att_ID'], true )) {
	        echo 'Attachment ID [' . $_POST['att_ID'] . '] has been deleted!';
	    }
	    die();
	}
}
add_action( 'wp_ajax_ct_delete_attachment_edit', 'ct_delete_attachment_edit' );

/*-----------------------------------------------------------------------------------*/
/* Advanced Search Ajax Chaining */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('ct_returnPostsTax')) {
	function ct_returnPostsTax($posts,$taxonomy) {
		if($taxonomy=="") return array();
		$r=array();
		foreach($posts as $post_t){
			$tax=wp_get_post_terms($post_t->ID, $taxonomy);
			if(!is_wp_error($tax) && (isset($tax[0]) && $tax[0]->name!=null)) $r[$tax[0]->slug]=$tax[0]->name;
		}
		return $r;
	}
}

if(!function_exists('ct_returnPostsByTax')) {
	function ct_returnPostsByTax($taxonomies) {
		$taxonomies_q=array();
		foreach($taxonomies as $k=>$tax){
			$taxonomies_q[]=array( 'taxonomy' => $k, 'field' => 'slug', 'terms' => $tax );
		}
		$args = array(
			'posts_per_page' => -1,
	        'post_type' => 'listings',
			'tax_query' => array( $taxonomies_q )
		);
		$posts=get_posts( $args );
		return $posts;
	}
}

if(!function_exists('ct_getTaxonomiesRelational')) {
	function ct_getTaxonomiesRelational($current, $filters="") {
		
		$args = array();

		if( $filters == "" ) { 

			$args = array (
				'state'=>'',
				'city'=>'',
				'zipcode'=>''
			); 

		} else { 

			foreach( $filters as $k=>$f ) {

				if ( $f != "" && $f != "0" ) {
					$args[$k] = $f; 
				}

			} 

		}

		$posts=ct_returnPostsByTax($args);
		$return=ct_returnPostsTax($posts,$current);

		return $return;
	}
}

if(!function_exists('ct_getAllTerms')) {
	function ct_getAllTerms($taxonomy_name) {
		$return=array();
		$terms=get_terms($taxonomy_name, 'hide_empty=true');
		foreach ( $terms as $k=>$term ) {
			$return[$term->slug]=$term->name;
		}
		return $return;
	}
}

add_action( 'wp_ajax_nopriv_country_ajax', 'ct_country_ajax_callback' );
add_action( 'wp_ajax_country_ajax', 'ct_country_ajax_callback' );

add_action( 'wp_ajax_nopriv_communityajax', 'ct_community_ajax_callback' );
add_action( 'wp_ajax_community_ajax', 'ct_community_ajax_callback' );

add_action( 'wp_ajax_nopriv_state_ajax', 'ct_state_ajax_callback' );
add_action( 'wp_ajax_state_ajax', 'ct_state_ajax_callback' );

add_action( 'wp_ajax_nopriv_city_ajax', 'ct_city_ajax_callback' );
add_action( 'wp_ajax_city_ajax', 'ct_city_ajax_callback' );

add_action( 'wp_ajax_nopriv_zipcode_ajax', 'ct_zipcode_ajax_callback' );
add_action( 'wp_ajax_zipcode_ajax', 'ct_zipcode_ajax_callback' );

if(!function_exists('ct_country_ajax_callback')) {
	function ct_country_ajax_callback() {
		global $wpdb;
		global $ct_options;

		if ( class_exists("WPDevCache") ) {

			global $oWPDevCache;

			$cache = $oWPDevCache->get( "ct_country_ajax_callback_".$_POST['country'], false ); // use the ID as part of the cache name to make a per page cache
		
			if ( $cache !== false ) {
				echo $cache;
				wp_die();
			}
		
		} 

		$ct_header_listing_search_ajaxify_country_state_city = isset( $ct_options['ct_header_listing_search_ajaxify_country_state_city'] ) ? esc_html( $ct_options['ct_header_listing_search_ajaxify_country_state_city'] ) : '';

		$return['success']=true;
		$return['city'] = "";
		$return['zipcode']="";
		
		if($_POST['country']=="0"){

			if ( $ct_header_listing_search_ajaxify_country_state_city != "yes" ) {
				$return['state']=ct_getAllTerms('state');
				$return['city']=ct_getAllTerms('city');
				$return['zipcode']=ct_getAllTerms('zipcode');
			}
		}
		else{
			$return['state']=ct_getTaxonomiesRelational('state',array('country'=>$_POST['country']));

			if ( $ct_header_listing_search_ajaxify_country_state_city != "yes" ) {
				$return['city']=ct_getTaxonomiesRelational('city',array('country'=>$_POST['country']));
				$return['zipcode']=ct_getTaxonomiesRelational('zipcode',array('country'=>$_POST['country']));
			}
		}

		echo json_encode($return);

		if ( class_exists("WPDevCache") ) {

			global $oWPDevCache;

			$oWPDevCache->set( "ct_country_ajax_callback_".$_POST['country'], json_encode($return), 3600 );
		} 

		wp_die();
	}
}

if(!function_exists('ct_community_ajax_callback')) {
	function ct_community_ajax_callback() {
		global $wpdb;


		if ( class_exists("WPDevCache") ) {

			global $oWPDevCache;

			$cache = $oWPDevCache->get( "ct_community_ajax_callback_".$_POST['community'], false );
		
			if ( $cache !== false ) {
				echo $cache;
				wp_die();
			}
		
		} 


		$return['success']=true;
		if($_POST['community']=="0"){
			$return['state']=ct_getAllTerms('state');
			$return['city']=ct_getAllTerms('city');
			$return['zipcode']=ct_getAllTerms('zipcode');
		}
		else{
			$return['state']=ct_getTaxonomiesRelational('state',array('community'=>$_POST['community']));
			$return['city']=ct_getTaxonomiesRelational('city',array('community'=>$_POST['community']));
			$return['zipcode']=ct_getTaxonomiesRelational('zipcode',array('community'=>$_POST['community']));
		}
		echo json_encode($return);


		
		if ( class_exists("WPDevCache") ) {
			$oWPDevCache->set( "ct_community_ajax_callback_".$_POST['community'], json_encode($return), 3600 );
		}


		wp_die();
	}
}

if(!function_exists('ct_state_ajax_callback')) {
	function ct_state_ajax_callback() {
		global $wpdb;
		global $ct_options;

		if ( class_exists("WPDevCache") ) {

			global $oWPDevCache;

			$cache = $oWPDevCache->get( "ct_state_ajax_callback_".$_POST['firstsearch']."_".$_POST['country']."_".$_POST['state'], false );
		
			if ( $cache !== false ) {
				echo $cache;
				wp_die();
			}
		
		} 


		$ct_header_listing_search_ajaxify_country_state_city = isset( $ct_options['ct_header_listing_search_ajaxify_country_state_city'] ) ? esc_html( $ct_options['ct_header_listing_search_ajaxify_country_state_city'] ) : '';

		$return['success']=true;

		$country = "";
		if ( isset( $_POST['country'] ) ) {
			$country = filter_var( $_POST["country"], FILTER_SANITIZE_STRING );
		}

		$state = "";
		if ( isset( $_POST['state'] ) ) {
			$state = filter_var( $_POST["state"], FILTER_SANITIZE_STRING );
		}
		
		

		if ( $state == "0" && ( $country == "" || $country == "0" ) ) {
			$return['state'] = array();
			$return['city'] = array();
			$return['zipcode'] = array();

			if ( $ct_header_listing_search_ajaxify_country_state_city != "yes" ) {
				$return['state']=ct_getAllTerms('state');
				$return['city']=ct_getAllTerms('city');
				$return['zipcode']=ct_getAllTerms('zipcode');
			}

		} else {

			$return['city']=ct_getTaxonomiesRelational( 'city', array( 'country'=> $country, 'state'=> $state ) );
			$return['zipcode']=ct_getTaxonomiesRelational('zipcode',array( 'country'=> $country, 'state'=> $state ) );

		}


		echo json_encode($return);
		
		if ( class_exists("WPDevCache") ) {
			$oWPDevCache->set( "ct_state_ajax_callback_".$_POST['firstsearch']."_".$_POST['country']."_".$_POST['state'], json_encode($return), 3600 );
		}

		wp_die();
	}
}

if(!function_exists('ct_city_ajax_callback')) {
	function ct_city_ajax_callback() {
		global $wpdb;
		global $ct_options;


		$country = "";
		if ( isset( $_POST['country'] ) ) {
			$country = filter_var( $_POST["country"], FILTER_SANITIZE_STRING );
		}

		$state = "";
		if ( isset( $_POST['state'] ) ) {
			$state = filter_var( $_POST["state"], FILTER_SANITIZE_STRING );
		}

		$city = "";
		if ( isset( $_POST['city'] ) ) {
			$city = filter_var( $_POST["city"], FILTER_SANITIZE_STRING );
		}

		$cacheName = "ct_city_ajax_callback_".$country."_".$state."_".$city;

		if ( class_exists("WPDevCache") ) {

			global $oWPDevCache;

			$cache = $oWPDevCache->get($cacheName , false );
		
			if ( $cache !== false ) {
				echo $cache;
				wp_die();
			}
		
		} 

		$ct_header_listing_search_ajaxify_country_state_city = isset( $ct_options['ct_header_listing_search_ajaxify_country_state_city'] ) ? esc_html( $ct_options['ct_header_listing_search_ajaxify_country_state_city'] ) : '';


	
		if ( $city == "0" && ( $state == "" || $state == "0" ) && ( $country == "" || $country == "0" ) ) {
			$return['state'] = array();
			$return['city'] = array();
			$return['zipcode'] = array();

			if ( $ct_header_listing_search_ajaxify_country_state_city != "yes" ) {
				$return['state']=ct_getAllTerms('state');
				$return['city']=ct_getAllTerms('city');
				$return['zipcode']=ct_getAllTerms('zipcode');
			}

		} else {

			$return['zipcode']=ct_getTaxonomiesRelational('zipcode',array( 'country'=> $country, 'state'=> $state, 'city' => $city ) );
		}

		$return['success']=true;

		echo json_encode($return);
		
		if ( class_exists("WPDevCache") ) {
			$oWPDevCache->set( $cacheName, json_encode($return), 3600 );
		}

		
		wp_die();
	}
}

if(!function_exists('ct_zipcode_ajax_callback')) {
	function ct_zipcode_ajax_callback() {
		global $wpdb;


		if ( class_exists("WPDevCache") ) {

			global $oWPDevCache;

			$cache = $oWPDevCache->get( "ct_zipcode_ajax_callback_".$_POST['country']."_".$_POST['zipcode'], false );
		
			if ( $cache !== false ) {
				echo $cache;
				wp_die();
			}
		
		} 


		$return['success']=true;
		$return['country']=ct_getTaxonomiesRelational('country',array('zipcode'=>$_POST['zipcode']));
		$return['state']=ct_getTaxonomiesRelational('state',array('zipcode'=>$_POST['zipcode']));
		$return['city']=ct_getTaxonomiesRelational('city',array('zipcode'=>$_POST['zipcode']));
		if($_POST['zipcode']=="0"){
			$return['zipcode']=ct_getTaxonomiesRelational('zipcode',array('country'=>$_POST['country']));
		}
		echo json_encode($return);

		
		if ( class_exists("WPDevCache") ) {
			$oWPDevCache->set( "ct_zipcode_ajax_callback_".$_POST['country']."_".$_POST['zipcode'], json_encode($return), 3600 );
		}


		wp_die();
	}
}

if(!function_exists('ct_add_localize_to_head')) {
	function ct_add_localize_to_head(){
		?>
		<script type="text/javascript">
			var ajax_link='<?php echo admin_url( 'admin-ajax.php' ); ?>';
		</script>
		<?php	
	}
}
add_action('wp_head','ct_add_localize_to_head');

/*-----------------------------------------------------------------------------------*/
/* Get Search Args */
/*-----------------------------------------------------------------------------------*/

if(!function_exists('getSearchArgs')) {
	function getSearchArgs($skipLocationData=false)
	{


		//file_put_contents(dirname(__FILE__)."/log.theme-functions", "Hit on getSearchArgs\r\n", FILE_APPEND);

		global $ct_options;
		global $paged;
		global $wp_query;
		global $wpdb;

		$ct_exclude_sold_listing_search = isset( $ct_options['ct_exclude_sold_listing_search'] ) ? $ct_options['ct_exclude_sold_listing_search']: '';
		
		/*-----------------------------------------------------------------------------------*/
		/* Query multiple taxonomies */
		/*-----------------------------------------------------------------------------------*/

		$taxonomies_to_search = array(
			'beds' => 'Bedrooms',
			'baths' => 'Bathrooms',
			'property_type' => 'Property Type',
			'ct_status' => 'Status',
			'additional_features' => 'Additional Features',
			//'furnished_unfurnished' => 'Furnished/Unfurnished'
		);                                                                       

		if ( $skipLocationData == false ) {
			$taxonomies_to_search['state'] = 'State';
			$taxonomies_to_search['zipcode'] = 'Zipcode';
			$taxonomies_to_search['city'] = 'City';
			$taxonomies_to_search['country'] = 'Country';
			$taxonomies_to_search['county'] = 'county';
			$taxonomies_to_search['community'] = 'Community';
		}
			
		$search_values = array();
		$tax_query = array();

		foreach($taxonomies_to_search as $t => $l) {
			$var_name = 'ct_'. $t;
			
			if (!empty($_GET[$var_name]) && $_GET[$var_name] != '<img') {  
				$search_values[$t] = $_GET[$var_name];
			}                                                     
		} 

		if(!empty($_GET['ct_additional_features'])) {
			foreach($_GET['ct_additional_features'] as $t) {	
				$ct_additional_feature = str_replace('%5B0%5D', '+', $_GET['ct_additional_features']);
				$search_values[$t."dd"] = $_GET[$var_name]."ff";
			}                                           
		}             
										
		$search_values['post_type'] = 'listings';
		$search_values['paged'] = ct_currentPage();
		$search_num = $ct_options['ct_listing_search_num'];
		$search_values['showposts'] = $search_num;

		/*-----------------------------------------------------------------------------------*/
		/* Additional Feature Search */
		/*-----------------------------------------------------------------------------------*/  
		$search_values['tax_query'] = array ();

		if (isset($_GET['ct_additional_features']) && !empty($_GET['ct_additional_features'])) {
			if (is_array($_GET['ct_additional_features'])) {
				$additional_features = $_GET['ct_additional_features'];

				foreach ($additional_features as $feature):
					array_push( $search_values['tax_query'],
						array(
							'taxonomy' => 'additional_features',
							'field' => 'slug',
							'terms' => $feature,
							'relation' => 'AND'
						)
					);
				endforeach;
			}
		}

		/*-----------------------------------------------------------------------------------*/
		/* Beds+ */
		/*-----------------------------------------------------------------------------------*/ 

		if (isset($_GET['ct_beds_plus']) && !empty($_GET['ct_beds_plus'])) {
			$ct_beds_start = $_GET['ct_beds_plus'];
			$ct_beds_end = 20;
			array_push( $search_values['tax_query'],
				array(
					'taxonomy'  => 'beds',
					'field'     => 'name',
					'terms'     => range($ct_beds_start, $ct_beds_end),
					'operator'  => 'IN'
				)
			);
		}

		/*-----------------------------------------------------------------------------------*/
		/* Baths+ */
		/*-----------------------------------------------------------------------------------*/ 

		if (isset($_GET['ct_baths_plus']) && !empty($_GET['ct_baths_plus'])) {
			$ct_baths_start = $_GET['ct_baths_plus'];
			$ct_beds_end = 20;
			array_push( $search_values['tax_query'],
				array(
					'taxonomy'  => 'baths',
					'field'     => 'name',
					'terms'     => range($ct_baths_start, $ct_beds_end),
					'operator'  => 'IN'
				)
			);
		}

		/*-----------------------------------------------------------------------------------*/
		/* Exclude Sold Status */
		/*-----------------------------------------------------------------------------------*/ 

		if($ct_exclude_sold_listing_search == 'yes') {
			array_push( $search_values['tax_query'],
				array(
					'taxonomy'  => 'ct_status',
					'field'     => 'slug',
					'terms'     => 'sold',
					'operator'  => 'NOT IN'
				)
			);
		}

		/*-----------------------------------------------------------------------------------*/
		/* Exclude Ghost Status */
		/*-----------------------------------------------------------------------------------*/ 

		array_push( $search_values['tax_query'],
			array(
				'taxonomy'  => 'ct_status',
				'field'     => 'slug',
				'terms'     => 'ghost',
				'operator'  => 'NOT IN'
			)
		);

		/*-----------------------------------------------------------------------------------*/
		/* Keyword Search on Title and Content */
		/*-----------------------------------------------------------------------------------*/

		add_action( 'pre_get_posts', function( $q ) {
			if($title = $q->get('_meta_or_title')) {
				add_filter( 'get_meta_sql', function($sql) use ($title) {
					global $wpdb;

					// Only run once:
					static $nr = 0; 
					if(0 != $nr++) return $sql;

					// Modify WHERE part:
					$sql['where'] = sprintf(
						" AND ( %s OR %s ) ",
						$wpdb->prepare("{$wpdb->posts}.post_title like '%%%s%%'", $title),
						$wpdb->prepare("{$wpdb->posts}.post_content like '%%%s%%'", $title),
						mb_substr( $sql['where'], 5, mb_strlen( $sql['where'] ) )
					);
					return $sql;
				});
			}
		});

		if ( $skipLocationData == false && !empty($_GET['ct_keyword'])) {

			$ct_keyword = $_GET['ct_keyword'];
			$search_values['_meta_or_title'] = $ct_keyword; 

			$post_keyword = $_REQUEST['ct_keyword'];
			
			global $wpdb;    
							
			$posts_data = $wpdb->get_results ("SELECT * FROM ".$wpdb->prefix ."posts WHERE post_type= 'listings' AND post_status= 'publish' AND (post_content like '%" .$post_keyword. "%' OR post_title like '%".$post_keyword. "%') ORDER BY post_title" ); 
			$post_meta_data = $wpdb->get_results ("SELECT * FROM ".$wpdb->prefix ."posts WHERE ".$wpdb->prefix ."posts.post_status ='publish' AND ".$wpdb->prefix ."posts.post_type= 'listings' AND ".$wpdb->prefix ."posts.ID = (SELECT ".$wpdb->prefix ."postmeta.post_id  FROM ".$wpdb->prefix ."postmeta  WHERE ".$wpdb->prefix ."postmeta.meta_key = '_ct_listing_alt_title'  AND ".$wpdb->prefix ."postmeta.meta_value LIKE '%".$post_keyword. "%' OR ".$wpdb->prefix ."postmeta.meta_key = '_ct_rental_title'  AND ".$wpdb->prefix ."postmeta.meta_value LIKE '%".$post_keyword. "%' )");

			$post_terms = get_posts(array(
				'showposts' => -1,
				'post_type' => 'listings',
				'post_status' => 'publish',
				'tax_query' => array(
					'relation' => 'OR',
					array(
						'taxonomy' => 'community',
						'field' => 'name',
						'compare' => 'LIKE', 
						'terms' => array($post_keyword)
					),
					array(
						'taxonomy' => 'city',
						'field' => 'name',
						'compare' => 'LIKE', 
						'terms' => array($post_keyword)
					),
					array(
						'taxonomy' => 'zipcode',
						'field' => 'name',
						'compare' => 'LIKE', 
						'terms' => array($post_keyword)
					),
					array(
						'taxonomy' => 'country',
						'field' => 'name',
						'compare' => 'LIKE', 
						'terms' => array($post_keyword)
					),
					array(
						'taxonomy' => 'state',
						'field' => 'name',
						'compare' => 'LIKE', 
						'terms' => array($post_keyword)
					),
				))
			);
			
			$id_array_post = array();
			foreach($posts_data as $post_terms_id) {
				array_push($id_array_post,$post_terms_id->ID); 
			};
			
			$id_array_post_meta = array();
			foreach($post_meta_data as $post_terms_id) {
				array_push($id_array_post_meta,$post_terms_id->ID); 
			};
			
			$id_array = array();
			foreach($post_terms as $post_terms_id) {
				array_push($id_array,$post_terms_id->ID); 
			};
		
			$ids = array_unique(array_merge($id_array_post,$id_array_post_meta,$id_array));
			if ( empty( $ids ) ) {
				$ids = array(1); // set it to 1 to get no posts in results rather than all posts
			}
			$search_values['post_type'] = array('listings');
			$search_values['post__in'] = $ids;

		}

		/*-----------------------------------------------------------------------------------*/
		/* Order by Price */
		/*-----------------------------------------------------------------------------------*/ 

		if (!empty($_GET['ct_orderby_price'])) {

			$order = utf8_encode($_GET['ct_orderby_price']);

			$search_values['orderby'] = 'meta_value';
			$search_values['meta_key'] = '_ct_price';
			$search_values['meta_type'] = 'numeric';
			$search_values['order'] = $order;

		}

		/*-----------------------------------------------------------------------------------*/
		/* Order by (Title, Price or upload date) */
		/*-----------------------------------------------------------------------------------*/ 

		if (!empty($_GET['ct_orderby'])) {
			$orderBy = $_GET['ct_orderby'];

			if ($orderBy == 'priceASC') {
				$search_values['orderby'] = 'meta_value';
				$search_values['meta_key'] = '_ct_price';
				$search_values['meta_type'] = 'numeric';
				$search_values['order'] = 'ASC';		
			} elseif ($orderBy == 'priceDESC') {
				$search_values['orderby'] = 'meta_value';
				$search_values['meta_key'] = '_ct_price';
				$search_values['meta_type'] = 'numeric';
				$search_values['order'] = 'DESC';
			} elseif ($orderBy == 'dateDESC') {
				$search_values['orderby'] = 'date';
				$search_values['order'] = 'DESC';
			}elseif ($orderBy == 'dateASC') {
				$search_values['orderby'] = 'date';
				$search_values['order'] = 'ASC';
			} else { //	titleASC	
				$search_values['orderby'] = 'title';
				$search_values['order'] = 'ASC';
			}
		} 

		$mode = 'search'; 
			
		/*-----------------------------------------------------------------------------------*/
		/* Check Price From/To */
		/*-----------------------------------------------------------------------------------*/

		if (!empty($_GET['ct_price_from']) && !empty($_GET['ct_price_to'])) {
			
			$ct_currency = "$";

			if($ct_options['ct_currency']) {
				$ct_currency = esc_html($ct_options['ct_currency']);
			}

			$ct_price_from = str_replace(',', '', $_GET['ct_price_from']);
			$ct_price_to = str_replace(',', '', $_GET['ct_price_to']);
			$ct_price_from = str_replace($ct_currency, '', $ct_price_from);
			$ct_price_to = str_replace($ct_currency, '', $ct_price_to);

			$search_values['meta_query'] = array(
				array(
					'key' => '_ct_price',
					'value' => array( $ct_price_from, $ct_price_to ),
					'type' => 'NUMERIC',
					'compare' => 'BETWEEN'
				)
			);
		}
		else if (!empty($_GET['ct_price_from'])) {               
			$ct_price_from = str_replace(',', '', $_GET['ct_price_from']);
			$search_values['meta_query'] = array(
				array(
					'key' => '_ct_price',
					'value' => $ct_price_from,
					'type' => 'NUMERIC',
					'compare' => '>='
				)
			);	
		}
		else if (!empty($_GET['ct_price_to'])) {               
			$ct_price_to = str_replace(',', '', $_GET['ct_price_to']);
			$search_values['meta_query'] = array(
				array(
					'key' => '_ct_price',
					'value' => $_GET['ct_price_to'],
					'type' => 'NUMERIC',
					'compare' => '<='
				)
			);	
		}

		/*-----------------------------------------------------------------------------------*/
		/* Check Dwelling Size From/To */
		/*-----------------------------------------------------------------------------------*/

		if (!empty($_GET['ct_sqft_from']) && !empty($_GET['ct_sqft_to'])) {
			$ct_sqft_from = str_replace(',', '', $_GET['ct_sqft_from']);
			$ct_sqft_to = str_replace(',', '', $_GET['ct_sqft_to']);
			$search_values['meta_query'] = array(
				array(
					'key' => '_ct_sqft',
					'value' => array( $ct_sqft_from, $ct_sqft_to ),
					'type' => 'NUMERIC',
					'compare' => 'BETWEEN'
				)
			);
		}
		else if (!empty($_GET['ct_sqft_from'])) {               
			$ct_sqft_from = str_replace(',', '', $_GET['ct_sqft_from']);
			$search_values['meta_query'] = array(
				array(
					'key' => '_ct_sqft',
					'value' => $ct_sqft_from,
					'type' => 'NUMERIC',
					'compare' => '>='
				)
			);	
		}
		else if (!empty($_GET['ct_sqft_to'])) {               
			$ct_sqft_to = str_replace(',', '', $_GET['ct_sqft_to']);
			$search_values['meta_query'] = array(
				array(
					'key' => '_ct_sqft',
					'value' => $ct_sqft_to,
					'type' => 'NUMERIC',
					'compare' => '<='
				)
			);	
		}

		/*-----------------------------------------------------------------------------------*/
		/* Check Lot Size From/To */
		/*-----------------------------------------------------------------------------------*/

		if (!empty($_GET['ct_lotsize_from']) && !empty($_GET['ct_sqft_to'])) {
			$ct_lotsize_from = str_replace(',', '', $_GET['ct_lotsize_from']);
			$ct_lotsize_to = str_replace(',', '', $_GET['ct_lotsize_to']);
			$search_values['meta_query'] = array(
				array(
					'key' => '_ct_lotsize',
					'value' => array( $ct_sqft_from, $ct_sqft_to ),
					'type' => 'NUMERIC',
					'compare' => 'BETWEEN'
				)
			);
		}
		else if (!empty($_GET['ct_lotsize_from'])) {               
			$ct_lotsize_from = str_replace(',', '', $_GET['ct_lotsize_from']);
			$search_values['meta_query'] = array(
				array(
					'key' => '_ct_lotsize',
					'value' => $ct_lotsize_from,
					'type' => 'NUMERIC',
					'compare' => '>='
				)
			);	
		}
		else if (!empty($_GET['ct_lotsize_to'])) {               
			$ct_lotsize_to = str_replace(',', '', $_GET['ct_lotsize_to']);
			$search_values['meta_query'] = array(
				array(
					'key' => '_ct_lotsize',
					'value' => $ct_lotsize_to,
					'type' => 'NUMERIC',
					'compare' => '<='
				)
			);	
		}

		/*-----------------------------------------------------------------------------------*/
		/* Check if pet friendly */
		/*-----------------------------------------------------------------------------------*/ 
		
		if (!empty($_GET['pet_friendly'])) {
			$pet_friendly = $_GET['pet_friendly'];
			$search_values['meta_query'] = array(
				array(
					'key' => 'pet_friendly',
					'value' => $pet_friendly,
					'type' => 'char',
					'compare' => '='
				)
			);	
		}

		/*-----------------------------------------------------------------------------------*/
		/* Check to see if reference number matches */
		/*-----------------------------------------------------------------------------------*/ 
		
		if (!empty($_GET['ct_mls'])) {
			$ct_mls = $_GET['ct_mls'];
			$search_values['meta_query'] = array(
				array(
					'key' => '_ct_mls',
					'value' => $ct_mls,
					'type' => 'char',
					'compare' => '='
				)
			);	
		}

		/*-----------------------------------------------------------------------------------*/
		/* Check if agent name matches */
		/*-----------------------------------------------------------------------------------*/ 
		
		if (!empty($_GET['ct_idx_agent'])) {
			$ct_idx_agent = $_GET['ct_idx_agent'];
			$search_values['meta_query'] = array(
				array(
					'key' => '_ct_agent_name',
					'value' => $ct_idx_agent,
					'type' => 'char',
					'compare' => '='
				)
			);	
		}

		/*-----------------------------------------------------------------------------------*/
		/* Check if brokerage ID matches */
		/*-----------------------------------------------------------------------------------*/ 
		
		if (!empty($_GET['ct_brokerage'])) {
			$ct_brokerage = $_GET['ct_brokerage'];
			$search_values['meta_query'] = array(
				array(
					'key' => '_ct_brokerage',
					'value' => $ct_brokerage,
					'type' => 'NUMERIC',
					'compare' => '='
				)
			);	
		}

		/*-----------------------------------------------------------------------------------*/
		/* Check to see if number of guests matches */
		/*-----------------------------------------------------------------------------------*/ 
		
		if (!empty($_GET['ct_rental_guests'])) {
			$ct_rental_guests = $_GET['ct_rental_guests'];
			$search_values['meta_query'] = array(
				array(
					'key' => '_ct_rental_guests',
					'value' => $ct_rental_guests,
					'type' => 'NUMERIC',
					'compare' => '='
				)
			);	
		}

		// display IDX results if plugin is active and license valid, 
		// else display only regular listings
		$displayIDX = "!=";

		if ( class_exists( "IDX_Query" ) ) {
			// get only idx rows when this plugin is active
			$oIDXQuery = new IDX_Query();
			if ( $oIDXQuery->validateEddKey( ) === true ) {
				$displayIDX = "=";
			}

		}

		if ( ! isset( $search_values["meta_query"] ) ) {
			$search_values['meta_query'] = array();
		}

		if ( $displayIDX == "=" ) {
			array_push( $search_values['meta_query'], array(
				"relation" => "AND",
				array(
					'key' => 'source',
					'value' => 'idx-api',
					'type' => 'char',
					'compare' => $displayIDX
				)
			)
			);
		} else { 
			array_push( $search_values['meta_query'], array(
				"relation" => "AND",
				array(
					'key' => 'source',
					'value' => 'idx-api',
					'compare' => 'NOT EXISTS'
				)
			)
			);
		}


		//file_put_contents(dirname(__FILE__)."/log.theme-functions", "done in getSearchArgs\r\n", FILE_APPEND);

		return $search_values;
	}
}

add_action( 'admin_init', 're7_upgrade_functions');
function re7_upgrade_functions( ) {

	$thisTheme = wp_get_theme();
	$version = str_replace(".", "_", $thisTheme->Version);

	$updated = get_option( "latlngUpdated_".$version, "" );

	if ( $updated == "" ) {
		updateLatLngsForAllListings();
		update_option( "latlngUpdated_".$version, "true" );
	}

}