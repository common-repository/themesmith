<?php 

function themesmith_videoplayer($attr){  
    global $post;
    $themesmith = get_option('themesmith');
    
    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_videos', '', $attr);
    if ( $output != '' )
       return $output;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }  
    
    extract(shortcode_atts(array(
        'order'      => $themesmith['videos_order'],
        'orderby'    => $themesmith['videos_orderby'],
        'id'         => $post->ID,
        'width'      => $themesmith['videos_width'] ,
        'height'     => $themesmith['videos_height'] ,
        'embed'      => '',
        'poster'     => $themesmith['videos_image'],
        'captions'   => $themesmith['videos_captions'],
        'link'       => $themesmith['videos_caption_link'],
        'repeat'     => $themesmith['videos_repeat'],
        'volume'     => $themesmith['videos_volume'],
        'auto'       => $themesmith['videos_auto'],
        'skin'       => $themesmith['videos_skin']
    ), $attr));

    $id = intval($id);
    if($embed != ''){
        $output = "<div class='themesmith-video-embed'>";
        $output .= get_post_meta($post->ID,$embed,true);
        $output .= "</div>";
        return $output;
        $embed = ''; 
    };
    
    $attachments = get_children( array(
            'post_parent' => $id, 
            'post_status' => 'inherit', 
            'post_type' => 'attachment', 
            'post_mime_type' => 'application', 
            'order' => $order, 
            'orderby' => $orderby
            )); 
     
    if ( empty($attachments) )
       return 'No videos uploaded, make sure you added it as video.';
       
    if ( is_feed() ) {
        return;
    }
    else {
       
    $output = '';   
    $counter = 0;       
    foreach ( $attachments as $id => $attachment ) {
       $counter++;
       $post_id = $attachment->ID;     
       $title = $attachment->post_title;
       $caption = $attachment->post_excerpt;
       $path = $attachment->guid;
       $start_image = $poster;
       //$duration = $attachment->post_content;
        
       
       $output .=  "<div class='themesmith-video-wrap'>\n";
       $output .=  "<div id='video-holder-$post_id-$counter' class='themesmith-video-holder'></div>\n";
       $output .=  "<script type='text/javascript'>";
       $output .=  "var s1 = new SWFObject('" . WP_PLUGIN_URL . "/themesmith/tools/player.swf','player_" . $post_id . "_" . $counter ."','$width','$height','8');\n";
       $output .=  "s1.addParam('allowfullscreen','true');\n";
       $output .=  "so.addParam('allowscriptaccess','always');\n";
       $output .=  "so.addParam('wmode','opaque');\n";
       $output .=  "s1.addVariable('width','$width');\n";
       $output .=  "s1.addVariable('height','$height');\n";
       $output .=  "s1.addVariable('file','$path');\n";
       $output .=  "s1.addVariable('volume','$volume');\n";
       $output .=  "s1.addVariable('autostart','$auto');\n";
       $output .=  "s1.addVariable('repeat','$repeat');\n";   
       $output .=  "s1.addVariable('image','$poster');\n";
       $output .=  "s1.addVariable('skin','$skin');\n";
       $output .=  "s1.write('video-holder-$post_id-$counter');\n";
       $output .=  "</script>";

       if(!empty($title) AND $captions == 'on' AND $link == 'off'){
         $output .= "<span class='themesmith-video-title'>$title</span>\n";}
       
       if(!empty($title) AND $captions == 'on' AND $link == 'on'){
         $output .= "<span class='themesmith-video-title'><a href='$path'>$title</a></span>\n";}
        
       if(!empty($caption)){
        $output .= "<span class='themesmith-video-caption'>$caption</span>\n";}
        
        $output .= "</div>";
       
     } 
     return $output;
    }
    } 
add_shortcode('videos', 'themesmith_videoplayer');  // use "[videos]" in a post  


?>