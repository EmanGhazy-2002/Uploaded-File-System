<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploded/';

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
        $errors[] = '<div>No file uploaded.</div>';
    } else {
        if ($file_size > 40000) {
            $errors[] = '<div>File size cannot exceed 40KB.</div>';
        }
        if (!in_array($file_extension, $allowed_extensions)) {
            $errors[] = '<div>Invalid file type. Allowed types: jpg, jpeg, gif, png.</div>';
        }
    }

    // File upload and error display
    if (empty($errors)) {
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
        }

        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            echo "<div>Image uploaded successfully!</div>";
        } else {
            echo "<div>Failed to move uploaded file.</div>";
        }
    } else {
        foreach ($errors as $error) {
            echo $error;
        }
    }
}

?>

<!-- Upload Form -->
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="my-task"><br><br>
    <input type="submit" name="submit" value="Upload"><br><br>
</form>
