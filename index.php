<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task App</title>
    <link href="https://bootswatch.com/5/lux/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">Tasks App</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" id="search" aria-label="Search">
                <button class="btn btn-outline-success" type="button">Search</button>
            </form>
        </div>
    </nav>

    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <form id="task-form">
                            <input type="hidden" id="task-id">
                            <div class="form-group p-2">
                                <input type="text" id="name" placeholder="Task Name" class="form-control">
                            </div>
                            <div class="form-group p-2">
                                <textarea id="description" cols="30" rows="10" placeholder="Task Description" class="form-control">
                                </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block text-center w-100" id="add-task">Save Task</button>
                            <div class="btn-container" id="edit-task" style="display: none">
                                <button type="button" class="btn btn-dark text-center" id="btn-cancel">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-block text-center" id="save-task-changes">Update Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-bordered table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody id="task-list-body"></tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/d426b639ac.js" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
</body>
</html>