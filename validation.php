<?php

function validateRequiredField($fieldName, $fieldLabel) {
    if (empty($_POST[$fieldName])) {
        $_SESSION['err_msg'][$fieldName] = "$fieldLabel is required.";
    }
}

function validateEmail($fieldName, $fieldLabel) {
    if (!filter_var($_POST[$fieldName], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['err_msg'][$fieldName] = "Invalid email address format.";
    }
}

function validatePhoneNumber($fieldName, $fieldLabel, $maxLength = 10) {
    if (empty($_POST[$fieldName])) {
        $_SESSION['err_msg'][$fieldName] = "$fieldLabel is required.";
    } elseif (!preg_match('/^\d{1,' . $maxLength . '}$/', $_POST[$fieldName])) {
        $_SESSION['err_msg'][$fieldName] = "Invalid $fieldLabel. Should be numeric and not more than $maxLength digits.";
    }
}

function validatePDFFile($fieldName, $uploadDirectory) {
    $file = $_FILES[$fieldName];

    if ($_FILES[$fieldName]['error'] == UPLOAD_ERR_NO_FILE) {
        return; // No file uploaded, so no validation needed
    }

    if ($file['error'] == UPLOAD_ERR_NO_FILE) {
        return ''; // No file uploaded
    }

    $allowedExtensions = ['pdf'];
    $maxFileSize = 5 * 1024 * 1024; // 5 MB in bytes
    $fileExtension = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
    $fileSize = $file['size'];

    // Validate file extension
    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        $_SESSION['err_msg'][$fieldName] = "Invalid file type. Only PDF files are allowed.";
        return;
    }

    // Validate file size
    if ($fileSize > $maxFileSize) {
        $_SESSION['err_msg'][$fieldName] = "File size exceeds the maximum limit of 5 MB.";
    }

    // Move the file to the upload directory
    $newFileName = uniqid() . '_' . $file['name'];
    $uploadPath = $uploadDirectory . $newFileName;

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        return $newFileName;
    } else {
        $_SESSION['err_msg'][$fieldName] = "Error uploading file.";
        return '';
    }
}
?>
