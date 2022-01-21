<?php

namespace Repse\Sa\support;

use Repse\Sa\support\MessageBag;

class QueryMessages extends MessageBag{

    public function setActionMessage($queryMessage){
       switch ($queryMessage) {
        case 'failExist':
           return $this->add(md5('failExist'),'Stránka již existuije použijte /update')->style('danger');
                break;
        case 'created':
            return $this->add(md5('created'),'Stránka úspěšně vyvořena')->style('success');
                break;
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
        case 'logged':
            return $this->add(md5('logged'),'Přihlášení úspěšné')->style('success');
                break;
        case 'permission':
            return $this->add(md5('permission'),'Pro zobrazení se musíte <a href="/login"></br>Přihlásit</a> / <a href="/register">Registovat</a>')->style('danger');
        case 'hash':
            return $this->add(md5('hash'),'Pro změnu hesla je nutné ověřit e-mail')->style('danger');
                default: null;
           
       }
    }
}