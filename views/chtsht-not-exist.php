<? include "views/header.php"; ?>
	<div id="new-chtsht-wrapper" class="row" data-name="<?= str_replace('-',' ',urldecode($chtshtUrl)); ?>">
		<h1>No result for '<?= str_replace('-',' ',urldecode($chtshtUrl)); ?>'</h1>

		<div class="msg-box text-center">
			<p class="msg">
				This cheatsheet does not exist yet.  <a href="/add">Add</a> one!
			</p>
		</div>
	</div>
	
<? include "views/footer.php"; ?>