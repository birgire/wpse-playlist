<?php 
/**
 * Plugin Name: WPSE Playlist shortcode for external files
 * Description: This plugin allows you to use external audio or video files with the native WordPress playlist, through the use of the [wpse_playlist] and [wpse_trac] shortcodes.
 * Plugin URI:  https://github.com/birgire/wpse-playlist
 * Author:      birgire
 * Author URI:  https://github.com/birgire
 * Version:     0.0.3
 */

namespace birgire;

/**
 * Autoload classes:
 */

spl_autoload_register(
    function( $class_name ){
			$path_part = plugin_dir_path( __FILE__ );
			$arr = explode( '\\', $class_name );
			$name_part = strtolower( array_pop( $arr ) );            
			$file_name = sprintf( '%sphp/class.%s.php', $path_part, $name_part );
			if( file_exists( $file_name ) )
                require_once( $file_name );
        }
);


/**
 * Register shortcodes:
 */

add_action( 'wp', '\birgire\playlist_init' );

function playlist_init()
{
    $playlist = new \birgire\Playlist;
    $playlist->init();
}


