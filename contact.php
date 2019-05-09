<?php
session_start();

require_once 'libs/phpmailer/PHPMailerAutoload.php';

$errors = [];

if(isset($_POST['name'], $_POST['email'], $_POST['message'])){
    $fields = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'message' => $_POST['message']
    ];

    foreach($fields as $field => $data){
        if(empty($data)){
            $errors[] = 'The '.$field.' field is required.';
        }
    }

    if(empty($errors)){
        $m = new phpmailer;
        $m->SMTPDebug = 2;
        
        $m->isSMTP();
        $m->SMTPAuth = true;
        $m->Host = 'smtp.gmail.com';
        $m->Username = 'ibrahimatagayev@gmail.com';
        $m->Password = 'Aa6477727575';
        $m->SMTPSecure = 'ssl';
        $m->Port = 465;

        $m->isHTML(true);

        $m->Subject = 'Contact form submmited';
        $m->Body = 'From: '.$fields['name'].' ('.$fields['email'].')<p>'.$fields['message'].'</p>';

        $m->From = 'ibrahimatagayev@gmail.com';
        $m->FromName = 'Contact';

        $m->AddAddress('ibrahimatagayev@gmail.com', 'Ibrahim Atagayev');

        if($m->send()){
            header('Location: thanks.php');
        }else{
            echo("failed");
        }
    }

}else{
    $errors[] = 'something went wrong.';
}

$_SESSION['errors'] = $errors;
$_SESSION['fields'] = $fields;
//header('Location: index.php');
?>