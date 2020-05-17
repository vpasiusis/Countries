<?php


class sorting
{
    public function sort($data)
    {
        if (isset($_GET['sortByNameAZ'])) {
            usort($data, function ($a, $b) {
                return strtolower($a["name"]) <=> strtolower($b["name"]);
            });
        }
        if (isset($_GET['sortByNameZA'])) {
            usort($data, function ($a, $b) {
                return strtolower($b["name"]) <=> strtolower($a["name"]);
            });

        }
        return $data;
    }
}