<?php
class Paginator
{
    private $total_count;
    private $total_parts;
    private $base_url;
    private $current_part;

    /*
     * this class takes two arguments: 'totalCount' & 'perPageItemCount' and returns some links
     *
     * each page which using this class may contains some parameters on it's query string,
     *      thus they will not destroy.
     *      just the `part` paramenter will append after each link
     *
     */


    public function __construct($total_count, $per_page_count)
    {
        $this->total_count = $total_count;
        $this->current_part = isset($_GET['part']) ? (int)$_GET['part'] : 1;
        $this->total_parts = ceil($total_count / $per_page_count);

        if ( isset($_GET['part']) )
            $this->base_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        else if (!preg_match("/\?/i", $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']))
            $this->base_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "?part=1";

        else
            $this->base_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "&part=1";
    }

    public function showLinks()
    {
        $str = "<div class='d-flex justify-content-center my-4'><div class='pagination paginadtion-sm'>";

        if ($this->total_count > 0) {

            // prev page
            if ($this->current_part == 1) {
                $str .= "<li class='page-item disabled'><a class='page-link' href='#'><i class='fa fa-angle-double-right'></i></a></li>";
            } else if ($this->current_part > 1) {

                if (preg_match("/\?part=[0-9]+/i", $this->base_url))
                    $url = preg_replace("/\?part=[0-9]+/i", "?part=".($this->current_part - 1), $this->base_url);
                else
                    $url = preg_replace("/&part=[0-9]+/i", "&part=".($this->current_part - 1), $this->base_url);

                $str .= "<li class='page-item'><a class='page-link' href='{$url}'><i class='fa fa-angle-double-right'></i></a></li>";

            }

            // middle pages
            for ($i = 1; $i <= $this->total_parts; $i++) {

                $active = ($i == $this->current_part) ? "active" : "";

                if (preg_match("/\?part=[0-9]+/i", $this->base_url))
                    $url = preg_replace("/\?part=[0-9]+/i", "?part={$i}", $this->base_url);
                else
                    $url = preg_replace("/&part=[0-9]+/i", "&part={$i}", $this->base_url);

                $str .= "<li class='page-item {$active}'><a class='page-link' href='{$url}'>{$i}</a></li>";

            }

            // next page
            if ($this->current_part == $this->total_parts) {
                $str .= "<li class='page-item disabled'><a class='page-link' href='#'><i class='fa fa-angle-double-left'></i></a></li>";
            } else if ($this->current_part < $this->total_parts) {

                if (preg_match("/\?part=[0-9]+/i", $this->base_url))
                    $url = preg_replace("/\?part=[0-9]+/i", "?part=".($this->current_part + 1), $this->base_url);
                else
                    $url = preg_replace("/&part=[0-9]+/i", "&part=".($this->current_part + 1), $this->base_url);

                $str .= "<li class='page-item'><a class='page-link' href='{$url}'><i class='fa fa-angle-double-left'></i></a></li>";

            }

        }

        echo $str . "</div></div>";
    }

}