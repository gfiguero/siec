<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class MenuInstructivoBuilder
{
    private $factory;

    private $tokenStorage;

    private $authorizationCheckerInterface;

    public function __construct(FactoryInterface $factory, AuthorizationCheckerInterface $authorizationCheckerInterface, TokenStorage $tokenStorage)
    {
        $this->factory = $factory;
        $this->tokenStorage = $tokenStorage;
        $this->authorizationCheckerInterface = $authorizationCheckerInterface;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array('class' => 'nav nav-pills nav-fill flex-column py-2')));

        $menu->addChild('Registrar Accidente', ['route' => 'accidente_new',]);

        return $menu;
    }

}