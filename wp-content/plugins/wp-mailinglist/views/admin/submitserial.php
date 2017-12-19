<script type="text/javascript">
var newsletters_ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>?';
</script>

<h3><?php echo sprintf(__('%s Serial Key', 'wp-mailinglist'), $this -> name); ?></h3>

<?php if (empty($success) || $success == false) : ?>
	<?php if (!$this -> ci_serial_valid()) : ?>
        <p style="width:400px;">
        	<?php echo sprintf(__('You are running %s LITE.', 'wp-mailinglist'), $this -> name); ?>
        	<?php echo sprintf(__('To remove limits, you can submit a serial key or %s.'), '<a href="' . admin_url('admin.php?page=' . $this -> sections -> lite_upgrade) . '">' . __('Upgrade to PRO', 'wp-mailinglist') . '</a>'); ?>
        </p>
        <p style="width:400px;">
	        <?php _e('Please obtain a serial key from the downloads section in your Tribulant Software account.', 'wp-mailinglist'); ?>
	        <?php _e('Once in the downloads section, click the KEY icon to request a serial key.', 'wp-mailinglist'); ?>
	        <a href="https://tribulant.com/downloads/" title="Tribulant Software Downloads" target="_blank"><?php _e('Downloads Section', 'wp-mailinglist'); ?></a>
        </p>
    
        <div class="newsletters_error">
            <?php $this -> render('error', array('errors' => $errors), true, 'admin'); ?>
        </div>
        
        <form onsubmit="wpml_submitserial(this); return false;" action="<?php echo home_url(); ?>/index.php?wpmlmethod=submitserial" method="post">
            <p>
	            <input type="text" class="widefat" style="width:400px;" name="serialkey" value="<?php echo esc_attr(stripslashes($_POST['serialkey'])); ?>" /><br/>
            </p>
            <p class="submit">
            	<input type="button" class="button-secondary" name="close" onclick="jQuery.colorbox.close();" value="<?php _e('Cancel', 'wp-mailinglist'); ?>" />
            	<button value="1" type="submit" class="button-primary" name="submit" id="newsletters_submitserial_button">
            		<i class="fa fa-check fa-fw"></i> <?php _e('Submit Serial Key', 'wp-mailinglist'); ?>
            		<span style="display:none;" id="wpml_submitserial_loading"><i class="fa fa-refresh fa-spin fa-fw"></i></span>
            	</button>
            </p>
        </form>        
    <?php else : ?>
        <p><?php _e('Serial Key:', 'wp-mailinglist'); ?> <strong><?php echo $this -> get_option('serialkey'); ?></strong></p>
        <p><?php _e('Your current serial is valid and working.', 'wp-mailinglist'); ?></p>
        <p>
        	<button value="1" type="button" onclick="jQuery.colorbox.close();" name="close" class="button-primary">
        		<?php _e('Close', 'wp-mailinglist'); ?>
        	</button>
        	<button value="1" type="button" onclick="if (confirm('<?php _e('Are you sure you want to delete your serial key?', 'wp-mailinglist'); ?>')) { wpml_deleteserial(); } return false;" name="delete" class="button-secondary">
        		<?php _e('Delete Serial', 'wp-mailinglist'); ?>
        	</button>
        	<span style="display:none;" id="wpml_submitserial_loading"><i class="fa fa-refresh fa-spin fa-fw"></i></span>
        </p>
    <?php endif; ?>
<?php else : ?>
    <p><?php _e('The serial key is valid and you can now continue using the Newsletter plugin. Thank you for your business and support!', 'wp-mailinglist'); ?></p>
    <p>
	    <button value="1" type="button" onclick="jQuery.colorbox.close(); parent.location = '<?php echo rtrim(get_admin_url(), '/'); ?>/admin.php?page=newsletters';" class="button-primary" name="close">
			<i class="fa fa-check fa-fw"></i> <?php _e('Apply Serial and Close Window', 'wp-mailinglist'); ?>
	    </button>
    </p>
<?php endif; ?>