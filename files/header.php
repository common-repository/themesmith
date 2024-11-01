<?php 

function ts_jquery_init() {
    wp_enqueue_script('jquery');            
}    
add_action('init', 'ts_jquery_init' );

function themesmith_header_inserts(){
    
  $themesmith = get_option('themesmith');  
  
?> 
<script type="text/javascript" language="javascript" src="<?php echo WP_PLUGIN_URL; ?>/themesmith/js/swfobject.js"></script> 
<script type="text/javascript" language="javascript" src="<?php echo WP_PLUGIN_URL; ?>/themesmith/js/jquery.lightbox-0.5.js"></script>
<script type="text/javascript" language="javascript">

   jQuery(document).ready(function(){       
       jQuery('.themesmith-photos a').lightBox({ path: "<?php echo WP_PLUGIN_URL; ?>/themesmith/images/"});
    });
    
</script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('wpurl') ?>/wp-content/plugins/themesmith/css/jquery.lightbox-0.5.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('wpurl') ?>/wp-content/plugins/themesmith/css/themesmith.css" media="screen" /> 
<style type="text/css"> .themesmith-photos img { padding: <?php echo $themesmith['photos_padding']?>; border-color:<?php echo $themesmith['photos_border_color']?>; background-color: <?php echo $themesmith['photos_frame_color']?>}</style>
<?php  
}

add_action('wp_head','themesmith_header_inserts');
?>