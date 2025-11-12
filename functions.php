<?php
// Theme setup
function owt_theme_setup() {
    // Add title tag support
    add_theme_support('title-tag');
    
    // Add featured image support
    add_theme_support('post-thumbnails');
    
    // Register navigation menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'onlinewebsitetools'),
    ));
}
add_action('after_setup_theme', 'owt_theme_setup');

// Enqueue scripts and styles
function owt_enqueue_assets() {
    // Bootstrap CSS
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    
    // Add this inside owt_enqueue_assets() function in functions.php
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css');
    
    // Custom CSS
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/custom.css', array('bootstrap'), '1.0');
    
    // Bootstrap JS
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), null, true);
    
    // Custom JS
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/js/custom.js', array('bootstrap'), '1.0', true);
    
    // Add this inside owt_enqueue_assets() function

    // Enqueue image compressor script only on compressor page
    if (is_page_template('page-templates/template-image-compressor.php')) {
        wp_enqueue_script('image-compressor', get_template_directory_uri() . '/assets/js/image-compressor.js', array(), '1.0', true);
    }
    
    
    // Add this inside owt_enqueue_assets() function

    // Enqueue crop image script only on crop page
    if (is_page_template('page-templates/template-crop-image.php')) {
        wp_enqueue_script('crop-image', get_template_directory_uri() . '/assets/js/crop-image.js', array(), '1.0', true);
    }
    
        // Enqueue meta tag generator script
    if (is_page_template('page-templates/template-meta-tag-generator.php')) {
        wp_enqueue_script('meta-tag-generator', get_template_directory_uri() . '/assets/js/meta-tag-generator.js', array(), '1.0', true);
    }
     // Enqueue meta tag generator script
    if (is_page_template('page-templates/template-meta-tag-generator.php')) {
        wp_enqueue_script('meta-tag-generator', get_template_directory_uri() . '/assets/css/meta-tag-generator.css', array(), '1.0', true);
    }
    
    // Enqueue image to PDF script and library
    if (is_page_template('page-templates/template-image-to-pdf.php')) {
        // jsPDF library from CDN
        wp_enqueue_script('jspdf', 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js', array(), '2.5.1', true);
        
        // Custom script
        wp_enqueue_script('image-to-pdf', get_template_directory_uri() . '/assets/js/image-to-pdf.js', array('jspdf'), '1.0', true);
        wp_enqueue_style('image-to-pdf', get_template_directory_uri() . '/assets/css/image-to-pdf.css', array('jspdf'), '1.0', true);
    }
    
    // Enqueue PDF Compressor 
    if (is_page_template('page-templates/template-pdf-compressor.php')) {
        // jsPDF library from CDN
        // wp_enqueue_script('jspdf', 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js', array(), '2.5.1', true);
        
        // Custom script
        wp_enqueue_script('image-to-pdf', get_template_directory_uri() . '/assets/js/pdf-compressor.js', array('jspdf'), '1.0', true);
        wp_enqueue_style('image-to-pdf', get_template_directory_uri() . '/assets/css/image-to-pdf.css', array('jspdf'), '1.0', true);
    }
        
    // Enqueue PDF Compressor 
    if (is_page_template('page-templates/template-meta-length-checker.php')) {
        // jsPDF library from CDN
        // wp_enqueue_script('jspdf', 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js', array(), '2.5.1', true);
        
        // Custom script
        wp_enqueue_script('template-meta-length-checker', get_template_directory_uri() . '/assets/js/meta-length-checker.js', array('jspdf'), '1.0', true);
        wp_enqueue_style('template-meta-length-checker', get_template_directory_uri() . '/assets/css/meta-length-checker.js', array('jspdf'), '1.0', true);
    }
    
}
add_action('wp_enqueue_scripts', 'owt_enqueue_assets');
?>