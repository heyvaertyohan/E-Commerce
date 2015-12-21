<?php

namespace ECommerce\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ECommerce\PageBundle\Entity\Page;

class PageController extends Controller
{
    public function menuAction()
    {
        $pages = $this->getDoctrine()->getManager()->getRepository('ECommercePageBundle:Page')->findAll();

        return $this->render('ECommercePageBundle:Page:menu.html.twig', array(
            'pages' => $pages
        ));
    }

    public function pageAction(Page $page)
    {
        $page = $this->getDoctrine()->getManager()->getRepository('ECommercePageBundle:Page')->find($page->getId());

        return $this->render('ECommercePageBundle:Page:page.html.twig', array(
            'page' => $page
        ));
    }
}
