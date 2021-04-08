<?php
  require_once __DIR__. "/../../autoload/autoload.php";
  //active navbar
  $currentPage = 'bills'; // current page is about, do the same for other page
  $id = intval(getInput('id'));
//   $sql = " SELECT bills.*, user.email as email FROM bills LEFT JOIN user ON user.id = bills.user_id ORDER BY ID DESC";
//   $bills = $db->fetchsql($sql); 
    $orders = $db->fetchID('orders',$id)           

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
                  <h4 class="card-title ">Orders list</h4>
                  <div class="d-fex">
                   <a href="" class="card-category">Show all bills order </a>
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
                          User's Email
                        </th>
                        <th >
                          Total Price
                        </th>
                        <th >
                          Checkout
                        </th>
                        <th >
                          Action
                        </th>
                      </thead>
                      <tbody>
                            <?php $stt = 1; foreach($bills as $item) : ?>
                        <tr>
                            <td>
                                <?php echo $stt; ?>
                            </td>
                            <td>
                                <?php echo $item['email']; ?>
                            </td>
                            <td class="text-primary">
                                <?php echo formatPrice($item['total_price']); ?> VND
                            </td>
                            <td>
                                <?php if($item['is_checkout'] == 1) :?>
                                <a class="btn btn-primary btn-fab btn-fab-mini btn-round" 
                                    href="is_checkout.php?id=<?php echo $item['id']; ?>">
                                         <i class="material-icons">check</i>
                                </a>
                                <?php else :?>
                                <a class="btn btn-primary btn-fab btn-fab-mini btn-round" 
                                    href="is_checkout.php?id=<?php echo $item['id']; ?>">
                                         <i class="material-icons">close</i>
                                </a>
                                <?php endif;?>
                            </td>
                            <td>
                              <a class="btn btn-primary btn-fab btn-fab-mini btn-round" 
                                  href="delete.php?id=<?php echo $item['id']; ?>">
                                  <i class="material-icons">delete</i>
                              </a>
                              <a class="btn btn-primary btn-fab btn-fab-mini btn-round" 
                                  href="view.php?id=<?php echo $item['id']; ?>">
                                  <i class="material-icons">visibility</i>
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