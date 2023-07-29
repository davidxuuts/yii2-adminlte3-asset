<?php
/*
 * Copyright (c) 2023.
 * @author David Xu <david.xu.uts@163.com>
 * All rights reserved.
 */

namespace davidxu\adminlte3\widgets;

use Exception;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
/**
 * Class Menu
 * Theme menu widget.
 */
class Menu extends \yii\widgets\Menu
{
    /**
     * {@inheritdoc}
     */
    public $linkTemplate = '<a class="nav-link {active}" href="{url}">{icon} {label}</a>';
    /**
     * {@inheritdoc}
     * Styles all labels of items on sidebar by AdminLTE
     */
    public $labelTemplate = '<p>{label} {badge} {submenu}</p>';
    /**
     * {@inheritdoc}
     */
    public $submenuTemplate = "\n<ul class='nav nav-treeview'>\n{items}\n</ul>\n";
    /**
     * {@inheritdoc}
     */
    public $activateParents = true;
    public string $defaultIconHtml = '<i class="fas fa-circle nav-icon"></i> ';
    /**
     * {@inheritdoc}
     */
    public $options = ['class' => 'nav nav-pills nav-sidebar flex-column', 'data-widget' => 'treeview'];

    /**
     * @var string is type that will be added to $item['icon'] if it exist.
     * Font Awesome 5 added different icon types instead of everything starting with "fas fa-"
     * Possible types are fab (brand), fas (solid), far (regular), fal (light).
     * Some of them are only available for pro version of FA so check the https://fontawesome.com website
     * @since 3.0
     */
    public static string $iconClassType = 'fas';
    /** @var string */
    public static string $iconClassPrefix = 'fa-';

    private string|bool $noDefaultAction;
    private string|bool $noDefaultRoute;

