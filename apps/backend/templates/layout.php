<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <ul style="margin:10px 0 10px 0">
      <li style="font-size:16px;"><a href="/backend.php/order/export">export order csv</a></li>      
      <li style="font-size:16px;"><a href="/backend.php/order">manage orders</a></li>
      <li style="font-size:16px;"><a href="/backend.php/site_setting">manage site settings</a></li>
    </ul>
    <?php echo $sf_content ?>
  </body>
</html>
