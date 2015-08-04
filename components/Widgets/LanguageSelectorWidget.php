<?php
/**
 * Created by PhpStorm.
 * User: Dmitry
 * Date: 30.07.2015
 * Time: 15:12
 */

namespace app\components\Widgets;

use yii;
use yii\base\Widget;

class LanguageSelectorWidget extends Widget
{
    public $supportedLanguages;
    protected $queryParams;

    public function init()
    {
        parent::init();
        $this->supportedLanguages = $this->supportedLanguages !== null ? $this->supportedLanguages : [];
        $params = Yii::$app->request->queryParams;
        $this->queryParams = '?';
        foreach($params as $key => $value) {
            $this->queryParams .= $key . '=' . $value . '&';
        }
    }

    public function run()
    {
        return $this->render('language-selector', [
            'queryParams' => $this->queryParams,
            'languages' => $this->supportedLanguages
        ]);
    }
}