<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Pno;
use AppBundle\Form\PnoType;

/**
 * Pno controller.
 *
 * @Route("/pno")
 */
class PnoController extends Controller
{

    /**
     * Lists all Pno entities.
     *
     * @Route("/", name="pno")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Pno')->findAll();

        return $this->render('pno/index.html.twig',array(
            'entities' => $entities,
        ));
    }


    /**
     * Creates a new Pno entity.
     *
     * @Route("/", name="pno_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new Pno();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pno', array('id' => $entity->getId())));
        }

        return $this->render('pno/new.html.twig',array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Pno entity.
     *
     * @param Pno $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pno $entity)
    {
        $form = $this->createForm(new PnoType(), $entity, array(
            'action' => $this->generateUrl('pno_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Pno entity.
     *
     * @Route("/new", name="pno_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $entity = new Pno();
        $form   = $this->createCreateForm($entity);

        return $this->render('pno/new.html.twig',array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pno entity.
     *
     * @Route("/{id}", name="pno_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Pno')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pno entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('pno/show.html.twig',array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pno entity.
     *
     * @Route("/{id}/edit", name="pno_edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Pno')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pno entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('pno/edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Pno entity.
    *
    * @param Pno $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pno $entity)
    {
        $form = $this->createForm(new PnoType(), $entity, array(
            'action' => $this->generateUrl('pno_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Pno entity.
     *
     * @Route("/{id}", name="pno_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Pno')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pno entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pno', array('id' => $id)));
        }

        return $this->render('pno/edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Pno entity.
     *
     * @Route("/{id}", name="pno_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Pno')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pno entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pno'));
    }

    /**
     * Creates a form to delete a Pno entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pno_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
