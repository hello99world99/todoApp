<?php
class Base{
    public $db;
    function __construct(){
        try{
            $this->db = new PDO("mysql:host=localhost;dbname=projetTodo", "root", "");
        }catch(PDOException $e){
            echo "Voici le chemin d'erreur : ", $e->getMessage();
        }

        if (isset($_GET["supression"])){
            $this->suprimerTodo($_GET["supression"]);
        }else if (isset($_GET["statut"])){
            $this->modifierTodo($_GET["statut"], $_GET["etat"]);
        }else if (isset($_GET["ajoutTodo"])){
            $this->ajoutTodo($_GET["ajoutTodo"], $_GET["ajoutStatut"]);
        }
    }

    function afficherTodo(){
        $requete = $this->db->prepare("SELECT * FROM todo");
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function suprimerTodo($id){
        $requete = $this->db->prepare("DELETE FROM Todo WHERE id_todo=:id");
        $requete->bindParam(":id", $id);
        $requete->execute();
        header("Location: index.php");
    }

    function modifierTodo($id, $etat){
        $requete = $this->db->prepare("UPDATE Todo SET statut=:etat WHERE id_todo=:id");
        $requete->bindParam(":id", $id);
        $requete->bindParam(":etat", $etat);
        $requete->execute();
        header("Location: index.php");
    }

    function ajoutTodo($nom, $statut){
        $requete = $this->db->prepare("INSERT INTO Todo VALUES(NULL, :nom, :statut)");
        $requete->bindParam(":nom", $nom);
        $requete->bindParam(":statut", $statut);
        $requete->execute();
        header("Location: index.php");
    }
}

$connecteur = new Base();
?>