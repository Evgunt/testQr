<?php

    use app\assets\AppAsset;
    use yii\helpers\Html;
    use yii\helpers\Url;

    AppAsset::register($this);
    $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Shortener</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="container mt-5"><?= $content ?></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
