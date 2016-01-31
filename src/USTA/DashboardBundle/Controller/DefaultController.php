<?php

namespace USTA\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
      $results = false;
      $resultPerPage = 20;
      $nbPages = 0;
      $page = 1;
      $results = $this->getDoctrine()->getRepository('USTAMemberBundle:Member')
      ->getLastDeath($page, $resultPerPage);
        $nbPages = ceil(count($results)/$resultPerPage);

      return $this->render('USTADashboardBundle:Default:index.html.twig', array(
        'results' => $results,
      ));
    }
}
