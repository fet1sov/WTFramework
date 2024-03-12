<?php

/**
*   router.php
*   Class for make path routing in web app
*
*   @author fet1sov <prodaugust21@gmail.com>
*/
class Router
{
    private function addRoute($file, $route){
        if(!empty($_REQUEST['uri'])){
            $route = preg_replace("/(^\/)|(\/$)/","",$route);
            $reqUri =  preg_replace("/(^\/)|(\/$)/","",$_REQUEST['uri']);
        }else{
            $reqUri = "/";
        }

        if($reqUri == $route){
            $params = [];
            include($file);
            exit();
        }

    }

    /**
    * Add the route with params
    * @param string $route Web path
    * @param string $file PHP Script which will be executed by path
    */
    public function add($route, $file) {
        $params = [];

        $paramKey = [];

        preg_match_all("/(?<={).+?(?=})/", $route, $paramMatches);

        if(empty($paramMatches[0])){
            $this->addRoute($file,$route);
            return;
        }

        foreach($paramMatches[0] as $key){
            $paramKey[] = $key;
        }


        if(!empty($_REQUEST['uri'])){
            $route = preg_replace("/(^\/)|(\/$)/","",$route);
            $reqUri =  preg_replace("/(^\/)|(\/$)/","",$_REQUEST['uri']);
        }else{
            $reqUri = "/";
        }

        $uri = explode("/", $route);
        $indexNum = []; 

        foreach($uri as $index => $param){
            if(preg_match("/{.*}/", $param)){
                $indexNum[] = $index;
            }
        }

        $reqUri = explode("/", $reqUri);

        foreach($indexNum as $key => $index) {
            if(empty($reqUri[$index])) {
                return;
            }

            $params[$paramKey[$key]] = $reqUri[$index];

            $reqUri[$index] = "{.*}";
        }

        $reqUri = implode("/",$reqUri);
        $reqUri = str_replace("/", '\\/', $reqUri);

        if(preg_match("/$reqUri/", $route))
        {
            include($file);
            exit();
        }
    }
}