<?php
// connect database 
    require_once __DIR__. "/../../autoload/autoload.php";
//active navbar
  $currentPage = 'products'; // current page is about, do the same for other page

  $categories = $db->fetchAll('categories');

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $data =
    [
        'name' => postInput('name'),
        'price' => postInput('price'),
        'categoryID' => postInput('categoryID'),
        'image' => postInput('image'),
        'description' => postInput('description')
    ];

    $error = [];
    if(postInput('name') == '')
    {
        $error['name'] = 'Input is null';
    }
    if(postInput('price') == '')
    {
        $error['price'] = 'Input is null';
    }
    if(postInput('description') == '')
    {
        $error['description'] = 'Input is null';
    }
    if(postInput('categoryID') == '')
    {
        $error['categoryID'] = 'Input is null';
    }
    if(! isset($_FILES['image']))
    {
      $error['image'] = 'No image';
    }


    if(empty($error))
    {
      if(isset($_FILES['image']))
      {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];

        if($file_error == 0)
        {
          $path = ROOT."products/";
          $data['image'] = $file_name;
        }

      }

      $id_insert = $db->insert('products',$data);
      if($id_insert)
      {
        move_uploaded_file($file_tmp,$path.$file_name);
        header("Location: http://localhost/fruitstore/admin/modules/products/index.php");
      };

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
                  <h4 class="card-title ">Add new Product :</h4>
                  <div class="d-fex">
                   <a href="index.php" class="card-category">Back</a>
                  </div>
                  <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
                <!-- mainn -->
                </div>
                <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product's name : </label>
                        <input 
                          type="text" 
                          class="form-control" 
                          id="exampleInputEmail1" 
                          aria-describedby="emailHelp"
                          name="name"
                        >
                        <div class="has-danger">
                        <?php if(isset($error['name'])): ?>
                          <label class="control-label bmd-label"><?php echo $error['name'] ?></label>
                        <?php endif;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2">Product's price : </label>
                        <input 
                          type="text" 
                          class="form-control" 
                          id="exampleInputEmail2" 
                          aria-describedby="emailHelp"
                          name="price"
                        >
                        <div class="has-danger">
                        <?php if(isset($error['price'])): ?>
                          <label class="control-label bmd-label"><?php echo $error['price'] ?></label>
                        <?php endif;?>
                        </div>
                    </div>
                    <div class="">
                      <label for="exampleFormControlSelect1">Image :</label>
                      <input type="file" name="image" id="">
                      <div class="has-danger">
                        <?php if(isset($error['image'])): ?>
                          <label class="control-label bmd-label"><?php echo $error['image'] ?></label>
                        <?php endif;?>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Category :</label>
                      <select 
                        class="form-control selectpicker" 
                        data-style="btn btn-link" 
                        id="exampleFormControlSelect1"
                        name="categoryID"
                      >
                      <?php foreach($categories as $item ): ?>  
                        <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
                      <?php endforeach ?>  
                      </select>
                      <div class="has-danger">
                        <?php if(isset($error['category'])): ?>
                          <label class="control-label bmd-label"><?php echo $error['category'] ?></label>
                        <?php endif;?>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Product's description : </label>
                        <textarea 
                          class="form-control" 
                          id="exampleInputEmail3" 
                          rows="3"
                          name="description"
                        ></textarea>
                        <div class="has-danger">
                        <?php if(isset($error['description'])): ?>
                          <label class="control-label bmd-label"><?php echo $error['description'] ?></label>
                        <?php endif;?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
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