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
	        	<div class="col-sm-9">
	        		<h1 class="page-header">YOUR CART</h1>
	        		<div class="box box-solid">
	        			<div class="box-body">
		        		<table class="table table-bordered">
		        			<thead>
		        				<th></th>
		        				<th>Photo</th>
		        				<th>Name</th>
		        				<th>Price</th>
		        				<th width="20%">Quantity</th>
		        				<th>Subtotal</th>
		        			</thead>
		        			<tbody id="tbody">
		        			</tbody>
		        		</table>
	        			</div>
	        		</div>
	        		<?php
	        			if(isset($_SESSION['user'])){
	        				echo "
	        					
<button class='btn btn-sm btn-flat btn-info transact mybutton'>Buy Now</button>
	        				";
	        			}
	        			else{
	        				echo "
	        					<h4>You need to <a href='login.php'>Login</a> to checkout.</h4>
	        				";
	        			}
	        		?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script type="text/javascript" src="extradata/js/jquery.classyqr.js"></script>
<script>
var total = 0;
var t = Math.floor(Math.random() * 10000) + 1;
$(function(){
	$(document).on('click', '.cart_delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'cart_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		qty++;
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});
	getDetails();
	getTotal();

});

function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'cart_details.php',
		dataType: 'json',
		success: function(response){
			$('#tbody').html(response);
			getCart();
		}
	});
}



function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'cart_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
		}
	});
}
function hello(){
	
	$.ajax({
		type: 'POST',
		url: 'cart_extra.php',
		dataType: 'json',
		success: function(response){
			
			myResponse = response;
			obj = JSON.parse(myResponse);
			
			done();
		}
	});
}
function done(){
	var dataPost = {
  			"Productname": obj.Productname,
                               "price": obj.price,
                               "quantity": obj.quantity,
                               "Buyername": "<?php echo $user['firstname'].' '.$user['lastname'];?>",
                               "TransactionId":t
                };
				
						var dataString = JSON.stringify(dataPost);
						console.log(dataString);
                        $.ajax({
                           url: 'Addingit.php',
                           data: {myData: dataString},
                           type: 'POST',
                           success: function(response) {
							myResponse=response;
                           }
						});tosaveqrcode();
						

}




function tosaveqrcode(){
	$data = "<?php echo $user['firstname'].' '.$user['lastname'];?>";

	$.ajax({
		type: 'POST',
		url: 'saveqr.php',
		data: {productname:obj.Productname,price:obj.price,quantity:obj.quantity,buyername:$data,trans:t},
		success: function(response){
		}
	});
}

$(".mybutton").click(function(e){

hello();
window.location = 'sales.php?pay='+t;
      

                    
});
</script>
<div class="qrcode" id="qr">
</div>
</body>
</html>