<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */

    private $tokenStorage;

    private $authorizationCheckerInterface;

    public function __construct(FactoryInterface $factory, AuthorizationCheckerInterface $authorizationCheckerInterface, TokenStorageInterface $tokenStorage)
    {
        $this->factory = $factory;
        $this->tokenStorage = $tokenStorage;
        $this->authorizationCheckerInterface = $authorizationCheckerInterface;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array('class' => 'nav nav-pills nav-fill flex-column py-2')));

        $menu->addChild('Registrar Accidente', ['route' => 'registro_new',])->setAttribute('icon', 'fa fa-car-crash');

        return $menu;
    }

    public function createUserMenu(array $options)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array('class' => 'nav nav-pills mb-2')));

        $menu->addChild('Ver Perfil', ['route' => 'fos_user_profile_show',]);
        $menu->addChild('Editar perfil', ['route' => 'fos_user_profile_edit',]);
        $menu->addChild('Cambiar password', ['route' => 'fos_user_change_password',]);

        return $menu;
    }

    public function createTopMenu(array $options)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array('class' => 'nav navbar-nav ml-auto')));

        if ($this->authorizationCheckerInterface->isGranted('ROLE_CARABINERO_SIEC')) {
            $menu->addChild('SIEC', ['route' => 'inspeccion_index',])->setAttribute('icon', 'fa fa-search');
        }

        if ($this->authorizationCheckerInterface->isGranted('ROLE_CARABINERO')) {
            $menu
                ->addChild('Accidentes', ['route' => 'registro_unidad_index'])
                ->setAttribute('icon', 'fa fa-car-crash')
                ->setExtra('routes', [
                    'accidente_unidad_index',
                    'accidente_funcionario_index',
                    'accidente_new',
                    'accidente_identificacion',
                    'accidente_causas',
                    'accidente_condiciones',
                    'accidente_ubicacion',
                    'accidente_vehiculos',
                    'accidente_personas',
                    'accidente_resumen',
                    'accidente_mensaje',
                ])
            ;
        }

        if ($this->authorizationCheckerInterface->isGranted('ROLE_ADMIN')) {
            $menu->addChild('Administración', ['route' => 'easyadmin',])->setAttribute('icon', 'fa fa-cogs')->setLinkAttribute('target', '_blank');
        }

        if ($this->authorizationCheckerInterface->isGranted('ROLE_USER')) {
//            $menu->addChild('Usuario', ['route' => 'fos_user_profile_show',])->setAttribute('icon', 'fa fa-user-circle')->setExtra('routes', ['fos_user_profile_show','fos_user_profile_edit','fos_user_change_password']);
            $menu->addChild($this->tokenStorage->getToken()->getUser()->getUsername(), ['route' => 'fos_user_profile_show',])->setAttribute('icon', 'fa fa-user-circle')->setExtra('routes', ['fos_user_profile_show','fos_user_profile_edit','fos_user_change_password']);
            $menu->addChild('Salir', ['route' => 'fos_user_security_logout'])->setAttribute('icon', 'fa fa-sign-out-alt');
        }

        return $menu;
    }

    public function createAnalisisMenu(array $options)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array( 'class' => 'nav navbar-nav' )));

        if ($this->authorizationCheckerInterface->isGranted('ROLE_CARABINERO')) {
            $funcionario = $this->tokenStorage->getToken()->getUser()->getFuncionario();
            if ($funcionario && $funcionario->getUnidad()) {
                $unidad = $funcionario->getUnidad();
                $menu->addChild('Dashboard', ['route' => 'analisis_unidad'])->setAttribute('icon', 'fa fa-chart-pie');
//                $menu->addChild($unidad->getNombre(), ['route' => 'analisis_unidad'])->setAttribute('icon', 'fa fa-flag');
//                $menu->addChild($funcionario->getNombreCompleto(), ['route' => 'analisis_funcionario'])->setAttribute('icon', 'fa fa-id-card');
            }
        }

        return $menu;
    }

    public function createAccidentesMenu(array $options)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array( 'class' => 'nav nav-pills')));

        $funcionario = $this->tokenStorage->getToken()->getUser()->getFuncionario();
        if ($funcionario && $funcionario->getUnidad()) {
            $unidad = $funcionario->getUnidad();
            $comuna = $unidad->getComuna();
            $menu->addChild('Accidentes funcionario', ['route' => 'registro_funcionario_index'])->setAttribute('icon', 'fa fa-search');
            $menu->addChild('Accidentes unidad', ['route' => 'registro_unidad_index'])->setAttribute('icon', 'fa fa-search');
        }

        return $menu;
    }

    public function createInspeccionAccidentesMenu(array $options)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array( 'class' => 'nav nav-pills')));

        $menu->addChild('Filtrar', ['route' => 'inspeccion_accidente_filtrar'])->setAttribute('icon', 'fa fa-filter');
        $menu->addChild('Buscar', ['route' => 'inspeccion_accidente_buscar'])->setAttribute('icon', 'fa fa-search');
        $menu->addChild('Exportar', ['route' => 'inspeccion_accidente_exportar'])->setAttribute('icon', 'fa fa-share');

        return $menu;
    }

    public function createInspeccionAccidentesVehiculosMenu(array $options)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array( 'class' => 'nav nav-pills')));

        $menu->addChild('Filtrar', ['route' => 'inspeccion_accidenteVehiculo_filtrar'])->setAttribute('icon', 'fa fa-filter');
        $menu->addChild('Buscar', ['route' => 'inspeccion_accidenteVehiculo_buscar'])->setAttribute('icon', 'fa fa-search');
        $menu->addChild('Exportar', ['route' => 'inspeccion_accidenteVehiculo_exportar'])->setAttribute('icon', 'fa fa-share');

        return $menu;
    }

    public function createInspeccionAccidentesPersonasMenu(array $options)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array( 'class' => 'nav nav-pills')));

        $menu->addChild('Filtrar', ['route' => 'inspeccion_accidentePersona_filtrar'])->setAttribute('icon', 'fa fa-filter');
        $menu->addChild('Buscar', ['route' => 'inspeccion_accidentePersona_buscar'])->setAttribute('icon', 'fa fa-search');
        $menu->addChild('Exportar', ['route' => 'inspeccion_accidentePersona_exportar'])->setAttribute('icon', 'fa fa-share');

        return $menu;
    }

    public function createInspeccionAccidentesUnidadesMenu(array $options)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array( 'class' => 'nav nav-pills')));

        $menu->addChild('Filtrar', ['route' => 'inspeccion_accidenteUnidad_filtrar'])->setAttribute('icon', 'fa fa-filter');
        $menu->addChild('Buscar', ['route' => 'inspeccion_accidenteUnidad_buscar'])->setAttribute('icon', 'fa fa-search');
        $menu->addChild('Exportar', ['route' => 'inspeccion_accidenteUnidad_exportar'])->setAttribute('icon', 'fa fa-share');

        return $menu;
    }

    public function createInspeccionVehiculosMenu(array $options)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array( 'class' => 'nav nav-pills')));

        $menu->addChild('Filtrar', ['route' => 'inspeccion_vehiculo_filtrar'])->setAttribute('icon', 'fa fa-filter');
        $menu->addChild('Buscar', ['route' => 'inspeccion_vehiculo_index'])->setAttribute('icon', 'fa fa-search');
        $menu->addChild('Exportar', ['route' => 'inspeccion_vehiculo_exportar'])->setAttribute('icon', 'fa fa-share');

        return $menu;
    }

    public function createInspeccionPersonasMenu(array $options)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array( 'class' => 'nav nav-pills')));

        $menu->addChild('Filtrar', ['route' => 'inspeccion_persona_filtrar'])->setAttribute('icon', 'fa fa-filter');
        $menu->addChild('Buscar', ['route' => 'inspeccion_persona_index'])->setAttribute('icon', 'fa fa-search');
        $menu->addChild('Exportar', ['route' => 'inspeccion_persona_exportar'])->setAttribute('icon', 'fa fa-share');

        return $menu;
    }

    public function createSiecMenu(array $options)
    {
        $menu = $this->factory->createItem('root', array('childrenAttributes' => array( 'class' => 'nav flex-column nav-pills')));

        $menu->addChild('Inspección', ['route' => 'inspeccion_index'])->setAttribute('icon', 'fa fa-search')->setExtra('routes', [
            'inspeccion_index',
            'inspeccion_accidenteUnidad_filtrar',
            'inspeccion_accidenteUnidad_buscar',
            'inspeccion_accidenteUnidad_exportar',
            'inspeccion_accidenteUnidad_resumen',
            'inspeccion_accidenteUnidad_objetar',
            'inspeccion_accidenteUnidad_mensaje',
            'inspeccion_accidenteUnidad_editar',
            'inspeccion_accidenteUnidad_editarVehiculo',
            'inspeccion_accidenteUnidad_editarConductor',
            'inspeccion_accidenteUnidad_editarPasajero',
            'inspeccion_accidenteUnidad_editarPeaton',

        ]);

        $menu->addChild('Mensajes', ['route' => 'mensaje_index'])->setAttribute('icon', 'fa fa-envelope')->setExtra('routes', ['mensaje_index','mensaje_edit','mensaje_new']);

        $menu->addChild('Usuarios', ['route' => 'usuario_index'])->setAttribute('icon', 'fa fa-users');

        $menu->addChild('Funcionarios', ['route' => 'funcionario_index'])->setAttribute('icon', 'fas fa-shield-alt');

        $menu->addChild('Unidades', ['route' => 'unidad_index'])->setAttribute('icon', 'fa fa-flag');

        return $menu;
    }
}