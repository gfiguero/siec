<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * ConsecuenciaPersona
 *
 * @ORM\Table(name="Consecuencia_Persona", uniqueConstraints={@ORM\UniqueConstraint(name="UQ_Consecuencia_Persona_Codigo", columns={"Codigo"})})
 * @ORM\Entity(repositoryClass="App\Repository\ConsecuenciaPersonaRepository")
 * @UniqueEntity("codigo")
 */
class ConsecuenciaPersona
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
     * @var \PersonaAccidente
     *
     * @ORM\OneToMany(targetEntity="App\Entity\PersonaAccidente", mappedBy="consecuenciaPersona")
     */
    private $personasAccidente;

    public function __construct()
    {
        $this->personasAccidente = new ArrayCollection();
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
     * @return Collection|PersonaAccidente[]
     */
    public function getPersonasAccidente(): Collection
    {
        return $this->personasAccidente;
    }

    public function addPersonasAccidente(PersonaAccidente $personasAccidente): self
    {
        if (!$this->personasAccidente->contains($personasAccidente)) {
            $this->personasAccidente[] = $personasAccidente;
            $personasAccidente->setConsecuenciaPersona($this);
        }

        return $this;
    }

    public function removePersonasAccidente(PersonaAccidente $personasAccidente): self
    {
        if ($this->personasAccidente->contains($personasAccidente)) {
            $this->personasAccidente->removeElement($personasAccidente);
            // set the owning side to null (unless already changed)
            if ($personasAccidente->getConsecuenciaPersona() === $this) {
                $personasAccidente->setConsecuenciaPersona(null);
            }
        }

        return $this;
    }


}
