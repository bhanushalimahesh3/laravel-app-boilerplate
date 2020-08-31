# Laravel App Boilerplate

I, most of the time follow the same code structure across all Laravel apps within my organization or on side projects, and eventually end up copy/pasting the base structure from existing project to new projects until some new pattern is followed/amended. 

Also while creating custom files **i.e helper or transformer class** we copy/paste scaffolding from existing file and start working on it. So to avoid or save time by doing all these manual, redundant and boredom tasks, this package came into existence.

With this package end goal is to save time and automate process on following items
* Transformers
* Helpers
* Response
* Form Request Validation
* View

To install package run following command in terminal from root the laravel project

```composer install bhanushalimahesh3/laravel-app-boilerplate```

After package is installed, run following command to list out all commands of this package

```php artisan list```

Following are this packages command

```
   boilerplate-package:install
   boilerplate-package:transformer
   boilerplate-package:helper
   boilerplate-package:form-request
   boilerplate-package:view
```

