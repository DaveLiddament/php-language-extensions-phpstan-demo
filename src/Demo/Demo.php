<?php

declare(strict_types=1);


namespace DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Demo;


use DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person;
use DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\PersonBuilder;
use DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\PersonUpdaterAction;

class Demo
{

    // These are all allowed
    public function happyPath(): void
    {
        $person = PersonBuilder::newPerson("Anne");
        $personUpdaterAction = new PersonUpdaterAction();
        $personUpdaterAction->updateName($person, "Ann");
    }


    public function notAFriend(): Person
    {
        $person = new Person("Bob"); // ERROR Demo is not a friend of Person::__construct

        return $person;
    }

    public function notInSamePackage(Person $person): void
    {
        $person->updateName("Charlie"); // ERROR Person::updateName has package visibility, Demo is in different namespace
    }
}
