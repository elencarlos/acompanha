<?php
/**
 * Created by PhpStorm.
 * User: flavio
 * Date: 29/04/16
 * Time: 15:30
 */

namespace UFT\TemaBundle\Model;


use Avanzu\AdminThemeBundle\Model\MenuItemInterface;

class MenuItemModel implements MenuItemInterface
{

    /**
     * @var mixed
     */
    protected $identifier;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $route;

    /**
     * @var array
     */
    protected $routeArgs = array();
    /**
     * @var bool
     */
    protected $isActive = false;
    /**
     * @var array
     */
    protected $children = array();

    /**
     * @var mixed
     */
    protected $icon = false;

    /**
     * @var mixed
     */
    protected $badge = false;

    protected $badgeColor = 'green';

    /**
     * @var MenuItemInterface
     */
    protected $parent = null;

    /**
     * @var mixed
     */
    protected $routeAcess = null;

    function __construct(
        $id,
        $label,
        $route,
        $routeArgs = array(),
        $icon = false,
        $badge = false,
        $badgeColor = 'green',
        $routeAcess = 'IS_AUTHENTICATED_ANONYMOUSLY'
    )
    {
        $this->badge = $badge;
        $this->icon = $icon;
        $this->identifier = $id;
        $this->label = $label;
        $this->route = $route;
        $this->routeArgs = $routeArgs;
        $this->badgeColor = $badgeColor;
        $this->routeAcess = $routeAcess;
    }

    /**
     * @return mixed
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * @param mixed $badge
     *
     * @return $this
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;

        return $this;
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param array $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     *
     * @return $this
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param mixed $identifier
     *
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     *
     * @return $this
     */
    public function setIsActive($isActive)
    {
        if ($this->hasParent()) {
            $this->getParent()->setIsActive($isActive);
        }

        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasParent()
    {
        return ($this->parent instanceof MenuItemInterface);
    }

    /**
     * @return \Avanzu\AdminThemeBundle\Model\MenuItemInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param \Avanzu\AdminThemeBundle\Model\MenuItemInterface $parent
     *
     * @return $this
     */
    public function setParent(MenuItemInterface $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string $route
     *
     * @return $this
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * @return array
     */
    public function getRouteArgs()
    {
        return $this->routeArgs;
    }

    /**
     * @param array $routeArgs
     *
     * @return $this
     */
    public function setRouteArgs($routeArgs)
    {
        $this->routeArgs = $routeArgs;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return (sizeof($this->children) > 0);
    }

    /**
     * @param MenuItemInterface $child
     *
     * @return $this
     */
    public function addChild(MenuItemInterface $child)
    {
        $child->setParent($this);
        $this->children[] = $child;

        return $this;
    }

    /**
     * @param MenuItemInterface $child
     *
     * @return $this
     */
    public function removeChild(MenuItemInterface $child)
    {
        if (false !== ($key = array_search($child, $this->children))) {
            unset ($this->children[$key]);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getBadgeColor()
    {
        return $this->badgeColor;
    }

    /**
     * @param string $badgeColor
     *
     * @return $this
     */
    public function setBadgeColor($badgeColor)
    {
        $this->badgeColor = $badgeColor;

        return $this;
    }

    /**
     * @return MenuItemInterface|null
     */
    public function getActiveChild()
    {
        foreach ($this->children as $child) {
            if ($child->isActive()) {
                return $child;
            }
        }

        return null;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @return mixed
     */
    public function getRouteAcess()
    {
        return $this->routeAcess;
    }

    /**
     * @param mixed $routeAcess
     */
    public function setRouteAcess($routeAcess)
    {
        $this->routeAcess = $routeAcess;
    }


}