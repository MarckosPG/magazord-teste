<?php

namespace src\Controller;
       
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use utils\RenderView;
use src\Entity\Pessoa;
use src\Entity\Contato;

class PessoaController extends RenderView {

    public function index() {}

    public function all () {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $entityManager = GetEntityManager();
                $pessoasRepository = $entityManager->getRepository(Pessoa::class);
        
                $pessoas = $pessoasRepository->findAll();

                $data = [];
                foreach ($pessoas as $pessoa) {
                    $data[] = [
                        'id' => $pessoa->getId(),
                        'nome' => $pessoa->getNome(),
                        'cpf' => $pessoa->getCpf(),
                    ];
                }
        
                $response = ['status' => 200, 'message' => 'Todas as pessoas encontradas com sucesso!', 'data' => $data];
        
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
                $pessoasRepository = $entityManager->getRepository(Pessoa::class);
    
                $pessoas = $pessoasRepository->createQueryBuilder('p')
                    ->where('p.nome LIKE :search OR p.cpf = :search')
                    ->setParameter('search', "%$search%")
                    ->getQuery()
                    ->getResult();

                $data = [];
                foreach ($pessoas as $pessoa) {
                    $data[] = [
                        'id' => $pessoa->getId(),
                        'nome' => $pessoa->getNome(),
                        'cpf' => $pessoa->getCpf(),
                    ];
                }
    
                $response = ['status' => 200, 'message' => 'Pessoas encontradas com sucesso!', 'data' => $data];
    
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
                $nome = isset($params['nome']) ? $params['nome'] : null;
                $cpf = isset($params['cpf']) ? $params['cpf'] : null;

                $entityManager = GetEntityManager();

                if ($id) {
                    $pessoa = $entityManager->find(Pessoa::class, $id);
                    if ($pessoa) {
                        $pessoa->setNome($nome);
                        $pessoa->setCpf($cpf);
                    }
                } else {
                    $pessoa = new Pessoa();
                    $pessoa->setNome($nome);
                    $pessoa->setCpf($cpf);
                }

                $entityManager->persist($pessoa);
                $entityManager->flush();

                $response = ['staus' => 200, 'message' => 'Pessoa salva com sucesso!', 'data' => true];

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
                    $pessoa = $entityManager->find(Pessoa::class, $id);
    
                    if ($pessoa) {
                     
                        $contatos = $entityManager->getRepository(Contato::class)->findBy(['pessoa' => $pessoa->getId()]);
    
                        foreach ($contatos as $contato) {
                            $entityManager->remove($contato); 
                        }
    
                        $entityManager->remove($pessoa); 
                        $entityManager->flush(); 
    
                        $response = ['status' => 200, 'message' => 'Pessoa excluída com sucesso!', 'data' => true];
                    } else {
                        $response = ['status' => 400, 'message' => 'Pessoa não encontrada.', 'data' => false];
                    }
    
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit;
                }
            }
        } catch (Exception $ex) {
            $response = ['status' => 400, 'message' => 'Houve um erro interno no servidor!', 'data' => false];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

    }

}