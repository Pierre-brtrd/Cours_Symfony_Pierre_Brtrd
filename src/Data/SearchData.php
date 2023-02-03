<?php

namespace App\Data;

use App\Entity\Categorie;
use App\Entity\User;

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
     *
     * @var array<int, User>
     */
    private ?array $author = [];

    /**
     * Array of tags filter.
     *
     * @var array<int, Categorie>
     */
    private ?array $categories = [];

    /**
     * Array of visibility filter.
     *
     * @var array<int, bool>
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
     *
     * @return SearchData
     */
    public function setQuery(?string $query): SearchData
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get the value of categorie.
     *
     * @return ?array<int, Categorie>
     */
    public function getCategories(): ?array
    {
        return $this->categories;
    }

    /**
     * Set the value of categorie.
     *
     * @param ?array<int, Categorie> $categories
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
     *
     * @return SearchData
     */
    public function setPage(?int $page): SearchData
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get the value of active.
     *
     * @return ?array<int, bool>
     */
    public function getActive(): ?array
    {
        return $this->active;
    }

    /**
     * Set the value of active.
     *
     * @param ?array<int, bool> $active
     */
    public function setActive(?array $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the value of author.
     *
     * @return ?array<int, User>
     */
    public function getAuthor(): ?array
    {
        return $this->author;
    }

    /**
     * Set the value of author.
     *
     * @param ?array<int, User> $author
     */
    public function setAuthor(?array $author): self
    {
        $this->author = $author;

        return $this;
    }
}
