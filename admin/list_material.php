<?php
    include 'includes/header.php';
    if ($_GET['action'] == 'delete') {
    $id = $_GET['id'];
    
    $con->query("Delete from `study_material` WHERE id = '$id'");
    echo '<script>alert("Document is deleted.");window.location.href="upload_material.php"</script>';
}

?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h5>All Update Study Material</h5>
    </div>
    <div class="panel-body">
        <table id="centerTable" class="table table-bordered data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Document Name / Link</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $get = $con->query("SELECT * FROM `study_material`");
        $i = 1;
        if ($get->num_rows) {
            while ($row = $get->fetch_assoc()) {
                echo '<tr>
                        <td>' . $i++ . '</td>
                        <td>' . $row['date'] . '</td>
                        <td>';
                if (!empty($row['link_url'])) {
                    // Display the link URL as a hyperlink
                    echo '<a href="' . $row['link_url'] . '" target="_blank">' . $row['link_url'] . '</a>';
                } else {
                    // Display the file name
                    echo $row['file'];
                }
                echo '</td>
                        <td>' . $row['description'] . '</td>
                        <td>
                            <a href="' . $row['link_url'] . '" target="_blank" class="btn btn-success"><i class="fa fa-download"></i> Google Drive</a>
                            <a href="'.BASE_URL.'uploads/study_material/' . $row['file'] . '" target="_blank" class="btn btn-success"><i class="fa fa-download"></i> Download</a>
                            <a href="?action=delete&id=' . $row['id'] . '" class="btn btn-danger" onclick="return confirm(\'Are You Sure You Want to Permanently Delete This Item?\')"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>';
            }
        }
        ?>
    </tbody>
</table>

    </div>
</div>
<?php
    include 'includes/footer.php';
?>