<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Reactivo;
use AppBundle\Form\ReactivoType;

/**
 * Reactivo controller.
 *
 * @Route("/reactivo")
 */
class ReactivoController extends Controller
{

    /**
     * Lists all Reactivo entities.
     *
     * @Route("/", name="reactivo")
     * @Method("GET")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Reactivo')->findAll();

        return $this->render('reactivo/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Reactivo entity.
     *
     * @Route("/", name="reactivo_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new Reactivo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se creo correctamente el Reactivo');
            return $this->redirect($this->generateUrl('reactivo', array('id' => $entity->getId())));
        }

        return $this->render('reactivo/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Reactivo entity.
     *
     * @param Reactivo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Reactivo $entity)
    {
        $form = $this->createForm(new ReactivoType(), $entity, array(
            'action' => $this->generateUrl('reactivo_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Reactivo entity.
     *
     * @Route("/new", name="reactivo_new")
     * @Method("GET")
     *
     */
    public function newAction()
    {
        $entity = new Reactivo();
        $form   = $this->createCreateForm($entity);

        return $this->render('reactivo/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Reactivo entity.
     *
     * @Route("/{id}", name="reactivo_show")
     * @Method("GET")
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Reactivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reactivo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('reactivo/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Reactivo entity.
     *
     * @Route("/{id}/edit", name="reactivo_edit")
     * @Method("GET")
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Reactivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reactivo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('reactivo/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Reactivo entity.
    *
    * @param Reactivo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Reactivo $entity)
    {
        $form = $this->createForm(new ReactivoType(), $entity, array(
            'action' => $this->generateUrl('reactivo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Reactivo entity.
     *
     * @Route("/{id}", name="reactivo_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Reactivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reactivo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se edito correctamente el Reactivo');
            return $this->redirect($this->generateUrl('reactivo', array('id' => $id)));
        }

        return $this->render('reactivo/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Reactivo entity.
     *
     * @Route("/{id}", name="reactivo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Reactivo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Reactivo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('reactivo'));
    }

    /**
     * Creates a form to delete a Reactivo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reactivo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar','attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
