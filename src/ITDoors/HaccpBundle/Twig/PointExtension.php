<?php

namespace ITDoors\HaccpBundle\Twig;

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

    public function pointCharacteristicColor($characteristicId, $value)
    {
        return $characteristicId . '&&&&&' .$value;
    }

    public function getName()
    {
        return 'point_extension';
    }
}