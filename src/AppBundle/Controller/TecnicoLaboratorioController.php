<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\TecnicoLaboratorio;
use AppBundle\Form\TecnicoLaboratorioType;

/**
 * TecnicoLaboratorio controller.
 *
 * @Route("/tecnicolaboratorio")
 */
class TecnicoLaboratorioController extends Controller
{

    /**
     * Lists all TecnicoLaboratorio entities.
     *
     * @Route("/", name="tecnicolaboratorio")
     * @Method("GET")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:TecnicoLaboratorio')->findAll();

        return $this->render('tecnicoLaboratorio/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TecnicoLaboratorio entity.
     *
     * @Route("/", name="tecnicolaboratorio_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new TecnicoLaboratorio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        $entity->setActivationToken('no se que es');

        $plainPassword = $entity->getPassword();
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($entity, $plainPassword);
        $entity->setPassword($encoded);
        $entity->setIsActive(true);
        $entity->addRole($em = $this->getDoctrine()->getManager()->getRepository('AppBundle:Role')->findByNombre('Tecnico'));

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se creo correctamente el Tecnico');
            return $this->redirect($this->generateUrl('tecnicolaboratorio', array('id' => $entity->getId())));
        }

        return $this->render('tecnicoLaboratorio/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TecnicoLaboratorio entity.
     *
     * @param TecnicoLaboratorio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TecnicoLaboratorio $entity)
    {
        $form = $this->createForm(new TecnicoLaboratorioType(), $entity, array(
            'action' => $this->generateUrl('tecnicolaboratorio_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new TecnicoLaboratorio entity.
     *
     * @Route("/new", name="tecnicolaboratorio_new")
     * @Method("GET")
     *
     */
    public function newAction()
    {
        $entity = new TecnicoLaboratorio();
        $form   = $this->createCreateForm($entity);

        return $this->render('tecnicoLaboratorio/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TecnicoLaboratorio entity.
     *
     * @Route("/{id}", name="tecnicolaboratorio_show")
     * @Method("GET")
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TecnicoLaboratorio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TecnicoLaboratorio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('tecnicoLaboratorio/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TecnicoLaboratorio entity.
     *
     * @Route("/{id}/edit", name="tecnicolaboratorio_edit")
     * @Method("GET")
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TecnicoLaboratorio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TecnicoLaboratorio entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('tecnicoLaboratorio/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TecnicoLaboratorio entity.
    *
    * @param TecnicoLaboratorio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TecnicoLaboratorio $entity)
    {
        $form = $this->createForm(new TecnicoLaboratorioType(), $entity, array(
            'action' => $this->generateUrl('tecnicolaboratorio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        return $form;
    }
    /**
     * Edits an existing TecnicoLaboratorio entity.
     *
     * @Route("/{id}", name="tecnicolaboratorio_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:TecnicoLaboratorio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TecnicoLaboratorio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        $plainPassword = $entity->getPassword();
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($entity, $plainPassword);
        $entity->setPassword($encoded);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se edito correctamente el Tecnico');
            return $this->redirect($this->generateUrl('tecnicolaboratorio', array('id' => $id)));
        }

        return $this->render('tecnicoLaboratorio/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TecnicoLaboratorio entity.
     *
     * @Route("/{id}", name="tecnicolaboratorio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:TecnicoLaboratorio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TecnicoLaboratorio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tecnicolaboratorio'));
    }

    /**
     * Creates a form to delete a TecnicoLaboratorio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tecnicolaboratorio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
