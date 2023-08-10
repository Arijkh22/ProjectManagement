<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Tache;
use App\Form\TacheType;
use App\Repository\ProjectRepository;
use App\Repository\TacheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;


#[Route('/tache/{id_projet}')]
class TacheController extends AbstractController
{
    public function index(int $id_projet, ProjectRepository $projectRepository): Response
    {
        $repository = $this->getDoctrine()->getRepository(Tache::class);
        $projet = $projectRepository->find($id_projet);
        $taches = $repository->findBy(['project_name' => $projet]);

        return $this->render('tache/index.html.twig', [
            'taches' => $taches,
            'project' => $projet,
        ]);
    }

    #[Route('/new', name: 'app_tache_new', methods: ['GET', 'POST'])]
    public function new(Request $request, int $id_projet, EntityManagerInterface $entityManager, ProjectRepository $projectRepository): Response
    {
        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache);
        $projet = $projectRepository->find($id_projet);
        $tache->setProjectName($projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tache);
            $entityManager->flush();

            return $this->redirectToRoute('app_tache_index', ['id_projet' => $projet->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tache/new.html.twig', [
            'tache' => $tache,
            'project' => $projet,
            'form' => $form,
        ]);
    }

    #[Route('/detail/{id}', name: 'app_tache_show', methods: ['GET'], priority: 5)]
    public function show(Tache $tache): Response
    {
        return $this->render('tache/show.html.twig', [
            'tache' => $tache,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tache_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tache $tache, int $id_projet, EntityManagerInterface $entityManager, ProjectRepository $projectRepository): Response
    {
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        $projet = $projectRepository->find($id_projet);
        $tache->setProjectName($projet);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tache_index', ['id_projet' => $projet->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tache/edit.html.twig', [
            'tache' => $tache,
            'project' => $projet,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_tache_delete', methods: ['POST'])]
    public function delete(Request $request, Tache $tache, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $tache->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tache);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tache_index', ['id_projet' => $tache->getProjectName()->getId()], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/detail', name: 'app_tache_detail')]
    public function detail(Request $request, int $id_projet, Tache $tache, EntityManagerInterface $entityManager): Response
    {
        return $this->render(view: 'tache/tache.html.twig', parameters: [

        ]);

    }

    /**
     * @Route("/get-tasks", name="get_tasks", methods={"GET"}, priority=1)
     */
    public function getTasksForProject(TacheRepository $tacheRepository, int $id_projet): JsonResponse
    {
        $project = $this->getDoctrine()->getRepository(Project::class)->find($id_projet);

        if (!$project) {
            return new JsonResponse(['error' => 'Project not found'], Response::HTTP_NOT_FOUND);
        }

        $tasks = $tacheRepository->findBy(['project_name' => $project]);

        $response = [];
        foreach ($tasks as $task) {
            $response[] = ['nom' => $task->getTache()];
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/add-task", name="app_tache_add_task", methods={"POST"},priority=1)
     */
    public function addTask(Request $request, int $id_projet, EntityManagerInterface $entityManager): Response
    {
        $taskText = $request->request->get('taskText');
        $project = $this->getDoctrine()->getRepository(Project::class)->find($id_projet);

        if (!$project) {
            return new JsonResponse(['error' => 'Project not found'], Response::HTTP_NOT_FOUND);
        }

        $tache = new Tache();
        $tache->setTache($taskText);
        $tache->setProjectName($project);

        $entityManager->persist($tache);
        $entityManager->flush();

        return new JsonResponse(['success' => true]);


        //return new JsonResponse(['success' => false], Response::HTTP_BAD_REQUEST);
    }


    #[Route('/get-users-ajax', name: 'get_users_ajax', methods: ['GET'])]
    public function getUsersAjax(): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository(User::class)->findAll();

        $userArray = [];
        foreach ($users as $user) {
            $userArray[] = ['username' => $user->getUsername()];
        }

        return new JsonResponse($userArray);
    }

    #[Route('/delete/{id}', name: 'app_tache_delete', methods: ['POST'])]
    public function deleteJson(Request $request, Tache $tache, EntityManagerInterface $entityManager): Response
    {
        // Vérifiez si le jeton CSRF est valide
        if ($this->isCsrfTokenValid('delete' . $tache->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tache);
            $entityManager->flush();
        }

        // Rediriger vers la liste des tâches après la suppression
        // Vous pouvez adapter cette redirection en fonction de vos besoins
        return $this->redirectToRoute('app_tache_index', ['id_projet' => $tache->getProjectName()->getId()], Response::HTTP_SEE_OTHER);
    }


}
