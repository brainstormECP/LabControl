<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Maestria;
use AppBundle\Form\MaestriaType;

/**
 * Maestria controller.
 *
 * @Route("/maestria")
 */
class MaestriaController extends Controller
{

    /**
     * Lists all Maestria entities.
     *
     * @Route("/", name="maestria")
     * @Method("GET")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Maestria')->findAll();

        return $this->render('maestria/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Maestria entity.
     *
     * @Route("/", name="maestria_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new Maestria();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se creo correctamente la Maestria');
            return $this->redirect($this->generateUrl('maestria'));
        }

        return $this->render('maestria/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Maestria entity.
     *
     * @param Maestria $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Maestria $entity)
    {
        $form = $this->createForm(new MaestriaType(), $entity, array(
            'action' => $this->generateUrl('maestria_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Maestria entity.
     *
     * @Route("/new", name="maestria_new")
     * @Method("GET")
     *
     */
    public function newAction()
    {
        $entity = new Maestria();
        $form   = $this->createCreateForm($entity);

        return $this->render('maestria/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Maestria entity.
     *
     * @Route("/{id}", name="maestria_show")
     * @Method("GET")
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Maestria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Maestria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('maestria/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Maestria entity.
     *
     * @Route("/{id}/edit", name="maestria_edit")
     * @Method("GET")
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Maestria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Maestria entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('maestria/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Maestria entity.
    *
    * @param Maestria $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Maestria $entity)
    {
        $form = $this->createForm(new MaestriaType(), $entity, array(
            'action' => $this->generateUrl('maestria_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Maestria entity.
     *
     * @Route("/{id}", name="maestria_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Maestria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Maestria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se edito correctamente la Maestria');
            return $this->redirect($this->generateUrl('maestria'));
        }

        return $this->render('maestria/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Maestria entity.
     *
     * @Route("/{id}", name="maestria_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Maestria')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Maestria entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('maestria'));
    }

    /**
     * Creates a form to delete a Maestria entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('maestria_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar','attr' => array('class'=>'btn btn-danger')))
            ->getForm()
        ;
    }
}
