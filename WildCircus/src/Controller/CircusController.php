<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Entity\Contact;
use App\Entity\Reservation;
use App\Form\ContactType;
use App\Form\ReservationType;
use App\Notification\ContactNotification;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CircusController extends AbstractController
{
    /**
     * @Route("/", name="circus_index")
     * @param ArtistRepository $artistRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ArtistRepository $artistRepository)
    {
        return $this->render('circus/index.html.twig', [
            'artists' => $artistRepository->findAllArtistsWithPerformance(),
        ]);
    }

    /**
     * @Route("/{id}", name="artist_show")
     * @param Artist $artist
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArtist(Artist $artist)
    {
        return $this->render('artist/show.html.twig', [
            'artist' => $artist
        ]);
    }

    /**
     * @Route("circus/histoire", name="circus_history")
     * @param Request $request
     * @param ContactNotification $notification
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function history(Request $request, ContactNotification $notification): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);
            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('circus_index');
        }
        return $this->render('circus/history.html.twig',[
            'form' => $form->createView(),

        ]);

    }

    /**
     * @Route("circus/reservation", name="reservation")
     * @param Request $request
     * @param ContactNotification $notification
     * @return Response
     */
    public function reservation(Request $request, ContactNotification $notification)
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $notification->reservationNotify($reservation);
            $this->addFlash('success', 'Votre réservation a bien été prise en compte, un mail vous a été envoyé');
            return $this->redirectToRoute('circus_index');

        }
        return $this->render('reservation/form.html.twig',[
                'form' => $form->createView(),

            ]);
    }
}
