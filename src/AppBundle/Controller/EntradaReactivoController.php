<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\EntradaReactivo;
use AppBundle\Form\EntradaReactivoType;

/**
 * EntradaReactivo controller.
 *
 * @Route("/entradareactivo")
 */
class EntradaReactivoController extends Controller
{

    /**
     * Lists all EntradaReactivo entities.
     *
     * @Route("/", name="entradareactivo")
     * @Method("GET")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:EntradaReactivo')->findAll();

        return $this->render('entradareactivo/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new EntradaReactivo entity.
     *
     * @Route("/", name="entradareactivo_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new EntradaReactivo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se creo correctamente la Entrada de Reactivo');
            return $this->redirect($this->generateUrl('entradareactivo', array('id' => $entity->getId())));
        }

        return $this->render('entradareactivo/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a EntradaReactivo entity.
     *
     * @param EntradaReactivo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(EntradaReactivo $entity)
    {
        $form = $this->createForm(new EntradaReactivoType(), $entity, array(
            'action' => $this->generateUrl('entradareactivo_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new EntradaReactivo entity.
     *
     * @Route("/new", name="entradareactivo_new")
     * @Method("GET")
     *
     */
    public function newAction()
    {
        $entity = new EntradaReactivo();
        $form   = $this->createCreateForm($entity);

        return $this->render('entradareactivo/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a EntradaReactivo entity.
     *
     * @Route("/{id}", name="entradareactivo_show")
     * @Method("GET")
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:EntradaReactivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EntradaReactivo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('entradareactivo/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing EntradaReactivo entity.
     *
     * @Route("/{id}/edit", name="entradareactivo_edit")
     * @Method("GET")
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:EntradaReactivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EntradaReactivo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('entradareactivo/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a EntradaReactivo entity.
    *
    * @param EntradaReactivo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(EntradaReactivo $entity)
    {
        $form = $this->createForm(new EntradaReactivoType(), $entity, array(
            'action' => $this->generateUrl('entradareactivo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing EntradaReactivo entity.
     *
     * @Route("/{id}", name="entradareactivo_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:EntradaReactivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EntradaReactivo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se edito correctamente la Entrada de Reactivo');
            return $this->redirect($this->generateUrl('entradareactivo', array('id' => $id)));
        }

        return $this->render('entradareactivo/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a EntradaReactivo entity.
     *
     * @Route("/{id}", name="entradareactivo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:EntradaReactivo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EntradaReactivo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('entradareactivo'));
    }

    /**
     * Creates a form to delete a EntradaReactivo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('entradareactivo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar','attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
