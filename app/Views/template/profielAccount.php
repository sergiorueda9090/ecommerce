

<div class="form-group">
<label>First Name<sup>*</sup></label>
<div class="form-group__content"><input class="form-control" readonly type="text" value="<?php echo $customerInfo->name; ?>"></div>
</div>

<div class="form-group">
<label>Last Name<sup>*</sup></label>
<div class="form-group__content"><input class="form-control" readonly type="text" value="<?php echo $customerInfo->lastname; ?>"></div>
</div>

<div class="form-group">
<label>Email Address<sup>*</sup></label>
<div class="form-group__content"><input class="form-control" readonly type="text" value="<?php echo $customerInfo->email; ?>"></div>
</div>

<div class="form-group disabled">

<label>Departamento<sup>*</sup></label>

    <div class="form-group__content disabled">

        <select name="deparments" class="form-control deparmentsprofield disabled" readonly id="deparmentsprofield">
            <?php
                foreach($deparments as $key => $value){
                    
                    if($customerInfo->department == $value['idDepartamento']){
                        echo '<option class="disabled" value="'.$value['idDepartamento'].'" selected>'.$value['despartamento'].'</option>';
                    }
                    
                }
            ?>
        </select>

    </div>


</div>

<div class="form-group disabled">

    <label>Ciudad<sup>*</sup></label>

    <div class="form-group__content disabled">

        <select name="city" class="form-control city disabled" readonly>
            <?php echo '<option value="'.$customerInfo->id_municipio.'" selected>'.$customerInfo->municipio.'</option>'; ?>
        </select>

    </div>

</div>

<div class="form-group">
<label>Phone<sup>*</sup></label>
<div class="form-group__content"><input class="form-control" readonly type="text" value="<?php echo $customerInfo->phone; ?>"></div>
</div>

<div class="form-group">
<label>Address<sup>*</sup></label>
<div class="form-group__content"><input class="form-control" readonly type="text" value="<?php echo $customerInfo->address; ?>"></div>
</div>

<div class="form-group">
<label> Address Addition information<sup>*</sup></label>
<div class="form-group__content"><textarea class="form-control" id="exampleFormControlTextarea1" rows="3" readonly></textarea></div>
</div>

