<?php
    // This fun is made to display error msg below respective input field.
    session_start();
    function displayErrorMessage($fieldName) {
        if (isset($_SESSION['err_msg'][$fieldName])) {
            echo '<p class="text-red-500">' . $_SESSION['err_msg'][$fieldName] . '</p>';
            unset($_SESSION['err_msg'][$fieldName]);
        }
    }
    $isoNumberErrorMsg = isset($_SESSION['err_msg']['iso_number']) ? $_SESSION['err_msg']['iso_number'] : '';
    $disableForm = !empty($isoNumberErrorMsg);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Warranty Registration Form</title>
</head>
<body>

    <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
        <div class="container max-w-screen-lg mx-auto">

            <?php
            if (isset($_SESSION['success_msg'])) {
                echo '<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200" role="alert">
                        <span class="font-medium">Success!</span> ' . $_SESSION['success_msg'] . '
                    </div>';
                unset($_SESSION['success_msg']);
            }elseif (isset($_SESSION['error_msg'])){
                echo '<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200" role="alert">
                        <span class="font-medium">Danger!</span> ' . $_SESSION['error_msg'] . '
                    </div>';
                unset($_SESSION['error_msg']);
            }
            ?>

            <div>
                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-2">
                    <div class="text-gray-600">
                        <p class="font-medium text-lg">Warranty Registration Form</p><p>Please fill out all the fields.</p>
                    </div>
                    
                    <div class="lg:col-span-2">
                        <form action="form_submission.php" method="post" enctype="multipart/form-data" id="warranty-registration-form">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-6">
                                <div class="md:col-span-3">
                                <label for="iso_number">Installation Service Order No <span class="text-red-500">*</span></label>
                                <input type="text" name="iso_number" id="iso_number" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="Example: BLR1234567890" />
                                <?php displayErrorMessage('iso_number'); ?>
                                </div>
                
                                <div class="md:col-span-3">
                                <label for="model_name">Model Name <span class="text-red-500">*</span></label>
                                <select name="model_name" id="model_name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                    <option value="" >Select Model</option>
                                    <option value="LWT">LWT</option>
                                    <option value="Aero">Aero</option>
                                </select>
                                <?php displayErrorMessage('model_name'); ?>
                                </div>
                                <div id="customer-and-product-information"></div>
                                <div class="md:col-span-6 font-semibold text-base">Customer Information</div>
                                
                                <div class="md:col-span-2">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                                <?php displayErrorMessage('name'); ?>
                                </div>
                
                                <div class="md:col-span-2">
                                <label for="email">Email Address</label>
                                <input type="text" name="email" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                                <?php displayErrorMessage('email'); ?>
                                </div>
                                
                                <div class="md:col-span-2">
                                <label for="phone">Mobile Number</label>
                                <input type="text" name="phone" id="phone" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                                <?php displayErrorMessage('phone'); ?>
                                </div>
                                
                                <div class="md:col-span-2">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                                <?php displayErrorMessage('address'); ?>
                                </div>
                                
                                <div class="md:col-span-2">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                                <?php displayErrorMessage('city'); ?>
                                </div>
                                
                                <div class="md:col-span-2">
                                <label for="state">State</label>
                                <input type="text" name="state" id="state" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                                <?php displayErrorMessage('state'); ?>
                                </div>
                                
                                <div class="md:col-span-2">
                                <label for="pincode">Pincode</label>
                                <input type="text" name="pincode" id="pincode" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                                <?php displayErrorMessage('pincode'); ?>
                                </div>

                                <div class="md:col-span-6 font-semibold text-base">Product Information</div>

                                <div class="md:col-span-3">
                                <label for="serial_number">Serial Number</label>
                                <input type="text" name="serial_number" id="serial_number" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                                <?php displayErrorMessage('serial_number'); ?>
                                </div>
                                
                                <div class="md:col-span-3">
                                <label for="purchase_date">Purchase Date</label>
                                <input type="date" name="purchase_date" id="purchase_date" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                                <?php displayErrorMessage('purchase_date'); ?>
                                </div>
                                
                                <div class="md:col-span-3">
                                <label for="invoice_pdf">Scan of Invoice (PDF)</label>
                                <input type="file" name="invoice_pdf" id="invoice_pdf" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                                <?php displayErrorMessage('invoice_pdf'); ?>
                                </div>
                                
                                <div class="md:col-span-3">
                                <label for="warranty_form_pdf">Scan of Life Time Warranty Registration Form (PDF)</label>
                                <input type="file" name="warranty_form_pdf" id="warranty_form_pdf" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                                <?php displayErrorMessage('warranty_form_pdf'); ?>
                                </div>
                        
                                <div class="md:col-span-6 text-right pt-4">
                                <div class="inline-flex items-end">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                                </div>
                                </div>
                
                            </div>
                        </form>
                    </div>

                    <div class="lg:col-span-2" id="ino-not-valid-div" style="display: none;">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-6">
                            <div class="md:col-span-6">
                                <label for="iso_number">Installation Service Order No <span class="text-red-500">*</span></label>
                                <input type="text" name="iso_number" id="iso_number" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="Example: BLR1234567890" />
                                <p class="text-red-500">Invalid ISO number format. Please email xyz@gmail.com for warranty registration.</p>
                            </div>
                        </div>
                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var disableForm = <?php echo json_encode($disableForm); ?>;    
        document.addEventListener("DOMContentLoaded", function() {
            var div = document.getElementById("warranty-registration-form");
            var divIno = document.getElementById("ino-not-valid-div");
            if (disableForm) {
                div.style.display = "none";
                divIno.style.display = "block";
            }
        });
    </script>

</body>
</html>
