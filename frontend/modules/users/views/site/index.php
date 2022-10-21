<?php

use common\components\ServicesGridWidget;
use common\models\Services;

if (!empty($category)) {
    echo ServicesGridWidget::widget(['category' => $category]);
} else {
    echo ServicesGridWidget::widget();
}
