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
                <div class="col-sm-6"><h2>Search Using Transaction Number</h2><br>

<input type="text" id='id' name="Transaction Number" />
<button type="button" class="button" onclick="getDetails()">Find Details</button>
<br><div id="tbody" class="box box-solid">
</div></div>
<div class="col-sm-6"><h2>Search Using Product Name</h2><br>

                        <input type="text" id='id1' name="Product Name" />
                    <button type="button" class="button" onclick="getDetails1()">Find Details</button>
					<br><div id="tbody1" class="box box-solid">
                </div></div>
            </div>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>
<script>
function getDetails(){
	$.ajax({
		type: 'GET',
		url: 'trackdetails.php',
		data: {
				id: $("#id").val(),
			},
		success: function(response){
			$('#tbody').html(response);
		}
	});
}
function getDetails1(){
	$.ajax({
		type: 'GET',
		url: 'trackdetails1.php',
		data: {
				id: $("#id1").val(),
			},
		success: function(response){
			$('#tbody1').html(response);
		}
	});
}
</script>
<style>
	#tbody,#tbody1{margin-top:50px;}
	</style>
<?php include 'includes/scripts.php'; ?>
</body>
</html>