<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Reservation;
use App\Repository\UserRepository;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AdminController extends AbstractController
{
    // CRUD Utilisateurs pour les administrateurs
    #[Route('/admin/users', name: 'admin_users')]
    public function listUsers(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('admin/users/index.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/admin/user/{id}/edit', name: 'admin_edit_user')]
    public function editUser(User $user, Request $request): Response
    {
        // Logic for editing a user (CRUD: create, update)
        return $this->render('admin/users/edit.html.twig', ['user' => $user]);
    }

    #[Route('/admin/user/{id}/delete', name: 'admin_delete_user')]
    public function deleteUser(User $user, UserRepository $userRepository): Response
    {
        $userRepository->remove($user);
        return $this->redirectToRoute('admin_users');
    }

    // Gestion des réservations
    #[Route('/admin/reservations', name: 'admin_reservations')]
    public function listReservations(ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findAll();
        return $this->render('admin/reservations/index.html.twig', [
            'reservations' => $reservations
        ]);
    }
}
