<?php
//Place the Date configuration array inside your 'components' definitions

	// application components
	'components'=>array(
	
		'Date' => array(
			'class'=>'application.components.Date',
			//And integer that holds the offset of hours from GMT e.g. 4 for GMT +4
			'offset' => 4,
		),
	),
);
