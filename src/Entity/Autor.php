<?php

namespace App\Entity;

use App\Repository\AutorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AutorRepository::class)]
class Autor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

    #[ORM\OneToMany(mappedBy: 'AutorName', targetEntity: Livro::class)]
    private Collection $livros;

    public function __construct()
    {
        $this->livros = new ArrayCollection();
    }

    public function __toString()
    {
       return strval( $this->getNome() );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return Collection<int, Livro>
     */
    public function getLivros(): Collection
    {
        return $this->livros;
    }

    public function addLivro(Livro $livro): self
    {
        if (!$this->livros->contains($livro)) {
            $this->livros[] = $livro;
            $livro->setAutorName($this);
        }

        return $this;
    }

    public function removeLivro(Livro $livro): self
    {
        if ($this->livros->removeElement($livro)) {
            // set the owning side to null (unless already changed)
            if ($livro->getAutorName() === $this) {
                $livro->setAutorName(null);
            }
        }

        return $this;
    }
}
