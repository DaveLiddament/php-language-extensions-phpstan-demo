<?php

declare(strict_types=1);


namespace DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person;


class PersonBuilder
{

    public static function newPerson(string $name): Person
    {
        return new Person($name);
    }
}
