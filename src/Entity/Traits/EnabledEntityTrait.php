<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait EnabledEntityTrait
{
    #[ORM\Column]
    private ?bool $enabled = null;

    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }
}
