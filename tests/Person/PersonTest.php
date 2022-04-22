<?php

declare(strict_types=1);


namespace DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Test\Person;


use DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{

    public function testPerson(): void
    {
        $person = new Person("bob");
        $this->assertSame("bob", $person->getName());
    }
}
