<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <?php
    require('reusables/connect.php');
    // require('reusables/functions.php');
    $productLine = $_GET['productLine'];
    echo '<title>' . htmlspecialchars($productLine) . '</title>'
    ?>
  
  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="reusables/css/styles.css">
  <link rel="stylesheet" href="reusables/style.css">
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <?php require('reusables/nav.php') ?>
      </div>
    </div>
  </div>
  <?php
    echo "<h1 class='my-4 text-center'>" . htmlspecialchars($productLine) . "</h1>";

    $query = "SELECT * FROM products WHERE productLine = '$productLine'";
    $products = mysqli_query($connect, $query);
    echo '<div class="row mb-3">';
      if ($productLine == "Classic Cars") {
        echo '<img src="https://images.unsplash.com/photo-1515281239448-2abe329fe5e5?q=80&w=1193&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">';
      } elseif ($productLine == "Motorcycles") {
        echo '<img src="https://images.unsplash.com/photo-1479909013849-e16a7dd14323?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">';
      } elseif ($productLine == "Planes") {
        echo '<img src="https://images.unsplash.com/photo-1702243080294-27e09e892995?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">';
      } elseif ($productLine == "Ships") {
        echo '<img src="https://images.unsplash.com/photo-1466188635785-8b5f35009981?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">';
      } elseif ($productLine == "Trains") {
        echo '<img src="https://images.unsplash.com/photo-1631819441984-f57278471d7f?q=80&w=1160&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">';
      } elseif ($productLine == "Trucks and Buses") {
        echo '<img src="https://images.unsplash.com/photo-1532151581482-2ff889458a5e?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">';
      } elseif ($productLine == "Vintage Cars") {
        echo '<img src="https://images.unsplash.com/photo-1534325206648-bb8fa5dba108?q=80&w=1174&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">';
      };
    echo '</div>';
      // https://unsplash.com/photos/die-cast-car-collection-on-rack-JBrfoV-BZts <- Cars
      // https://unsplash.com/photos/close-up-photo-of-harley-davidson-touring-motorcycle-MfkYKk07lnE <- Motorcycles
      // https://unsplash.com/photos/a-garage-filled-with-lots-of-clutter-and-tools-Cw_MTo3o4hs <- Planes
      // https://unsplash.com/photos/black-brown-and-white-galleon-ship-scale-model-on-brown-wooden-shelf-05nD5VT-714 <- Ships
      // https://unsplash.com/photos/a-toy-train-is-sitting-on-the-tracks-uZ03bUfmhGU <- trains
      // https://unsplash.com/photos/gray-truck-toy-with-brown-wooden-frame-on-wall-jW43ulaCnok <- trucks
      // https://unsplash.com/photos/selective-focus-photography-of-classic-brown-coupe-die-cast-model-on-gray-ground-Ug2XO67KVYQ <- vintage car
    echo '<div class= "row">';
    foreach($products as $product){
      echo 
      '<div class="col-md-4 mb-2">
        <div class="card mb-2">
          <div class="card-body">
              <h5 class="card-title">' . $product['productName'] . '</h5>
              <p class="card-text">Vendor: ' . $product['productVendor'] . '</p>
              <p class="card-text">Stock Quantity: ' . $product['quantityInStock'] . ' units</p>
              <p class="card-text">Price: $' . $product['buyPrice'] . '</p>
              <p class="card-text">MSRP: $' . $product['MSRP'] . '</p>
          </div>';
      
          if (isset($_SESSION['admin'])) {
            echo'
            <div class="card-footer">
              <div class="row">
                <div class="col">        
                    <form method="GET" action="updateProduct.php">
                      <input type="hidden" name="productCode" value="' . $product['productCode'] . '">
                      <input type="hidden" name="productLine" value="' . $product['productLine'] . '">
                      <button class="btn btn-sm btn-primary">Update</button>
                    </form>
                </div>
                <div class="col">
                    <form method="GET" action="deleteProduct.php">
                      <input type="hidden" name="productCode" value="' . $product['productCode'] . '">
                      <input type="hidden" name="productLine" value="' . $product['productLine'] . '">
                      <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
              </div>
            </div>
        </div>
      </div>';
        } else {
          echo '<div class="card-footer">
                      <div class="row">
                        <div class="col">        
                            <form method="GET" action="productDetails.php">
                              <input type="hidden" name="productCode" value="' . $product['productCode'] . '">
                              <input type="hidden" name="productLine" value="' . $product['productLine'] . '">
                              <button class="btn btn-sm btn-primary">Details</button>
                            </form>
                        </div>
                </div>
              </div> 
            </div>
          </div>';
        };
    };
  ?>
      </div>
    </div>
  </body>
  </html>