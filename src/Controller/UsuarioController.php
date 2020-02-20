<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use App\Form\UsuarioType;
use App\Form\UsuarioRegistroType;
use Knp\Component\Pager\PaginatorInterface;
use FOS\UserBundle\Model\UserManagerInterface;

/**
 * @Route("/usuario")
 */
class UsuarioController extends AbstractController
{
    /**
     * @Route("/", name="usuario_index")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $query = $this->getDoctrine()->getRepository(Usuario::class)->findAll();
        $page = 1;
        $limit = 100;
        $usuarios = $paginator->paginate($query, $request->query->getInt('page', $page), $limit);

        return $this->render('usuario/index.html.twig', [
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * @Route("/new", name="usuario_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserManagerInterface $userManager): Response
    {
        $usuario = $userManager->createUser();

        $form = $this->createForm(UsuarioRegistroType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->updateUser($user);
            return $this->redirectToRoute('usuario_index');
        }

        return $this->render('usuario/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
