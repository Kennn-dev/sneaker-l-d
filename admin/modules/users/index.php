<?php
  require_once __DIR__. "/../../autoload/autoload.php";
  //active navbar
  $currentPage = 'users'; // current page is about, do the same for other page

  $users = $db->fetchAll('user');
?>


<?php require_once __DIR__. "/../../layouts/header.php"; ?>
      <!-- CONTENT CHANGING HERE -->
      <div class="content">
        <div class="container-fluid">
        <?php if(isset($_SESSION['fail'])) :?>
        <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['fail'] ; unset($_SESSION['fail']); ?>
        </div>
        <?php endif ;?>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Users list</h4>
                  <div class="d-fex">
                   <a href="add.php" class="card-category">Add </a>
                  </div>
                  <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          ID
                        </th>
                        <th>
                          First Name
                        </th>
                        <th>
                          Last Name
                        </th>
                        <th>
                          Email
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                            <?php $stt = 1; foreach($users as $item) : ?>
                        <tr>
                            <td>
                                <?php echo $stt; ?>
                            </td>
                            <td>
                                <?php echo $item['first_name']; ?>
                            </td>
                            <td>
                                <?php echo $item['last_name']; ?>
                            </td>
                            <td>
                                <?php echo $item['email']; ?>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-fab btn-fab-mini btn-round" 
                                    href="delete.php?id=<?php echo $item['id']; ?>">
                                    <i class="material-icons">delete</i>
                                </a>
                                <a class="btn btn-primary btn-fab btn-fab-mini btn-round" 
                                    href="edit.php?id=<?php echo $item['id']; ?>">
                                    <i class="material-icons">create</i>
                                </a>
                                
                            </td>
                        </tr>
                            <?php $stt++ ;endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- CONTENT CHANGING END -->
<?php require_once __DIR__. "/../../layouts/footer.php"; ?>