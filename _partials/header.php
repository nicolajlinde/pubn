<!-- Meta tags -->
<meta charset="UTF-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">


<!-- Favicons-->
<link rel="icon" href="#" type="image/gif" sizes="16x16">

<!-- Google fonts-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Teko" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Chewy" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet">


<!-- CSS -->
<link rel="stylesheet" href="assets/css/normalize.css">
<link rel="stylesheet" href="assets/css/main.css">

<!-- Font Awesome (icon package) -->
<script src="https://use.fontawesome.com/d3f1ae9c80.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css"
      integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">


<!-- schema.org + JSON-LD -->
<script src="json/json-ld.json" type="application/ld+json"></script>


<!-- Site title-->
<?php if ($title == "") { ?>
    <title>Published News</title>
<?php } else { ?>
    <title><?php echo htmlspecialchars($title) ?> | Battle Royale Games</title>
<?php } ?>