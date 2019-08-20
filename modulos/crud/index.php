<!DOCTYPE html>
<html>
<head>
	<title>PHP Jquery Ajax CRUD Example</title>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
    <script src="/js/aplicacao/item-ajax.js"></script>
    
    
    	<script type="text/javascript">
    	 var url = "<?php echo URL_SISTEMA ?>";
        </script>
</head>
<body>


	<div class="container">
		<div class="row">
		    <div class="col-lg-12 margin-tb">					
		        <div class="pull-left">
		            <h2>PHP Jquery Ajax CRUD Example</h2>
		        </div>
		        <div class="pull-right">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
					  Create Item
				</button>
		        </div>
		    </div>
		</div>


		<table class="table table-bordered">
			<thead>
			    <tr>
				<th>Title</th>
				<th>Description</th>
				<th width="200px">Action</th>
			    </tr>
			</thead>
			<tbody>
			</tbody>
		</table>


		<ul id="pagination" class="pagination-sm"></ul>


	        <!-- Create Item Modal -->
		<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Create Item</h4>
		      </div>


		      <div class="modal-body">
		      		<form data-toggle="validator" action="api/create.php" method="POST">


		      			<div class="form-group">
							<label class="control-label" for="title">Title:</label>
							<input type="text" name="title" class="form-control" data-error="Please enter title." required />
							<div class="help-block with-errors"></div>
						</div>


						<div class="form-group">
							<label class="control-label" for="title">Description:</label>
							<textarea name="description" class="form-control" data-error="Please enter description." required></textarea>
							<div class="help-block with-errors"></div>
						</div>


						<div class="form-group">
							<button type="submit" class="btn crud-submit btn-success">Submit</button>
						</div>


		      		</form>


		      </div>
		    </div>


		  </div>
		</div>


		<!-- Edit Item Modal -->
		<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
		      </div>


		      <div class="modal-body">
		      		<form data-toggle="validator" action="api/update.php" method="put">
		      			<input type="hidden" name="id" class="edit-id">


		      			<div class="form-group">
							<label class="control-label" for="title">Title:</label>
							<input type="text" name="title" class="form-control" data-error="Please enter title." required />
							<div class="help-block with-errors"></div>
						</div>


						<div class="form-group">
							<label class="control-label" for="title">Description:</label>
							<textarea name="description" class="form-control" data-error="Please enter description." required></textarea>
							<div class="help-block with-errors"></div>
						</div>


						<div class="form-group">
							<button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
						</div>


		      		</form>


		      </div>
		    </div>
		  </div>
		</div>


	</div>
</body>
</html>