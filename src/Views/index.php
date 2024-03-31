<?php
function renderTask($data)
{
  ?>
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h6 class="m-0">
        <?php echo 'ID: ' . $data['id'] ?><br />
        <span class="mt-1 badge  <?php echo $data["is_done"] ? "text-bg-success" : "text-bg-warning" ?>">
          <?php echo $data["is_done"] ? "Done" : "In progress" ?>
        </span>
      </h6>
      <form method="post" action="/">
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />
        <input type="hidden" name="is_done" value="<?php echo $data['is_done'] == 0 ? 1 : 0 ?>" />
        <button type="submit" class="btn btn-sm <?php echo $data["is_done"] ? "btn-secondary" : "btn-success" ?> mr-1">
          <?php echo $data['is_done'] ? 'Mark as undone' : 'Mark as done' ?>
        </button>
      </form>
    </div>
    <div class="card-body">
      <h5 class="card-title">
        <?php echo $data['title'] ?>
      </h5>
      <p class="card-text">
        <?php echo $data['description'] ?>
        <br />
      </p>
      <div class="d-flex justify-content-between gap-2 align-items-end">
        <form method="post" action="/">
          <input type="hidden" name="action" value="destroy" />
          <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />
          <button type="submit" class="btn btn-sm btn-danger">
            Delete
          </button>
        </form>
        <p class="m-0 fs-6">
          <i class="bi bi-clock"></i>
          <?php echo $data['created_at'] ?>
          <br />
          <i class="bi bi-pencil-square"></i>
          <?php echo $data['updated_at'] ?? "No updates" ?>
        </p>
      </div>
    </div>
  </div>
  <?php
}
?>
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
      <a class="navbar-brand" href="/">To-Do List (Preview)</a><a href="/logout" class="btn btn-danger">Logout</a>
    </div>
  </nav>
  <div class="container my-3">
    <?php
    if (isset ($error)) {
      ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $error ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php
    }
    if (isset ($success)) {
      ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $success ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php
    }
    ?>
    <div class="row">
      <div class="col-md-4 my-1">
        <div class="card border border-0">
          <h4 class="card-header bg-transparent">New Task</h4>
          <div class="card-body">
            <form id="form-task" method="post" action="/">
              <input type="hidden" name="action" value="store" />
              <div class="form-group my-2">
                <input type="text" id="title" class="form-control" maxlength="50" autocomplete="off" placeholder="Title"
                  name="title" required />
              </div>
              <div class="form-group my-2">
                <textarea type="text" id="description" cols="30" rows="10" class="form-control" maxlength="50"
                  autocomplete="off" placeholder="Description" name="description" required></textarea>
              </div>
              <input type="submit" name="submit" value="Save" class="btn btn-success btn-block float-end" />
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-8 my-1">
        <div class="card border border-0">
          <h4 class="card-header bg-transparent">All tasks
            <span class="badge bg-primary rounded-pill fs-6 py-1">
              <?php echo count($tasks) ?>
            </span>
          </h4>
          <div class="card-body">
            <?php
            if (empty ($tasks)) {
              ?>
              <div class="alert alert-info" role="alert">
                No tasks found
              </div>
              <?php
            }
            foreach ($tasks as $task) {
              renderTask($task);
            }
            ?>
          </div>
        </div>
      </div>
    </div>
</body>

</html>