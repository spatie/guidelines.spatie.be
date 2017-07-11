<?php

namespace App\Navigation;

use Spatie\Menu\Laravel\Menu;
use Symfony\Component\Yaml\Yaml;

class Navigation
{
    /** @var \Illuminate\Support\Collection */
    private $sections;

    public static function create()
    {
        return new self();
    }

    public function scanContent()
    {
        $yaml = new Yaml();

        $baseNavigation = base_path('content/navigation.yml');
        $sections = glob(base_path('content/**/navigation.yml'));

        $this->sections = collect($baseNavigation)
            ->merge($sections)
            ->map(function ($path) use ($yaml) {
                return $yaml->parse(file_get_contents($path));
            });

        return $this;
    }

    public function menu()
    {
        return $this->buildMenu($this->sections);
    }

    private function buildMenu($items)
    {
        return Menu::build($items, function ($menu, $section) {
            return $menu->submenu(
                ...$this->buildSection($section)
            );
        });
    }

    private function buildSection($section)
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