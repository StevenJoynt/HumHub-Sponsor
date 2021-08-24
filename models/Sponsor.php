<?php

namespace sij\humhub\modules\sponsor\models;

use humhub\modules\user\models\User;

class Sponsor extends \humhub\components\ActiveRecord
{

    public static function tableName()
    {
        return 'sponsor';
    }

    public function rules()
    {
        return [
            [['invited_email', 'created_name', 'created_email'], 'required'],
            [['invited_id', 'created_by'], 'integer'],
            [['created_email'], 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invited_id' => 'Invited User ID',
            'invited_email' => 'Invited User Email Address',
            'created_by' => 'Invited By User ID',
            'created_name' => 'Invited By User Name',
            'created_email' => 'Invited By User Email Address',
        ];
    }

    public function getInvited()
    {
        return $this->hasOne(User::className(), ['id' => 'invited_id']);
    }

    public function getInviter()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public static function findInvited($user_id) {
        return Sponsor::find()
            ->where(['sponsor.created_by' => $user_id])
            ->all();
    }

    public static function findInviter($user_id) {
        return Sponsor::find()
            ->where(['sponsor.invited_id' => $user_id])
            ->all();
    }

    public static function updateInvitation($email, $user_id) {
        $items = Sponsor::find()->where(['invited_email' => strtolower(trim($email))])->all();
        foreach ( $items as $item ) {
          $item->invited_id = $user_id;
          $item->update(false);
        }
    }

}
