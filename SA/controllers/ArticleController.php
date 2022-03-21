<?php

namespace Repse\Sa\controllers;

use HTMLPurifier;
use Envms\FluentPDO\Query;
use Repse\Sa\http\Request;
use Repse\Sa\support\MessageBag;

class ArticleController{

    public function __construct(protected Query $db,protected MessageBag $message, protected HTMLPurifier $purifier){}

   /**
    * use this fuction only if you dont have access to the database
    * @param Request $request
    * @return void for now
    */
    public function create(Request $request) : void
    {
        $values = [
            'chapter'=>(strlen($request->chapter) > 0) ? $request->chapter : null,
            'body'=>$this->purifier->purify($request->editor1),
            'pg_num'=>$request->page
        ];

        $this->db->insertInto($request->article,$values)->execute();
        $this->message->style('success')->add('PageCreated','Stránka úspěšně vyvořena, zmáčkněte F5');
    }

    public function update(Request $request) 
    {
        
        $values = [
            'chapter'=>(strlen($request->chapter) > 0) ? $request->chapter : null,
            'body'=>$this->purifier->purify($request->editor1)
        ];
        
        $this->db->update($request->article)->set($values)->where('pg_num',$request->page)->execute();
        $this->message->style('success')->add('PageUpdated','Stránka úspěšně upravena, zmáčkněte F5');
    }

    public function delete(Request $request)  : void
    {
        $this->db->deleteFrom($request->article)->where('pg_num',$request->page)->execute();
        $this->message->style('success')->add('PageDeleted','Stránka úspěšně smazána, zmáčkněte F5');
    }
   
}