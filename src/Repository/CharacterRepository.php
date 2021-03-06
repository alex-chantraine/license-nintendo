<?php

namespace App\Repository;

use App\Entity\Character;
use App\Entity\Game;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Search\Character as SearchCharacter;

class CharacterRepository extends AbstractEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Character::class);
    }

    /**
     * Undocumented function
     *
     * @param SearchCharacter $search
     * @return Query
     */
    public function findBySearchCriterias(SearchCharacter $search){
        $query = $this
            ->createQueryBuilder('C')
            ->addOrderBy('C.name', 'ASC')
        ;

        if($name = $search->getName()){
            $query
                ->andWhere('C.name LIKE :name')
                ->setParameter('name', '%' . $name . '%')
            ;
        }

        if($gender = $search->getGender()){
            $query
                ->andWhere('C.gender = :gender')
                ->setParameter('gender', $gender)
            ;
        }

        if($game = $search->getGame()){
            $query
                ->join('C.gameCharacters', 'GC')
                ->andWhere('GC.game = :game')
                ->setParameter('game', $game)
            ;
        }

        return $query->getQuery();
    }
}
