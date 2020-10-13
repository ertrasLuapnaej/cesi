<?php
namespace src\Model;




class Categories {


    private $Id;
    private $libelle;
    private $Icone;
 
    public function SqlAdd(\PDO $bdd){
        try {
            $requete = $bdd->prepare("INSERT INTO categories (libelle, icone) VALUES(:libelle, :icone)");

            $requete->execute([
                "libelle" => $this->getlibelle(),
                "icone" => $this->geticone(),
            ]);
            return $bdd->lastInsertId();
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }


    
    public function Delete($id){
        $categories = new Categories();
        $datas = $categories->SqlDeleteById(BDD::getInstance(),$id);

        header("Location:/Categories/All");
    }

    public function Update($id){
        $categories = new Categories();
        $datas = $categories->SqlGetById(BDD::getInstance(),$id);

        if($_POST){
            $objcategorie = new Categories();
            $objcategorie->setlibelle($_POST["Titre"]);
            $objcategorie->seticone($_POST["Description"]);
            $objcategorie->setId($id);
            //Exécuter la mise à jour
            $objcategorie->SqlUpdate(BDD::getInstance());/*  */
            // Redirection
            header("Location:/Categories/show/$id");
        }else{
            return $this->twig->render("Categories/update.html.twig", [
                "categorieList"=>$datas
            ]);
        }
    }
 /**
     * Récupère tous les categories
     * @param \PDO $bdd
     * @return array
     */
    public function SqlGetAll(\PDO $bdd){
        $requete = $bdd->prepare("SELECT * FROM categories");
        $requete->execute();
        //$datas =  $requete->fetchAll(\PDO::FETCH_ASSOC);
        $datas =  $requete->fetchAll(\PDO::FETCH_CLASS,'src\Model\Categories');
        return $datas;
    }

    public function SqlGet(\PDO $bdd){
        $requete = $bdd->prepare("SELECT * FROM categories");
        $requete->execute();
        //$datas =  $requete->fetchAll(\PDO::FETCH_ASSOC);
        $datas =  $requete->fetchAll(\PDO::FETCH_CLASS,'src\Model\Categories');
        return $datas;
    }

    public function SqlGetById(\PDO $bdd, $Id){
        $requete = $bdd->prepare("SELECT * FROM categories WHERE Id=:Id");
        $requete->execute([
            "Id" => $Id
        ]);
        $requete->setFetchMode(\PDO::FETCH_CLASS,'src\Model\Categories');
        $categorie = $requete->fetch();

        return $categorie;
    }

    public function SqlDeleteById(\PDO $bdd, $Id){
        $requete = $bdd->prepare("DELETE FROM categories WHERE Id=:Id");
        $requete->execute([
            "Id" => $Id
        ]);
        return true;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param mixed $Id
     * @return Categories
     */
    public function setId($Id)
    {
        $this->Id = $Id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getlibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     * @return Categories
     */
    public function setlibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }

    /**
     * @return mixed
     */
    public function geticone()
    {
        return $this->Icone;
    }

    /**
     * @param mixed $Icone
     * @return Categories
     */
    public function seticone($Icone)
    {
        $this->Icone = $Icone;
        return $this;
    }



}
