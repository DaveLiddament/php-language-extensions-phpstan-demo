# PHP Language Extensions Demo (using PHPStan)

This is a simple demo project for showing how to use the attributes provided by [PHP Language Extensions](https://github.com/DaveLiddament/php-language-extensions).

[Person](src/Person/Person.php) has methods with the attributes:
- [`#[Friend]`](https://github.com/DaveLiddament/php-language-extensions#friend)
- [`#[NamespaceVisibility]`](https://github.com/DaveLiddament/php-language-extensions#namespaceVisibility)
- [`#[TestTag]`](https://github.com/DaveLiddament/php-language-extensions#testtag)

- Example code in [Demo](src/Demo/Demo.php) show correct and invalid uses of Person's methods based on the attributes.

The validation of this is done by [PHPStan](https://phpstan.org/) using the [PHPStan php language extension](https://github.com/DaveLiddament/phpstan-php-language-extensions).

To see this in action checkout this project and run `composer install`, allow phpstan-installer to run when asked.

If you run PHPStan it will show you the following issues:

```shell
vendor/bin/phpstan analyse src --level=max
```

```shell
vendor/bin/phpstan analyse src --level=max
 4/4 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

 ------ ------------------------------------------------------------------------------------------------------------------------------- 
  Line   Demo/Demo.php                                                                                                                  
 ------ ------------------------------------------------------------------------------------------------------------------------------- 
  27     DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person::__construct cannot be called from                                
         DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Demo\Demo, it can only be called from its friend(s):                            
         DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\PersonBuilder                                                            
  34     DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person::updateName has Namespace Visibility, it can only be called from  
         namespace DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person and sub-namespaces of                                          
         DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person                                                                          
 ------ ------------------------------------------------------------------------------------------------------------------------------- 

 ------ --------------------------------------------------------------------------------------------------------------------------- 
  Line   Person/PersonUpdaterAction.php                                                                                             
 ------ --------------------------------------------------------------------------------------------------------------------------- 
  14     DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person::getName is a test tag and can only be called from test code  
 ------ --------------------------------------------------------------------------------------------------------------------------- 
 
                                                                                                                         
 [ERROR] Found 3 errors                                                                                                 
                                                         
```

### Analysing test code

You can, and should, run PHPStan on your test code too, doing this will show you an additional error in the test script.

```shell
vendor/bin/phpstan analyse src tests --level=max 
```

```shell
vendor/bin/phpstan analyse src tests --level=max
 5/5 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

 ------ ------------------------------------------------------------------------------------------------------------------------------- 
  Line   src/Demo/Demo.php                                                                                                              
 ------ ------------------------------------------------------------------------------------------------------------------------------- 
  27     DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person::__construct cannot be called from                                
         DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Demo\Demo, it can only be called from its friend(s):                            
         DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\PersonBuilder                                                            
  34     DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person::updateName has Namespace Visibility, it can only be called from  
         namespace DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person and sub-namespaces of                                          
         DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person                                                                          
 ------ ------------------------------------------------------------------------------------------------------------------------------- 

 ------ --------------------------------------------------------------------------------------------------------------------------- 
  Line   src/Person/PersonUpdaterAction.php                                                                                         
 ------ --------------------------------------------------------------------------------------------------------------------------- 
  14     DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person::getName is a test tag and can only be called from test code  
 ------ --------------------------------------------------------------------------------------------------------------------------- 

 ------ --------------------------------------------------------------------------------------------------------------------------- 
  Line   tests/Person/PersonTest.php                                                                                                
 ------ --------------------------------------------------------------------------------------------------------------------------- 
  17     DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person::__construct cannot be called from                            
         DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Test\Person\PersonTest, it can only be called from its friend(s):           
         DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\PersonBuilder                                                        
  18     DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person::getName is a test tag and can only be called from test code  
 ------ --------------------------------------------------------------------------------------------------------------------------- 

                                                                                                                        
 [ERROR] Found 5 errors                                                                                                 
                                                                                                                                                                                                                                                
```

If you want to exclude applying the `package` and `friend` checks on your test code you can do this in one of two ways.

#### Excluding checks for classes ending in Test

To exclude checks for these attributes for any class with a name ending in `Test` add the following to your phpstan.neon file (see [example](phpstan-test-name.neon)):

```yaml
parameters:
    phpLanguageExtensions:
        mode: className
```

Running with this config will ignore these issues in test classes:

```shell
vendor/bin/phpstan analyse src tests --level=max -c phpstan-test-name.neon 
```

```shell
vendor/bin/phpstan analyse src tests --level=max -c phpstan-test-name.neon 
 5/5 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

 ------ ------------------------------------------------------------------------------------------------------------------------------- 
  Line   src/Demo/Demo.php                                                                                                              
 ------ ------------------------------------------------------------------------------------------------------------------------------- 
  27     DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person::__construct cannot be called from                                
         DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Demo\Demo, it can only be called from its friend(s):                            
         DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\PersonBuilder                                                            
  34     DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person::updateName has Namespace Visibility, it can only be called from  
         namespace DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person and sub-namespaces of                                          
         DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person                                                                          
 ------ ------------------------------------------------------------------------------------------------------------------------------- 

 ------ --------------------------------------------------------------------------------------------------------------------------- 
  Line   src/Person/PersonUpdaterAction.php                                                                                         
 ------ --------------------------------------------------------------------------------------------------------------------------- 
  14     DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person::getName is a test tag and can only be called from test code  
 ------ --------------------------------------------------------------------------------------------------------------------------- 

                                                                                                                        
 [ERROR] Found 3 errors                                                                                                 
                                                                                                                   
```

#### Excluding checks for classes based on namesapce

To exclude checks for these attributes for any class with the test namespace (in this example `DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Test\`) add the following to your phpstan.neon file (see [example](phpstan-test-namespace.neon)):

```yaml
parameters:
    phpLanguageExtensions:
        mode: namespace
        testNamespace: 'DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Test\'
```

Running with this config will ignore these issues in test classes:

```shell
vendor/bin/phpstan analyse src tests --level=max -c phpstan-test-namespace.neon 
```

```shell
vendor/bin/phpstan analyse src tests --level=max -c phpstan-test-namespace.neon
 5/5 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

 ------ ------------------------------------------------------------------------------------------------------------------------------- 
  Line   src/Demo/Demo.php                                                                                                              
 ------ ------------------------------------------------------------------------------------------------------------------------------- 
  27     DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person::__construct cannot be called from                                
         DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Demo\Demo, it can only be called from its friend(s):                            
         DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\PersonBuilder                                                            
  34     DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person::updateName has Namespace Visibility, it can only be called from  
         namespace DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person and sub-namespaces of                                          
         DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person                                                                          
 ------ ------------------------------------------------------------------------------------------------------------------------------- 

 ------ --------------------------------------------------------------------------------------------------------------------------- 
  Line   src/Person/PersonUpdaterAction.php                                                                                         
 ------ --------------------------------------------------------------------------------------------------------------------------- 
  14     DaveLiddament\PhpLanguageExtensionsPhpstanDemo\Person\Person::getName is a test tag and can only be called from test code  
 ------ --------------------------------------------------------------------------------------------------------------------------- 

                                                                                                                        
 [ERROR] Found 3 errors                                                                                                 
                                                                                                                        
```
