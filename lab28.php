<?php

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $file = $_FILES["image"];

    $allowed = ["png", "jpg", "jpeg"];
    $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    if (!in_array($extension, $allowed)) {
        $message = "Only PNG and JPEG images are allowed.";
    } elseif ($file["size"] >= 500 * 1024) {
        $message = "Image size must be less than 500 KB.";
    } else {

        move_uploaded_file(
            $file["tmp_name"],
            "uploads/" . $file["name"]
        );

        $message = "Profile image uploaded successfully.";
    }
}

?>

<form method="post" enctype="multipart/form-data">

    Select Profile Image:
    <input type="file" name="image"><br><br>

    <input type="submit" value="Upload">

</form>

<p><?php echo $message; ?></p>