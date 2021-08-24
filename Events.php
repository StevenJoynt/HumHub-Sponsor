<?php

namespace sij\humhub\modules\sponsor;

use Yii;
use yii\helpers\Url;
use sij\humhub\modules\sponsor\widgets\Sponsors;
use sij\humhub\modules\sponsor\models\Sponsor;

class Events
{

    public static function onProfileSidebarInit($event)
    {
        try {
            if ( Yii::$app->user->isGuest ) return;
            $user = $event->sender->user;
            if ( ! $user ) return;
            $event->sender->addWidget(
                Sponsors::class,
                ['user' => $user],
                ['sortOrder' => 500]
            );
        } catch ( \Throwable $e ) {
            Yii::error($e);
        }
    }

    public static function onAfterInsertInvite($event)
    {
        try {
            $identity = Yii::$app->user->getIdentity();
            $sponsor = new Sponsor();
            $sponsor->invited_email = strtolower(trim($event->sender->email));
            $sponsor->created_by = $identity->id;
            $sponsor->created_name = $identity->displayName;
            $sponsor->created_email = strtolower(trim($identity->email));
            $sponsor->save();
        } catch ( \Throwable $e ) {
            Yii::error($e);
        }
    }

    public static function onAfterRegistration($event)
    {
        $identity = $event->identity;
        $email = strtolower(trim($identity->email));
        $user_id = $identity->id;
        Sponsor::updateInvitation($email, $user_id);
    }

}
