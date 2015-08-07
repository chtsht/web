<?php

if (isset($Chtsht['id'])) {
	$metaTitle = $Chtsht['name'] . ' - History';
	$metaDescription = 'History for the cheatsheet '.$Chtsht['name'].'.';

	$Response = $Client->get('chtsht/history/'.$Chtsht['id']);

	if ($Response->getStatusCode() == '200') {
		$res = $Response->json();

		$historyObj = (isset($res['history'])) ? $res['history'] : null;
		// build history for our view
		$prevUserId = 0; $prevDateAdded = 0;
		$History = array();
		$count = 0;
		foreach($historyObj as $line) {
			if ($line['user_id'] != $prevUserId or strtotime($line['date_added'])+900 < strtotime($prevDateAdded)) {
				$count++;
			}
			if (!isset($History[$count]['user_id'])) {
				$History[$count] = array(
					'user_id'=>$line['user_id'],
					'display_name'=>$line['display_name'],
					'avatar'=>$line['avatar']
				);
			}
			$History[$count]['entries'][] = array(
				'id'=>$line['id'],
				'module'=>$line['module'],
				'date_added'=>$line['date_added'],
				'data'=>$line['data'],
			);

			$prevUserId = $line['user_id'];
			$prevDateAdded = $line['date_added'];
		}
	} else {
		require 'views/loadError.php';
		exit;
	}
}

header('Location: /');
exit;