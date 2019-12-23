<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AnalisisReactivo;
use AppBundle\Entity\Campo;
use AppBundle\Form\AnalisisReactivoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Analisis;
use AppBundle\Form\AnalisisType;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Analisis controller.
 *
 * @Route("/analisis")
 */
class AnalisisController extends Controller
{

    /**
     * Lists all Analisis entities.
     *
     * @Route("/", name="analisis")
     * @Method("GET")
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Analisis')->findAll();

        return $this->render('analisis/index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Creates a new Analisis entity.
     *
     * @Route("/", name="analisis_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new Analisis();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('analisis'));
        }

        return $this->render('analisis/new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Analisis entity.
     *
     * @param Analisis $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Analisis $entity)
    {
        $form = $this->createForm(new AnalisisType(), $entity, array(
            'action' => $this->generateUrl('analisis_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Analisis entity.
     *
     * @Route("/new", name="analisis_new")
     * @Method("GET")
     *
     */
    public function newAction(Request $request)
    {
        $entity = new Analisis();
        $form = $this->createCreateForm($entity);

        return $this->render('analisis/new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Analisis entity.
     *
     * @Route("/{id}", name="analisis_show")
     * @Method("GET")
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Analisis')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Analisis entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('analisis/show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Analisis entity.
     *
     * @Route("/{id}/edit", name="analisis_edit")
     * @Method("GET")
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Analisis')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Analisis entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('analisis/edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Analisis entity.
     *
     * @param Analisis $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Analisis $entity)
    {
        $form = $this->createForm(new AnalisisType(), $entity, array(
            'action' => $this->generateUrl('analisis_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }

    /**
     * Edits an existing Analisis entity.
     *
     * @Route("/{id}", name="analisis_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $analisis = $em->getRepository('AppBundle:Analisis')->find($id);

        if (!$analisis) {
            throw $this->createNotFoundException('Unable to find Analisis entity.');
        }

        $originalCampos = new ArrayCollection();
        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($analisis->getCampos() as $campo) {
            $originalCampos->add($campo);
        }

        $editForm = $this->createEditForm($analisis);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            // remove the relationship between the tag and the Task
            foreach ($originalCampos as $campo) {
                if (false === $analisis->getCampos()->contains($campo)) {
                    // if it was a many-to-one relationship, remove the relationship like this
                    // $tag->setTask(null);
                    $campo->setAnalisis(null);
                    $em->remove($campo);
                    //$em->persist($campo);
                    // if you wanted to delete the Tag entirely, you can also do that
                    // $em->remove($tag);
                }
            }
            $em->persist($analisis);

            $em->flush();

            return $this->redirect($this->generateUrl('analisis'));
        }

        return $this->render('analisis/edit.html.twig', array(
            'entity' => $analisis,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Analisis entity.
     *
     * @Route("/{id}", name="analisis_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Analisis')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Analisis entity.');
            }
            //Eliminando la relacion con los campos
            foreach ($entity->getCampos() as $campo) {
                $campo->setAnalisis(null);
                $em->remove($campo);
            }
            //Eliminando la relacion con los reactivos
            foreach ($entity->getAnalisisReactivos() as $reactivo) {
                $reactivo->setAnalisis(null);
                $em->remove($reactivo);
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('analisis'));
    }

    /**
     * Creates a form to delete a Analisis entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('analisis_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm();
    }

    /**
     * Añade la cantidad de reactivos de un analisis.
     *
     * @Route("/agregarreactivo", name="agregar_reactivo")
     * @Method("POST")
     */
    public function agregarReactivoAction(Request $request)
    {
        $entity = new AnalisisReactivo();
        $form = $this->createReactivoForm($entity);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $analisis = $em->getRepository('AppBundle:Analisis')->find($request->request->get('id'));

        if ($form->isValid()) {
            $entity->setAnalisis($analisis);
            $em->persist($entity);
            $em->flush();

            $newForm = $this->createReactivoForm(new AnalisisReactivo());
            return $this->render('analisis/reactivo.html.twig', array(
                'entity' => new AnalisisReactivo(),
                'analisis' => $analisis,
                'form' => $newForm->createView(),
            ));
        }

        return $this->render('analisis/reactivo.html.twig', array(
            'entity' => $entity,
            'analisis' => $analisis,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Analisis entity.
     *
     * @param AnalisisReactivo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createReactivoForm(AnalisisReactivo $entity)
    {
        $form = $this->createForm(new AnalisisReactivoType(), $entity, array(
            'action' => $this->generateUrl('agregar_reactivo'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Muestra formulario para agregar reactivos a un analisis
     *
     * @Route("/{id}/reactivos", name="analisis_reactivo")
     * @Method("GET")
     *
     */
    public function reactivoAction(Request $request, $id)
    {
        $entity = new AnalisisReactivo();
        $form = $this->createReactivoForm($entity);

        $em = $this->getDoctrine()->getManager();
        $analisis = $em->getRepository('AppBundle:Analisis')->find($id);

        return $this->render('analisis/reactivo.html.twig', array(
            'entity' => $entity,
            'analisis' => $analisis,
            'form' => $form->createView(),
        ));
    }


    /**
     * Edita la cantidad de reactivos de un analisis.
     *
     * @Route("/{id}/reactivos", name="editar_reactivo")
     * @Method("PUT")
     */
    public function editarReactivoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:AnalisisReactivo')->find($id);
        $id = $entity->getAnalisis()->getId();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Analisis entity.');
        }
        $form = $this->createEditarReactivoForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->flush();

            $newForm = $this->createReactivoForm(new AnalisisReactivo());
            return $this->render('analisis/reactivo.html.twig', array(
                'entity' => new AnalisisReactivo(),
                'analisis' => $entity->getAnalisis(),
                'form' => $newForm->createView(),
            ));

        }

        return $this->render('analisis/reactivo.html.twig', array(
            'entity' => $entity,
            'analisis' => $entity->getAnalisis(),
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Analisis entity.
     *
     * @param AnalisisReactivo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditarReactivoForm(AnalisisReactivo $entity)
    {
        $form = $this->createForm(new AnalisisReactivoType(), $entity, array(
            'action' => $this->generateUrl('editar_reactivo', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }

    /**
     * Muestra formulario para agregar reactivos a un analisis
     *
     * @Route("/{id}/reactivos/editar", name="analisis_reactivo_editar")
     * @Method("GET")
     *
     */
    public function reactivoEditarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:AnalisisReactivo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Analisis entity.');
        }
        $form = $this->createEditarReactivoForm($entity);

        return $this->render('analisis/reactivo.html.twig', array(
            'entity' => $entity,
            'analisis' => $entity->getAnalisis(),
            'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a Analisis entity.
     *
     * @Route("/{id}", name="analisis_reactivo_delete")
     * @Method("DELETE")
     */
    public function reactivoDeleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Analisis')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Analisis entity.');
            }
            //Eliminando la relacion con los campos
            foreach ($entity->getCampos() as $campo) {
                $campo->setAnalisis(null);
                $em->remove($campo);
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('analisis'));
    }

}
