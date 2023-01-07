<?php

$carousel = "<div id=\"CWI\" class=\"carousel slide center carousel-dark mt-5\" data-bs-ride=\"carousel\">";

$indicator = "<div class=\"carousel-indicators\">";
$inner = "<div class=\"carousel-inner\">";

for($x = 0; $x < 9; $x++) {

    $img = get_attachment_url_by_slug("banner-" . $x . ".jpg");

    $active = "active";
    if($x > 0) $active = "";

    $i = $x + 1;
    $indicator .= "<button type=\"button\" data-bs-target=\"#CWI\" data-bs-slide-to=\"$x\" class=\"$active\" aria-current=\"true\" aria-label=\"Slide $i\"></button>";

    $inner .= "<div class=\"carousel-item $active\"><img src=\"$img\" class=\"d-block w-100\" alt=\"Gallery $i\"></div>";


}
$indicator .= "</div>";
$inner .= "</div>";

$carousel .= $indicator;
$carousel .= $inner;
$carousel .= "<button class=\"carousel-control-prev\" type=\"button\" data-bs-target=\"#CWI\" data-bs-slide=\"prev\"><span class=\"carousel-control-prev-icon\" aria-hidden=\"true\"></span><span class=\"visually-hidden\">Previous</span></button>\n<button class=\"carousel-control-next\" type=\"button\" data-bs-target=\"#CWI\" data-bs-slide=\"next\"><span class=\"carousel-control-next-icon\" aria-hidden=\"true\"></span><span class=\"visually-hidden\">Next</span></button>";
$carousel .= "</div>";

$content = str_replace("[LOL_GALLERY]", $carousel, $content);



$img = get_attachment_url_by_slug("banner.png");
if(!empty($img)) {

    $banner = "<img style=\"max-width: 250px;\" src=\"$img\" alt=\"Sample produk\">";

    $content = str_replace("[PRODUK_BANNER]", $banner, $content);
}


$list = ["tokopedia", "carousell", "shopee"];
$lolECOM = "<div class=\"row\">";
foreach($list AS $ecom) {

    $img = get_attachment_url_by_slug($ecom.".png");
    if(!empty($img)) $lolECOM .= "<div class=\"col-sm text-center\"><a target=\"_blank\" href=\"http://carousell.com/rotchai\"><img height=\"75\" src=\"$img\" alt=\"carousel\"></a></div>";

}

$lolECOM .= "</div>";
$content = str_replace("[LOL_ECOMMERCE]", $lolECOM, $content);