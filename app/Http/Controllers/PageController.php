<?php

namespace App\Http\Controllers;

use App\Markdown\MarkdownConverter;
use Illuminate\Support\HtmlString;
use Spatie\YamlFrontMatter\Parser;

class PageController
{
    public function __invoke($url)
    {
        abort_unless($page = app('navigation')->getPage($url), 404);

        return view('page', [
            'contents' => MarkdownConverter::convert($page),
        ]);
    }
}
