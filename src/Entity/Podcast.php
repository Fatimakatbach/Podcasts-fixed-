<?php

namespace App\Entity;

use App\Repository\PodcastRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank as Assert;

#[ORM\Entity(repositoryClass: PodcastRepository::class)]
class Podcast
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert]
    private ?string $Titulo = null;

    #[ORM\ManyToOne(inversedBy: 'podcasts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $Fecha = null;

    #[ORM\Column(length: 610)]
    #[Assert]
    private ?string $descripcion = null;

    #[ORM\Column(type: Types::BINARY)]
    #[Assert]
    private $audio = null;

    #[ORM\Column(type: Types::BINARY)]
    #[Assert]
    private $imagen = null;

    #[ORM\Column(nullable: true)]
    private ?bool $favorito = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->Titulo;
    }

    public function setTitulo(string $Titulo): self
    {
        $this->Titulo = $Titulo;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getFecha(): ?\DateTimeImmutable
    {
        return $this->Fecha;
    }

    public function setFecha(\DateTimeImmutable $Fecha): self
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getAudio()
    {
        return $this->audio;
    }

    public function setAudio($audio): self
    {
        $this->audio = $audio;

        return $this;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function isFavorito(): ?bool
    {
        return $this->favorito;
    }

    public function setFavorito(?bool $favorito): self
    {
        $this->favorito = $favorito;

        return $this;
    }
    public function __toString() {
        return $this->usuario;
        
    }
}