    /**
     * Renders the menu.
     * @throws Exception
     */
    public function run()
    {
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
        $posDefaultAction = strpos($this->route, Yii::$app->controller->defaultAction);
        if ($posDefaultAction) {
            $this->noDefaultAction = rtrim(substr($this->route, 0, $posDefaultAction), '/');
        } else {
            $this->noDefaultAction = false;
        }
        $posDefaultRoute = strpos($this->route, Yii::$app->controller->module->defaultRoute);
        if ($posDefaultRoute) {
            $this->noDefaultRoute = rtrim(substr($this->route, 0, $posDefaultRoute), '/');
        } else {
            $this->noDefaultRoute = false;
        }
        $items = $this->normalizeItems($this->items, $hasActiveChild);
        if (!empty($items)) {
            $options = $this->options;
            $tag = ArrayHelper::remove($options, 'tag', 'ul');

            echo Html::tag($tag, $this->renderItems($items), $options);
        }
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    protected function renderItem($item)
    {
        if($item['header']) {
            return $item['label'];
        }

        $submenu = '';

        if (isset($item['items'])) {
            $submenu = '<i class="right fas fa-angle-left"></i>';
            $labelTemplate = '<a class="nav-link ' . ($item['active'] ? 'active' : '') . '" href="{url}">{icon} {label}</a>';
            $linkTemplate = '<a class="nav-link ' . ($item['active'] ? 'active' : '') . '" href="{url}">{icon} {label}</a>';
        } else {
            $labelTemplate = $this->labelTemplate;
            $linkTemplate = $this->linkTemplate;
        }

        if (empty($item['icon'])) {
            $icon = $this->defaultIconHtml;
        } else {
            if (isset($item['iconType'])) {
                $icon = '<i class="nav-icon ' . $item['iconType'] . ' ' . static::$iconClassPrefix . $item['icon'] . '"></i> ';
            } else {
                if (count(explode(' ', $item['icon'])) > 1) {
                    $icon = '<i class="nav-icon ' . $item['icon'] .'"></i> ';
                } else {
                    $icon = '<i class="nav-icon ' . static::$iconClassType . ' ' . static::$iconClassPrefix . $item['icon'] . '"></i> ';
                }
            }
        }
        $replacements = [
            '{label}' => strtr($this->labelTemplate, ['{label}' => $item['label'], '{badge}' => $item['badge'], '{submenu}' => $submenu]),
//            '{icon}' => empty($item['icon']) ? $this->defaultIconHtml
//                : '<i class="nav-icon ' . ($item['iconType'] ?? static::$iconClassType) . ' ' . static::$iconClassPrefix . $item['icon'] . '"></i> ',
            '{icon}' => $icon,
//            '{icon}' => empty($item['icon']) ? $this->defaultIconHtml
//                : '<i class="nav-icon ' . ($item['iconType'] ?? static::$iconClassType) . ' ' . static::$iconClassPrefix . $item['icon'] . '"></i> ',

            '{url}' => isset($item['url']) ? Url::to($item['url']) : 'javascript:void(0);',
            '{active}' => $item['active'] ? $this->activeCssClass : '',
            // If item doesn't have url, make sure these placeholders get removed from output
            '{badge}' => '',
            '{submenu}' => ''
        ];

        $template = ArrayHelper::getValue($item, 'template', isset($item['url']) ? $linkTemplate : $labelTemplate);

        return strtr($template, $replacements);
    }

    /**
     * Recursively renders the menu items (without the container tag).
     * @param array $items the menu items to be rendered recursively
     * @return string the rendering result
     * @throws Exception
     */
    protected function renderItems($items): string
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {
            $itemValues = ArrayHelper::getValue($item, 'options', []);
            if ($itemValues == null) {
                $itemValues = [];
            }
            $options = array_merge($this->itemOptions, $itemValues);
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = $item['header'] ? ['nav-header'] : ['nav-item'];
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            if (!empty($class)) {
                if (empty($options['class'])) {
                    $options['class'] = implode(' ', $class);
                } else {
                    $options['class'] .= ' ' . implode(' ', $class);
                }
            }
            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {
                $menu .= strtr($this->submenuTemplate, [
                    '{items}' => $this->renderItems($item['items']),
                ]);
				if (isset($options['class'])) {
					$options['class'] .= ' treeview';
				} else {
					$options['class'] = 'treeview';
				}
                if($item['active']) {
                    $options['class'] .= ' menu-open';
                }
            }
            $lines[] = Html::tag($tag, $menu, $options);
        }
        return implode("\n", $lines);
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    protected function normalizeItems($items, &$active): array
    {
        foreach ($items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
            if (!isset($item['label'])) {
                $item['label'] = '';
            }
            $encodeLabel = $item['encode'] ?? $this->encodeLabels;
            $items[$i]['label'] = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $items[$i]['icon'] = $item['icon'] ?? '';
            $items[$i]['header'] = ArrayHelper::getValue($item, 'header', false);
            $items[$i]['badge'] = $item['badge'] ?? '';
            $hasActiveChild = false;
            if (isset($item['items'])) {
                $items[$i]['items'] = $this->normalizeItems($item['items'], $hasActiveChild);
                if (empty($items[$i]['items']) && $this->hideEmptyItems) {
                    unset($items[$i]['items']);
                    if (!isset($item['url'])) {
                        unset($items[$i]);
                        continue;
                    }
                }
            }
            if (!isset($item['active'])) {
                if ($this->activateParents && $hasActiveChild || $this->activateItems && $this->isItemActive($item)) {
                    $active = $items[$i]['active'] = true;
                } else {
                    $items[$i]['active'] = false;
                }
            } elseif ($item['active']) {
                $active = true;
            }
        }
        return array_values($items);
    }

    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return boolean whether the menu item is active
     */
    protected function isItemActive($item): bool
    {
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = $item['url'][0];
            if (isset($route[0]) && $route[0] !== '/' && Yii::$app->controller) {
                $route = ltrim(Yii::$app->controller->module->getUniqueId() . '/' . $route, '/');
            }
            $route = ltrim($route, '/');
            if ($route != $this->route && $route !== $this->noDefaultRoute && $route !== $this->noDefaultAction) {
                return false;
            }
            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                foreach (array_splice($item['url'], 1) as $name => $value) {
                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }
            return true;
        }
        return false;
    }
}
