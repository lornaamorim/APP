<?php

namespace App\Controller;

use App\Model\Categoria; 
use Exception;


final class CategoriaController extends Controller
{
    public static function index() : variant_mod
    { 
        parent::isProtected();

        $model = new Categoria();

        try {
            $model->getAllRows();
        } catch(Exception $e)
        {
            $model->setError("Ocorreu um erro ao buscar o autor:");
            $model->setError($e->getMessage());
        }

        parent::render('Autor/lista_autor.php', $model);
    }

    public static function autor() : void
    {
        parent::isProtected();

        $model = new Autor();

        try
        {
            if(parent::isPost())
            {
               
                $model->Id = !empty($_POST['id']) ? $_POST['id'] : null; 
                $model->Nome = $_POST['nome'];
                $model->Data_nasc = $_POST['data_nasc'];
                $model->Cpf = $POST['cpf'];
              
                $model->save(); 

             
                parent::redirect("/autor");

            } else {

              
                if(isset($_GET['id']))
                {
                  
                    $model = $model->getById( (int) $_GET['id']);
                }
            }
        } catch(Exception $e) {
            
            $model->setError($e->getMessage());
        }
        
        parent::render('Autor/form_autor.php', $model);

    }
    
        public static function delete() : void
        {
            parent::isProtected();

            $model = new Autor();

            try
            {
                $model->delete( (int) $_GET['id']);
                parent::redirect("/autor");

            } catch(Exception $e) {
                $model->setError("Ocorreu um erro ao excluir o autor:");
                $model->setError($e->getMessage());
            }

            parent::render('Autor/lista_autor.php', $model);
        }
    } 