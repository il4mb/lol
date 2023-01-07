<?php

function get_attachment_url_by_slug($slug)
{
    $args = array(
        'post_type' => 'attachment',
        'name' => sanitize_title($slug),
        'posts_per_page' => 1,
        'post_status' => 'inherit',
    );
    $_header = get_posts($args);
    $header = $_header ? array_pop($_header) : null;
    return $header ? wp_get_attachment_url($header->ID) : '';
}



$listFile = scandir(__DIR__ . "/../attachments/");
$listFile = array_values(array_filter($listFile, fn ($val) => $val != ".." && $val != '.'));

foreach ($listFile as $key => $file) {


    $image_url = __DIR__ . "/../attachments/" . $file;
    $info = pathinfo($image_url);

    if (empty(get_attachment_url_by_slug($info['filename'] . "." . $info['extension']))) {

        $upload_dir = wp_upload_dir();

        $image_data = file_get_contents($image_url);

        $filename = basename($image_url);

        if (wp_mkdir_p($upload_dir['path'])) {
            $file = $upload_dir['path'] . '/' . $filename;
        } else {
            $file = $upload_dir['basedir'] . '/' . $filename;
        }

        file_put_contents($file, $image_data);

        $wp_filetype = wp_check_filetype($filename, null);

        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'inherit'
        );

        $attach_id = wp_insert_attachment($attachment, $file);

        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata($attach_id, $file);
        wp_update_attachment_metadata($attach_id, $attach_data);
    }
}


$template_title = "lol template";
$check_page_exist = get_page_by_title($template_title, 'OBJECT', 'page');
// Check if the page already exists
if (empty($check_page_exist)) {

    $content = file_get_contents(__DIR__ . "/../asset/template.html");

    $page_id = wp_insert_post(
        array(
            'comment_status' => 'close',
            'ping_status'    => 'close',
            'post_author'    => 1,
            'post_title'     => ucwords($template_title),
            'post_name'      => strtolower(str_replace(' ', '-', trim($template_title))),
            'post_status'    => 'publish',
            'post_content'   => $content,
            'post_type'      => 'page',
            'post_parent'    => 'id_of_the_parent_page_if_it_available'
        )
    );
    update_option('page_on_front', $page_id);
    update_option( 'show_on_front', 'page' );
}
