# Done-In-A-Weekend PHP MVC Framework
> This repository tells a story of a young Perl/C boy diving into the harsh world of Object Orientation programming. They said that he attempted to create a MVC framework in a weekend using his newly acquired skills. Here lies the result.

Don't ever use this for production. If you're brave, you can try to fork/clone and improve this.

# Folders & Files
* ```\app\```: user created classes.
* ```\app\Controllers\```: user created controllers. You can subclass ```\Vendor\Controller``` and start creating your own controllers here.
* ```\app\Controller\HomeController.php```: default controller. will be called when the user accesses the url's root.
* ```\app\Model\SampleDataFill.php```: special classes that, when passed to a template, should explode it's data
* ```\app\View\```: template files should reside here. sample provided
* ```\configs\```: app and database configuration.
* ```\system\```: core framework classes.

# Templating

You can follow this syntax:

``` <!--[[object::method-parameter:array.index]]--> ```

Printing variable lions:

``` [[=lions]] ```

Accessing lions data:

``` [[lions]] ```

If-elseif-else:

```
<!--if [[username]] == 1 -->
Só se if for true

<!--elseif [[username]] == [[username]]-->
Só se if for false
<!--/if-->
```

__Templates are converted to pure php during first access OR when modified.__

## Installing

Clone inside apache/nginx folder.

## Licensing

Distributed under the GNU GENERAL PUBLIC LICENSE Version 3 license. See ``LICENSE`` for more information.

[https://github.com/marcelothebuilder/](https://github.com/marcelothebuilder/)

