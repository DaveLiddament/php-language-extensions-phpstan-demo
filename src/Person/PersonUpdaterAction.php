<?php

declare(strict_types=1);


namespace DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person;


class PersonUpdaterAction
{

    public function updateName(Person $person, string $name): void
    {
        $person->getName();
        $person->updateName($name);
    }

}
