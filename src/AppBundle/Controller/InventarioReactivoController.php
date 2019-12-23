<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\InventarioReactivo;

/**
 * InventarioReactivo controller.
 *
 * @Route("/inventarioreactivo")
 */
class InventarioReactivoController extends Controller
{

    /**
     * Lists all InventarioReactivo entities.
     *
     * @Route("/", name="inventarioreactivo")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:InventarioReactivo')->findAll();

        return $this->render('inventarioReactivo/index.html.twig',array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a InventarioReactivo entity.
     *
     * @Route("/{id}", name="inventarioreactivo_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:InventarioReactivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InventarioReactivo entity.');
        }

        return $this->render('inventarioReactivo/index.html.twig',array(
            'entity'      => $entity,
        ));
    }
}
