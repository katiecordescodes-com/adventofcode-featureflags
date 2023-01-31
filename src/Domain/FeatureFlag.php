<?php

namespace App\Domain;

class FeatureFlag
{
    private string $id;
    private bool $enabled;

    /**
     * @param string $id
     * @param bool $enabled
     */
    public function __construct(string $id, bool $enabled)
    {
        $this->id = $id;
        $this->enabled = $enabled;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return FeatureFlag
     */
    public function setId(string $id): FeatureFlag
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return FeatureFlag
     */
    public function setEnabled(bool $enabled): FeatureFlag
    {
        $this->enabled = $enabled;
        return $this;
    }
}