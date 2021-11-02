<div class="mt-3">
    <table>
        <tr>
            <th>Nom du Vin</th>
            <th>Numero SAQ </th>
            <th>Statut Importation</th>



        </tr>
        <?php 
        foreach ($data as $row) {
            //   var_dump($data);

        ?>
            <tr>

                <td><?php echo $row['info']->nom ?></td>
                <td><?php echo $row['info']->desc->code_SAQ ?></td>
                <td><?php echo $row['retour']->raison ?></td>


              
            </tr>

        <?php


        }

        ?>
    </table>
</div>