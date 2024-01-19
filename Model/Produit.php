<?php
require_once "ModeleAbstrait.php";
Class Produit extends ModeleAbstrait {
    public function readAll(){
        $sql = "SELECT * FROM produits";
        return mysqli_query($this->connection, $sql)->fetch_all();
    }
    public function readOne($id){
        $sql = "SELECT * FROM produits WHERE idproduit = $id";
        return mysqli_query($this->connection, $sql)->fetch_assoc();
    }

    public function GetCategories($id){
        $sql = "SELECT nom_categorie FROM categorie WHERE idcategorie = ".$id;
        return mysqli_query($this->connection, $sql)->fetch_assoc();
    }

    public function print($data){
        $result = "";
       foreach ($data as $key => $value) {
        $result .= "
                <tr>
                    <td>" . $value[1] . "</td>
                    <td>" . $this->GetCategories($value[2])["nom_categorie"] . "</td>
                    <td>" . $value[3] . "</td>
                    <td>" . $value[4] . "</td>
                    <td>" . $value[5] . "</td>
                    <td><a href='./Produits.php?action=modifier&id=" . $value[0] . "'>Modifier</a></td>
                    <td><a href='./Produits.php?action=supprimer&id=" . $value[0] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer " . $value[1] . " ?\");'>Supprimer</a></td>
                </tr>";
    
       }
       return $result;
    }

    public function DeleteProduit($id){
        if($id >= 0 ){
            $Id = mysqli_real_escape_string($this->connection, $id);
            $sql = "DELETE FROM produits WHERE idproduit   = $Id";
            mysqli_query($this->connection, $sql);
            header( "Location:  ./Produits.php");
        }
    }

}
