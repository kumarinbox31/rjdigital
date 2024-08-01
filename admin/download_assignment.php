<?php
if(isset($_GET['file'])) {
    $file = $_GET['file'];
    $filepath = '../uploads/assignment/' . $file;

    if (file_exists($filepath)) {
        // Set headers for force download
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file");
        header("Content-Type: application/pdf"); // Change the content type as needed (e.g., for different file types)

        // Read the file content and output it to the user
        readfile($filepath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid file request.";
}
?>
