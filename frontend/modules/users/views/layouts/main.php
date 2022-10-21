<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use common\components\CategoriesNavWidget;
use common\models\Categories;
use kartik\icons\FontAwesomeAsset;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap5\ButtonDropdown;
use yii\bootstrap5\Dropdown;

FontAwesomeAsset::register($this);
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
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-success',
            ],
        ]);
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
        ];
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
            'items' => $menuItems,
        ]);
        if (!Yii::$app->user->isGuest) {
            echo ButtonDropdown::widget([
                'label' => FA::icon('user') . ' Profile',
                'buttonOptions' => ['class' => 'text-white'],
                'encodeLabel' => false,
                'dropdown' => [
                    'items' => [
                        ['label' => 'Services', 'url' => ['my/services']],
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')', 'url' => '/site/logout'],
                    ],
                ],
            ]);
        }
        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container p-0">
            <?= CategoriesNavWidget::widget(['model' => new Categories(), 'parent' => null]) ?>
        </div>
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
            <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="float-end"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
