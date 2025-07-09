<?php 
include '../includes/functions.php';
session_start();
check_admin();
        $conn = coonect();  
        $req = "select *, CONCAT(first_name,' ', last_name) AS username from users WHERE 1 ";
        $search = $_GET['search'] ?? '';
        $role = $_GET['rolesearch'] ?? '';
        $statu = $_GET['statusearch'] ?? '';
        if (!empty($search)) {
            $req .= " AND CONCAT(first_name,' ', last_name) LIKE :search";
        }
        if (!empty($role)) {
            $req .= " AND role = :role";
        }
        if (!empty($statu)) {
            $req .= " AND statu = :statu";
        }
        $req .=" order by id desc";
        $op = $conn->prepare($req);
        if (!empty($search)) {
            $op->bindValue(':search', '%' . $search . '%');
        }
        if (!empty($statu)) {
            $op->bindValue(':statu', $statu);
        }
        if (!empty($role)) {
            $op->bindValue(':role', $role);
        }
        $op->execute();
        $useres = $op->fetchAll(PDO::FETCH_OBJ);
   
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
</head>
<body >
    <div class="d-flex ">
         <?php include '../includes/sidebar.php'; ?>
        <div class="content p-4 ms-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Users Management</h3>
            </div>

            <form action="">
                    <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="search" name="search" class="form-control" placeholder="Search user...">
                    </div>
                    <div class="col-md-2">
                    <select class="form-select" name="statusearch">
                        <option value="">All Statuses</option>
                        <option value="Active">Active</option>
                        <option value="banned">Banned</option>
                    </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" name="rolesearch">
                            <option value="">All Roles</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>

                </form>

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($useres as $user){ ?>
                    <tr>
                        <td>
                            <strong><?php echo $user->username ?></strong><br>
                            <small><?php echo $user->email ?></small>
                        </td>
                        <td><?php echo $user->role ?></td>
                        <td><span class="<?php echo $user->statu ?>"><?php echo $user->statu ?></span></td>
                        <td><?php echo $user->address ?></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary edit-btn"
                            data-id="<?php echo $user->id ?>"
                            data-name="<?php echo $user->username ?>"
                            data-email="<?php echo $user->email ?>"
                            data-role="<?php echo $user->role ?>"
                            data-state="<?php echo $user->statu ?>"
                            >
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <a onclick="return confirm('Supprimer cet élément ?')" class="btn btn-sm btn-outline-danger" href="deleteuser.php?id=<?php echo $user->id?>"><i class="fa-regular fa-trash-can color-danger"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                   
                </tbody>
            </table>
        </div>
    </div>
    <div class="adduser d-none">
        <div class="modal-overlay position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex justify-content-center align-items-center" style="z-index:1050;">
            <div class="modal-content bg-white p-4 rounded shadow" style="width: 400px;">
                <div class="modal-header">
                    <h5 class="modal-title">User</h5>
                    <button type="button" class="btn-close closeModal"></button>
                </div>
                <div class="modal-body">
                <form method="post" action="manage_user.php">
                    <input type="hidden" id="productId" name="id">

                    <div class="mb-3">
                        <label class="form-label">Full Name *</label>
                        <input type="text" class="form-control" name="name" id="name" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="emial" class="form-control" name="email" id="email" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Role *</label>
                        <select class="form-select" name="role" id="role">
                            <option >admin</option>
                            <option>user</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">State *</label>
                        <select class="form-select" name="statu" id="statu">
                            <option >Active</option>
                            <option>banned</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary" id="actn" name="edite">Edite</button>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
  const modalDiv = document.querySelector('.adduser')
  const closeModalBtn = document.querySelector('.closeModal')

  closeModalBtn.addEventListener('click', () => {
    modalDiv.classList.add('d-none')
  });

  document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function () {
    const id = this.dataset.id
    const name = this.dataset.name
    const email = this.dataset.email
    const role = this.dataset.role
    const state = this.dataset.state

      document.querySelector('#productId').value = id
      document.querySelector('#name').value = name
      document.querySelector('#email').value = email
      document.querySelector('#role').value = role
      document.querySelector('#statu').value = state

      modalDiv.classList.remove('d-none')
    })
  })
  const hide = ()=>{
    document.querySelector(".sidebar").classList.toggle('show');
  }
</script>
</html>