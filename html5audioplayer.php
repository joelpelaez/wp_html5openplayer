<?php
/**
 * @package HTML5_Open_Player
 * @version 0.1
 */
/*
  Plugin Name: HTML5 Open Player
  Plugin URI: http://github.com/darkmega0/wp_html5openplayer
  Description: A simple HTML5 Audio Player for Ogg/Vorbis/Theora or WebM format with <video> and <audio> tag compatibles with HTML5 Standard. 
  Version: 0.1
  Author: Joel Peláez Jorge
  Author URI: http://darkmegazero.wordpress.com/
  License: GPLv3
*/
/*
  HTML5 Open Player for Wordpress
  Copyright (C) 2012 Joel Peláez Jorge <joelpelaez@gmail.com>

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/*
  Manage audio5 tag for use only open formats: Ogg
  Example use: 
     [audio5 src="file.ogg" {autoplay="autoplay"} {loop="loop"} {preload="none"|"auto"|"meadata"}  ]
*/
function html5audio_shortcode ($attrs, $content = null) {
  extract (shortcode_atts (array ('src' => '',
                                  'autoplay' => '',
                                  'loop' => '',
                                  'preload' => ''
                                  ), $attrs ));
  /* Check mime type */
  if (strpos ($src, '.ogg') === FALSE)
    return "<br>"
           "Error: Cannot open file: It's not a open format.<br>"
           "Please Use Ogg/Vorbis format.<br>"; 

  $output  = '<audio controls="controls" ';
  if ($autoplay == 'autoplay')
    $output .= 'autoplay="autoplay" ';
  if ($loop == 'loop')
    $output .= 'loop="loop" ';
  if ($preload != '')
    $output .= 'preload="' . $preload . '"';
  $output .= '>';
  $output .= '<source src="' . $src . '" type="audio/ogg" />';
  $output .= '</audio>';
  return $output;
}
add_shortcode ('audio5', 'html5audio_shortcode');

/*
  Manage video5 tag for use only open formats: Ogg or WebM
  Example use:
     [video5 src="file.ogg" type="video/openformattype" {height="size"} {width="size"}
     {autoplay="autoplay"} {loop="loop"} {preload="none"|"auto"|"meadata"}  ]
*/
function html5video_shortcode ($attrs, $content = null) {
  extract (shortcode_atts (array ('src' => '',
                                  'type' => '',
                                  'height' => '',
                                  'width' => '',
                                  'autoplay' => '',
                                  'loop' => '',
                                  'preload' => ''
                                  ), $attrs ));
  /* Check mime type of video. */
  if ((strpos ($src, '.ogg')
       || strpos ($src, '.ogv')
       || strpos ($src, '.webm')) === FALSE)
    return "<br>"
           "Error: Cannot open file: It's not a open format.<br>"
           "Use Ogg/Theora or WebM format.<br>";

  /* Check mime type used for video5. */
  if (($type == "video/ogg") || ($type == "video/webm"))
    return "<br>"
           "Error setting mime type for video: Actually type is: $type.<br>"
           "Please use correct mime type.<br>";

  $output  = '<video controls="controls" ';
  if ($autoplay == 'autoplay')
    $output .= 'autoplay="autoplay" ';
  if ($loop == 'loop')
    $output .= 'loop="loop" ';
  if ($preload != '')
    $output .= 'preload="' . $preload . '" ';
  if ($height != '')
    $output .= 'height="' . $height . '" ';
  if ($width != '')
    $output .= 'width="' . $width . '" ';
  $output .= '>';
  $output .= '<source src="' . $src . '" type="' . $type . '"/>';
  $output .= '</video>';
  return $output;
}
add_shortcode ('video5', 'html5video_shortcode');
?>
