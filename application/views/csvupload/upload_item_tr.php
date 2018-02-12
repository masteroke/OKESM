

<!-- $csv_columns -- Eingelesenen Spaltenüberschriften aus der CSV Datei-->
           
<tr> 
<th valign="top"><?php echo $I1;?>:</th><td>
    <select name="<?php echo $N1;?>">
        <?php foreach($csv_columns as $row){ ?>
            <option <?php if(strtoupper($N1) == strtoupper($row) || strtoupper($S1) == strtoupper($row)){echo("selected");}?> value="<?php echo $row; ?>"><?php echo $row; ?></option><?php } ?>
    </select></td><td width="10px;"></td>
<th valign="top"><?php echo $I2;?>:</th><td>
    <select name="<?php echo $N2;?>">
        <?php foreach($csv_columns as $row){ ?>
            <option <?php if(strtoupper($N2) == strtoupper($row) || strtoupper($S2) == strtoupper($row)){echo("selected");}?> value="<?php echo $row; ?>"><?php echo $row; ?></option><?php } ?>
    </select></td><td width="10px;"></td>
</tr>