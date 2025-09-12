<?php

namespace App\Entity;

use App\Form\SupplierOfferType;
use App\Grid\SupplierOfferGrid;
use App\Repository\SupplierOfferRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Metadata\BulkDelete;
use Sylius\Resource\Metadata\Create;
use Sylius\Resource\Metadata\Delete;
use Sylius\Resource\Metadata\Index;
use Sylius\Resource\Metadata\Show;
use Sylius\Resource\Metadata\Update;
use Sylius\Resource\Model\ResourceInterface;

#[AsResource(
    section: 'admin',
    routePrefix: '/admin',
    templatesDir: '@SyliusAdminUi/crud',
    formType: SupplierOfferType::class,
    operations: [
        new Create(),
        new Update(),
        new Show(),
        new Delete(),
        new BulkDelete(),
        new Index(
            grid: SupplierOfferGrid::class,
        ),
    ],
)]
#[ORM\Entity(repositoryClass: SupplierOfferRepository::class)]
class SupplierOffer implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $supplierSKU = null;

    #[ORM\Column(length: 255)]
    private ?string $productTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $productDescription = null;

    #[ORM\Column(nullable: true)]
    private ?int $leadTimeDays = null;

    #[ORM\ManyToOne(inversedBy: 'supplierOffers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Supplier $supplier = null;

    #[ORM\ManyToOne(inversedBy: 'supplierOffers')]
    private ?Product $product = null;

    #[ORM\Column(nullable: true)]
    private ?float $PurchasePrice = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $PurchasePriceValidUntil = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplierSKU(): ?string
    {
        return $this->supplierSKU;
    }

    public function setSupplierSKU(?string $supplierSKU): static
    {
        $this->supplierSKU = $supplierSKU;

        return $this;
    }

    public function getProductTitle(): ?string
    {
        return $this->productTitle;
    }

    public function setProductTitle(string $productTitle): static
    {
        $this->productTitle = $productTitle;

        return $this;
    }

    public function getProductDescription(): ?string
    {
        return $this->productDescription;
    }

    public function setProductDescription(string $productDescription): static
    {
        $this->productDescription = $productDescription;

        return $this;
    }

    public function getLeadTimeDays(): ?int
    {
        return $this->leadTimeDays;
    }

    public function setLeadTimeDays(?int $leadTimeDays): static
    {
        $this->leadTimeDays = $leadTimeDays;

        return $this;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): static
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getPurchasePrice(): ?float
    {
        return $this->PurchasePrice;
    }

    public function setPurchasePrice(?float $PurchasePrice): static
    {
        $this->PurchasePrice = $PurchasePrice;

        return $this;
    }

    public function getPurchasePriceValidUntil(): ?\DateTime
    {
        return $this->PurchasePriceValidUntil;
    }

    public function setPurchasePriceValidUntil(?\DateTime $PurchasePriceValidUntil): static
    {
        $this->PurchasePriceValidUntil = $PurchasePriceValidUntil;

        return $this;
    }
}
