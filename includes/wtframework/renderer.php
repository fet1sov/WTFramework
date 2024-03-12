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
        // Avoiding XSS attack
        foreach ($data as $key => $value) {
            if (is_array($data[$key])) {
                $data[$key] = htmlspecialchars($data[$key]);
            }
        }

        extract($data);
        ob_start();
        try {
            require __DIR__ . "/templates/" . $path;
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
        // Avoiding XSS attack
        foreach ($data as $key => $value) {
            if (is_array($data[$key])) {
                $data[$key] = htmlspecialchars($data[$key]);
            }
        }

        extract($data);
        ob_start();
        try {
            require __DIR__ . "/templates/" . $path;
        } catch(Throwable $trow) {
            
        } finally {
            print(ob_get_clean()); 
        }
    }
}