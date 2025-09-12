<?php

namespace App\Entity;

use App\Form\PharmaActiveIngredientFormType;
use App\Grid\PharmaActiveIngredientGrid;
use App\Grid\ProductGrid;
use App\Repository\PharmaActiveIngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    formType: PharmaActiveIngredientFormType::class,
    operations: [
        new Create(),
        new Update(),
        new Show(),
        new Delete(),
        new BulkDelete(),
        new Index(
            grid: PharmaActiveIngredientGrid::class,
        ),
    ],
)]
#[ORM\Entity(repositoryClass: PharmaActiveIngredientRepository::class)]
class PharmaActiveIngredient implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\OneToMany(mappedBy: 'pharmaActiveIngredient', targetEntity: Product::class)]
    private Collection $product;

    public function __construct()
    {
        $this->product = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->product->contains($product)) {
            $this->product->add($product);
            $product->setPharmaActiveIngredient($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->product->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getPharmaActiveIngredient() === $this) {
                $product->setPharmaActiveIngredient(null);
            }
        }

        return $this;
    }
}
