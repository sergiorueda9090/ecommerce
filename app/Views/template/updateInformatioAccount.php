

<div class="form-group">
<label>First Name<sup>*</sup></label>
<div class="form-group__content"><input class="form-control firstnameupdate"  type="text" value="<?php echo $customerInfo->name; ?>"></div>
</div>

<div class="form-group">
<label>Last Name<sup>*</sup></label>
<div class="form-group__content"><input class="form-control lastnameupdate"  type="text" value="<?php echo $customerInfo->lastname; ?>"></div>
</div>

<div class="form-group">
<label>Email Address<sup>*</sup></label>
<div class="form-group__content"><input class="form-control emailupdate"  type="text" value="<?php echo $customerInfo->email; ?>"></div>
</div>

<div class="form-group">

<label>Departamento<sup>*</sup></label>

<div class="form-group__content">

<select name="deparments" class="form-control deparmentsupdate">
    <option value="">Seleccionar</option>

    <?php
        foreach($deparments as $key => $value){

            if($customerInfo->department == $value['idDepartamento']){

                echo '<option value="'.$value['idDepartamento'].'" selected>'.$value['despartamento'].'</option>';
            
            }else{
                echo '<option value="'.$value['idDepartamento'].'">'.$value['despartamento'].'</option>';
           
            }
            
        }
    ?>

</select>

</div>


</div>

<div class="form-group">

    <label>Ciudad<sup>*</sup></label>

    <div class="form-group__content">

        <select name="city" class="form-control cityupdate">

            <option value="">Seleccionar</option>

            <?php
                foreach($cities as $key => $value){

                    if($customerInfo->department == $value['departamento_id']){

                        if($customerInfo->city == $value['id_municipio']){

                            echo '<option value="'.$value['id_municipio'].'" selected>'.$value['municipio'].'</option>';
                        
                        }else{
                       
                            echo '<option value="'.$value['id_municipio'].'">'.$value['municipio'].'</option>';
                       
                        }

                    }

                }
            ?>

        </select>

    </div>

</div>

<div class="form-group">
<label>Phone<sup>*</sup></label>
<div class="form-group__content"><input class="form-control phoneupdate"  type="text" value="<?php echo $customerInfo->phone; ?>"></div>
</div>

<div class="form-group">
<label>Address<sup>*</sup></label>
<div class="form-group__content"><input class="form-control addressupdate"  type="text" value="<?php echo $customerInfo->address; ?>"></div>
</div>

<div class="form-group">
<label>Address Addition information<sup>*</sup></label>
<div class="form-group__content"><textarea class="form-control addaddtioninfoupdate" id="exampleFormControlTextarea1" rows="3"></textarea></div>
</div>

<button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg btnUpdateInfo">Actualizar Informacion</button>