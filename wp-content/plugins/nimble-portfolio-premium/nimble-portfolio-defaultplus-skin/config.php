<?php
$skin_options = $this->getOptions();

if (@$_POST['pro-skin-submit']) {

    $skin_options['readmore-flag'] = (int) @$_POST['readmore-flag'];
    $skin_options['readmore-text'] = @$_POST['readmore-text'];
    $skin_options['readmore-color'] = @$_POST['readmore-color'];
    $skin_options['viewproject-flag'] = (int) @$_POST['viewproject-flag'];
    $skin_options['viewproject-text'] = @$_POST['viewproject-text'];
    $skin_options['viewproject-color'] = @$_POST['viewproject-color'];
    $skin_options['filter_bg_color'] = @$_POST['filter_bg_color'];
    $skin_options['filter_link_color'] = @$_POST['filter_link_color'];
    $skin_options['filter_border_color'] = @$_POST['filter_border_color'];
    $skin_options['filter_bg_color_hover'] = @$_POST['filter_bg_color_hover'];
    $skin_options['filter_link_color_hover'] = @$_POST['filter_link_color_hover'];
    $skin_options['filter_border_color_hover'] = @$_POST['filter_border_color_hover'];
    $skin_options['hover-icon'] = @$_POST['hover-icon'];
    $skin_options['hover-color'] = @$_POST['hover-color'];
    $skin_options['hover-bgcolor'] = @$_POST['hover-bgcolor'];
    $skin_options['thumb-size'] = @$_POST['thumb-size'];
    if (is_writable("$this->path/overrides.css")) {
        ob_start();
        include 'overrides.php';
        $buffer = ob_get_clean();
        file_put_contents("$this->path/overrides.css", $buffer);
        $skin_options['overrides-writable'] = true;
    } else {
        $skin_options['overrides-writable'] = false;
    }
    $this->setOptions($skin_options);
}

