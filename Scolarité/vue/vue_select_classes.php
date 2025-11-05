<h3> Listes des classses </h3>

 <table border="1">
    <tr>
        <th>Id Classe</th>
        <th>Nom Classe</th>
        <th>Salle de cours</th>
        <th>Diplôme Préparé</th>

        <td> Opérations </td>
    </tr>
    <?php
       if (isset($lesClasses)){
            foreach ($lesClasses as $uneClasse){
                echo "<tr>";
                echo "<td>".$uneClasse['idclasse']."</td>";
                echo "<td>".$uneClasse['nom']."</td>";
                echo "<td>".$uneClasse['salle']."</td>";
                echo "<td>".$uneClasse['diplome']."</td>";
                echo "<td>";
                echo "<a href='index.php?page=2&action=edit&idclasse=".$uneClasse['idclasse']."'><img src='images\modifier.png' width='30' height='30'></a>";

                echo "<a href='index.php?page=2&action=sup&idclasse=".$uneClasse['idclasse']."'><img src='images\supprimer.png' width='25' height='25'></a>";

                echo "</td>";
                echo "</tr>";
            }
       }
    ?>

 </table>