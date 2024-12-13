<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserController extends AbstractController
{
    // Consultation et mise à jour des informations personnelles
    #[Route('/user/profile', name: 'user_profile')]
    public function profile(): Response
    {
        return $this->render('user/profile.html.twig');
    }

    #[Route('/user/profile/edit', name: 'user_edit_profile')]
    public function editProfile(): Response
    {
        // Logic for editing user profile (CRUD: update)
        return $this->render('user/edit_profile.html.twig');
    }

    // Gestion des réservations de l'utilisateur
    #[Route('/user/reservations', name: 'user_reservations')]
    public function listReservations(ReservationRepository $reservationRepository): Response
    {
        $user = $this->getUser();
        $reservations = $reservationRepository->findBy(['user' => $user]);
        return $this->render('user/reservations/index.html.twig', [
            'reservations' => $reservations
        ]);
    }

    #[Route('/user/reservation/new', name: 'user_new_reservation')]
    public function newReservation(): Response
    {
        // Logic for creating a reservation
        return $this->render('user/reservations/new.html.twig');
    }
}