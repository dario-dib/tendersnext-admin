<?php

namespace App\Entity;

use App\Form\ProductFormType;
use App\Grid\Grid\ProductGrid;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    formType: ProductFormType::class,
    operations: [
        new Create(),
        new Update(),
        new Show(),
        new Delete(),
        new BulkDelete(),
        new Index(
            grid: ProductGrid::class,
        ),
    ],
)]
#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[ORM\ManyToOne(inversedBy: 'product')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProductType $productType = null;

    /**
     * @var Collection<int, SupplierOffer>
     */
    #[ORM\OneToMany(mappedBy: 'product', targetEntity: SupplierOffer::class)]
    private Collection $supplierOffers;

    public function __construct()
    {
        $this->supplierOffers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getProductType(): ?ProductType
    {
        return $this->productType;
    }

    public function setProductType(?ProductType $productType): static
    {
        $this->productType = $productType;

        return $this;
    }

    /**
     * @return Collection<int, SupplierOffer>
     */
    public function getSupplierOffers(): Collection
    {
        return $this->supplierOffers;
    }

    public function addSupplierOffer(SupplierOffer $supplierOffer): static
    {
        if (!$this->supplierOffers->contains($supplierOffer)) {
            $this->supplierOffers->add($supplierOffer);
            $supplierOffer->setProduct($this);
        }

        return $this;
    }

    public function removeSupplierOffer(SupplierOffer $supplierOffer): static
    {
        if ($this->supplierOffers->removeElement($supplierOffer)) {
            // set the owning side to null (unless already changed)
            if ($supplierOffer->getProduct() === $this) {
                $supplierOffer->setProduct(null);
            }
        }

        return $this;
    }
}
