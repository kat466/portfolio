<?php
/*
  Plugin Name: Nimble Portfolio - Isotope Addon
  Plugin URI: http://www.nimble3.com
  Description: Isotope Addon for Nimble Portfolio
  Author: Nimble3
  Version: 1.0.0
  Author URI: http://www.nimble3.com
 */

class NimblePortfolioIsotopeAddon {

    static private $dirPath;
    static private $dirUrl;
    static private $version;
    static private $reqVersion;

    static function init() {
        self::$version = '1.0.0';
        self::$reqVersion = '2.0.5';
        add_action('init', array(__CLASS__, 'setup'));
    }

    static function getReqVersion() {
        return self::$reqVersion;
    }

    static function setup() {

        if (class_exists('NimblePortfolioPlugin')) {
            if (version_compare(self::$reqVersion, NimblePortfolioPlugin::getVersion(), 'gt')) {
                add_action('admin_notices', array(__CLASS__, 'adminNoticeReqVer'));
                return;
            }
        } else {
            add_action('admin_notices', array(__CLASS__, 'adminNoticeReqPlugin'));
            return;
        }

        self::$dirPath = dirname(__FILE__);
        self::$dirUrl = NimblePortfolioPlugin::path2url(self::$dirPath);

        add_filter('nimble_portfolio_sort_script', array(__CLASS__, 'overrideScript'));
        add_filter('nimble_portfolio_sort_style', array(__CLASS__, 'overrideStyle'));

        add_action('nimble_portfolio_enqueue_script', array(__CLASS__, 'enqueueScript'));
        add_action('nimble_portfolio_create_section_before', array(__CLASS__, 'registerMenu'));
        add_action('nimble_portfolio_tinymce_params_after', array(__CLASS__, 'addTinymceShortcodeParam'));
        add_action('nimble_portfolio_skin_before', array(__CLASS__, 'applyShortcodeAtts'));
        add_filter('nimble_portfolio_query_args', array(__CLASS__, 'setQueryArgs'), 10, 2);
        add_action('wp_ajax_isotope_doajax', array(__CLASS__, 'doAjax'));        
        add_action('wp_ajax_nopriv_isotope_doajax', array(__CLASS__, 'doAjax'));
        add_filter('nimble_portfolio_filter_atts', array(__CLASS__, 'addFilterAttribute'), 10, 2);
    }

    function overrideScript() {
        return self::$dirUrl . '/inc/jquery.isotope.min.js';
    }

    function overrideStyle() {
        return self::$dirUrl . '/inc/nimble-isotope.css';
    }

    function enqueueScript() {
        
        wp_enqueue_style('jquery-prettyLoader', self::$dirUrl . '/inc/css/prettyLoader.css');
        wp_enqueue_script('jquery-prettyLoader', self::$dirUrl . '/inc/jquery.prettyLoader.js', array('jquery'));
        wp_enqueue_script('jquery-easing', self::$dirUrl . '/inc/jquery.easing.js', array('jquery'), '1.3');
        wp_register_script('nimble-portfolio-isotope-add-on', self::$dirUrl . '/inc/nimble-isotope.js', array('jquery'), self::$version);
        $options = self::getOptions();
        $options['ajaxurl'] = admin_url('admin-ajax.php');
        $options['url'] = self::$dirUrl;
        wp_localize_script('nimble-portfolio-isotope-add-on', 'NimbleIsotope', json_encode($options));
        wp_enqueue_script('nimble-portfolio-isotope-add-on');
    }

    function addTinymceShortcodeParam() {
        ?>
        <fieldset>
            <legend>Isotope</legend>
            <p>
                <label for="isotope_addon_default_filter"><?php _e("Default Filter"); ?>:</label>
                <?php
                $args = array();
                $args['id'] = 'isotope_addon_default_filter';
                $args['taxonomy'] = NimblePortfolioPlugin::getTaxonomy();
                $args['show_option_none'] = '--- No Default Filter ---';
                $args['hierarchical'] = 1;
                $args['orderby'] = 'name';
                wp_dropdown_categories($args);
                ?>
            </p>
            <p>
                <label for="isotope_addon_multi_filters"><?php _e("Multi-filters selection"); ?>:</label>
                <input type="checkbox" id="isotope_addon_multi_filters" name="isotope_addon_multi_filters" value="1" />
            </p>
            <p>
                <label for="isotope_addon_ajax_filter"><?php _e("Ajax Filtering"); ?>:</label>
                <input type="checkbox" id="isotope_addon_ajax_filter" name="isotope_addon_ajax_filter" value="1" />
            </p>
            <p>
                <label for="isotope_addon_ajax_paginate"><?php _e("Ajax Pagination"); ?>:</label>
                <input type="checkbox" id="isotope_addon_ajax_paginate" name="isotope_addon_ajax_paginate" value="1" />
            </p>
        </fieldset>
        <script>
            (function($) {
                $(document).on("nimble_portfolio_tinymce_param", function(event, obj) {
                    var default_filter = $('#isotope_addon_default_filter').val();
                    var multi_filters = $('#isotope_addon_multi_filters').is(':checked');
                    var ajax_filter = $('#isotope_addon_ajax_filter').is(':checked');
                    var ajax_paginate = $('#isotope_addon_ajax_paginate').is(':checked');
                    var params = event.result ? event.result : '';
                    if (default_filter) {
                        params += ' default_filter="' + default_filter + '" ';
                    }
                    if (multi_filters) {
                        params += ' multi_filters="' + multi_filters + '" ';
                    }
                    if (ajax_filter) {
                        params += ' ajax_filter="' + ajax_filter + '" ';
                    }
                    if (ajax_paginate) {
                        params += ' ajax_paginate="' + ajax_paginate + '" ';
                    }
                    return params;
                });
            })(jQuery);
        </script>
        <?php
    }

