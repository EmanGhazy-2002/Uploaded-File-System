# Uploaded File System

A simple PHP application for uploading files with validation and error handling. This project allows users to upload images to a specific directory on the server while checking file type, size, and other parameters. The system includes both single and multi-file upload options.

## Features

- **Single and Multi-file upload support**
- **File type validation** (supports `jpg`, `jpeg`, `gif`, and `png` formats)
- **File size limit** (40KB maximum per file)
- **Error handling** for unsupported file types and sizes
- **Automatic creation of the upload directory** if it doesn't exist
- **Simple GUI with CSS** to display messages and improve user experience

## Installation

1. Clone this repository to your local machine:
    ```bash
    git clone https://github.com/EmanGhazy-2002/Uploaded-File-System.git
    ```
2. Ensure your server's document root (e.g., Apache) is correctly configured.
3. Open the project directory:
    ```bash
    cd Uploaded-File-System
    ```

## Usage

1. Start your local PHP server:
    ```bash
    php -S localhost:8000
    ```
2. Open your browser and navigate to `http://localhost:8000`.
3. Use the form to upload files.

## Code Overview

- **`singleUpload.php`**: Handles single file upload, validates file size and type, and saves the file to the `/uploaded/` directory.
- **`multiUpload.php`**: Manages multiple file uploads, performs validation, and saves each file to the same directory.
- **`styles.css`**: A CSS file with basic styles for error and success messages and a simple GUI for the upload form.

## File Validation Rules

- **Allowed File Types**: `jpg`, `jpeg`, `gif`, `png`
- **Maximum File Size**: 40KB

## Error Handling

The script validates and handles the following errors:
- **File Size Error**: Displays an error if a file exceeds 40KB.
- **File Type Error**: Displays an error if the file type is unsupported.
- **File Upload Error**: If no file is selected or an error occurs during the upload, an appropriate message is shown.

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue.
