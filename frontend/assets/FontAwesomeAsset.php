<?php
namespace frontend\assets;
use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/fortawesome/font-awesome';
    // public $js = [
    //     'js/all.min.js',
    // ];
    public $css = [
        'css/all.min.css',
    ];
}