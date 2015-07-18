<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Objetivo;
use AppBundle\Form\ObjetivoType;

/**
 * Objetivo controller.
 *
 * @Route("/objetivo")
 */
class ObjetivoController extends Controller
{

    /**
     * Lists all Objetivo entities.
     *
     * @Route("/", name="objetivo")
     * @Method("GET")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Objetivo')->findAll();

        return $this->render('', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Objetivo entity.
     *
     * @Route("/", name="objetivo_create")
     * @Method("POST")
     * @Template("AppBundle:Objetivo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Objetivo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('objetivo_show', array('id' => $entity->getId())));
        }

        return $this->render('', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Objetivo entity.
     *
     * @param Objetivo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Objetivo $entity)
    {
        $form = $this->createForm(new ObjetivoType(), $entity, array(
            'action' => $this->generateUrl('objetivo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Objetivo entity.
     *
     * @Route("/new", name="objetivo_new")
     * @Method("GET")
     *
     */
    public function newAction()
    {
        $entity = new Objetivo();
        $form   = $this->createCreateForm($entity);

        return $this->render('', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Objetivo entity.
     *
     * @Route("/{id}", name="objetivo_show")
     * @Method("GET")
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Objetivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Objetivo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Objetivo entity.
     *
     * @Route("/{id}/edit", name="objetivo_edit")
     * @Method("GET")
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Objetivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Objetivo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Objetivo entity.
    *
    * @param Objetivo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Objetivo $entity)
    {
        $form = $this->createForm(new ObjetivoType(), $entity, array(
            'action' => $this->generateUrl('objetivo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Objetivo entity.
     *
     * @Route("/{id}", name="objetivo_update")
     * @Method("PUT")
     * @Template("AppBundle:Objetivo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Objetivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Objetivo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('objetivo_edit', array('id' => $id)));
        }

        return $this->render('', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Objetivo entity.
     *
     * @Route("/{id}", name="objetivo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Objetivo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Objetivo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('objetivo'));
    }

    /**
     * Creates a form to delete a Objetivo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('objetivo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
