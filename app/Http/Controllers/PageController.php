<?php

namespace App\Http\Controllers;

class PageController
{
    public function __invoke($url)
    {
        dd($url);
    }
}