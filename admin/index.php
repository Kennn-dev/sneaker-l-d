<?php
// connect database 
    require_once __DIR__. "/autoload/autoload.php";
    
    $products = $db->fetchAll("products");
?>


<?php require_once __DIR__. "/layouts/header.php"; ?>
      <!-- CONTENT CHANGING HERE -->
      <div class="content">
        
      </div>
      <!-- CONTENT CHANGING END -->
<?php require_once __DIR__. "/layouts/footer.php"; ?>