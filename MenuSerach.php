<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
class MenuSerach
{
 /**
 * @ORM\ManyToOne(targetEntity="App\Entity\Category")
 */
 private $menu;
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