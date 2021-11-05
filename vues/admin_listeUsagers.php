    <div class="mt-3">
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th> Prénom/Nom </th>
                            <th>Email </th>
                            
                            <th>Username</th>
                            <th>Actions</th>

                        </tr>
                        <?php

                        foreach ($listeUsager as $row) {

                        ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><i class="fas fa-user fa-2x" ></i></td>


                                <td><?php echo $row['nom']; $row['prenom'];?></td>
                                <td><?php echo $row['email'];?></td>
                                <td><?php echo $row['username'];?></td>

                                
                                <td class="actions">


                                    <form action="studentForm/showUpdateStudent" method="post" class="nostyle">

                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

                                        <button class="edit  small" name="Update" type="submit"><i class="fas fa-pen fa-xs"></i></button>

                                    </form>

                                    <form action="studentForm/deleteStudent" method="post" class="nostyle">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

                                        <button class="trash  small" name="Delete" type="submit"><i class="fas fa-trash fa-xs"></i></button>
                                    </form>

                                </td>




                            </tr>

                        <?php


                        }

                        ?>
                    </table>
                </div>