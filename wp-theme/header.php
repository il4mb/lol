<?php

$wpf_li = [
    "language_attributes",
    "bloginfo",
    "is_front_page",
    "wp_title",
    "wp_head",
    "body_class",
    "esc_url",
    "wp_nav_menu",
    "home_url"
];

$wpf = [];

foreach ($wpf_li as $item) {
    $wpf[$item] = $item;
}

?>

<!DOCTYPE html>
<html <?php $wpf['language_attributes'](); ?>>

<head>
    <title><?php $wpf['bloginfo']('name'); ?> &raquo; <?php $wpf['is_front_page']() ? $wpf['bloginfo']('description') : $wpf['wp_title'](''); ?></title>
    <meta charset="<?php $wpf['bloginfo']('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php $wpf['bloginfo']('stylesheet_url'); ?>">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <?php $wpf['wp_head'](); ?>
</head>

<body <?php $wpf['body_class'](); ?>>
    <nav>
        <div class="container-lg">
            <a class="d-flex text-decoration-none" href="<?php echo $wpf['esc_url']($wpf['home_url']('/')); ?>">

                <?php

                $custom_logo_id = get_theme_mod('custom_logo');
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');

                if (has_custom_logo()) {
                    echo '<img width="65" height="65" src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
                }

                
                ?>
                <div class="text-start">
                    <h1 class="brand"><?php $wpf['bloginfo']('name'); ?></h1>
                    
                    <?php

                    if(get_bloginfo('description')) {

                        echo "<small>".get_bloginfo("description")."</small>";
                    }
                    ?>
                </div>
            </a>
        </div>
    </nav>
</body>