<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploaded/';
    $all_files = []; // To store successfully uploaded files

    // Check if the directory exists, if not create it
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Loop through each uploaded file
    foreach ($_FILES['my-task']['name'] as $key => $file_name) {
        $file_tmp = $_FILES['my-task']['tmp_name'][$key];
        $file_size = $_FILES['my-task']['size'][$key];
        $file_error = $_FILES['my-task']['error'][$key];
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Allowed file extensions
        $allowed_extensions = ['jpg', 'jpeg', 'gif', 'png'];

        // Error handling
        if ($file_error === UPLOAD_ERR_NO_FILE) {
            $errors[] = '<div class="error">No file uploaded for file: ' . $file_name . '.</div>';
        } else {
            if ($file_size > 40000) { // Limit file size to 40KB
                $errors[] = "<div class='error'>File '$file_name' size cannot exceed 40KB.</div>";
            }
            if (!in_array($file_extension, $allowed_extensions)) {
                $errors[] = "<div class='error'>Invalid file type for '$file_name'. Allowed types: jpg, jpeg, gif, png.</div>";
            }
        }

        // File upload and error display
        if (empty($errors)) {
            if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
                $all_files[] = $file_name; // Add successfully uploaded file to the list
            } else {
                $errors[] = "<div class='error'>Failed to move file '$file_name'.</div>";
            }
        }
    }

    // Display results after form submission
    if (!empty($all_files)) {
        $file_field = implode(', ', $all_files);
        $status = 'success';
        $message = "Files uploaded successfully!<br>Uploaded Files: $file_field";
    }
}
?>

<!-- Link the external CSS file -->
<link rel="stylesheet" href="styles.css">

<!-- Upload Form and Result Message -->
<div class="upload-container">
    <h1>Upload Files</h1>
    <!-- File Upload Form -->
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="files">Select Files:</label>
            <input type="file" name="my-task[]" class="file-input" multiple><br><br>
        </div>
        <button type="submit" name="submit" class="submit-btn">Upload</button>
    </form>

    <!-- Display Result Message -->
    <?php if (isset($status)): ?>
        <div class="message <?php echo $status; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <!-- Display Errors -->
    <?php if (!empty($errors)): ?>
        <div class="message error">
            <strong>Errors:</strong><br>
            <?php echo implode('<br>', $errors); ?>
        </div>
    <?php endif; ?>
</div>
