<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" >Shop Hoa</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/homes">TRANG CHỦ</a>
                </li>
                <li><a href="/flowers">GIỎ HOA</a>
                </li>
                <li><a href="/categories">DANH MỤC</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<div class="container">
	<p  id="error_message">
	<?php 
		if($error){
	?>
		<h5><span class="label label-danger"><?php echo $error;?></span><h5>
	<?php 
		}
	?>
	</p>
	
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading">Categories</div>
	
	  <!-- Table -->
	  <table class="table table-striped table-bordered table-condensed table-hover">
	  	<tr>
	  		<th>#</th>
	  		<th>Name</th>
	  		<th>Action</th>
	  	</tr>
		<?php 
			$i = 0;
			foreach($list as $item){
				$i++;
		?>
			<tr>
		  		<td><?php echo $i;?></td>
		  		<td><?php echo $item['Category']['name']?></td>
		  		<td>
		  			<a href="javascript:delete_category(<?php echo $item['Category']['id']?>)" >Delete</a>
		  		</td>
		  	</tr>
	  	<?php }?>
	  </table>
	</div>
	

		
		<div class="row">
		<h4 class="panel-heading">Add Category</h4>
		  <div class="col-md-6">
		  	<form role="form" action="/categories/add" method="post">
		  		<div class="input-group">
			      <input name="name" type="text" class="form-control" placeholder="Category name">
			      <span class="input-group-btn">
			        <button class="btn btn-primary" type="submit" >Save!</button>
			      </span>
			    </div><!-- /input-group -->
		  	</form>
		  </div><!-- /.col-md-6 -->
		</div>

	
	
</div>
<script type='text/javascript'>
	function delete_category(id) {
		  var answer = confirm("Có chắc bạn muốn xóa danh mục này?");
	    if (answer){
	    	$.ajax({
	    		  type: "POST",
	    		  url: "/categories/delete/"+id,
	    		  }).done(function( msg ) {
		    		  if(msg == "OK"){
		    			  location.reload();  
		    		  }
		    		  else{
			    		  $("#error_message").html("<h5><span class='label label-danger'>"+msg+"</span><h5>");
		    		  }
	    		  });
	    }
	}
</script>
    