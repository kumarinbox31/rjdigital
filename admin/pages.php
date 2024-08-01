<?php
require_once 'includes/header.php';
error_reporting(E_ALL);ini_set('display_errors',1);
if(isset($_POST['status']) && $_POST['status'] == 'add_page') {
    // Sanitize user inputs to prevent SQL injection
    $pageName = $con->real_escape_string($_POST['page_name']);
    $content = $con->real_escape_string($_POST['content']);

    // Check if the page with the same name already exists
    $chk = $con->query("SELECT * FROM his_page WHERE page_name = '$pageName'");

    if($chk->num_rows === 0) {
        // Insert new page
        $con->query("INSERT INTO `his_page` (`page_header`,`id`, `timestamp`, `page_name`, `content`,`status`,`default_page`,`redirect`)
        VALUES ('N/A',NULL, CURRENT_TIMESTAMP, '$pageName', '$content','1','0','0')");
        $lastPageId = $con->query('SELECT `id` FROM `his_page` ORDER BY id DESC LIMIT 1')->fetch_assoc()['id'];

        // Insert into web_schema
        $con->query("INSERT INTO `web_schema` (`id`, `type`, `page_id`) VALUES (NULL, 'content', '$lastPageId')");

        echo '<script>alert("Success"); location.href="pages.php"</script>';
    } else {
        echo '<script>alert("Page with the same name already exists");</script>';
    }
}

?>

<!-- Main content -->
<section class="content">
    <div class="box box-success">
        <div class="box-header">
            <h3 class="text-center title-2">Add Page</h3>
        </div>
        <div class="box-body">
            <form action="" method="post" novalidate="novalidate" class="AddPage">
                <input type="hidden" name="status" value="add_page">
                <div class="form-group">
                    <label for="cc-payment" class="control-label mb-1">Page Name</label>
                    <input name="page_name" type="text" class="form-control" placeholder="Enter Page Name" required="">
                </div>
                <div class="form-group has-success">
                    <label for="cc-name" class="control-label mb-1">Page Content</label>
                    <textarea class="form-control ckeditor" name="content" placeholder="Enter Page Content"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>
