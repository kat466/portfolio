<?php
if (@$_POST['prettyphoto-submit']) {
    $nimble_prettyphoto = @$_POST['nimble_prettyphoto'];
    self::setOptions($nimble_prettyphoto);
}
$nimble_prettyphoto = self::getFormattedOptions();
?>
<div class="wrap">
    <div id="icon-edit" class="icon32 icon32-posts-portfolio">&nbsp;</div>
    <h2><?php echo get_admin_page_title(); ?></h2>
    <br class="clear" />
    <form action="" method="post">        
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label><?php _e('Animation Speed ', 'prettyphoto_addon') ?></label>
                    </th>
                    <td class="nimble-select">
                        <select name="nimble_prettyphoto[animation_speed]">
                            <option value='fast' <?php selected($nimble_prettyphoto['animation_speed'], 'fast'); ?>>Fast</option>
                            <option value='slow' <?php selected($nimble_prettyphoto['animation_speed'], 'slow'); ?>>Slow</option>
                            <option value='normal' <?php selected($nimble_prettyphoto['animation_speed'], 'normal'); ?>>Normal</option>
                        </select>    
                        <p class="description">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="slideshow"><?php _e('Slideshow', 'prettyphoto_addon') ?></label>
                    </th>
                    <td>
                        <input type="text" value="<?php echo $nimble_prettyphoto['slideshow']; ?>"  name="nimble_prettyphoto[slideshow]" id="slideshow" />
                        <p class="description">empty OR interval time in ms</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="autoplay_slideshow"><?php _e('Autoplay Slideshow', 'prettyphoto_addon') ?></label>
                    </th>

                    <td class="nimble-radio">
                        <input type="radio" value="1" name="nimble_prettyphoto[autoplay_slideshow]" id="autoplay_slideshow-yes" <?php checked($nimble_prettyphoto['autoplay_slideshow'], true); ?> />
                        <label for="autoplay_slideshow-yes" class="radio-button">YES</label>
                        <input type="radio" value="0"  name="nimble_prettyphoto[autoplay_slideshow]" id="autoplay_slideshow-no" <?php checked($nimble_prettyphoto['autoplay_slideshow'], false); ?> />
                        <label for="autoplay_slideshow-no" class="radio-button">NO</label>
                        <p class="description">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label><?php _e('Opacity', 'prettyphoto_addon') ?></label>
                    </th>
                    <td class="nimble-select">
                        <select name="nimble_prettyphoto[opacity]">
                            <option value='0.1'  <?php selected($nimble_prettyphoto['opacity'], 0.1); ?>>10%</option>
                            <option value='0.2'  <?php selected($nimble_prettyphoto['opacity'], 0.2); ?>>20%</option>
                            <option value='0.3'  <?php selected($nimble_prettyphoto['opacity'], 0.3); ?>>30%</option>
                            <option value='0.4'  <?php selected($nimble_prettyphoto['opacity'], 0.4); ?>>40%</option>
                            <option value='0.5'  <?php selected($nimble_prettyphoto['opacity'], 0.5); ?>>50%</option>
                            <option value='0.6'  <?php selected($nimble_prettyphoto['opacity'], 0.6); ?>>60%</option>
                            <option value='0.7'  <?php selected($nimble_prettyphoto['opacity'], 0.7); ?>>70%</option>
                            <option value='0.8'  <?php selected($nimble_prettyphoto['opacity'], 0.8); ?>>80%</option>
                            <option value='0.9'  <?php selected($nimble_prettyphoto['opacity'], 0.9); ?>>90%</option>
                            <option value='1.0'  <?php selected($nimble_prettyphoto['opacity'], 1.0); ?>>100%</option>
                        </select>    
                        <p class="description">Value between 0 and 1</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="show_title"><?php _e('Show title', 'prettyphoto_addon') ?></label>
                    </th>

                    <td class="nimble-radio">
                        <input type="radio" value="1" name="nimble_prettyphoto[show_title]" id="show_title-yes" <?php checked($nimble_prettyphoto['show_title'], true); ?> />
                        <label for="show_title-yes" class="radio-button">YES</label>
                        <input type="radio" value="0"  name="nimble_prettyphoto[show_title]" id="show_title-no" <?php checked($nimble_prettyphoto['show_title'], false); ?> />
                        <label for="show_title-no" class="radio-button">NO</label>
                        <p class="description">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="allow_resize"><?php _e('Allow Resize', 'prettyphoto_addon') ?></label>
                    </th>

                    <td class="nimble-radio">
                        <input type="radio" value="1" name="nimble_prettyphoto[allow_resize]" id="allow_resize-yes" <?php checked($nimble_prettyphoto['allow_resize'], true); ?> />
                        <label for="allow_resize-yes" class="radio-button">YES</label>
                        <input type="radio" value="0"  name="nimble_prettyphoto[allow_resize]" id="allow_resize-no" <?php checked($nimble_prettyphoto['allow_resize'], false); ?> />
                        <label for="allow_resize-no" class="radio-button">NO</label>
                        <p class="description">Resize the photos bigger than viewport. true/false</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="Width"><?php _e('Default width', 'prettyphoto_addon') ?></label>
                    </th>
                    <td>
                        <input type="text" value="<?php echo $nimble_prettyphoto['default_width']; ?>"  name="nimble_prettyphoto[default_width]" id="default_width" />
                        <p class="description">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="Height"><?php _e('Default height', 'prettyphoto_addon') ?></label>
                    </th>
                    <td>
                        <input type="text" value="<?php echo $nimble_prettyphoto['default_height']; ?>"  name="nimble_prettyphoto[default_height]" id="default_height" />
                        <p class="description">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="counter_separator_label"><?php _e('Counter Separator label', 'prettyphoto_addon') ?></label>
                    </th>
                    <td>
                        <input type="text" value="<?php echo $nimble_prettyphoto['counter_separator_label']; ?>"  name="nimble_prettyphoto[counter_separator_label]" id="counter_separator_label" maxlength="1" />
                        <p class="description">The separator for the gallery counter 1 "of" 2</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label><?php _e('Theme', 'prettyphoto_addon') ?></label>
                    </th>
                    <td class="nimble-select">
                        <select name="nimble_prettyphoto[theme]">
                            <option value='pp_default'<?php selected($nimble_prettyphoto['theme'], 'default'); ?>>Default</option>
                            <option value='dark_rounded'<?php selected($nimble_prettyphoto['theme'], 'dark_rounded'); ?>>Dark Rounded</option>
                            <option value='dark_square'<?php selected($nimble_prettyphoto['theme'], 'dark_square'); ?>>Dark square</option>
                            <option value='facebook'<?php selected($nimble_prettyphoto['theme'], 'facebook'); ?>>facebook</option>
                            <option value='light_rounded'<?php selected($nimble_prettyphoto['theme'], 'light_rounded'); ?>>Light rounded</option>
                            <option value='light_square'<?php selected($nimble_prettyphoto['theme'], 'light_square'); ?>>Light Square</option>
                        </select>    
                        <p class="description">&nbsp;</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="horizontal_padding"><?php _e('Horizontal Padding', 'prettyphoto_addon') ?></label>
                    </th>
                    <td>
                        <input type="text" value="<?php echo $nimble_prettyphoto['horizontal_padding']; ?>"  name="nimble_prettyphoto[horizontal_padding]" id="horizontal_padding" />
                        <p class="description">The padding on each side of the picture</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="hideflash"><?php _e('Hide flash', 'prettyphoto_addon') ?></label>
                    </th>

                    <td class="nimble-radio">
                        <input type="radio" value="1" name="nimble_prettyphoto[hideflash]" id="hideflash-yes" <?php checked($nimble_prettyphoto['hideflash'], true); ?> />
                        <label for="hideflash-yes" class="radio-button">YES</label>
                        <input type="radio" value="0"  name="nimble_prettyphoto[hideflash]" id="hideflash-no" <?php checked($nimble_prettyphoto['hideflash'], false); ?> />
                        <label for="hideflash-no" class="radio-button">NO</label>
                        <p class="description">Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="Autoplay"><?php _e('Autoplay Videos', 'prettyphoto_addon') ?></label>
                    </th>

                    <td class="nimble-radio">
                        <input type="radio" value="1" name="nimble_prettyphoto[autoplay]" id="autoplay-yes" <?php checked($nimble_prettyphoto['autoplay'], true); ?> />
                        <label for="autoplay-yes" class="radio-button">YES</label>
                        <input type="radio" value="0"  name="nimble_prettyphoto[autoplay]" id="autoplay-no" <?php checked($nimble_prettyphoto['autoplay'], false); ?> />
                        <label for="autoplay-no" class="radio-button">NO</label>
                        <p class="description">Automatically start videos: True/False</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="modal"><?php _e('Modal', 'prettyphoto_addon') ?></label>
                    </th>

                    <td class="nimble-radio">
                        <input type="radio" value="1" name="nimble_prettyphoto[modal]" id="modal-yes" <?php checked($nimble_prettyphoto['modal'], true); ?> />
                        <label for="modal-yes" class="radio-button">YES</label>
                        <input type="radio" value="0"  name="nimble_prettyphoto[modal]" id="modal-no" <?php checked($nimble_prettyphoto['modal'], false); ?> />
                        <label for="modal-no" class="radio-button">NO</label>
                        <p class="description">If set to true, only the close button will close the window</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="deeplinking"><?php _e('Deep Linking', 'prettyphoto_addon') ?></label>
                    </th>

                    <td class="nimble-radio">
                        <input type="radio" value="1" name="nimble_prettyphoto[deeplinking]" id="deeplinking-yes" <?php checked($nimble_prettyphoto['deeplinking'], true); ?> />
                        <label for="deeplinking-yes" class="radio-button">YES</label>
                        <input type="radio" value="0"  name="nimble_prettyphoto[deeplinking]" id="deeplinking-no" <?php checked($nimble_prettyphoto['deeplinking'], false); ?> />
                        <label for="deeplinking-no" class="radio-button">NO</label>
                        <p class="description">Allow prettyPhoto to update the url to enable deeplinking.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="overlaygallery"><?php _e('Overlay Gallery', 'prettyphoto_addon') ?></label>
                    </th>

                    <td class="nimble-radio">
                        <input type="radio" value="1" name="nimble_prettyphoto[overlay_gallery]" id="overlay_gallery-yes" <?php checked($nimble_prettyphoto['overlay_gallery'], true); ?> />
                        <label for="overlay_gallery-yes" class="radio-button">YES</label>
                        <input type="radio" value="0"  name="nimble_prettyphoto[overlay_gallery]" id="overlay_gallery-no" <?php checked($nimble_prettyphoto['overlay_gallery'], false); ?> />
                        <label for="overlay_gallery-no" class="radio-button">NO</label>
                        <p class="description">If set to true, a gallery will overlay the fullscreen image on mouse over</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="keyboardshortcuts"><?php _e('Keyboard Shortcuts', 'prettyphoto_addon') ?></label>
                    </th>

                    <td class="nimble-radio">
                        <input type="radio" value="1" name="nimble_prettyphoto[keyboard_shortcuts]" id="keyboard_shortcuts-yes" <?php checked($nimble_prettyphoto['keyboard_shortcuts'], true); ?> />
                        <label for="keyboard_shortcuts-yes" class="radio-button">YES</label>
                        <input type="radio" value="0"  name="nimble_prettyphoto[keyboard_shortcuts]" id="keyboard_shortcuts-no" <?php checked($nimble_prettyphoto['keyboard_shortcuts'], false); ?> />
                        <label for="keyboard_shortcuts-no" class="radio-button">NO</label>
                        <p class="description"> Set to false if you open forms inside prettyPhoto</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="addthis_script"><?php _e('Addthis Script Tag', 'prettyphoto_addon') ?></label>
                    </th>

                    <td class="nimble-radio">
                        <textarea name="nimble_prettyphoto[addthis_script]" id="addthis_script"  /><?php echo stripcslashes($nimble_prettyphoto['addthis_script']); ?></textarea>
                        <p class="description">Paste script tag from Addthis widget settings here</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" value="<?php _e('Save Settings', 'nimble_prettyphoto') ?>" class="button button-primary" id="prettyphoto-submit" name="prettyphoto-submit" />
        </p>
    </form>
</div> 
