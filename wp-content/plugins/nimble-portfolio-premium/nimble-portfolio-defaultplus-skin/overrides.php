<?php

if ($skin_options['readmore-color']) {
    echo ".-skin-defaultplus .-items .-item .-link.-readmore a { color: " . $skin_options['readmore-color'] . ";}";
}
if ($skin_options['viewproject-color']) {
    echo ".-skin-defaultplus .-items .-item .-link.-viewproject a { color: " . $skin_options['viewproject-color'] . ";}";
}
if ($skin_options['filter_bg_color']) {
    echo ".-skin-defaultplus .-filters .-filter, .-skin-defaultplus .-pages .-page-link { background-color: " . $skin_options['filter_bg_color'] . ";}";
}
if ($skin_options['filter_link_color']) {
    echo ".-skin-defaultplus .-filters .-filter, .-skin-defaultplus .-pages .-page-link { color: " . $skin_options['filter_link_color'] . ";}";
}
if ($skin_options['filter_border_color']) {
    echo ".-skin-defaultplus .-filters .-filter, .-skin-defaultplus .-pages .-page-link { border: 1px solid " . $skin_options['filter_border_color'] . ";}";
}
if ($skin_options['filter_bg_color_hover']) {
    echo ".-skin-defaultplus .-filters .-filter:hover, .-skin-defaultplus .-pages .-page-link:hover,.-skin-defaultplus .-filters .-filter.active, .-skin-defaultplus .-pages .-page-link.active { background-color: " . $skin_options['filter_bg_color_hover'] . ";}";
}
if ($skin_options['filter_link_color_hover']) {
    echo ".-skin-defaultplus .-filters .-filter:hover, .-skin-defaultplus .-pages .-page-link:hover,.-skin-defaultplus .-filters .-filter.active, .-skin-defaultplus .-pages .-page-link.active { color: " . $skin_options['filter_link_color_hover'] . ";}";
}
if ($skin_options['filter_border_color_hover']) {
    echo ".-skin-defaultplus .-filters .-filter:hover, .-skin-defaultplus .-pages .-page-link:hover,.-skin-defaultplus .-filters .-filter.active, .-skin-defaultplus .-pages .-page-link.active { border: 1px solid " . $skin_options['filter_border_color_hover'] . ";}";
}
if ($skin_options['hover-color']) {
    echo ".-skin-defaultplus .-items .-item .genericon { color: " . $skin_options['hover-color'] . " !important;}";
}

if ($skin_options['hover-bgcolor']) {
    echo ".-skin-defaultplus .-items .-item .-mask { background-color: " . $skin_options['hover-bgcolor'] . " !important;}";
}


