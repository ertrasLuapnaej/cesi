<?php

namespace src\Controller;


use src\Model\Categories;
use src\Model\BDD;

class CategoriesController extends  AbstractController {
  
  
    public function Add(){
        if($_POST){
            $objCategorie = new Categories();
            $objCategorie->setLibelle($_POST["libelle"]);
            $objCategorie->seticone($_POST["icone"]);
            //Exécuter l'insertion
            $id = $objCategorie->SqlAdd(BDD::getInstance());
            // Redirection
            header("Location:/Categories/show/$id");
        }else{
            return $this->twig->render("Categories/add.html.twig");

        }


    }
    public function All(){
        $categorie = new Categories();
        $datas = $categorie->SqlGetAll(BDD::getInstance());

        $categorie = new Categories();
        $data = $categorie->SqlGetAll(BDD::getInstance());
        var_dump($data);
        return $this->twig->render("Categories/all.html.twig", [
            "categorieList"=>$datas
        ]);
    }
    public function Show($id){
        $categories = new Categories();
        $datas = $categories->SqlGetById(BDD::getInstance(),$id);

        return $this->twig->render("Categories/show.html.twig", [
            "categories"=>$datas
        ]);
    }
    public function Update($id){
        $categories = new Categories();
        $datas = $categories->SqlGetById(BDD::getInstance(),$id);

        if($_POST){
            $objCategorie = new Categories();
            $objCategorie->setLibelle($_POST["libelle"]);
            $objCategorie->seticone($_POST["icone"]);
            $objCategorie->setId($id);
            //Exécuter la mise à jour
            $id = $objCategorie->SqlAdd(BDD::getInstance());
            // Redirection
            header("Location:/categories/show/$id");
        }else{
            return $this->twig->render("Categories/update.html.twig", [
                "categories"=>$datas
            ]);
        }

    }
    
    public function Delete($id){
        $categories = new Categories();
        $datas = $categories->SqlDeleteById(BDD::getInstance(),$id);

        header("Location:/Categories/All");
    }
    
    public function AllCategories(){
        $categories = new Categories();
        $datas = $categories->SqlGet(BDD::getInstance());

        return $this->$datas ;
    }



}
