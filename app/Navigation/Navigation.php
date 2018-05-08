<?php

namespace App\Navigation;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use Spatie\Menu\Laravel\Menu;
use Spatie\Sheets\Sheet;
use Spatie\Sheets\Sheets;
use Symfony\Component\Yaml\Yaml;

class Navigation
{
    /** @var \Spatie\Sheets\Sheets */
    private $filesystem;

    /** @var \Spatie\Sheets\Sheets */
    private $sheets;

    /** @var \Symfony\Component\Yaml\Yaml */
    private $yaml;

    public function __construct(Filesystem $filesystem, Sheets $sheets, Yaml $yaml)
    {
        $this->filesystem = $filesystem;
        $this->sheets = $sheets;
        $this->yaml = $yaml;
    }

    public function getPage($url)
    {
        return $this->sheets->get($url);
    }

    public function menu()
    {
        $menu = Menu::build($this->sections(), function ($menu, $section) {
            return $menu->submenu(
                ...$this->buildSectionSubmenu($section)
            );
        });

        return $menu
            ->addClass('menu')
            ->addItemParentClass('menu__section')
            ->setActiveClass('-active')
            ->setActiveFromRequest();
    }

    private function sections(): array
    {
        $sections = $this->yaml->parse(
            $this->filesystem->get('navigation.yml')
        );

        if (Auth::check()) {
            $privateSections = $this->yaml->parse(
                $this->filesystem->get('private/navigation.yml')
            );

            $sections = array_merge($sections, $privateSections);
        }

        return $sections;
    }

    private function buildSectionSubmenu($section)
    {
        $items = $this->sheets->all()->filter(function (Sheet $sheet) use ($section) {
            return starts_with($sheet->slug, "{$section['slug']}/");
        })->sortBy('order');

        $submenu = Menu::build($items, function ($menu, $item) {
            $menu->link(url($item->slug), $item->title);
        });

        $submenu
            ->addClass('menu__submenu')
            ->addItemParentClass('menu__item js-sidebar-hide')
            ->setActiveClass('-active');

        return [
            "<span class=menu__subtitle>{$section['title']}</span>",
            $submenu
        ];
    }
}
