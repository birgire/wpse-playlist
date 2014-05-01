wpse-playlist
=================

WordPress - Playlist shortcode with external audio or video files

###Description

This plugin allows you to use external audio or video files with the native WordPress playlist, through the use of a shortcode.

This started as an answer on WordPress StackExchange, see here:

http://wordpress.stackexchange.com/questions/141766/making-audio-playlist-with-external-audio-files/

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

