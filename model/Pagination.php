<?php
class Pagination
{
    public function __construct($limit, $total_count, $page = null)
    {
        $this->limit = $limit;
        $this->total_count = $total_count;

        // TODO: remove hardcode
        $this->page = $page ? $page : $this->page();
    }

    public function pages_quantity()
    {
        return ceil($this->total_count / $this->limit);
    }

    public function has_prev()
    {
        return $this->page > 1;
    }

    public function has_next()
    {
        return $this->page < $this->pages_quantity();
    }

    public function page($namber=1)
    {
        if ( isset($_GET['N']) )
        {
            if ( is_numeric($_GET['N']) && (int)$_GET['N'] < $this->pages_quantity()+1)
                return (int) $_GET['N'];
            else
                throw new NotFoundException();
        }
        else
        {
            return 1;
        }
    }

}