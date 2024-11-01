<?php

/* Setup Options 
* Skins - http://www.longtailvideo.com/addons/skins?q=&sort=popularity&dir=desc 
* 
*/

function do_plugin(){
    
//Setting up the Defults

$defaults = array(
    //Photos
    'photos_thumbnail' => 'thumbnail',
    'photos_source' => 'large',
    'photos_caption' => 'on',
    'photos_order' => 'DESC',
    'photos_orderby' => 'menu_order date',
    'photos_cols' => '3',
    'photos_padding' => '12px',
    'photos_border_color' => '#dddddd',
    'photos_frame_color' => '#f7f7f7',
    //Videos
    'videos_caption' => 'on',
    'videos_caption_link' => 'off',
    'videos_order' => 'DESC',
    'videos_orderby' => 'menu_order date',
    'videos_width' => '450',
    'videos_height' => '320',
    'video_volume' => '50',
    'video_repeat' => 'none',
    'video_auto' => 'false',
    'videos_image' => 'http://',
    'videos_skin' => WP_PLUGIN_URL . '/themesmith/tools/skins/stylish_slim.swf',
    //Audio
    'audio_caption' => 'on',
    'audio_caption_link' => 'off',
    'audio_order' => 'DESC',
    'audio_orderby' => 'menu_order date',
    'audio_width' => '350',
    'audio_height' => '30',
    'audio_volume' => '50',
    'audio_repeat' => 'none',
    'audio_auto' => 'false',
    'audio_image' => 'http://',
    'audio_skin' => WP_PLUGIN_URL . '/themesmith/tools/skins/stylish_slim.swf',
    
        
);

add_option('themesmith',$defaults);
    
$themesmith_template = array(
    
    "photos" => array(
    
        "active" => true,
        "heading" => array(
            "tag" => "h3",
            "value" => "[Photos] Setup",
            "info" => "Modify the default option for the [photos] shortcode"
        ),
        "options" => array(
           "photos_caption" => array( 
                        "label" => "Captions",
                        "type" => "input-select",
                        "selection" => array("on","off"),
                        "value" => "on",
                        "info" => "Enable or Disable captions on Photos"),
                        
             "photos_thumbnail" => array( 
                    "label" => "Thumnail Size",
                    "type" => "input-select",
                    "selection" => array("thumbnail","medium","large","full"),
                    "value" => "thumbnail",
                    "info" => "Default thumbnail size"),

           "photos_source" => array( 
                        "label" => "Source Size",
                        "type" => "input-select",
                        "selection" => array("thumbnail","medium","large","full"),
                        "value" => "large",
                        "info" => "When an image is clicked, this is the source image size"),
                        
            "photos_order" => array( 
                    "label" => "Photos Order",
                    "type" => "input-select",
                    "selection" => array("DESC","ASC"),
                    "value" => "DESC",
                    "info" => "Change default order of photo uploads"),    
                    
            "photos_orderby" => array( 
                    "label" => "Photos Order By",
                    "type" => "input-text",
                    "value" => "menu_order date",
                    "info" => "Arguments by which the attachments get ordered. <a href='http://bit.ly/DEaqU'>More Info</a>"),                        
                    
            "photos_cols" => array( 
                    "label" => "Columns",
                    "type" => "input-text",
                    "value" => "2",
                    "info" => "Default amount of columns shortcode will create"),
                        
            "photos_padding" => array( 
                        "label" => "Image Padding",
                        "type" => "input-text",
                        "value" => "12px",
                        "info" => "Padding around photos in px."),
                        
            "photos_border_color" => array( 
                        "label" => "Border Color",
                        "type" => "input-text",
                        "value" => "#dddddd",
                        "info" => "Define a color to replace the default color"), 
                        
            "photos_frame_color" => array( 
                        "label" => "Frame Color",
                        "type" => "input-text",
                        "value" => "#f7f7f7",
                        "info" => "Define a Hex color te replace the default color"),

        ),         
    ),   
        
   "video" => array(
    
        "active" => true,
        "heading" => array(
            "tag" => "h3",
            "value" => "[Videos] Setup",
            "info" => "Modify the default option for the [video] shortcode"
        ),
        "options" => array(
            "videos_captions" => array( 
                    "label" => "Captions",
                    "type" => "input-select",
                    "selection" => array("on","off"),
                    "value" => "on",
                    "info" => "Enable or Disable captions on Videos"),  
                    
           "videos_caption_link" => array( 
                        "label" => "Caption Link",
                        "type" => "input-select",
                        "selection" => array("on","off"),
                        "value" => "off",
                        "info" => "Enable or disable a link to the source file on the caption text"),  
                    
            "videos_order" => array( 
                    "label" => "Video Order",
                    "type" => "input-select",
                    "selection" => array("DESC","ASC"),
                    "value" => "DESC",
                    "info" => "Change default order of video uploads"), 
                    
            "videos_orderby" => array( 
                    "label" => "Videos Order By",
                    "type" => "input-text",
                    "value" => "menu_order date",
                    "info" => "Arguments by which the attachments get ordered. <a href='http://bit.ly/DEaqU'>More Info</a>"),    
                                           
             "videos_width" => array( 
                    "label" => "Width",
                    "type" => "input-text",
                    "value" => "450",
                    "info" => "Default width setting"),

             "videos_height" => array( 
                        "label" => "Height",
                        "type" => "input-text",
                        "value" => "320",
                        "info" => "Default height setting"),
                        
              "videos_volume" => array( 
                        "label" => "Volume",
                        "type" => "input-text",
                        "value" => "50",
                        "info" => "Default video player volume (0 - 100)"), 
                        
              "videos_repeat" => array( 
                        "label" => "Repeat",
                        "type" => "input-select",
                        "selection" => array("none","always"),
                        "value" => "none",
                        "info" => "Set whether video player will reapeat or not"),
                        
              "videos_auto" => array( 
                        "label" => "Auto Play",
                        "type" => "input-select",
                        "selection" => array("false","true"),
                        "value" => "false",
                        "info" => "Set whether video player will auto play on load"),
                        
              "videos_image" => array( 
                        "label" => "Poster Image",
                        "type" => "input-text",
                        "value" => "http://",
                        "info" => "URL of video player's opening image. (Use manual override for more specific usage)"),  
                        
              "videos_skin" => array( 
                        "label" => "Player Skin",
                        "type" => "input-text",
                        "value" => WP_PLUGIN_URL . "/themesmith/tools/skins/stylish_slim.swf",
                        "info" => "Change the default audio player skin. <a href='http://bit.ly/L1rC5'>More skins here</a>"),    
            ),
        ),
        

    "audio" => array( 
    
        "active" => true,
        "heading" => array(
            "tag" => "h3",
            "value" => "[Audio] Setup",
            "info" => "Modify the default option for the [audio] shortcode"
        ),
        "options" => array(                 
            "audio_captions" => array( 
                        "label" => "Captions",
                        "type" => "input-select",
                        "selection" => array("on","off"),
                        "value" => "on",
                        "info" => "Enable or disable captions on audio uploads"),
                        
           "audio_caption_link" => array( 
                        "label" => "Caption Link",
                        "type" => "input-select",
                        "selection" => array("on","off"),
                        "value" => "off",
                        "info" => "Enable or disable a link to the source file on the caption text"),  
                        
            "audio_order" => array( 
                    "label" => "Order",
                    "type" => "input-select",
                    "selection" => array("DESC","ASC"),
                    "value" => "DESC",
                    "info" => "Change default order of audio uploads"),  
            
            "audio_orderby" => array( 
                    "label" => "Order By",
                    "type" => "input-text",
                    "value" => "menu_order date",
                    "info" => "Arguments by which the attachments get ordered. <a href='http://bit.ly/DEaqU'>More Info</a>"),      

             "audio_width" => array( 
                        "label" => "Width",
                        "type" => "input-text",
                        "value" => "350",
                        "info" => "Default audio players width"),
                        
             "audio_height" => array( 
                        "label" => "Height",
                        "type" => "input-text",
                        "value" => "30",
                        "info" => "Default audio player height (Only adjust when skins are changed)"),

              "audio_volume" => array( 
                        "label" => "Volume",
                        "type" => "input-text",
                        "value" => "50",
                        "info" => "Default audio player volume (0 - 100)"), 
                        
              "audio_repeat" => array( 
                        "label" => "Repeat",
                        "type" => "input-select",
                        "selection" => array("none","always"),
                        "value" => "none",
                        "info" => "Set whether audio player will reapeat or not"),
                        
              "audio_auto" => array( 
                        "label" => "Auto Play",
                        "type" => "input-select",
                        "selection" => array("false","true"),
                        "value" => "false",
                        "info" => "Set whether audio player will auto play on load"),
                        
              "audio_image" => array( 
                        "label" => "Poster Image",
                        "type" => "input-text",
                        "value" => "http://",
                        "info" => "URL of audio player's opening image. (Use manual override for more specific usage)"),  

              "audio_skin" => array( 
                        "label" => "Player Skin",
                        "type" => "input-text",
                        "value" => WP_PLUGIN_URL . "/themesmith/tools/skins/stylish_slim.swf",
                        "info" => "Change the default audio player skin. <a href='http://bit.ly/L1rC5'>More skins here</a>"),
            )
    )

);
    
update_option('themesmith_template',$themesmith_template);    

}
add_action('init','do_plugin');
?>