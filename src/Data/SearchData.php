<?php

namespace App\Data;

class SearchData
{
    private ?int $page = 1;

    private ?string $query = '';

    private ?array $categories = [];

    private ?array $active = null;

    /**
     * Get the value of query.
     *
     * @return ?string
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * Set the value of query.
     *
     * @param ?string $query
     */
    public function setQuery(?string $query): self
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get the value of categorie.
     *
     * @return ?array
     */
    public function getCategories(): ?array
    {
        return $this->categories;
    }

    /**
     * Set the value of categorie.
     *
     * @param ?array $categorie
     */
    public function setCategories(?array $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get the value of page.
     *
     * @return ?int
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * Set the value of page.
     *
     * @param ?int $page
     */
    public function setPage(?int $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get the value of active.
     *
     * @return ?array
     */
    public function getActive(): ?array
    {
        return $this->active;
    }

    /**
     * Set the value of active.
     *
     * @param ?array $active
     */
    public function setActive(?array $active): self
    {
        $this->active = $active;

        return $this;
    }
}
