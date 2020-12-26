<?php

namespace App\Repository;

use App\Entity\Cliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Cliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cliente[]    findAll()
 * @method Cliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClienteRepository extends ServiceEntityRepository
{
    private $manager;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Cliente::class);
        $this->manager = $manager;
    }

    public function salvarCliente($nomeCliente, $emailCliente, $cpfCnpj, $telefoneCliente) {
        $cliente = new Cliente();
        $cliente
            ->setTXNOMECLIENTE($nomeCliente)
            ->setTXEMAILCLIENTE($emailCliente)
            ->setNBCPFCNPJ($cpfCnpj)
            ->setTNBTELEFONECLIENTE($telefoneCliente);

        $this->manager->persist($cliente);
        $this->manager->flush();
    }

    // /**
    //  * @return Cliente[] Returns an array of Cliente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cliente
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
    $persister = $this->_em->getUnitOfWork()->getEntityPersister($this->_entityName);

    return $persister->load($criteria, null, null, [], null, 1, $orderBy);
    }

    public function atualizaCliente(Cliente $cliente): Cliente {
        $this->manager->persist($cliente);
        $this->manager->flush();

        return $cliente;
    }
}
