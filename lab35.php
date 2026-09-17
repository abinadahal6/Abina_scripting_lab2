<?php
$message = '';
$operation = $_POST['operation'] ?? '';
$filename = trim($_POST['filename'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $filename !== '') {
    switch ($operation) {
        case 'check':
            $message = file_exists($filename)
                ? "File '$filename' exists."
                : "File '$filename' does not exist.";
            break;

        case 'open':
            $handle = fopen($filename, 'a+');
            $message = $handle ? "File opened successfully." : "Could not open file.";
            if ($handle) fclose($handle);
            break;

        case 'write':
            $text = $_POST['text'] ?? '';
            $handle = fopen($filename, 'a');
            if ($handle) {
                fwrite($handle, $text . "\n");
                fclose($handle);
                $message = "Text written to file.";
            } else {
                $message = "Could not open file for writing.";
            }
            break;

        case 'read':
            if (file_exists($filename)) {
                $handle = fopen($filename, 'r');
                $content = fread($handle, filesize($filename));
                fclose($handle);
                $message = "File content:<br><pre>" . htmlspecialchars($content) . "</pre>";
            } else {
                $message = "File does not exist.";
            }
            break;

        case 'close':
            $message = "File handle closed (close is done right after each operation above).";
            break;

        case 'rename':
            $newName = trim($_POST['newname'] ?? '');
            if (file_exists($filename) && $newName !== '') {
                $message = rename($filename, $newName)
                    ? "File renamed to '$newName'."
                    : "Rename failed.";
            } else {
                $message = "Original file missing or new name empty.";
            }
            break;

        case 'checkperm':
            if (file_exists($filename)) {
                $perms = substr(sprintf('%o', fileperms($filename)), -4);
                $message = "Current permissions: $perms";
            } else {
                $message = "File does not exist.";
            }
            break;

        case 'changeperm':
            if (file_exists($filename)) {
                chmod($filename, 0755);
                $perms = substr(sprintf('%o', fileperms($filename)), -4);
                $message = "Permissions changed. New permissions: $perms";
            } else {
                $message = "File does not exist.";
            }
            break;
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>File Handling Operations</h2>
<form method="post">
    Filename: <input type="text" name="filename" value="<?= htmlspecialchars($filename) ?>" required><br>
    Text to write (for Write): <input type="text" name="text"><br>
    New filename (for Rename): <input type="text" name="newname"><br>

    <button type="submit" name="operation" value="check">Check File</button>
    <button type="submit" name="operation" value="open">Open File</button>
    <button type="submit" name="operation" value="write">Write File</button>
    <button type="submit" name="operation" value="read">Read File</button>
    <button type="submit" name="operation" value="close">Close File</button>
    <button type="submit" name="operation" value="rename">Rename File</button>
    <button type="submit" name="operation" value="checkperm">Check Permissions</button>
    <button type="submit" name="operation" value="changeperm">Change Permissions</button>
</form>

<?php if ($message): ?>
    <p><?= $message ?></p>
<?php endif; ?>
</body>
</html>