<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MenuRepository::class)
 */
class Menu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $IdMenu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Entree;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $plat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Dessert;

    /**
     * @ORM\OneToMany(targetEntity=Restaurant::class, mappedBy="menu")
     */
    private $restaurants;

    public function __construct()
    {
        $this->restaurants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMenu(): ?int
    {
        return $this->IdMenu;
    }

    public function setIdMenu(int $IdMenu): self
    {
        $this->IdMenu = $IdMenu;

        return $this;
    }

    public function getEntree(): ?string
    {
        return $this->Entree;
    }

    public function setEntree(string $Entree): self
    {
        $this->Entree = $Entree;

        return $this;
    }

    public function getPlat(): ?string
    {
        return $this->plat;
    }

    public function setPlat(string $plat): self
    {
        $this->plat = $plat;

        return $this;
    }

    public function getDessert(): ?string
    {
        return $this->Dessert;
    }

    public function setDessert(string $Dessert): self
    {
        $this->Dessert = $Dessert;

        return $this;
    }

    /**
     * @return Collection|Restaurant[]
     */
    public function getRestaurants(): Collection
    {
        return $this->restaurants;
    }

    public function addRestaurant(Restaurant $restaurant): self
    {
        if (!$this->restaurants->contains($restaurant)) {
            $this->restaurants[] = $restaurant;
            $restaurant->setMenu($this);
        }

        return $this;
    }

    public function removeRestaurant(Restaurant $restaurant): self
    {
        if ($this->restaurants->removeElement($restaurant)) {
            // set the owning side to null (unless already changed)
            if ($restaurant->getMenu() === $this) {
                $restaurant->setMenu(null);
            }
        }

        return $this;
    }
  

}