<?php

namespace Frbr18\Playground;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class PlaygroundController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $db = "not active";

    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->db = "active";
    }

    public function indexAction()
    {
        // Deal with the action and return a response.
        $page = $this->di->get("page");
        $page->add("playground/hello");
        return $page->render();
    }
}
