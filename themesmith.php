<?php
/**
 * @package ThemeSmith
 * @author Foxinni.com
 * @version 1.1
 */
/*
Plugin Name: ThemeSmith
Plugin URI: http://themesmith.com
Description: Give your theme a boost with the ThemeSmith Plugin. Adding [photos],[videos] and [audio] shortcodes.
Author: Foxinni
Version: 1.1
Author URI: http://foxinni.com
*/

include_once('files/options.php'); // Options template
include_once('files/setup.php'); // Options page

include_once('files/audio.php'); // Shost Codes [audio]
include_once('files/videos.php'); // Shost Codes [videos]
include_once('files/photos.php'); // Shost Codes [photos]

include_once('files/header.php'); // Header inserts
?>