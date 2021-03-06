<?php

namespace App\Service;

use Doctrine\ORM\Query;
use App\Entity\AbstractEntity;
use App\Entity\Search\AbstractSearch;
use App\Repository\AbstractEntityRepository;

abstract class AbstractEntityService{

    /**
     * @var AbstractEntityRepository
     */
    protected $repository;

    /**
     * Insert or update entity in database
     *
     * @param AbstractEntity $entity
     * @param boolean $exist
     * @return void
     */
    public function saveEntity(AbstractEntity $entity, bool $exist)
    {
        if($exist){
            $this->repository->updateEntity($entity);
        }else{
            $this->repository->createEntity($entity);
        }
        return;
    }

    /**
     * Remove enetity in database
     *
     * @param AbstractEntity $entity
     * @return void
     */
    public function removeEntity(AbstractEntity $entity)
    {
        $this->repository->removeEntity($entity);
        return;
    }

    /**
     * Finds all entities in the repository.
     *
     * @param array $sortOptions
     * @return AbstractEntity[]
     */
    public function findAll(array $sortOptions = [])
    {
        return $this->repository->findBy([], $sortOptions);
    }

    /**
     * Finds entities by criterias in the repository.
     *
     * @param array $criterias
     * @param array $sortOptions
     * @return AbstractEntity[]
     */
    public function findBy(array $criterias = [], array $sortOptions = [])
    {
        return $this->repository->findBy($criterias, $sortOptions);
    }

    /**
     * Finds one entity by criterias in the repository.
     *
     * @param array $criterias
     * @param array $sortOptions
     * @return AbstractEntity
     */
    public function findOneBy(array $criterias = [], array $sortOptions = [])
    {
        return $this->repository->findOneBy($criterias, $sortOptions);
    }

    /**
     * Find entities by criterias
     *
     * @param AbstractSearch $search
     * @return Query
     */
    public function findBySearchCriterias(AbstractSearch $search){
        return $this->repository->findBySearchCriterias($search);
    }

    /**
     * Return query without parameters
     * @return Query
     */
    public function getPaginateElements(){
        return $this->repository->getQueryForPagination();
    }
}