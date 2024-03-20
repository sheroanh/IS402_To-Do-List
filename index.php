<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">My To-Do List</a>
    </div>
  </nav>
  <div class="container">
    <div class="row my-5">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <form id="form-Task" method="post">
              <div class="form-group">
                <input type="text" id="title" class="form-control" maxlength="50" autocomplete="off" placeholder="Title" name="title" required />
              </div>
              <div class="form-group">
                <textarea type="text" id="description" cols="30" rows="10" class="form-control" maxlength="50" autocomplete="off" placeholder="Description" name="description" required></textarea>
              </div>
              <button type="submit" name="submit" value="save" class="btn btn-success btn-block">
                Save
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="row">
          <div class="col-sm-3 text-left">
            <p class="font-weight-bold">Title</p>
          </div>
          <div class="col-sm-6 text-left">
            <p class="font-weight-bold">Description</p>
          </div>
          <div class="col-sm-3 text-right">
            <p class="font-weight-bold">Delete</p>
          </div>
        </div>
        <hr />
        <div id="tasks">
          <?php
          session_start();
          include "connect.php";
          $username = $_SESSION['username'];
          $sql = "SELECT * FROM TASK WHERE USERNAME='$username'";
          $result = $connect->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '
                    <div class="card mb-3">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-3 text-left">
                              <p>' . $row['title'] . '</p>
                            </div>
                            <div class="col-sm-7 text-left">
                              <p>' . $row['description'] . '</p>
                            </div>
                            <div class="col-sm-2 text-right">
                              <button onclick=deleteTask(' . "'" . $row['title'] . "'" . ') class="btn btn-danger ml-5">x</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      ';
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>

  <?php
  if($_SESSION['username'] == null)
  {
    header("location: signin.php");
    die;
  }
  if ((isset($_POST['submit']) && ($_POST['submit'] == 'save'))) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $sql = "INSERT INTO TASK VALUES('$title','$description','$username')";
    if ($connect->query($sql) == true) {
      header("Refresh: 0");
    }
    $connect->close();
  }
  ?>

  <script>
    function deleteTask(title)
    {
      $.get("deleteTask.php?title="+title, function(data, status){})
      location.reload()
    }
  </script>
</body>

</html>