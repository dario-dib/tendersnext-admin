<?php
declare(strict_types=1);

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Sylius\AdminUi\Knp\Menu\MenuBuilderInterface;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;

#[AsDecorator(decorates: 'sylius_admin_ui.knp.menu_builder')]
final readonly class MenuBuilder implements MenuBuilderInterface
{
    public function __construct(
        private readonly FactoryInterface $factory,
    ) {
    }

    public function createMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');
        // ...
        $this->addLibrarySubMenu($menu);

        return $menu;
    }

    private function addLibrarySubMenu(ItemInterface $menu): void
    {
        $library = $menu
            ->addChild('library')
            ->setLabel('app.ui.suppliers')
            ->setLabelAttribute('icon', 'tabler:books')
        ;

        $library->addChild('supplier', ['route' => 'app_admin_supplier_index'])
            ->setLabel('app.ui.suppliers')
            ->setLabelAttribute('icon', 'supplier')
        ;
    }

}
