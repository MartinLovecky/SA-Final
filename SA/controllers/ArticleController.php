<?php

namespace Repse\Sa\controllers;

use Envms\FluentPDO\Query;
use Repse\Sa\http\Request;

class ArticleController{

    public function __construct(protected Query $db){}

   /**
    * use this fuction only if you dont have access to the database
    * @param Request $request
    * @return void for now
    */
    public function create(Request $request) : void
    {
        $values = ['chapter'=>(isset($request->chapter)) ? $request->chapter : null,'body'=>$request->content,'pg_num'=>$request->page];
        $this->db->insertInto($request->article,$values)->execute();
    }

    public function update(Request $request) : void
    {
        $values = ['chapter'=>(isset($request->chapter)) ? $request->chapter : null,'body'=>$request->content];
        $this->db->update($request->article)->set($values)->where('pg_num',$request->page)->execute();
    }

    public function delete(Request $request)  : void
    {
        $this->db->deleteFrom($request->article)->where('pg_num',$request->page)->execute();
    }
   
}