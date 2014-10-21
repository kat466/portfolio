<?php
$isotope_options = self::getOptions();

if (@$_POST['isotope-submit']) {

    $isotope_options['animationOptions']['easing'] = $_POST['animationOptions-easing'];
    $isotope_options['animationOptions']['queue'] = false;
    $isotope_options['animationOptions']['duration'] = (int) $_POST['animationOptions-duration'];

    self::setOptions($isotope_options);
}

$animationOptions = $isotope_options['animationOptions'];
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
                        <label for="animationOptions-easing"><?php _e('Easing', 'nimble_portfolio_isotope') ?></label>
                    </th>
                    <td>
                        <select id="animationOptions-easing" name="animationOptions-easing" >
                            <?php
                            $easings = self::getEasingList();
                            foreach ($easings as $easing):
                                ?>
                                <option value="<?php echo $easing; ?>" <?php selected($easing, $animationOptions['easing']); ?>>
                                    <?php echo $easing; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="description"><?php _e('Used only when CSS3 transitions are not supported by browser, defaults to '); ?><strong>jswing</strong></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="animationOptions-duration"><?php _e('Duration', 'nimble_portfolio_isotope') ?></label>
                    </th>
                    <td>
                        <input type="text" name="animationOptions-duration" id="animationOptions-duration" value="<?php echo $animationOptions['duration']; ?>"/>
                        <p class="description"><?php _e('Used only when CSS3 transitions are not supported by browser, defaults to '); ?><strong>750</strong></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit"><input type="submit" value="<?php _e('Save Settings', 'nimble_portfolio_isotope') ?>" class="button button-primary" id="isotope-submit" name="isotope-submit"></p>
    </form>

</div>