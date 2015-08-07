<? include "views/header.php"; ?>

	<h1>All Cheatsheets</h1>

	<? foreach ($Chtshts as $Chtsht): ?>
		<h3><a href="/<?= $Chtsht['url'] ?>"><?= $Chtsht['name'] ?></a></h3>
		<p><?= $Chtsht['description'] ?></p>
	<? endforeach; ?>
	
<? include "views/footer.php"; ?>