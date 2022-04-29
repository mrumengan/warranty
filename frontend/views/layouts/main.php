<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="//img1.wsimg.com/isteam/ip/133dd2a3-6070-41c6-ad94-b7158afddea9/logo/8373db80-187c-4081-b286-1dfcd00345ca.png/:/rs=h:80,cg:true,m/qt=q:95" srcset="//img1.wsimg.com/isteam/ip/133dd2a3-6070-41c6-ad94-b7158afddea9/logo/8373db80-187c-4081-b286-1dfcd00345ca.png/:/rs=h:80,cg:true,m/qt=q:95, //img1.wsimg.com/isteam/ip/133dd2a3-6070-41c6-ad94-b7158afddea9/logo/8373db80-187c-4081-b286-1dfcd00345ca.png/:/rs=h:160,cg:true,m/qt=q:95 2x, //img1.wsimg.com/isteam/ip/133dd2a3-6070-41c6-ad94-b7158afddea9/logo/8373db80-187c-4081-b286-1dfcd00345ca.png/:/rs=h:240,cg:true,m/qt=q:95 3x" alt="VapeZOO" data-ux="ImageLogo" data-aid="HEADER_LOGO_IMAGE_RENDERED" id="logo-3451" class="x-el x-el-img c1-1 c1-2 c1-30 c1-10 c1-w c1-x c1-1b c1-1d c1-35 c1-36 c1-37 c1-38 c1-39 c1-3a c1-1o c1-1p c1-1q c1-33 c1-3b c1-34 c1-b c1-c c1-3c c1-3d c1-3e c1-3f c1-3g c1-3h c1-3i c1-3j c1-3k c1-3l c1-3m c1-3n c1-3o c1-3p c1-d c1-3q c1-3r c1-3s c1-e c1-f c1-g" style="max-height: 35px; box-shadow: none; margin-top: 0px;">'
                        . '<div>'.Yii::$app->name.'</div>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index'], 'visible' => !Yii::$app->user->isGuest],
        ['label' => 'Hexohm', 'url' => ['/user-parts'], 'visible' => !Yii::$app->user->isGuest],
        ['label' => 'Repair', 'url' => ['/repairs'], 'visible' => !Yii::$app->user->isGuest],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'Profile', 'url' => ['/members/view', 'id' => Yii::$app->user->id]];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-right"><?= 'Powered By Interindo' ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
