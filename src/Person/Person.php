<?php

declare(strict_types=1);


namespace DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person;


use DaveLiddament\PhpLanguageExtensions\Friend;
use DaveLiddament\PhpLanguageExtensions\NamespaceVisibility;
use DaveLiddament\PhpLanguageExtensions\Package;
use DaveLiddament\PhpLanguageExtensions\TestTag;

class Person
{

    #[Friend(PersonBuilder::class)]
    public function __construct(
        private string $name,
    ) {
    }

    #[NamespaceVisibility]
    public function updateName(string $name): void
    {
        $this->name = $name;
    }

    #[TestTag]
    public function getName(): string
    {
        return $this->name;
    }
}
