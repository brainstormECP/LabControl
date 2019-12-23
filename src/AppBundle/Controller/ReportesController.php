<?php

namespace AppBundle\Controller;


use AppBundle\ViewModel\EspecieView;
use AppBundle\ViewModel\EspecieViewType;
use AppBundle\ViewModel\PeriodoView;
use AppBundle\ViewModel\PeriodoViewType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Response;

/**
 * Reportes controller.
 *
 * @Route("/reportes")
 */
class ReportesController extends Controller
{

    /**
     * Lists all Analisis entities.
     *
     * @Route("/graf", name="grafica")
     * @Method("GET")
     *
     */
    public function graficaAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('reportes/grafico.html.twig');
    }


    /**
     * Mostrar compras en fecha.
     *
     * @Route("/grafica", name="grafica_data")
     */
    public function graficaDataAction()
    {

        $em = $this->getDoctrine()->getManager();

        /*$especies = $em->createQuery(
            'SELECT e.nombre AS especie FROM AppBundle:Especie e'
        )
            ->getResult();*/

        /*$muestras = $em->createQuery(
            "SELECT COUNT(m), e.nombre AS especie FROM AppBundle:Pasto m JOIN m.especie e WHERE m.estado = 'Recibida' GROUP BY m."
        )
            ->getResult();*/

        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        $result = array();

        $data = array();

        /*foreach ($muestras as $m) {

        }*/

        for ($i = 1; $i <= 12; $i++) {
            $fila = array();
            $fila['period'] = "2015-$i";
            $fila['muestra1'] = 10 * $i;
            $fila['muestra2'] = 15 * 1;
            $fila['muestra3'] = 5 * $i;
            $data[] = $fila;
        }
        $result['data'] = $data;

        return new JsonResponse($result);
    }

    private function createFechaForm(PeriodoView $entity, $ruta)
    {
        $form = $this->createForm(new PeriodoViewType(), $entity, array(
            'action' => $this->generateUrl($ruta),
            'method' => 'POST',
        ));
        return $form;
    }

    /**
     * Mostrar compras por fecha.
     *
     * @Route("/periodoinvestigador", name="muestra_investigador_selector")
     * @Method("GET")
     */
    public function muestraAgrupadaPorInvestigadorSelectorAction()
    {
        $entity = new PeriodoView();
        $form = $this->createFechaForm($entity, 'muestra_investigador');

        return $this->render('reportes/seleccionar.fecha.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/investigador", name="muestra_investigador")
     * @Method("POST")
     */
    public function muestraAgrupadaPorInvestigadorAction(Request $request)
    {
        $entity = new PeriodoView();
        $form = $this->createFechaForm($entity, 'muestra_investigador');
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $queryResult = $em->createQuery(
                'SELECT i FROM AppBundle:Investigador i JOIN i.experimentos e WHERE e.fechaInicio >= :fechaInicio AND e.fechaInicio <= :fechaFin'
            )
                ->setParameters(array(
                    'fechaInicio' => $entity->getFechaInicio(),
                    'fechaFin' => $entity->getFechaFin(),
                ))
                ->getResult();

            return $this->render('reportes/muestra.agrupadas.investigador.html.twig', array(
                'entities' => $queryResult,
                'fechaInicio' => $entity->getFechaInicio(),
                'fechaFin' => $entity->getFechaFin(),
            ));
        }

        return $this->render('reportes/seleccionar.fecha.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }


    /**
     * Mostrar compras por fecha.
     *
     * @Route("/periodoinvestigadorresultados", name="resultados_investigador_selector")
     * @Method("GET")
     */
    public function muestraDeInvestigadorSelectorAction()
    {
        $entity = new PeriodoView();
        $form = $this->createFechaForm($entity, 'resultados_investigador');

        return $this->render('reportes/seleccionar.fecha.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/investigador/resultados", name="resultados_investigador")
     * @Method("POST")
     */
    public function muestraDeInvestigadorAction(Request $request)
    {
        $entity = new PeriodoView();
        $form = $this->createFechaForm($entity, 'resultados_investigador');
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $queryResult = $em->createQuery(
                'SELECT m FROM AppBundle:Muestra m WHERE m.fechaRecibida >= :fechaInicio AND m.fechaRecibida <= :fechaFin AND m.investigador = :investigador'
            )
                ->setParameters(array(
                    'fechaInicio' => $entity->getFechaInicio(),
                    'fechaFin' => $entity->getFechaFin(),
                    'investigador' => $this->getUser(),
                ))
                ->getResult();

            return $this->render('reportes/resultados.investigador.html.twig', array(
                'entities' => $queryResult,
                'fechaInicio' => $entity->getFechaInicio(),
                'fechaFin' => $entity->getFechaFin(),
            ));
        }

        return $this->render('reportes/seleccionar.fecha.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }


    /**
     * Mostrar compras por fecha.
     *
     * @Route("/periodoespecie", name="muestra_especie_selector")
     * @Method("GET")
     */
    public function muestraAgrupadaPorEspeciesSelectorAction()
    {
        $entity = new PeriodoView();
        $form = $this->createFechaForm($entity, 'muestra_especie');

        return $this->render('reportes/seleccionar.fecha.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/especie", name="muestra_especie")
     * @Method("POST")
     */
    public function muestraAgrupadaPorEspeciesAction(Request $request)
    {
        $entity = new PeriodoView();
        $form = $this->createFechaForm($entity, 'muestra_especie');
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $queryResult = $em->createQuery(
                'SELECT i FROM AppBundle:Especie i JOIN i.muestras e WHERE e.fechaRecibida >= :fechaInicio AND e.fechaRecibida <= :fechaFin'
            )
                ->setParameters(array(
                    'fechaInicio' => $entity->getFechaInicio(),
                    'fechaFin' => $entity->getFechaFin(),
                ))
                ->getResult();

            return $this->render('reportes/muestra.agrupadas.especie.html.twig', array(
                'entities' => $queryResult,
                'fechaInicio' => $entity->getFechaInicio(),
                'fechaFin' => $entity->getFechaFin(),
            ));
        }

        return $this->render('reportes/seleccionar.fecha.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Mostrar compras por fecha.
     *
     * @Route("/periodoresultado", name="muestra_resultado_selector")
     * @Method("GET")
     */
    public function resultadosMuestrasSelectorAction()
    {
        $entity = new PeriodoView();
        $form = $this->createFechaForm($entity, 'muestra_resultado');

        return $this->render('reportes/seleccionar.fecha.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/resultado", name="muestra_resultado")
     * @Method("POST")
     */
    public function resultadosMuestrasAction(Request $request)
    {
        $entity = new PeriodoView();
        $form = $this->createFechaForm($entity, 'muestra_resultado');
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $queryResult = $em->createQuery(
                'SELECT i FROM AppBundle:Muestra i JOIN i.experimento e WHERE e.fechaInicio >= :fechaInicio AND e.fechaInicio <= :fechaFin AND i.investigador = :investigador'
            )
                ->setParameters(array(
                    'fechaInicio' => $entity->getFechaInicio(),
                    'fechaFin' => $entity->getFechaFin(),
                    'investigador' => $this->getUser(),
                ))
                ->getResult();

            return $this->render('reportes/muestra.agrupadas.investigador.html.twig', array(
                'entities' => $queryResult,
            ));
        }

        return $this->render('reportes/seleccionar.fecha.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/actividad", name="muestra_actividad")
     */
    public function muestrasPorActividadIentificaAction()
    {
        $em = $this->getDoctrine()->getManager();
        $muestras = $em->createQuery(
            'SELECT a FROM AppBundle:ActividadCientifica a'
        )
            ->getResult();

        return $this->render('reportes/muestra.agrupadas.actividad.html.twig', array(
            'entities' => $muestras,
        ));
    }


    /**
     * @Route("/nutricionanimal", name="nutricion_animal")
     */
    public function nutricionAnimalAction()
    {
        $em = $this->getDoctrine()->getManager();
        $muestras = $em->createQuery(
            'SELECT e  FROM AppBundle:Pasto e WHERE e.tipoEstudio = :tipo'
        )
            ->setParameters(array(
                'tipo' => 'Nutrición animal',
            ))
            ->getResult();

        return $this->render('reportes/nutricion.html.twig', array(
            'entities' => $muestras,
        ));
    }

    /**
     * @Route("/agronomicos", name="agronomicos")
     */
    public function agronomicosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $muestras = $em->createQuery(
            'SELECT e  FROM AppBundle:Pasto e WHERE e.tipoEstudio = :tipo'
        )
            ->setParameters(array(
                'tipo' => 'Agronómicos',
            ))
            ->getResult();

        return $this->render('reportes/agronomicas.html.twig', array(
            'entities' => $muestras,
        ));
    }

    /**
     * @Route("/agronomicos_pdf", name="agronomicos_pdf")
     */
    public function agronomicosPdfAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $muestras = $em->createQuery(
            'SELECT e  FROM AppBundle:Pasto e WHERE e.tipoEstudio = :tipo'
        )
            ->setParameters(array(
                'tipo' => 'Agronómicos',
            ))
            ->getResult();

        $html = $this->render('reportes/pasto.pdf.twig', array(
            'entities' => $muestras,
            'tipo' => 'Agronómicos',
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

    /**
     * @Route("/nutricion_pdf", name="nutricion_pdf")
     */
    public function nutricionPdfAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $muestras = $em->createQuery(
            'SELECT e  FROM AppBundle:Pasto e WHERE e.tipoEstudio = :tipo'
        )
            ->setParameters(array(
                'tipo' => 'Nutrición Animal',
            ))
            ->getResult();

        $html = $this->render('reportes/pasto.pdf.twig', array(
            'entities' => $muestras,
            'tipo' => 'Nutrición animal',
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

    /**
     * @Route("/investigador_pdf/{fechaInicio}/{fechaFin}", name="investigador_pdf")
     * @Method("GET")
     * @param \Datetime $fechaInicio
     * @param \Datetime $fechaFin
     * @return Response
     */
    public function investigadorPdfAction( $fechaInicio, $fechaFin)
    {
        $em = $this->getDoctrine()->getManager();

        $queryResult = $em->createQuery(
            'SELECT i FROM AppBundle:Investigador i JOIN i.experimentos e WHERE e.fechaInicio >= :fechaInicio AND e.fechaInicio <= :fechaFin'
        )
            ->setParameters(array(
                'fechaInicio' => $fechaInicio,
                'fechaFin' => $fechaFin,
            ))
            ->getResult();

        $html = $this->render('reportes/muestras.investigador.pdf.twig', array(
            'entities' => $queryResult,
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

    /**
     * @Route("/especie_pdf/{fechaInicio}/{fechaFin}", name="especie_pdf")
     * @Method("GET")
     * @param \Datetime $fechaInicio
     * @param \Datetime $fechaFin
     * @return Response
     */
    public function especiePdfAction( $fechaInicio, $fechaFin)
    {
        $em = $this->getDoctrine()->getManager();

        $queryResult = $em->createQuery(
            'SELECT i FROM AppBundle:Especie i JOIN i.muestras e WHERE e.fechaRecibida >= :fechaInicio AND e.fechaRecibida <= :fechaFin'
        )
            ->setParameters(array(
                'fechaInicio' => $fechaInicio,
                'fechaFin' => $fechaFin,
            ))
            ->getResult();

        $html = $this->render('reportes/muestras.especie.pdf.twig', array(
            'entities' => $queryResult,
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

    /**
     * @Route("/resultados_pdf", name="resultados_pdf")
     */
    public function resultadosPdfAction(Request $request)
    {
        $entity = new PeriodoView();
        $form = $this->createFechaForm($entity, 'muestra_resultado');
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $queryResult = $em->createQuery(
                'SELECT i FROM AppBundle:Muestra i JOIN i.experimento e WHERE e.fechaInicio >= :fechaInicio AND e.fechaInicio <= :fechaFin AND i.investigador = :investigador'
            )
                ->setParameters(array(
                    'fechaInicio' => $entity->getFechaInicio(),
                    'fechaFin' => $entity->getFechaFin(),
                    'investigador' => $this->getUser(),
                ))
                ->getResult();

            $html = $this->render('reportes/muestra.agrupadas.investigador.html.twig', array(
                'entities' => $queryResult,
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

        return $this->render('reportes/seleccionar.fecha.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/resultados_investigador_pdf/{fechaInicio}/{fechaFin}", name="resultados_investigador_pdf")
     * @Method("GET")
     * @param \Datetime $fechaInicio
     * @param \Datetime $fechaFin
     * @return Response
     */
    public function resultadosInvestigadorPdfAction($fechaInicio, $fechaFin)
    {
        $em = $this->getDoctrine()->getManager();

        $queryResult = $em->createQuery(
            'SELECT m FROM AppBundle:Muestra m WHERE m.fechaRecibida >= :fechaInicio AND m.fechaRecibida <= :fechaFin AND m.investigador = :investigador'
        )
            ->setParameters(array(
                'fechaInicio' => $fechaInicio,
                'fechaFin' => $fechaFin,
                'investigador' => $this->getUser(),
            ))
            ->getResult();

        $html = $this->render('reportes/resultados.investigador.pdf.twig', array(
            'entities' => $queryResult,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
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

    private function createEspecieForm(EspecieView $entity, $ruta)
    {
        $form = $this->createForm(new EspecieViewType(), $entity, array(
            'action' => $this->generateUrl($ruta),
            'method' => 'POST',
        ));
        return $form;
    }

    /**
     * Mostrar compras por fecha.
     *
     * @Route("/periodoresultadoespecie", name="resultado_especie_selector")
     * @Method("GET")
     */
    public function resultadosEspecieSelectorAction()
    {
        $entity = new EspecieView();
        $form = $this->createEspecieForm($entity, 'resultado_especie');

        return $this->render('reportes/seleccionar.especie.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/resultadoespecie", name="resultado_especie")
     * @Method("POST")
     */
    public function resultadosEspecieAction(Request $request)
    {
        $entity = new EspecieView();
        $form = $this->createEspecieForm($entity, 'resultado_especie');
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $queryResult = $em->createQuery(
                'SELECT i FROM AppBundle:Pasto i WHERE i.fechaRecibida >= :fechaInicio AND i.fechaRecibida <= :fechaFin AND i.investigador = :investigador AND i.especie = :especie'
            )
                ->setParameters(array(
                    'fechaInicio' => $entity->getFechaInicio(),
                    'fechaFin' => $entity->getFechaFin(),
                    'investigador' => $this->getUser(),
                    'especie' => $entity->getEspecie(),
                ))
                ->getResult();

            return $this->render('reportes/resultados.especie.html.twig', array(
                'entities' => $queryResult,
                'fechaInicio' => $entity->getFechaInicio(),
                'fechaFin' => $entity->getFechaFin(),
                'especie' => $entity->getEspecie(),
            ));
        }

        return $this->render('seleccionar.especie.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/resultados_especie_pdf/{fechaInicio}/{fechaFin}/{especie}", name="resultados_especie_pdf")
     * @Method("GET")
     * @param \Datetime $fechaInicio
     * @param \Datetime $fechaFin
     * @param $especie
     * @return Response
     */
    public function resultadosEspeciePdfAction($fechaInicio, $fechaFin, $especie)
    {
        $em = $this->getDoctrine()->getManager();
        $e = $em->getRepository('AppBundle:Especie')->find($especie);

        $queryResult = $em->createQuery(
            'SELECT i FROM AppBundle:Pasto i WHERE i.fechaRecibida >= :fechaInicio AND i.fechaRecibida <= :fechaFin AND i.investigador = :investigador AND i.especie = :especie'
        )
            ->setParameters(array(
                'fechaInicio' => $fechaInicio,
                'fechaFin' => $fechaFin,
                'investigador' => $this->getUser(),
                'especie' => $e,
            ))
            ->getResult();

        $html = $this->render('reportes/resultados.especie.pdf.twig', array(
            'entities' => $queryResult,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
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
