<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Investigador;
use AppBundle\Form\InvestigadorType;

/**
 * Investigador controller.
 *
 * @Route("/investigador")
 */
class InvestigadorController extends Controller
{

    /**
     * Lists all Investigador entities.
     *
     * @Route("/", name="investigador")
     * @Method("GET")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Investigador')->findAll();

        return $this->render('investigador/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Investigador entity.
     *
     * @Route("/", name="investigador_create")
     * @Method("POST")
     * @Template("AppBundle:Investigador:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Investigador();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        $entity->setActivationToken('no se que es');

        $plainPassword = $entity->getPassword();
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($entity, $plainPassword);
        $entity->setPassword($encoded);
        $entity->setIsActive(true);
        $entity->addRole($em = $this->getDoctrine()->getManager()->getRepository('AppBundle:Role')->findByNombre('Investigador'));

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Se creo correctamente el Investigador');
            return $this->redirect($this->generateUrl('investigador'));
        }

        return $this->render('investigador/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Investigador entity.
     *
     * @param Investigador $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Investigador $entity)
    {
        $form = $this->createForm(new InvestigadorType(), $entity, array(
            'action' => $this->generateUrl('investigador_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Investigador entity.
     *
     * @Route("/new", name="investigador_new")
     * @Method("GET")
     *
     */
    public function newAction()
    {
        $entity = new Investigador();
        $form   = $this->createCreateForm($entity);

        return $this->render('investigador/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Investigador entity.
     *
     * @Route("/{id}", name="investigador_show")
     * @Method("GET")
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Investigador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Investigador entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('investigador/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Investigador entity.
     *
     * @Route("/{id}/edit", name="investigador_edit")
     * @Method("GET")
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Investigador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Investigador entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('investigador/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Investigador entity.
    *
    * @param Investigador $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Investigador $entity)
    {
        $form = $this->createForm(new InvestigadorType(), $entity, array(
            'action' => $this->generateUrl('investigador_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Investigador entity.
     *
     * @Route("/{id}", name="investigador_update")
     * @Method("PUT")
     * @Template("AppBundle:Investigador:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Investigador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Investigador entity.');
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
            $this->get('session')->getFlashBag()->add('info', 'Se edito correctamente el Investigador');
            return $this->redirect($this->generateUrl('investigador'));
        }

        return $this->render('investigador/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Investigador entity.
     *
     * @Route("/{id}", name="investigador_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Investigador')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Investigador entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('investigador'));
    }

    /**
     * Creates a form to delete a Investigador entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('investigador_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
