<?php
define('PAGINATION_COUNT',25);
function getFolder(){
    return app()-> getLocale() === 'ar'? 'css-rtl' : 'css';
}