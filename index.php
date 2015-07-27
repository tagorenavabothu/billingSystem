<?php
	/*
Script Name: Read excel file in php with example
Script URI: http://allitstuff.com/?p=1303
Website URI: http://allitstuff.com/
*/
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.js"></script>
    <style>
    body{
  -webkit-print-color-adjust:exact;
}
        @media print {
.header, .hide { visibility: hidden }
}
    </style>
</head>
<body>
<?php
/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';


$inputFileName = './uploads/sample.xlsx';  // File to read
//echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
//print_r($sheetData);
echo "<table id='tableId' style='display:none;'>";
 foreach($sheetData as $rec)
{
     echo "<tr>";
     foreach($rec as $key => $element) {
        //echo $key . " - " . $element."<br />";
        /* if (strpos($element,'$') !== false) {
                echo "<td>". $element."<input type='text' style='width:40px;'/></td>";
         }else{
         echo "<td>". $element."</td>";
         }*/
         echo "<td>". $element."</td>";
        }
     echo "</tr>";
}
echo "</table>";
 

?>
    
    <div id="maincontent">
        <p>Email To: <br>
            <span id="contact"></span> <br>
            <span id="email"></span>
        </p>
        <hr>
        <p>
          Service Period : <span id="ServicePeriod"></span><br>
             Customer : <span id="Customer"></span><br>
             Invoice type : <span id="Invoicetype"></span><br>
             invoice # : <span id="invoice"></span><br>
             Invoice Period : <span id="InvoicePeriod"></span><br>
             Terms : <span id="Terms"></span><br>
        </p>
        <hr>
     <table width="100%"  style="text-align:center;">
        <tbody id="finaltable">
        </tbody>
    </table>
        <hr>
        <p>
            sub-Total : <span id="subtotal"></span><br>
            Service Fee : <span id="servicefee"></span><br>
            Total : <span id="total"></span><br>
            Invoice Total Due : <span id="invoicetotaldue"></span><br>
            Outstanding Balance : <span id="outstandingbal"></span><br>
            Account Balance : <span id="accbal"></span><br>
        </p>
        <hr>
        <p>
            sub-Total : <span id="subtotalnew"></span><br>
            Service Fee : <span id="servicefeenew"></span><br>
            Shipping Charges : <span id="shippingchargesnew"></span><br>
            Total : <span id="totalnew"></span><br>
            
        </p>
        
    
  <hr>
