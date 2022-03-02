# Coding standards
- Ref.: <a href="https://symfony.com/doc/current/contributing/code/standards.html">link</a>
- Add a single space after comma delimiters.
- Add a single space around binary operators.
- Use braces to indicate control structure body.
- Defined <b>one</b> class per file.
- Declare properties (fields/attributes) before methods.
- Declare methods in the following order: `public`, `protected` and `private`.

# Naming conventions
- Use camelCase for `variables`, `functions`, `methods` and `arguments`.
- Use snake_case for configuration parameters and Twig template variables.
- Namespaces should be UpperCamelCase.
- Suffix the following with:
    - Interfaces with Interface
    - Traits with Trait
    - Exceptions with Exception

# MVC Pattern
- "M" - Model:
  - manages the fundamental behaviour and data.
  - interacts with the requests from input fields.
  - responds to instructions.
  - notifies observers in event-driven systems.
- "V" - View:
  - interface (visual) of the application.
  - pulls data from the database and translates it into the views.
  
- "C" - Controller:
  - takes http requests and retrieves the corresponding data.
  - validates user input.
  - sends responses back to the user.

Note:
- <b style="color: red">Do not use the view or controller in the model.</b>
- <b style="color: red">No SQL should be used inside the controller or views.</b>

Use case (sample):
  - In the case of an E-commerce application, the user will look at a view, he will add products to his shopping cart.
  - The controller accepts the request and responds by interacting with the model, the model retrieves the product(s) and sends
them back to the controller. The controller further sends the product(s) to the view.

# Symfony sample project
- This project is a hands-on approach to learning the Symfony (v.: 6.0.3) PHP framework.
- Reference: <a href="https://www.youtube.com/watch?v=kJrCd5RcC0g&list=PLFHz2csJcgk-t8ErN1BHUUxTNj45dkSqS&index=5">link</a>

# Project Structure
1. The `bin` directory, it contains only one file and contains the main CLI entry point (the console).
2. The `config` directory, contains default configurations for the project.
3. The `public` directory, contains the main HTTP resources with the `index.php` file being the main entry point for dynamic
HTTP resources.
4. The `src` (source) directory is <b>the most important directory</b>, the `Kernel.php` is the heart of the application
and all the adherent files will use the `App` namespace.
5. The `var` directory contains all cache and log files that are generated at runtime by the application.
6. The `vendor` directory contains all the packages that are installed through <a href="https://getcomposer.org/">Composer</a>, <u><b>this
directory should never be directly changed</b></u>.

# CLI commands
- Note.: When seeing the terms "execute", "run" or "CLI", a terminal should be used.
- <b>Terminals:</b>
  - <a href="https://www.microsoft.com/en-us/p/windows-terminal/9n0dx20hk701#activetab=pivot:overviewtab">Windows Terminal (preferred as it can use other terminals and has a lot of useful features)</a>
  - <a href="https://git-scm.com/downloads">Bash (comes with the installation of Git)</a>
  - Command prompt (windows default)
  - <a href="https://hyper.is/">Hyper</a> 
  - PowerShell (windows and VSCode)
### General
- To create a new Symfony project (using <a href="https://getcomposer.org/">Composer</a>) execute the following command
`composer create-project symfony/skeleton projectName`. The anatomy of the previous command is, `composer create-project`
creates a project, `symfony/skeleton` implies that the Symfony project template should be used, `projectName` is the name
of the project to be created.
- To check available CLI commands, run `symfony console` or `symfony console --help`.
- To check if the current Symfony version, Symfony CLI version and PHP (should be 8+) are valid (as per Symfony project 
configuration requirements), run `symfony check:requirements`.
- To check the Symfony CLI version, run `bin/console --version`.
### Server
- To run the development server (in debug mode), execute `symfony server:start -d`.
- To stop the development server, execute `symfony server:stop`.

# Controllers
- In MVC, these organize the logic for one or more routes (HTTP resources/endpoints) in one place. They should not contain
all the application logic. Can be perceived as "traffic cops" that route HTTP requests within the application.
- To create controllers, these require configuration first which can be done in the following ways:
  - with yaml.
  - with xml.
  - with PHP.
  - with annotations (the classic/old approach).
