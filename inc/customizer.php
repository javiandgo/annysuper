<?php
/**
 * AnnySuper Theme Customizer.
 *
 * @package AnnySuper
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function annysuper_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';




//Logo Settings
$wp_customize->add_section('title_tagline', array(
	'title' => __('Title, Tagline & Logo', 'annysuper'),
	'Priority' => 30,
	));

$wp_customize->add_setting('annysuper_logo', array(
	'default'		=> '',
	'sanitize_callback'		=> 'esc_url_raw',
	));

$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'annysuper_logo',
		array(
			'label' => 'Subir Logo',
			'section' => 'title_tagline',
			'settings' => 'annysuper_logo',
			'priority' => 5,
			)
		)
	);

	$wp_customize->add_setting( 'annysuper_logo_resize' , array(
	    'default'     => 100,
	    'sanitize_callback' => 'annysuper_sanitize_positive_number',
	) );
	$wp_customize->add_control(
	        'annysuper_logo_resize',
	        array(
	            'label' => __('Resize & Adjust Logo','annysuper'),
	            'section' => 'title_tagline',
	            'settings' => 'annysuper_logo_resize',
	            'priority' => 6,
	            'type' => 'range',
	            'active_callback' => 'annysuper_logo_enabled',
	            'input_attrs' => array(
			        'min'   => 30,
			        'max'   => 200,
			        'step'  => 5,
			    ),
	        )
	);
	
	function annysuper_logo_enabled($control) {
		$option = $control->manager->get_setting('annysuper_logo');
		return $option->value() == true;
	}

//Replace Header Text Color with, separate colors for Title and Description
	//Override annysuper_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_setting('header_textcolor');
	$wp_customize->add_setting('annysuper_site_titlecolor', array(
	    'default'     => '#FFFFFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'annysuper_site_titlecolor', array(
			'label' => __('Site Title Color','annysuper'),
			'section' => 'colors',
			'settings' => 'annysuper_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('annysuper_header_desccolor', array(
	    'default'     => '#FFFFFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'annysuper_header_desccolor', array(
			'label' => __('Site Tagline Color','annysuper'),
			'section' => 'colors',
			'settings' => 'annysuper_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	//Settings for Nav Area
	$wp_customize->add_section(
	    'annysuper_menu_basic',
	    array(
	        'title'     => __('Menu Settings','annysuper'),
	        'priority'  => 0,
	        'panel'     => 'nav_menus'
	    )
	);
	
	
	$wp_customize->add_setting( 'annysuper_disable_nav_desc' , array(
	    'default'     => true,
	    'sanitize_callback' => 'annysuper_sanitize_checkbox',
	) );
	
	$wp_customize->add_control(
	'annysuper_disable_nav_desc', array(
		'label' => __('Disable Description of Menu Items','annysuper'),
		'section' => 'annysuper_menu_basic',
		'settings' => 'annysuper_disable_nav_desc',
		'type' => 'checkbox'
	) );
	
	
	//Settings For Logo Area
	
	$wp_customize->add_setting(
		'annysuper_hide_title_tagline',
		array( 'sanitize_callback' => 'annysuper_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'annysuper_hide_title_tagline', array(
		    'settings' => 'annysuper_hide_title_tagline',
		    'label'    => __( 'Hide Title and Tagline.', 'annysuper' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);
		
	function annysuper_title_visible( $control ) {
		$option = $control->manager->get_setting('annysuper_hide_title_tagline');
	    return $option->value() == false ;
	}
	
	//SLIDER
	// SLIDER PANEL
	$wp_customize->add_panel( 'annysuper_slider_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Main Slider',
	) );
	
	$wp_customize->add_section(
	    'annysuper_sec_slider_options',
	    array(
	        'title'     => 'Enable/Disable',
	        'priority'  => 0,
	        'panel'     => 'annysuper_slider_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'annysuper_main_slider_enable',
		array( 'sanitize_callback' => 'annysuper_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'annysuper_main_slider_enable', array(
		    'settings' => 'annysuper_main_slider_enable',
		    'label'    => __( 'Enable Slider on HomePage.', 'annysuper' ),
		    'section'  => 'annysuper_sec_slider_options',
		    'type'     => 'checkbox',
		)
	);
	
	
	$wp_customize->add_setting(
		'annysuper_main_slider_count',
			array(
				'default' => '0',
				'sanitize_callback' => 'annysuper_sanitize_positive_number'
			)
	);
	
	// Select How Many Slides the User wants, and Reload the Page.
	$wp_customize->add_control(
			'annysuper_main_slider_count', array(
		    'settings' => 'annysuper_main_slider_count',
		    'label'    => __( 'No. of Slides(Min:0, Max: 10)' ,'annysuper'),
		    'section'  => 'annysuper_sec_slider_options',
		    'type'     => 'number',
		    'description' => __('Save the Settings, and Reload this page to Configure the Slides.','annysuper'),
		    
		)
	);
	
	for ( $i = 1 ; $i <= 10 ; $i++ ) :
		
		//Create the settings Once, and Loop through it.
		static $x = 0;
		$wp_customize->add_section(
		    'annysuper_slide_sec'.$i,
		    array(
		        'title'     => 'Slide '.$i,
		        'priority'  => $i,
		        'panel'     => 'annysuper_slider_panel',
		        'active_callback' => 'annysuper_show_slide_sec'
		        
		    )
		);	
		
		$wp_customize->add_setting(
			'annysuper_slide_img'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'annysuper_slide_img'.$i,
		        array(
		            'label' => '',
		            'section' => 'annysuper_slide_sec'.$i,
		            'settings' => 'annysuper_slide_img'.$i,			       
		        )
			)
		);
		
		$wp_customize->add_setting(
			'annysuper_slide_title'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'annysuper_slide_title'.$i, array(
			    'settings' => 'annysuper_slide_title'.$i,
			    'label'    => __( 'Slide Title','annysuper' ),
			    'section'  => 'annysuper_slide_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		$wp_customize->add_setting(
			'annysuper_slide_desc'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'annysuper_slide_desc'.$i, array(
			    'settings' => 'annysuper_slide_desc'.$i,
			    'label'    => __( 'Slide Description','annysuper' ),
			    'section'  => 'annysuper_slide_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		
		
		$wp_customize->add_setting(
			'annysuper_slide_CTA_button'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'annysuper_slide_CTA_button'.$i, array(
			    'settings' => 'annysuper_slide_CTA_button'.$i,
			    'label'    => __( 'Custom Call to Action Button Text(Optional)','annysuper' ),
			    'section'  => 'annysuper_slide_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		$wp_customize->add_setting(
			'annysuper_slide_url'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
				'annysuper_slide_url'.$i, array(
			    'settings' => 'annysuper_slide_url'.$i,
			    'label'    => __( 'Target URL','annysuper' ),
			    'section'  => 'annysuper_slide_sec'.$i,
			    'type'     => 'url',
			)
		);
		
	endfor;
	
	//active callback to see if the slide section is to be displayed or not
	function annysuper_show_slide_sec( $control ) {
	        $option = $control->manager->get_setting('annysuper_main_slider_count');
	        global $x;
	        if ( $x < $option->value() ){
	        	$x++;
	        	return true;
	        }
		}
	

	
	// Layout and Design
	$wp_customize->add_panel( 'annysuper_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','annysuper'),
	) );
	
	$wp_customize->add_section(
	    'annysuper_design_options',
	    array(
	        'title'     => __('Blog Layout','annysuper'),
	        'priority'  => 0,
	        'panel'     => 'annysuper_design_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'annysuper_blog_layout',
		array( 'sanitize_callback' => 'annysuper_sanitize_blog_layout' )
	);
	
	function annysuper_sanitize_blog_layout( $input ) {
		if ( in_array($input, array('grid','grid_2_column','annysuper','annysuper_3_column') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'annysuper_blog_layout',array(
				'label' => __('Select Layout','annysuper'),
				'settings' => 'annysuper_blog_layout',
				'section'  => 'annysuper_design_options',
				'type' => 'select',
				'choices' => array(
						'grid' => __('Standard Blog Layout','annysuper'),
						'annysuper' => __('annysuper Theme Layout','annysuper'),
						'annysuper_3_column' => __('annysuper Theme Layout (3 Columns)','annysuper'),
						'grid_2_column' => __('Grid - 2 Column','annysuper'),
					)
			)
	);
	
	$wp_customize->add_section(
	    'annysuper_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','annysuper'),
	        'priority'  => 0,
	        'panel'     => 'annysuper_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'annysuper_disable_sidebar',
		array( 'sanitize_callback' => 'annysuper_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'annysuper_disable_sidebar', array(
		    'settings' => 'annysuper_disable_sidebar',
		    'label'    => __( 'Disable Sidebar Everywhere.','annysuper' ),
		    'section'  => 'annysuper_sidebar_options',
		    'type'     => 'checkbox',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'annysuper_disable_sidebar_home',
		array( 'sanitize_callback' => 'annysuper_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'annysuper_disable_sidebar_home', array(
		    'settings' => 'annysuper_disable_sidebar_home',
		    'label'    => __( 'Disable Sidebar on Home/Blog.','annysuper' ),
		    'section'  => 'annysuper_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'annysuper_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'annysuper_disable_sidebar_front',
		array( 'sanitize_callback' => 'annysuper_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'annysuper_disable_sidebar_front', array(
		    'settings' => 'annysuper_disable_sidebar_front',
		    'label'    => __( 'Disable Sidebar on Front Page.','annysuper' ),
		    'section'  => 'annysuper_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'annysuper_show_sidebar_options',
		    'default'  => false
		)
	);
	
	
	$wp_customize->add_setting(
		'annysuper_sidebar_width',
		array(
			'default' => 4,
		    'sanitize_callback' => 'annysuper_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'annysuper_sidebar_width', array(
		    'settings' => 'annysuper_sidebar_width',
		    'label'    => __( 'Sidebar Width','annysuper' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','annysuper'),
		    'section'  => 'annysuper_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'annysuper_show_sidebar_options',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 5,
		        'step'  => 1,
		        'class' => 'sidebar-width-range',
		        'style' => 'color: #0a0',
		    ),
		)
	);
	
	/* Active Callback Function */
	function annysuper_show_sidebar_options($control) {
	   
	    $option = $control->manager->get_setting('annysuper_disable_sidebar');
	    return $option->value() == false ;
	    
	}
	
	class annysuper_Custom_CSS_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="8" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}
	
	$wp_customize-> add_section(
    'annysuper_custom_codes',
    array(
    	'title'			=> __('Custom CSS','annysuper'),
    	'description'	=> __('Enter your Custom CSS to Modify design.','annysuper'),
    	'priority'		=> 11,
    	'panel'			=> 'annysuper_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'annysuper_custom_css',
	array(
		'default'		=> '',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'wp_filter_nohtml_kses',
		'sanitize_js_callback' => 'wp_filter_nohtml_kses'
		)
	);
	
	$wp_customize->add_control(
	    new annysuper_Custom_CSS_Control(
	        $wp_customize,
	        'annysuper_custom_css',
	        array(
	            'section' => 'annysuper_custom_codes',
	            'settings' => 'annysuper_custom_css'
	        )
	    )
	);
	
	function annysuper_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	
	$wp_customize-> add_section(
    'annysuper_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','annysuper'),
    	'description'	=> __('Enter your Own Copyright Text.','annysuper'),
    	'priority'		=> 11,
    	'panel'			=> 'annysuper_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'annysuper_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'annysuper_footer_text',
	        array(
	            'section' => 'annysuper_custom_footer',
	            'settings' => 'annysuper_footer_text',
	            'type' => 'text'
	        )
	);	
	
	
	//Select the Default Theme Skin
	$wp_customize->add_section(
	    'annysuper_skin_options',
	    array(
	        'title'     => __('Choose Skin','annysuper'),
	        'priority'  => 39,
	    )
	);
	
	$wp_customize->add_setting(
		'annysuper_skin',
		array(
			'default'=> 'default',
			'sanitize_callback' => 'annysuper_sanitize_skin' 
			)
	);
	
	$skins = array( 'default' => __('Default(blue)','annysuper'),
					'orange' =>  __('Orange','annysuper'),
					'brown' =>  __('Brown','annysuper'),
					'green' => __('Green','annysuper'),
					'grayscale' => __('GrayScale','annysuper') );
	
	$wp_customize->add_control(
		'annysuper_skin',array(
				'settings' => 'annysuper_skin',
				'section'  => 'annysuper_skin_options',
				'type' => 'select',
				'choices' => $skins,
			)
	);
	
	function annysuper_sanitize_skin( $input ) {
		if ( in_array($input, array('default','orange','brown','green','grayscale') ) )
			return $input;
		else
			return '';
	}
	
	
	//Fonts
	$wp_customize->add_section(
	    'annysuper_typo_options',
	    array(
	        'title'     => __('Google Web Fonts','annysuper'),
	        'priority'  => 41,
	        'description' => __('Defaults: Lato, Open Sans.','annysuper')
	    )
	);
	
	$font_array = array('Raleway','Khula','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans');
	$fonts = array_combine($font_array, $font_array);
	
	$wp_customize->add_setting(
		'annysuper_title_font',
		array(
			'default'=> 'Lato',
			'sanitize_callback' => 'annysuper_sanitize_gfont' 
			)
	);
	
	function annysuper_sanitize_gfont( $input ) {
		if ( in_array($input, array('Raleway','Khula','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
		'annysuper_title_font',array(
				'label' => __('Title','annysuper'),
				'settings' => 'annysuper_title_font',
				'section'  => 'annysuper_typo_options',
				'type' => 'select',
				'choices' => $fonts,
			)
	);
	
	$wp_customize->add_setting(
		'annysuper_body_font',
			array(	'default'=> 'Open Sans',
					'sanitize_callback' => 'annysuper_sanitize_gfont' )
	);
	
	$wp_customize->add_control(
		'annysuper_body_font',array(
				'label' => __('Body','annysuper'),
				'settings' => 'annysuper_body_font',
				'section'  => 'annysuper_typo_options',
				'type' => 'select',
				'choices' => $fonts
			)
	);
	
	// Social Icons
	$wp_customize->add_section('annysuper_social_section', array(
			'title' => __('Social Icons','annysuper'),
			'priority' => 44 ,
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','annysuper'),
					'facebook' => __('Facebook','annysuper'),
					'twitter' => __('Twitter','annysuper'),
					'google-plus' => __('Google Plus','annysuper'),
					'instagram' => __('Instagram','annysuper'),
					'rss' => __('RSS Feeds','annysuper'),
					'vine' => __('Vine','annysuper'),
					'vimeo-square' => __('Vimeo','annysuper'),
					'youtube' => __('Youtube','annysuper'),
					'flickr' => __('Flickr','annysuper'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'annysuper_social_'.$x, array(
				'sanitize_callback' => 'annysuper_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'annysuper_social_'.$x, array(
					'settings' => 'annysuper_social_'.$x,
					'label' => __('Icon ','annysuper').$x,
					'section' => 'annysuper_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'annysuper_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'annysuper_social_url'.$x, array(
					'settings' => 'annysuper_social_url'.$x,
					'description' => __('Icon ','annysuper').$x.__(' Url','annysuper'),
					'section' => 'annysuper_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function annysuper_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube',
					'flickr'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}
	

	
	
	/* Sanitization Functions Common to Multiple Settings go Here, Specific Sanitization Functions are defined along with add_setting() */
	function annysuper_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	
	function annysuper_sanitize_positive_number( $input ) {
		if ( ($input >= 0) && is_numeric($input) )
			return $input;
		else
			return '';	
	}
	
	function annysuper_sanitize_category( $input ) {
		if ( term_exists(get_cat_name( $input ), 'category') )
			return $input;
		else 
			return '';	
	}
	
	function annysuper_sanitize_product_category( $input ) {
		if ( get_term( $input, 'product_cat' ) )
			return $input;
		else 
			return '';	
	}
	
	
}
add_action( 'customize_register', 'annysuper_customize_register' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function annysuper_customize_preview_js() {
	wp_enqueue_script( 'annysuper_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'annysuper_customize_preview_js' );
