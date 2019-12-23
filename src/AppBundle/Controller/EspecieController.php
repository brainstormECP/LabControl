<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Especie;
use AppBundle\Form\EspecieType;

/**
 * Especie controller.
 *
 * @Route("/especie")
 */
class EspecieController extends Controller
{

    /**
     * Lists all Especie entities.
     *
     * @Route("/", name="especie")
     * @Method("GET")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Especie')->findAll();

        return $this->render('especie/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Especie entity.
     *
     * @Route("/", name="especie_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new Especie();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se agrego correctamente la Especie');
            return $this->redirect($this->generateUrl('especie'));
        }

        return $this->render('especie/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Especie entity.
     *
     * @param Especie $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Especie $entity)
    {
        $form = $this->createForm(new EspecieType(), $entity, array(
            'action' => $this->generateUrl('especie_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Especie entity.
     *
     * @Route("/new", name="especie_new")
     * @Method("GET")
     *
     */
    public function newAction()
    {
        $entity = new Especie();
        $form   = $this->createCreateForm($entity);

        return $this->render('especie/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Especie entity.
     *
     * @Route("/{id}", name="especie_show")
     * @Method("GET")
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Especie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('especie/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Especie entity.
     *
     * @Route("/{id}/edit", name="especie_edit")
     * @Method("GET")
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Especie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especie entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('especie/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Especie entity.
    *
    * @param Especie $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Especie $entity)
    {
        $form = $this->createForm(new EspecieType(), $entity, array(
            'action' => $this->generateUrl('especie_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Especie entity.
     *
     * @Route("/{id}", name="especie_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Especie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se edito correctamente la Especie');
            return $this->redirect($this->generateUrl('especie'));
        }

        return $this->render('especie/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Especie entity.
     *
     * @Route("/{id}", name="especie_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Especie')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Especie entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('especie'));
    }

    /**
     * Creates a form to delete a Especie entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('especie_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
