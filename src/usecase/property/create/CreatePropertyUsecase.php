<?php

declare(strict_types=1);

namespace App\Usecase\Property\Create;

use App\Domain\Property\Repository\PropertyRepositoryInterface;

class CreatePropertyUsecase
{
    public function __construct(
        private PropertyRepositoryInterface $repository
    ) {
    }

    public function execute(InputCreatePropertyDto $input): void
    {
      // TODO implement create property Usecase
    }
}
