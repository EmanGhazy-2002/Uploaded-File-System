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
            $errors[] = "No file uploaded for file: $file_name.";
        } elseif ($file_size > $max_file_size) {
            $errors[] = "File $file_name is too large. Maximum size: $max_file_size bytes.";
        } elseif (!in_array($file_extension, $allowed_extensions)) {
            $errors[] = "Invalid file type for $file_name. Allowed types: jpg, jpeg, gif, png.";
        } else {
            // If no errors, move file to the upload directory
            if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
                $all_files[] = $new_file_name;
            } else {
                $errors[] = "Failed to upload $file_name.";
            }
        }
    }

    // Display results after form submission
    if (!empty($all_files)) {
        $file_field = implode(', ', $all_files);
        $status = 'success';
        $message = "Files uploaded successfully!<br>Uploaded Files: $file_field";
    } elseif (!empty($errors)) {
        $status = 'error';
        $message = "Error(s) occurred:<br>" . implode('<br>', $errors);
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
            <?php foreach ($errors as $error): ?>
                <?php echo $error; ?><br>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
