<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AnalisisMuestra;
use AppBundle\ViewModel\OtraMuestraView;
use AppBundle\ViewModel\OtraMuestraViewType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\OtraMuestra;
use AppBundle\Form\OtraMuestraType;

/**
 * OtraMuestra controller.
 *
 * @Route("/otramuestra")
 */
class OtraMuestraController extends Controller
{

    /**
     * Lists all OtraMuestra entities.
     *
     * @Route("/", name="otramuestra")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:OtraMuestra')->findAll();

        return $this->render('otramuestra/index.html.twig',array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new OtraMuestra entity.
     *
     * @Route("/", name="otramuestra_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new OtraMuestraView();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $muestra = new OtraMuestra();
            foreach($entity->getTratamientos() as $tratamiento)   {
                $muestra->addTratamiento($tratamiento);
            }
            foreach($entity->getAnalisis() as $analisis)   {
                $analisisMuestra = new AnalisisMuestra();
                $analisisMuestra->setAnalisis($analisis);
                $analisisMuestra->setAprobado(false);
                $analisisMuestra->setMuestra($muestra);
                $muestra->addAnalisisMuestra($analisisMuestra);
            }
            $muestra->setTipo($entity->getTipo());
            $muestra->setDescripcion($entity->getDescripcion());
            $muestra->setExperimento($entity->getExperimento());
            $muestra->setInvestigador($this->getUser());
            $muestra->setEstado('Enviada');

            $em->persist($muestra);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'Su muestra ha sido enviada correctamente!');

            return $this->redirect($this->generateUrl('muestras_por_investigador', array('id' => $entity->getId())));
        }

        return $this->render('otramuestra/new.html.twig',array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a OtraMuestraView entity.
     *
     * @param OtraMuestraView $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(OtraMuestraView $entity)
    {
        $form = $this->createForm(new OtraMuestraViewType($this->getUser()), $entity, array(
            'action' => $this->generateUrl('otramuestra_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new OtraMuestra entity.
     *
     * @Route("/new", name="otramuestra_new")
     * @Method("GET")
     */
    public function newAction()
    {
        $entity = new OtraMuestraView();
        $form   = $this->createCreateForm($entity);

        return $this->render('otramuestra/new.html.twig',array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a OtraMuestra entity.
     *
     * @Route("/{id}", name="otramuestra_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:OtraMuestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OtraMuestra entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('otramuestra/show.html.twig',array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing OtraMuestra entity.
     *
     * @Route("/{id}/edit", name="otramuestra_edit")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:OtraMuestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OtraMuestra entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('otramuestra/edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a OtraMuestra entity.
    *
    * @param OtraMuestra $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(OtraMuestra $entity)
    {
        $form = $this->createForm(new OtraMuestraType(), $entity, array(
            'action' => $this->generateUrl('otramuestra_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing OtraMuestra entity.
     *
     * @Route("/{id}", name="otramuestra_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:OtraMuestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OtraMuestra entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('otramuestra_edit', array('id' => $id)));
        }

        return $this->render('otramuestra/edit.html.twig',array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a OtraMuestra entity.
     *
     * @Route("/{id}", name="otramuestra_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:OtraMuestra')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OtraMuestra entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('otramuestra'));
    }

    /**
     * Creates a form to delete a OtraMuestra entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('otramuestra_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
