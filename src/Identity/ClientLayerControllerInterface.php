<?php
namespace PHPAPILibrary\Core\Identity;

/**
 * Interface ClientLayerController
 * @package PHPAPILibrary\Core\Identity
 */
interface ClientLayerControllerInterface extends LayerControllerInterface
{
    /**
     * @return \PHPAPILibrary\Core\Network\LayerControllerInterface
     */
    public function getNetworkLayer(): \PHPAPILibrary\Core\Network\LayerControllerInterface;
}
