<?php

declare(strict_types=1);

namespace App\Domain\Property\ValueObject;

use App\Domain\Property\Factory\ImageValidatorFactory;
use App\Domain\ValueObject\ValueObject;

class Image extends ValueObject
{
    public function __construct(
        public string $url,
        public bool $isDefault = false,
    ) {
        parent::__construct();
        $this->validate();
    }

    private function validate(): void
    {
        ImageValidatorFactory::create()->validate($this);
        $this->notification->throwIfHasErrors('Invalid image data.');
    }
}
