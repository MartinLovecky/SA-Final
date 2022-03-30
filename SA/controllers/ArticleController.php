<?php

namespace Repse\Sa\controllers;

use HTMLPurifier;
use Envms\FluentPDO\Query;
use Repse\Sa\http\Request;

class ArticleController{

    public function __construct(protected Query $db, protected HTMLPurifier $purifier){}

   /**
    * use this fuction only if you dont have access to the database
    * @param Request $request
    */
    public function create(Request $request) 
    {
        $values = [
            'chapter'=>(strlen($request->chapter) > 0) ? $request->chapter : null,
            'body'=>$this->purifier->purify($request->editor1),
            'pg_num'=>$request->page
        ];

       $this->db->insertInto($request->article,$values)->execute();

       if($request->submit == 'submit'){ 
            header("Location: /update?action=created"); die;
        }
    }

    public function update(Request $request) 
    {
        $values = [
            'chapter'=>(strlen($request->chapter) > 0) ? $request->chapter : null,
            'body'=>$this->purifier->purify($request->editor1)
        ];
        
        $this->db->update($request->article)->set($values)->where('pg_num',$request->page)->execute();
        
        if($request->submit == 'submit'){ 
            header("Location: /update?action=updated"); die;
        }
    }

    public function delete(Request $request)  : void
    {
        $this->db->deleteFrom($request->article)->where('pg_num',$request->page)->execute();
        
        if($request->submit == 'submit'){ 
            header("Location: /update?action=deleted"); die;
        }
    }
   
}