<input type="button" value="done" onclick="calculate()"/>
    
    <input type="button" value="Save & view" onclick="getDatatableinput()"/>
    <!--<input type="button" value="view" onclick="showprinatblepage()"/>-->
    </div>
    
    <div style="padding:100px;" id="printdivcontent">
        <div class="wrapper">
            <div id="">
                <div style="float:left">
                    
                    logo
                <div>
                  <table style="border-collapse: collapse; border: 1px solid black;width:200px;">
                   <tr><td style=" border: 1px solid black;padding:5px;background-color: #2E9CE3;">Bill To</td></tr>  
                  </table>   
                    <table style="border-collapse: collapse; border: 1px solid black;width:200px;margin-top:5px;">
                   <tr><td style="border: 1px solid black;padding:5px;padding:4px;width:200px;"><span id="gettodetailsname"></span><br><span id="gettodetailsemail"></span><br><span id="gettodetailscustomer"></span></td></tr>  
                  </table> 
                </div>
                </div>
                <div style="float:right">
                    <div>
                      <h3 style="text-align:right;">Invoice</h3>
                    <table style="border-collapse: collapse; border: 1px solid black;text-align:center;">
                        
                            <tr>
                                <td style=" border: 1px solid black;padding:5px;background-color: #2E9CE3;">Date</td>
                                <td style=" border: 1px solid black;padding:5px; background-color: #2E9CE3;">Invoice #</td>
                            </tr>
                            <tr>
                                <td style=" border: 1px solid black;padding:5px;"><span id="getInvoiceDate"></span></td>
                                <td style=" border: 1px solid black;padding:5px;"><span id="getinvoiceID"></span></td>
                            </tr>
                        
                    </table>
                    
                    </div>
                 
                </div>
                <div style="clear:both;"></div>
            </div>
            <div>
                <br><br>
                <div>
            <table style="border-collapse: collapse;  border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;text-align:center;width:200px;float:right">
              <tr>
                <td style=" border: 1px solid black;padding:5px;background-color: #2E9CE3;">Terms</td>
              </tr> 
                <tr>
                    <td style=" border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;padding:5px;">
                        <span id="getTermsText"></span>
                    </td>
                </tr>
            </table>
                    </div>
                <div style="clear:both;"></div>
                <div>
                <table style="border-collapse: collapse; border: 1px solid black;width:100%;">
                  <tr>
                      <td style=" border: 1px solid black;padding:5px;text-align:center;background-color: #2E9CE3;">site location</td>
                      <td style=" border: 1px solid black;padding:5px;text-align:center;background-color: #2E9CE3;">Description</td>
                      <td style=" border: 1px solid black;padding:5px;text-align:center;background-color: #2E9CE3;">Amount</td>
                    </tr>
                    <tbody id="invoicetable">
                       
                    </tbody>
                    <tr>
                        <td style="border: 1px solid black;padding:5px;" colspan="2">Thankyou for your Bussiness.</td>
                        <td style="border: 1px solid black;padding:5px;"><b>Total Due : </b>&nbsp;<span id="getTotalDue"></span></td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>
    <input type="button" onclick="printDiv('printdivcontent')" value="print a div!" />
    <script>
        column0 = new Array();
        column1 = new Array();
        column2 = new Array();
        column3 = new Array();
        column4 = new Array();
        column5 = new Array();
        column6 = new Array();
        column7 = new Array();
        column8 = new Array();
        column9 = new Array();
        column10 = new Array();
        column11 = new Array();
        column12 = new Array();
        column13 = new Array();
        column14 = new Array();
        column15 = new Array();
        column16 = new Array();
        column17 = new Array();
        column18 = new Array();
        column19 = new Array();
        column20 = new Array();
        column21 = new Array();
        column22 = new Array();
        column23 = new Array();
        column24 = new Array();
        column25 = new Array();
        column26 = new Array();
        column27 = new Array();
    
       
        inputdataArray = new Array();
        
        toInputArray = new Array();
        oInputArray = new Array();
        prpaInputArray = new Array();
        amprInputArray = new Array();
        tmaInputArray = new Array();
        serviceInputArray = new Array();
        shippingChargesInputArray = new Array();
        mmaInputArray = new Array();
        mmoInputArray = new Array();
        
        
        
           toInputArray1 = new Array();
        oInputArray1 = new Array();
        prpaInputArray1 = new Array();
        amprInputArray1 = new Array();
        tmaInputArray1 = new Array();
        serviceInputArray1 = new Array();
        shippingChargesInputArray1 = new Array();
        mmaInputArray1 = new Array();
        mmoInputArray1 = new Array();
        
        dataArray = new Array();
        details = new Array();
        
        
        subTotalsArray = new Array();
        subTotalshArray = new Array();
    
