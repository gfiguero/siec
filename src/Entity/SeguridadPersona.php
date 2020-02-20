<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * SeguridadPersona
 *
 * @ORM\Table(name="Seguridad_Persona", uniqueConstraints={@ORM\UniqueConstraint(name="UQ_Seguridad_Persona_Codigo", columns={"Codigo"})})
 * @ORM\Entity
 */
class SeguridadPersona
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
     * @ORM\ManyToMany(targetEntity="App\Entity\PersonaAccidente", mappedBy="seguridad")
     */
    private $personaAccidentes;

    public function __construct()
    {
        $this->personaAccidentes = new ArrayCollection();
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
        return $this->getNombre();
    }

    public function getCodigoNombre(): string
    {
        return $this->getCodigo() . ' - ' . $this->getNombre();
    }

    /**
     * @return Collection|PersonaAccidente[]
     */
    public function getPersonaAccidentes(): Collection
    {
        return $this->personaAccidentes;
    }

    public function addPersonaAccidente(PersonaAccidente $personaAccidente): self
    {
        if (!$this->personaAccidentes->contains($personaAccidente)) {
            $this->personaAccidentes[] = $personaAccidente;
            $personaAccidente->addSeguridade($this);
        }

        return $this;
    }

    public function removePersonaAccidente(PersonaAccidente $personaAccidente): self
    {
        if ($this->personaAccidentes->contains($personaAccidente)) {
            $this->personaAccidentes->removeElement($personaAccidente);
            $personaAccidente->removeSeguridade($this);
        }

        return $this;
    }

}
