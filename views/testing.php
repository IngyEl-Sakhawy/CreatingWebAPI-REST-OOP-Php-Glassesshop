<?php
session_start();

// Function to search for an image in specific directories recursively
function searchImage($imageName) {
    // Directories to search in
    $directories = [
        'C:/',
        'D:/',
        'E:/'
    ];
    
    // Pattern to match image file extensions
    $pattern = '**/' . $imageName;
    
    // Iterate through each directory
    foreach ($directories as $directory) {
        // Use glob() with GLOB_BRACE and GLOB_NOSORT flags for recursive search
        $files = glob($directory . $pattern, GLOB_BRACE | GLOB_NOSORT);
        
        // Check if any files match the pattern
        if (!empty($files)) {
            // Store the matched image paths in a session variable
            $_SESSION['image_paths'] = $files;
            return; // Stop searching after finding the first match
        }
    }
    
    // If the function reaches here, it means the image was not found
    echo "Image '$imageName' not found.";
}

// Define the image name to search for
$imageName = '1.jpg';

// Start the search
searchImage($imageName);

// Check if image paths are stored in session
if (isset($_SESSION['image_paths'])) {
    // Retrieve the image paths from session
    $imagePaths = $_SESSION['image_paths'];
    
    // Display the first matched image
    echo "<img src='" . $imagePaths[0] . "' alt='Specific Image'>";
} else {
    // If image paths are not found in session, display error message
    echo "No image paths found in session.";
}
?>
