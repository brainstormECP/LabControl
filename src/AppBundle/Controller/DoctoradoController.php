<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Doctorado;
use AppBundle\Form\DoctoradoType;

/**
 * Doctorado controller.
 *
 * @Route("/doctorado")
 */
class DoctoradoController extends Controller
{

    /**
     * Lists all Doctorado entities.
     *
     * @Route("/", name="doctorado")
     * @Method("GET")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Doctorado')->findAll();

        return $this->render('', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Doctorado entity.
     *
     * @Route("/", name="doctorado_create")
     * @Method("POST")
     * @Template("AppBundle:Doctorado:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Doctorado();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('doctorado_show', array('id' => $entity->getId())));
        }

        return $this->render('', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Doctorado entity.
     *
     * @param Doctorado $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Doctorado $entity)
    {
        $form = $this->createForm(new DoctoradoType(), $entity, array(
            'action' => $this->generateUrl('doctorado_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Doctorado entity.
     *
     * @Route("/new", name="doctorado_new")
     * @Method("GET")
     *
     */
    public function newAction()
    {
        $entity = new Doctorado();
        $form   = $this->createCreateForm($entity);

        return $this->render('', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Doctorado entity.
     *
     * @Route("/{id}", name="doctorado_show")
     * @Method("GET")
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Doctorado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doctorado entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Doctorado entity.
     *
     * @Route("/{id}/edit", name="doctorado_edit")
     * @Method("GET")
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Doctorado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doctorado entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Doctorado entity.
    *
    * @param Doctorado $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Doctorado $entity)
    {
        $form = $this->createForm(new DoctoradoType(), $entity, array(
            'action' => $this->generateUrl('doctorado_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Doctorado entity.
     *
     * @Route("/{id}", name="doctorado_update")
     * @Method("PUT")
     * @Template("AppBundle:Doctorado:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Doctorado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doctorado entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('doctorado_edit', array('id' => $id)));
        }

        return $this->render('', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Doctorado entity.
     *
     * @Route("/{id}", name="doctorado_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Doctorado')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Doctorado entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('doctorado'));
    }

    /**
     * Creates a form to delete a Doctorado entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('doctorado_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
