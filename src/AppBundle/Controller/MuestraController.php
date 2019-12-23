<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AnalisisMuestra;
use AppBundle\Entity\CampoAnalisisValor;
use AppBundle\Entity\SalidaReactivo;
use AppBundle\Form\ResultadosAnalisisType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Muestra;
use AppBundle\Form\MuestraType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Muestra controller.
 *
 * @Route("/muestra")
 */
class MuestraController extends Controller
{

    /**
     * Lista todas las muestras de nueva creacion
     *
     * @Route("/muestrasinvestigador", name="muestras_por_investigador")
     * @Method("GET")
     *
     */
    public function muestrasPorInvestigadorAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $entities = $em->getRepository('AppBundle:Muestra')->buscarPorInvestigador($user);

        return $this->render('muestra/muestras.investigador.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Lista todas las muestras de nueva creacion
     *
     * @Route("/nuevas", name="nuevas_muestras")
     * @Method("GET")
     *
     */
    public function nuevasMuestrasAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Muestra')->buscarPorEstado('Enviada');

        return $this->render('muestra/nuevas.muestras.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Lista todas las muestras en proceso
     *
     * @Route("/procesando", name="muestras_en_proceso")
     * @Method("GET")
     *
     */
    public function muestrasEnProcesoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Muestra')->buscarPorEstado('Recibida');

        return $this->render('muestra/muestras.procesando.html.twig', array(
            'entities' => $entities,
        ));
    }


    /**
     * Muestra todas las muestras de nueva creacion
     *
     * @Route("/canceladas", name="muestras_canceladas")
     * @Method("GET")
     *
     */
    public function muestrasCanceladasAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Muestra')->buscarPorEstado('Cancelada');

        return $this->render('muestra/muestras.canceladas.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Muestra entity.
     *
     * @Route("/{id}", name="cancelar_muestra")
     * @Method("GET")
     *
     */
    public function cancelarMuestraAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Muestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Muestra entity.');
        }

        $deleteForm = $this->createCancelarForm($id);

        return $this->render('muestra/show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a Objetivo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCancelarForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('muestra_cancelada', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Cancelar'))
            ->getForm();
    }

    /**
     * Deletes a Muestra entity.
     *
     * @Route("/{id}", name="muestra_cancelada")
     * @Method("DELETE")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function muestraCanceladaAction(Request $request, $id)
    {
        $form = $this->createCancelarForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Muestra')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No se encuentra la muestra.');
            }
            $entity->setEstado('Cancelada');

            $em->flush();

            $canceladas = $this->get('session')->get('procesando');
            $nuevas = $this->get('session')->get('nuevas');
            $nuevas--;
            $canceladas++;
            $this->get('session')->set('nuevas', $nuevas);
            $this->get('session')->set('procesando', $canceladas);
        }

        return $this->redirect($this->generateUrl('muestras_canceladas'));
    }

    /**
     * Displays a form to edit an existing Muestra entity.
     *
     * @Route("/{id}/recibir", name="recibir_muestra")
     * @Method("GET")
     *
     */
    public function recibirMuestraAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Muestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Muestra entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('muestra/recibir.muestra.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Muestra entity.
     *
     * @param Muestra $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Muestra $entity)
    {
        $form = $this->createForm(new MuestraType($entity), $entity, array(
            'action' => $this->generateUrl('muestra_recibida', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }

    /**
     * Edits an existing Muestra entity.
     *
     * @Route("/{id}", name="muestra_recibida")
     * @Method("PUT")
     */
    public function muestraRecibidaAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Muestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Muestra entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        $entity->setEstado('Recibida');
        $entity->setFechaRecibida(new \DateTime('now'));

        if ($editForm->isValid()) {
            foreach ($entity->getAnalisisMuestras() as $analisis) {
                $analisis->setAprobado(true);
            }

            $em->flush();

            $recibidas = $this->get('session')->get('procesando');
            $nuevas = $this->get('session')->get('nuevas');
            $nuevas--;
            $recibidas++;
            $this->get('session')->set('nuevas', $nuevas);
            $this->get('session')->set('procesando', $recibidas);

            return $this->redirect($this->generateUrl('muestras_en_proceso', array('id' => $id)));
        }

        return $this->render('muestra/recibir.muestra.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     *  Muestra los analisis de una muestra.
     *
     * @Route("/{id}/resultados", name="resultados")
     * @Method("GET")
     *
     */
    public function resultadosAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $muestra = $em->getRepository('AppBundle:Muestra')->find($id);

        if (!$muestra) {
            throw $this->createNotFoundException('Unable to find Muestra entity.');
        }
        $entities = $muestra->getAnalisisMuestras();

        return $this->render('muestra/resultados.investigador.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     *  Muestra los analisis de una muestra.
     *
     * @Route("/{id}/analisis", name="muestra_analisis")
     * @Method("GET")
     *
     */
    public function analisisAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $muestra = $em->getRepository('AppBundle:Muestra')->find($id);

        if (!$muestra) {
            throw $this->createNotFoundException('Unable to find Muestra entity.');
        }
        $entities = $muestra->getAnalisisMuestras();

        return $this->render('muestra/analisis.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     *  Agregar los resultados de un analisis.
     *
     * @Route("/{id}/analisisresultados", name="muestra_analisisresultados")
     * @Method("GET")
     *
     */
    public function analisisResultadosAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $analisis = $em->getRepository('AppBundle:AnalisisMuestra')->find($id);

        if (!$analisis) {
            throw $this->createNotFoundException('Unable to find Muestra entity.');
        }

        foreach ($analisis->getAnalisis()->getCampos() as $campo) {
            if (!$em->getRepository('AppBundle:CampoAnalisisValor')->existeCampo($analisis, $campo->getId())) {
                $valor = new CampoAnalisisValor();
                $valor->setValor(0);
                $valor->setCampo($campo);
                $valor->setAnalisis($analisis);
                $analisis->addValore($valor);
            }
        }
        $em->flush();

        $editForm = $this->createResultadoForm($analisis);

        return $this->render('muestra/analisis.resultado.html.twig', array(
            'entity' => $analisis,
            'edit_form' => $editForm->createView(),
        ));
    }

    private function createResultadoForm(AnalisisMuestra $entity)
    {
        $form = $this->createForm(new ResultadosAnalisisType(), $entity, array(
            'action' => $this->generateUrl('guardar_resultados', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }

    /**
     * Guardar resultados de un analisis.
     *
     * @Route("/{id}/guardar", name="guardar_resultados")
     * @Method("PUT")
     */
    public function guardarResultadosAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:AnalisisMuestra')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Muestra entity.');
        }

        $editForm = $this->createResultadoForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                $user = $this->getUser();
                if (in_array('ROLE_TECNICO', $user->getRoles(), true)) {
                    $entity->setTecnicoLaboratorio($this->getUser());
                    if ($entity->getResultado() != "") {
                        foreach ($entity->getAnalisis()->getAnalisisReactivos() as $reactivo) {
                            $inventario = $em->getRepository('AppBundle:InventarioReactivo')->findOneBy(array('reactivo' => $reactivo->getReactivo()));

                            $salida = new SalidaReactivo();
                            $salida
                                ->setFecha(new \DateTime())
                                ->setCantidad($reactivo->getCantidad())
                                ->setReactivo($inventario);
                            $em->persist($salida);
                        }
                    }
                }
            }
            $em->flush();
            return $this->redirect($this->generateUrl('muestra_analisis', array('id' => $entity->getMuestra()->getId())));
        }
        return $this->render('muestra/analisis.resultado.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        ));
    }


    /**
     * @Route("/pdf/{id}", name="pdf")
     * @Method("GET")
     */
    public function resultadosPdfAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $muestra = $em->getRepository('AppBundle:Muestra')->find($id);

        if (!$muestra) {
            throw $this->createNotFoundException('No se encuentra la Muestra.');
        }

        $html = $this->render('muestra/muestra.pdf.twig', array(
            'muestra' => $muestra,
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="file.pdf"'
            )
        );
    }

}