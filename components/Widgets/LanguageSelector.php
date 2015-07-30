<?php
/**
 * Created by PhpStorm.
 * User: Dmitry
 * Date: 30.07.2015
 * Time: 15:12
 */

namespace app\components\Widgets;

use yii\base\Widget;

class LanguageSelector extends Widget
{
    public $supportedLanguages;

    protected $data;

    public function init()
    {
        parent::init();

        $this->supportedLanguages = $this->supportedLanguages !== null ? $this->supportedLanguages : [];
    }

    public function run()
    {
        return $this->render('languageselector', [ 'languages' => $this->supportedLanguages ]);
    }
}