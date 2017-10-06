<?php

namespace App\Markdown;

use Illuminate\Support\HtmlString;
use League\CommonMark\Block\Element\Heading;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;

class MarkdownConverter
{
    public static function convert($markdown)
    {
        $environment = Environment::createCommonMarkEnvironment();
        
        $environment->addBlockRenderer(Heading::class, new HeadingRenderer());

        $parser = new DocParser($environment);
        
        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($markdown);

        return new HtmlString(
            $htmlRenderer->renderBlock($document)
        );
    }
}
