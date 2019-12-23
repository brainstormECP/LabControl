<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        if($this->get('security.authorization_checker' ) ->isGranted('IS_AUTHENTICATED_FULLY' )) {
            $user = $this->getUser();
            if(in_array('ROLE_SADMIN',$user->getRoles(),true)){

                $em = $this->getDoctrine()->getManager();
                $muestras = $em->getRepository('AppBundle:Muestra')->findAll();
                $investigadores = $em->getRepository('AppBundle:Investigador')->findAll();
                $tecnicos = $em->getRepository('AppBundle:TecnicoLaboratorio')->findAll();
                $instituciones = $em->getRepository('AppBundle:Institucion')->findAll();

                return $this->render('default/admin.index.html.twig', array(
                    'muestras' => count($muestras),
                    'investigadores' => count($investigadores),
                    'tecnicos' => count($tecnicos),
                    'instituciones' => count($instituciones),
                ));
            }
            else if(in_array('ROLE_INVESTIGADOR',$user->getRoles(),true)){

                $em = $this->getDoctrine()->getManager();
                $queryResult = $em->createQuery(
                    'SELECT i FROM AppBundle:Muestra i JOIN i.experimento e WHERE e.investigador = :investigador'
                )
                    ->setParameters(array(
                        'investigador' => $this->getUser(),
                    ))
                    ->getResult();

                $mismuestras = count($queryResult);

                $queryResult = $em->createQuery(
                    'SELECT i FROM AppBundle:PlanificacionCorteExperimento i JOIN i.experimento e WHERE e.investigador = :investigador AND i.fecha >= :fecha'
                )
                    ->setParameters(array(
                        'investigador' => $this->getUser(),
                        'fecha' => new \DateTime('now'),
                    ))
                    ->getResult();

                $miprogramacion = count($queryResult);

                $queryResult = $em->createQuery(
                    'SELECT i FROM AppBundle:AnalisisMuestra i JOIN i.muestra m JOIN m.experimento e  WHERE e.investigador = :investigador AND i.aprobado = true'
                )
                    ->setParameters(array(
                        'investigador' => $this->getUser(),
                    ))
                    ->getResult();

                $misresultados = count($queryResult);

                return $this->render('default/investigador.index.html.twig', array(
                    'mismuestras' => $mismuestras,
                    'miprogramacion' => $miprogramacion,
                    'misresultados' => $misresultados,
                ));
            }
            else if(in_array('ROLE_TECNICO',$user->getRoles(),true)){
                $em = $this->getDoctrine()->getManager();

                $entities = $em->getRepository('AppBundle:Muestra')->buscarPorEstado('Enviada');
                $value = count($entities);
                $this->get('session')->set('nuevas',$value);

                $entities = $em->getRepository('AppBundle:Muestra')->buscarPorEstado('Recibida');
                $value = count($entities);
                $this->get('session')->set('procesando',$value);

                $entities = $em->getRepository('AppBundle:Muestra')->buscarPorEstado('Cancelada');
                $value = count($entities);
                $this->get('session')->set('canceladas',$value);

                $misAnalisis = count($em->getRepository('AppBundle:AnalisisMuestra')->findByTecnicoLaboratorio($this->getUser()));

                return $this->render('default/tecnico.index.html.twig', array(
                    'misanalisis' => $misAnalisis,
                ));
            }
        }

        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/AnalisisDisponible", name="analisis_disponibles")
     */
    public function analisisAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Analisis')->findAll();

        return $this->render('default/analisis.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Lists all Pno entities.
     *
     * @Route("/procedimientos", name="mostrar_pno")
     */
    public function mostrarPnoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Pno')->findAll();

        return $this->render('default/pno.html.twig',array(
            'entities' => $entities,
        ));
    }
}
