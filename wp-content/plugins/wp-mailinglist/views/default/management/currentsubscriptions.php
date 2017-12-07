<?php	$paymentmethod = $this -> get_option('paymentmethod');		?><h3><?php _e('Current Subscriptions', 'wp-mailinglist'); ?></h3><?php if (!empty($subscriber -> subscriptions)) : ?>        <p><?php _e('Below are your current subscriptions to our list(s).', 'wp-mailinglist'); ?><br/>    <?php _e('An Active status indicates that you will receive emails on that list.', 'wp-mailinglist'); ?></p>        <?php if (!empty($errors)) : ?>    	<?php $this -> render('error', array('errors' => $errors), true, 'default'); ?>    <?php endif; ?>    <?php if (!empty($success) && $success == true) : ?>    	<div class="ui-state-highlight ui-corner-all">    		<p><i class="fa fa-check"></i> <?php echo $successmessage; ?></p>    	</div>    <?php endif; ?>	<table>    	<tbody>    		<?php $intervals = $this -> get_option('intervals'); ?>        	<?php foreach ($subscriber -> subscriptions as $subscription) : ?>        		<?php if (empty($subscription -> mailinglist -> privatelist) || $subscription -> mailinglist -> privatelist != "Y") : ?>	            	<tr id="currentsubscription<?php echo $subscription -> mailinglist -> id; ?>">	                	<td>	                    	<label for="mailinglists<?php echo $subscription -> mailinglist -> id; ?>"><?php echo __($subscription -> mailinglist -> title); ?></label>	                    	<?php if ($subscription -> mailinglist -> paid == "Y") : ?>	                    		<span class="wpmlcustomfieldcaption"><?php echo $Html -> currency() . '' . number_format($subscription -> mailinglist -> price, 2, '.', '') . ' ' . $intervals[$subscription -> mailinglist -> interval]; ?></span>	                    	<?php endif; ?>	                        <?php if ($subscription -> mailinglist -> paid == "Y" && $subscription -> active == "Y") : ?>	                        	<?php $expiresdate = (!empty($subscription -> mailinglist -> interval) && $subscription -> mailinglist -> interval != "once") ? $Html -> gen_date(false, strtotime($Mailinglist -> gen_expiration_date($subscriber -> id, $subscription -> mailinglist -> id))) : __('Never', 'wp-mailinglist'); ?>	                        	<span class="wpmlcustomfieldcaption"><?php _e('Expires:', 'wp-mailinglist'); ?> <strong><?php echo $expiresdate; ?></strong></span>	                        	<?php if (!empty($subscription -> mailinglist -> maxperinterval)) : ?>	                        		<span class="wpmlcustomfieldcaption"><?php echo sprintf(__('%s out of %s sent', 'wp-mailinglist'), $subscription -> paid_sent, $subscription -> mailinglist -> maxperinterval); ?></span>	                        	<?php endif; ?>	                        <?php endif; ?>	                    </td>	                    <td><label for="mailinglists<?php echo $subscription -> mailinglist -> id; ?>"><?php echo ($subscription -> active == "Y") ? '<span class="newsletters_success">' . __('Active', 'wp-mailinglist') . '</span>' : '<span class="newsletters_error">' . __('Inactive', 'wp-mailinglist') . '</span>'; ?></label></td>	                    <td>	                    	<span id="activatelink<?php echo $subscription -> mailinglist -> id; ?>">	                    	<?php if ($subscription -> active == "Y") : ?>	                        	<a href="" class="newsletters_button ui-button-error" onclick="remove_subscription('<?php echo $subscriber -> id; ?>','<?php echo $subscription -> mailinglist -> id; ?>','N'); return false;"><?php _e('Remove', 'wp-mailinglist'); ?></a>	                        	<?php if (!empty($subscription -> mailinglist -> paid) && $subscription -> mailinglist -> paid == "Y") : ?>	                        		<form action="<?php echo $Html -> retainquery('method=paidsubscription', $this -> get_managementpost(true, false, false)); ?>" method="post" id="paidsubscription_<?php echo $subscription -> mailinglist -> id; ?>">		                        		<input type="hidden" name="extend" value="1" />		                        		<input type="hidden" name="subscriber_id" value="<?php echo esc_attr(stripslashes($subscriber -> id)); ?>" />		                        		<input type="hidden" name="list_id" value="<?php echo esc_attr(stripslashes($subscription -> mailinglist -> id)); ?>" />		                        		<button value="1" type="submit" class="btn btn-success" name="pay">		                        			<?php _e('Extend', 'wp-mailinglist'); ?>		                        		</button>	                        		</form>	                        	<?php endif; ?>	                        <?php else : ?>	                        	<?php if (!empty($subscription -> mailinglist -> paid) && $subscription -> mailinglist -> paid == "Y") : ?>	                        		<form action="<?php echo $Html -> retainquery('method=paidsubscription', $this -> get_managementpost(true, false, false)); ?>" method="post" id="paidsubscription_<?php echo $subscription -> mailinglist -> id; ?>">		                        		<input type="hidden" name="extend" value="0" />		                        		<input type="hidden" name="subscriber_id" value="<?php echo esc_attr(stripslashes($subscriber -> id)); ?>" />		                        		<input type="hidden" name="list_id" value="<?php echo esc_attr(stripslashes($subscription -> mailinglist -> id)); ?>" />		                        		<button value="1" type="submit" class="btn btn-success" name="pay">		                        			<?php _e('Pay Now', 'wp-mailinglist'); ?>		                        		</button>	                        		</form>	                        	<?php else : ?>	                        		<a href="javascript:wpmlmanagement_activate('<?php echo $subscriber -> id; ?>','<?php echo $subscription -> mailinglist -> id; ?>','Y');" onclick="if (!confirm('<?php _e('Are you sure you want to activate this subscription?', 'wp-mailinglist'); ?>')) { return false; }" class="<?php echo $this -> pre; ?>button activatebutton ui-button-success"><?php _e('Activate', 'wp-mailinglist'); ?></a>	                        	<?php endif; ?>	                        	<a href="" class="newsletters_button ui-button-error" onclick="remove_subscription('<?php echo $subscriber -> id; ?>','<?php echo $subscription -> mailinglist -> id; ?>','N'); return false;"><?php _e('Remove', 'wp-mailinglist'); ?></a>	                        <?php endif; ?>	                       	</span>	                    </td>	                </tr>	                <?php $subscribedlists[] = $subscription -> mailinglist -> id; ?>	            <?php endif; ?>            <?php endforeach; ?>        </tbody>    </table>        <div style="display:none;">	    <div id="dialog-form" title="<?php _e('Unsubscribe', 'wp-mailinglist'); ?>">		    <form action="" method="" id="unsubscribe-form">			    <p>				    <label for="unsubscribe_comments"><?php _e('Comments (optional)', 'wp-mailinglist'); ?></label>				    <textarea name="unsubscribe_comments" cols="100%" rows="4" id="unsubscribe_comments"></textarea>			    </p>			    			    <input type="hidden" name="unsubscribe_subscriber_id" id="unsubscribe_subscriber_id" value="<?php echo $subscriber -> id; ?>" />			    <input type="hidden" name="unsubscribe_list_id" id="unsubscribe_list_id" value="" />			    <input type="hidden" name="unsubscribe_status" id="unsubscribe_status" value="N" />		    </form>		</div>    </div>        <script type="text/javascript"><?php $unsubscribecomments = $this -> get_option('unsubscribecomments'); ?> var unsubscribecomments = <?php echo (!empty($unsubscribecomments) && $unsubscribecomments == "Y") ? "true" : "false"; ?>; function remove_subscription(subscriber_id, list_id, status) { if (unsubscribecomments == true) { dialog.dialog('open'); jQuery('#unsubscribe_subscriber_id').val(subscriber_id); jQuery('#unsubscribe_list_id').val(list_id); jQuery('#unsubscribe_status').val("N"); } else { if (confirm('<?php echo __('Are you sure you want to remove this subscription?', 'wp-mailinglist'); ?>')) { wpmlmanagement_activate(subscriber_id, list_id, status); }}} jQuery(document).ready(function() { if (jQuery.isFunction(jQuery.fn.button)) { jQuery('.<?php echo $this -> pre; ?>button, .newsletters_button').button(); } dialog = jQuery( "#dialog-form" ).dialog({dialogClass:'newsletters-ui-dialog', autoOpen: false, modal: true, buttons: {'Unsubscribe': function() { unsubscribe_comments = jQuery('#unsubscribe_comments').val(); var subscriber_id = '<?php echo $subscriber -> id; ?>'; var list_id = jQuery('#unsubscribe_list_id').val(); var status = "N"; wpmlmanagement_activate(subscriber_id, list_id, status); jQuery('#unsubscribe_comments').val(""); dialog.dialog("close"); }, 'Cancel': function() { dialog.dialog("close"); } } }); });</script><?php else : ?>	<div class="ui-state-error ui-corner-all">		<p><i class="fa fa-exclamation-triangle"></i> <?php _e('You are not subscribed to any lists.', 'wp-mailinglist'); ?></p>	</div><?php endif; ?>