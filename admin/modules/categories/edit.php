<?php
// connect database 
    require_once __DIR__. "/../../autoload/autoload.php";
    
    $id = intval(getInput('id'));

    $editCategory = $db->fetchID('categories', $id);

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $data =
        [
            'name' => postInput('name')
        ];
        
        $error = [];
    
        if(postInput('name') == '')
        {
            $error['name'] = 'Input is null';
        };

        if(empty($error))
        {
            $id_update = $db->update('categories' , $data, array('id'=>$id));
            if($id_update > 0)
            {
                header("Location: http://localhost/fruitstore/admin/modules/categories/index.php");
            }
        }

        
    }
?>


<?php require_once __DIR__. "/../../layouts/header.php"; ?>
      <!-- CONTENT CHANGING HERE -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Edit category's name :</h4>
                  <div class="d-fex">
                   <a href="index.php" class="card-category">Back</a>
                  </div>
                  <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
                <!-- mainn -->
                </div>
                <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category's name : </label>
                        <input name="name" 
                            type="text" 
                            class="form-control" 
                            id="exampleInputEmail1" 
                            aria-describedby="emailHelp"
                            value="<?php echo $editCategory['name']; ?>"    
                        >
                        <?php if(isset($error['name'])): ?>
                        <label class="control-label"><?php echo $error['name'] ?></label>
                        <?php endif ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
              </div>
               <!-- mainn -->
            </div>
           
          </div>
        </div>
      </div>
      <!-- CONTENT CHANGING END -->
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>