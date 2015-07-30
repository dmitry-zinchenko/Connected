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

class LanguageSelectorClass implements BootstrapInterface
{
    public $supportedLanguages = [];

    public function bootstrap($app)
    {
        if($preferredLanguage = $app->request->post('language')) {
            $cookies = $app->response->cookies;

            $cookies->add(new \yii\web\Cookie([
                'name' => 'language',
                'value' => $preferredLanguage,
            ]));
        } else {
            if (\Yii::$app->user->isGuest) {
                $preferredLanguage = isset($app->request->cookies['language']) ? (string)$app->request->cookies['language'] : null;
            } else {
                // !!!
                // Add reading from database for registered user
                // !!!
            }

            if (empty($preferredLanguage)) {
                $preferredLanguage = $app->request->getPreferredLanguage($this->supportedLanguages);
//            if(!\Yii::$app->user->isGuest()) {
//                // Add language to database
//            }
            }
        }

        return $app->language = $preferredLanguage;
    }

}