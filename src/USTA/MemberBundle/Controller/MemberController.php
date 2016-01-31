<?php

namespace USTA\MemberBundle\Controller;

use USTA\MemberBundle\Entity\Member;
use USTA\MemberBundle\Form\MemberDeathType;
use USTA\MemberBundle\Form\MemberType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MemberController extends Controller
{
  public function deathAction(Request $request, $id = null)
  {
      $member = $this->getDoctrine()->getRepository('USTAMemberBundle:Member')->find($id);
      // On vérifie que family avec cet id existe bien
      if ($member === null) {
        return $this->render('USTAMemberBundle::error.html.twig', array('errorTitle' => 'Famille Introuvable.', 'errorBody' => 'Le membre N° <strong>' . $id . '</strong> est introuvable.'));
      }
      $form = $this->createForm(MemberDeathType::class, $member);

      if ($form->handleRequest($request)->isValid()) {

        //On l'enregistre notre objet $advert dans la base de données, par exemple
        $em = $this->getDoctrine()->getManager();
        $em->persist($member);
        $em->flush();

        $this->addFlash('success', 'Décès bien enregistrée.');

        return $this->redirect($this->generateUrl('usta_family_view', array('id' => $member->getFamily()->getId())));
      }

      return $this->render('USTAMemberBundle:Member:death.html.twig', array(
        'form' => $form->createView(),
      ));
  }
    public function addAction()
    {
        return $this->render('USTAMemberBundle:Member:add.html.twig', array());
    }
    public function viewAction($id)
    {
        return $this->render('USTAMemberBundle:Member:view.html.twig', array('id' => $id));
    }
    public function editAction($id)
    {
        return $this->render('USTAMemberBundle:Member:edit.html.twig', array('id' => $id));
    }
    public function deleteAction($id)
    {
        return $this->render('USTAMemberBundle:Member:delete.html.twig', array('id' => $id));
    }
}
