<?php
   require_once __DIR__ . '/vendor/autoload.php';

    use BBLocawebEmail\Core\Sender;
    use BBLocawebEmail\Core\Message;

    ?>
    <h1>Envio de Mensagem</h1>
    <?php
        $to = ["emaildestino1@email.com", "emaildestino2@email.com"];
        $message = (new Message())->setMessage("Teste", "Teste de corpo text ou html", "email@email.com", $to);
       // $res = (new Sender())->sendMessage($message);
        var_dump($message);
    ?>
    <hr>

    <h1>Listar uma mensagem especificia</h1>
    <?php
        $email = (new Sender())->getEmailSentID("1317");
        var_dump($email);
    ?>
    <hr>

    <h1>Listar todas as mensagens (all, delivered ou errors)</h1>
    <?php
        $emails = (new Sender())->setInterval('2020-11-03')->getEmailSent('delivered');
        var_dump($emails);
    ?>
    <hr>


