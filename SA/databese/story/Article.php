<?php

namespace Repse\Sa\databese\story;

use Envms\FluentPDO\Query;
use Repse\Sa\tool\Selector;

/**
 * Gets specific article from database
 */
class Article
{
    public ?string $articleBody = null;
    public ?string $articleChapter = null;
  
    public function __construct(protected Query $db,protected Selector $selector){}

    public function getArticle(string $article, $page)
    {
        if($this->selector->action != 'create' || $this->selector->action != 'delete'){
        // non click able style="pointer-events: none; cursor: default;"
        $stmt = $this->db->from($article)->where('pg_num', $page);
        $row = $stmt->fetchAll('body', 'chapter');
        if (empty($row)) {
            header('Location: /update/'.'?action=failExist&params='.$article.'.'.$page); exit;
        } else {
            foreach ($row as $key => $value) {
                $this->articleBody = $value['body'];
                $this->articleChapter = $value['chapter'];
            return $this->articleBody;
            }
        }
    }
    }
}
