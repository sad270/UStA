<?php

namespace USTA\MemberBundle\Controller;

use USTA\MemberBundle\Entity\MemberSearch;
use USTA\MemberBundle\Form\MemberSearchType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
  public function homeAction()
  {

    $member_search = new MemberSearch();


    $form = $this->createForm(MemberSearchType::class, $member_search, array(
      'action' => $this->generateUrl('usta_search_redirect'),
      'method' => 'POST',
    ));
      return $this->render('USTAMemberBundle:Search:home.html.twig', array(
        'form' => $form->createView(),
      ));
  }

  public function searchRedirectAction(Request $request)
  {
    $member_search = new MemberSearch();
    $form = $this->createForm(MemberSearchType::class, $member_search, array(
      'action' => $this->generateUrl('usta_search_redirect'),
      'method' => 'POST',
    ));
    if ($form->handleRequest($request)->isValid()) {
      $keyword = $form->getData()->getFirstnameLastname();
      $url = $this->generateUrl('usta_search_search', array(
        'keyword'  => $keyword,
        'page' => 1,
    ));

    return $this->redirect($url);
    }
  }

  public function searchAction($keyword, $page)
  {
    $results = false;
    $resultPerPage = 20;
    $nbPages = 0;
    if ($page < 1) {
      return $this->render('USTAMemberBundle::error.html.twig', array('errorTitle' => 'Page Introuvable.', 'errorBody' => "La page N° <strong>".$page."</strong> n'existe pas.<br> Le numéro de page ne peux pas être inferieur à 1"));
    }

    $member_search = new MemberSearch();
    $member_search->setFirstnameLastname($keyword);

    // On récupère le service validator
    $validator = $this->get('validator');

    // On déclenche la validation sur notre object
    $listErrors = $validator->validate($member_search);

    $form = $this->createForm(MemberSearchType::class, $member_search, array(
      'action' => $this->generateUrl('usta_search_redirect'),
      'method' => 'POST',
    ));

    // Si le tableau n'est pas vide, on affiche les erreurs
    if(count($listErrors) > 0) {
      return $this->render('USTAMemberBundle::error.html.twig', array('errorTitle' => 'Page Introuvable.', 'errorBody' => "La page N° <strong>".$page."</strong> n'existe pas."));
    } else {
      $results = $this->getDoctrine()->getRepository('USTAMemberBundle:Member')
      ->search($member_search->getFirstnameLastname(), $page, $resultPerPage);

      // On calcule le nombre total de pages grâce au count($listAdverts) qui retourne le nombre total d'annonces
      $nbPages = ceil(count($results)/$resultPerPage);
        // Si la page n'existe pas, on retourne une 404
        // if ($nbPages == 0) {
        //   return $this->render('USTAMemberBundle::error.html.twig', array('errorTitle' => 'Aucun résultat.', 'errorBody' => "Aucun membre ne correspond aux termes de recherche spécifiés  <strong>".$keyword."</strong>."));
        // }
        if($page > $nbPages && $nbPages != 0) {
          return $this->render('USTAMemberBundle::error.html.twig', array('errorTitle' => 'Page Introuvable.', 'errorBody' => "La page N° <strong>".$page."</strong> n'existe pas."));
        }
    }

    return $this->render('USTAMemberBundle:Search:search.html.twig', array(
      'form'    => $form->createView(),
      'results' => $results,
      'nbResults' => count($results),
      'nbPages' => $nbPages,
      'page'    => $page,
    ));


  }

  public function searchFormAction()
  {

    $member_search = new MemberSearch();


    $form = $this->createForm(MemberSearchType::class, $member_search, array(
      'action' => $this->generateUrl('usta_search_redirect'),
      'method' => 'POST',
    ));
      return $this->render('USTAMemberBundle:Search:searchForm.html.twig', array(
        'form' => $form->createView(),
      ));
  }

  public function searchAJAXAction(Request $request, $firstname_lastname)
  {
      // if ($request->isXmlHttpRequest()) {
        $results = $this->getDoctrine()->getRepository('USTAMemberBundle:Member')
        ->search($firstname_lastname, 1, 15);

          $members = array();
          if ($results) {
              foreach($results as $member) {
                $members[] = array(
                  'lastname' => strtoupper($member->getLastname()),
                  'firstname' => ucfirst(strtolower($member->getFirstname())),
                  'birthDate' => $member->getBirthDate()->format('d/m/Y'),
                  'family' => $member->getFamily()->getId(),
                );
              }
          }
          $response = new JsonResponse();
          return $response->setData($members);
      // } else {
      //     throw new \Exception('Erreur');
      // }
  }
}
