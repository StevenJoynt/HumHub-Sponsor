<?php

namespace sij\humhub\modules\sponsor\widgets;

use Yii;
use humhub\components\Widget;
use humhub\libs\ProfileImage;
use sij\humhub\modules\sponsor\models\Sponsor;

/**
 * Sponsors shows those invited by this user,
 * and who invited this user, in sidebar.
 */
class Sponsors extends Widget
{

    public $user;

    private function getProfileImage($user) {
        $cfg = [ 'showTooltip' => true ];
        $img = new ProfileImage($user->guid);
        return $img->render(24, $cfg) . "\n";
    }

    public function run()
    {

        $mySponsor = "";
        foreach ( Sponsor::findInviter($this->user->id) as $inviter ) {
            $user = $inviter->inviter;
            if ( $user ) {
                $mySponsor .= $this->getProfileImage($user);
            } else {
                $mySponsor .=
                    "[<a href=\"mailto:" . $inviter->created_email . "\">" .
                    htmlentities($inviter->created_name) .
                    "</a>]\n";
            }
        }

        $iSponsor = "";
        foreach ( Sponsor::findInvited($this->user->id) as $invited ) {
            $user = $invited->invited;
            if ( $user ) {
                $iSponsor .= $this->getProfileImage($user);
            }
        }

        if ( empty($mySponsor) && empty($iSponsor) ) return;

        return $this->render(
            'sponsorPanel',
            [
                'mySponsor' => $mySponsor,
                'iSponsor' => $iSponsor,
            ]
        );

    }

}
