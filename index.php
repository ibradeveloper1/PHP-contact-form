<?php
session_start();

require_once 'helpers/security.php';

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$fields = isset($_SESSION['fields']) ? $_SESSION['fields'] : [];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php if(!empty($errors)) : ?>
    <div>
        <ul>
            <li><?php echo implode('<li></li>', $errors); ?></li>
        </ul>
    </div>
<?php endif; ?>
    <form method="post" action="contact.php">
        <label>Name</label>
        <input type="text" name="name" autocomplete="off"<?php echo isset($fields['name']) ? 'value="'.e($fields['name']).'"' : ''?>> <br>

        <label>Email</label>
        <input type="text" name="email" autocomplete="off"<?php echo isset($fields['email']) ? 'value="'.e($fields['email']).'"' : ''?>><br>

        <label>Message</label>
        <textarea type="text" name="message"><?php echo isset($fields['message']) ? e($fields['message']) : ''?></textarea><br>

        <input type="submit" value="send">
    </form>
</body>
</html>

<?php
unset($_SESSION['errors']);
unset($_SESSION['fields']);

?>