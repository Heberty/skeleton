<?php

namespace Helper;

use Mix\Router\Router;

class LayoutHelper
{
    private static $instance              = null;
    private static $showPageHeader        = true;
    private static $showBreadcrumbInitial = true;
    private static $breadcrumb;
    private static $interna               = true;

    private static $data = [
        'page-header' => ''
    ];

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new LayoutHelper();
        }

        return self::$instance;
    }

    public static function setInterna($interna)
    {
        self::$interna = $interna;
    }

    public static function isInterna()
    {
        return self::$interna;
    }

    public static function getBreadcrumbs()
    {
        if (self::$showBreadcrumbInitial && !isset(self::$breadcrumb)) {
            self::$breadcrumb = [
                [
                    'title' => __('Inicial'),
                    'url' => Router::getRouteUrl('home')
                ]
            ];
        }

        return (array)self::$breadcrumb;
    }

    public static function addBreadcrumbs(array $items)
    {
        self::$breadcrumb = array_merge(
            self::getBreadcrumbs(),
            $items
        );
    }

    public static function addBreadcrumb(array $item)
    {
        self::$breadcrumb = array_merge(
            self::getBreadcrumbs(),
            [$item]
        );
    }

    public static function renderBreadcrumb()
    {
        $breadcrumbs = self::getBreadcrumbs();
        $totalItems = count($breadcrumbs);

        if ($totalItems == 0 || (self::$showBreadcrumbInitial && $totalItems <= 1)) {
            return '';
        }

        $output = '<ol class="breadcrumb">';
        foreach ($breadcrumbs as $i => $item) {
            $active = ($i == $totalItems - 1) ? 'active' : '';
            $wraper = isset($item['url']) && $item['url'] ? '<a href="' . $item['url'] . '">' . $item['title'] . '</a>' : $item['title'];
            $output .= '<li class="breadcrumb-item ' . $active . '"><span>' . $wraper . '</span></li>';
        }
        $output .= '</ol>';

        return $output;
    }

    public static function setPageHeader($data)
    {
        return self::$data['page-header'] = $data;
    }

    public static function getPageHeader()
    {
        return self::$data['page-header'];
    }

    public static function showPageHeader()
    {
        return self::$showPageHeader;
    }

    public static function disablePageHeader()
    {
        self::$showPageHeader = false;
    }

    public static function disableBreadcrumbInitial()
    {
        self::$showBreadcrumbInitial = false;
    }
}
