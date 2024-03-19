<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">My To-Do List</a>
    </div>
  </nav>
  <div class="mt-5 card" style="max-width: 480px; margin:auto">
    <div class="card-body">
      <form style="max-width: 400px; margin: auto" method="post" action="register.php">
        <div class="">
          <h1>Sign up</h1>
          <label for="username" class="form-label">Username</label>
          <input class="form-control" id="username" name="username" placeholder="Enter username" required />
        </div>
        <div class="">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Enter password" required />
        </div>
        <input type="submit" name="signup" value="Sign up" class="btn btn-primary mt-3">
        <input type="submit" name="signin" value="Sign in" class="btn btn-success mt-3">
      </form>
    </div>
  </div>
  
</body>
</html>