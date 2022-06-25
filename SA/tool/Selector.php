<?php

namespace Repse\Sa\tool;

class Selector
{
    protected array $url = [];
    protected ?array $queryArray = null;
    public ?string $viewName = null;
    public ?string $action = null;
    public ?string $article = null;
    public ?string $page = null;
    public ?string $fristQueryValue = null;
    public ?string $secondQueryValue = null;
    public ?string $title = null;
    public $file = null;
    public array $allowedViews = [];

    public function __construct()
    {
        # url[0] = allways empty string
        $this->url = explode('/', trim(str_replace(['<','>','!','@','$'], '', urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)))));
        $this->queryArray = isset($_SERVER['QUERY_STRING']) ? explode('=', $_SERVER['QUERY_STRING']) : null;
        $this->action = isset($this->url[1]) ? $this->url[1] : $this->action;
        $this->article = isset($this->url[2]) ? $this->url[2] : $this->article;
        $this->page = isset($this->url[3]) ? $this->url[3] : $this->page;
        $this->fristQueryValue = !empty($this->queryArray[0]) ? filter_input(INPUT_GET, trim($this->queryArray[0])) : $this->fristQueryValue;
        $this->secondQueryValue = isset($this->queryArray[1]) ? filter_input(INPUT_GET, trim(str_replace('&', '', strpbrk($this->queryArray[1], '&')))) : $this->secondQueryValue;
    }

    public function viewName(): void
    {
        if (in_array($this->url[1], $this->allowedViews)) {
            switch ($this->url[1]) {
                case '':
                    $this->viewName = 'index';
                    $this->title = 'SA | index';
                break;
                case 'update':
                case 'delete':
                case 'create':
                    $this->viewName = 'editor';
                    $this->title = 'SA | '.$this->url[1].' | '.$this->article ?? $this->article;
                break;   
                case $this->url[1]:
                    $this->viewName = $this->url[1];
                    $this->title = 'SA | '.$this->url[1].' | '.$this->article ?? $this->article;
                break;
            }
        }
        elseif ($this->url[1] == 'StarAdventure') {
            $this->viewName = 'index';
            $this->title = 'SA | index';
        }
        else{
            # If page is not allowed 404
            $this->viewName = '404';
            $this->title = 'SA | 404';
        }
    }
}