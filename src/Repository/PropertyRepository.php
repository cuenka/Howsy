<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    /**
     * PropertyRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * Return all properties as array so it is easier to display
     * @return array
     */
    public function findAllPropertiesAsArray()
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getArrayResult();

    }

    /**
     * @return Property[] Returns an array of Property objects
     */
    public function findBySearch(array $parameters)
    {
        $qb = $this->createQueryBuilder('p');
        foreach ($parameters as $key => $parameter) {
            if ($key == 'addressline1') {
                $qb->andWhere('p.addressLine1 LIKE :addressLine1')
                    ->setParameter('addressLine1', "%".$parameter."%");
            }
            if ($key == 'city') {
                $qb->andWhere('p.city LIKE :city')
                    ->setParameter('city', "%".$parameter."%");
            }
            if ($key == 'postcode') {
                $qb->andWhere('p.postcode LIKE :postcode')
                    ->setParameter('postcode', "%".$parameter."%");
            }
        }
        return $qb->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return Property[] Returns an array of Property objects
     */
    public function findByNameField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $value
     * @return Property|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByName($value): ?Property
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();

    }

}
