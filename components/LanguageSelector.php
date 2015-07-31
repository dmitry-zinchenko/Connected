<?php
/**
 * Created by PhpStorm.
 * User: Dmitry
 * Date: 30.07.2015
 * Time: 14:44
 */

namespace app\components;

use yii;
use yii\base\BootstrapInterface;
use app\models\Users;

class LanguageSelector implements BootstrapInterface
{
    public $supportedLanguages = [];

    public function bootstrap($app)
    {
        if(!\Yii::$app->user->isGuest) {
            $user = Users::findOne(Yii::$app->user->getId());
        }

        if(($preferredLanguage = $app->request->post('language')) && $user) {
            $user->language = $preferredLanguage;
            $user->save();
        } elseif ($user) {
            $preferredLanguage = $user->language;
        } elseif (empty($preferredLanguage)) {
            $preferredLanguage = isset($app->request->cookies['language']) ?
                (string)$app->request->cookies['language'] :
                $app->request->getPreferredLanguage($this->supportedLanguages);
        }

        $cookies = $app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => 'language',
            'value' => $preferredLanguage,
            'expire' => time() + 60 * 60 * 24 * 30,
        ]));

        return $app->language = $preferredLanguage;
    }
}