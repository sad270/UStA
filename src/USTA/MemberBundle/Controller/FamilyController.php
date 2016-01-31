<?php

namespace USTA\MemberBundle\Controller;

use USTA\MemberBundle\Entity\Family;
use USTA\MemberBundle\Form\FamilyType;
use USTA\AccountBundle\Form\MembershipFeeType;
use USTA\AccountBundle\Entity\MembershipFee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FamilyController extends Controller
{
    public function addeditAction(Request $request, $id = null)
    {
      if($id ){
        $family = $this->getDoctrine()->getRepository('USTAMemberBundle:Family')->find($id);

        // On vérifie que family avec cet id existe bien
        if ($family === null) {
          return $this->render('USTAMemberBundle::error.html.twig', array('errorTitle' => 'Famille Introuvable.', 'errorBody' => 'La Famille N° <strong>' . $id . '</strong> est introuvable.'));
        }
      } else {
        $family = new Family();
      }

      $form = $this->createForm(FamilyType::class, $family);

      if ($form->handleRequest($request)->isValid()) {

        //On l'enregistre notre objet $advert dans la base de données, par exemple
        $em = $this->getDoctrine()->getManager();
        $em->persist($family);
        $em->flush();

        $this->addFlash('success', 'Famille bien enregistrée.');

        return $this->redirect($this->generateUrl('usta_family_view', array('id' => $family->getId())));
      }

      // À ce stade, le formulaire n'est pas valide car :
      // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
      // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau

      return $this->render('USTAMemberBundle:Family:add.html.twig', array(
        'form' => $form->createView(),
      ));
    }

    public function viewAction(Request $request, $id)
    {
      $family = $this->getDoctrine()->getRepository('USTAMemberBundle:Family')->find($id);

        // On vérifie que family avec cet id existe bien
        if ($family === null) {
          return $this->render('USTAMemberBundle::error.html.twig', array('errorTitle' => 'Famille Introuvable.', 'errorBody' => 'La Famille N° <strong>' . $id . '</strong> est introuvable.'));
        }

        $membershipFee = new MembershipFee();
        $membershipFee->setFamily($family->getId());

        $form = $this->createForm(MembershipFeeType::class, $membershipFee);

        if ($form->handleRequest($request)->isValid()) {

          //On l'enregistre notre objet $advert dans la base de données, par exemple
          $em = $this->getDoctrine()->getManager();
          $em->persist($membershipFee);
          $em->flush();

          $this->addFlash('success',"Paiement bien enregistrée.");
          $membershipFee = new MembershipFee();
        }
        if($form->getErrors(true)->count()){
          $this->addFlash('warning',"Une erreur s'est produite lors du paiement. Veuillez verifier que vous avez bien rempli les champs du formulaire.");
        }

        $membershipFeesHistory = $this->getDoctrine()->getRepository('USTAAccountBundle:membershipFee')->myFindByFamily($family->getId());
        return $this->render('USTAMemberBundle:Family:view.html.twig', array(
          'membershipFeesHistory' => $membershipFeesHistory,
          'family' => $family,
          'form' => $form->createView()
          ));
    }

    public function deleteAction(Request $request)
    {
        $id = $request->request->get('usta_memberbundle_family_id', 0);
        $family = $this->getDoctrine()->getRepository('USTAMemberBundle:Family')->find($id);
        // On vérifie que family avec cet id existe bien
        if ($family === null) {
          return $this->render('USTAMemberBundle::error.html.twig', array('errorTitle' => 'Famille Introuvable.', 'errorBody' => 'La Famille N° <strong>' . $id . '</strong> est introuvable.'));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($family);
        $em->flush();
        return $this->render('USTAMemberBundle:Family:delete.html.twig', array('id' => $id));
    }
}
