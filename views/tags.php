<? include "views/header.php"; ?>

	<div class="tags">
		<h1>Tags</h1>

		<ul>
			<? foreach ($Tags as $Tag): ?>
				<li><a href="/tag/<?= $Tag['name'] ?>"><?= $Tag['name'] ?></a> (<?= $Tag['count'] ?>)</li>
			<? endforeach; ?>
		</ul>
	</div>
	
<? include "views/footer.php"; ?>