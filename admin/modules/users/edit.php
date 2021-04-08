<?php
// connect database 
    require_once __DIR__. "/../../autoload/autoload.php";
//active navbar
  $currentPage = 'users'; // current page is about, do the same for other page
  
  $id = intval(getInput('id'));
  $editUser = $db->fetchID('user',$id);  

  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $data =
    [
        'last_name' => postInput('last_name'),
        'first_name' => postInput('first_name'),
        'email' => postInput('email'),
        'address' => postInput('address'),
        'phone' => postInput('phone')
    ];

    $error = [];
    if(postInput('last_name') == '')
    {
        $error['last_name'] = 'Input is null';
    }
    if(postInput('first_name') == '')
    {
        $error['first_name'] = 'Input is null';
    }
    if(postInput('email') == '')
    {
        $error['email'] = 'Input is null';
    }
    if(postInput('address') == '')
    {
        $error['address'] = 'Input is null';
    }
    if(postInput('phone') == '')
    {
        $error['phone'] = 'Input is null';
    }


    if(empty($error))
    {
        $update = $db->update('user',$data,array('id'=>$id));
        if($update > 0)
        {
            header("Location: http://localhost/fruitstore/admin/modules/users/index.php");
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
                  <h4 class="card-title "><?php echo $editUser['first_name'] ?> <?php echo $editUser['last_name'] ?></h4>
                  <div class="d-fex">
                   <a href="index.php" class="card-category">Back</a>
                  </div>
                  <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
                <!-- mainn -->
                </div>
                <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">User's first name : </label>
                        <input 
                        type="text" 
                        class="form-control" 
                        id="exampleInputEmail1" 
                        aria-describedby="emailHelp"
                        name="first_name"
                        value="<?php echo $editUser['first_name'] ?>"
                        >
                        <div class="has-danger">
                        <?php if(isset($error['first_name'])): ?>
                        <label class="control-label bmd-label"><?php echo $error['first_name'] ?></label>
                        <?php endif;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">User's last name : </label>
                        <input 
                          type="text" 
                          class="form-control" 
                          id="exampleInputEmail1" 
                          aria-describedby="emailHelp"
                          name="last_name"
                          value="<?php echo $editUser['last_name'] ?>"
                        >
                        <div class="has-danger">
                        <?php if(isset($error['last_name'])): ?>
                          <label class="control-label bmd-label"><?php echo $error['name'] ?></label>
                        <?php endif;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2">User's Email : </label>
                        <input 
                          type="email" 
                          class="form-control" 
                          id="exampleInputEmail2" 
                          aria-describedby="emailHelp"
                          name="email"
                          value="<?php echo $editUser['email'] ?>"
                        >
                        <div class="has-danger">
                        <?php if(isset($error['email'])): ?>
                          <label class="control-label bmd-label"><?php echo $error['email'] ?></label>
                        <?php endif;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">User's address : </label>
                        <input 
                          type="text" 
                          class="form-control" 
                          id="exampleInputEmail1" 
                          aria-describedby="emailHelp"
                          name="address"
                          value="<?php echo $editUser['address'] ?>"
                        >
                        <div class="has-danger">
                        <?php if(isset($error['address'])): ?>
                          <label class="control-label bmd-label"><?php echo $error['address'] ?></label>
                        <?php endif;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">User's phone : </label>
                        <input 
                          type="number" 
                          class="form-control" 
                          id="exampleInputEmail1" 
                          aria-describedby="emailHelp"
                          name="phone"
                          value="<?php echo $editUser['phone'] ?>"
                        >
                        <div class="has-danger">
                        <?php if(isset($error['phone'])): ?>
                          <label class="control-label bmd-label"><?php echo $error['phone'] ?></label>
                        <?php endif;?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
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