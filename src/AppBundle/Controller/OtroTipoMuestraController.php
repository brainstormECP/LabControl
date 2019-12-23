<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\OtroTipoMuestra;
use AppBundle\Form\OtroTipoMuestraType;

/**
 * OtroTipoMuestra controller.
 *
 * @Route("/otrotipomuestra")
 */
class OtroTipoMuestraController extends Controller
{

    /**
     * Lists all OtroTipoMuestra entities.
     *
     * @Route("/", name="otrotipomuestra")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:OtroTipoMuestra')->findAll();

        return $this->render('otrotipomuestra/index.html.twig',array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new OtroTipoMuestra entity.
     *
     * @Route("/", name="otrotipomuestra_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new OtroTipoMuestra();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se creo correctamente el <strong>Tipo de muestra</strong>');
            return $this->redirect($this->generateUrl('otrotipomuestra', array('id' => $entity->getId())));
        }

        return $this->render('otrotipomuestra/new.html.twig',array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a OtroTipoMuestra entity.
     *
     * @param OtroTipoMuestra $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(OtroTipoMuestra $entity)
    {
        $form = $this->createForm(new OtroTipoMuestraType(), $entity, array(
            'action' => $this->generateUrl('otrotipomuestra_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new OtroTipoMuestra entity.
     *
     * @Route("/new", name="otrotipomuestra_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $entity = new OtroTipoMuestra();
        $form   = $this->createCreateForm($entity);

        return $this->render('otrotipomuestra/new.html.twig',array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a OtroTipoMuestra entity.
     *
     * @Route("/{id}", name="otrotipomuestra_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:OtroTipoMuestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OtroTipoMuestra entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('otrotipomuestra/show.html.twig',array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing OtroTipoMuestra entity.
     *
     * @Route("/{id}/edit", name="otrotipomuestra_edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:OtroTipoMuestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OtroTipoMuestra entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('otrotipomuestra/edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a OtroTipoMuestra entity.
    *
    * @param OtroTipoMuestra $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(OtroTipoMuestra $entity)
    {
        $form = $this->createForm(new OtroTipoMuestraType(), $entity, array(
            'action' => $this->generateUrl('otrotipomuestra_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing OtroTipoMuestra entity.
     *
     * @Route("/{id}", name="otrotipomuestra_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:OtroTipoMuestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OtroTipoMuestra entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se edito correctamente el <strong>Tipo de muestra</strong>');
            return $this->redirect($this->generateUrl('otrotipomuestra', array('id' => $id)));
        }

        return $this->render('otrotipomuestra/edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a OtroTipoMuestra entity.
     *
     * @Route("/{id}", name="otrotipomuestra_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:OtroTipoMuestra')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OtroTipoMuestra entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('otrotipomuestra'));
    }

    /**
     * Creates a form to delete a OtroTipoMuestra entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('otrotipomuestra_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
