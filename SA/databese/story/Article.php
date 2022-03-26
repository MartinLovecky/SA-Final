<?php

namespace Repse\Sa\databese\story;


use Envms\FluentPDO\Query;
use Repse\Sa\tool\Selector;

class Article
{
    public ?string $articleBody = null;
    public ?string $articleChapter = null;
  
    public function __construct(protected Query $db,protected Selector $selector){}

    public function getArticle(string $article, $page)
    {
        // non click able style="pointer-events: none; cursor: default;"
        $stmt = $this->db->from($article)->where('pg_num', $page);
        $row = $stmt->fetchAll('body', 'chapter');
        if (empty($row)) {
            header('Location: update/'.$article.'/'.$page.'?'.base64_encode('danger.failExist')); exit;
        } else {
            foreach ($row as $key => $value) {
                $this->articleBody = $value['body'];
                $this->articleChapter = $value['chapter'];
            return $this->articleBody;
            }
        }
    }
}
