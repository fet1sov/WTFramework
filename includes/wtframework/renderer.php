<?php

/**
*   renderer.php
*   Class for rendering 
*
*   @author fet1sov <prodaugust21@gmail.com>
*/

class Renderer { 

    /**
    * Make a template with data inside of it and returns HTML DOM Tree in string
    * @param string $path Relative path from templates folder 
    * @param array $data Associative array of data
    * @return string HTML Dom tree in string
    */
    public static function getRawTemplate($path, array $data = []) : ?string
    {
        extract($data);
        ob_start();
        try {
            require $_SERVER['DOCUMENT_ROOT'] . "/frontend/" . $path;
        } catch(Throwable $trow) {
            return null;
        } finally {
            return ob_get_clean(); 
        }
    }

    /**
    * Rendering the template with data
    * @param string $path Relative path from templates folder 
    * @param array $data Associative array of data
    */
    public static function includeTemplate($path, array $data = []) : void
    {
        extract($data);
        ob_start();
        try {
            require $_SERVER['DOCUMENT_ROOT'] . "/frontend/" . $path;
        } catch(Throwable $trow) {
            
        } finally {
            print(ob_get_clean()); 
        }
    }
}