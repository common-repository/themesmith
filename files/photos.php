<?php 

function themesmith_photoviewer($attr) {
    global $post;
    $themesmith = get_option('themesmith');
    
    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_photos', '', $attr);
    if ( $output != '' )
        return $output;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => $themesmith['photos_order'],
        'orderby'    => $themesmith['mp3_orderby'],
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => $themesmith['photos_cols'],
        'size'       =>  $themesmith['photos_thumbnail'] ,
        'source'     => $themesmith['photos_source'],
        'max'        => -1,
        'captions'   => $themesmith['photos_caption']
    ), $attr));

    $id = intval($id);
    $max = intval($max);
    $attachments = get_children( array(
            'post_parent' => $id, 
            'post_status' => 'inherit', 
            'post_type' => 'attachment', 
            'post_mime_type' => 'image', 
            'order' => $order, 
            'orderby' => $orderby, 
            'numberposts' => $max,
            ));

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        return;
    }
    else
    {

    $listtag = tag_escape($listtag);
    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns); 
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    
    $output = "<div class='themesmith-photos'>";

    foreach ( $attachments as $id => $attachment ) {
        $link = wp_get_attachment_image_src($id, $size, true);
        $src = wp_get_attachment_image_src($id, $source, true);
        $title = '';
        
        if (!empty($attachment->post_excerpt)){ $title = $attachment->post_title . ' - ' . $attachment->post_excerpt;}
        else { $title = $attachment->post_title;}
        
        $output .= "<{$itemtag} class='themesmith-photos-item' style='width: {$itemwidth}%'>";
        $output .= "<{$icontag} class='themesmith-photos-icon'><a href='$src[0]' title='$title'><img src='$link[0]'  alt='' /></a></{$icontag}>";
        if ($captions == 'on' ) {
            $output .= "<{$captiontag} class='themesmith-photos-title'>{$attachment->post_title}</{$captiontag}>";
            $output .= "<{$captiontag} class='themesmith-photos-caption' >{$attachment->post_excerpt}</{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
        if ( $columns > 0 && ++$i % $columns == 0 )
            $output .= '<br style="clear: both" />';
    }
    $output .= "<br style='clear: both;' /></div>\n";
    
    return $output;
    }
}
add_shortcode('photos', 'themesmith_photoviewer'); 

?>