$readmore_flag = $skin_options['readmore-flag'];
$readmore_text = $skin_options['readmore-text'];
$readmore_color = $skin_options['readmore-color'];
$viewproject_flag = $skin_options['viewproject-flag'];
$viewproject_text = $skin_options['viewproject-text'];
$hover_icon = $skin_options['hover-icon'];
$thumb_size = $skin_options['thumb-size'];
$icon_set = $this->getHoverIconSet();
?>
<div class="wrap nimble-portfolio-config">
    <div id="icon-edit" class="icon32 icon32-posts-portfolio">&nbsp;</div>
    <h2><?php echo get_admin_page_title(); ?></h2>
    <br class="clear" />
    <form action="" method="post">    
        <div class="tabs">
            <ul>
                <li><a href="#tab-filter-page-link" class="nav-tab">Filter/Pagination Link</a></li>
                <li><a href="#tab-permalink" class="nav-tab">Post Permalink</a></li>
                <li><a href="#tab-portfolio-url" class="nav-tab">Portfolio URL Link</a></li>
                <li><a href="#tab-thumbnail" class="nav-tab">Thumbnail</a></li>
            </ul>
            <div id="tab-filter-page-link" class="panel-tab">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <td colspan="2"><h3><?php _e('Normal State', 'nimble_portfolio_pro_skin') ?></h3></td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="filter_link_color"><?php _e('Color', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td>
                                <input  type="text" id="filter_link_color" name="filter_link_color" value="<?php echo $skin_options['filter_link_color']; ?>" /></div><div class="color-picker" rel="#filter_link_color"></div>
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="filter_bg_color"><?php _e('Background Color', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td>
                                <input  type="text" id="filter_bg_color" name="filter_bg_color" value="<?php echo $skin_options['filter_bg_color']; ?>" /></div><div class="color-picker" rel="#filter_bg_color"></div>
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="filter_border_color"><?php _e('Border Color', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td>
                                <input  type="text" id="filter_border_color" name="filter_border_color" value="<?php echo $skin_options['filter_border_color']; ?>" /></div><div class="color-picker" rel="#filter_border_color"></div>
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><h3><?php _e('Selected / On Hover', 'nimble_portfolio_pro_skin') ?></h3></td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="filter_link_color_hover"><?php _e('Color', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td>
                                <input  type="text" id="filter_link_color_hover" name="filter_link_color_hover" value="<?php echo $skin_options['filter_link_color_hover']; ?>" /></div><div class="color-picker" rel="#filter_link_color_hover"></div>
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="filter_bg_color_hover"><?php _e('Background Color', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td>
                                <input  type="text" id="filter_bg_color_hover" name="filter_bg_color_hover" value="<?php echo $skin_options['filter_bg_color_hover']; ?>" /></div><div class="color-picker" rel="#filter_bg_color_hover"></div>
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="filter_border_color_hover"><?php _e('Border Color', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td>
                                <input  type="text" id="filter_border_color_hover" name="filter_border_color_hover" value="<?php echo $skin_options['filter_border_color_hover']; ?>" /></div><div class="color-picker" rel="#filter_border_color_hover"></div>
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="tab-permalink" class="panel-tab">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label><?php _e('Display?', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td class="nimble-radio">
                                <input type="radio" value="1" name="readmore-flag" id="readmore-flag-yes" <?php checked($readmore_flag, 1); ?> />
                                <label for="readmore-flag-yes" class="radio-button">YES</label>
                                <input type="radio" value="0"  name="readmore-flag" id="readmore-flag-no" <?php checked($readmore_flag, 0); ?> />
                                <label for="readmore-flag-no" class="radio-button">NO</label>
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="readmore-text"><?php _e('Text', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td>
                                <input type="text" value="<?php echo $readmore_text; ?>"  name="readmore-text" id="readmore-text" />
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="readmore-color"><?php _e('Color', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td>
                                <input  type="text" id="readmore-color" name="readmore-color" value="<?php echo $skin_options['readmore-color']; ?>" /></div><div class="color-picker" rel="#readmore-color"></div>
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div id="tab-portfolio-url" class="panel-tab">
                <table class="form-table">
                    <tbody>

                        <tr>
                            <th scope="row">
                                <label><?php _e('Display?', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td class="nimble-radio">
                                <input type="radio" value="1" name="viewproject-flag" id="viewproject-flag-yes" <?php checked($skin_options['viewproject-flag'], 1); ?> />
                                <label for="viewproject-flag-yes" class="radio-button">YES</label>
                                <input type="radio" value="0"  name="viewproject-flag" id="viewproject-flag-no" <?php checked($skin_options['viewproject-flag'], 0); ?> />
                                <label for="viewproject-flag-no" class="radio-button">NO</label>
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="viewproject-text"><?php _e('Text', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td>
                                <input type="text" value="<?php echo $skin_options['viewproject-text']; ?>"  name="viewproject-text" id="viewproject-text" />
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="viewproject-color"><?php _e('Color', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td>
                                <input  type="text" id="viewproject-color" name="viewproject-color" value="<?php echo $skin_options['viewproject-color']; ?>" /></div><div class="color-picker" rel="#viewproject-color"></div>
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="tab-thumbnail" class="panel-tab">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="thumb-size"><?php _e('Thumbnail Size', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td>
                                <input type="text" value="<?php echo $thumb_size; ?>"  name="thumb-size" id="thumb-size" />
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="hover-icon"><?php _e('Default Hover Icon', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td>
                                <select name="hover-icon" id="hover-icon" class="genericon" >
                                    <optgroup>
                                        <?php foreach ($icon_set as $value => $label) { ?>
                                            <option value="<?php echo $value; ?>" <?php selected($hover_icon, $value); ?>><?php echo $label; ?></option>
                                            <?php echo ++$i % 4 == 0 ? "</optgroup><optgroup>" : ""; ?>
                                        <?php } ?>
                                    </optgroup>
                                </select>                       
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="hover-color"><?php _e('Hover Color', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td>
                                <input  type="text" id="hover-color" name="hover-color" value="<?php echo $skin_options['hover-color']; ?>" /></div><div class="color-picker" rel="#hover-color"></div>
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="hover-bgcolor"><?php _e('Hover Background Color', 'nimble_portfolio_pro_skin') ?></label>
                            </th>
                            <td>
                                <input  type="text" id="hover-bgcolor" name="hover-bgcolor" value="<?php echo $skin_options['hover-bgcolor']; ?>" /></div><div class="color-picker" rel="#hover-bgcolor"></div>
                                <p class="description">&nbsp;</p>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <p class="submit">
            <input type="submit" value="<?php _e('Save Settings', 'nimble_portfolio_pro_skin') ?>" class="button button-primary" id="nimble-portfolio-pro-skin-submit" name="pro-skin-submit" />
        </p>
    </form>

</div> 
