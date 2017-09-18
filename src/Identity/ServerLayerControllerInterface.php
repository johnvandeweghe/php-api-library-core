<?php
namespace PHPAPILibrary\Core\Identity;

/**
 * Interface ServerLayerControllerInterface
 * @package PHPAPILibrary\Core\Identity
 */
interface ServerLayerControllerInterface extends LayerControllerInterface
{
    /**
     * @return \PHPAPILibrary\Core\Data\LayerControllerInterface
     */
    public function getDataLayer(): \PHPAPILibrary\Core\Data\LayerControllerInterface;
}
