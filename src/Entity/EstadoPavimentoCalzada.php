<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * EstadoPavimentoCalzada
 *
 * @ORM\Table(name="Estado_Pavimento_Calzada", uniqueConstraints={@ORM\UniqueConstraint(name="UQ_Estado_Pavimento_Calzada_Codigo", columns={"Codigo"})})
 * @ORM\Entity(repositoryClass="App\Repository\EstadoPavimentoCalzadaRepository")
 * @UniqueEntity("codigo")
 */
class EstadoPavimentoCalzada
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Codigo", type="string", length=10, nullable=false)
     */
    private $codigo;

    /**
     * @var \Accidentes
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Accidente", mappedBy="estadoPavimentoCalzada")
     */
    private $accidentes;

    public function __construct()
    {
        $this->accidentes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getCodigoNombre();
    }

    public function getCodigoNombre(): string
    {
        return $this->getCodigo() . ' - ' . $this->getNombre();
    }

    /**
     * @return Collection|Accidente[]
     */
    public function getAccidentes(): Collection
    {
        return $this->accidentes;
    }

    public function addAccidente(Accidente $accidente): self
    {
        if (!$this->accidentes->contains($accidente)) {
            $this->accidentes[] = $accidente;
            $accidente->setEstadoPavimentoCalzada($this);
        }

        return $this;
    }

    public function removeAccidente(Accidente $accidente): self
    {
        if ($this->accidentes->contains($accidente)) {
            $this->accidentes->removeElement($accidente);
            // set the owning side to null (unless already changed)
            if ($accidente->getEstadoPavimentoCalzada() === $this) {
                $accidente->setEstadoPavimentoCalzada(null);
            }
        }

        return $this;
    }


}
