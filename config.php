<?php

use sij\humhub\modules\sponsor\Events;
use humhub\modules\user\widgets\ProfileSidebar;
use humhub\modules\user\models\Invite;
use humhub\modules\user\models\forms\Registration;

return [
	'id' => 'sponsor',
	'class' => 'sij\humhub\modules\sponsor\Module',
	'namespace' => 'sij\humhub\modules\sponsor',
	'events' => [
		[
			'class' => ProfileSidebar::class,
			'event' => ProfileSidebar::EVENT_INIT,
			'callback' => [Events::class, 'onProfileSidebarInit']
		],
		[
			'class' => Invite::class,
			'event' => Invite::EVENT_AFTER_INSERT,
			'callback' => [Events::class, 'onAfterInsertInvite']
		],
		[
			'class' => Registration::class,
			'event' => Registration::EVENT_AFTER_REGISTRATION,
			'callback' => [Events::class, 'onAfterRegistration']
		],

	],
];
