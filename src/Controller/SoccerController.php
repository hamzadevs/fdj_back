<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class SoccerController extends ApiController{

    /**
     * @Route("/get_leagues", name="get_leagues", methods="GET")
     */
    public function getAllLeagues()
    {
        $leagues = $this->CallApi("GET",$this->container->getParameter('apiUrl')."all_leagues.php");
        if ($leagues['status']) {
            return $this->respond($leagues['data']);
        } else {
            return  $this->respondWithErrors($leagues['message']);
        }  
    }
    /**
     * @Route("/get_teams/{league}", name="get_teams_league", methods="GET")
     */
    public function getAllTeams($league)
    {
        if($league){
            $league = str_replace('+', '%20', $league);
            $teams = $this->CallApi("GET",$this->container->getParameter('apiUrl')."search_all_teams.php?l=".$league);
            if (!$teams['status']) {
                return $this->respondWithErrors($teams['message']);
            }else
                return $this->respond($teams['data']);
        }else return $this->respondNotFound();
        
    }
    /**
     * @Route("/get_players/{teamId}", name="get_players_team", methods="GET")
     */
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