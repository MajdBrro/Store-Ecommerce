<?php

use Illuminate\Contracts\Cache\Store;
use Illuminate\Session\Store as SessionStore;

define('PAGINATION_COUNT',25);
function getFolder(){
    return app()-> getLocale() === 'ar'? 'css-rtl' : 'css';
}
function uploadImage($folder,$image){
   $image-> Store('/', $folder);
   $filename= $image->hashName();
   return $filename;
}