<?php

namespace AppBundle\Utils;


class TwigExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('age', array($this, 'ageFilter'))
        );
    }

    public function ageFilter(\DateTime $dateBirth)
    {
        $now = new \DateTime();
        $diff = $now->diff($dateBirth);

        return $diff->y;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'twig_extension';
    }
}