<?php

namespace ITDoors\HaccpBundle\Twig;

/**
 * PointExtension
 */
class PointExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'pointCharacteristicColor' => new \Twig_Function_Method($this, 'pointCharacteristicColor')
        );
    }

    /**
     * pointCharacteristicColor
     *
     * @param int    $characteristicId
     * @param string $value
     *
     * @return string
     */
    public function pointCharacteristicColor($characteristicId, $value)
    {
        return $characteristicId . '&&&&&' .$value;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'point_extension';
    }
}
