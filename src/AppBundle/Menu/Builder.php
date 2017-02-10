<?php
/**
 * Created by PhpStorm.
 * User: olaf
 * Date: 30.01.17
 * Time: 20:08
 */

namespace AppBundle\Menu;


use Knp\Menu\FactoryInterface;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class Builder implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /** @var  AuthorizationCheckerInterface */
    private $securityContext;


    public function mainMenu(
        FactoryInterface $factory,
        /** @noinspection PhpUnusedParameterInspection */
        array $options
    )
    {
        /** @var Translator $translator */
        $translator = $this->container->get('translator');
        $menu = $factory->createItem('root');

        $menu->addChild('menu.home', [
                'route' => 'homepage',
                'label' => $translator->trans('menu.home', [], 'menu')
            ]
        )->setExtra('translation_domain', false);

        if ($this->securityContext->isGranted('ROLE_ADMIN')) {
            $menu->addChild('menu.supplier', [
                    'route' => 'app_supplier_index',
                    'label' => $translator->trans('menu.supplier', [], 'menu')
                ]
            )->setExtra('translation_domain', false);


            $menu->addChild('menu.admin', [
                    'route' => 'app_admin_index',
                    'label' => $translator->trans('menu.admin', [], 'menu')
                ]
            )->setExtra('translation_domain', false);;

            $menu['menu.admin']->addChild('menu.users', [
                    'route' => 'app_admin_users',
                    'label' => $translator->trans('menu.users', [], 'menu')
                ]
            )->setExtra('translation_domain', false);;
        }
        return $menu;
    }

    public function rightMenu(
        FactoryInterface $factory,
        /** @noinspection PhpUnusedParameterInspection */
        array $options
    )
    {
        $translator = $this->container->get('translator');
        $menu = $factory->createItem('root');
        if ($this->securityContext->isGranted('ROLE_USER')) {

            $menu->addChild('menu.account', [
                    'label' => $translator->trans('menu.account', [], 'menu')
                ]
            )->setExtra('translation_domain', false);

            $menu['menu.account']->addChild('menu.profile', [
                    'route' => 'fos_user_profile_show',
                    'label' => $translator->trans('menu.profile', [], 'menu')
                ]
            )->setExtra('translation_domain', false);

            $menu['menu.account']->addChild('menu.changepass', [
                    'route' => 'fos_user_change_password',
                    'label' => $translator->trans('menu.changepass', [], 'menu')
                ]
            )->setExtra('translation_domain', false);

            $menu['menu.account']->addChild('menu.logout', [
                    'route' => 'fos_user_security_logout',
                    'label' => $translator->trans('menu.logout', [], 'menu')
                ]
            )->setExtra('translation_domain', false);;
        } else {
            $menu->addChild('menu.login', [
                    'route' => 'fos_user_security_login',
                    'label' => $translator->trans('menu.login', [], 'menu')
                ]
            )->setExtra('translation_domain', false);;
        }
        return $menu;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        if (!$container) {
            return;
        }
        $this->container = $container;
        $this->securityContext = $this->container->get('security.authorization_checker');
    }
}
