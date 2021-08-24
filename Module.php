<?php

namespace sij\humhub\modules\sponsor;

use Yii;

class Module extends \humhub\components\Module
{

    /**
    * @inheritdoc
    */
    public function disable()
    {
        // Cleanup all module data, don't remove the parent::disable()!!!
        parent::disable();
    }

}
