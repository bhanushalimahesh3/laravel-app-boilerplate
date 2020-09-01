# Laravel App Boilerplate

I, most of the time follow the same code structure across all Laravel apps and eventually end up copy/pasting the base structure from existing project to new projects until some new pattern is followed/amended. 

Also while creating custom files **i.e helper or transformer class, view files etc** we copy/paste scaffolding from existing file to new file and start working on it. So to avoid or save time by doing all these manual, redundant and boredom tasks, this package came into existence.

With this package end goal is to save time and automate process on following items
* Transformers
* Helpers
* Response Trait
* Form Request Validation
* View

To install package, run following command in terminal from root folder of the laravel project

```composer install bhanushalimahesh3/laravel-app-boilerplate```

After package is installed, run following command to list out all the commands of this package

```php artisan list```

Once you run above command, you can find following commands in the list of commands displayed

```
   boilerplate-package:install
   boilerplate-package:transformer
   boilerplate-package:helper
   boilerplate-package:form-request
   boilerplate-package:view
```
Will walk through each command.

Run command ```php artisan boilerplate-package:install```, with this command configuration file **boilerplate_package.php** will be published in laravel project's config folder. In this file you can configure folder names for Transformer, Helper, Response Trait and View.

Run command ```php artisan boilerplate-package:transformer Foo/BarTransformer```, so this command will create *BarTransformer* class file inside *app/{folder in config file}/Foo* folder. When you create first Transformer file, base Transformer abstract class file is also created on first hit of this command in *app/{folder in config file}*.

Run command ```php artisan boilerplate-package:helper Foo/BarHelper```, so this command will create *BarHelper* class inside *app/{folder in config file}/Foo* folder. When you create first Helper file, base Helper class file is also created on first hit of this command in *app/{folder in config file}*. Also ResponseTrait file is also created on first hit of helper command in *project/{folder in config file}/ResponseTrait*.

Run command ```php artisan boilerplate-package:form-request Foo/BarTrait```, so this command will create a trait file which can be used as a common rules file for a create and update operation on a Bar module. Also *BaseRequestHandler* interface is created on the first hit of this command which can be used to implement defined methods in interface. And these methods body are generated when you create first request trait. 
Let's say we have a form with fields name, email, dob. Now for insert operation we will create a file with help of laravel defined command ```php artisan make:request Foo/Bar/Create``` so this will create file name Create.php in *app/Http/Request/Foo/Bar/Create* and in the rules method of this we'll add validation for above 3 fields. Now we'll create one more file Update.php for update operation and in the rules method of Update.php we'll add validation rules for 3 fields. So keeping common rules in one place for the same module is the goal of ```php artisan boilerplate-package:form-request```. Like rules there are other methods also in this trait.

Run command ```php artisan boilerplate-package:view layout``` or ```php artisan boilerplate-package:view viewName layoutNameToExtend``` to create layouts & partial or new blade view file which extends defined layout passed in command.
When you run layout command auth & guest layout as well as partials are created in a folder defined in the config file. If folder name are not changed the in *app/resources/views/layouts* folder auth.blade.php and guest.blade.php with basic structure is created.  And *header.blade.php, css.balde.php and js.blade.php* are created in *app/resources/views/partials* folder, if default folder name is config file is not changed.




