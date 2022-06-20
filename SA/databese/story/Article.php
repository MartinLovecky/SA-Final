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

    /**
     * Gets exact page of story (for story.blade)
     *
     * @param string $article must be set and must have  database column
     * @param [int] $page is having same fuction like ID
     * @param [string] $articleChapter is empty string or some [string]
     * @return var $articleBody is empty string or some [string]
     */
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
    /**
     * //ANCHOR: this fuction should be easy. I don't have so much time now but I hope make some progress
     *
     * @return string
     */
    public function overview()
    {
        //TODO: show image for each article [image can load friom server or external link]
        //TODO: show short description of the article [?hardcoded or stored in database]
        //TODO: show clickable link to the article [?hardcoded(dynamicly possible) or stored in database]
    }
}
