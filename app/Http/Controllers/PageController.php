<?php

namespace App\Http\Controllers;

use App\Markdown\MarkdownConverter;
use Illuminate\Support\HtmlString;
use Spatie\YamlFrontMatter\Parser;

class PageController extends Controller
{
    public function __invoke($url)
    {
        abort_unless($page = app('navigation')->getPage($url), 404);

        return view('page', [
            'title' => $page->title,
            'contents' => MarkdownConverter::convert($page->contents),
        ]);
    }
}
