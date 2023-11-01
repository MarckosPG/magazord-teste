<?php

namespace src\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use utils\RenderView;
use src\Entity\Contato;
use src\Entity\Pessoa;
use utils\Validations;

class ContatoController extends RenderView {

    public function index() {}

    public function all () {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $entityManager = GetEntityManager();
                $contatosRepository = $entityManager->getRepository(Contato::class);
        
                $contatos = $contatosRepository->findAll();

                $data = [];
                foreach ($contatos as $contato) {
                    $data[] = [
                        'id' => $contato->getId(),
                        'tipo' => $contato->getTipo(),
                        'descricao' => $contato->getDescricao(),
                        'idPessoa' => $contato->getPessoa(),
                    ];
                }
        
                $response = ['status' => 200, 'message' => 'Todas os contatos encontrados com sucesso!', 'data' => $data];
        
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }
        } catch (Exception $ex) {
            $response = ['status' => 400, 'message' => 'Houve um erro interno no servidor!', 'data' => false];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }

    public function find () {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $params = @$_POST;
                $search = isset($params['search']) ? $params['search'] : null;
    
                $entityManager = GetEntityManager();
                $contatosRepository = $entityManager->getRepository(Contato::class);
    
                $queryBuilder = $contatosRepository->createQueryBuilder('c');
                $queryBuilder->where('c.descricao LIKE :search');
                $queryBuilder->setParameter('search', "%$search%");
                $queryBuilder->leftJoin('c.pessoa', 'p');

                $contatos = $queryBuilder->getQuery()->getResult();
    
                $data = [];
                foreach ($contatos as $contato) {
                    $data[] = [
                        'id' => $contato->getId(),
                        'tipo' => $contato->getTipo(),
                        'descricao' => $contato->getDescricao(),
                        'idPessoa' => $contato->getPessoa()->getId(),
                        'nome' => $contato->getPessoa()->getNome(),
                    ];
                }

                $response = ['status' => 200, 'message' => 'Contatos encontrados com sucesso!', 'data' => $data];
    
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }
        } catch (Exception $ex) {
            $response = ['status' => 400, 'message' => 'Houve um erro interno no servidor!', 'data' => false];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }

    public function save () {
        try{
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $params = @$_POST;

                $id = isset($params['id']) ? $params['id'] : null;
                $tipo = isset($params['tipo']) ? $params['tipo'] : null;
                $descricao = isset($params['descricao']) ? $params['descricao'] : null;
                $idPessoa = isset($params['vinculo']) ? $params['vinculo'] : null;

                $entityManager = GetEntityManager();

                $pessoa = $entityManager->find(Pessoa::class, $idPessoa);

                switch($tipo){
                    case 0:
                        $phoneValid = Validations::validateCellPhone($descricao);
                        if(!$phoneValid){
                            $response = ['staus' => 400, 'message' => 'Celular inválido!', 'data' => false];
                            header('Content-Type: application/json');
                            echo json_encode($response);
                            exit;
                        }
                        break;
                    case 1:
                        $emailValid = Validations::validateEmail($descricao);
                        if(!$emailValid){
                            $response = ['staus' => 400, 'message' => 'Email inválido!', 'data' => false];
                            header('Content-Type: application/json');
                            echo json_encode($response);
                            exit;
                        }
                        break;
                }

                if($pessoa){
                    if ($id) {
                        $contato = $entityManager->find(Contato::class, $id);
                        if ($contato) {
                            $contato->setTipo($tipo);
                            $contato->setDescricao($descricao);
                            $contato->setPessoa($pessoa);
                        }
                    } else {
                        $contato = new Contato();
                        $contato->setTipo($tipo);
                        $contato->setDescricao($descricao);
                        $contato->setPessoa($pessoa);
                    }

                    $entityManager->persist($contato);
                    $entityManager->flush();

                }else{
                    $response = ['staus' => 400, 'message' => 'Não há nenhuma pessoa com esse ID!', 'data' => false];
                }

                $response = ['staus' => 200, 'message' => 'Contato salvo com sucesso!', 'data' => true];

                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }
        }catch(Exception $ex){
            $response = ['staus' => 400, 'message' => 'Houve um erro interno no servidor!', 'data' => false];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }

    public function delete() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $params = @$_POST;
                $id = isset($params['id']) ? $params['id'] : null;
    
                $entityManager = GetEntityManager();
    
                if ($id) {
                    $contato = $entityManager->find(Contato::class, $id);
    
                    if ($contato) {
                        $entityManager->remove($contato);
                        $entityManager->flush();
                    }
    
                    $response = ['status' => 200, 'message' => 'Contato excluído com sucesso!', 'data' => true];
                } else {
                    $response = ['status' => 400, 'message' => 'ID inválido. A exclusão requer um ID válido.', 'data' => false];
                }
    
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }
        } catch (Exception $ex) {
            $response = ['status' => 400, 'message' => 'Houve um erro interno no servidor!', 'data' => false];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }

}