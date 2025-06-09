<?php
// Check if the file parameter exists
if (isset($_GET['file'])) {
    $file = urldecode($_GET['file']); // Decode the URL-encoded file path

    // Make sure the file exists
    if (file_exists($file)) {
        // Set the headers to force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Content-Length: ' . filesize($file));
        readfile($file); // Read and send the file to the user
        exit();
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}
?>
