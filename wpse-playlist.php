<?php 
/**
 * Plugin Name:       WPSE Playlist shortcode for external files
 * Description:       This plugin allows you to use external audio or video files with the native WordPress playlist, through the use of the [_playlist] and [_trac] shortcodes.
 * Plugin URI:        https://github.com/birgire/wpse-playlist
 * GitHub Plugin URI: https://github.com/birgire/wpse-playlist.git
 * Author:            Birgir Erlendsson (birgire)
 * Author URI:        https://github.com/birgire
 * Version:           0.0.8
 */

namespace birgire;

/**
 * Minimum PHP version:
 */
define( 'WPSE_PLAYLIST_MIN_PHP_VER', '5.3.3' );


/**
 * Autoload classes:
 */

\spl_autoload_register(
    function( $class_name )
    {
        $path_part 	= plugin_dir_path( __FILE__ );
        $arr 		= explode( '\\', $class_name );
        $name_part 	= strtolower( array_pop( $arr ) );            
        $file_name 	= sprintf( '%sphp/class.%s.php', $path_part, $name_part );
        if( file_exists( $file_name ) )
        {
            require_once( $file_name );
        }
    }
);


/**
 * Register shortcodes:
 */

\add_action( 'wp', '\birgire\playlist_init' );

function playlist_init()
{
    if( class_exists( '\birgire\Playlist' ) )
    {
        $playlist = new \birgire\Playlist;
        $playlist->init();
    }
}
