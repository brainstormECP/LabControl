<?php
/**
 * @author Dariel J. Vicedo <darielvicedo@gmail.com>
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Institucion;
use AppBundle\Entity\TecnicoLaboratorio;
use AppBundle\Entity\Investigador;
use AppBundle\Form\ActivateProfessorType;
use AppBundle\Form\ActivateUserType;
use AppBundle\Form\ChangePasswordType;
use AppBundle\Form\InstitucionType;
use AppBundle\Form\ProfessorType;
use AppBundle\Form\RegisterType;
use AppBundle\ViewModel\ChangePassword;
use AppBundle\ViewModel\Register;
use Proxies\__CG__\AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Exception\AlreadySubmittedException;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\SecurityContext;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $peticion = $this->getRequest();
        $sesion = $peticion->getSession();
        $error = $peticion->attributes->get(
            SecurityContext::AUTHENTICATION_ERROR,
            $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
        );

        //get the login error
        //$error = $authenticationUtils->getLastAuthenticationError();

        //last username entered by the user
        //$lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig',array(
        'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
        'error' => $error
    ));
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {

    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
    }

    /**
     * Activation of Users via its activation md5 hash
     *
     * @param string $hash The hash of the User email
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/activation/{token}", name="activation")
     */
    public function activationAction($token, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:User')->findByActivationCode($token);

        if ($entity->getIsActive()) {
            throw new AlreadySubmittedException();
        }

        if ($entity instanceof Professor) {
            $form = $this->createForm(new ActivateProfessorType(), $entity, array(
                'action' => $this->generateUrl('activation', array(
                    'token' => $token,
                )),
                'method' => 'POST',
            ));

            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->activateUser($entity);

                return $this->render(
                    'user/welcome.html.twig',
                    array(
                        'entity' => $entity,
                    )
                );
            }

            return $this->render(
                'professor/register.html.twig',
                array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                )
            );
        } else {
            $form = $this->createForm(new ActivateUserType(), $entity, array(
                'action' => $this->generateUrl('activation', array(
                    'token' => $token,
                )),
                'method' => 'POST',
            ));

            $form->handleRequest($request);
            if ($form->isValid())
            {
                $this->activateUser($entity);

                return $this->render(
                    'user/welcome.html.twig',
                    array(
                        'entity' => $entity,
                    )
                );
            }

            return $this->render(
                'user/register.html.twig',
                array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                )
            );
        }
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/cambiar_contrasena", name="change_password")
     */
    public function changePasswordAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $peticion = $this->getRequest();
        $sesion = $peticion->getSession();


        //get the login error
        $error = $authenticationUtils->getLastAuthenticationError();

        //last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        $entity = new ChangePassword();
        $form = $this->createChangePasswordForm($entity);

        return $this->render('login/change.password.html.twig', array(
            'last_username' => $lastUsername,
            'errors' => $form->getErrors(),
            'form' => $form->createView(),
        ));
    }

    private function createChangePasswordForm(ChangePassword $entity)
    {
        $form = $this->createForm(new ChangePasswordType(), $entity, array(
            'action' => $this->generateUrl('password_changed'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Creates a new Register entity.
     *
     * @Route("/contrasena_cambiada", name="password_changed")
     * @Method("POST")
     */
    public function passwordChangedAction(Request $request)
    {
        $entity = new ChangePassword();
        $form = $this->createChangePasswordForm($entity);
        $form->handleRequest($request);
        $user = $this->getUser();

        $encoder = $this->container->get('security.password_encoder');

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $passNew = $encoder->encodePassword($user, $entity->getPassword());
            $user->setPassword($passNew);

            $em->flush();

            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('login/change.password.html.twig', array(
            'entity' => $entity,
            'errors' => $form->getErrors(),
            'form' => $form->createView(),
        ));
    }


    /**
     * Creates a new Register entity.
     *
     * @Route("/register", name="registerUser")
     * @Method("POST")
     */
    public function registerSaveAction(Request $request)
    {
        $entity = new Register();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $user = new Investigador();
            $user->setName($entity->getNombre());
            $user->setUsername($entity->getUsername());
            $user->setEmail($entity->getEmail());

            $user->setPassword($entity->getPassword());
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);

            $user->setInstitucion($entity->getInstitucion());

            $user->setIsActive(false);

            // de vice2

            $hash = $this->get('app.utils')->randomMd5();
            $user->setActivationToken($hash);

            $role = $em->getRepository('AppBundle:Role')->findByNombre('Investigador');
            $user->addRole($role);

            $message = \Swift_Message::newInstance()
                ->setSubject('Administrador Laboratorio de analisis quimico indio hatuy: Confimación de su registro ')
                ->setFrom($this->container->getParameter('bundle.email'))
                ->setTo($entity->getEmail())
                ->setBody($this->renderView('emails/user_registration.txt.twig', array('entity' => $user,)));

            $this->get('mailer')->send($message);

            //fin de vice2

            $em->persist($user);

            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'Usted se ha inscrito correctamente espere un correo para activar la cuenta!');
            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('login/register.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Register entity.
     *
     * @param Register $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Register $entity)
    {
        $form = $this->createForm(new RegisterType(), $entity, array(
            'action' => $this->generateUrl('registerUser'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Register entity.
     *
     * @Route("/institucioninvestigador", name="register")
     * @Method("GET")
     *
     */
    public function registerAction(Request $request)
    {
        $entity = new Register();
        $form = $this->createCreateForm($entity);

        return $this->render('login/register.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    private function activateUser(\AppBundle\Entity\User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $user->getPassword());

        $user->setPassword($encoded);
        $user->setIsActive(true);
        $user->setActivationToken(null);

        $em->flush();
    }

    /**
     * Creates a new Institucion entity.
     *
     * @Route("/institucioninvestigador", name="institucion_nueva")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new Institucion();
        $form = $this->createInstitucionForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('regiter'));
        }

        return $this->render('login/institucion.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Institucion entity.
     *
     * @param Institucion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createInstitucionForm(Institucion $entity)
    {
        $form = $this->createForm(new InstitucionType(), $entity, array(
            'action' => $this->generateUrl('institucion_nueva'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Institucion entity.
     *
     * @Route("/institucioninvestigador", name="nuevainstitucion")
     * @Method("GET")
     *
     */
    public function newAction()
    {
        $entity = new Institucion();
        $form   = $this->createInstitucionForm($entity);

        return $this->render('login/institucion.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

}