<?php

namespace App\Navigation;

use Illuminate\Support\Facades\Auth;
use Spatie\Menu\Laravel\Menu;
use Symfony\Component\Yaml\Yaml;

class Navigation
{
    /** @var \Illuminate\Support\Collection */
    private $sections;

    public function scanContent()
    {
        $yaml = new Yaml();

        $baseNavigation = base_path('content/navigation.yml');
        $sections = glob(base_path('content/**/navigation.yml'));

        $this->sections = collect($baseNavigation)
            ->merge($sections)
            ->mapWithKeys(function ($path) use ($yaml) {
                $properties = $yaml->parse(file_get_contents($path));

                return [
                    dirname($path) => [
                        'section' => $properties['section'] ?? null,
                        'items' => $properties['items'],
                        'protected' => $properties['protected'] ?? false,
                    ],
                ];
            });

        return $this;
    }

    public function getPage($url)
    {
        $path = base_path("content/{$url}.md");

        if (! $this->isVisible($path)) {
            return null;
        }

        return @file_get_contents($path) ?: null;
    }

    private function isVisible($pagePath)
    {
        if (Auth::check()) {
            return true;
        }

        $section = dirname($pagePath);

        if (! $this->sections->has($section)) {
            return false;
        }
        
        return ! $this->sections[$section]['protected'];
    }
    
    public function menu()
    {
        return $this->buildMenu($this->sections);
    }

    private function buildMenu($items)
    {
        $menu = Menu::build($items, function ($menu, $section) {
            if ($section['protected'] && ! Auth::check()) {
                return;
            }

            return $menu->submenu(
                ...$this->buildSectionSubmenu($section)
            );
        });

        $menu->setActiveFromRequest();

        return $menu;
    }

    private function buildSectionSubmenu($section)
    {
        [$items, $title] = collect($section)->extract('items', 'section');

        $submenu = Menu::build($items, function ($menu, $item) use ($title) {
            $url = $title ? '/'.str_slug($title).'/'.str_slug($item) : '/'.str_slug($item);
            $menu->link($url, $item);
        });

        if (empty($title)) {
            return [$submenu];
        }

        return [$title, $submenu];
    }
}
