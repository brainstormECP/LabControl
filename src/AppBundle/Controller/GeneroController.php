<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Genero;
use AppBundle\Form\GeneroType;

/**
 * Genero controller.
 *
 * @Route("/genero")
 */
class GeneroController extends Controller
{

    /**
     * Lists all Genero entities.
     *
     * @Route("/", name="genero")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Genero')->findAll();

        return $this->render('genero/index.html.twig',array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Genero entity.
     *
     * @Route("/", name="genero_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new Genero();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se agregó correctamente el Género');
            return $this->redirect($this->generateUrl('genero', array('id' => $entity->getId())));
        }

        return $this->render('genero/new.html.twig',array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Genero entity.
     *
     * @param Genero $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Genero $entity)
    {
        $form = $this->createForm(new GeneroType(), $entity, array(
            'action' => $this->generateUrl('genero_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Genero entity.
     *
     * @Route("/new", name="genero_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $entity = new Genero();
        $form   = $this->createCreateForm($entity);

        return $this->render('genero/new.html.twig',array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Genero entity.
     *
     * @Route("/{id}", name="genero_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Genero')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genero entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('genero/show.html.twig',array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Genero entity.
     *
     * @Route("/{id}/edit", name="genero_edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Genero')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genero entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('genero/edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Genero entity.
    *
    * @param Genero $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Genero $entity)
    {
        $form = $this->createForm(new GeneroType(), $entity, array(
            'action' => $this->generateUrl('genero_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Genero entity.
     *
     * @Route("/{id}", name="genero_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Genero')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genero entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se edito correctamente el Género');
            return $this->redirect($this->generateUrl('genero', array('id' => $id)));
        }

        return $this->render('genero/edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Genero entity.
     *
     * @Route("/{id}", name="genero_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Genero')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Genero entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('genero'));
    }

    /**
     * Creates a form to delete a Genero entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('genero_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar','attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
