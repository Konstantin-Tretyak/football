<?php
// \Controllers\Base::dsfdsf()

class BaseController 
{
    public static function get_current_page_num()
    {
        return ( isset($_GET['N']) && is_numeric($_GET['N']) ) ? $_GET['N'] : 1;
    }
}