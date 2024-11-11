<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploaded/';

    // Check if the directory exists, if not create it
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $all_files = [];

    // Retrieve uploaded file information
    $files = $_FILES['my-task'];
    $file_names = $files['name'];
    $file_tmps = $files['tmp_name'];
    $file_sizes = $files['size'];
    $file_errors = $files['error'];

    // Allowed file extensions and maximum file size
    $allowed_extensions = ['jpg', 'jpeg', 'gif', 'png'];
    $max_file_size = 40000; // 40KB

    // Loop through each uploaded file
    $file_count = count($file_names);
    for ($i = 0; $i < $file_count; $i++) {
        $file_name = $file_names[$i];
        $file_tmp = $file_tmps[$i];
        $file_size = $file_sizes[$i];
        $file_error = $file_errors[$i];
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Generate a unique random name for each file
        $new_file_name = rand(0, 1000) . "." . $file_extension;

        // Check for upload errors and file validation
        if ($file_error === UPLOAD_ERR_NO_FILE) {
            $errors[] = "<div class='error'>No file uploaded for file: $file_name.</div>";
        } elseif ($file_size > $max_file_size) {
            $errors[] = "<div class='error'>File $file_name is too large. Maximum size: $max_file_size bytes.</div>";
        } elseif (!in_array($file_extension, $allowed_extensions)) {
            $errors[] = "<div class='error'>Invalid file type for $file_name. Allowed types: jpg, jpeg, gif, png.</div>";
        } else {
            // If no errors, move file to the upload directory
            if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
                echo "<div class='success'>File $file_name uploaded successfully! New Name: $new_file_name</div>";
                $all_files[] = $new_file_name;
            } else {
                $errors[] = "<div class='error'>Failed to upload $file_name.</div>";
            }
        }
    }

    // Display errors, if any
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error;
        }
    }

    // Display all uploaded file names as a comma-separated string
    if (!empty($all_files)) {
        $file_field = implode(', ', $all_files);
        echo "<div class='success'>Uploaded Files: $file_field</div>";
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
    <input type="file" name="my-task[]" multiple><br><br>
    <input type="submit" name="submit" value="Upload"><br><br>
</form>
