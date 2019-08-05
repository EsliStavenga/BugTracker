<?php

namespace BugTracker\Http;

use BugTracker\Util\FileHandler;

class BasePage
{

    public $title = "BugTracker";

    protected $template = "404.php";
    protected $pageVariables = [];
    
    private const BASE_TITLE = " &middot; BugTracker";

    public function Require() : void {
        $this->title .= self::BASE_TITLE;
        $this->pageVariables["page"] = $this;

        FileHandler::RequireFile(FileHandler::HEADER_PATH, ["page" => $this]);
        FileHandler::RequireFile(FileHandler::TEMPLATES_PATH . $this->template, $this->pageVariables);
        FileHandler::RequireFile(FileHandler::FOOTER_PATH);
    }

}