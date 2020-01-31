<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
	<?php include 'includes/navbar.php'; ?>
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-12">
				<?php
		       			
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
							$stmt = $conn->prepare("SELECT * FROM products");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-3'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'><a href='product.php?product=".$row['slug']."'>
		       									<img  src='".$image."' width='100%' height='230px' class='thumbnail'></a>
												   <h3><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h3>
												   <b><span class='pricetag'>Rs. ".number_format($row['price'], 2)."</span></b>
		       								</div><a class='buylink' href='product.php?product=".$row['slug']."'>
		       								<div class='box-footer'>
		       									Buy Now
		       								</div></a>
	       								</div>
	       							</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>