<?php

declare(strict_types=1);


namespace DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person;


use DaveLiddament\PhpLanguageExtensions\Friend;
use DaveLiddament\PhpLanguageExtensions\Package;

class Person
{

    #[Friend(PersonBuilder::class)]
    public function __construct(
        private string $name,
    ) {
    }

    #[Package]
    public function updateName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
