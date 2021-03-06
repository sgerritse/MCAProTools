<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>

<div class="wrap">
  <?php echo PrliAppHelper::page_title(__('Add Pretty Link', 'pretty-link')); ?>

  <?php require(PRLI_VIEWS_PATH.'/shared/errors.php'); ?>

  <form name="form1" method="post" action="<?php echo admin_url("admin.php?page=pretty-link"); ?>">
    <input type="hidden" name="action" value="create">
    <?php wp_nonce_field('update-options'); ?>

    <?php require(PRLI_VIEWS_PATH.'/links/form.php'); ?>

    <p class="submit">
      <input type="submit" class="button button-primary" name="submit" value="<?php _e('Create', 'pretty-link'); ?>" /> &nbsp; <a href="<?php echo admin_url('admin.php?page=pretty-link'); ?>" class="button"><?php _e('Cancel', 'pretty-link'); ?></a>
    </p>
  </form>
</div>
