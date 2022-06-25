<?php

namespace Repse\Sa\support;

use Repse\Sa\tool\Selector;

class Messages
{
    private ?array $params  = null;
    private ?string $article = null;
    private ?int $page = null;
    public array $messages = [];
    public ?string $style = null;
    public ?string $message = null;

    public function __construct(protected Selector $selector){
        $this->params = (isset($this->selector->secondQueryValue)) ? explode('.',$this->selector->secondQueryValue) : $this->params;
        $this->article =  (isset($this->params[0])) ? $this->params[0] : $this->article;
        $this->page = (isset($this->params[1])) ? (int)$this->params[1] : $this->page;

    }

    public function add(string $message)
    {
        $this->messages[] = $message;
    }

    public function getMessage()
    {
        if (!empty($this->messages)) {
            foreach ($this->messages as $key => $value) {
                $qmessage = explode('.', $value);
                $this->style = $qmessage[0];
                $this->message = $qmessage[1];
                return $this;
            }
        }
    }

    public function isNotEmpty()
    {
        return !empty($this->messages);
    }

    /* DEPRECATED
    public function display()
    {
        return include_once(dirname(__DIR__, 2) . '/app/message.php');
    }
    */

    public function getQueryMessage()
    {
        switch ($this->selector->fristQueryValue) {
            case 'failExist':
                return $this->messages[] = 'danger.Stránka nexistuje,Vytvořte jí <a  href="/create/' . $this->article . '/' . $this->page . '">/create/' . $this->article . '/' . $this->page . '</a>';
                break;
            case 'logged':
                return $this->messages[] = 'success.Přihlášení úspěšné';
                break;
            case 'created':
                return $this->messages[] = 'success.Stránka úspěšně vyvořena';
                break;
            case 'updated':
                return $this->messages[] = 'success.Stránka úspěšně upravena';
                break;
            case 'deleted':
                return $this->messages[] = 'success.Stránka úspěšně smazána';
                break;
            case 'Uexist':
                return $this->messages[] = 'danger.Jméno nebo email se již používá';
                break;
            case 'Ulen':
                return $this->messages[] = 'danger.Jméno musí obsahovat nejméně 4 znaky a ne více jak 35';
                break;
            case 'UNum':
                return $this->messages[] = 'danger.Jméno musí obsahovat nejméně 1 číslo';
                break;
            case 'PWDLen':
                return $this->messages[] = 'danger.Heslo musí obsahovat nejméně 6 znaků';
                break;
            case 'PWDSpec':
                return $this->messages[] = 'danger.Heslo musí obasahovat nejméně jedno malé a velké písmeno a jeden specialní znak(!@$%^&)';
                break;
            case 'PWDAga':
                return $this->messages[] = 'danger.Heslo se neschoduje se neschoduje s heslem znovu';
                break;
            case 'FilterE':
                return $this->messages[] = 'danger.Neplatný formát e-mailu';
                break;
            case 'FField':
                return $this->messages[] = 'danger.Všechna pole musí být vyplneněna';
                break;
            case 'Persistent':
                return $this->messages[] = 'danger.Pro úspěšnou registraci musíte souhlasit se smluvními podmínkami a ochranou soukromí';
                break;
            case 'UNexist':
                return $this->messages[] = 'danger.Uživatelské jméno neexistuje';
                break;
            case 'joined':
                return $this->messages[] = 'success.Registrace úspěšná, pro aktivovaní účtu zkotrolujte email';
                break;
            case 'active':
                return $this->messages[] = 'success.Váš účet je aktivní můžete se přihlásit';
                break;
            case 'Esend': 
                return $this->messages[] = 'success.Na váš email byl odeslán odkaz na změnu hesla';
                break;
            case 'Enotsend':
                return $this->messages[] = 'danger.Reset hesla se nezdařil';
                break;
            case 'resetAccount':
                return $this->messages[] = 'success.Heslo změněno, můžete se přihlásit';
                break;                
            default: null;                                       
         /*
        case 'failUpdate':
            return $this->add(md5('failUpdate'),'Stránka neexistuje vytvořte jí pomocí /create')->style('danger');
        case 'savedBookmark':
            return $this->add(md5('savedBookmark'),'Záložka uložena')->style('success');
        case 'maxBookmarks':
            return $this->add(md5('maxBookmarks'),'Maximální počet záložek je 12, pokud chcete uložit novou nejprve musíte smazat jednu záložku')->style('danger');
        case 'profilUpdate':
            return $this->add(md5('profilUpdate'),'Profil aktualizován')->style('success');
        case 'active':
            return $this->add(md5('active'),'Váš účet je aktivní můžete se přihlásit')->style('success');
        case 'failActive':
            return  $this->add(md5('failActive'),'Aktivace účtu se nezdaržila kotaktujte prosím Admina')->style('danger');
        case 'failBookmark':
            return $this->add(md5('failBookmark'),'Záložka neuložena zkuste to znovu, pokud se tato chyba bude opakovat kontaktujte Admina')->style('danger');
      
        
        case 'send':
            return $this->add(md5('send'),'Zpráva odeslána')->style('danger');
        case 'permission':
            return $this->add(md5('permission'),'Pro zobrazení se musíte <a href="/login"></br>Přihlásit</a> / <a href="/register">Registovat</a>')->style('danger');
        case 'hash':
            return $this->add(md5('hash'),'Pro změnu hesla je nutné ověřit e-mail')->style('danger');

        */
        }
    }
}
