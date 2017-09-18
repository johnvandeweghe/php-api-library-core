<?php
namespace PHPAPILibrary\Core\Data;

/**
 * Interface ClientLayerControllerInterface
 * @package PHPAPILibrary\Core\Data
 */
interface ClientLayerControllerInterface extends LayerControllerInterface
{
    /**
     * @return \PHPAPILibrary\Core\Identity\LayerControllerInterface
     */
    public function getIdentityLayer(): \PHPAPILibrary\Core\Identity\LayerControllerInterface;
}
