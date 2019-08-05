<?php

namespace BugTracker\Http\Router;

use BugTracker\Http\Interfaces\Page;
use BugTracker\Views\Pages\PageNotFound;
use BugTracker\Http\BasePage;
use BugTracker\Http\Request;
use BugTracker\Exceptions\WrongArgumentException;
use BugTracker\Util\BugString;
use BugTracker\Util\FileHandler;

class Router {

    public $defaultPage = null;
    public $basePage = null;
    private static $pages = [];
    private static $redirectURLs = [];
    private $html = "";
    private $page = null;

    public function __construct() {
        $this->defaultPage = new PageNotFound();
        $this->basePage = new BasePage();
    }

    public function LoadPage() 
    {
        $path = BugString::SanitizeURL($_SERVER["REQUEST_URI"]);

        $page = $this->defaultPage;

        //if redirect
        if(\array_key_exists($path, self::$redirectURLs)) {
            header("Location: " . self::$redirectURLs[$path]);
            exit(); //stop script execution immediately
        }

        //else if page is registered
        if(\array_key_exists($path, self::$pages)) {
            $page = self::$pages[$path];
        } 
        
        $page->OnLoad(new Request($path));

        $this->page = $page;
        //$this->html = FileHandler::LoadFile(self::TEMPLATES_PATH . $page->GetTemplate()); //file_get_contents(self::TEMPLATES_PATH . $page->GetTemplate());
    }

    public function ShowPage() {
        // $page = $this->page;
        // $page->title = ($page->title ?? self::DEFAULT_TITLE) . self::BASE_TITLE;
        // $arr = $page->GetReplaceValues();

        $this->page->OnRequire();
        $this->page->Require();
    }

    public static function RegisterURL(string $url, Page $callbackClass) : void {
        self::registerURLInternally($url, self::$pages, $callbackClass);
    }

    public static function RegisterRedirect(string $url, string $newUrl) : void {
        self::registerURLInternally($url, self::$redirectURLs, $newUrl);
    }

    /**
     * Register an url in the specified array
     *
     * @param string $url The url to listen for
     * @param array $arr A reference to the array
     * @param [type] $value The value to save
     * @return void
     */
    private static function registerURLInternally(string $url, array &$arr, $value) {
        $url = BugString::SanitizeURL($url);
        if(self::urlIsRegistered($url)) {
            throw new WrongArgumentException("URL is already in use");
        }

        $arr[$url] = $value;
    }

    private static function urlIsRegistered(string $url) : bool {
        return \array_key_exists($url, self::$pages) || \array_key_exists($url, self::$redirectURLs);
    }

}