$(document).ready(function(){
$('#tableId tbody tr td:nth-child(0)').each( function(){
column0.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(1)').each( function(){
column1.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(2)').each( function(){
column2.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(3)').each( function(){
column3.push($(this).text());
});

        $('#tableId tbody tr td:nth-child(4)').each( function(){
column4.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(5)').each( function(){
column5.push($(this).text());
});
        $('#tableId tbody tr td:nth-child(6)').each( function(){
column6.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(7)').each( function(){
column7.push($(this).text());
});
        $('#tableId tbody tr td:nth-child(8)').each( function(){
column8.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(9)').each( function(){
column9.push($(this).text());
});
        $('#tableId tbody tr td:nth-child(10)').each( function(){
column10.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(11)').each( function(){
column11.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(12)').each( function(){
column12.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(13)').each( function(){
column13.push($(this).text());
});

        $('#tableId tbody tr td:nth-child(14)').each( function(){
column14.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(15)').each( function(){
column15.push($(this).text());
});
        $('#tableId tbody tr td:nth-child(16)').each( function(){
column16.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(17)').each( function(){
column17.push($(this).text());
});
        $('#tableId tbody tr td:nth-child(18)').each( function(){
column18.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(19)').each( function(){
column19.push($(this).text());
});
     $('#tableId tbody tr td:nth-child(20)').each( function(){
column20.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(21)').each( function(){
column21.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(22)').each( function(){
column22.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(23)').each( function(){
column23.push($(this).text());
});

        $('#tableId tbody tr td:nth-child(24)').each( function(){
column24.push($(this).text());
});
        
$('#tableId tbody tr td:nth-child(25)').each( function(){
column25.push($(this).text());
});
 
     
       
       // starting index from where the site charges begin
         startindex = column2.indexOf("Site Name");
        // endiong index where the site charges end
         endindex = column2.indexOf("Subtotal");
        
        var str="";
        for(var i=startindex;i<=endindex;i++){
           //console.log(column0[i]);
            if(i==7){
            str+="<tr><td>"+column2[i]+"</td><td>"+column10[i]+"</td><td>"+column11[i]+"</td><td>"+column12[i]+"</td><td>"+column13[i]+"</td><td>"+column15[i]+"</td><td>"+column16[i]+"</td><td>"+column17[i]+"</td><td>"+column18[i]+"</td><td>Service Fee</td><td>Shipping charges</td><td>"+column19[i]+"</td><td>"+column20[i]+"</td></tr>";
                dataArray.push(column2[i]+","+column10[i]+","+column11[i]+","+column12[i]+","+column13[i]+","+column15[i]+","+column16[i]+","+column17[i]+","+column18[i]+","+column19[i]+",Service Fee,Shipping charges,"+column20[i]);
            }
            if(i>=8){
                if(i!=endindex-1){
                     str+="<tr><td>"+column2[i]+"</td><td>"+column10[i]+"</td><td>"+column11[i]+"</td><td id=to_"+i+">"+column12[i]+"<br><input type='text' style='width:40px' id=to_input"+i+"></td><td id=o_"+i+">"+column13[i]+"<br><input type='text' style='width:40px' id=o_input"+i+"></td><td id=prpa_"+i+">"+column15[i]+"<br><input type='text' style='width:40px' id=prpa_input"+i+"></td><td id=ampr_"+i+">"+column16[i]+"<br><input type='text' style='width:40px' id=ampr_input"+i+"></td><td id=mma_"+i+">"+column17[i]+"<br><input type='text' style='width:40px' id=mma_input"+i+"></td><td id=mmo_"+i+">"+column18[i]+"<br><input type='text' style='width:40px' id=mmo_input"+i+"></td><td><br><input type='text' style='width:40px' id=service_fee"+i+"></td><td><br><input type='text' style='width:40px' id=shipping_charges"+i+"></td><td id=tma_"+i+">"+column19[i]+"<br><input type='text' style='width:40px' id=tma_input"+i+" disabled></td><td>"+column20[i]+"</td></tr>";
                    dataArray.push(column2[i]+","+column10[i]+","+column11[i]+","+column12[i]+","+column13[i]+","+column15[i]+","+column16[i]+","+column17[i]+","+column18[i]+","+column19[i]+",,,"+column20[i]);
                }else{
                str+="<tr><td>"+column2[i]+"</td><td>"+column10[i]+"</td><td>"+column11[i]+"</td><td>"+column12[i]+"</td><td>"+column13[i]+"</td><td>"+column15[i]+"</td><td>"+column16[i]+"</td><td>"+column17[i]+"</td><td>"+column18[i]+"</td><td></td><td></td><td>"+column19[i]+"</td><td>"+column20[i]+"</td></tr>";
                    dataArray.push(column2[i]+","+column10[i]+","+column11[i]+","+column12[i]+","+column13[i]+","+column15[i]+","+column16[i]+","+column17[i]+","+column18[i]+","+column19[i]+",,,"+column20[i]);
                }
          
            }
            
        }
        
       
        $("#finaltable").html(str);        
        
       
        $("#contact").text(column12[2]);
        details['Contact'] = column12[2];
        
       
         $("#email").text(column12[3]);
        details['Email'] = column12[3];
        
       
         $("#ServicePeriod").text(column18[1]);
        details['Service Period'] = column18[1];
        
     
        $("#Customer").text(column18[2]);
        details['Customer'] = column18[2];
        
       
        $("#Invoicetype").text(column18[3]);
        details['Invoice type'] = column18[3];
        
      
        $("#invoice").text(column18[4]);
        details['invoice#'] = column18[4];
        
      
        $("#InvoicePeriod").text(column18[5]);
        details['Invoice Period'] = column18[5];
        
        
         $("#Terms").text(column18[6]);
        details['Terms'] = column18[6];
        
        
        
         $("#subtotal").text(column19[endindex+4]);
        details['sub-Total'] = column19[endindex+4];
        
       
         $("#servicefee").text(column19[endindex+5]);
        details['Service Fee'] =column19[endindex+5];
        
       
         $("#total").text(column19[endindex+6]);
        details['Total'] = column19[endindex+6];
        
        
         $("#invoicetotaldue").text(column19[endindex+7]);
        details['Invoice Total Due'] = column19[endindex+7];
        
     
         $("#outstandingbal").text(column19[endindex+8]);
        details['Outstanding Balance'] = column19[endindex+8];
        
       
         $("#accbal").text(column19[endindex+9]);
        details['Account Balance'] = column19[endindex+9];

    });
        
        function calculate(){   
            
             toInputArray = []
        oInputArray = [];
        prpaInputArray = [];
        amprInputArray = [];
        tmaInputArray = [];
        serviceInputArray = [];
            shippingChargesInputArray = [];
        mmaInputArray = [];
        mmoInputArray = [];
            
             toInputArray1 = []
        oInputArray1 = [];
        prpaInputArray1 = [];
        amprInputArray1 = [];
        tmaInputArray1 = [];
        serviceInputArray1 = [];
            shippingChargesInputArray1 = [];
        mmaInputArray1 = [];
        mmoInputArray1 = [];
            
            to_inputresult = looperresult("to_input");
            o_inputresult = looperresult("o_input");
            prpa_inputresult = looperresult("prpa_input");
            ampr_inputresult = looperresult("ampr_input");
            mma_inputresult = looperresult("mma_input");
            mmo_inputresult = looperresult("mmo_input");
            tma_inputresult = looperresult("tma_input");
            service_feeresult = looperresult("service_fee");
            shipping_chargesresult = looperresult("shipping_charges");
            
             subTotalsArray = [];
            for(var i=8;i<=endindex;i++){
               
                var obtainedvalue = calculateIndividual_subtotal(i);
                subTotalsArray.push(obtainedvalue);
               $("#tma_input"+i).val(obtainedvalue);
                 $("#tma_input"+i).prop('disabled','true');
                if(i==endindex){
                //alert(obtainedvalue);
                    $("#totalnew").text(obtainedvalue);
                    $("#servicefeenew").text(service_feeresult);
                    $("#shippingchargesnew").text(shipping_chargesresult);
                   
                    $("#subtotalnew").text((parseFloat(obtainedvalue))-(parseFloat(service_feeresult)+parseFloat(shipping_chargesresult)));
                }
                
            }
             
            //console.log("Global sub total : "+global_subtotal);
        }
        
       function looperresult(id){
         var count=0;
           var rowcount = 0;
            for(var i=startindex+1;i<endindex-1;i++){
                //to elemnate the $value; 
                tdtext = $("#"+id+i).parent().text();
                tdtext = tdtext.trim();
                //final value without $ use this to add.
                
                if(tdtext!=""){
                    var res = tdtext.split("$");
                    textvalue=parseFloat(res[1]);
                   // console.log(textvalue);
                }else{
                    textvalue = 0;
                }
                
            
                inputval =parseFloat($("#"+id+i).val());
                if($("#"+id+i).val()==""){
                   inputval = 0;
                }
                
                     populateArrays(id,inputval);

                     populateArraysvalue(id,parseFloat(textvalue+inputval).toFixed(2));
                //inputdataArray[id] = inputval;
                //console.log("this is the row count : "+i);
               
                count+=parseFloat(textvalue+inputval);
            }
            $("#"+id+endindex).val(count);
           $("#"+id+endindex).prop('disabled', true);
           subTotalshArray[id+endindex] = count;
           return count;
        }
        
        
        //to populate Arrays with the given values in the input boxes.
        function populateArrays(id,value){
            if(id=="to_input"){
                toInputArray.push(value);
            }
            if(id=="o_input"){
                 oInputArray.push(value);
            }
            if(id=="prpa_input"){
                 prpaInputArray.push(value);
            }
            if(id=="ampr_input"){
                 amprInputArray.push(value);
            }
            if(id=="mma_input"){
                 mmaInputArray.push(value);
            }
            if(id=="mmo_input"){
                 mmoInputArray.push(value);
            }
            if(id=="tma_input"){
                 tmaInputArray.push(value);
            }
            if(id=="service_fee"){
                 serviceInputArray.push(value);
            }
            if(id=="shipping_charges"){
                shippingChargesInputArray.push(value);
            }
        }
        
        function populateArraysvalue(id,value){
            //alert(id+" , "+value);
            if(id=="to_input"){
                toInputArray1.push(value);
            }
            if(id=="o_input"){
                 oInputArray1.push(value);
            }
            if(id=="prpa_input"){
                 prpaInputArray1.push(value);
            }
            if(id=="ampr_input"){
                 amprInputArray1.push(value);
            }
            if(id=="mma_input"){
                 mmaInputArray1.push(value);
            }
            if(id=="mmo_input"){
                 mmoInputArray1.push(value);
            }
            if(id=="tma_input"){
                 tmaInputArray1.push(value);
            }
            if(id=="service_fee"){
                 serviceInputArray1.push(value);
            }
            if(id=="shipping_charges"){
                shippingChargesInputArray1.push(value);
            }
        }
        
        
        //to calculate the sub-total row wise.
        function calculateIndividual_subtotal(rowid){
            var rowinput1 = parseFloat($("#to_input"+rowid).val());
            
            if(isNaN(rowinput1) || rowinput1==""){
               rowinput1 = 0; 
            }
            
            var rowinput2 = parseFloat($("#o_input"+rowid).val());
            
            if(isNaN(rowinput2) || rowinput2==""){
               rowinput2 = 0; 
            }
           
            var rowinput3 = parseFloat($("#prpa_input"+rowid).val());
            
            
            if(isNaN(rowinput3) || rowinput3==""){
             
               rowinput3 = 0; 
            }
           
            var rowinput4 = parseFloat($("#ampr_input"+rowid).val());
            
            if(isNaN(rowinput4) || rowinput4==""){
             
               rowinput4 = 0; 
            }
            
            var rowinput5 = parseFloat($("#mma_input"+rowid).val());
           
            if(isNaN(rowinput5) || rowinput5==""){
               rowinput5 = 0; 
            
           
            }
            var rowinput6 = parseFloat($("#mmo_input"+rowid).val());
            
            if(isNaN(rowinput6) || rowinput6==""){
               rowinput6 = 0; 
            }
            
            var rowinput7 = parseFloat($("#service_fee"+rowid).val());
            
            if(isNaN(rowinput7) || rowinput7==""){
               rowinput7 = 0; 
            }
            
            
            var rowinput8 = parseFloat($("#shipping_charges"+rowid).val());
            
            if(isNaN(rowinput8) || rowinput8==""){
               rowinput8 = 0; 
            }
            
          
           
            
            var result = eval(rowinput1+rowinput2+rowinput3+rowinput4+rowinput5+rowinput6+rowinput7+rowinput8);
          
            
            return result;
        }
        
        
        
        
       // final data to submit to database.
        function getDatatableinput(){
         // console.log("^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^");
           // console.log(toInputArray);
            inputdataArray['TotalOverage']=toInputArray;
            inputdataArray['Overage']=oInputArray;
            inputdataArray['ProratedPlanAmt']=prpaInputArray;
            inputdataArray['MonthlyPlanRate']=amprInputArray;
            inputdataArray['MonthlyMaint']=mmaInputArray;
            inputdataArray['MonthlyMonitor']=mmoInputArray;
            inputdataArray['TotalMonthlyAmount']=tmaInputArray;
            inputdataArray['ServiceFee']=serviceInputArray;
            inputdataArray['ShippingCharges']=shippingChargesInputArray;
            
             inputdataArray['TotalOverage1']=toInputArray1;
            inputdataArray['Overage1']=oInputArray1;
            inputdataArray['ProratedPlanAmt1']=prpaInputArray1;
            inputdataArray['MonthlyPlanRate1']=amprInputArray1;
            inputdataArray['MonthlyMaint1']=mmaInputArray1;
            inputdataArray['MonthlyMonitor1']=mmoInputArray1;
            inputdataArray['TotalMonthlyAmount1']=tmaInputArray1;
            inputdataArray['ServiceFee1']=serviceInputArray1;
            inputdataArray['ShippingCharges1']=shippingChargesInputArray1;
            
           // console.log("%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%");
          // console.log(inputdataArray);
          //  console.log(details);
          //  console.log(subTotalsArray);
          //  console.log(subTotalshArray);
          //  console.log(dataArray);
            showprinatblepage();
        }
        
        function showprinatblepage(){
            
            
            $("#getinvoiceID").text($("#invoice").text());
            $("#getInvoiceDate").text($("#InvoicePeriod").text());
            $("#getTermsText").text($("#Terms").text());
            
            $("#getTotalDue").text($("#totalnew").text());
            $("#gettodetailsname").text($("#contact").text()+",");
            $("#gettodetailsemail").text($("#email").text()+",");
            $("#gettodetailscustomer").text($("#Customer").text());
            
            console.log(inputdataArray);
            console.log(dataArray[1]);
            var innerhtml = '';
             var totalcount = 0;
            /* for(var i=1;i<dataArray.length-2;i++){
                    var str = dataArray[i].split(",");
                    console.log(str[0]);
                innerhtml+="<tr><td>"+str[0]+"</td>";
                //<td></td><td></td></tr>";
                
                //console.log(inputdataArray['TotalOverage'].length);
               
            }*/
            
             for(var k=0;k<inputdataArray['TotalOverage'].length;k++){
                        innerhtml+="<tr><td style='border: 1px solid black;padding:5px;'>"+column2[k+8]+"</td><td style='border: 1px solid black;padding:5px;'>Monthly monitor & maintainance<br>Monthly Plan Rate<br>Prorated Plan Amount <br>service fee<br>Shipping charges<br><span style='font-weight:bold;'>Total Monthly amount</span><br></td><td style='border: 1px solid black;padding:5px;'>"+eval(parseFloat(inputdataArray['MonthlyMaint1'][k])+parseFloat(inputdataArray['MonthlyMonitor1'][k]))+"<br>"+inputdataArray['MonthlyPlanRate1'][k]+"<br>"+inputdataArray['ProratedPlanAmt1'][k]+"<br>"+inputdataArray['ServiceFee1'][k]+"<br>"+inputdataArray['ShippingCharges1'][k]+"<br><span style='font-weight:bold;'>"+inputdataArray['TotalMonthlyAmount1'][k]+"</span></td></tr>";          console.log("_________________________________________________________");
                        console.log("Monthly monitor & Monthly maintain :"+parseFloat(inputdataArray['MonthlyMaint1'][k])+parseFloat(inputdataArray['MonthlyMonitor1'][k]));
                        console.log("Prorated Plan Amount : "+inputdataArray['ProratedPlanAmt1'][k]);
                        console.log("service fee : "+inputdataArray['ServiceFee1'][k]);
                        console.log("Shipping charges : "+inputdataArray['ShippingCharges1'][k]);
                        console.log("Total Monthly amount : "+inputdataArray['TotalMonthlyAmount1'][k]);
                }
            
            
            $("#invoicetable").html(innerhtml);
            
        }
        
        
        function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
                  //  document.getElementById('header').style.display = 'none';
                 // document.getElementById('footer').style.display = 'none';
     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
        
    </script>
    </body>
</html>