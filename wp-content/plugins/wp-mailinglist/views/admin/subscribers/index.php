<div class="wrap <?php echo $this -> pre; ?> newsletters">
	<h1><?php _e('Manage Subscribers', 'wp-mailinglist'); ?> <a class="add-new-h2" href="?page=<?php echo $this -> sections -> subscribers; ?>&amp;method=save" title="<?php _e('Create a new subscriber', 'wp-mailinglist'); ?>"><?php _e('Add New', 'wp-mailinglist'); ?></a></h1>
	<form id="posts-filter" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    	<?php if (!empty($subscribers)) : ?>
            <ul class="subsubsub">
                <li><?php echo (empty($_GET['showall'])) ? $paginate -> allcount : count($subscribers); ?> <?php _e('subscribers', 'wp-mailinglist'); ?> |</li>
                <?php if (empty($_GET['showall'])) : ?>
                    <li><?php echo $Html -> link(__('Show All', 'wp-mailinglist'), $Html -> retainquery('showall=1')); ?></li>
                <?php else : ?>
                    <li><?php echo $Html -> link(__('Show Paging', 'wp-mailinglist'), "?page=" . $this -> sections -> subscribers); ?></li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
		<p class="search-box">
			<input id="post-search-input" class="search-input" type="text" name="searchterm" value="<?php echo (!empty($_POST['searchterm'])) ? $_POST['searchterm'] : esc_html($_GET[$this -> pre . 'searchterm']); ?>" />
			<button value="1" type="submit" class="button">
				<?php _e('Search Subscribers', 'wp-mailinglist'); ?>
			</button>
		</p>
	</form>
	<br class="clear" />
    <form id="posts-filter" action="?page=<?php echo $this -> sections -> subscribers; ?>" method="get">
    	<input type="hidden" name="page" value="<?php echo $this -> sections -> subscribers; ?>" />
    	
    	<?php if (!empty($_GET[$this -> pre . 'searchterm'])) : ?>
    		<input type="hidden" name="<?php echo $this -> pre; ?>searchterm" value="<?php echo esc_attr(stripslashes(esc_html($_GET[$this -> pre . 'searchterm']))); ?>" />
    	<?php endif; ?>
    	
    	<div class="alignleft actions">
    		<?php _e('Filters:', 'wp-mailinglist'); ?>
    		<?php $filter_list = (!empty($_COOKIE['newsletters_filter_subscribers_list'])) ? $_COOKIE['newsletters_filter_subscribers_list'] : $_GET['list']; ?>
    		<select name="list" onchange="newsletters_change_filter('subscribers', 'list', this.value); if (jQuery('option:selected', this).data('paid') == 1) { jQuery('#expireddiv').show(); } else { jQuery('#expireddiv').hide(); }">
    			<option <?php echo (!empty($filter_list) && $filter_list == "all") ? 'selected="selected"' : ''; ?> value="all"><?php _e('All Mailing Lists', 'wp-mailinglist'); ?></option>
    			<option <?php echo (!empty($filter_list) && $filter_list == "none") ? 'selected="selected"' : ''; ?> value="none"><?php _e('No Mailing Lists', 'wp-mailinglist'); ?></option>
    			<?php if ($mailinglists = $Mailinglist -> select(true)) : ?>
    				<?php foreach ($mailinglists as $list_id => $list_title) : ?>
    					<?php $mailinglist = $Mailinglist -> get($list_id); ?>
    					<option data-paid="<?php echo (!empty($mailinglist -> paid) && $mailinglist -> paid == "Y") ? 1 : 0; ?>" <?php echo (!empty($filter_list) && $filter_list == $list_id) ? 'selected="selected"' : ''; ?> value="<?php echo $list_id; ?>"><?php echo __($list_title); ?></option>
    				<?php endforeach; ?>
    			<?php endif; ?>
    		</select>
    		<?php
	    		
	    	$filter_expired = (!empty($_COOKIE['newsletters_filter_subscribers_expired'])) ? $_COOKIE['newsletters_filter_subscribers_expired'] : $_GET['expired'];
	    	$showexpired = false;
	    	if (!empty($filter_list)) {
		    	if ($mailinglist = $Mailinglist -> get($filter_list)) {
			    	if (!empty($mailinglist -> paid) && $mailinglist -> paid == "Y") {
				    	$showexpired = true;
			    	}
		    	}
	    	}	
	    		
	    	?>
    		<span id="expireddiv" style="display:<?php echo (!empty($showexpired)) ? '' : 'none'; ?>;">
    			<select name="expired" onchange="newsletters_change_filter('subscribers', 'expired', this.value);">
	    			<option <?php echo (!empty($filter_expired) && $filter_expired == "all") ? 'selected="selected"' : ''; ?> value="all"><?php _e('All Expired/Not Expired', 'wp-mailinglist'); ?></option>
	    			<option <?php echo (!empty($filter_expired) && $filter_expired == "expired") ? 'selected="selected"' : ''; ?> value="expired"><?php _e('Expired', 'wp-mailinglist'); ?></option>
	    			<option <?php echo (!empty($filter_expired) && $filter_expired == "notexpired") ? 'selected="selected"' : ''; ?> value="notexpired"><?php _e('Not Expired', 'wp-mailinglist'); ?></option>
    			</select>
    		</span>
    		<?php $filter_status = (empty($_COOKIE['newsletters_filter_subscribers_status'])) ? $_GET['status'] : $_COOKIE['newsletters_filter_subscribers_status']; ?>
    		<select name="status" onchange="newsletters_change_filter('subscribers', 'status', this.value);">
    			<option <?php echo (!empty($filter_status) && $filter_status == "all") ? 'selected="selected"' : ''; ?> value="all"><?php _e('All Status', 'wp-mailinglist'); ?></option>
    			<option <?php echo (!empty($filter_status) && $filter_status == "active") ? 'selected="selected"' : ''; ?> value="active"><?php _e('Active Subscriptions', 'wp-mailinglist'); ?></option>
    			<option <?php echo (!empty($filter_status) && $filter_status == "inactive") ? 'selected="selected"' : ''; ?> value="inactive"><?php _e('Inactive Subscriptions', 'wp-mailinglist'); ?></option>
    		</select>
    		<?php $filter_registered = (empty($_COOKIE['newsletters_filter_subscribers_registered'])) ? $_GET['registered'] : $_COOKIE['newsletters_filter_subscribers_registered']; ?>
    		<select name="registered" onchange="newsletters_change_filter('subscribers', 'registered', this.value);">
    			<option <?php echo (!empty($filter_registered) && $filter_registered == "all") ? 'selected="selected"' : ''; ?> value="all"><?php _e('All Subscribers', 'wp-mailinglist'); ?></option>
    			<option <?php echo (!empty($filter_registered) && $filter_registered == "Y") ? 'selected="selected"' : ''; ?> value="Y"><?php _e('Registered Users', 'wp-mailinglist'); ?></option>
    			<option <?php echo (!empty($filter_registered) && $filter_registered == "N") ? 'selected="selected"' : ''; ?> value="N"><?php _e('Not Registered', 'wp-mailinglist'); ?></option>
    		</select>
    		<button value="1" type="submit" name="filter" class="button button-primary">
    			<?php _e('Filter', 'wp-mailinglist'); ?>
    		</button>
    	</div>
    </form>
    <br class="clear" />
	<?php $this -> render('subscribers' . DS . 'loop', array('subscribers' => $subscribers, 'paginate' => $paginate), true, 'admin'); ?>
</div>