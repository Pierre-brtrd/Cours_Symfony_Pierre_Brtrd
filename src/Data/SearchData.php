<?php

namespace App\Data;

/**
 * Search Data class to search object in application.
 */
class SearchData
{
    /**
     * Number of the page of search.
     */
    private ?int $page = 1;

    /**
     * The query for the search (for title fields).
     */
    private ?string $query = '';

    /**
     * Array of author filter.
     */
    private ?array $author = [];

    /**
     * Array of tags filter.
     */
    private ?array $categories = [];

    /**
     * Array of visibility filter.
     */
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

    /**
     * Get the value of author.
     *
     * @return ?array
     */
    public function getAuthor(): ?array
    {
        return $this->author;
    }

    /**
     * Set the value of author.
     *
     * @param ?array $author
     */
    public function setAuthor(?array $author): self
    {
        $this->author = $author;

        return $this;
    }
}
