<?php

namespace App\Entity;

use App\Form\SupplierType;
use App\Grid\SupplierGrid;
use App\Repository\SupplierRepository;
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
}
