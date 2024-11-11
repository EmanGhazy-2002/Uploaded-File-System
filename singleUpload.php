<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploaded/';

    // Check if the directory exists, if not create it
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Retrieve uploaded file information
    $file = $_FILES['my-task'];
    $file_name = $file['name'];
    $file_type = $file['type'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    // Allowed file extensions
    $allowed_extensions = ['jpg', 'jpeg', 'gif', 'png'];
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Display file details (for debugging or confirmation purposes)
    echo "Image name: $file_name<br>";
    echo "Image type: $file_type<br>";
    echo "Image temp: $file_tmp<br>";
    echo "Image size: $file_size bytes<br>";

    // Error handling
    if ($file_error === UPLOAD_ERR_NO_FILE) {
        $errors[] = '<div class="error">No file uploaded.</div>';
    } else {
        if ($file_size > 40000) { // Limit file size to 40KB
            $errors[] = '<div class="error">File size cannot exceed 40KB.</div>';
        }
        if (!in_array($file_extension, $allowed_extensions)) {
            $errors[] = '<div class="error">Invalid file type. Allowed types: jpg, jpeg, gif, png.</div>';
        }
    }

    // File upload and error display
    if (empty($errors)) {
        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            echo "<div class='success'>Image uploaded successfully!</div>";
        } else {
            echo "<div class='error'>Failed to move uploaded file.</div>";
        }
    } else {
        foreach ($errors as $error) {
            echo $error;
        }
    }
}
?>

<!-- Simple CSS for styling the messages -->
<style>
    .error {
        color: #d9534f;
        background-color: #f2dede;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ebccd1;
        border-radius: 5px;
    }
    .success {
        color: #4cae4c;
        background-color: #dff0d8;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #d6e9c6;
        border-radius: 5px;
    }
</style>

<!-- Upload Form -->
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="my-task"><br><br>
    <input type="submit" name="submit" value="Upload"><br><br>
</form>
