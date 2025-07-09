<?php
include '../includes/functions.php';
session_start();
  check_admin();
        $conn = coonect();  
        // echo"hello";
        $search = $_GET['search'] ?? '';
        $category = $_GET['category'] ?? '';
        $req = "select * from products WHERE 1 ";
        if (!empty($search)) {
            $req .= " AND name LIKE :search";
        }
        if (!empty($category)) {
            $req .= " AND category = :category";
        }
        $req .=" order by price desc";
        $op = $conn->prepare($req);
        if (!empty($search)) {
            $op->bindValue(':search', '%' . $search . '%');
        }
        if (!empty($category)) {
            $op->bindValue(':category', $category);
        }
        $op->execute();
        $products=$op->fetchAll(PDO::FETCH_OBJ);
    
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
<body>
    <div >
        <div class="d-flex ">
             <?php include '../includes/sidebar.php'; ?>
            <div class="content p-4 ms-auto">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Product Management</h3>
                    <button class="btn btn-primary add">+ Add New Product</button>
                </div>
                <form method="GET" class="d-flex gap-3 mb-3">
                    <select class="form-select w-auto" name="category">
                        <option value="">All Categories</option>
                        <option value="Salads">Salads</option>
                        <option value="Main Courses">Main Courses</option>
                        <option value="Moroccan Desserts">Moroccan Desserts</option>
                        <option value="Beverages">Beverages</option>
                    </select>
                    <input type="text" class="form-control" name="search" placeholder="Search for a product...">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
                <div class="">
                    <table class="table table-hover align-middle table-responsive">
                        <thead class="table-light">
                            <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $prd){ ?>
                            <tr>
                                <td>
                                    <img src="<?php echo $prd->image?>" class="product-img me-2" loading="lazy" />
                                    <?php echo $prd->name?>
                                </td>
                                <td><?php echo $prd->category?></td>
                                <td><?php echo $prd->price?></td>
                                <td><span class="badge bg-success"><?php echo $prd->quantity?> Available</span></td>
                                <td><span class="badge bg-success">Active <i class="fa-regular fa-eye"></i></span></td>
                                <td class="text-center featur" data-id="<?php echo $prd->id?>"><i class=" fa-star <?php echo ($prd->is_featured == 0) ?  'fa-light':  'fa-solid';?>"> </i></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary edit-btn"
                                    data-id="<?php echo $prd->id?>"
                                    data-name="<?php echo $prd->name?>"
                                    data-price="<?php echo $prd->price?>"
                                    data-category="<?php echo $prd->category?>"
                                    data-stock="<?php echo $prd->quantity?>"
                                    data-image="<?php echo $prd->image?>"
                                    >
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cet élément ?');" href="deleteprdt.php?id=<?php echo $prd->id?>"><i class="fa-regular fa-trash-can"></i></a>
                                </td>
                            </tr>
                            <?php }?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="addproduct d-none">
            <div class="modal-overlay position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex justify-content-center align-items-center" style="z-index:1050;"">
            <div class="modal-content bg-white p-4 rounded shadow" style="width: 400px;">
                <div class="modal-header">
                    <h5 class="modal-title">Product</h5>
                    <button type="button" class="btn-close closeModal"></button>
                </div>
                <div class="modal-body">
                <form method="post" action="manag_prudct.php">
                    <input type="hidden" id="productId" name="id">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Product Name *</label>
                            <input type="text" class="form-control" id="productName" name="name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price (SAR) *</label>
                            <input type="number" class="form-control" id="productPrice" name="price">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Available Quantity *</label>
                            <input type="number" value="0" class="form-control" name="quantity" id="productStock">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category *</label>
                            <select class="form-select" id="productCategory" name="category">
                                <option>Salads</option>
                                <option>Main Courses</option>
                                <option>Moroccan Desserts</option>
                                <option>Beverages</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                    <label class="form-label">Product Image *</label>
                    <input type="text" class="form-control" id="productImg" name="image">
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary" id="actn" name="save">Save</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
  const openModalBtn = document.querySelector('.add')
  const modalDiv = document.querySelector('.addproduct')
  const closeModalBtn = document.querySelector('.closeModal')
  

  openModalBtn.addEventListener('click', () => {
    modalDiv.classList.remove('d-none')
    document.querySelector('#actn').name = "save"
  })

  closeModalBtn.addEventListener('click', () => {
    modalDiv.classList.add('d-none')
  })

  document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      const id = this.dataset.id
      const name = this.dataset.name
      const price = this.dataset.price
      const category = this.dataset.category
      const stock = this.dataset.stock
      const image = this.dataset.image

      
      document.querySelector('#actn').name = "edite"
      
      document.querySelector('#productId').value = id
      document.querySelector('#productName').value = name
      document.querySelector('#productPrice').value = price
      document.querySelector('#productCategory').value = category
      document.querySelector('#productStock').value = stock
      document.querySelector('#productImg').value = image
      
      modalDiv.classList.remove('d-none')
      
    });
  });

   document.querySelectorAll('.featur').forEach(star =>{
    star.addEventListener('click',function (){
        const icon = $(this).find('i')
        const isSelected = icon.hasClass('fa-solid')
        const selectedCount = $('.featur .fa-solid').length
        const productId = $(this).data('id')

        if (isSelected || selectedCount < 3) {
            icon.toggleClass('fa-light fa-solid')
            const is_featured = icon.hasClass('fa-solid') ? 1 : 0
            $.ajax({
                url: 'update_feature.php',
                type: 'POST',
                data: {
                    id: productId,
                    featured: is_featured
                },
                success: function (response) {
                    console.log(response)
                },
                error: function () {
                    console.log('err')
                }
            })
        }
    })
  })
  const hide = ()=>{
    document.querySelector(".sidebar").classList.toggle('show');
  }
</script>
</html>
