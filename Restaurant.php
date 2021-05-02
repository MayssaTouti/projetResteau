<?php

namespace App\Entity;

use App\Entity\Menu;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RestaurantRepository;
use Symfony\Component\Validator\Constraints as Assert;

 /**
  * @ORM\Entity(repositoryClass=RestaurantRepository::class)
  */
class Restaurant
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
    private $IdResto;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 5,
     * max = 50,
     * minMessage = "Le nom d'un restaurant doit comporter au moins {{ limit }} caractères",
     * maxMessage = "Le nom d'un restaurant doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $NomResto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 5,
     * max = 50,
     * minMessage = "Le numero d'un restaurant doit comporter au moins {{ limit }} caractères",
     * maxMessage = "Le numero d'un restaurant doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $Telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 5,
     * max = 50,
     * minMessage = "Le nom d'un chef  doit comporter au moins {{ limit }} caractères",
     * maxMessage = "Le nom d'un chef doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $NomChef;

    /**
     * @ORM\Column(type="integer")
     */
    private $NbEtoile;

    /**
     * @ORM\ManyToOne(targetEntity=Menu::class, inversedBy="restaurants")
     */
    private $menu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdResto(): ?int
    {
        return $this->IdResto;
    }

    public function setIdResto(int $IdResto): self
    {
        $this->IdResto = $IdResto;

        return $this;
    }

    public function getNomResto(): ?string
    {
        return $this->NomResto;
    }

    public function setNomResto(string $NomResto): self
    {
        $this->NomResto = $NomResto;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getNomChef(): ?string
    {
        return $this->NomChef;
    }

    public function setNomChef(string $NomChef): self
    {
        $this->NomChef = $NomChef;

        return $this;
    }

    public function getNbEtoile(): ?int
    {
        return $this->NbEtoile;
    }

    public function setNbEtoile(int $NbEtoile): self
    {
        $this->NbEtoile = $NbEtoile;

        return $this;
    }

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }
    


}
