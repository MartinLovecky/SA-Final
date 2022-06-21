<?php

namespace Repse\Sa\databese\story;

use Envms\FluentPDO\Query;
use Repse\Sa\tool\Selector;

/**
 * Gets specific article from database
 */
class Article
{
    public ?array $storyNames = [];
    public ?array $storyLinks = [];
    public ?array $storyDescription = [];
    public ?array $storyImage = [];
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
     * @return array
     */
    public function overview()
    {
        //FIXME: Need fix css for articlers.blade.php
        /**
         * If you want load from database
         * $stmt = $this->db->from('table.name');
         * $result = $stmt->fetchAll();
         * return $result;

         * foreach ($article->overview as $articleItem){
         *      $articleItem['img']; etc
         * }
         * ##############################################
         *  IF you want load from external source each image just hardcode it is best :D 
         * <img src="YOUR link" class="img-fluid" alt="img" />
         * 
         * IF you want use local storage without DB  or you can assure that external links have same structure only different predictable ending
         *  /public/image/folderToImages/previewXXX.png
         * for($i=0; $i < MAX; $i++){
         *     <img src="/public/image/folderToImages/preview{{$i}}.png" class="img-fluid" alt="img" />
         * } 
         */
        //gets array with information [$key=>'name.descript.linkToImg']
        $overviewData = require($_SERVER['DOCUMENT_ROOT'].'/app/storyOverview.php');
        foreach($overviewData as $key => $value){ 
            $split = explode('.', $value);
            /*
            $this->storyNames = $split;
            $this->storyLinks = $key;
            $this->storyDescription = $split[1];
            $this->storyImage = $split[2];
            */
            echo '<img src="/public/image/preview/story'.$split[2].'.jpg" class="img-fluid" alt="img" /><div class="col"><h3 class="name"><a href="/show/'.$key.'/1">'.$split[0].'</a></h3><p class="text-left description">'.$split[1].'</p></div>';
        }
    }
}
