<?php
/**
 * Custom functions
 */


add_action('admin_head', 'my_admin_column_width');
function my_admin_column_width() {
    echo '<style type="text/css">
        .column-title { width:130px !important; }
        .column-testominal { width:40%; }
        .column-show_hide {width: 72px;text-align: center;}
    </style>';
}