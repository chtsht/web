<? include "views/header.php"; ?>
<div class="chtsht" data-id="<?= $Chtsht['id'] ?>">
	<div class="info">
		<h1 class="name"><?= $Chtsht['name'] ?></h1>

		<div class="description">
			<? if ($Chtsht['description']): ?>
				<? $lines = explode("\n",$Chtsht['description']); ?>
				<? foreach($lines as $line): ?>
					<p><?= $line ?></p>
				<? endforeach; ?>
			<? else: ?>
				<span class="no-description">This cheatsheet currently has no description.  Please add one!</span>
			<? endif; ?>
		</div>

		<div class="menu">
			<!-- <a href="/<?= $Chtsht['url'] ?>/history"><span class="history-icon" title="History"><i class="fa fa-history"></i></span></a> -->
			<? if (isset($User['id'])): ?>
				<a href="/" class="js-chtsht-edit"><i class="js-lock fa fa-lock"></i></a>
			<? endif; ?>
		</div>
	</div>

	<div class="tags">
		<? if (!empty($Chtsht['tags'])): ?>
			<? foreach ($Chtsht['tags'] as $tag): ?>
				<span class="tag" data-name="<?= $tag;?>">
					<a href="/tag/<?= $tag; ?>"><?= $tag;?></a>
				</span>
			<? endforeach; ?>
		<? endif; ?>
	</div>

	<div class="blocks">
		<? foreach ($Chtsht['blocks'] as $Block): ?>
		<div class="block" id="block_<?= $Block['id'] ?>" data-id="<?= $Block['id'] ?>">
			<a name="<?= urlencode(str_replace(' ','-',$Block['name'])) ?>"></a>
			<h3 class="name"><?= $Block['name'] ?></h3> <a href="/<?= $Chtsht['url'] ?>#<?= urlencode(str_replace(' ','-',$Block['name'])) ?>"><i class="js-link fa fa-link link"></i></a>

			<div class="elements">
				<? foreach ($Block['elements'] as $Element): ?>
				<div id="element_<?= $Element['id'] ?>" class="element <? if($Element['type'] == 'short'): ?>short-element<? endif; ?>" data-id="<?= $Element['id'] ?>">
					<div class="description">
						<p>
							<? $descriptionLines = explode("\n",$Element['description']); ?>
							<? foreach($descriptionLines as $descriptionLine): ?>
								<?= $descriptionLine ?><br />
							<? endforeach; ?>
						</p>
					</div>

					<div class="entry <?= $Element['type'] ?>">
						<? if ($Element['type'] == 'command'): ?>
							<? $elements = explode("\n",$Element['content']); ?>
							<? foreach($elements as $element): ?>
								<p><span class="hash">#</span> <strong><?= $element ?></strong> <span class="js-copy copy-icon-wrapper"><span class="copy-icon" data-clipboard-text="<?= strip_tags($element) ?>"></span></span></p>
							<? endforeach; ?>
						<? else: ?>
<pre>
<?= $Element['content'] ?>
</pre>
						<? endif; ?>
					</div>
				</div>
				<? endforeach; ?>
			</div>
		</div>
		<? endforeach; ?>
	</div>
</div>

<? include "views/footer.php"; ?>