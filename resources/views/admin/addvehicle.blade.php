<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Vehicle</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4" style="margin-top: 20px">
            <h1>Add Vehicle To Company Fleet</h1>
            <hr>
            <form action="{{route('submit-registration')}}" method="post">
                @if (Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if (Session::has('fail'))
                <div class="alert alert-success">{{Session::get('fail')}}</div>
                @endif
                @csrf
                <div class="form-group">
                    <label for="make">Vehical Make</label>
                    <input type="text" class="form-control" placeholder="Enter Vehicle Model" name="make">
                    <span class="text-danger">@error('make') {{$message}} @enderror</span>
                </div>
                <div class="form-group">
                    <label for="model">Vehicle Model</label>
                    <input type="text" class="form-control" placeholder="Enter Vehicle Model" name="model">
                    <span class="text-danger">@error('model') {{$message}} @enderror</span>
                </div>
                <div class="form-group">
                    <label for="year">Vehicle year</label>
                    <input type="number" class="form-control" placeholder="Enter Vehicle Year" name="year">
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                </div>                
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" placeholder="Enter Phone" name="phone">
                    <span class="text-danger">@error('phone') {{$message}} @enderror</span>
                </div>                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                    <span class="text-danger">@error('password') {{$message}} @enderror</span>
                </div>                
                <div class="form-group" style="margin-top: 10px">
                    <button class="btn btn-block btn-primary" type="submit">Register</button>
                </div>
                Already Registered? <a href="/login">Login here</a>
            </form>
        </div>
      </div>
    </div>
  </body>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</html>
