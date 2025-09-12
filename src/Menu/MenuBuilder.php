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
        $this->addCatalogSubMenu($menu);
        return $menu;
    }

    private function addSupplierSubMenu(ItemInterface $menu): void
    {
        $supplier = $menu
            ->addChild('supplier')
            ->setLabel('app.ui.suppliers')
            ->setLabelAttribute('icon', 'tabler:building-skyscraper')
        ;

        $supplier->addChild('supplier', ['route' => 'app_admin_supplier_index'])
            ->setLabel('app.ui.suppliers')
            ->setLabelAttribute('icon', 'tabler:building-skyscraper')
        ;

        $supplier->addChild('supplier_offer', ['route' => 'app_admin_supplier_offer_index'])
            ->setLabel('app.ui.supplier_offers')
            ->setLabelAttribute('icon', 'tabler:building-skyscraper')
        ;
    }

    private function addCatalogSubMenu(ItemInterface $menu): void
    {
        $catalog = $menu
            ->addChild('catalog')
            ->setLabel('app.ui.catalog')
            ->setLabelAttribute('icon', 'tabler:brand-superhuman')
        ;

        $catalog->addChild('product', ['route' => 'app_admin_product_index'])
            ->setLabel('app.ui.products')
            ->setLabelAttribute('icon', 'tabler:brand-superhuman')
        ;

        $catalog->addChild('product_type', ['route' => 'app_admin_product_type_index'])
            ->setLabel('app.ui.products_types')
            ->setLabelAttribute('icon', 'tabler:brand-superhuman')
        ;
    }

}
