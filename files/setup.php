<?php                                         
add_action('admin_menu', 'themesmith_setup'); 
add_action('admin_head', 'themesmith_setup_head');
function themesmith_setup() {
    if ( $_GET['page'] == 'themesmith/' . basename(__FILE__) ) {    
        if ( 'save' == $_REQUEST['action'] ) {    
            update_option( 'themesmith', $_POST );
         
           if( isset( $_REQUEST['save'] ) ) { update_option( 'themesmith', $_POST );   } // Saved?

            header("Location: admin.php?page=themesmith/setup.php&saved=true");
            die;

        } else if ( 'reset' == $_REQUEST['action'] ) {
                                                                                    
            delete_option( 'themesmith' );
              
            header("Location: admin.php?page=themesmith/setup.php&reset=true");
            die;
            
           
        }
    }
    if(function_exists(add_object_page))
    {
        add_object_page ('Customize Plugin','ThemeSmith', 'edit_themes', 'themesmith/' . basename(__FILE__), 'themesmith_setup_page', WP_PLUGIN_URL . '/themesmith/images/themesmith_logo.png'); 
    }
    else
    {
        add_menu_page('Customize Plugin','ThemeSmith', 'edit_themes', 'themesmith/' . basename(__FILE__), 'themesmith_setup_page', WP_PLUGIN_URL . '/themesmith/images/themesmith_logo.png'); 
    }

}

function themesmith_setup_page (){
if ( $_REQUEST['saved'] ) { ?><div id="message1" class="updated fade"><p><?php printf('ThemeSmith options saved. <a href="%s">View site &raquo;</a>', get_bloginfo('home') . '/'); ?></p></div><?php }
if ( $_REQUEST['reset'] ) { ?><div id="message2" class="updated fade"><p>ThemeSmith options reset.</p></div><?php } ?>

<div class="wrap">
<h2>ThemeSmith Shortcode Options</h2>
     <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <p class="submit">
                <input name="save" type="submit" value="Save Options &raquo;" />  
                <input name="action" type="hidden" value="save" />
            </p>    
            <?php  themesmith_create_options();   // Oh, it's magic  ?>
            
            <p class="submit">
                <input name="save" type="submit" value="Save Options &raquo;" />  
                <input name="action" type="hidden" value="save" />
            </p>
   </form>
   
   
        <form action="<?php echo wp_specialchars( $_SERVER['REQUEST_URI'] ) ?>" method="post">
        <?php wp_nonce_field('reset_options'); echo "\n"; ?>
        <p class="submit">
            <input name="reset" type="submit" value="Reset Settings" onclick="return confirm('Click OK to reset. Any changes to these theme options will be lost!');" tabindex="44" accesskey="R" />
            <input name="action" type="hidden" value="reset" />
      
        </p>
    </form>
    </div>
 <?php
}

