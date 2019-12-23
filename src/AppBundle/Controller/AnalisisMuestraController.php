<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\AnalisisMuestra;
use AppBundle\Form\AnalisisMuestraType;

/**
 * AnalisisMuestra controller.
 *
 * @Route("/analisismuestra")
 */
class AnalisisMuestraController extends Controller
{

    /**
     * Lists all AnalisisMuestra entities.
     *
     * @Route("/", name="analisismuestra")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:AnalisisMuestra')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new AnalisisMuestra entity.
     *
     * @Route("/", name="analisismuestra_create")
     * @Method("POST")
     * @Template("AppBundle:AnalisisMuestra:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new AnalisisMuestra();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('analisismuestra_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a AnalisisMuestra entity.
     *
     * @param AnalisisMuestra $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(AnalisisMuestra $entity)
    {
        $form = $this->createForm(new AnalisisMuestraType(), $entity, array(
            'action' => $this->generateUrl('analisismuestra_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AnalisisMuestra entity.
     *
     * @Route("/new", name="analisismuestra_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AnalisisMuestra();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a AnalisisMuestra entity.
     *
     * @Route("/{id}", name="analisismuestra_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:AnalisisMuestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AnalisisMuestra entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AnalisisMuestra entity.
     *
     * @Route("/{id}/edit", name="analisismuestra_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:AnalisisMuestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AnalisisMuestra entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a AnalisisMuestra entity.
    *
    * @param AnalisisMuestra $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AnalisisMuestra $entity)
    {
        $form = $this->createForm(new AnalisisMuestraType(), $entity, array(
            'action' => $this->generateUrl('analisismuestra_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AnalisisMuestra entity.
     *
     * @Route("/{id}", name="analisismuestra_update")
     * @Method("PUT")
     * @Template("AppBundle:AnalisisMuestra:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:AnalisisMuestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AnalisisMuestra entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('analisismuestra_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a AnalisisMuestra entity.
     *
     * @Route("/{id}", name="analisismuestra_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:AnalisisMuestra')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AnalisisMuestra entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('analisismuestra'));
    }

    /**
     * Creates a form to delete a AnalisisMuestra entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('analisismuestra_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
