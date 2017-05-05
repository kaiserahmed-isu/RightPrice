<!DOCTYPE html>
<html lang="en">
<head>
  <title>RightPrice - Price Comparison and Affiliation Engine</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>RightPrice</h1>
  <p>Price Comparison and Affiliation Engine</p>
</div>

<div class="container">

  <div class="row">
      {!! Form::open(array('url' => 'amazon', 'method' => 'post', 'class' => 'form-inline')) !!}
    <div class="col-md-10 col-md-push-2">
      <div class="form-group">
        <input type="text" id="term" name="term" style ="width:500px" class="form-control input-lg" placeholder="What product do you want to compare?" >
      </div>
      <div class="form-group">
       <select name="cat" class="form-control input-lg" id="cat" required>
         <option value="">Select category</option>
         <option value="Automotive">Automotive</option>
         <option value="Baby">Baby Products</option>
         <option value="Beauty">Beauty</option>
         <option value="Books">Books</option>
         <option value="DVD">DVD</option>
         <option value="Electronics">Electronics</option>
         <option value="Software">Software</option>
       </select>
      </div>
      <div class="form-group">
  			<button class="btn btn-success btn-lg">Search</button>
  		</div>
    </div>


{!! Form::close() !!}
</div>

<div class="row" style="margin-top: 150px;">
          <div class="col-md-12 text-center">
          <hr>
            <p>&copy; 2017 - Md Kaiser Ahmed | Built with Bootstrap 3 and Laravel 5.3</p>
          </div>
</div>
</div>

</body>
</html>
