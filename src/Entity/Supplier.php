<?php

namespace App\Entity;

use App\Form\SupplierType;
use App\Grid\SupplierGrid;
use App\Repository\SupplierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Resource\Metadata\BulkDelete;
use Sylius\Resource\Model\ResourceInterface;


use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Metadata\Index;
use Sylius\Resource\Metadata\Update;
use Sylius\Resource\Metadata\Delete;
use Sylius\Resource\Metadata\Show;
use Sylius\Resource\Metadata\Create;

#[AsResource(
    section: 'admin',
    routePrefix: '/admin',
    templatesDir: '@SyliusAdminUi/crud',
    formType: SupplierType::class,
    operations: [
        new Create(),
        new Update(),
        new Show(),
        new Delete(),
        new BulkDelete(),
        new Index(
            grid: SupplierGrid::class,
        ),
    ],
)]
#[ORM\Entity(repositoryClass: SupplierRepository::class)]
class Supplier implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mainContactEmail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secondContactEmail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phoneNumber = null;

    /**
     * @var Collection<int, SupplierOffer>
     */
    #[ORM\OneToMany(mappedBy: 'supplier', targetEntity: SupplierOffer::class, orphanRemoval: true)]
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
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMainContactEmail(): ?string
    {
        return $this->mainContactEmail;
    }

    public function setMainContactEmail(?string $mainContactEmail): static
    {
        $this->mainContactEmail = $mainContactEmail;

        return $this;
    }

    public function getSecondContactEmail(): ?string
    {
        return $this->secondContactEmail;
    }

    public function setSecondContactEmail(?string $secondContactEmail): static
    {
        $this->secondContactEmail = $secondContactEmail;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

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
            $supplierOffer->setSupplier($this);
        }

        return $this;
    }

    public function removeSupplierOffer(SupplierOffer $supplierOffer): static
    {
        if ($this->supplierOffers->removeElement($supplierOffer)) {
            // set the owning side to null (unless already changed)
            if ($supplierOffer->getSupplier() === $this) {
                $supplierOffer->setSupplier(null);
            }
        }

        return $this;
    }
}
