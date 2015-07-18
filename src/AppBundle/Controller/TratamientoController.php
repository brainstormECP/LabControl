<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Tratamiento;
use AppBundle\Form\TratamientoType;

/**
 * Tratamiento controller.
 *
 * @Route("/tratamiento")
 */
class TratamientoController extends Controller
{

    /**
     * Lists all Tratamiento entities.
     *
     * @Route("/", name="tratamiento")
     * @Method("GET")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Tratamiento')->findAll();

        return $this->render('', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tratamiento entity.
     *
     * @Route("/", name="tratamiento_create")
     * @Method("POST")
     * @Template("AppBundle:Tratamiento:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Tratamiento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tratamiento_show', array('id' => $entity->getId())));
        }

        return $this->render('', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tratamiento entity.
     *
     * @param Tratamiento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tratamiento $entity)
    {
        $form = $this->createForm(new TratamientoType(), $entity, array(
            'action' => $this->generateUrl('tratamiento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Tratamiento entity.
     *
     * @Route("/new", name="tratamiento_new")
     * @Method("GET")
     *
     */
    public function newAction()
    {
        $entity = new Tratamiento();
        $form   = $this->createCreateForm($entity);

        return $this->render('', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tratamiento entity.
     *
     * @Route("/{id}", name="tratamiento_show")
     * @Method("GET")
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Tratamiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tratamiento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tratamiento entity.
     *
     * @Route("/{id}/edit", name="tratamiento_edit")
     * @Method("GET")
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Tratamiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tratamiento entity.');
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
    * Creates a form to edit a Tratamiento entity.
    *
    * @param Tratamiento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tratamiento $entity)
    {
        $form = $this->createForm(new TratamientoType(), $entity, array(
            'action' => $this->generateUrl('tratamiento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Tratamiento entity.
     *
     * @Route("/{id}", name="tratamiento_update")
     * @Method("PUT")
     * @Template("AppBundle:Tratamiento:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Tratamiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tratamiento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tratamiento_edit', array('id' => $id)));
        }

        return $this->render('', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tratamiento entity.
     *
     * @Route("/{id}", name="tratamiento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Tratamiento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tratamiento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tratamiento'));
    }

    /**
     * Creates a form to delete a Tratamiento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tratamiento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
