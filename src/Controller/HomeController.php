<?php

namespace App\Controller;

use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Member;
use App\Service\CsvHelper;

class HomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }


    #[Route('/teams/export', name: 'app_teams_export')]
    public function exportTeams(): Response
    {
        try {
            $jsonFile  = file_get_contents(__DIR__."\sample_data_test.json"); // get file
            $teamsData = json_decode($jsonFile)->teams;
            $columns   = Team::COLUMNS; // get file columns
            $fileName  = 'teams';
            $helper    = new CsvHelper();
            $file = $helper::createFile($columns); // initiate file with columns

            foreach ($teamsData as $team){ // parse json data
                $ages      = array_column($team->members, 'age');
                $avgAge    = $helper::calculateAvg($ages);
                $nbMembers = count($team->members);
                $isActive  = $team->active ? 'true' : 'false';

                $inputData = array(     //prepare row
                    'squadName' => $team->squadName ?? '',
                    'homeTown'  => $team->homeTown ?? '',
                    'formed'    => $team->formed ?? '',
                    'base'      => $team->secretBase ?? '',
                    'nb_members'=> $nbMembers ?? '',
                    'avgage'    =>  $avgAge ?? '',
                    'active'    => $isActive,
                );
                fputcsv($file,array_values($inputData));
            }
            fclose($file);

            $response = new Response();
            $response->headers->set('Content-Type', 'text/csv');//output in a $filename.csv file
            $response->headers->set('Content-Disposition', 'attachment; filename="'.$fileName.'.csv"');
            return $response;
        }catch (\Exception $e){
            return $this->json(['status' =>'error','message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    #[Route('/members/export', name: 'app_members_export')]
    public function exportMembers(): Response
    {
        try {
            $jsonFile  = file_get_contents(__DIR__."\sample_data_test.json"); // get file
            $datas  =json_decode($jsonFile)->teams;
            $columns  = Member::COLUMNS; //get columns
            $fileName = 'members';
            $helper = new CsvHelper();
            $file = $helper::createFile($columns);

            foreach ($datas as $team){ // parse json data
                foreach ($team->members as $member){

                    $inputData = array(
                        'squadName' => $team->squadName ?? '',
                        'homeTown'  => $team->homeTown ?? '',
                        'name'      => $member->name ?? '',
                        'secretId'  => $member->secretIdentity ?? '',
                        'age'       => $member->age ?? '',
                        'nb_powers'=>  '',
                    );

                    if (is_array($member->powers)){ // prepare powers columns data
                        $inputData['nb_powers'] = count($member->powers);
                        foreach ($member->powers as  $key => $power){
                            $inputData['Power'.$key] = $power;
                            $inputData['PowerCode'.$key] = Member::POWERS[$power];
                        }
                    }
                fputcsv($file,array_values($inputData));
                }
            }
            fclose($file);

            $response = new Response();
            $response->headers->set('Content-Type', 'text/csv');//output in a $filename.csv file
            $response->headers->set('Content-Disposition', 'attachment; filename="'.$fileName.'.csv"');
            return $response;
        }catch (\Exception $e){
            return $this->json(['status' =>'error','message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

    }
}
