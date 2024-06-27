<!DOCTYPE html>
<html>
  <head>
  	<meta charset="UTF-8">
  	
    <title>PHP Test Application</title>
    
    <link href="favicon.ico" type="image/x-icon" rel="icon" />
    <link href="favicon.ico" type="image/x-icon" rel="shortcut icon" />	
      
    <link rel="stylesheet" type="text/css" href="assets/css/compiled.css">
    
    <script type="text/javascript" charset="utf-8" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="assets/js/bootstrap.min.js"></script>

  </head>
  <body>
    <div class="container-sm d-flex flex-column main p-0">
    <?php include __DIR__ . '/components/navbar.php'; ?>
      <div class="content">
        <?= $content ?>
      </div>  
      <?php include __DIR__ . '/components/footer.php'; ?>
    </div>  
  </body>
</html>