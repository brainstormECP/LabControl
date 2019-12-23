<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\SalidaReactivo;
use AppBundle\Form\SalidaReactivoType;

/**
 * SalidaReactivo controller.
 *
 * @Route("/salidareactivo")
 */
class SalidaReactivoController extends Controller
{

    /**
     * Lists all SalidaReactivo entities.
     *
     * @Route("/", name="salidareactivo")
     * @Method("GET")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:SalidaReactivo')->findAll();

        return $this->render('salidareactivo/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SalidaReactivo entity.
     *
     * @Route("/", name="salidareactivo_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new SalidaReactivo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se creo correctamente la Salida de Reactivo');
            return $this->redirect($this->generateUrl('salidareactivo', array('id' => $entity->getId())));
        }

        return $this->render('salidareactivo/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SalidaReactivo entity.
     *
     * @param SalidaReactivo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SalidaReactivo $entity)
    {
        $form = $this->createForm(new SalidaReactivoType(), $entity, array(
            'action' => $this->generateUrl('salidareactivo_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new SalidaReactivo entity.
     *
     * @Route("/new", name="salidareactivo_new")
     * @Method("GET")
     *
     */
    public function newAction()
    {
        $entity = new SalidaReactivo();
        $form   = $this->createCreateForm($entity);

        return $this->render('salidareactivo/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SalidaReactivo entity.
     *
     * @Route("/{id}", name="salidareactivo_show")
     * @Method("GET")
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:SalidaReactivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SalidaReactivo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('salidareactivo/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SalidaReactivo entity.
     *
     * @Route("/{id}/edit", name="salidareactivo_edit")
     * @Method("GET")
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:SalidaReactivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SalidaReactivo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('salidareactivo/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SalidaReactivo entity.
    *
    * @param SalidaReactivo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SalidaReactivo $entity)
    {
        $form = $this->createForm(new SalidaReactivoType(), $entity, array(
            'action' => $this->generateUrl('salidareactivo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing SalidaReactivo entity.
     *
     * @Route("/{id}", name="salidareactivo_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:SalidaReactivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SalidaReactivo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se edito correctamente la Salida de Reactivo');
            return $this->redirect($this->generateUrl('salidareactivo', array('id' => $id)));
        }

        return $this->render('salidareactivo/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SalidaReactivo entity.
     *
     * @Route("/{id}", name="salidareactivo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:SalidaReactivo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SalidaReactivo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('salidareactivo'));
    }

    /**
     * Creates a form to delete a SalidaReactivo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('salidareactivo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
