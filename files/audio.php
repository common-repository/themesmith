<?php

function themesmith_audioplayer($attr) {
    global $post;      
    $themesmith = get_option('themesmith');
    
   // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_audio', '', $attr);
    if ( $output != '' )
       return $output;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }
    
    extract(shortcode_atts(array(
        'order'      => $themesmith['audio_order'],
        'orderby'    => $themesmith['audio_orderby'],
        'id'         => $post->ID,
        'captions'   => $themesmith['audio_captions'],
        'link'       => $themesmith['audio_caption_link'],
        'width'      => $themesmith['audio_width'],
        'height'     => $themesmith['audio_height'],
        'repeat'     => $themesmith['audio_repeat'],
        'volume'     => $themesmith['audio_volume'],
        'auto'       => $themesmith['audio_auto'],
        'skin'       => $themesmith['audio_skin'],
        'poster'     => $themesmith['audio_image'] 
        
    ), $attr));


    $id = intval($id);
    $attachments = get_children( array(
            'post_parent' => $id, 
            'post_status' => 'inherit', 
            'post_type' => 'attachment', 
            'post_mime_type' => 'audio', 
            'order' => $order, 
            'orderby' => $orderby,
            ));
           
    if ( empty($attachments) )
        return 'No audio files uploaded, make sure you added it as audio.';

    if ( is_feed() ) {
        return;
    } else {
    
    $counter = 0;    
    $output .=  '<div class="themesmith-audio-unit">'; 

      foreach ($attachments as $id => $attachment ) {
       $counter++;
       $post_id = $attachment->ID;    
       $title = trim($attachment->post_title);
       $caption = trim($attachment->post_excerpt);
       $path = $attachment->guid;
       $duration = trim($attachment->post_content); // Used for file play length

       $output .= "<div class='themesmith-audio-player'>" ;
       $output .= "<div id='themesmith-audio-holder-$post_id-$counter' class='themesmith-audio-file'></div>";
       $output .=  "<script type='text/javascript'>" . "\n";
       $output .=  "var so = new SWFObject('" . WP_PLUGIN_URL . "/themesmith/tools/player.swf','player_" . $post_id . "_" . $counter ."','$width','$height','8');" . "\n";
       $output .=  "so.addParam('allowfullscreen','true');" . "\n";
       $output .=  "so.addParam('allowscriptaccess','always');" . "\n";
       $output .=  "so.addParam('wmode','opaque');";
       $output .=  "so.addVariable('type','sound');" . "\n";
       $output .=  "so.addVariable('width','$width');\n";
       $output .=  "so.addVariable('height','$height');\n";
       $output .=  "so.addVariable('file','$path');\n";
       $output .=  "so.addVariable('volume','$volume');\n";
       $output .=  "so.addVariable('autostart','$auto');\n";
       $output .=  "so.addVariable('repeat','$repeat');\n";   
       $output .=  "so.addVariable('skin','$skin');\n";
       if(!empty($duration)){
        $output .=  "so.addVariable('duration',$duration);" . "\n";
       }
       $output .=  "so.write('themesmith-audio-holder-$post_id-$counter');";
       $output .=  "</script>";
       
       if(!empty($title) AND $captions == 'on' AND $link == 'off'){
            $output .= "<span class='themesmith-audio-title'>$title</span>";}
       
       if(!empty($title) AND $captions == 'on' AND $link == 'on'){
            $output .= "<span class='themesmith-audio-title'><a href='$path'>$title</a></span>";}
       
       if(!empty($caption)){
           $output .= "<span class='themesmith-audio-excerpt'>$caption</span>";
        }
        $output .= "</div>"; 
       
    }
    $output .= "</div>";   
    return $output;
         
        
    }
}
add_shortcode('audio', 'themesmith_audioplayer');   // use "[mp3]" in a post 

?>