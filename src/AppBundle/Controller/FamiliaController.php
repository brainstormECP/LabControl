<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Familia;
use AppBundle\Form\FamiliaType;

/**
 * Familia controller.
 *
 * @Route("/familia")
 */
class FamiliaController extends Controller
{

    /**
     * Lists all Familia entities.
     *
     * @Route("/", name="familia")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Familia')->findAll();

        return $this->render('familia/index.html.twig',array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Familia entity.
     *
     * @Route("/", name="familia_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new Familia();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Nueva Familia agregada correctamente');
            return $this->redirect($this->generateUrl('familia', array('id' => $entity->getId())));
        }

        return $this->render('familia/new.html.twig',array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Familia entity.
     *
     * @param Familia $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Familia $entity)
    {
        $form = $this->createForm(new FamiliaType(), $entity, array(
            'action' => $this->generateUrl('familia_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Familia entity.
     *
     * @Route("/new", name="familia_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $entity = new Familia();
        $form   = $this->createCreateForm($entity);

        return $this->render('familia/new.html.twig',array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Familia entity.
     *
     * @Route("/{id}", name="familia_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Familia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Familia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('familia/show.html.twig',array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Familia entity.
     *
     * @Route("/{id}/edit", name="familia_edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Familia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Familia entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('familia/edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Familia entity.
    *
    * @param Familia $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Familia $entity)
    {
        $form = $this->createForm(new FamiliaType(), $entity, array(
            'action' => $this->generateUrl('familia_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Familia entity.
     *
     * @Route("/{id}", name="familia_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Familia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Familia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se edito correctamente la Familia');
            return $this->redirect($this->generateUrl('familia', array('id' => $id)));
        }

        return $this->render('familia/edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Familia entity.
     *
     * @Route("/{id}", name="familia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Familia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Familia entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('familia'));
    }

    /**
     * Creates a form to delete a Familia entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('familia_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
