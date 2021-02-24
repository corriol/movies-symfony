<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 */
class Movie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @param mixed $id
     * @return Movie
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotNull(message = "The title is mandatory")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tagline;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $poster;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotNull()
     */
    private $releaseDate;


    /**
     * @ORM\Column(type="text")
     * @Assert\NotNull
     */
    private $overview;

    /**
     * @ORM\ManyToOne(targetEntity=Genre::class, inversedBy="movies")
     * @Assert\NotNull()
     */
    private $genre;

    /**
     * @ORM\OneToMany(targetEntity=Rating::class, mappedBy="movie")
     */
    private $ratings;

    public function __construct()
    {
        $this->ratings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTagline(): ?string
    {
        return $this->tagline;
    }

    public function setTagline(?string $tagline): self
    {
        $this->tagline = $tagline;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): self
    {
        $this->overview = $overview;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate = null): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection|Rating[]
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): self
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings[] = $rating;
            $rating->setMovie($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getMovie() === $this) {
                $rating->setMovie(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getTitle() . " ({$this->getReleaseDate()->format("Y")})";
    }

    public function getRating(): ?float {
        $sum = 0;
        foreach ($this->getRatings() as $rating) {
            $sum += $rating->getValue();
        }
        $count = count($this->getRatings());
        if (empty($count))
            return null;
        return ($sum/$count);
    }
}