function themesmith_setup_head(){    
?>
<style>
.option{ background: #F1F1F1; border: 1px solid #e3e3e3;  margin: 10px 20px 10px 10px; }
.option .styler{   border-top:1px #fff solid;  padding: 15px;}
.option small { color: #aaa;}
.option .heading {border-bottom: 1px solid #e3e3e3; padding-bottom: 5px; margin-bottom:20px;}
.option .heading h3{ color:#464646;}
.option .heading h3 {font-family:Georgia,"Times New Roman"; font-size:24px; font-style:italic; font-variant:normal; font-weight:normal; line-height:35px; margin:0; padding:0px 15px 3px 0; }
.option .heading h4{ display: inline; padding: 0; margin:0 ; border:0}
.option .heading small{ margin-left: 10px; display: block;}
.option .sub-heading {border-bottom: 1px solid #e3e3e3; padding-bottom: 0px; margin:15px 0 20px;}
.option .sub-heading b {font-family:Georgia,"Times New Roman"; font-size:16px; font-style:italic; font-variant:normal; font-weight:normal; line-height:20px; margin:0; padding:0px 0px 3px 0; }
.option .sub-heading i { margin-left: 10px;color: #aaa; font-size: 11px;}
.option .row{ margin:5px 0 5px 10px; padding-bottom: 5px; border-bottom: 1px #ececec solid;}
.option .row span{  display: block;}
.option .row label{display: block; float:left;width: 250px; margin: 5px 10px 0 0 ;}
.option .row label span {display: inline; float:left; text-indent:20px; color: #aaa;}
.option .row input.input-text{ border:1px solid #bbb; background: #fff; width: 260px; margin-right: 10px; font-size: 11px; color: #9a9a9a; padding: 5px 3px;}
.option .row input.input-text:focus{ color: #222;}
.option .row .input-select{ border:1px solid #bbb; background: #fff; width: 260px; margin-right: 10px; font-size: 11px; color: #9a9a9a; padding: 5px 3px;}
.option .row .input-select:focus{ color: #222;}
.option .row textarea{ border:1px solid #ccc; background: #fff; width: 350px; margin-right: 10px; height: 180px; color: #aaa; font-size: 11px;  vertical-align: text-top;}
.option .row textarea:focus{color: #222;}
.option .row input.input-checkbox{ margin: 5px; }
.option .row input.input-radio{ margin: 3px 10px 0 10px; }
.option .row ul {padding-left: 20px; margin: 10px 0}
.option .row ul li{padding: 5px 0; list-style: disc;}
.option .row ul li li{padding: 0px 0; list-style: square; color: #666;}
.cl:after{display:block; clear:both; height:0; visibility: hidden; content: ".";}

</style>
<?php /*
<script type="text/javascript">
jQuery(document).ready(function(){

        jQuery('.styler').each(function() {
           if (jQuery(this).height() > 500)
           {
                 jQuery(this).css('height','380px').css('overflow-y','scroll');
            }
        });
});
</script>
*/ 
}

function themesmith_create_options(){

$themesmith_template = get_settings('themesmith_template');

                                        
    foreach ($themesmith_template as $tier => $inits){
        echo "<div class='clear'></div>";

        
           if ($inits['active'] == false)
           { continue;} // Check of "Option Set" is enabled, then continues.
           else
           {
           echo "<div class='option'><div class='styler'>";
           
        foreach ($inits as $settings => $init)
        {            
                   if($settings == "heading"){
                       echo "<div class='heading'><h3>{$init['value']}</h3><small>{$init['meta']}</small></div>";
                   }
                   
                   if($settings == "options")
                   {
                       foreach ($init as $name => $option)
                       {
                            themesmith_machine($option,$id,$name);
                       }
                   }
            }
        }   
        echo "</div></div>";
    }
    echo "<div style='display:none'><pre>"; //Debugging Purposes
    $themesmith_new_options = get_settings('themesmith');
    print_r($themesmith_new_options);
    echo '</pre></div>';     
    
}

function themesmith_machine($option,$id,$name = ''){
    $themesmith_new_options = get_settings('themesmith');    
      

         $id = $option['id'];    
            
         $value = $themesmith_new_options[$name];
         
         if ($value == '') { $value = $option['value']; };

            $output = '';
            switch ($option['type']) {
                   case "heading":
                        echo "<div class='sub-heading'><b>{$option['value']}</b><i>{$option['info']}</i></div>";                                                                                                                                                                      
                       break;
                       case "input-text":
                                   $output .=  "<div class='row cl'>";
                                   $output .=  "<label>{$option['label']}</label>";
                                   $output .= "<input class='input-text' type='text' name='{$name}'";
                                   $output .= "value='{$value}' />";
                                   $output .= "<small>{$option['info']}</small>";
                                   $output .= "</div>";
                                   echo $output;                                                                                                                                                                    
                       break;
                       case "input-checkbox":
                                   $output .=  "<div class='row cl'>";
                                   $output .=  "<label>{$option['label']}</label>";
                                   $output .= "<input class='input-checkbox' type='checkbox' name='{$name}' ";
                                        if($value == "on"){ $output .= "checked=''"; }
                                   $output .= "/>";
                                   $output .= "<small>{$option['info']}</small>";
                                   $output .= "</div>";
                                   echo $output;                                                                                                                                                                    
                       break;
                       case "input-radio":
                                   $output .=  "<div class='row cl'>";
                                   $output .=  "<label>{$option['label']}</label>";
                                   $output .= "<input class='input-radio' type='radio' value='{$option['id']}' name='{$name}' ";
                                        if($value == $option['id']){ $output .= "checked=''"; }
                                   $output .= "/>";
                                   $output .= "<small>{$option['info']}</small>";
                                   $output .= "</div>";
                                   echo $output;                                                                                                                                                                    
                       break;     
                       case "input-textarea";
                                   $output .=  "<div class='row cl'>";
                                   $output .=  "<label>{$option['label']}</label>";
                                   $output .= "<textarea class='input-textarea' name='{$name}'>{$value}</textarea>";
                                   $output .= "<small>{$option['info']}</small>";
                                   $output .= "</div>";
                                   echo $output;                                                                                                                                                                    
                       break;
                       case "input-select";
                                   $output .=  "<div class='row cl'>";
                                   $output .=  "<label>{$option['label']}</label>";
                                   $output .= "<select class='input-select' name='{$name}'>";
                                        $options = "";
                                        foreach($option['selection'] as $selected){
                                            $options .= "<option value='{$selected}' ";
                                                 if($value == $selected){ $options .= "selected='' "; }
                                            $options .= ">{$selected}</option>";
                                        }
                                   $output .= $options;
                                   $output .= "</select>";
                                   $output .= "<small>{$option['info']}</small>";
                                   $output .= "</div>";
                                   echo $output;                                                                                                                                                      
                       break;


    }
}
?>