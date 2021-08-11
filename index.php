<?php

    $currentPage = 'home';

    require_once('./layout/header.php');
    require_once('./server/db.php');

    $flashMsg = false;

    function getFlashMessage($status, $message) {
        return array('status' => $status, 'message' => $message);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['editId'])) {
            $id = $_POST['editId'];
            $title = $_POST['titleEdit'];
            $description = $_POST['descriptionEdit'];
            $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$description', `updated_at` = current_timestamp() WHERE `notes`.id = $id";
            $result = mysqli_query($conn, $sql);
            $flashMsg = true;
            if ($result) {
                $msg = getFlashMessage('success', 'Note updated successfully!');
                header('refresh: 2; url=index.php');
            } else {
                $msg = getFlashMessage('danger', 'Note updating failed!');
                header('refresh: 2; url=index.php');
            }
        } else {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
            $result = mysqli_query($conn, $sql);
            $flashMsg = true;
            if ($result) {
                $msg = getFlashMessage('success', 'Note saved successfully!');
            } else {
                $msg = getFlashMessage('danger', 'Note saving failed!');
            }
        }

    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = "DELETE from `notes` WHERE `notes`.id = $id";
        $result = mysqli_query($conn, $sql);
        $flashMsg = true;
        if ($result) {
            $msg = getFlashMessage('success', 'Note deleted successfully!');
            header('refresh: 2; url=index.php');
        } else {
            $msg = getFlashMessage('danger', 'Note deleting failed!');
            header('refresh: 2; url=index.php');
        }
    }

    $sql = "SELECT * FROM notes ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);

?>

    <main class="container my-5 pb-4">

        <?php if ($flashMsg) { ?>
            <div class="alert alert-<?= $msg['status'] ?> alert-dismissible fade show text-center fw-bold mb-5" role="alert">
                <?= $msg['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <div class="card shadow-sm px-5 py-4 mt-4">
            <div class="border-bottom d-flex justify-content-between align-items-center mb-4 pb-3">
                <h4>My Note</h4>
                <button class="btn btn-dark js--btn-add px-4 py-2" data-bs-toggle="modal" data-bs-target="#addModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg> Add Note
                </button>
            </div>
            <div class="table-responsive">
                <table id="data-table" class="table table-hover text-center">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-start" scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created Date</th>
                            <th scope="col">Updated Date</th>
                            <th class="border-end" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <th class="border-start" scope="row"><?= $i++; ?></th>
                            <td><?= $row['title']; ?></td>
                            <td><?= $row['description']; ?></td>
                            <td><?= date("dS M, Y", strtotime($row['created_at'])) ?></td>
                            <td><?= date("dS M, Y", strtotime($row['updated_at'])) ?></td>
                            <td class="border-end">
                                <button data-id="<?= $row['id'] ?>" class="btn btn-primary btn-sm js--btn-edit" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </button>
                                <button data-id="<?= $row['id'] ?>" class="btn btn-danger btn-sm js--btn-delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- Popup Modal For Add Note  -->
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= htmlentities($_SERVER['PHP_SELF']) ?>" method="post" class="js--form-note">
                        <div class="mb-3 form-group">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" data-name="Title" class="form-control" />
                            <span class="text-danger small"></span>
                        </div>
                        <div class="mb-4 form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea rows="4" name="description" data-name="Description" class="form-control"></textarea>
                            <span class="text-danger small"></span>
                        </div>
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-info w-100 fw-bold py-2">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup Modal For Edit Note  -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= htmlentities($_SERVER['PHP_SELF']) ?>?update=true" method="post" class="js--form-note">
                        <div class="mb-3 form-group">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="titleEdit" data-name="Title" class="form-control" />
                            <span class="text-danger small"></span>
                        </div>
                        <div class="mb-4 form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea rows="4" name="descriptionEdit" data-name="Description" class="form-control"></textarea>
                            <span class="text-danger small"></span>
                        </div>
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-info w-100 fw-bold py-2">Submit</button>
                        </div>
                        <input type="hidden" name="editId" id="js--edit-id" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php include_once './layout/footer.php' ?>