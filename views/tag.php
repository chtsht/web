<? include "views/header.php"; ?>

	<h1>Tag '<?= $Tag['name'] ?>'</h1>

	<? foreach ($Tag['chtshts'] as $Chtsht): ?>
		<h3><a href="/<?= $Chtsht['url'] ?>"><?= $Chtsht['name'] ?></a></h3>
		<p><?= $Chtsht['description'] ?></p>
	<? endforeach; ?>
	
<? include "views/footer.php"; ?>