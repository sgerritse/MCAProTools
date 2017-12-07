<div id="Theme_type_upload_div" style="display:<?php echo ($Html -> field_value('Theme[type]') == "" || $Html -> field_value('Theme[type]') == "upload") ? 'block' : 'none'; ?>;">
	<table class="form-table">
    	<tbody>
        	<tr>
            	<th><label for=""><?php _e('Choose HTML File', 'wp-mailinglist'); ?></label></th>
                <td>
                	<input class="widefat" type="file" name="upload" value="" />
                    <?php if (!empty($Theme -> errors['upload'])) : ?>
                    	<div class="newsletters_error"><?php echo $Theme -> errors['upload']; ?></div>
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<table class="form-table">
	<tbody>
    	<tr>
    		<th><label for="Theme_imgprependurl"><?php _e('Image Prepend URL', 'wp-mailinglist'); ?></label>
    		<?php echo $Html -> help(__('If your template has relative image paths in the source, this image prepend URL setting is very useful to automatically add an absolute URL to the source attribute of all images. Eg. <code>src="images/myimage.jpg"</code> and you fill in a prepend URL of <code>http://domain.com/</code>, it will become <code>src="http://domain.com/images/myimage.jpg"</code>', 'wp-mailinglist')); ?></th>
    		<td>
    			<input type="text" class="widefat" name="Theme[imgprependurl]" value="<?php echo esc_attr(stripslashes($Theme -> data -> imgprependurl)); ?>" id="Theme_imgprependurl" />
    			<span class="howto"><small><?php _e('(optional)', 'wp-mailinglist'); ?></small> <?php _e('Prepend the SRC attribute of IMG tags with a URL', 'wp-mailinglist'); ?></span>
    		</td>
    	</tr>
        <tr>
			<th><label for="Theme_inlinestyles_N"><?php _e('Inline Styles', 'wp-mailinglist'); ?></label>
			<?php echo $Html -> help(__('Set this setting to "Yes" to automatically convert all CSS rules into inline, style attributes in the HTML elements. If you use this setting, be sure to create a backup of your original HTML for easier editing later on.', 'wp-mailinglist')); ?></th>
			<td>
				<label><input onclick="if (!confirm('<?php echo __('Please ensure that you create a local copy/backup of your newsletter template HTML for editing in the future.', 'wp-mailinglist'); ?>')) { return false; }" type="radio" name="Theme[inlinestyles]" value="Y" id="Theme_inlinestyles_Y" /> <?php _e('Yes', 'wp-mailinglist'); ?></label>
				<label><input type="radio" checked="checked" name="Theme[inlinestyles]" value="N" id="Theme_inlinestyles_N" /> <?php _e('No', 'wp-mailinglist'); ?></label>
				<span class="howto"><?php _e('Convert CSS rules into inline, style attributes on elements.', 'wp-mailinglist'); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="Theme_acolor"><?php _e('Shortcode Link Color', 'wp-mailinglist'); ?></label>
			<?php echo $Html -> help(__('Set the color of the links generated from the plugin shortcodes dynamically.', 'wp-mailinglist')); ?></th>
			<td>
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Background Color', 'wp-mailinglist'); ?></span></legend>
					<div class="wp-picker-container">
						<a tabindex="0" id="acolorbutton" class="wp-color-result" style="background-color:<?php echo $Html -> field_value('Theme[acolor]'); ?>;" title="Select Color"></a>
						<span class="wp-picker-input-wrap">
							<input type="text" name="Theme[acolor]" id="Theme_acolor" value="<?php echo $Html -> field_value('Theme[acolor]'); ?>" class="wp-color-picker" style="display: none;" />
						</span>
					</div>
				</fieldset>
				<span class="howto"><?php echo sprintf(__('Control the color of the links generated by shortcodes such as %s, %s, %s, etc.', 'wp-mailinglist'), '[newsletters_online]', '[newsletters_activate]', '[newsletters_unsubscribe]'); ?></span>
			</td>
		</tr>
	</tbody>
</table>