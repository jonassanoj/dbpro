<div id="body">‎
<div class="box">
<h3> <?php echo lang('msg_login_failed') ?></h3>
<p><?php echo sprintf(lang('msgvar_login_trial'), $failed_logins); ?></p> 
<?php $this->load->view('content/form/login'); ?>
</div> <!-- box-->
</div> <!-- body -->
