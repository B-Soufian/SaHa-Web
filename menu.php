<?php
    session_start();
    include 'includes/functions.php';
    
    
    try{
         
        // $conn = new PDO("mysql:host=localhost;port=3308;dbname=maroccan", "root", "");
        // $search = $_GET['search'] ?? '';
        // $category = $_GET['category'] ?? '';
        // $req = "select * from products WHERE 1";
        // if (!empty($search)) {
        //     $req .= " AND name LIKE :search";
        // }
        // if (!empty($category)) {
        //     $req .= " AND category = :category";
        // }
        // $op = $conn->prepare($req);
        // if (!empty($search)) {
        //     $op->bindValue(':search', '%' . $search . '%');
        // }
        // if (!empty($category)) {
        //     $op->bindValue(':category', $category);
        // }
        // $op->execute();
        // $products=$op->fetchAll(PDO::FETCH_OBJ);


        $conn = coonect(); 
        $search = $_GET['search'] ?? '';
        $category = $_GET['category'] ?? '';
        
        $perPage = 12;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $perPage;
        $req = "SELECT * FROM products WHERE 1 ";
        if (!empty($search)) {
            $req .= " AND name LIKE :search";
        }
        if (!empty($category)) {
            $req .= " AND category = :category";
        }
        $req .= " LIMIT :limit OFFSET :offset";

        $stmt = $conn->prepare($req);

        if (!empty($search)) {
            $stmt->bindValue(':search', '%' . $search . '%');
        }
        if (!empty($category)) {
            $stmt->bindValue(':category', $category);
        }

        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_OBJ);

        $countStmt = $conn->query("SELECT COUNT(*) as total FROM products");
        $tot = $countStmt->fetch(PDO::FETCH_OBJ);
        $total = $tot->total;
        $totalPages = ceil($total / $perPage);
    }
    catch(PDOException $e){
        echo "Problème de connexion ".$e->getMessage();
    } 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaHa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/duotone.css"/>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/brands.css"/>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  
    <?php include 'includes/header.php'; ?>

    <section id="Menu">
        <div class="container">
            <h1 class="pop h1 text-center my-5 fw-bold">Menu</h1>
            <div class="sear pop ">
                <form method="GET" class="search d-flex gap-3 mb-3 flex-wrap ">
                    <div class="flex-grow-1 d-flex align-items-center gap-1">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input  type="search" placeholder="Search" name="search" id="menu_srach">
                    </div>
                    <select class="form-select" name="category" style="width: 10rem;" >
                            <option value="">All Categories</option>
                        <option value="Salads">Salads</option>
                        <option value="Main Courses">Main Courses</option>
                        <option value="Moroccan Desserts">Moroccan Desserts</option>
                        <option value="Beverages">Beverages</option>
                    </select>
                    <button type="submit" class="btn btn-success">Filter</button>
                </form>
            </div>

            <div class="row d-flex align-items-center justify-content-center mt-5">
                <?php foreach($products as $prd){?>
                <div class="shows col-md-3 my-2">
                    <div class="card ">
                        <img src="<?php echo $prd->image;?>" class="card-img-top object-fit-cover" alt="food" loading="lazy">
                        <div class="card-body ">
                            <h5 class="card-title"><?php echo $prd->name;?></h5>
                            <p class="card-text fw-bold text-success fs-4 mb-2"><?php echo $prd->price;?>$</p>
                            <a href="add_product.php?id=<?php echo $prd->id?>" class="btn btn-success">Add To Cart</a>
                        </div>
                    </div>
                </div>
                <?php };?>
            </div>

            <nav>
              <ul class="pagination justify-content-center mt-3">
                <li class="page-item">
                  <a class="page-link text-success" href="?page=1" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++){ ?>
                <li class="page-item"><a class="page-link text-success" href="?page=<?php echo $i ?>" ><?= $i ?></a></li>
                <?php }?>
                <li class="page-item text-success">
                  <a class="page-link text-success" href="?page=<?php echo $totalPages ?>" >
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
        </div>

    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>