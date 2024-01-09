<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = connectToDatabase();
    
    include 'validation.php'; // Validate data

    validateRequiredField('iso_number', 'Installation Service Order No');
    validateRequiredField('model_name', 'Model Name');
    validateRequiredField('name', 'Name');
    validateRequiredField('email', 'Email Address');
    validateRequiredField('phone', 'Phone Number');
    validateEmail('email', 'Email Address');
    validatePhoneNumber('phone', 'Phone Number', 10);
    validateRequiredField('address', 'Address');
    validateRequiredField('city', 'City');
    validateRequiredField('state', 'State');
    validateRequiredField('pincode', 'Pincode');
    validateRequiredField('serial_number', 'Serial Number');
    validateRequiredField('purchase_date', 'Purchase Date');
    // validateRequiredField('invoice_pdf', 'Scan of Invoice (PDF)');
    // validateRequiredField('warranty_form_pdf', 'Scan of Life Time Warranty Registration Form (PDF)');

    $iso_number = $_POST["iso_number"];
    if (!preg_match("/^[A-Za-z]{3}\d{10}$/", $iso_number)) {
        $_SESSION['err_msg']['iso_number'] = "Invalid ISO number format. Please email xyz@gmail.com for warranty registration.";
        header("Location: index.php");
        exit;
    }

    $fieldsToValidate = ['invoice_pdf', 'warranty_form_pdf'];
    foreach ($fieldsToValidate as $field) {
        $_POST[$field] = validatePDFFile($field, 'img/');
    }

    // Check for any errors before database insertion
    if (!empty($_SESSION['err_msg'])) {
        header("Location: index.php");
        exit();
    }

    // Continue processing the form and saving to the database
    $model_name = $_POST['model_name'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $serial_number = $_POST['serial_number'];
    $purchase_date = $_POST['purchase_date'];
    $invoice_pdf = $_POST['invoice_pdf'];
    $warranty_form_pdf = $_POST['warranty_form_pdf'];

    try{
        $sql = "INSERT INTO warranty_registration (iso_number, model_name, name, email, phone, address, city, state, pincode, serial_number, purchase_date, invoice_pdf, warranty_form_pdf)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";    
            
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("sssssssssssss", $iso_number, $model_name, $name, $email, $phone, $address, $city, $state, $pincode, $serial_number, $purchase_date, $invoice_pdf, $warranty_form_pdf);

        if ($stmt->execute()) {
            include 'smtp_config.php'; 
            
            try {
                $mail->isSMTP();
                $mail->Host = $smtpConfig['host'];
                $mail->SMTPAuth = true;
                $mail->Port = $smtpConfig['port'];
                $mail->Username = $smtpConfig['username'];
                $mail->Password = $smtpConfig['password'];
    
                $mail->setFrom('jstandoff45@gmail.com', 'John Doe');
                $mail->addAddress('hr@unbundl.com', 'hr'); // to: hr@unbundl.com
    
                $mail->isHTML(true);
                $mail->Subject = 'Warranty Registration';
                $mail->Body = "Hi,<br><br>Warranty registration with Installation Service Order No $iso_number has been successful. Thank you for registering with us.<br>
                        <br><strong>Details Submitted:</strong><br>
                        - Model Name: $model_name<br>
                        - Name: $name<br>
                        - Email: $email<br>
                        - Phone: $phone<br>
                        - Address: $address<br>
                        - City: $city<br>
                        - State: $state<br>
                        - Pincode: $pincode<br>
                        - Serial Number: $serial_number<br>
                        - Purchase Date: $purchase_date";
    
                $mail->send();

            } catch (Exception $e) {
                $_SESSION['error_msg'] = 'Whoops!, Error sending email. Please try again.'. $e->getMessage();
                header("Location: index.php");
                exit();
            }

            $_SESSION['success_msg'] = "Thank you for sharing the documents with us. Our team will verify the details and get back to you within 7 
                working days. FFIPL reserves the right to reject the warranty application if the registration terms & conditions are not met. Please refer to the product’s user manual for detailed 
                warranty terms & conditions.";
            header("Location: index.php");
            exit();
    
        } else {
            $_SESSION['error_msg'] = "Whoops!, Something went wrong. Please try again.";
            header("Location: index.php");
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error_msg'] = "Whoops!, Something went wrong. Please try again.";
        header("Location: index.php"); 
        exit();
    }

    $stmt->close(); $conn->close(); // Close the prepared statement and the database connection
}
?>
