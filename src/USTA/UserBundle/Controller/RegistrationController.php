<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace USTA\UserBundle\Controller;

use USTA\UserBundle\Entity\Invitation;
use USTA\UserBundle\Form\SendInvitationType;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
/**
 * Controller managing the registration
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author Christophe Coevoet <stof@notk.org>
 */
class RegistrationController extends BaseController
{
  public function InviteAction(Request $request)
  {
    $invitation = new Invitation();

    $form = $this->createForm(SendInvitationType::class, $invitation);

    if ($form->handleRequest($request)->isValid()) {
      // If email already existe, resend the same code.
      if($result = $this->getDoctrine()->getRepository('USTAUserBundle:Invitation')->findOneByEmail($invitation->getEmail())){
        $result
          ->setFirstname($invitation->getFirstname())
          ->setLastname($invitation->getLastname())
          ->setDate($invitation->getDate())
          ;
        $invitation = $result;
      }
      // send the invitation
      $message = \Swift_Message::newInstance()
      ->setSubject('[UStA] Code d\'activation')
      ->setFrom('send@example.com')
      ->setTo($invitation->getEmail())
      ->setBody(
          $this->renderView(
              'USTAUserBundle:Registration:inviteEMAIL.html.twig',
              array('invitation' => $invitation)
          ),
          'text/html'
      )
      ;
      $this->get('mailer')->send($message);



// On dit que le mail a était envoyé et on enregistre dans la base de donnée
$invitation->send();
$em = $this->getDoctrine()->getManager();
$em->persist($invitation);
$em->flush();

$this->addFlash('success', "L'invitation de <strong>" . $invitation->getLastname() . " " . $invitation->getFirstname() . " (" . $invitation->getEmail() . ")</strong> a été envoyé avec succés !");
if($this->get('kernel')->getEnvironment() == "dev"){
  $this->addFlash('info', "<strong>[ " . $this->get('kernel')->getEnvironment() . " ]</strong> code : <strong>" . $invitation->getCode() . "</strong>");
}

$invitation = new Invitation();
$form = $this->createForm(SendInvitationType::class, $invitation);
    }
    $allInvitationOrderByDate = $this->getDoctrine()->getRepository('USTAUserBundle:Invitation')->getAllInvitationOrderByDate();
    return $this->render('USTAUserBundle:Registration:invite.html.twig', array(
      'form' => $form->createView(),
      'invitations' => $allInvitationOrderByDate,
    ));
  }
}
