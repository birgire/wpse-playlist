<?php

/**
 * Class Playlist
 */

namespace birgire;

class Playlist
{
    protected $type     = '';
    protected $types    = array( 'audio', 'video' );
    protected $instance = 0;
    
    /**
     * Init - Register shortcodes
     */
 
    public function init()
    {
        add_shortcode( 'wpse_playlist', array( $this, 'playlist_shortcode' ) );
        add_shortcode( 'wpse_trac',     array( $this, 'trac_shortcode'     ) );
    }


    /**
     * Callback for the [wpse_playlist] shortcode
     *
     * @uses wp_validate_boolean() from WordPress 4.0
     */
	 
    public function playlist_shortcode( $atts = array(), $content = '' ) 
    {        
        global $content_width;  // Theme dependent content width
        $this->instance++;      // Counter to activate the 'wp_playlist_scripts' action only once

        $atts = shortcode_atts( 
            array(
                'type'           => 'audio',
                'style'          => 'light',
                'tracklist'      => 'true',
                'tracknumbers'   => 'true',
                'images'         => 'true',     // Audio related
                'artists'        => 'true',     // Audio related
                'current'        => 'true',
		'autoplay'       => 'false',
		'class'          => 'wpse-playlist',
		'width'          => '',
		'height'         => '',
		'outer'          => '20',
		'default_width'  => '640',
		'default_height' => '380',
            ), 
            $atts, 
            'wpse_playlist_shortcode' 
        );
   
        // Autoplay:
        $autoplay = wp_validate_boolean( $atts['autoplay'] ) ? 'autoplay="yes"' : '';

        // Nested shortcode support:
        $this->type = ( in_array( $atts['type'], $this->types, TRUE ) ) ? esc_attr( $atts['type'] ) : 'audio';
 
        // Enqueue default scripts and styles for the playlist.
        ( 1 === $this->instance ) && do_action( 'wp_playlist_scripts', esc_attr( $atts['type'] ), esc_attr( $atts['style'] ) );
        
        //----------
        // Height & Width - Adjusted from the WordPress core
        //----------
        
        $width = esc_attr( $atts['width'] );       
        if( empty( $width ) )
            $width = empty( $content_width ) 
                ? intval( $atts['default_width'] ) 
                : ( $content_width - intval( $atts['outer'] ) );
       
        $height = esc_attr( $atts['height'] );       
        if( empty( $height ) && intval( $atts['default_height'] ) > 0 )
            $height = empty( $content_width ) 
                ? intval( $atts['default_height'] )
                : round( ( intval( $atts['default_height'] ) * $width ) / intval( $atts['default_width'] ) );

        //----------
        // Output
        //----------
        $html = '';
        $html .= sprintf( '<div class="wp-playlist wp-%s-playlist wp-playlist-%s ' .  esc_attr( $atts['class'] ) . '">', 
	    $this->type, 
            esc_attr( $atts['style'] )
        );

        // Current audio item:
        if( $atts['current'] && 'audio' === $this->type )
	{
            $html .= '<div class="wp-playlist-current-item"></div>';   
        }

        // Video player:					  
        if( 'video' === $this->type )
        {
            $html .= sprintf( '<video controls="controls" ' . $autoplay . ' preload="none" width="%s" height="%s"></video>',
                $width,
                $height
            );
        }
        // Audio player:					  
        else
        {
            $html .= sprintf( '<audio controls="controls" ' . $autoplay . ' preload="none" width="%s" style="visibility: hidden"></audio>', 
                $width 
            );
        }

        // Next/Previous:
        $html .= '<div class="wp-playlist-next"></div><div class="wp-playlist-prev"></div>';

        // JSON	
        $html .= sprintf( '
            <script class="wp-playlist-script" type="application/json">{
                "type":"%s",
                "tracklist":%b,
                "tracknumbers":%b,
                "images":%b,
                "artists":%b,
                "tracks":[%s]
            }</script></div>', 
            esc_attr( $atts['type'] ), 
            wp_validate_boolean( $atts['tracklist'] ), 
            wp_validate_boolean( $atts['tracknumbers'] ),  
            wp_validate_boolean( $atts['images'] ),
            wp_validate_boolean( $atts['artists'] ),
            $this->get_tracs_from_content( $content )
        );

        return $html;
    }

  
    /**
     * Get tracs from the wpse_playlist shortcode content string
     */

    private function get_tracs_from_content( $content )
    {
        // Get tracs:
	$content = strip_tags( nl2br( do_shortcode( $content ) ) );
	
        // Replace last comma:
        if( FALSE !== ( $pos = strrpos( $content, ',' ) ) )
        {
            $content = substr_replace( $content, '', $pos, 1 );
        }
				
        return $content;
    }


    /**
     * Callback for the [wpse_trac] shortcode
     */

    public function trac_shortcode( $atts = array(), $content = '' ) 
    {        
        $atts = shortcode_atts( 
            array(
                'src'                        => '',
                'type'                       => ( 'video' === $this->type ) ? 'video/mp4' : 'audio/mpeg',
                'title'                      => '',
                'caption'                    => '',
                'description'                => '',
                'image_src'                  => sprintf( '%s/wp-includes/images/media/%s.png', get_site_url(), $this->type ),
                'image_width'                => '48',
                'image_height'               => '64',
                'thumb_src'                  => sprintf( '%s/wp-includes/images/media/%s.png', get_site_url(), $this->type ),
                'thumb_width'                => '48',
                'thumb_height'               => '64',
                'meta_artist'                => '',
                'meta_album'                 => '',
                'meta_genre'                 => '',
                'meta_length_formatted'      => '',
                'dimensions_original_width'  => '300',
                'dimensions_original_height' => '200',
                'dimensions_resized_width'   => '600',
                'dimensions_resized_height'  => '400',
            ), 
            $atts, 
            'wpse_trac_shortcode' 
        );

        //----------
        // Data output:
        //----------
        $data['src']                      = esc_url( $atts['src'] );
        $data['title']                    = sanitize_text_field( $atts['title'] );
        $data['type']                     = sanitize_text_field( $atts['type'] );
        $data['caption']                  = sanitize_text_field( $atts['caption'] );
        $data['description']              = sanitize_text_field( $atts['description'] );
        $data['image']['src']             = esc_url( $atts['image_src'] );
        $data['image']['width']           = intval( $atts['image_width'] );
        $data['image']['height']          = intval( $atts['image_height'] );
        $data['thumb']['src']             = esc_url( $atts['thumb_src'] );
        $data['thumb']['width']           = intval( $atts['thumb_width'] );
        $data['thumb']['height']          = intval( $atts['thumb_height'] );
        $data['meta']['length_formatted'] = sanitize_text_field( $atts['meta_length_formatted'] );

        // Video related:
        if( 'video' === $this->type ) 
        {
            $data['dimensions']['original']['width']  = sanitize_text_field( $atts['dimensions_original_width'] );
            $data['dimensions']['original']['height'] = sanitize_text_field( $atts['dimensions_original_height'] );
            $data['dimensions']['resized']['width']   = sanitize_text_field( $atts['dimensions_resized_width'] );
            $data['dimensions']['resized']['height']  = sanitize_text_field( $atts['dimensions_resized_height'] );

    	// Audio related:
        } else {
            $data['meta']['artist'] = sanitize_text_field( $atts['meta_artist'] );
            $data['meta']['album']  = sanitize_text_field( $atts['meta_album'] );
            $data['meta']['genre']  = sanitize_text_field( $atts['meta_genre'] );
        }

        return json_encode( $data ) . ',';      
    }

} // end class


