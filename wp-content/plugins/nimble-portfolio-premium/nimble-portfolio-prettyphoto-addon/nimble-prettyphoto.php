<?php

/*
  Plugin Name: Nimble Portfolio - prettyPhoto Addon
  Plugin URI: http://www.nimble3.com
  Description: prettyPhoto Addon for Nimble Portfolio
  Author: Nimble3
  Version: 1.0.0
  Author URI: http://www.nimble3.com
 */

class NimblePortfolioSwipeboxAddon {

    static private $dirPath;
    static private $dirUrl;
    static private $reqVersion;
    static private $version;

    static function init() {
        self::$version = '1.0.0';
        self::$reqVersion = '2.0.5';
        add_action('init', array(__CLASS__, 'setup'));
    }

    static function getRequiredVersion() {
        return self::$reqVersion;
    }

    static function setup($params = array()) {

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

        add_filter('nimble_portfolio_lightbox_style', array(__CLASS__, 'overrideStyle'));
        add_filter('nimble_portfolio_lightbox_script', array(__CLASS__, 'overrideScript'));
        add_action('nimble_portfolio_create_section_before', array(__CLASS__, 'registerMenu'));
        add_action('nimble_portfolio_enqueue_script', array(__CLASS__, 'enqueueScript'));
        add_action('wp_head', array(__CLASS__, 'insertAddthisScript'), 99);
    }

    static function overrideStyle() {
        return self::$dirUrl . '/inc/jquery.prettyPhoto.css';
    }

    static function overrideScript() {
        return self::$dirUrl . '/inc/jquery.prettyPhoto.js';
    }

    static function enqueueScript() {

        $options = self::getFormattedOptions();
        wp_register_script('nimble-portfolio-prettyPhoto', self::$dirUrl . '/inc/nimble-prettyPhoto.js', array('jquery'), self::$version);
        $options['AddThis'] = apply_filters('nimble_portfolio_pp_addthis_params', array('services' => array('facebook', 'twitter', 'pinterest_share', 'compact')));
        wp_localize_script('nimble-portfolio-prettyPhoto', 'NimblePrettyPhoto', json_encode($options));
        wp_enqueue_script('nimble-portfolio-prettyPhoto');
        wp_enqueue_style('nimble-portfolio-prettyPhoto', self::$dirUrl . '/inc/nimble-prettyPhoto.css');
    }

    static function getOptions() {

        $defaults = array();
        $defaults['animation_speed'] = 'fast';
        $defaults['slideshow'] = 5000;
        $defaults['autoplay_slideshow'] = false;
        $defaults['opacity'] = 0.80;
        $defaults['show_title'] = true;
        $defaults['allow_resize'] = true;
        $defaults['default_width'] = 500;
        $defaults['default_height'] = 344;
        $defaults['counter_separator_label'] = '/';
        $defaults['theme'] = 'pp_default';
        $defaults['horizontal_padding'] = 20;
        $defaults['hideflash'] = false;
        $defaults['autoplay'] = true;
        $defaults['modal'] = false;
        $defaults['deeplinking'] = true;
        $defaults['overlay_gallery'] = true;
        $defaults['keyboard_shortcuts'] = true;
        return get_option('nimble-portfolio-prettyPhoto-options', $defaults);
    }

    static function getFormattedOptions($options = null) {

        if ($options === null) {
            $options = self::getOptions();
        }
        $formatted = $options;
        $formatted['slideshow'] = (int) @$options['slideshow'];
        $formatted['autoplay_slideshow'] = (bool) @$options['autoplay_slideshow'];
        $formatted['opacity'] = (float) @$options['opacity'];
        $formatted['show_title'] = (bool) @$options['show_title'];
        $formatted['allow_resize'] = (bool) @$options['allow_resize'];
        $formatted['default_width'] = (int) @$options['default_width'];
        $formatted['default_height'] = (int) @$options['default_height'];
        $formatted['horizontal_padding'] = (int) @$options['horizontal_padding'];
        $formatted['hideflash'] = (bool) @$options['hideflash'];
        $formatted['autoplay'] = (bool) @$options['autoplay'];
        $formatted['modal'] = (bool) @$options['modal'];
        $formatted['deeplinking'] = (bool) @$options['deeplinking'];
        $formatted['overlay_gallery'] = (bool) @$options['overlay_gallery'];
        $formatted['keyboard_shortcuts'] = (bool) @$options['keyboard_shortcuts'];
        
        return $formatted;
    }

    static function setOptions($options) {
        update_option('nimble-portfolio-prettyPhoto-options', $options);
    }

    static function registerMenu($post_type) {
        add_submenu_page('edit.php?post_type=' . ($post_type ? $post_type : 'portfolio'), 'prettyPhoto Add-on Settings', 'Add-on: prettyPhoto', 'manage_options', 'nimble-prettyPhoto-addon', array(__CLASS__, 'adminConfigPage'));
    }

    static function adminConfigPage() {
        include_once('inc/admin.php');
    }

    static function insertAddthisScript() {
        $options = self::getOptions();
        if (isset($options['addthis_script']) && $options['addthis_script'] ){
            echo stripcslashes($options['addthis_script']);
        }
    }

    static function adminNoticeReqPlugin() {
        echo '<div class="error"><p>The <strong>Nimble Portfolio - prettyPhoto Addon</strong> plugin requires <strong>Nimble Portfolio</strong> (version ' . self::$reqVersion . ' or greater) Plugin installed and activated.</p></div>';
    }

    static function adminNoticeReqVer() {
        echo '<div class="error"><p>The <strong>Nimble Portfolio - prettyPhoto Addon</strong> plugin requires <strong>Nimble Portfolio</strong> version ' . self::$reqVersion . ' or greater.</p></div>';
    }

}

NimblePortfolioSwipeboxAddon::init();
