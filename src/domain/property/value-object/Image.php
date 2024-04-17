<?php

declare(strict_types=1);

namespace App\Domain\Property\ValueObject;

use App\Domain\Property\Factory\ImageValidatorFactory;
use App\Domain\ValueObject\ValueObject;

class Image extends ValueObject
{
    public function __construct(
        private string $url,
        private bool $isDefault = false,
    ) {
        parent::__construct();
        $this->validate();
    }

    private function validate(): void
    {
        ImageValidatorFactory::create()->validate($this);
        $this->notification->throwIfHasErrors('Invalid image data.');
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function isDefault(): bool
    {
        return $this->isDefault;
    }
}
