<?php
$skin = $this->getSkin();
$skin_options = $skin->getOptions();
$readmore_flag = $skin_options['readmore-flag'];
$readmore_text = $skin_options['readmore-text'];
$viewproject_flag = $skin_options['viewproject-flag'];
$viewproject_text = $skin_options['viewproject-text'];
$hover_icon = $skin_options['hover-icon'] ? $skin_options['hover-icon'] : 'zoom';
$thumb_size = $skin_options['thumb-size'] ? $skin_options['thumb-size'] : '480x480';
$skin_type = $this->atts['skin_style'];
$skin_cols = $this->atts['skin_columns'];
$items = $this->getItems();
foreach ($items as $item) {
    $sep_gal_imgs = array();
    if ($item->getData('sep-gal-ids')) {
        $ids = explode(",", $item->getData('sep-gal-ids'));
        $sep_gal_imgs = $skin->getSepGalImages($ids);
    }
    $item_atts = array();
    $item_atts['class'] = $item->getFilters($this->taxonomy);
    $item_atts['class'][] = "-item";
    $item_atts['class'][] = $skin_type;
    $item_atts['class'][] = $skin_cols;
    $item_atts['id'] = "item-" . $item->ID;
    $item_atts = apply_filters('nimble_portfolio_item_atts', $item_atts, $item);
    ?>
    <div <?php echo NimblePortfolioPlugin::phpvar2htmlatt($item_atts); ?>>
        <div class="title"><?php echo $item->getTitle(); ?></div>    
        <div class="itembox">
            <a href="<?php echo $item->getData('nimble-portfolio'); ?>" target="<?php echo $item->getData('browse-lightbox-url-newtab') ? "_blank" : ""; ?>" rel="<?php echo $item->getData('browse-lightbox-url') ? "" : ($item->getData('sep-gal-ids') ? "nimblebox[nimble_portfolio_gal_$item->ID]" : 'nimblebox[nimble_portfolio_gal_pro]'); ?>" <?php do_action('nimble_portfolio_lightbox_link_atts', $item); ?> title="<?php echo esc_attr($item->post_excerpt); ?>">
                <img src="<?php echo $item->getThumbnail($thumb_size); ?>" alt="<?php echo esc_attr($item->getTitle()); ?>" />
                <div class="-mask"> </div>
                <div class="genericon genericon-<?php echo $item->getData('hover-icon') ? $item->getData('hover-icon') : $hover_icon; ?>"></div>
            </a>    
            <?php foreach ($sep_gal_imgs as $img) { ?>
                <a href="<?php echo esc_url($img['url']); ?>" class="sep-gal-img" rel="<?php echo "nimblebox[nimble_portfolio_gal_$item->ID]"; ?>" <?php do_action('nimble_portfolio_lightbox_link_atts', $item); ?> title="<?php echo esc_attr($img['caption']); ?>"><img src="<?php echo $img; ?>" alt="<?php echo esc_attr($item->getTitle()); ?>" /></a>
            <?php } ?>
        </div>
        <?php if ($readmore_flag || $viewproject_flag) { ?> 
            <div class="-links">
                <?php if ($readmore_flag) { ?>
                    <div class="-link -readmore <?php echo $viewproject_flag ? '' : '-onlyonelink'; ?>">
                        <a href="<?php echo $item->getPermalink(); ?>" class="button-fixed">
                            <?php _e($readmore_text, 'nimble_portfolio_context') ?>
                        </a>
                    </div>
                <?php } ?>
                <?php if ($viewproject_flag) { ?>
                    <div class="-link -viewproject <?php echo $readmore_flag ? '' : '-onlyonelink'; ?>"> 
                        <a href="<?php echo $item->getData('nimble-portfolio-url'); ?>" class="button-fixed">
                            <?php _e($viewproject_text, 'nimble_portfolio_context') ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <?php
}
?>
<div style="clear: both;"></div>
