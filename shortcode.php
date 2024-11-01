<?php
/**
 * Created by touqeer.shafi@gmail.com
 * Date: 4/30/13
 * Time: 1:50 PM
 * Filename : shortcode.php
 */

add_shortcode('heading', 'leads_heading');
function leads_heading($atts, $content) {
    extract(shortcode_atts(array(
        "type" => 'h3',
        "color" => '#000',
    ), $atts));
    return  "<{$type} style='color:{$color}'>". $content . "</$type>";
}

add_shortcode('button', 'leads_button');
function leads_button($atts, $content) {
    extract(shortcode_atts(array(
        "type" => 'medium',
        "class" => 'white',
        "url" => 'javascript:void(0)',
        "target" => 'self',
        "size" => 'small'
    ), $atts));

    return  "<a class='$class btn $size' href='$url' target='_{$target}'>". $content . "</a>";
}

add_shortcode('video', 'leads_video');

function leads_video($atts, $content){

    extract(shortcode_atts(array(
        "width" => 'auto',
        "height" => 'auto',
        "url" => '#',
    ), $atts));

    return '<iframe width="'.$width.'" height="'.$height.'" src="'.$url.'"></iframe>';

}


function notification($message){
    return '<div id="message" class="updated below-h2"><p>'.$message.'</p></div>';
}

add_action('init', 'add_button');
function add_button() {
    if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
    {
        add_filter('mce_external_plugins', 'add_video');
        add_filter('mce_buttons', 'register_video');

        add_filter('mce_external_plugins', 'add_heading');
        add_filter('mce_buttons', 'register_heading');

        add_filter('mce_external_plugins', 'add_btn');
        add_filter('mce_buttons', 'register_btn');
    }
}

function register_video($buttons) {
    array_push($buttons, "video");
    return $buttons;
}

function add_video($plugin_array) {
    $plugin_array['video'] = plugins_url().'/'.PLUGIN_NAME.'/js/customcodes.js';
    return $plugin_array;
}

function register_heading($buttons) {
    array_push($buttons, "heading");
    return $buttons;
}

function add_heading($plugin_array) {
    $plugin_array['heading'] = plugins_url().'/'.PLUGIN_NAME.'/js/customcodes.js';
    return $plugin_array;
}

function register_btn($buttons) {
    array_push($buttons, "button");
    return $buttons;
}

function add_btn($plugin_array) {
    $plugin_array['button'] = plugins_url().'/'.PLUGIN_NAME.'/js/customcodes.js';
    return $plugin_array;
}


