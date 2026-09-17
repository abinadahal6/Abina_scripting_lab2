<?php

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $file = $_FILES["cv"];

    $allowed = ["pdf", "doc", "docx"];
    $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    if (!in_array($extension, $allowed)) {
        $message = "Only PDF, DOC and DOCX files are allowed.";
    } elseif ($file["size"] >= 1024 * 1024) {
        $message = "File size must be less than 1 MB.";
    } else {

        move_uploaded_file(
            $file["tmp_name"],
            "uploads/" . $file["name"]
        );

        $message = "CV uploaded successfully.";
    }
}

?>

<form method="post" enctype="multipart/form-data">

    Select CV:
    <input type="file" name="cv"><br><br>

    <input type="submit" value="Upload">

</form>

<p><?php echo $message; ?></p>