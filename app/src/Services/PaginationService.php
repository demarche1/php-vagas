<?php

namespace Root\Html\Services;

class PaginationService
{
    private $totalPages;
    private $limit;
    private $currentPage;
    private $results;

    public function __construct($results, $currentPage = 1, $limit = 10)
    {
        $this->results     = $results;
        $this->limit       = $limit;
        $this->currentPage = (is_numeric($currentPage) && $currentPage > 0) ? $currentPage : 1;
        $this->calculatePages();
    }

    private function calculatePages()
    {
        $this->totalPages  = $this->results > 0 ? ceil($this->results / $this->limit) : 1;
        $this->currentPage = $this->currentPage <= $this->totalPages ? $this->currentPage : $this->totalPages;
    }

    public function getLimit()
    {
        $offset = ($this->limit * ($this->currentPage - 1));

        return "$offset, $this->limit";
    }

    public function getPages()
    {
        if ($this->totalPages == 1) return [];

        $pages = [];

        for ($i = 1; $i <= $this->totalPages; $i++) {
            $pages[] = [
                "page"        => $i,
                "currentPage" => $i == $this->currentPage,
            ];
        }

        return $pages;
    }
}