<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\PlanificacionCorteExperimento;
use AppBundle\Form\PlanificacionCorteExperimentoType;

/**
 * PlanificacionCorteExperimento controller.
 *
 * @Route("/planificacioncorteexperimento")
 */
class PlanificacionCorteExperimentoController extends Controller
{

    /**
     * Lists all PlanificacionCorteExperimento entities.
     *
     * @Route("/", name="planificacioncorteexperimento")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:PlanificacionCorteExperimento')->findAll();

        return $this->render('planificacionCorteExperimento/index.html.twig',array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new PlanificacionCorteExperimento entity.
     *
     * @Route("/", name="planificacioncorteexperimento_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new PlanificacionCorteExperimento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('planificacioncorteexperimento_show', array('id' => $entity->getId())));
        }

        return $this->render('planificacionCorteExperimento/new.html.twig',array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a PlanificacionCorteExperimento entity.
     *
     * @param PlanificacionCorteExperimento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PlanificacionCorteExperimento $entity)
    {
        $form = $this->createForm(new PlanificacionCorteExperimentoType(), $entity, array(
            'action' => $this->generateUrl('planificacioncorteexperimento_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new PlanificacionCorteExperimento entity.
     *
     * @Route("/new", name="planificacioncorteexperimento_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $entity = new PlanificacionCorteExperimento();
        $form   = $this->createCreateForm($entity);

        return $this->render('planificacionCorteExperimento/new.html.twig',array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PlanificacionCorteExperimento entity.
     *
     * @Route("/{id}", name="planificacioncorteexperimento_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:PlanificacionCorteExperimento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlanificacionCorteExperimento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('planificacionCorteExperimento/show.html.twig',array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PlanificacionCorteExperimento entity.
     *
     * @Route("/{id}/edit", name="planificacioncorteexperimento_edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:PlanificacionCorteExperimento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlanificacionCorteExperimento entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('planificacionCorteExperimento/edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a PlanificacionCorteExperimento entity.
    *
    * @param PlanificacionCorteExperimento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PlanificacionCorteExperimento $entity)
    {
        $form = $this->createForm(new PlanificacionCorteExperimentoType(), $entity, array(
            'action' => $this->generateUrl('planificacioncorteexperimento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing PlanificacionCorteExperimento entity.
     *
     * @Route("/{id}", name="planificacioncorteexperimento_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:PlanificacionCorteExperimento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PlanificacionCorteExperimento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('planificacioncorteexperimento_edit', array('id' => $id)));
        }

        return $this->render('planificacionCorteExperimento/edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a PlanificacionCorteExperimento entity.
     *
     * @Route("/{id}", name="planificacioncorteexperimento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:PlanificacionCorteExperimento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PlanificacionCorteExperimento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('planificacioncorteexperimento'));
    }

    /**
     * Creates a form to delete a PlanificacionCorteExperimento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('planificacioncorteexperimento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }

    /**
     *
     * @Route("/investigador/admin", name="planificacion_admin")
     * @Method("GET")
     */
    public function planificacionAdminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $investigadores = $em->getRepository('AppBundle:Investigador')->findAll();

        return $this->render('planificacionCorteExperimento/investigador.planificaciones.html.twig',array(
            'investigadores' => $investigadores,
        ));
    }

    /**
     * Displays a form to edit an existing PlanificacionCorteExperimento entity.
     *
     * @Route("/plan/{investigador}", name="planificacion_investigador")
     * @Method("GET")
     */
    public function planificacionInvestigadorAction($investigador)
    {
        $em = $this->getDoctrine()->getManager();

        $investigador = $em->getRepository('AppBundle:Investigador')->find($investigador);

        return $this->render('planificacionCorteExperimento/planificaciones.html.twig',array(
            'experimentos'      => $investigador->getExperimentos(),
        ));
    }

}