- Annotations allow the configuration to be specified in the controller itself, however they require a dependency -"annotations",
this can be installed using <a href="https://getcomposer.org/">Composer</a> by executing the following command `composer require annotations`.
- After the routing configuration has been chosen, a controller can be created (scaffolded) using the CLI by running the following command
`symfony console make:controller ControllerNameController` (note that the ControllerName is suffixed with the term `Controller` this is required and
will be the class name of the scaffolded controller). Example: `symfony console make:controller MoviesController`.
- If facing the error <b style="color: red">There are no commands defined in the "make" namespaces.</b> either follow the suggestion or install
the `maker bundle` by running the following command `composer require symfony maker-bundle --dev`, then the previous command (controller creation) can be run.
#### Sample
- After executing `symfony console make:controller MoviesController`, in `root/src/Controller` a file entitled "MoviesController.php" should be present and its
contents should look similar to the below "Sample".
```
namespace App\Controller;

# Below, marked by the "use" keyword the class imports are defined.
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    /**
     * Below, the 'Route' attribute indicates that this is a route (HTTP) defining the route and the method that handles
     * it (the event of the '/movies' subresource being accessed in the browser). The 'index()' is function is called/returned
     * instantly when the '/movies' subresource is accessed (use the url "http://127.0.0.1:8000/movies").
     * @return Response
     */
    #[Route('/movies', name: 'app_movies')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MoviesController.php',
        ]);
    }
}
```
- Note that routing logic is found in the `root/config/routes.yaml` within this file, the `resource` property permits
the creation of the HTTP routes based on the controller annotations.

### Route parameters
- Perform CRUD operations on a specific entry/object, for example the movie with id `24`.
- By default, the controller methods will have `ANY` as a value for the `Method` route parameter, this can be changed
to specific HTTP verbs ('GET', 'DELETE', etc...) by adding the `methods` parameter after the `name` parameter and assign
it an array of strings with the needed values, for example `methods: ['GET', 'HEAD']`.
#### Sample
- The below method 
```
    /**
     * Returns a JSON response containing the URI variable string `name`, if no string value is 
     * provided, it will return `null` as a JSON string value.
     * @param $name : Variable entered in the url request.
     * @return Response
     */
    #[Route('/movies/{name}', name: 'app_movies', defaults: ['name' => null], methods: ['GET', 'HEAD'])]
    public function getMovieByName($name): Response
    {
        return $this->json([
            'message' => $name,
            'path' => 'src/Controller/MoviesController.php',
        ]);
    }
```
- When accessing the endpoint - "http://127.0.0.1:8000/movies/inception", the value of `$name` will become
"inception", if no string is provided, then the default value of `null` will be returned.

### Available routes
- To view/list the available HTTP endpoints (routes), run `symfony console debug:router`. This will list all the available routes
in the application.

# Twig
- Templating engine used with Symfony, S.S.R. mechanics.
- Importing (installation of dependency), run `composer require twig`.
- After the previous command is executed, a new directory `templates` will be created in the root directory of the
application. The `templates` directory is where all views will be stored/kept.
- When using Twig, the endpoint resource's method will return a view (twig, for example `index.html.twig`),
for this to be possible, in the endpoint resource's method the `render()` method must be used and provided an argument
with the filename of the twig file to be rendered (see sample below).
#### Sample
```
    // This is the route of the controller, "MoviesController.php"
    #[Route('/movies', name: 'movies')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
    
    // This is the HTML content of the twig template
    <h1>
      Welcome to this Symfony course!.
    </h1>
```
### Variable embedding
- Done using the "banana box syntax", `{{ variableName }}` where `variableName` is a key from the provided arguments'
array of the render method, for example 'title' will be accessed with `{{ title }}`.
### Comments
- Ref.: <a href="https://www.branchcms.com/learn/docs/developer/twig/comments">link</a>
- Can be added in templates using this format `{# comment #}`.
### Debugging
- To debug templates, we can use "dump(templateVariableName)" which in the case of the tile variable would
output `string(17) "Avengers:Endgame"`
### Conditional rendering
- In the below code snippet (twig template), if title is set/provided (the value is not empty), the first
paragraph will be rendered otherwise the second paragraph will be rendered.
```
{% if title %}
  <p>{{title}} is a movie</p>
{% else %}
  <p>Whoops, no title has been set.</p>
{% endif %}
```
### Looping
- If values are sent (by the controller) in an array, within the template, they should be iterated over.
#### Sample:
```
// Controller
#[Route('/movies', name: 'movies')]
public function index(): Response
{
    $movies = ['Avengers: Endgame', 'Inception', 'Loki', 'Black Widow'];
    return $this->render('index.html.twig', array(
        'movies' => $movies
    ));
}
```
```
{# Twig template #}
{% block body %}
    {% for movie in movies %}
        <li>{{ movie }}</li>
    {% endfor %}
{% endblock %}
```
### Global variables
- `_self` used as `{{_self}}` will display the name of the currently viewed/accessed page.
- `_charset` used as `{{_charset}}` will display the web document format (usually UTF-8).
- Global variables can also be defined in `root/config/packages/twig.yaml` in the following way:
```
# under `default_path` add globals
twig:
    default_path: '%kernel.project_dir%/templates'
    globals:
        author: EDFIS
        # other global variables will be added as tuples below `author`.
```