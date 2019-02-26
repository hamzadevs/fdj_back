<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class SoccerController extends ApiController{

    /**
     * @Route("/test", name="championat", methods="GET")
     */
    public function index()
    {

        $leagues = $this->CallApi("GET",$this->container->getParameter('apiUrl')."search_all_teams.php?l=French%20ligue%201");
        if ($leagues['status']) {
            return $this->respond($leagues['data']);
        } else {
            return  $this->respondWithErrors($teams['message']);
        }

    }
    /**
     * 
     */
    public function getAllLeagues()
    {
        $leagues = $this->CallApi("GET",$this->container->getParameter('apiUrl')."all_leagues.php");
        if ($leagues['status']) {
            return $this->respond($leagues['data']);
        } else {
            return  $this->respondWithErrors($teams['message']);
        }  
    }

    public function getAllTeams($league)
    {
        if($league){
            $teams = $this->CallApi("GET",$this->container->getParameter('apiUrl')."search_all_teams.php?l=".$league);
            if (!$teams['status']) {
                return $this->respondWithErrors($teams['message']);
            }else
                return $this->respond($teams['data']);
        }else return $this->respondNotFound();
        
    }
    public function getAllPlayers($teamId)
    {
        if($teamId){
            $players = $this->CallApi("GET",$this->container->getParameter('apiUrl')."lookup_all_players.php?id=".$teamId);
            if (!$players['status']) {
                return $this->respondWithErrors($players['message']);
            }else
                return $this->respond($players['data']);
        }else return $this->respondNotFound();
        
    }
}