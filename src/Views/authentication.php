<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>To-Do List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
  <nav class="navbar navbar-dark bg-dark ">
    <div class="container d-flex justify-content-between">
      <a class="navbar-brand" href="/">To-Do List (Preview)</a>
    </div>
  </nav>
  <div class="mt-5 card" style="max-width: 480px; margin:auto">
    <div class="card-body p-5">
      <form style="max-width: 400px; margin: auto" method="post"
        action="<?php echo $action ? '/' . $action : "/signin" ?>">
        <h1>
          <?php echo $action == 'signin' ? "Sign In" : "Sign Up" ?>
        </h1>
        <div class="my-2">

          <label for="username" class="form-label">Username</label>
          <input class="form-control" id="username" name="username" placeholder="Enter username" required
            value="<?php echo $username ?>" />
        </div>
        <div class="my-2">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Enter password" required />
        </div>
        <div class="pt-2">
          <?php
          if (isset ($error)) {
            ?>
            <div class="alert alert-danger">
              <?php echo $error ?>
            </div>
            <?php
          } else if (isset ($info)) {
            ?>
              <div class="alert alert-info">
              <?php echo $info ?>
              </div>
            <?php
          } else if (isset ($success)) {
            ?>
                <div class="alert alert-info">
              <?php echo $success ?>
                </div>
            <?php
          }
          if ($action == 'signin') {
            ?>
            <input type="submit" value="Sign in" class="btn btn-primary">
            <a href="/signup" class="btn btn-secondary">Sign up</a>
            <?php
          } else {
            ?>
            <input type="submit" value="Sign up" class="btn btn-secondary">
            <a href="/signin" class="btn btn-primary">Sign in</a>
            <?php
          }
          ?>
        </div>
      </form>
    </div>
  </div>


</body>

</html>