<? include "views/header.php"; ?>
	<div class="chtsht row">
		<h1><a href="/<?= $Chtsht['url'] ?>"><?= $Chtsht['name'] ?></a> - History</h1>
	</div>
	
	<div class="row">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<? foreach($History as $k=>$history): ?>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="heading<?= $k ?>">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $k ?>" aria-expanded="true" aria-controls="collapse<?= $k ?>">
							<? if ($history['avatar']): ?>
								<img src="<?= $history['avatar'] ?>&s=25" title="<?= $history['display_name'] ?>" alt="<?= $history['display_name'] ?>" />
							<? endif; ?>
							<span><?= $history['display_name']; ?></span>
						</a>
					</h4>
				</div>
				<div id="collapse<?= $k ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $k ?>">
					<div class="panel-body">
						<? foreach ($history['entries'] as $entry): ?>
						<div class="row">
							<div class="col-sm-2">
								<?= $entry['module']; ?>
							</div>
							<div class="col-sm-5">
								<?= $entry['data']; ?>
							</div>
							<div class="col-sm-3">
								<?= $entry['date_added']; ?>
							</div>
						</div>
						<? endforeach; ?>
					</div>
				</div>
			</div>
		<? endforeach; ?>
		</div>
	</div>
<? include "views/footer.php"; ?>