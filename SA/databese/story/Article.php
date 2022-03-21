<?php

namespace Repse\Sa\databese\story;


use Envms\FluentPDO\Query;
use Repse\Sa\tool\Selector;
use Repse\Sa\support\MessageBag;

class Article
{

    public ?string $articleBody = null;
    public ?string $articleChapter = null;
  
    public function __construct(protected Query $db, protected MessageBag $message,protected Selector $selector){}

    public function getArticle(string $article, $page)
    {
        // non click able style="pointer-events: none; cursor: default;"
        $stmt = $this->db->from($article)->where('pg_num', $page);
        $row = $stmt->fetchAll('body', 'chapter');
        if (empty($row)) {
            $this->message->style('danger')->add('danger', 'Stránka '.$article.'/'.$page.' nexistuje. Vytvořte jí <a  href="/create/'.$article.'/'.$page.'">/create/'.$article.'/'.$page.'</a>');
        } else {
            foreach ($row as $key => $value) {
                $this->articleBody = $value['body'];
                $this->articleChapter = $value['chapter'];
                if (empty($this->articleBody)) {
                    if($this->selector->action != 'update' || $this->selector->action != 'delete'){
                    $this->message
                    ->style('danger')
                    ->add('danger1', 'Stránka '.$article.'/'.$page.' nemá žádný obsah. Upravit jí můžete <a href="/update/'.$article.'/'.$page.'">/update/'.$article.'/'.$page.'</a>');
                    }
                }
                return $this->articleBody;
            }
        }
    }
}
