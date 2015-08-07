<? include "views/header.php"; ?>
	<div class="add">
		<h1>Create a Cheatsheet</h1>

		<? if($resp->status == "FAILURE"): ?>
			<div class="msg warning">
				<p>There was an error:</p>

				<ul>
					<? foreach($resp->msg as $msg): ?>
						<li><?= $msg ?></li>
					<? endforeach; ?>
				</ul>
			</div>
		<? endif; ?>

		<form method="post">
			<input type="text" name="name" placeholder="Cheetsheet Name" value="<?= $name ?>" />
			<textarea name="description" placeholder="Cheatsheet Description"><?= $description ?></textarea>
			<button>Create</button>
		</form>
	</div>
	
<? include "views/footer.php"; ?>