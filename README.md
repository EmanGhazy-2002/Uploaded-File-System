# Uploaded File System

A simple PHP application for uploading files with validation and error handling. This project allows users to upload images to a specific directory on the server while checking file type, size, and other parameters.

## Features

- Multi-file upload support
- File type validation (supports `jpg`, `jpeg`, `gif`, and `png` formats)
- File size limit (40KB maximum per file)
- Error handling for unsupported file types and sizes
- Automatic creation of the upload directory if it doesn't exist

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

- **`multiUpload.php`**: The main PHP file that handles file uploads, validates file size and type, and saves files to the `/uploaded/` directory.
- **CSS**: Basic styles are embedded within the file to display error and success messages.

## File Validation Rules

- **Allowed File Types**: `jpg`, `jpeg`, `gif`, `png`
- **Maximum File Size**: 40KB

## Error Handling

The script validates and handles the following errors:
- **File Size Error**: Displays an error if a file exceeds 40KB.
- **File Type Error**: Displays an error if the file type is unsupported.
- **File Upload Error**: If no file is selected or an error occurs during the upload, an appropriate message is shown.

## Screenshots

![Screenshot of File Upload Form](path_to_screenshot.png)

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue.

## License

This project is licensed under the MIT License.
