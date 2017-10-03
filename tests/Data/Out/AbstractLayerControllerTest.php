<?php
namespace PHPAPILibrary\Core\Data\Out;

use PHPAPILibrary\Core\Data\AccessControllerInterface;
use PHPAPILibrary\Core\Data\CacheControllerInterface;
use PHPAPILibrary\Core\Data\LoggerInterface;
use PHPAPILibrary\Core\Data\RateControllerInterface;
use PHPAPILibrary\Core\Data\ResponseInterface;

class AbstractLayerControllerTest extends \PHPAPILibrary\Core\Data\AbstractLayerControllerTest
{
    //Test that the translators are called with request, and that when the next layer returns a response it is translated and returned
    //Test that """                                                               """ throws an exception, it is translated to this layer's exception (with a translated response) and thrown
    //  - For each exception type (access/rate/general)
}
