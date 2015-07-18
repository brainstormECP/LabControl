<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Muestra;
use AppBundle\Form\MuestraType;

/**
 * Muestra controller.
 *
 * @Route("/muestra")
 */
class MuestraController extends Controller
{

    /**
     * Lists all Muestra entities.
     *
     * @Route("/", name="muestra")
     * @Method("GET")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Muestra')->findAll();

        return $this->render('', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Muestra entity.
     *
     * @Route("/", name="muestra_create")
     * @Method("POST")
     * @Template("AppBundle:Muestra:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Muestra();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('muestra_show', array('id' => $entity->getId())));
        }

        return $this->render('', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Muestra entity.
     *
     * @param Muestra $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Muestra $entity)
    {
        $form = $this->createForm(new MuestraType(), $entity, array(
            'action' => $this->generateUrl('muestra_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Muestra entity.
     *
     * @Route("/new", name="muestra_new")
     * @Method("GET")
     *
     */
    public function newAction()
    {
        $entity = new Muestra();
        $form   = $this->createCreateForm($entity);

        return $this->render('', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Muestra entity.
     *
     * @Route("/{id}", name="muestra_show")
     * @Method("GET")
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Muestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Muestra entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Muestra entity.
     *
     * @Route("/{id}/edit", name="muestra_edit")
     * @Method("GET")
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Muestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Muestra entity.');
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
    * Creates a form to edit a Muestra entity.
    *
    * @param Muestra $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Muestra $entity)
    {
        $form = $this->createForm(new MuestraType(), $entity, array(
            'action' => $this->generateUrl('muestra_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Muestra entity.
     *
     * @Route("/{id}", name="muestra_update")
     * @Method("PUT")
     * @Template("AppBundle:Muestra:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Muestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Muestra entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('muestra_edit', array('id' => $id)));
        }

        return $this->render('', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Muestra entity.
     *
     * @Route("/{id}", name="muestra_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Muestra')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Muestra entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('muestra'));
    }

    /**
     * Creates a form to delete a Muestra entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('muestra_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
