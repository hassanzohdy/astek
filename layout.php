<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="style/<?=$config->favicon;?>" rel="shortcut icon">
  <title><?=$config->title?></title>
  <?php foreach ($config->styles as $stylesheet) { ?>
<link href="style/<?=$stylesheet?>" rel="stylesheet" />
  <?php } ?>
<link href="style/css/<?=$page?>.css" rel="stylesheet">
  
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="<?=str_replace(' ', '-', $page)?>-page">
  <?php 
  foreach ($config->common->beforeContent as $section) {
    require "common/$section.php";
  } ?>

  <main>
    <?php require "pages/$page.php"; ?>
  </main>

  <?php
  foreach ($config->common->afterContent as $section) {
    require "common/$section.php";
  }
  ?>

  <?php foreach ($config->js as $script) { ?>
  <script src="style/<?=$script?>"></script>
   <?php } ?>
</body>
</html>