<?php
namespace BBLocawebEmail\Core;

use BBCurl\Core\Request;
/**
 * Class Sender - BB_Locaweb_email
 * @author Carlos Mateus Carvalho <carvalho.ti.adm@gmail.com>
 * @license MIT
 * @package BBLocalwebEmail\Core
 */
class Sender{

    /**
     * Atributo  para receber o tipo de messagem enviada - all, delivered ou errors.
     * @var string
     */
    private $status;

    /**
     * Atributo para receber a quantidade de registro por pagina.
     * @var string
     */
    private $per;

    /**
     * Atributo de  data de inicio do relatório, campo obrigatório.
     * @var string
     */
    private $start_date;

    /**
     * Atributo de  data final do relatório.
     * @var string
     */
    private $end_date;

    /**
     * Atributo para guardar o numero da página.
     * @var int
     */
    private $page;

    public function __construct()
    {
        $this->page = 1;
    }

    /**
     * Método responsável por configurar um intervalo obrigatório nos emails enviados, antes do método getEmailSent()
     * @param string $start_date - Data de inicio do relatorio.
     * @param string $end_date - Data final do relatorio (caso não informado ele irá buscar até o ultimo dia do mes atual)
     * @return $this
     */
    public function setInterval(string $start_date, string $end_date='')
    {
        $this->start_date = $start_date;
        $this->end_date = empty($end_date) ? date("Y-m-t") : $end_date;
        return $this;
    }

    /**
     * Método responsável por buscar pela pagina do relatoriom antes do método getEmailSent().
     * @param int $page - Numero da página.
     * @return $this
     */
    public function page(int $page)
    {
        $this->page = ($page==0) ? 1 : $page;
        return $this;
    }

    /**
     * Método principal responsável por listar os emails enviados configurados previamente pelo setIntenval().
     * @param string $status - Tipo do status da mensagem (all = Todos, delivered = somente entregues ou errors = somente os erros de envio).
     * @param int $per - Quantos resultados por pagina ( máximo 100).
     * @return array
     */
    public function getEmailSent(string $status='all', int $per=100)
    {
        $this->status = $status;
        $this->per = $per;

        $header = ["x-auth-token: " . API_TOKEN];
        $req = (new Request(API_URL . '/messages', $header))
            ->get(['status' => $this->status, 'start_date' => $this->start_date, 'end_date' => $this->end_date, 'per' => $this->per, 'page'=> $this->page])->run();

        return empty($req) ? []  : $req['data'];
    }


    /**
     * Método responsável por buscar um email especifico por seu id
     * @param string $id - Id no email.
     * @return array
     */
    public function  getEmailSentID(string $id)
    {
        $header = ["x-auth-token: " . API_TOKEN];
        $req = (new Request(API_URL . '/messages/' . $id, $header))
            ->get()->run();

        return empty($req) ? []  : $req['data'];
    }

    /**
     * étodo principal responsável enviar um email através da API.
     * @param Message $message - Dependência da classe Message com seus atributos.
     * @return array
     * @throws \Exception
     */
    public function sendMessage(Message $message)
    {
        $message = $message->getMessage();
        $header = ["x-auth-token: " . API_TOKEN];
        $req = (new Request(API_URL . '/messages', $header))
            ->post($message)->run();
        return  empty($req) ? []  : $req['data'];
    }

}