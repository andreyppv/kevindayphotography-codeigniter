<fieldset>
	<legend>Test Results</legend>
</fieldset>


<?php if (isset($results)) : ?>

	<?php if ($results['success'] !== false) :?>
		<div class="alert alert-info fade in">
			The email appears to be set correctly. If you do not see the email in your inbox, try looking in your Spam box or Junk mail.
		</div>
	<?php else : ?>
		<div class="alert alert-warning fade in">
			The email looks like it is not set correctly.
		</div>
	<?php endif; ?>

	<fieldset>
		<legend>Debug Information</legend>

		<div style="padding: 10px"><?php echo $results['debug']; ?></div>
	</fieldset>

<?php else : ?>

	<div class="alert alert-error fade in">
		<a class="close" data-dismiss="alert">&times;</a>
		Either the test did not run, or did not return any results.
	</div>

<?php endif; ?>
