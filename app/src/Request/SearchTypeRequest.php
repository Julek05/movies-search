<?php

declare(strict_types=1);

namespace App\Request;

use App\Enum\SearchType;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class SearchTypeRequest
{
    #[Assert\NotBlank]
    #[Assert\Choice(callback: [SearchType::class, 'values'])]
    private mixed $type;

    public function __construct(mixed $type)
    {
        $this->type = $type;
    }

    public function getTypeAsEnum(): SearchType
    {
        return SearchType::from($this->type);
    }
}