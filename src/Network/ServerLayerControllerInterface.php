<?php
namespace PHPAPILibrary\Core\Network;

/**
 * Interface ServerLayerControllerInterface
 * @package PHPAPILibrary\Core\Network
 */
interface ServerLayerControllerInterface extends LayerControllerInterface
{
    /**
     * @return \PHPAPILibrary\Core\Identity\LayerControllerInterface
     */
    public function getIdentityLayer(): \PHPAPILibrary\Core\Identity\LayerControllerInterface;
}
