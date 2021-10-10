<?php

namespace Repse\Sa\databese\story;

use Repse\Sa\databese\DB;
use Repse\Sa\support\MessageBag;

class Article
{

    public string $articleBody;
    public string $articleChapter;
  
    public function __construct(protected $db, protected MessageBag $message){}

    public function getArticle($article, $page)
    {
        $stmt = $this->db->from($article)->where('pg_num', $page);
        $row = $stmt->fetchAll('body', 'chapter');
        if (empty($row)) {
            $this->message->style('danger')->add('danger', 'Stránka '.$article.'/'.$page.' nexistuje. Vytvořte jí <a style="pointer-events: none; cursor: default;" href="/create/'.$article.'/'.$page.'">/create/'.$article.'/'.$page.'</a>');
        } else {
            foreach ($row as $key => $value) {
                $this->articleBody = $value['body'];
                $this->articleChapter = $value['chapter'];
                if (empty($this->articleBody)) {
                    $this->message->style('danger')->add('danger1', 'Stránka '.$article.'/'.$page.' nemá žádný obsah. Upravit jí můžete <a style="pointer-events: none; cursor: default;" href="/create/'.$article.'/'.$page.'">/update/'.$article.'/'.$page.'</a>');
                }
                return $this->articleBody;
            }
        }
    }
}
