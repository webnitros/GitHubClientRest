# Клиент для управления issues github через rest

https://docs.github.com/en/rest/reference/issues

```php

$User = new User('ORGANIZATION NAME', 'API KEY');
$Client = new Issues($User);
$issue = $Client->setRepo('РЕПОЗИТОРИЙ');
$list = \GitHubClientRest\Commands\Issues::getList($issue, [
    'per_page' => 100
]);
```

