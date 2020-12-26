<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\ClienteRepository;

class ClienteController extends AbstractController
{
    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository) {
        $this->clienteRepository = $clienteRepository;

    }

    /**
     * @Route("/clientes/add", name="addCliente", methods={"POST"})
     */
    public function add(Request $request):JsonResponse {
        $data = json_decode($request->getContent(), true);
        $TX_NOME_CLIENTE = $data['nome_cliente'];
        $TX_EMAIL_CLIENTE = $data['email_cliente'];
        $NB_CPF_CNPJ = $data['cpf_cnpj'];
        $TNB_TELEFONE_CLIENTE = $data['telefone_cliente'];

        if(empty($TX_NOME_CLIENTE) || empty($TX_EMAIL_CLIENTE) || empty($NB_CPF_CNPJ) || empty($TNB_TELEFONE_CLIENTE)) {
            throw new NotFoundHttpException('Parametros Obrigatórios Faltando!');

        }
        $this->clienteRepository->salvarCliente($TX_NOME_CLIENTE,$TX_EMAIL_CLIENTE,$NB_CPF_CNPJ,$TNB_TELEFONE_CLIENTE);

        return $this->json(['status' => 'Cliente salvo com sucesso'], Response::HTTP_CREATED);


    }
    /**
     * @Route("/clientes/{id}", name="getClientById", methods={"GET"})
     */
    public function get($id):JsonResponse
    {
            $cliente = $this->clienteRepository->findOneBy(['id' => $id]);

            $data = [
                'id_cliente' => $cliente->getId(),
                'nome_cliente' => $cliente->getTXNOMECLIENTE(),
                'email_cliente' => $cliente->getTXEMAILCLIENTE(),
                'cpf_cnpj' => $cliente->getNBCPFCNPJ(),
            ];

            return $this->json($data, Response::HTTP_OK);
    }

    /** 
     * @Route("/clientes/", name="getAllClientes", methods={"GET"})
    */
    public function retornaTodos(): JsonResponse {
        $clientes = $this->clienteRepository->findAll();
        $dados = [];

        foreach($clientes as $cliente) {
            $dados[] = [
                'id_cliente' => $cliente->getId(),
                'nome_cliente' => $cliente->getTXNOMECLIENTE(),
                'email_cliente' => $cliente->getTXEMAILCLIENTE(),
                'cpf_cnpj' => $cliente->getNBCPFCNPJ(),
            ];
        }

        return new JsonResponse($dados, Response::HTTP_OK);
    }


    /** 
     * @Route("/clientes/{id}", name="updateCliente", methods={"PUT"})
    */
    public function atualizaCliente($id, Request $request): JsonResponse {
        $cliente = $this->clienteRepository->findOneBy(array('id' => $id));

        $dados = json_decode($request->getContent(), true);

        empty($dados['nome_cliente']) ? true : $cliente->setTXNOMECLIENTE($dados['nome_cliente']);
        empty($dados['email_cliente']) ? true : $cliente->setTXEMAILCLIENTE($dados['email_cliente']);
        empty($dados['cpj_cnpj']) ? true : $cliente->setNBCPFCNPJ($dados['cpf_cnpj']);

        $clienteAtualizado = $this->clienteRepository->atualizaCliente($cliente);

        return new JsonResponse($clienteAtualizado->toArray(), Response::HTTP_OK);

    }

    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ClienteController.php',
        ]);
    }
}
