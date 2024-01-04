<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\FullCalendar;
use App\Repository\FullCalendarRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class FullCalendarController extends AbstractController
{
    #[Route('/full/calendar', name: 'full_calendar')]
    public function index(): Response
    {
        return $this->render('full_calendar/index.html.twig');
    }

    #[Route('/full/calendar/new_event', name:'calendar_new_event')]
    public function create(EntityManagerInterface $entityManager, Request $request)
    {
        $form = $this->createFormBuilder()
        ->add('title')
        ->add('start', DateType::class, [
            'widget' => 'choice',
        ])
        ->add('end', DateType::class, [
            'widget' => 'choice',
        ])
        ->add('send', SubmitType::class)
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $calendar = new FullCalendar();

            $data = $form->getData();

            // dd($data);
            $calendar->setTitle($data['title']);
            $calendar->setStart($data['start']);
            $calendar->setFinalDate($data['end']);
            $entityManager->persist($calendar);
            $entityManager->flush();

            return $this->redirectToRoute('full_calendar');
        }


        return $this->render('full_calendar/create_event.html.twig',[
            'form' => $form
        ]);
    }

    #[Route('/full/calendar/events', name:'calendar_events')]
    public function getEvents(EntityManagerInterface $entityManager, FullCalendarRepository $calendarRepository){

        $events = $calendarRepository->getAllEvents();

        // dd(json_encode($events));
        return new JsonResponse($events);
    }

}
