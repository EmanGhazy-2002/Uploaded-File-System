# Uploaded File System

A simple PHP application for uploading files with validation and error handling. This project allows users to upload images to a specific directory on the server while checking file type, size, and other parameters. It also includes a basic graphical interface styled with an external CSS file.

## Features

- Multi-file upload support
- File type validation (supports `jpg`, `jpeg`, `gif`, and `png` formats)
- File size limit (40KB maximum per file)
- Error handling for unsupported file types, large file sizes, and upload issues
- Automatic creation of the upload directory if it doesn't exist
- Simple GUI for a user-friendly upload experience

## Installation

1. Clone this repository to your local machine:
    ```bash
    git clone https://github.com/EmanGhazy-2002/Uploaded-File-System.git
    ```
2. Ensure your server’s document root (e.g., Apache) is correctly configured.
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
3. Use the form to upload files through a simple GUI.

## Code Overview

- **`multiUpload.php`**: The main PHP file that handles file uploads, validates file size and type, and saves files to the `/uploaded/` directory.
- **CSS (styles.css)**: A separate stylesheet that defines basic styles for the upload form, error, and success messages to enhance user experience.

## File Validation Rules

- **Allowed File Types**: `jpg`, `jpeg`, `gif`, `png`
- **Maximum File Size**: 40KB per file

## Error Handling

The script validates and handles the following errors:
- **File Size Error**: Displays an error if a file exceeds 40KB.
- **File Type Error**: Displays an error if the file type is unsupported.
- **File Upload Error**: Displays a message if no file is selected or if an error occurs during upload.

## GUI and Styling

The user interface has been enhanced with a simple CSS-based design:
- **styles.css**: Provides a cleaner, more user-friendly look with error and success message styling, as well as general styling for the upload form and buttons.

## Contributing

Contributions are welcome! Feel free to submit a pull request or open an issue if you have suggestions or improvements.
