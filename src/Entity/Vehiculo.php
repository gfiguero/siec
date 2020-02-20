<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehiculo
 *
 * @ORM\Table(name="Vehiculo", indexes={
 * @ORM\Index(name="IDX_Vehiculo_Tipo_Vehiculo", columns={"Tipo_Vehiculo"})})
 * @ORM\Entity(repositoryClass="App\Repository\VehiculoRepository")
 */
class Vehiculo
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
     * @ORM\Column(name="Placa_Patente_Unica", type="string", length=15, nullable=true, options={"default" : ""})
     */
    private $placaPatenteUnica = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Marca_Vehiculo", type="string", length=255, nullable=true)
     */
    private $marcaVehiculo = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="Modelo_Vehiculo", type="string", length=255, nullable=true)
     */
    private $modeloVehiculo = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="Ano", type="integer", nullable=true)
     */
    private $ano;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Color", type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @var \TipoVehiculo
     *
     * @ORM\ManyToOne(targetEntity="TipoVehiculo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Tipo_Vehiculo", referencedColumnName="Id")
     * })
     */
    private $tipoVehiculo;

    /**
     * @var \VehiculoAccidente
     *
     * @ORM\OneToOne(targetEntity="VehiculoAccidente", mappedBy="vehiculo")
     */
    private $vehiculoAccidente;

    public function __toString(): string
    {
        return $this->getPlacaPatenteUnica();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlacaPatenteUnica(): ?string
    {
        return $this->placaPatenteUnica;
    }

    public function setPlacaPatenteUnica(?string $placaPatenteUnica): self
    {
        $this->placaPatenteUnica = $placaPatenteUnica;

        return $this;
    }

    public function getMarcaVehiculo(): ?string
    {
        return $this->marcaVehiculo;
    }

    public function setMarcaVehiculo(?string $marcaVehiculo): self
    {
        $this->marcaVehiculo = $marcaVehiculo;

        return $this;
    }

    public function getModeloVehiculo(): ?string
    {
        return $this->modeloVehiculo;
    }

    public function setModeloVehiculo(?string $modeloVehiculo): self
    {
        $this->modeloVehiculo = $modeloVehiculo;

        return $this;
    }

    public function getAno(): ?int
    {
        return $this->ano;
    }

    public function setAno(?int $ano): self
    {
        $this->ano = $ano;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getTipoVehiculo(): ?TipoVehiculo
    {
        return $this->tipoVehiculo;
    }

    public function setTipoVehiculo(?TipoVehiculo $tipoVehiculo): self
    {
        $this->tipoVehiculo = $tipoVehiculo;

        return $this;
    }

    public function getVehiculoAccidente(): ?VehiculoAccidente
    {
        return $this->vehiculoAccidente;
    }

    public function setVehiculoAccidente(?VehiculoAccidente $vehiculoAccidente): self
    {
        $this->vehiculoAccidente = $vehiculoAccidente;

        // set (or unset) the owning side of the relation if necessary
        $newVehiculo = $vehiculoAccidente === null ? null : $this;
        if ($newVehiculo !== $vehiculoAccidente->getVehiculo()) {
            $vehiculoAccidente->setVehiculo($newVehiculo);
        }

        return $this;
    }


}
