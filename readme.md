## Locaweb SMTP com CurlPHP

Utilização da ferramenta SMTP da locaweb para envio e retorno de relatorios dos e-mails enviado pela mesma.

##Dependência:
"bblibs/bb_curl" : "dev-main"


Nesse pacote terá 4 arquivos

* index.php - Arquivo onde terá um exemplo pratico do uso da ferramanta.
* Message.php - Classe onde será armazenada dos campos de um e-mail.
* Sender.php - Classe onde é feita todo chamada de envio e retorno de relatórios.
* Config.php - Onde você colocara o token fornecido pela locaweb. 

##### Message.php
* setMessage(string $subject, string $body, string $from, array $to);
* setCC(array $emails);
* setBCC(array $emails);
* getMessage();

##### Sender.php
* setInterval(string $start_date, string $end_date='');
* page(int $page);
* getEmailSent(string $status='all', int $per=100);
* getEmailSentID(string $id);
* sendMessage(Message $message)

##### Config.php
define("API_TOKEN", "sua-chave-token"); - trocar pela sua chave token da locaweb.

