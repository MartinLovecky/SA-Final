<?php

namespace Repse\Sa\support;

use Repse\Sa\tool\Selector;

class Messages {

    public array $messages = [];
    public ?string $style = null;
    public ?string $message = null;

    public function __construct(protected Selector $selector){}

    public function add(string $message)
    {
       $this->messages[] = $message;
    }

    public function getMessage()
    {
        if(!empty($this->messages)){
            foreach($this->messages as $key => $value){
                $qmessage = explode('.',$value);
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

    public function display()
    {
        return include_once(dirname(__DIR__,2).'/app/message.php');
    }

    public function getQueryMessage(){
       switch ($this->selector->fristQueryValue) {
        case 'failExist':
            return $this->messages[] = 'danger.Stránka nexistuje,Vytvořte jí <a  href="/create/'.$this->selector->article.'/'.$this->selector->page.'">/create/'.$this->selector->article.'/'.$this->selector->page.'</a>';
                break;
        case 'logged':
            return $this->messages[] = 'success.Přihlášení úspěšné';
                break;
        case 'created':
            return $this->messages[] = 'success.Stránka úspěšně vyvořena';
                break;                        
                /*
        
        case 'failUpdate':
            return $this->add(md5('failUpdate'),'Stránka neexistuje vytvořte jí pomocí /create')->style('danger');
                break;
        case 'updated':
            return $this->add(md5('updated'),'Stránka úspěšně upravena')->style('success');
                break;
        case 'deleted':
            return $this->add(md5('deleted'),'Stránka úspěšně smazána')->style('success');
                break;
        case 'savedBookmark':
            return $this->add(md5('savedBookmark'),'Záložka uložena')->style('success');
                break;
        case 'maxBookmarks':
            return $this->add(md5('maxBookmarks'),'Maximální počet záložek je 12, pokud chcete uložit novou nejprve musíte smazat jednu záložku')->style('danger');
                break;
        case 'check':
            return $this->add(md5('check'),'Registrací souhlasíte se smluvníma podmínkama a ochranou soukromí')->style('danger');
                break;
        case 'profilUpdate':
            return $this->add(md5('profilUpdate'),'Profil aktualizován')->style('success');
                break;
        case 'active':
            return $this->add(md5('active'),'Váš účet je aktivní můžete se přihlásit')->style('success');
                break;
        case 'failActive':
            return  $this->add(md5('failActive'),'Aktivace účtu se nezdaržila kotaktujte prosím Admina')->style('danger');
                break;
        case 'failBookmark':
            return $this->add(md5('failBookmark'),'Záložka neuložena zkuste to znovu, pokud se tato chyba bude opakovat kontaktujte Admina')->style('danger');
                break;
        case 'reset':
            return $this->add(md5('reset'),'Prosím zkotrolujte si Váš email')->style('success');
                break;
        case 'resetAccount':
            return $this->add(md5('resetAccount'),'Heslo změněno, můžete se přihlásit')->style('success');
                break;
        case 'send':
            return $this->add(md5('send'),'Zpráva odeslána')->style('danger');
                break;
        case 'joined':
            return $this->add(md5('joined'),'Registrace úspěšná, pro aktivovaní účtu zkotrolujte email')->style('success');
                break;
       
        case 'permission':
            return $this->add(md5('permission'),'Pro zobrazení se musíte <a href="/login"></br>Přihlásit</a> / <a href="/register">Registovat</a>')->style('danger');
        case 'hash':
            return $this->add(md5('hash'),'Pro změnu hesla je nutné ověřit e-mail')->style('danger');
                default: null;
        */
           
       }
    }
}