<?php

/*
 * This file is part of BookmarkIt.
 *
 * (c) Monofony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\RequestStack;

final class AdminMenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param RequestStack $requestStack
     *
     * @return ItemInterface
     */
    public function createMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');

        $this->addConfigurationSubMenu($menu);

        return $menu;
    }

    /**
     * @param ItemInterface $menu
     *
     * @return ItemInterface
     */
    private function addConfigurationSubMenu(ItemInterface $menu)
    {
        $configuration = $menu
            ->addChild('configuration')
            ->setLabel('sylius.ui.configuration')
        ;

        $configuration->addChild('backend_admin_user', ['route' => 'sylius_backend_admin_user_index'])
            ->setLabel('sylius.ui.admin_users')
            ->setLabelAttribute('icon', 'lock');

        return $configuration;
    }
}
