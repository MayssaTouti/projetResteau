<?php
namespace App\Entity;
class PropertySearch
{
 private $NomResto;
 public function getNomResto(): ?string
 {
     return $this->NomResto;
 }
 public function setNomResto(string $NomResto): self
    {
        $this->NomResto = $NomResto;

        return $this;
    }

}