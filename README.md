wpse-playlist
=================

WordPress - Playlist shortcode with support for external audio and video files.

### Description

This plugin allows you to use external audio or video files with the native WordPress playlist, through the use of a shortcode.

This started as an answer on WordPress StackExchange, see [here](http://wordpress.stackexchange.com/questions/141766/making-audio-playlist-with-external-audio-files/), hence the name wpse-playlist.

The plugin works on PHP 5.3+ and WordPress 4.0+ 

Tested up to WordPress 5.8.1

It supports the GitHub Updater.

### Supported shortcodes and default attributes:

    [_playlist type="audio" 
                   class="wpse-playlist" 
                   current="true" 
                   autoplay="false" 
                   style="light" 
                   tracklist="true" 
                   tracknumbers="true" 
                   images="true" 
                   artists="true" 
                   width="" 
                   height=""
                   outer="20"
                   default_width="640"
                   default_height="380"]
        [_track src="" 
                   title="" 
                   type="audio/mpeg" 
                   caption="" 
                   description="" 
                   image="" 
                   meta_artist="" 
                   meta_album="" 
                   meta_genre=""
                   meta_length_formatted=""
                   image_src="%s/wp-includes/images/media/%s.png" 
                   image_width="48" 
                   image_height="64"
                   thumb_src="%s/wp-includes/images/media/%s.png" 
                   thumb_width="48" 
                   thumb_height="64"
                   dimensions_original_width="300" 
                   dimensions_original_height="200"
                   dimensions_resized_width="600" 
                   dimensions_resized_height="400"]
    [/_playlist]

where one can add multiple `[_track]`, one for each track, inside `[_playlist]`.

The shortcodes `[wpse_trac]` and `[wpse_playlist]` are also supported, but are deprecated.

When the `width` and `height` is empty, the global `$content_width` is used to calculate these values.

When the playlist type is `"video"` the track type is automatically set to `"video/mp4"` as the default value.

The attributes  `artists`, `images`, `meta_artist`, `meta_album` and `meta_genre` are only audio related.

Similarly the `dimensions_original_width`, `dimensions_original_height`, `dimensions_resized_width`, `dimensions_resized_height` are only video related.

### Demo

[Check it out here.](http://xlino.com/projects/wordpress-playlist-shortcode-with-external-audio-or-video-files/)

### Example 1

A simple example for the audio playlist:

    [_playlist]
       [_track title="Ain't Misbehavin'" src="//s.w.org/images/core/3.9/AintMisbehavin.mp3"]
       [_track title="Buddy Bolden's Blues" src="//s.w.org/images/core/3.9/JellyRollMorton-BuddyBoldensBlues.mp3"]
    [/_playlist]
 

### Example 2

The vanilla audio version is generated with:

    [_playlist type="audio" current="no" tracklist="yes" tracknumbers="no" images="no" artist="no"]
        [_track title="Davenport Blues" src="//s.w.org/images/core/3.9/DavenportBlues.mp3"]
        [_track title="Dixie Blues" src="//s.w.org/images/core/3.9/Louisiana_Five-Dixie_Blues-1919.mp3"]
    [/_playlist]

### Example 3

The video playlist can be generated with:

    [_playlist type="video"]
        [_track caption="Live widgets previews in WordPress 3.9" src="//s.w.org/images/core/3.9/widgets.mp4" image_src="/wp-content/uploads/2014/04/widgets_screen.png"]
        [_track caption="Another cool video showing how live widgets previews works in WordPress 3.9" src="//s.w.org/images/core/3.9/widgets.mp4" image_src="/wp-content/uploads/2014/04/widgets_screen2.png"]
    [/_playlist]


Any suggestions are welcomed.

### Changelog

0.0.9 (2015-08-02)

    - Fixed: Issue #7 by using true/false instead of 1/0 (Props: @X-PRESSIVE)


0.0.7 (2015-03-08) 

    - Added: New shortcodes [_playlist] and [_track].
    - Deprecated: The support for the shortcodes [wpse_playlist] and [wpse_trac] will phase out. 

0.0.6 (2015-03-07) 

    - Added: Support for the autoplay attribute.
    - Added: Support for the GitHub Updater. (Probs: @BlaineMoore)
    - Added: More info in the README.md file.
    - Changed: Refactored regarding late escaping.
    - Changed: Replaced filter_var() with wp_validate_boolean(), so we need WordPress 4.0+.
    - Fixed: Some minor adjustments.

0.0.5 

    - Fixed: added the missing script class to support WordPress 4.0 (Props: @ruLait)
