<?php

// Leggi i dati dal form
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$surname = isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

// Validazione base
if (empty($name) || empty($surname) || empty($email) || empty($message)) {
    http_response_code(400);
    echo "Errore: Tutti i campi sono obbligatori";
    exit;
}

// Validazione email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Errore: Email non valida";
    exit;
}

// Email dove ricevere i messaggi
$to = "seba.laterra@gmail.com"; // MODIFICA CON LA TUA EMAIL

// Oggetto email
$subject = "Nuovo messaggio da: $name $surname";

// Corpo del messaggio
$body = "Hai ricevuto un nuovo messaggio da:\n\n";
$body .= "Nome: $name\n";
$body .= "Cognome: $surname\n";
$body .= "Email: $email\n";
$body .= "Messaggio:\n$message\n";

// Headers
$headers = "From: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Invia l'email
if (mail($to, $subject, $body, $headers)) {
    http_response_code(200);
    echo "Messaggio inviato con successo";
} else {
    http_response_code(500);
    echo "Errore nell'invio del messaggio";
}

?>
