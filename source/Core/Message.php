<?php
    namespace BBLocawebEmail\Core;
    /**
     * Class Message - BB_Locaweb_email
     * @author Carlos Mateus Carvalho <carvalho.ti.adm@gmail.com>
     * @license MIT
     * @package BBLocalwebEmail\Core
     */
    class Message{

        /**
         * Atributo para guardar o assunto da email.
         * @var string
         */
        private $subject;

        /**
         * Atributo para guardar o corpo da email.
         * @var string
         */
        private $body;

        /**
         * Atributo para guardar o email do rementente do email.
         * @var string
         */
        private $from;

        /**
         * Atributo para guardar o(s) destinatario(s) do email.
         * @var array
         */
        private $to;

        /**
         * Atributo para guardar os emails com copia.
         * @var array
         */
        private $cc;

        /**
         * Atributo para guardar os emails de copai oculta.
         * @var array
         */
        private $bcc;


        public function __construct()
        {
            $this->cc = [];
            $this->bcc = [];
        }

        /**
         * Método responsável por "setar" as informações de básicas do email.
         * @param string $subject - Assunto do E-mail.
         * @param string $body - Corpo do E-mail (text ou html).
         * @param string $from - Remetente do email (deve ser um previamente cadastrado na ferramenta SMTP da Locaweb).
         * @param array $to - Destinatarios do email.
         * @return $this
         */
        public function setMessage(string $subject, string $body, string $from, array $to)
        {
            $this->subject = $subject;
            $this->body = $body;
            $this->from = $from;
            $this->to = $to;
            return $this;
        }

        /**
         * Método responsável por "setar" os emails com copia para.
         * @param array $emails - Lista de emails válidos ex. ['email1@email.com', 'email2@email.com', ...].
         * @return $this
         */
        public function setCC(array $emails){
            $this->cc = $emails;
            return $this;
        }

        /**
         * Método responsável por "setar" os emails com copia oculta para.
         * @param array $emails - Lista de emails válidos ex. ['email1@email.com', 'email2@email.com', ...].
         * @return $this
         */
        public function setBCC(array $emails){
            $this->bcc = $emails;
            return $this;
        }

        /**
         *  Método responsável retornar da array montada para o CURL PHP
         * @return array
         */
        public function getMessage()
        {
            return ['subject' => $this->subject, 'body' => $this->body, 'from' => $this->from, 'to' => $this->to, 'cc' => $this->cc, 'bcc' => $this->bcc];
        }


    }