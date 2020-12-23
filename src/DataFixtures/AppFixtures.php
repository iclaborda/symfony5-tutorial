<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Cliente;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();
        $tipoPessoa = null;
        $faker->addProvider(new \JansenFelipe\FakerBR\FakerBR($faker));

        for ($i = 0; $i < 50; $i++) {
            $cliente = new Cliente();
            $cliente->setTXNOMECLIENTE(($tipoPessoa ?: $tipoPessoa = rand(0, 1)) ? $faker->company : $faker->name());
            $cliente->setTXEMAILCLIENTE($tipoPessoa ? $faker->companyEmail : $faker->email);
            $cliente->setTNBTELEFONECLIENTE($faker->phoneNumber);
            $cliente->setNBCPFCNPJ($tipoPessoa ? $faker->cnpj : $faker->cpf);
            $manager->persist($cliente);
        }
        $manager->flush();
    }
}
