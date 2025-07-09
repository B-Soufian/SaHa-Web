<?php
include '../includes/functions.php';
session_start();
  check_admin();
        $conn = coonect();  
        $req = "SELECT o.*,  CONCAT(u.first_name,' ', u.last_name) AS username FROM orders o 
                       JOIN users u ON o.user_id = u.id 
                       order by created_at desc";
        $op = $conn->prepare($req);
        $op->execute();
        $orders = $op->fetchAll(PDO::FETCH_OBJ);
        if(isset($_GET["edite"])){
            $id = $_GET["order_id"];
            $stau = $_GET["statu"];
            $req ="UPDATE orders SET status = :status WHERE id = :id";
            $op = $conn->prepare($req);
            $op->execute([':status' => $stau,
            ':id' => $id]);
            header("location:orders.php");
        }

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaHA Dashbord</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/duotone.css"/>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/brands.css"/>
    <link rel="stylesheet" href="../css/adminstyle.css">
</head>
<body >
    <div class="d-flex">
         <?php include '../includes/sidebar.php'; ?>
        <div class="content p-4 ms-auto">
            <div class="flex-grow-1 p-4">
                <h3>Order Management</h3>
                <div class="d-flex my-3">
                    <input type="text" class="form-control me-2" placeholder="Search orders...">
                    <button class="btn btn-outline-secondary">All</button>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle orders">
                        <thead class="table-light">
                            <tr>
                                <th>ORDER ID</th>
                                <th>CUSTOMER</th>
                                <th>TOTAL</th>
                                <th>STATUS</th>
                                <th>DATE</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $ord){ ?>
                            <tr>
                                <td><strong>ORD-<?php echo $ord->id; ?></strong></td>
                                <td><?php echo $ord->username ; ?></td>
                                <td><strong><?php echo $ord->price; ?></strong></td>
                                <td>
                                    <span class="badge status-badge <?php echo $ord->status; ?>">
                                    </i> <?php echo $ord->status; ?>
                                    </span>
                                </td>
                                <td><?php echo $ord->created_at; ?></td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm me-1 show-details" data-id="<?php echo $ord->id;?>"><i class="fa-regular fa-eye"></i></button>
                                </td>
                            </tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class=" d-none" id="modal">
        <div class="modal-overlay position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex justify-content-center align-items-center" style="z-index:1050;">
            <div class="order-box" id="modal-content">
               
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
  $('.show-details').click(function () {
    let orderId = $(this).data('id')
    $.ajax({
      url: 'get_order.php',
      type: 'GET',
      data: { order_id: orderId },
      success: function (response) {
        $('#modal-content').html(response)
        
        $('#modal').removeClass('d-none').fadeIn()

        $('#statu').change(function() {
            let selected = $(this).val()
            $('#statures').html("<strong>Status: </strong>" + selected)
            $('#statinput').val(selected)
        })

      },
      error: function () {
        $('#modal-content').html('<p>ERR /p>')
        $('#modal').removeClass('d-none').fadeIn()
      }
    })
})

  $(document).on('click', '.closeModal', function () {
    $('#modal').fadeOut()
  })
  
})
    const hide = ()=>{
    document.querySelector(".sidebar").classList.toggle('show');
  }
</script>
</html>