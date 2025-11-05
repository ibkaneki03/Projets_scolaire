<h3> Listes des professeurs </h3>

 <table border="1">
    <tr>
        <th>Id Prof</th>
        <th>Nom du professeur</th>
        <th>Prénom du professeur</th>
        <th>Email</th>
        <th>Diplôme</th>
    </tr>
    <?php
       if (isset($lesProfs)){
            foreach ($lesProfs as $unProf){
                echo "<tr>";
                echo "<td>".$unProf['idprofesseur']."</td>";
                echo "<td>".$unProf['nom']."</td>";
                echo "<td>".$unProf['prenom']."</td>";
                echo "<td>".$unProf['email']."</td>";
                echo "<td>".$unProf['diplome']."</td>";
                echo "</tr>";
            }
       }
    ?>

 </table>