<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand name-font" href="#">E_commerce</a>
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarTogglerDemo02"
      aria-controls="navbarTogglerDemo02"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item nav-mar cont_font">
          <a class="nav-link active" aria-current="page" href="productt.php">Product</a>
        </li>
        
        <?php
 require_once "connectdatabase.php";     
        
$get_category=$conn->prepare("SELECT * FROM category");

$get_category->execute();
        
foreach($get_category As $data){


echo '<li class="nav-item nav-mar cont_font">
          <a class="nav-link active" aria-current="page" href="productt.php?p_category='.$data["c_id"].'">'. $data["c_name"] . '</a>';}
          



 
        
  ?>      



    </div>
  </div>
</nav>