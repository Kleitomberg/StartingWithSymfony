<?php

namespace App\Entity;

use App\Repository\LivroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivroRepository::class)]
class Livro implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    

    #[ORM\Column]
    private ?int $ano = null;

    #[ORM\Column(length: 255)]
    private ?string $resumo = null;

    #[ORM\ManyToOne(inversedBy: 'livros')]
    private ?Autor $AutorName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

  

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

       

    public function getAno(): ?int
    {
        return $this->ano;
    }

    public function setAno(int $ano): self
    {
        $this->ano = $ano;

        return $this;
    }

    public function getResumo(): ?string
    {
        return $this->resumo;
    }

    public function setResumo(string $resumo): self
    {
        $this->resumo = $resumo;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return[
            "id"=> $this->getId(),
            "titulo"=> $this->getTitulo(),
            "ano"=>$this->getAno(),
            "resumo"=>$this->getResumo()
        ];
        
    }

    public function getAutorName(): ?Autor
    {
        return $this->AutorName;
    }

    public function setAutorName(?Autor $AutorName): self
    {
        $this->AutorName = $AutorName;

        return $this;
    }

    
 
}
