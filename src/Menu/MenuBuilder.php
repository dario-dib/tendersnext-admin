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
        $this->addSupplierSubMenu($menu);

        return $menu;
    }

    private function addSupplierSubMenu(ItemInterface $menu): void
    {
        $supplier = $menu
            ->addChild('supplier')
            ->setLabel('app.ui.suppliers')
            ->setLabelAttribute('icon', 'tabler:books')
        ;

        $supplier->addChild('supplier', ['route' => 'app_admin_supplier_index'])
            ->setLabel('app.ui.suppliers')
            ->setLabelAttribute('icon', 'supplier')
        ;

        $supplier->addChild('supplier_offer', ['route' => 'app_admin_supplier_offer_index'])
            ->setLabel('app.ui.supplier_offers')
            ->setLabelAttribute('icon', 'supplier')
        ;

//        $supplier->addChild('supplierOffer', ['route' => 'app_admin_supplier_offer_index'])
//            ->setLabel('app.ui.supplier_offers')
//            ->setLabelAttribute('icon', 'supplier')
//        ;

    }

}
