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
add_action('wp_body_open', 'insert_text');
add_action('wp_body_open', 'get_text');

function insert_text() {
    echo "this is text";
}

function get_text() {

    //extracts post content
    $content = apply_filters('the_content', get_the_content());
    $paragraphs = explode('</p>', $content);
    $first_paragraph = array_shift($paragraphs).'</p>';

    echo $first_paragraph;
    $first_paragraph = array_shift($paragraphs).'</p>';

    echo $first_paragraph;
    $first_paragraph = array_shift($paragraphs).'</p>';

    echo $first_paragraph;
    echo $first_paragraph;
    echo $first_paragraph;
}

