

<div id="ImportDetailsLeft" style="visibility: hidden; display: none;">  
    <div style="border: none;" id='jqxGridAdapt'></div>
    <div id="windowSearch">
        <div>
            Find Record</div>
        <div style="overflow: hidden;">
            <div>
                Find what:</div>
            <div style='margin-top:5px;'>
                <input id='inputField' type="text" class="jqx-input" style="width: 200px; height: 23px;" />
            </div>
            <div style="margin-top: 7px; clear: both;">
                Look in:</div>
            <div style='margin-top:5px;'>
                <div id='dropdownlist'>
                </div>
            </div>
            <div>
                <input type="button" style='margin-top: 15px; margin-left: 50px; float: left;' value="Find" id="findButton" />
                <input type="button" style='margin-left: 5px; margin-top: 15px; float: left;' value="Clear" id="clearButton" />
            </div>
        </div>
    </div>
    
    <div id="windowLoad">
        <div>Load Import File</div>
        <div style="overflow: hidden;">

            
            <span>Select data from db</span>
            
        </div>
    </div>
</div>

<div id="ImportDetailsRight" style="visibility: hidden; display: none;">
    <form id="Form">
        <table style="margin-top: 20px; width: 90%;">
            
             <tr><td style="text-align:right;">Bestellnummer:</td><td style="text-align:left;"><input type="text" id="ordernumber" /></td></tr>
             <tr><td style="text-align:right;">Bestelldatum:</td><td style="text-align:left;"><input type="text" id="orderdate" /></td></tr>
             <tr><td style="text-align:right;">AnzLT:</td><td style="text-align:left;"><input type="text" id="receiveddaysafter" /></td></tr>
             <tr><td style="text-align:right;">Verk-Email:</td><td style="text-align:left;"><input type="text" id="emailofseller" /></td></tr>
             <tr><td style="text-align:right;">Verk-Vorname:</td><td style="text-align:left;"><input type="text" id="nameofseller" /></td></tr>
             <tr><td style="text-align:right;">Verk-Nachname:</td><td style="text-align:left;"><input type="text" id="secondnameofseller" /></td></tr>
             <tr><td style="text-align:right;">Prod-SKU:</td><td style="text-align:left;"><input type="text" id="product_sku" /></td></tr>
             <tr><td style="text-align:right;">Prod-Name:</td><td style="text-align:left;"><input type="text" id="productname" /></td></tr>
             <tr><td style="text-align:right;">Prod-URL:</td><td style="text-align:left;"><input type="text" id="producturl" /></td></tr>
             <tr><td style="text-align:right;">Prod-GTIN:</td><td style="text-align:left;"><input type="text" id="product_gtin" /></td></tr>
             
             <tr><td></td><td style="padding-top: 5px; padding-right: 20px; text-align: center;"><input value="Save" type="button" id="Save" /></td></tr>
        </table>
    </form>
</div>

