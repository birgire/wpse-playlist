wpse-playlist
=================

WordPress - Playlist shortcode with external audio or video files

###Description

This plugin allows you to use external audio or video files with the native WordPress playlist, through the use of a shortcode.

This started as an answer on WordPress StackExchange, see [here](http://wordpress.stackexchange.com/questions/141766/making-audio-playlist-with-external-audio-files/).

The plugin works on PHP 5.3+ and WordPress 4.0+ 

It supports the GitHub Updater.

###Supported shortcodes and their default attributes:

    [wpse_playlist type="audio" 
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
        [wpse_trac src="" 
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
    [/wpse_playlist]

where one can add multiple `[wpse_trac]`, one for each trac, inside `[wpse_playlist]`.

When the `width` and `height` is empty, the global `$content_width` is used to calculate these values.

When the playlist type is `"video"` then the trac type is automatically set to `"video/mp4"` as the default value.

The attributes  `artists`, `images`, `meta_artist`, `meta_album`, `meta_genre` are only audio related.

Similarly the `dimensions_original_width`, `dimensions_original_height`, `dimensions_resized_width`, `dimensions_resized_height` are only video related.

###Example 1

    [wpse_playlist]
       [wpse_trac title="Ain't Misbehavin'" src="//s.w.org/images/core/3.9/AintMisbehavin.mp3"]
       [wpse_trac title="Buddy Bolden's Blues" src="//s.w.org/images/core/3.9/JellyRollMorton-BuddyBoldensBlues.mp3"]
    [/wpse_playlist]


The global settings are under `options-writing.php`:
 

###Example 2

The vanilla  version is generated with:

    [wpse_playlist type="audio" current="no" tracklist="yes" tracknumbers="no" images="no" artist="no"]
        [wpse_trac title="Davenport Blues" src="//s.w.org/images/core/3.9/DavenportBlues.mp3"]
        [wpse_trac title="Dixie Blues" src="//s.w.org/images/core/3.9/Louisiana_Five-Dixie_Blues-1919.mp3"]
    [/wpse_playlist]

###Example 3

The video playlist can be generated with:

    [wpse_playlist type="video"]
        [wpse_trac caption="Live widgets previews in WordPress 3.9" src="//s.w.org/images/core/3.9/widgets.mp4" image_src="/wp-content/uploads/2014/04/widgets_screen.png"]
        [wpse_trac caption="Another cool video showing how live widgets previews works in WordPress 3.9" src="//s.w.org/images/core/3.9/widgets.mp4" image_src="/wp-content/uploads/2014/04/widgets_screen2.png"]
    [/wpse_playlist]


Any suggestions are welcomed.

###Changelog

0.0.6 
    - Added: Support for the autoplay attribute.
    - Added: Support for the GitHub Updater. (Probs: @BlaineMoore)
    - Added: More info in the README.md file.
    - Changed: Refactored regarding late escaping.
    - Fixed: Some minor adjustments.
0.0.5 
    - Fixed: added the missing script class to support WordPress 4.0 (Props: @ruLait)
