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
  <h2>Best products from Amazon</h2>

  <div class="panel-heading">
          <div class="row">
            <div class="col col-xs-6">
              <h3 class="panel-title"></h3>
            </div>
            <div class="col col-xs-6 text-right">

              <a class="btn btn-sm btn-danger" href="javascript: history.go(-1)">Search Again</a>

            </div>
          </div>
    </div>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Title</th>
        <th>Image</th>
        <th>Price</th>
        <th>Buy Now</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($output["items"] as $item)
      {!! Form::open(['url' => 'compare']) !!}
        <input type="hidden" name="title" value="{{ $item["title"] }}">
          <tr>
            <td>{{ $item["title"] }} ...<br/> {!!  $item["review"] !!}</td>
            <td><img src="{{ $item["img"] }}" alt="img" width="100"/></td>
            <td>{{ $item["price"] }}</td>
            <td><a target ="_blank"  class="btn btn-warning" href="{{ $item["url"] }}">Buy Now</a> <br> <br><button class="btn btn-success">Compare with Ebay</button></td>
          </tr>
      </form>
      @endforeach


    </tbody>
  </table>

  <div class="row">
    				<div class="col-md-12 text-center">
    				<hr>
    				  <p>&copy; 2017 - Md Kaiser Ahmed | Built with Bootstrap 3 and Laravel 5.3</p>
    				</div>
  </div>
</div>

</body>
</html>
