<?php
/**
* Plugin Name: Insert HTML Code Sets
* Plugin URI: C:\xampp\htdocs\mytest\wp-content\plugins\justinsplugins\plugin1.php
* Description: This will implement adding HTML code sets according to admin specifications
* Version: 1.0
* Author: justinkperalta
* Author URI: Hip Hop Stuff
**/

//testing usage of add_action with custom functions and various hooks

//add_action('wp_body_open', 'get_text');
add_filter('the_content', 'last');
//add_filter('the_content', 'first');



function last($content) {
    return $content . "HTML CODE 3";
}
function first($content) {
    return "before text" . $content;
}


function get_text() {

    //extracts post content
    $content = apply_filters('the_content', get_the_content());
    $paragraphs = explode('</p>', $content);
$index = count($paragraphs) - 2;

echo "$paragraphs[$index]";

        $index = 0;
        foreach($paragraphs as $paragraph) {
            echo "$index $paragraph <br>";
            $index++;
        }
}


//insert text after every n paragraphs in post
add_filter( 'the_content', 'insert_media1' );
add_filter( 'the_content', 'insert_media2' );


function insert_media1( $content ) {
 $media = "HTML CODE 1!!!!!!";
 return insert_after_paragraph1( $media, 3, $content );
}
function insert_media2( $content ) {
 $media = "HTML CODE 2 ------";
 return insert_after_paragraph2( $media, 5, $content );
}


function insert_after_paragraph1( $insertion, $n, $content ) {

 $paragraphs = explode( '</p>', $content );

$index = 0;
 foreach ($paragraphs as $paragraph) {
     if ( trim( $paragraph ) ) {
        $paragraphs[$index] .= '</p>';
     }
     if ( ($index + 1) % $n == 0 ) {
        $paragraphs[$index] .= $insertion;
     }
     $index++;
 }

 return implode( '', $paragraphs );
}



function insert_after_paragraph2( $insertion, $n, $content ) {

 $paragraphs = explode( '</p>', $content );

$index = 0;
 foreach ($paragraphs as $paragraph) {
     if ( trim( $paragraph ) ) {
        $paragraphs[$index] .= '</p>';
     }
     if ( (($index + 1) % $n == 0 ) && $index > 6 ) {
        $paragraphs[$index] .= $insertion;
     }
     $index++;
 }

 return implode( '', $paragraphs );
}
