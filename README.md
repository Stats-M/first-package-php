### first-package
## Тестовый пакет для Composer
Этот проект служит для отработки навыков формирования php-пакета для Composer.





### How to install to your project
```
composer require stats-m/first-package
```

### Unit testing
```
composer install
./vendor/bin/codecept build
./vendor/bin/codecept run unit tests/unit
```

### Usage

#### Basic usage

```php
use Statsm\FirstPackage\FirstPackage;
```
