<?php

class Chapter
{
    protected $chapter_id;
    protected $chapter_nom;
    protected $chapter_content;
    protected $chapter_image;
    protected $links; // Tableau associatif pour stocker les liens (next_chapter_id et description)

    public function __construct()
    {
        $this->chapter_id = null;
        $this->chapter_nom = null;
        $this->chapter_content = null;
        $this->chapter_image = null;
        $this->links = []; // Initialisation des liens comme tableau vide
    }


    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getId()

    {
        foreach ($data as $key => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Getters et Setters
    public function getChapterId()
    {
        return $this->chapter_id;
    }

    public function setChapterId($chapter_id): self
    {
        $this->chapter_id = $chapter_id;
        return $this;
    }

    public function getChapterNom()
    {
        return $this->chapter_nom;
    }

    public function setChapterNom($chapter_nom): self
    {
        $this->chapter_nom = $chapter_nom;
        return $this;
    }

    public function getChapterContent()
    {
        return $this->chapter_content;
    }

    public function setChapterContent($chapter_content): self
    {
        $this->chapter_content = $chapter_content;
        return $this;
    }

    public function getChapterImage()
    {
        return $this->chapter_image;
    }

    public function setChapterImage($chapter_image): self
    {
        $this->chapter_image = $chapter_image;
        return $this;
    }

    public function getLinks()
    {
        return $this->links;
    }
    
    public function addLink($link): self
    {
        $this->links[] = $link;
        return $this;
    }
}