    function applyShortcodeAtts($portfolioObj) {
        $atts = $portfolioObj->atts;
        if (isset($atts['default_filter']) && $atts['default_filter']) {
            $filter_id = (int) $atts['default_filter'];
            $filter = get_term($filter_id, $portfolioObj->taxonomy);
            echo $filter ? '<input type="hidden" value="' . $filter->slug . '" class="isotope_default_filter" />' : '';
        }

        if (isset($atts['multi_filters']) && $atts['multi_filters']) {
            echo '<input type="hidden" value="1" class="isotope_multi_filters" />';
        }

        if (isset($atts['ajax_filter']) && $atts['ajax_filter']) {
            echo '<input type="hidden" value="1" class="isotope_ajax_filter" />';
        }

        if (isset($atts['ajax_paginate']) && $atts['ajax_paginate']) {
            echo '<input type="hidden" value="1" class="isotope_ajax_paginate" />';
        }

        echo '<input type="hidden" value="' . base64_encode(serialize($portfolioObj->atts)) . '" class="isotope_addon_atts" />';
    }

    function getOptions() {
        return get_option('nimble-portfolio-isotope-options', array('resizable' => true, 'animationEngine' => 'best-available', 'animationOptions' => array('duration' => 750, 'easing' => 'jswing', 'queue' => false)));
    }

    function setOptions($isotope_options) {
        update_option('nimble-portfolio-isotope-options', $isotope_options);
    }

    static function registerMenu($post_type) {
        add_submenu_page('edit.php?post_type=' . ($post_type ? $post_type : 'portfolio'), 'Isotope Addon Settings', 'Add-on: Isotope', 'manage_options', 'nimble-portfolio-isotope-addon', array(__CLASS__, 'adminConfigPage'));
    }

    function adminConfigPage() {
        include_once( 'inc/admin.php');
    }

    function setQueryArgs($args, $portfolioObj) {
        $atts = $portfolioObj->atts;
        if (isset($atts['isotope-ajax-filters']) && $atts['isotope-ajax-filters']) {
            var_dump($atts['isotope-ajax-filters']);
            $args['tax_query'] = array(array('taxonomy' => $portfolioObj->taxonomy, 'field' => 'id', 'terms' => $atts['isotope-ajax-filters'], 'include_children' => false));
        }
        return $args;
    }

    function doAjax() {
        var_dump($_POST);
        if (isset($_POST['atts']) && $_POST['atts']) {
            $atts = unserialize(base64_decode($_POST['atts']));
            $atts['isotope-ajax-filters'] = $_POST['filters'];
            $atts['pagenum'] = isset($_POST['paged']) && $_POST['paged'] ? (int) $_POST['paged'] : 1;
            $portfolioObj = new NimblePortfolio($atts);
            $portfolioObj->renderTemplate();
        }
        exit();
    }

    function addFilterAttribute($filter_atts, $filter) {
        $filter_atts['data-id'] = $filter->term_id;
        return $filter_atts;
    }

    function adminNoticeReqPlugin() {
        echo '<div class="error"><p>The <strong>Nimble Portfolio - Isotope Addon</strong> plugin requires <strong>Nimble Portfolio</strong> Plugin installed and activated.</p></div>';
    }

    function adminNoticeReqVer() {
        echo '<div class="error"><p>The <strong>Nimble Portfolio - Isotope Addon</strong> plugin requires <strong>Nimble Portfolio</strong> version ' . self::$reqVersion . ' or greater.</p></div>';
    }

    function getEasingList() {
        return array(
            'jswing',
            'easeInQuad',
            'easeOutQuad',
            'easeInOutQuad',
            'easeInCubic',
            'easeOutCubic',
            'easeInOutCubic',
            'easeInQuart',
            'easeOutQuart',
            'easeInOutQuart',
            'easeInQuint',
            'easeOutQuint',
            'easeInOutQuint',
            'easeInSine',
            'easeOutSine',
            'easeInOutSine',
            'easeInExpo',
            'easeOutExpo',
            'easeInOutExpo',
            'easeInCirc',
            'easeOutCirc',
            'easeInOutCirc',
            'easeInElastic',
            'easeOutElastic',
            'easeInOutElastic',
            'easeInBack',
            'easeOutBack',
            'easeInOutBack',
            'easeInBounce',
            'easeOutBounce',
            'easeInOutBounce'
        );
    }

}

NimblePortfolioIsotopeAddon::init();


