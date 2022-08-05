<?php
/*
 * Plugin Name: Insert HTML Code Sets
 * Plugin URI:
    C:\xampp\htdocs\mytest\wp-content\plugins\justinsplugins\plugin1.php
 * Description: This plugin implements adding HTML
    code sets according to admin specifications.
 * Version: 1.0
 * Author: justinkperalta
 * Author URI: Hip Hop Stuff
 */


//Below filters insert corresponding code sets after every $n paragraphs

//HTML CODE 1
add_filter('the_content', 'insert_media_1');

//HTML CODE 2
add_filter('the_content', 'insert_media_2');

//HTML CODE 3
add_filter('the_content', 'insert_after_last');


//Inserts media according to specifications for HTML CODE 1
function insert_media_1($content) {
    $media = '<div>Ex. iFrame goes here (HTML CODE 1)</div>';
    $n = 3; //User specifies number of paragraphs that come before CODE 1

    //User is admin and single post check
    if (is_single() && current_user_can('manage_options')) {
        return insert_after_paragraph1($media, $n, $content);
    }
    return $content;
}

//Inserts media according to specifications for HTML CODE 2
function insert_media_2($content) {
    $media = '<div>Ex. Advertisement goes here (HTML CODE 2)</div>';

     //User specifies min number of paragraphs before first insert of CODE 2
    $minParagraphIndex = 6;

    $n = 5; //User specifies number of paragraphs that come before CODE 2

    //User is admin and single post check
    if (is_single() && current_user_can('manage_options')) {
        return insert_after_paragraph2($media, $minParagraphIndex,
                    $n, $content);
    }
    return $content;
}


//Locates the appropriate section to insert CODE 1 by counting paragraphs
function insert_after_paragraph1($insertion, $n, $content) {

    //Store content of post in array of its paragraphs
    $paragraphs = explode('</p>', $content);

    foreach ($paragraphs as $index => $paragraph) {
         if (trim($paragraph)) {
            $paragraphs[$index] .= '</p>';
         }
         //Insert media if paragraph number is multiple of $n
         if (($index + 1) % $n == 0) {
            $paragraphs[$index] .= $insertion;
         }
     }
     return implode('', $paragraphs);
}

//Locates the appropriate section to insert CODE 2 by counting paragraphs
function insert_after_paragraph2($insertion, $m, $n, $content) {

    //Store content of post in array of its paragraphs
    $paragraphs = explode('</p>', $content);

    foreach ($paragraphs as $index => $paragraph) {
         if (trim($paragraph)) {
            $paragraphs[$index] .= '</p>';
         }
         //Insert media if paragraph number is multiple of $n
         //and at least $m paragraphs into the post
         if ((($index + 1) % $n == 0) && $index > $m) {
            $paragraphs[$index] .= $insertion;
         }
     }
     return implode('', $paragraphs);
}

//Inserts CODE 3 at the very end of the post after last paragraph
function insert_after_last($content) {
    return $content . '<div>Ex. Form goes here (HTML CODE 3)</div>';
}
?>


