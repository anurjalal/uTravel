<?php
session_start(); // Use session variable on this page. This function must put on the top of page.
if(!isset($_SESSION['LOGIN_NAME']) || $_SESSION['ID_GROUP'] !='Administrator'){ // if session variable "username" does not exist.
header("location:index.php?msg=Please%20login%20to%20access%20admin%20area%20!"); // Re-direct to index.php
}
else
{
	include_once "db.php"; 
	error_reporting (E_ALL ^ E_NOTICE);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Sistem Informasi Sinar Rodamas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META Http-Equiv="Cache-Control" Content="no-cache">
<META Http-Equiv="Pragma" Content="no-cache">
<META Http-Equiv="Expires" Content="0">
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />
<script src="js/jquery.min.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="jquery.date_input.js"></script>
<link rel="stylesheet" href="date_input.css" type="text/css">
				<script type="text/javascript">$(function() {
				$(".datefield").date_input();
				$(".due").date_input();
				});</script>--> 
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"tanggalnota",
			dateFormat:"%d-%m-%Y"
		});
		new JsDatePick({
			useMode:2,
			target:"jt1",
			dateFormat:"%d-%m-%Y"
		});
		new JsDatePick({
			useMode:2,
			target:"jt2",
			dateFormat:"%d-%m-%Y"
		});
		new JsDatePick({
			useMode:2,
			target:"jt3",
			dateFormat:"%d-%m-%Y"
		});
		new JsDatePick({
			useMode:2,
			target:"jt4",
			dateFormat:"%d-%m-%Y"
		});
		new JsDatePick({
			useMode:2,
			target:"jt5",
			dateFormat:"%d-%m-%Y"
		});
		new JsDatePick({
			useMode:2,
			target:"jt6",
			dateFormat:"%d-%m-%Y"
		});
		new JsDatePick({
			useMode:2,
			target:"tgl_lahir",
			dateFormat:"%d-%m-%Y"
		});
	};
</script>
<script type='text/javascript' src='lib/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='lib/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='lib/thickbox-compressed.js'></script>


<script type='text/javascript' src='localdata.js'></script>
<!--
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<link rel="stylesheet" type="text/css" href="lib/thickbox.css" />
<script type='text/javascript' src='jquery.autocomplete.js'></script>	
<script type="text/javascript">
$().ready(function() {

	function log(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}
	
	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}*/
	
	$("#customer").autocomplete("customer.php", {
		selectFirst: true
	});
	
});


</script>
-->

		<script src="js/jquery.validationEngine-en.js" type="text/javascript"></script>
		<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
		<!--<script src="js/jquery.hotkeys-0.7.9.js"></script>-->
		<!-- AJAX SUCCESS TEST FONCTION	
			<script>function callSuccessFunction(){alert("success executed")}
					function callFailFunction(){alert("fail executed")}
			</script>
		-->
		
		<script>	
		
		function callAutoComplete(idname)
	{
	
	/*$("#"+idname).autocomplete("stock.php", {
		width: 160,
		autoFill: true,
		mustMatch: true,
		selectFirst: false
	});*/
	
	}
	
	
	function checkDuplicateName()
	{	var k=0;
				for (i=0;i<=400;i=i+5)
					{
					if($("#0"+i).length>0)
					{		$k=0;
							 for (j=0;j<=400;j=j+5)
							{
							if($("#0"+j).length>0 && $("#0"+i).val()==$("#0"+j).val())
							{
							 $k++;
							 
							}
							}
						if($k>1)
					{
					alert("Duplicate stock Entry. please remove new and add stock in existing one !");
					
					}
				 	 
					}
					}
					
					
					
					
					
	}

	function callAutoAsignValue(idname)
	{
			
			 var name1 = parseInt(idname,10);
			 
			var quantity1 = name1+1;
			
			 var rate1 =  quantity1+1;
			 var avail1 = rate1+1;
			 var total1 = avail1+1;
			
			 if(parseInt(idname)>0)
			 {
			 quantity1="00"+quantity1;
			 rate1="000"+rate1;
			 avail1="0000"+avail1;
			 total1="00000"+total1;
			 
			 }
			 else
			 {
			  quantity1="00";
			  rate1="000";
			  avail1="0000";
			  total1="00000";
			  
			 }
			 
				 $.post('check_sales_details.php', {stock_name: $("#"+idname).val() },
				function(data){
								
								$("#"+rate1).val(data.rate);
								$("#"+avail1).val(data.availstock);
								$("#"+quantity1).focus();
							}, 'json');
							
						checkDuplicateName();	
							
	}
	function callQKeyUp(Qidname)
	{		
			 
			 var quantity = parseInt(Qidname,10);
			 var rate =  quantity+1;
			 var avail = rate+1;
			 var total = avail+1;
			 var rowcount = parseInt((total+1)/5);
			 if(rowcount==0)
			 rowcount=1;
			
			 if(parseInt(Qidname)>0)
			 {
			 quantity="00"+quantity;
			 rate="000"+rate;
			 avail="0000"+avail;
			 total="00000"+total
			 }
			 else
			 {
			  quantity="00";
			  rate="000";
			  avail="0000";
			  total="00000";
			  
			  
			 }
			var result= parseFloat($("#"+quantity).val()) * parseFloat( $("#"+rate).val() );
			result=result.toFixed(2);
			$("#"+total).val(result);
			if(parseFloat($("#"+quantity).val()) > parseFloat($("#"+avail).val()))
			$("#"+quantity).val(parseFloat($("#"+avail).val()));
			var result= parseFloat($("#"+rate).val())
			result=result.toFixed(2);
			$("#"+total).val(result);
			
			updateSubtotal();
			
	}
	function hitungKekurangan()
	{		if(parseFloat($("#uangmuka").val()) > parseFloat($("#totalsetelahdiskon").val()))
			$("#uangmuka").val(parseFloat($("#totalsetelahdiskon").val()));
			
			var result= parseFloat($("#totalsetelahdiskon").val()) - parseFloat( $("#uangmuka").val() );
			result=result.toFixed(2);
			$("#kekurangan").val(result);
			
	}
	
	function cekDuplikat(cekrangka)
	{		
			var counter = $('.duplikat').length;
			var counter2 = counter - 1;
			if (counter2>0)
			{
			var norangka = 'norangka'+counter2;
		    var norangkavalue = document.salesform.getElementsByClassName(norangka)[0].getAttribute("value");;
			if (norangkavalue==cekrangka)
			{
			alert("No Rangka atau No Mesin yang dipilih sama");
			hapus();
			}
			}
	}
	function hapus()
	{
		var counter = $('.duplikat').length;
		var norangka = 'norangka'+counter;
		document.salesform.getElementsByClassName(norangka)[0].setAttribute("value","");
		var nomesin = 'nomesin'+counter;
		document.salesform.getElementsByClassName(nomesin)[0].setAttribute("value","");
		var namatipe = 'namatipe'+counter;
		document.salesform.getElementsByClassName(namatipe)[0].setAttribute("value","");
		var warna = 'warna'+counter;
		document.salesform.getElementsByClassName(warna)[0].setAttribute("value","");
		var tahun = 'tahun'+counter;
		document.salesform.getElementsByClassName(tahun)[0].setAttribute("value","");
		var cc = 'cc'+counter;
		document.salesform.getElementsByClassName(cc)[0].setAttribute("value","");
		var quantity = "quantity"+counter;
		document.salesform.getElementsByClassName(quantity)[0].setAttribute("value","");
		var harga = "harga"+counter;
		document.salesform.getElementsByClassName(harga)[0].setAttribute("value","");
		var tersedia = "tersedia"+counter;
		document.salesform.getElementsByClassName(tersedia)[0].setAttribute("value","");
		var total = "total"+counter;
		document.salesform.getElementsByClassName(total)[0].setAttribute("value","");
		var bbn = "bbn"+counter;
		document.salesform.getElementsByClassName(bbn)[0].setAttribute("value","");
		
	}
	
	function hitungDiskon()
	{		
			var counter = $('.duplikat').length;
			var total = "total"+counter;
		    var totalvalue = document.salesform.getElementsByClassName(total)[0].getAttribute("value");
		    var diskon = "#diskon"+counter;
		    var diskoninternal = "#diskoninternal"+counter;
		    var grandtotal = "#grandtotal"+counter;
		    var ppn = "#ppn"+counter;
		    var bbn = "#bbn"+counter;
			var result= parseFloat(totalvalue)-parseFloat($(diskon).val())-parseFloat($(diskoninternal).val());
			var hasil = result + (result*0.1) + parseFloat($(bbn).val());
			var ppnvalue = result.toFixed(2)/10;
			$(ppn).val(ppnvalue);
			$(grandtotal).val(hasil.toFixed(2));
			updateTotaldiskon();
	}
	function hitungDiskonInternal()
	{		
			var counter = $('.duplikat').length;
			var total = "total"+counter;
		    var totalvalue = document.salesform.getElementsByClassName(total)[0].getAttribute("value");
		    var diskon = "#diskon"+counter;
		    var diskoninternal = "#diskoninternal"+counter;
		    var grandtotal = "#grandtotal"+counter;
		    var ppn = "#ppn"+counter;
		    var bbn = "#bbn"+counter;
			var result= parseFloat(totalvalue)-parseFloat($(diskon).val())-parseFloat($(diskoninternal).val());
			var hasil = result + (result*0.1) + parseFloat($(bbn).val());
			var ppnvalue = result.toFixed(2)/10;
			$(ppn).val(ppnvalue);
			$(grandtotal).val(hasil.toFixed(2));
			updateTotaldiskon();
	}
	function updateSubtotal()
	{					
					var temp=0;
					for (i=4;i<=400;i=i+5)
					{
					if($("#00000"+i).length>0)
					{
					 temp=parseFloat(temp)+parseFloat($("#00000"+i).val());
				 	 
					}
					}
				
			
			var subtotal=parseFloat(temp);
			
			if($("#00000").length>0)
			{
			var firstrowvalue=$("#00000").val();
			
			subtotal=parseFloat(subtotal)+parseFloat(firstrowvalue);
			}
			subtotal=subtotal.toFixed(2);
			$("#subtotal").val(subtotal);
	}

	function updateTotaldiskon()
	{					
					var counter = $('.duplikat').length;
					var sumtotal = 0;
					for (i=1;i<=counter;i=i+1)
					{
					var grandtotal = "#grandtotal"+i;
					grandtotalvalue = parseFloat($(grandtotal).val());
					sumtotal = sumtotal + grandtotalvalue;
					}
			$("#totalsetelahdiskon").val(sumtotal.toFixed(2));
	}
	
	function callRKeyUp(Ridname)
	{
			var rate = parseInt(Ridname,10);
			 var quantity =  rate-1;
			 var avail = rate+1;
			 var total = avail+1;
			 
			 if(parseInt(Ridname)>0)
			 {
			 quantity="00"+quantity;
			 rate="000"+rate;
			 avail="0000"+avail;
			 total="00000"+total
			 
			 }
			 else
			 {
			  quantity="00";
			  rate="000";
			  avail="0000";
			  total="00000";
			  
			 }
			
			var result= parseFloat($("#"+quantity).val()) * parseFloat( $("#"+rate).val() );
			result=result.toFixed(2);
			$("#"+total).val(result);
			if(parseFloat($("#"+quantity).val()) > parseFloat($("#"+avail).val()))
			$("#"+quantity).val(parseFloat($("#"+avail).val()));
			
			updateSubtotal();
	
	}
		$(document).ready(function() {
			// SUCCESS AJAX CALL, replace "success: false," by:     success : function() { callSuccessFunction() }, 
			 /*$("#nofaktur").focus();*/
			
			/*$("#"+quantity).keyup(function (e) {
			
			$("#"+total).val( parseInt( $("#"+qunatity).val()) * parseInt( $("#"+rate).val() ));
			if(parseInt($("#"+quantity).val()) > parseInt($("#"+avail).val()))
			$("#"+quantity).val(parseInt($("#"+avail).val()));
			
			});
			
			$("#"+rate).keyup(function (e) {
			
			$("#"+total).val( parseInt($("#"+quantity).val()) * parseInt($("#"+rate).val()) );
			if(parseInt($("#"+quantity).val()) > parseInt($("#"+avail).val()))
			$("#"+quatity).val(parseInt($("#"+avail).val()));
			
			});*/
			$("#customer").blur(function()
			{
				 $.post('check_customer_details.php', {nm_cust: $(this).val() },
				function(data){
								$("#alamat").val(data.almt_cust);
								$("#telp1_cust").val(data.telp1_cust);
								$("#telp2_cust").val(data.telp2_cust);
							  }, 'json');			
			});	
			$("#form1").validationEngine(),
			
			/*jQuery(document).bind('keydown', 'Ctrl+s',function() {*/
		  $('#form1').submit();
			
			/*jQuery(document).bind('keydown', 'Ctrl+r',function() {
		  $('#subtotal').reset();
		  return false;
			});*/
			
			//$.validationEngine.loadValidation("#date")
			//alert($("#formID").validationEngine({returnIsValid:true}))
			//$.validationEngine.buildPrompt("#date","This is an example","error")	 		 // Exterior prompt build example								 // input prompt close example
			//$.validationEngine.closePrompt(".formError",true) 							// CLOSE ALL OPEN PROMPTS
		});
	</script>
<!-- <script type="text/javascript" src="lib/jquery-latest.js"></script> -->
<script type="text/javascript" src="lib/jquery-latest.js"></script>
<script type="text/javascript">
		jQuery(document).ready(function($){
		$("#nofaktur").focus();
		$('.containerkelengkapan .pluskelengkapan').click(function(){
			var counter = $('.kelengkapan').length;
			var getkelengkapan = <?php echo json_encode($kelengkapan=$db->getKelengkapan());?>;
			var kelengkapanreplaceid = getkelengkapan.replace("kelengkapan1","kelengkapan"+counter);
			var kelengkapan_html = $('<p class="kelengkapan"><table><tr><td><div align="left"><strong>Kelengkapan:</strong></div></td>'+
					  '<td>'+kelengkapanreplaceid+'</td>'+
					  '</tr>'+
					  '<a href="#" class="minuskelengkapan">[Kurangi Kelengkapan]</a></td></tr></table></p>'
					);
			kelengkapan_html.hide();
        $('.containerkelengkapan p.kelengkapan:last').after(kelengkapan_html);
        kelengkapan_html.fadeIn('slow');
        return false;
        });
    $('.containerkelengkapan').on('click', '.minuskelengkapan', function(){
		var counter = $('.kelengkapan').length - 1;
        $(this).parent().fadeOut("slow", function() {
            $(this).remove();
		});
        return false;
    });

    	$('.containerpromo .pluspromo').click(function(){
			var counter = $('.promo').length;
			var getpromo = <?php echo json_encode($promo=$db->getPromo());?>;
			var promoreplaceid = getpromo.replace("promo1","promo"+counter);
			var promo_html = $('<p class="promo"><table><tr><td><div align="left"><strong>Promo:</strong></div></td>'+
					  '<td>'+promoreplaceid+'</td>'+
					  '</tr>'+
					  '<a href="#" class="minuspromo">[Kurangi Promo]</a></td></tr></table></p>'
					);
			promo_html.hide();
        $('.containerpromo p.promo:last').after(promo_html);
        promo_html.fadeIn('slow');
        return false;
        });
    $('.containerpromo').on('click', '.minuspromo', function(){
		var counter = $('.promo').length - 1;
        $(this).parent().fadeOut("slow", function() {
            $(this).remove();
		});
        return false;
    });

		$('.container .plus').click(function(){
		/*$('.container').on('click', '.plus', function(){*/
		var counter = $('.duplikat').length + 1;
		var counter2 = $('.duplikat').length;
		var quantitynow = "quantity" + counter2;
		var quantity = document.getElementsByClassName(quantitynow)[0].getAttribute("id");
		var quantityid = parseInt(quantity.slice(2)) + 5;
		var quantitylast = "00" + quantityid.toString();
		var harganow = "harga" + counter2;
		var harga = document.getElementsByClassName(harganow)[0].getAttribute("id");
		var hargaid = parseInt(harga.slice(3)) + 5;
		var hargalast = "000" + hargaid.toString();
		var tersedianow = "tersedia" + counter2;
		var tersedia = document.getElementsByClassName(tersedianow)[0].getAttribute("id");
		var tersediaid = parseInt(tersedia.slice(4)) + 5;
		var tersedialast = "0000" + tersediaid.toString();
		var totalnow = "total" + counter2;
		var total = document.getElementsByClassName(totalnow)[0].getAttribute("id");
		var totalid = parseInt(total.slice(5)) + 5;
		var totallast = "00000" + totalid.toString();
		var getkd_tipe = <?php echo json_encode($tipe=$db->getTipe());?>;
		//var getselection = document.getElementById("gettipe").value;
		var kd_tipereplaceid = getkd_tipe.replace("kd_tipe1","kd_tipe"+counter);
		var kd_tipereplace = kd_tipereplaceid.replace("showKodeTipe(1)","showKodeTipe("+counter+")");
		//alert(selectreplace);
        var add_html = $('<p class="duplikat"><table width="800" border="0" cellspacing="0" cellpadding="0" style="margin-left:20px;"><tr><td><div align="left"><strong>Kode Tipe</strong></div></td>'+
					  '<td >'+kd_tipereplace+'</td>'+
					  '<td ><div align="right"><strong>Nama Tipe</strong></div></td>'+
					  '<td><input style="width:100px" class="namatipe' + counter + '" name="namatipe[]" type="text" value=""></td>'+
					  '<td ><div align="right"><strong>Warna</strong></div></td>'+
					  '<td><input class="warna' + counter + '" name="warna[]" style="width:50px;" type="text" value=""></td>'+
					  '</tr>'+
					  '<tr>'+
					  '<td><br/></td>'+
					  '</tr>'+
					  '<tr>'+
					  '<td ><div align="left"><strong>No.Rangka</strong></div></td>'+
					  '<td><input class="norangka' + counter + '" name="norangka[]" type="text" value="" style="width:150px;"></td>'+
					  '<td ><div align="right"><strong>No.Mesin</strong></div></td>'+
					  '<td><input style="width:100px" class="nomesin' + counter + '"name="nomesin[]" type="text" value="" style="width:150px;"></td>'+
					  '<td ><div align="right"><strong>Tahun</strong></div></td>'+
					  '<td><input class="tahun' + counter + '"name="tahun[]" type="text" value="" style="width:50px;"></td>'+
					  '<td ><div align="right"><strong>CC</strong></div></td>'+
					  '<td><input class="cc' + counter + '"name="cc[]" type="text" value="" style="width:30px;"></td>'+
					  '</tr>'+
					  '<tr>'+
					  '<td><br/></td>'+
					  '</tr>'+
					  '<tr>'+
                      '<td><div align="left"><strong>Quantity</strong></div></td>'+
                      '<td><input class="quantity' + counter + '"name="quantity[]" type="text" id="'+quantitylast+'"   class="validate[required,custom[onlyFloat],lengthCheck[6]] text-input"  style="width:50px;" onKeyUp="callQKeyUp(this.id)"></td>'+
                      '<td><div align="right"><strong>Harga</strong></div></td>'+
                      '<td><input class="harga' + counter + '"name="harga[]" value="" type="text" id="'+hargalast+'"  class="validate[required,custom[onlyFloat],lengthCheck[6]] text-input"  style="width:80px;" onKeyUp="callRKeyUp(this.id)"  ></td>'+
					  '<td><div align="right"><strong>Tersedia</strong></div></td>'+
						'<td><input class="tersedia' + counter + '"name="tersedia[]" type="text" id="'+tersedialast+'" readonly="" value="" style="width:50px;" ></td>'+
                      '<td><div align="right"><strong>Total</strong></div></td>'+
                      '<td><input class="total' + counter + '"name="total[]" type="text" id="'+totallast+'" value="0" style="width:100px;text-align:right;"></td>'+
                      '</tr>'+
                      '<tr>'+
					  '<td><br/></td>'+
					  '</tr>'+
                      '<tr>'+
                      '<td><div align="left"><strong>Diskon</strong></div></td>'+
                      '<td><input name="diskon[]" type="text" id="diskon'+ counter +'" class="diskon'+ counter +'" value="0" style="width:80px;" onKeyUp="hitungDiskon()"></td>'+
                      '<td><div align="right"><strong>Diskon Int</strong></div></td>'+
                      '<td><input name="diskoninternal[]" value="0" type="text" id="diskoninternal'+ counter +'" class="diskoninternal'+ counter +'"  style="width:80px;" onKeyUp="hitungDiskonInternal()"></td>'+
					  '<td><div align="right"><strong>PPN 10%</strong></div></td>'+
					  '<td><input name="ppn[]" type="text" id="ppn'+ counter +'" class="ppn'+ counter +'" readonly="" value="0" style="width:80px;" ></td>'+
                      '<td><div align="right"><strong>BBN</strong></div></td>'+
                      '<td><input name="bbn[]" type="text" id="bbn'+ counter +'" class="bbn'+ counter +'" readonly="" value="0" style="width:100px;text-align:right;">  </td>'+
                      '</tr>'+
                      '<tr>'+
					  '<td><br/></td>'+
					  '</tr>'+
					  '<tr>'+
					  '<td colspan=3><div align="right"><strong>Grand Total</strong></div></td>'+
                      '<td><input name="grandtotal[]" type="text" id="grandtotal'+ counter +'" class="grandtotal'+ counter +'" value="0" readonly="" value="" style="width:100px;text-align:right;"></td>'+
					  '<a class="minus" href="#">[Remove]</a></td></tr>'+
					  '<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></p>'
					);
        add_html.hide();
        $('.container p.duplikat:last').after(add_html);
        add_html.fadeIn('slow');
        return false;
    });
    $('.container').on('click', '.minus', function(){
		var counter = $('.duplikat').length - 1;
        $(this).parent().fadeOut("slow", function() {
            $(this).remove();
            var temp=0;
					for (i=4;i<=400;i=i+5)
					{
					if($("#00000"+i).length>0)
					{
					 temp=parseFloat(temp)+parseFloat($("#00000"+i).val());
				 	 
					}
					}
				
			
			var subtotal=parseFloat(temp);
			
			if($("#00000").length>0)
			{
			var firstrowvalue=$("#00000").val();
			
			subtotal=parseFloat(subtotal)+parseFloat(firstrowvalue);
			}
			subtotal=subtotal.toFixed(2);
			$("#subtotal").val(subtotal);
			var counter = $('.duplikat').length;
					var sumtotal = 0;
					for (i=1;i<=counter;i=i+1)
					{
					var grandtotal = "#grandtotal"+i;
					grandtotalvalue = parseFloat($(grandtotal).val());
					sumtotal = sumtotal + grandtotalvalue;
					}
			$("#totalsetelahdiskon").val(sumtotal.toFixed(2));
        });
        return false;
    });
});
		</script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.autocomplete.min.js"></script>
<script>
$(document).ready(function(){
	$("#customer").autocomplete("customer.php", {
        selectFirst: true});			
			});
</script>
<script src="js/jquery.validationEngine-en.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
<script>
​$(document).ready(function() {
    $("#customer").blur(function(){
				 $.post('check_customer_details.php', {nm_cust: $(this).val() },
				function(data){
								$("#alamat").val(data.almt_cust);
								$("#telp1_cust").val(data.telp1_cust);
								$("#telp2_cust").val(data.telp2_cust);
							  }, 'json');			
			});
});
</script>
<script type="text/javascript">
function showhidefields(x) {
	{
	switch (x){
	case 'TUNAI': document.getElementById("jatuhtempo").style.visibility = "hidden";break;
	case 'TUNAI TEMPO': document.getElementById("jatuhtempo").style.visibility = "visible";break;
	case 'KREDIT': document.getElementById("jatuhtempo").style.visibility = "hidden";break;
   	}
	}
}

// called onclick of checkbox
function gantiSTNK(status) {
    // get reference to related content to display/hide
    if (status.checked) {
        document.getElementById("stnkbeda").style.visibility = "visible";
        status.value="1"
    } else {
        document.getElementById("stnkbeda").style.visibility = "hidden";
        status.value="0"
    }
}
</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFFFFF;
}

*{
padding: 0px;
margin: 0px;
}
#vertmenu {
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 100%;
width: 160px;
padding: 0px;
margin: 0px;
}

#vertmenu h1 {
display: block;
background-color:#FF9900;
font-size: 90%;
padding: 3px 0 5px 3px;
border: 1px solid #000000;
color: #333333;
margin: 0px;
width:159px;
}

#vertmenu ul {
list-style: none;
margin: 0px;
padding: 0px;
border: none;
}
#vertmenu ul li {
margin: 0px;
padding: 0px;
}
#vertmenu ul li a {
font-size: 80%;
display: block;
border-bottom: 1px dashed #C39C4E;
padding: 5px 0px 2px 4px;
text-decoration: none;
color: #666666;
width:160px;
}

#vertmenu ul li a:hover, #vertmenu ul li a:focus {
color: #000000;
background-color: #eeeeee;
}
.style1 {color: #000000}
div.pagination {

	padding: 3px;

	margin: 3px;

}



div.pagination a {

	padding: 2px 5px 2px 5px;

	margin: 2px;

	border: 1px solid #AAAADD;

	

	text-decoration: none; /* no underline */

	color: #000099;

}

div.pagination a:hover, div.pagination a:active {

	border: 1px solid #000099;



	color: #000;

}

div.pagination span.current {

	padding: 2px 5px 2px 5px;

	margin: 2px;

		border: 1px solid #000099;

		

		font-weight: bold;

		background-color: #000099;

		color: #FFF;

	}

	div.pagination span.disabled {

		padding: 2px 5px 2px 5px;

		margin: 2px;

		border: 1px solid #EEE;

	

		color: #DDD;

	}

	
-->
</style>
</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top"><table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="960" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr>
            <td height="90" align="left" valign="top"><img src="images/topbanner.png" width="960" height="82"></td>
          </tr>
          <tr>
            <td height="800" align="left" valign="top"><table width="960" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
              <tr>
                <td width="130" align="left" valign="top">
				
				<br>

				<strong>Welcome <font color="#3399FF"><?php echo $_SESSION['LOGIN_NAME']; ?></font></strong><br> <br><table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="admin.php"><img src="images/home.png" width="130" height="99" border="0"></a></td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td align="center"><a href="add_purchase_edited.php"><img src="images/purchase.png" width="130" height="124" border="0"></a></td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td align="center"><a href="add_stock_sales_edited.php"><img src="images/sales.png" width="146" height="111" border="0"></a></td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td align="center"><a href="report.php"><img src="images/reports.png" width="131" height="142" border="0"></a></td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    </tr>
</table>


	
				
				
				</td>  <td height="500" align="center" valign="top"> 
<script type='text/javascript'>
var inmenu=false;
var lastmenu=0;
function Menu(current) {
   if (!document.getElementById) return;
   inmenu=true;
   oldmenu=lastmenu;
   lastmenu=current;
   if (oldmenu) Erase(oldmenu);
   m=document.getElementById("menu-" + current);
   /* box=document.getElementById(current);
   box.style.left= m.offsetLeft;
   box.style.top= m.offsetTop + m.offsetHeight; */
   box.style.visibility="visible";
   m.style.backgroundColor="LightBlue";
   box.style.backgroundColor="LightBlue";
   box.style.width="100px";
}
function Erase(current) {
   if (!document.getElementById) return;
   if (inmenu && lastmenu==current) {
     return;
   }
   m=document.getElementById("menu-" + current);
   box=document.getElementById(current);
   box.style.visibility="hidden";
   m.style.backgroundColor="#FFFFFF";
}
function Timeout(current) {
   inmenu=false;
   window.setTimeout("Erase('" + current + "')",10) ;
}
function Highlight(menu,item) {
   if (!document.getElementById) return;
   inmenu=true;
   lastmenu=menu;
   obj=document.getElementById(item);
   obj.style.backgroundColor="#FFFFFF";
   obj.style.fontSize = "x-large";
}
function UnHighlight(menu,item) {
   if (!document.getElementById) return;
   Timeout(menu);
   obj=document.getElementById(item);
   obj.style.backgroundColor="LightBlue";
   obj.style.fontSize = "x-large";
}
</script>				
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td id="menu-mastering" bgcolor="#FFFFFF"
      onMouseOver="Menu('mastering')" onMouseOut="Timeout('mastering')">
     <img src="images/master.png" width="67" height="62" border="0">
   </td>
    <td><a href="add_stock_details.php"><img src="images/addstockdetails.png" width="67" height="62" border="0"></a></td>
    <td><a href="add_supplier_details.php"><img src="images/supplier.png" width="67" height="54" border="0"></a></td>
    <td><a href="add_customer_details.php"><img src="images/customer.png" width="67" height="54" border="0"></a></td>
    <td><a href="add_category.php"><img src="images/categories.png" width="67" height="54" border="0"></a></td>
    <td><a href="view_stock_sales.php"><img src="images/vsales.png" width="67" height="54" border="0"></a></td>
    <td><a href="view_stock_entries.php"><img src="images/vpurchase.png" width="67" height="54" border="0"></a></td>
    <td><a href="view_stock_details.php"><img src="images/stockdetails.png" width="67" height="54" border="0"></a></td>
    <td><a href="view_stock_availability.php"><img src="images/savail.png" width="67" height="54" border="0"></a></td>
    <td align="left" valign="top"><a href="view_customer_details.php"><img src="images/customers.png" width="94" height="22" border="0"></a><br>      
      <a href="view_supplier_details.php"><img src="images/suppliers.png" width="94" height="22" border="0"></a><br>
      <a href="view_payments.php"><img src="images/payments.png" width="94" height="22" border="0"></a></td>
    <td align="left" valign="top"><a href="view_stock_sales_payments.php"><img src="images/outstanding.png" width="94" height="22" border="0"></a><br>      <a href="view_stock_entries_payments.php"><img src="images/pendings.png" width="94" height="22" border="0"></a><br>
      <a href="logout.php"><img src="images/logout.png" width="94" height="22" border="0"></a></td>
  </tr>
</table>
<div id="mastering" style="position:absolute; visibility: hidden">
  <table width="100%"  style="font-size: x-large" border="0" cellspacing="0" cellpadding="0">
  <tr> <td id="menu-customer"
     onMouseOver="Highlight('mastering','menu-customer')"
     onMouseOut="UnHighlight('mastering','menu-customer')">
  <a href="masteringkustomer.php">Customer</a></td></tr>
  <tr> <td ID="menu-supplier"
     onMouseOver="Highlight('mastering','menu-supplier')"
     onMouseOut="UnHighlight('mastering','menu-supplier')">
  <a href="masteringsupplier.php">Supplier</a></td></tr>
  <tr> <td ID="menu-salesman"
     onMouseOver="Highlight('mastering','menu-salesman')"
     onMouseOut="UnHighlight('mastering','menu-salesman')">
  <a href="masteringsalesman.php">Staff</a></td></tr>
  <tr> <td ID="menu-wilayah"
     onMouseOver="Highlight('mastering','menu-wilayah')"
     onMouseOut="UnHighlight('mastering','menu-wilayah')">
  <a href="masteringkelurahan.php">Wilayah</a></td></tr>
  <tr> <td ID="menu-leasing"
     onMouseOver="Highlight('mastering','menu-leasing')"
     onMouseOut="UnHighlight('mastering','menu-leasing')">
  <a href="masteringleasing.php">Leasing</a></td></tr>
  <tr> <td ID="menu-tipe"
     onMouseOver="Highlight('mastering','menu-tipe')"
     onMouseOut="UnHighlight('mastering','menu-tipe')">
  <a href="masteringtipe.php">Tipe</a></td></tr>
  <tr> <td ID="menu-warna"
     onMouseOver="Highlight('mastering','menu-warna')"
     onMouseOut="UnHighlight('mastering','menu-warna')">
  <a href="masteringleasing.php">Warna</a></td></tr>
  <tr> <td ID="menu-stnk"
     onMouseOver="Highlight('mastering','menu-stnk')"
     onMouseOut="UnHighlight('mastering','menu-stnk')">
  <a href="masteringstnk.php">Warna</a></td></tr>
  <tr> <td ID="menu-stock"
     onMouseOver="Highlight('mastering','menu-stock')"
     onMouseOut="UnHighlight('mastering','menu-stock')">
  <a href="masteringstock.php">Stock</a></td></tr>
  </table>
</div>
<?php
 				if(isset($_POST['nonota']))
			//if($_SERVER['REQUEST_METHOD']==="POST")
            {
			$revisi=mysql_real_escape_string($_POST['revisi']);
			$no_nota=mysql_real_escape_string($_POST['nonota']);
			
			$no_faktur=mysql_real_escape_string($_POST['nofaktur']);
			$nm_cust=mysql_real_escape_string($_POST['customer']);
			$almt_cust=mysql_real_escape_string($_POST['alamat']);
			$telp1_cust=mysql_real_escape_string($_POST['telp1_cust']);
			$telp2_cust=mysql_real_escape_string($_POST['telp2_cust']);
			$namasales=mysql_real_escape_string($_POST['namasales']);
			$uangmuka=mysql_real_escape_string($_POST['uangmuka']);
			$kekurangan=mysql_real_escape_string($_POST['kekurangan']);
			$komisi=mysql_real_escape_string($_POST['komisi']);
			$sistembayar=mysql_real_escape_string($_POST['sistembayar']);
			$username = $_SESSION['LOGIN_NAME'];
			$gabungant = $db->getMotor($no_nota);
			foreach($gabungant as $gabunganisi)
			{
			$db->query($gabunganisi);
			}
			$gabunganpartt = $db->getCurrentPart($no_nota);
			foreach($gabunganpartt as $gabunganpartisi)
			{
			$db->query($gabunganpartisi);
			}
			$gabunganpromot = $db->getCurrentPromo($no_nota);
			foreach($gabunganpromot as $gabunganpromoisi)
			{
			$db->query($gabunganpromoisi);
			}
			$db->query("delete from trjual where no_nota='$no_nota'");
			$db->query("delete from trjualdetail where no_nota='$no_nota'");
			$db->query("delete from trjualpart where no_nota='$no_nota'");
			$db->query("delete from trjualpromo where no_nota='$no_nota'");
			$db->query("delete from trjualtemp where no_nota='$no_nota'");
			$db->query("delete from trjualstnk where no_nota='$no_nota'");
			$db->query("delete from tempo where no_nota='$no_nota'");
			$db->query("delete from transaksi where kd_transaksi='$no_nota'");
			$db->query("delete from transaksidetail where kd_transaksi='$no_nota'");
			$db->query("delete from piutang where kd_penjualan='$no_nota'");
			$db->execute("UPDATE nomonth SET SL=NOW()");
			$nilai = $db->queryUniqueValue("SELECT SL FROM nonota");
			$nilaibaru = $nilai - 1;
			$db->execute("UPDATE nonota SET SL=$nilaibaru");
			if($sistembayar=="TUNAI TEMPO")
			{
				$jt1=mysql_real_escape_string($_POST['jt1']);
		  		$jt1=strtotime($jt1);
				$jt1=date('Y-m-d H:i:s', $jt1);
				$jt2=mysql_real_escape_string($_POST['jt2']);
				$jt2=strtotime($jt2);
				$jt2=date('Y-m-d H:i:s', $jt2);
				$jt3=mysql_real_escape_string($_POST['jt3']);
				$jt3=strtotime($jt3);
				$jt3=date('Y-m-d H:i:s', $jt3);
				$jt4=mysql_real_escape_string($_POST['jt4']);
				$jt4=strtotime($jt4);
				$jt4=date('Y-m-d H:i:s', $jt4);
				$jt5=mysql_real_escape_string($_POST['jt5']);
				$jt5=strtotime($jt5);
				$jt5=date('Y-m-d H:i:s', $jt5);
				$jt6=mysql_real_escape_string($_POST['jt6']);
				$jt6=strtotime($jt6);
				$jt6=date('Y-m-d H:i:s', $jt6);
				$db->execute("INSERT INTO tempo(no_nota,jt1,jt2,jt3,jt4,jt5,jt6,user) values ('$no_nota','$jt1','$jt2','$jt3','$jt4','$jt5','$jt6','$username')");
			}
			if($_POST['stnk']==0) 
    		{$stnkvalue = "0";}
    		else if ($_POST['stnk']==1)
    		{
    			$stnkvalue = "1";
    			$no_ktp=mysql_real_escape_string($_POST['noktp']);
    			$nama_ktp=mysql_real_escape_string($_POST['namaktp']);
    			$alamat_ktp=mysql_real_escape_string($_POST['alamatktp']);
    			$kelurahan=mysql_real_escape_string($_POST['kelurahan']);
    			$kecamatan=mysql_real_escape_string($_POST['kecamatan']);
    			$kota=mysql_real_escape_string($_POST['kota']);
    			$provinsi=mysql_real_escape_string($_POST['provinsi']);
    			$telpon=mysql_real_escape_string($_POST['telepon']);
    			$tgl_lahir=mysql_real_escape_string($_POST['tgl_lahir']);
				$tgl_lahir=strtotime($tgl_lahir);
				$tgl_lahir=date('Y-m-d H:i:s', $tgl_lahir);
    			$db->query("insert into trjualstnk (no_nota,no_ktp,nama,alamat,kelurahan,kecamatan,kota,provinsi,tgl_lahir,telpon) values('$no_nota','$no_ktp','$nama_ktp','$alamat_ktp','$kelurahan','$kecamatan','$kota','$provinsi','$tgl_lahir','$telpon')");
			}

			/*$stnkvalue=mysql_real_escape_string($_POST['stnk']);*/
			$kd_cust = $db->queryUniqueValue("SELECT kd_cust FROM mstcust WHERE nm_cust='$nm_cust'");
			$count1 = $db->queryUniqueValue("SELECT count(*) FROM mstcust WHERE kd_cust='$kd_cust'");
			if ($count1==0)
			{
				$max = $db->maxOfAll("kd_cust","mstcust");
				$maxcust = str_pad($max+1, 5, '0', STR_PAD_LEFT);
				$db->query("INSERT INTO piutang(kd_cust,jumlah,kd_penjualan) values ('$maxcust',$kekurangan,'$no_nota')");
			}
			else
			{
				$db->query("INSERT INTO piutang(kd_cust,jumlah,kd_penjualan) values ('$kd_cust',$kekurangan,'$no_nota')");
			}
			/*$tanggalnota=$_POST['tanggalnota'];*/
			/*$tanggalnota=$date->now();
		  	$tanggalnota=strtotime( $tanggalnota );
			$mysqltanggalnota = date('Y-m-d H:i:s', $tanggalnota );
			$tanggalnota=$mysqltanggalnota;*/
			
			/*$description=mysql_real_escape_string($_POST['description']);*/
			
			$subtotal=mysql_real_escape_string($_POST['subtotal']);
			$totalsetelahdiskon=mysql_real_escape_string($_POST['totalsetelahdiskon']);
			$username=$_SESSION['LOGIN_NAME'];
			
			$count2 = $db->queryUniqueValue("SELECT count(kd_cust) FROM mstcust WHERE nm_cust='$nm_cust'");
			if($count2 == 1)
			{
			$kd_cust = $db->queryUniqueValue("SELECT kd_cust FROM mstcust WHERE nm_cust='$nm_cust'");
			$kd_sales = $db->queryUniqueValue("SELECT KD_SALES FROM mstsales WHERE NM_SALES='$namasales'"); 
			$db->query("insert into trjual (no_nota,no_faktur,tgl_nota,kd_cust,kd_sales,sistem_byr,dp,komisi,user,stnk,total,total_dng_diskon,revisi) values('$no_nota','$no_faktur',NOW(),'$kd_cust','$kd_sales','$sistembayar',$uangmuka,$komisi,'$username',$stnkvalue,$subtotal,$totalsetelahdiskon,$revisi)");
			$db->query("insert into transaksi (kd_transaksi,jenis,kd_cust,subtotal,pembayaran,piutang,tgl_transaksi,user) values('$no_nota','penjualan','$kd_cust',$totalsetelahdiskon,$uangmuka,$kekurangan,NOW(),'$username')");
			$db->execute("UPDATE nomonth SET SL=NOW()");
			$nilai = $db->queryUniqueValue("SELECT SL FROM nonota");
			$nilaibaru = $nilai + 1;
			$db->execute("UPDATE nonota SET SL=$nilaibaru");
			}
			else if ($count2 == 0)
			{
				$max = $db->maxOfAll("kd_cust","mstcust");
				$maxcust = str_pad($max+1, 5, '0', STR_PAD_LEFT);
				$kd_sales = $db->queryUniqueValue("SELECT KD_SALES FROM mstsales WHERE NM_SALES='$namasales'");
				$db->query("insert into trjual (no_nota,no_faktur,tgl_nota,kd_cust,kd_sales,sistem_byr,dp,komisi,user,stnk,total,total_dng_diskon,revisi) values('$no_nota','$no_faktur',NOW(),'$maxcust','$kd_sales','$sistembayar',$uangmuka,$komisi,'$username',$stnkvalue,$subtotal,$totalsetelahdiskon,$revisi)");
				$db->query("insert into transaksi (kd_transaksi,jenis,kd_cust,subtotal,pembayaran,piutang,tgl_transaksi,user) values('$no_nota','penjualan','$maxcust',$totalsetelahdiskon,$uangmuka,$kekurangan,NOW(),'$username')");
				$db->execute("UPDATE nomonth SET SL=NOW()");
			$nilai = $db->queryUniqueValue("SELECT SL FROM nonota");
			$nilaibaru = $nilai + 1;
			$db->execute("UPDATE nonota SET SL=$nilaibaru");
			}
			/*if($_POST['stnk']==1)
			{
				$stnkvalue = "1";
				$db->query("insert into trjualstnk (no_nota,no_ktp,nama,alamat,keluruhan,kecamatan,kota,provinsi,telpon) values('$no_nota','$no_faktur',NOW(),'$maxcust','$kd_sales','$sistembayar',$uangmuka,$komisi,'$username',$stnkvalue,$subtotal,$totalsetelahdiskon)");
			} */
			$i=0;
			$kdtipet=$_POST['kd_tipe'];
			$namatipet=$_POST['namatipe'];
			$norangkat=$_POST['norangka'];
			$nomesint=$_POST['nomesin'];
			$warnat=$_POST['warna'];
			$tahunt=$_POST['tahun'];
			$cct=$_POST['cc'];
			$quantityt=$_POST['quantity'];
			$hargat=$_POST['harga'];
			$totalt=$_POST['total'];
			$diskont=$_POST['diskon'];
			$diskoninternalt=$_POST['diskoninternal'];
			$ppnt=$_POST['ppn'];
			$bbnt=$_POST['bbn'];
			$grandtotalt=$_POST['grandtotal'];
			  foreach($kdtipet as $kdtipe1)
			   {
			$kdtipe=$_POST['kd_tipe'][$i];
			$namatipe=$_POST['namatipe'][$i];
			$norangka=$_POST['norangka'][$i];
			$nomesin=$_POST['nomesin'][$i];
			$warna=$_POST['warna'][$i];
			$tahun=$_POST['tahun'][$i];
			$cc=$_POST['cc'][$i];
			$quantity=$_POST['quantity'][$i];
			$harga=$_POST['harga'][$i];
			$total=$_POST['total'][$i];
			$diskon=$_POST['diskon'][$i];
			$diskoninternal=$_POST['diskoninternal'][$i];
			$ppn=$_POST['ppn'][$i];
			$bbn=$_POST['bbn'][$i];
			$grandtotal=$_POST['grandtotal'][$i];
			$username = $_SESSION['LOGIN_NAME'];
			
			
			$db->query("insert into trjualdetail (no_nota,no_faktur,kd_tipe,nm_tipe,no_rangka,no_mesin,kd_warna,tahun,cc,quantity,hrg_jual,diskon,diskon_int,ppn,bbn,grandtotal,user,count) values('$no_nota','$no_faktur','$kdtipe1','$namatipe','$norangka','$nomesin','$warna','$tahun','$cc',$quantity,$harga,$diskon,$diskoninternal,$ppn,$bbn,$grandtotal,'$username',$i+1)");
			$db->query("insert into transaksidetail (kd_transaksi,kd_tipe,no_rangka,no_mesin,kd_warna,tahun,cc,grandtotal,user) values('$no_nota','$kdtipe1','$norangka','$nomesin','$warna','$tahun','$cc',$grandtotal,'$username')");
			$db->query("insert into trjualtemp (no_nota,no_rangka,no_mesin,jumlah,user,count) values ('$no_nota','$norangka','$nomesin',$quantity,'$username',$i+1)");
			
			$amount = $db->queryUniqueValue("SELECT jumlah FROM motor WHERE no_rangka='$norangka' and no_mesin = '$nomesin'");
			if ($amount>0)
			{
				$amount1 = $amount - $quantity;
				$db->execute("UPDATE motor SET jumlah=$amount1 WHERE no_rangka='$norangka' and no_mesin = '$nomesin'");
			}
			//echo "<br><font color=green size=+1> Current Stock Availability is  [ $amount1 ]</font>" ;	
			{
				$reorder = $db->queryUniqueValue("SELECT sum(jumlah) FROM motor where kd_tipe='$kd_tipe1'");
				if($reorder<4)
				{
				echo "<br><font color=green size=+1 >Segera Lakukan Reorder untuk TIPE $kdtipe1!</font>" ;
				}
			}
			$jumlahmotor = count($quantity);
			$count1 = $db->queryUniqueValue("SELECT count(*) FROM mstcust WHERE nm_cust='$nm_cust'");
			if($count1!=1)
			{
			$max = $db->maxOfAll("kd_cust","mstcust");
			$maxcust = str_pad($max+1, 5, '0', STR_PAD_LEFT);
			if($db->query("insert into mstcust (kd_cust,nm_cust,almt_cust,telp1_cust,telp2_cust,jml_beli) values('$maxcust','$nm_cust','$almt_cust','$telp1_cust','$telp2_cust',$jumlahmotor)"))
			echo "<br><font color=green size=+1 > [ $nm_cust ] Customer Berhasil Ditambah !</font>" ;
			}
			else if($count1==1)
			{
				$jml_beli = $db->queryUniqueValue("SELECT jml_beli FROM mstcust WHERE nm_cust='$nm_cust'");
				$jml_beli1 = $jml_beli + $jumlahmotor;
				$db->execute("UPDATE mstcust SET jml_beli=$jml_beli1,almt_cust='$almt_cust',telp1_cust='$telp1_cust',telp2_cust='$telp2_cust' WHERE nm_cust='$nm_cust'");
			} 
			$i++;
			}
			$j=0;
			$kelengkapant=$_POST['kelengkapan'];
			  foreach($kelengkapant as $kelengkapan1)
			   {
			$kelengkapan=$_POST['kelengkapan'][$j];
			$db->query("insert into trjualpart (no_nota,kd_part,count) values('$no_nota','$kelengkapan1',$j+1)");
			$j++;
			$jmlh=0;
			foreach($kdtipet as $kdtipe1)
			   {
			   $norangka=$_POST['norangka'][$jmlh];
			   $nomesin=$_POST['nomesin'][$jmlh];   
			   $quantity=$_POST['quantity'][$jmlh];
			   $jumlahmotor = count($quantity);
			   
			   $jmlh++;
			$jumlahmotor = count($quantity);
			
			$jml_kelengkapan = $db->queryUniqueValue("SELECT jumlah FROM mstpart WHERE kd_part='$kelengkapan1'");
			$jml_kurangpart = $jml_kelengkapan - $jumlahmotor;
			$db->query("UPDATE mstpart SET jumlah=$jml_kurangpart WHERE kd_part='$kelengkapan1'");
				//$j++;
			   }
			   }
			$k=0;
			$promot=$_POST['promo'];
			  foreach($promot as $promo1)
			   {
			$promo=$_POST['promo'][$k];
			$db->query("insert into trjualpromo (no_nota,kd_promo,count) values('$no_nota','$promo1',$k+1)");
			$k++;
			
			$jml=0;
			foreach($kdtipet as $kdtipe1)
			   {
			   $quantity=$_POST['quantity'][$jml];
			   $jumlahmotor = count($quantity);
			   
			   $jml++;
			$jml_promo = $db->queryUniqueValue("SELECT jumlah FROM mstpromo WHERE kd_promo='$promo1'");
			$jml_kurangpromo = $jml_promo - $jumlahmotor;
			$db->query("UPDATE mstpromo SET jumlah=$jml_kurangpromo WHERE kd_promo='$promo1'");
			//$k++;
			   }
			}
			echo "<div style='background-color:yellow;'><br><font color=green size=+1 >New Sales Added ! Transaction ID [ $no_nota ]</font></div> ";
			//echo "<script>window.open('add_sales_print.php?sid=$nonota','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');</script>";
			
		}
				?>
				
				<br>

<br>

				
				<form name="salesform" method="post" id="form1" action="" onSubmit="updateSubtotal();updateTotaldiskon()" >
                  
                  <p align="center"><strong>Pembayaran</strong></p><br/>
				  <?php
				  if(isset($_GET['id']))
				  {
				  $id=$_GET['id'];
				  $line = $db->queryUniqueObject("SELECT * FROM trjual WHERE no_nota='$id'");			
				  ?>
				  <table>
				  <tr>
                      <td width="61">&nbsp;</td>
                      <td width="110">&nbsp;</td>
                      <td width="75">&nbsp;</td>
					  <strong>Tanggal Pembayaran</strong></div>
                      <input type="text" name="revisi" style="width:100px" id="revisi" value="" class="validate[required,length[0,100]] text-input">
                      <td width="171">&nbsp;</td>
                      <td width="74">&nbsp;</td>
                      <td width="111">&nbsp;</td>
                    </tr>
				</table>
				<table>
					<tr>
                      <td width="61">&nbsp;</td>
                      <td width="110">&nbsp;</td>
                      <td width="75">&nbsp;</td>
					  <strong>No. Nota</strong>
					  <input name="nonota" style="width:100px" type="text" id="nonota" value="<?php echo $line->NO_NOTA; ?>" style="width:110px">
                      <td width="171">&nbsp;</td>
                      <td width="74">&nbsp;</td>
                      <td width="111">&nbsp;</td>
                    </tr>
					
					</table>
				  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0"  id="duplicate" style="margin-left:20px;">
					  
					  <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td width="103">&nbsp;</td>
						<td width="140">&nbsp;</td>
						<td width="5">&nbsp;</td>
						<td width="5">&nbsp;</td>
						<td width="5">&nbsp;</td>
						<td width="13">&nbsp;</td>
					  </tr>
					  <tr>
						<td>Pembayaran:</td>
						<td><input type="text" value="<?php echo $line->DP;?>" name="uangmuka" style="width:100px;text-align:right;" id="uangmuka" onKeyUp="hitungKekurangan()"></td>
						<!--class="validate[required,custom[onlyFloat],lengthCheck[6]] text-input"-->
						<!-- <td><div align="left">Description</div></td>
						<td rowspan="2"><textarea name="description" style="width:150px; height:40px; "></textarea></td> -->
						<td>&nbsp;</td>
						<td><div align="center"><strong>Sub Total </strong></div></td>
						<td><input name="subtotal" value="<?php echo $line->TOTAL;?>" id="subtotal" type="text" readonly="" style="width:100px; text-align:right; color:#333333; font-weight:bold; font-size:16px;"><img src="images/refresh.png" alt="Refresh" align="absmiddle" onClick="updateSubtotal()"></td>
						<td><div align="center"><strong>Grand Total</strong></div></td>
						<td><input name="totalsetelahdiskon" id="totalsetelahdiskon" type="text" readonly="" style="width:100px; text-align:right; color:#333333; font-weight:bold; font-size:16px;"><img src="images/refresh.png" alt="Refresh" align="absmiddle" onClick="updateTotaldiskon()"></td>
						
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<td>Kekurangan:</td>
						<td><input name="kekurangan" value="<?php echo (($line->TOTAL_DNG_DISKON)-($line->DP));?>" type="text" id="kekurangan" style="width:100px;text-align:right;" readonly=""></td>
					  </tr>
					  <tr>
					    <td width="100px">Komisi:</td>
					    <td><input name="komisi" value="<?php echo $line->KOMISI;?>" type="text" id="komisi" style="width:100px;text-align:right;" value="0.00"></td>
					  </tr>
					  <tr>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    </tr>
					  <tr>
						<td width="100px">Sistem Bayar:</td>
						<td width="110"><select name="sistembayar" value="<?php echo $line->SISTEM_BYR;?>" onChange="showhidefields(this.value);">
						<option value="TUNAI" <?php if($line->SISTEM_BYR=="TUNAI"){echo "selected";}?>>Tunai</option>
						<option value="TUNAI TEMPO" <?php if($line->SISTEM_BYR=="TUNAI TEMPO"){echo "selected";}?>>Tunai Tempo</option>
						<option value="KREDIT" <?php if($line->SISTEM_BYR=="KREDIT"){echo "selected";}?>>Kredit</option>
						
						  </select></td></tr></table><br/>
						  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0"  id="jatuhtempo" style="margin-left:20px;visibility:<?php if($line->SISTEM_BYR=="TUNAI TEMPO"){echo "visible";} else {echo "hidden";}?>">
					  <tr>
					    <?php 
					  $line10 = $db->queryUniqueObject("SELECT * FROM tempo WHERE no_nota='$line->NO_NOTA'");	
					  ?>
						<td width="150px">Jatuh Tempo 1:</td>
						<td width="195"><input type="text" id="jt1" name="jt1" value="<?php echo date('d-m-Y',strtotime($line10->JT1));?>" style="width:70px;"></td>
						<td width="150px">Jatuh Tempo 3:</td>
						<td width="195"><input type="text" id="jt3" name="jt3" value="<?php echo date('d-m-Y',strtotime($line10->JT3));?>" style="width:70px;"></td>
						<td width="150px">Jatuh Tempo 5:</td>
						<td width="195"><input type="text" id="jt5" name="jt5" value="<?php echo date('d-m-Y',strtotime($line10->JT5));?>" style="width:70px;"></td>
					  </tr>
					  <tr>
					  <td width="150px">Jatuh Tempo 2:</td>
					  <td width="195"><input type="text" id="jt2" name="jt2" value="<?php echo date('d-m-Y',strtotime($line10->JT2));?>" style="width:70px;"></td>
					  <td width="150px">Jatuh Tempo 4:</td>
					  <td width="195"><input type="text" id="jt4" name="jt4" value="<?php echo date('d-m-Y',strtotime($line10->JT4));?>" style="width:70px;"></td>
					  <td width="150px">Jatuh Tempo 6:</td>
					  <td width="195"><input type="text" id="jt6" name="jt6" value="<?php echo date('d-m-Y',strtotime($line10->JT6));?>" style="width:70px;"></td>
					</tr>
					</table>
					<table>
					<tr>
					  <td>&nbsp;</td>
					</tr>
					  <tr>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
					    <td><input type="submit" style="height:50px;width:100px" name="Submit" value="Save" onClick="updateSubtotal()" ></td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    </tr>
					</table>
					</td>
              </tr>
            </table>
					</td>
          </tr>
          <tr>
            <td height="30" align="center" bgcolor="#88D2F5"><span class="style2"><p>&copy; Sinar Rodamas
				<script language="JavaScript" type="text/javascript">
					now = new Date
					theYear=now.getYear()
					if (theYear < 1900)
					theYear=theYear+1900
					document.write(theYear)
				</script></span></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
                  <table width="800"  style="visibility:hidden" border="0" cellspacing="0" cellpadding="0"  id="dynamictable">
                    
					
                    
                    <tr>
                      <td width="61">&nbsp;</td>
					  <td width="110">&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
                      <td>&nbsp;</td>
					  <td><div align="left" style="width:110px"><strong>Tanggal Nota</strong></div></td>
					  <td><input type="text" id="tanggalnota" name="tanggalnota" value="<?php echo date('d-m-Y',strtotime($line->TGL_NOTA));?>" style="width:80px"></td>
					  <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
					  <td width="61">&nbsp;</td>
					  <td width="110">&nbsp;</td>
                      <td width="15"><div align="left"></div></td>
                      <td width="76">&nbsp;</td>
                      <td width="171"><div align="left"></div></td>
                      <td width="74">&nbsp;</td>
                      <td width="111"><div align="left"></div></td>
                      <td width="77">&nbsp;</td>
                      <td width="105">&nbsp;</td>
                    </tr>
                    <tr>
                      <td><div align="center" style="width:90px"><strong>No. Faktur</strong></div></td>
                      <td><input type="text" name="nofaktur" style="width:100px" id="nofaktur" value="<?php echo $line->NO_FAKTUR; ?>" ></td>
                      <td>&nbsp;</td>
                      <td><div align="left"><strong>Customer</strong><br><br>Alamat</div></td>
					  <?php
				      $line2 = $db->queryUniqueObject("SELECT * FROM mstcust WHERE kd_cust='$line->KD_CUST'");			
				      ?>
                      <td><input name="customer" type="text" id="customer" value="<?php echo $line2->NM_CUST; ?>" style="width:110px" autocomplete="off">
                      <br><br>
                      <input name="alamat" id="alamat" value="<?php echo $line2->ALMT_CUST; ?>" style="width:150px"></td>
                     <!--  <td><div align="left" style="width:30px"><strong>Alamat</strong></div></td>
                      <td><textarea name="alamat" id="alamat" style="width:100px"></textarea></td> -->
                      <td><div align="left">No. Telepon<br>
                              <br>
                        No. HP</div></td>
                      <td><input name="telp1_cust" type="text" id="telp1_cust"  value="<?php echo $line2->TELP1_CUST; ?>" style="width:90px;">
                          <br>
                          <br>
                          <input name="telp2_cust" type="text" id="telp2_cust"  value="<?php echo $line2->TELP2_CUST; ?>" style="width:100px;" ></td>
                      
                      <td><strong>Sales</strong></td>
                      <td>
					  <?php
				      $line7 = $db->queryUniqueObject("SELECT * FROM mstsales WHERE kd_sales='$line->KD_SALES'");			
				      ?>
					  <!--<input name="name[]" type="text" class="validate[required,length[0,100]] text-input" onFocus="callAutoComplete(this.id)" id="0"   style="width:100px;" onBlur="callAutoAsignValue(this.id)" autocomplete="off">-->
					  <?php $salesman = $db->getSalesman(); $nm_sales = $line7->NM_SALES; $sebelum = '<option value="'.$nm_sales.'">'; $sesudah = '<option value="'.$nm_sales.'" selected>'; $seleksi = str_replace($sebelum,$sesudah,$salesman); echo $seleksi?>
						</td>

                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><div align="left"></div></td>
                      <td>&nbsp;</td>
                      <td><div align="left"></div></td>
                      <td>&nbsp;</td>
                      <td><div align="left"></div></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                   </table>
                  <br>
				  <?php 
					$max = $db->maxOf("count", "trjualdetail", "no_nota='$line->NO_NOTA'");
					$j=0;
					for($i=1; $i<=$max; $i++)
					{
					?>
				  <div class="container">
				  <p class="duplikat">
					<table width="800" border="0" cellspacing="0" cellpadding="0" style="margin-left:20px;visibility:hidden">
					  <tr>  
                      <td ><div align="left"><strong>Kode Tipe</strong></div></td>
                      <td >
					  <?php 
					  $line3 = $db->queryUniqueObject("SELECT * FROM trjualdetail WHERE no_nota='$line->NO_NOTA' and count=$i");	
					  ?>
					  <!--<input name="name[]" type="text" class="validate[required,length[0,100]] text-input" onFocus="callAutoComplete(this.id)" id="0"   style="width:100px;" onBlur="callAutoAsignValue(this.id)" autocomplete="off">-->
					  <?php $tipe = $db->getTipe(); $tipeganti=str_replace("kd_tipe1","kd_tipe"+$i,$tipe);$kd_tipe = $line3->KD_TIPE; $sebelum = '<option value="'.$kd_tipe.'">'; $sesudah = '<option value="'.$kd_tipe.'" selected>'; $seleksi = str_replace($sebelum,$sesudah,$tipeganti); echo $seleksi;?>
					  </td>
					  <td ><div align="right"><strong>Nama Tipe</strong></div></td>
					  <td><input style="width:100px" class="namatipe<?php echo $i;?>" name="namatipe[]" type="text" value="<?php echo $line3->NM_TIPE;?>"></td>
					  <td ><div align="right"><strong>Warna</strong></div></td>
					  <td><input class="warna<?php echo $i;?>" name="warna[]" style="width:50px;" type="text" value="<?php echo $line3->KD_WARNA;?>"></td>
					  </tr>
					  <tr>
					  <td><br/></td>
					  </tr>
					  <tr>
					  <td ><div align="left"><strong>No.Rangka</strong></div></td>
					  <td><input class="norangka<?php echo $i;?>" name="norangka[]" type="text" value="<?php echo $line3->NO_RANGKA;?>" style="width:150px;"></td>
					  <td ><div align="right"><strong>No.Mesin</strong></div></td>
					  <td><input style="width:100px" class="nomesin<?php echo $i;?>" name="nomesin[]" type="text" value="<?php echo $line3->NO_MESIN;?>" style="width:150px;"></td>
					  <td ><div align="right"><strong>Tahun</strong></div></td>
					  <td><input class="tahun<?php echo $i;?>" name="tahun[]" type="text" value="<?php echo $line3->TAHUN;?>" style="width:50px;"></td>
					  <td ><div align="right"><strong>CC</strong></div></td>
					  <td><input class="cc<?php echo $i;?>" name="cc[]" type="text" value="<?php echo $line3->CC;?>" style="width:30px;"></td>
					  </tr>
					  <tr>
					  <td><br/></td>
					  </tr>
					  <tr>
                      <td><div align="left"><strong>Quantity</strong></div></td>
                      <td><input name="quantity[]" type="text" id="00<?php echo 1+$j;?>" class="quantity<?php echo $i;?>"  style="width:50px;" onKeyUp="callQKeyUp(this.id)" value="<?php echo $line3->QUANTITY;?>"></td>
                      <td><div align="right"><strong>Harga</strong></div></td>
					  <!--class="validate[required,custom[onlyFloat],lengthCheck[6]] text-input"-->
                      <td><input name="harga[]" value="<?php echo $line3->HRG_JUAL;?>" type="text" id="000<?php echo 2+$j;?>"  class="harga<?php echo $i;?>"  style="width:80px;text-align:right;" onKeyUp="callRKeyUp(this.id)"></td>
					  <?php 
					  $line5 = $db->queryUniqueObject("SELECT * FROM motor WHERE no_rangka='$line3->NO_RANGKA'");	
					  ?>
					  <td><div align="right"><strong>Tersedia</strong></div></td>
						<td><input name="tersedia[]" type="text" id="0000<?php echo 3+$j;?>" class="tersedia<?php echo $i;?>" readonly="" value="<?php echo $line5->JUMLAH;?>" style="width:50px;" ></td>
                      <td><div align="right"><strong>Total</strong></div></td>
                      <td><input name="total[]" type="text" id="00000<?php echo 4+$j;?>" class="total<?php echo $i;?>" readonly="" value="<?php echo ($line3->HRG_JUAL)*($line3->QUANTITY)?>" style="width:100px;text-align:right;" ></td>
                      </tr>
                      <tr>
					  <td><br/></td>
					  </tr>
                      <tr>
                      <td><div align="left"><strong>Diskon</strong></div></td>
                      <td><input name="diskon[]" type="text" id="diskon<?php echo $i;?>" class="diskon<?php echo $i;?>" value="<?php echo $line3->DISKON;?>" style="width:80px;text-align:right;" onKeyUp="hitungDiskon()"></td>
                      <td><div align="right"><strong>Diskon Int</strong></div></td>
					  <!--class="validate[required,custom[onlyFloat],lengthCheck[6]] text-input"-->
                      <td><input name="diskoninternal[]" value="<?php echo $line3->DISKON_INT;?>" type="text" id="diskoninternal<?php echo $i;?>" class="diskoninternal<?php echo $i;?>" style="width:80px;text-align:right;" onKeyUp="hitungDiskonInternal()"></td>
					  <td><div align="right"><strong>PPN 10%</strong></div></td>
					  <td><input name="ppn[]" type="text" id="ppn<?php echo $i;?>" class="ppn<?php echo $i;?>" readonly="" value="<?php echo $line3->PPN;?>" style="width:80px;text-align:right;"></td>
                      <td><div align="right"><strong>BBN</strong></div></td>
                      <td><input name="bbn[]" type="text" id="bbn<?php echo $i;?>" class="bbn<?php echo $i;?>" readonly="" value="<?php echo $line3->BBN;?>" style="width:100px;text-align:right;">  </td>
                      </tr>
                      <tr>
					  <td><br/></td>
					  </tr>
					  <tr>
					  <td colspan=3><div align="right"><strong>Grand Total</strong></div></td>
                      <td><input name="grandtotal[]" type="text" id="grandtotal<?php echo $i;?>" class="grandtotal<?php echo $i;?>" value="<?php echo $line3->GRANDTOTAL;?>" style="width:100px;text-align:right;"></td>
                      </tr>
					  <?php
					  if ($i==1){?>
                      <a class="plus" style="visibility:hidden" href="#">[Add]</a></td>
					  <a class="minus" style="visibility:hidden" href="#">[Remove]</a></td>
					 <?php }
					  else {?>
					  <a class="minus" style="visibility:hidden" href="#">[Remove]</a></td>
					  <?php }?>
                    </tr>
					  <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  </table>
					  </p>
					  </div>
					  <?php
					  $j=$j+5;
					  }
					  ?>
					 <?php
					
					$max = $db->maxOf("count", "trjualpart", "no_nota='$line->NO_NOTA'");
					for($k=1; $k<=$max; $k++)
					{
						$line8 = $db->queryUniqueObject("SELECT * FROM trjualpart WHERE no_nota='$line->NO_NOTA' and count=$k");
					?>
					  <div class="containerkelengkapan">
				  	  <p class="kelengkapan">
				  	  <table style="visibility:hidden">
					  <tr>  
                      <td><div align="left"><strong>Kelengkapan:</strong></div></td>
                      <td>
					  <?php $kelengkapan = $db->getKelengkapan(); $kelengkapanganti=str_replace("kd_part1","kd_part"+$k,$kelengkapan);$kd_part = $line8->KD_PART; $sebelum = '<option value="'.$kd_part.'">'; $sesudah = '<option value="'.$kd_part.'" selected>'; $seleksi = str_replace($sebelum,$sesudah,$kelengkapanganti); echo $seleksi?>
					  </td>
					  </tr>
					  <?php
					  if ($k==1){?>
					  <a class="pluskelengkapan" style="visibility:hidden" href="#">[Tambah Kelengkapan]</a></td>
					  <?php }
					  else {?>
					  <a class="pluskelengkapan" style="visibility:hidden" href="#">[Kurangi Kelengkapan]</a></td>
					  <?php }?>
					  </table>
					  </p>
					  </div>
					  <?php
					  }
					  ?>
					  <br/>
					   <?php
					
					$max = $db->maxOf("count", "trjualpromo", "no_nota='$line->NO_NOTA'");
					for($l=1; $l<=$max; $l++)
					{
						$line9 = $db->queryUniqueObject("SELECT * FROM trjualpromo WHERE no_nota='$line->NO_NOTA' and count=$l");
					?>
					  <div class="containerpromo">
				  	  <p class="promo">
				  	  <table style="visibility:hidden">
					  <tr>  
                      <td><div align="left"><strong>Promo:</strong></div></td>
                      <td>
					  <?php $promo = $db->getPromo();$promoganti=str_replace("kd_promo1","kd_promo"+$l,$promo);$kd_promo = $line9->KD_PROMO; $sebelum = '<option value="'.$kd_promo.'">'; $sesudah = '<option value="'.$kd_promo.'" selected>'; $seleksi = str_replace($sebelum,$sesudah,$promoganti); echo $seleksi?>
					  </td>
					  </tr>
					  <?php
					  if ($l==1){?>
					  <a class="pluspromo" style="visibility:hidden" href="#">[Tambah Promo]</a></td>
					  <?php }
					  else {?>
					  <a class="minuspromo" style="visibility:hidden" href="#">[Kurangi Promo]</a></td>
					  <?php }?>
					  </table>
					  </p>
					  </div>
					  <?php
					  }
					  ?>
					  
					<br/>
					<table style="visibility:hidden">
					<tr>
					<td><input type="checkbox" id="stnk" name="stnk" <?php if($line->STNK=="1"){echo "checked";}?> value="<?php if($line->STNK=="1"){echo '1';} else{echo '0';}?>" onChange="gantiSTNK(this)">Nama STNK</input></td>
					</tr>
					</table>
					<table width="800" border="0" align="center" cellpadding="0" cellspacing="0"  id="stnkbeda" style="margin-left:20px;visibility:hidden">
					<tr>
					<?php 
					  $line11 = $db->queryUniqueObject("SELECT * FROM trjualstnk WHERE no_nota='$line->NO_NOTA'");	
					  ?>
						<td width="150px">No KTP:</td>
						<td width="195"><input type="text" id="noktp" name="noktp" value="<?php echo $line11->NO_KTP;?>" style="width:70px;"></td>
						<td width="150px">Nama:</td>
						<td width="195"><input type="text" id="namaktp" name="namaktp" value="<?php echo $line11->NAMA;?>" style="width:70px;"></td>
						<td width="150px">Alamat:</td>
						<td width="195"><input type="text" id="alamatktp" name="alamatktp" value="<?php echo $line11->ALAMAT;?>" style="width:70px;"></td>
						<td width="150px">Telepon:</td>
						<td width="195"><input type="text" id="telepon" name="telepon" value="<?php echo $line11->TELPON;?>" style="width:70px;"></td>
					  </tr>
					  <tr>
					  <td width="150px">Kelurahan:</td>
					  <td width="195"><input type="text" id="kelurahan" name="kelurahan" value="<?php echo $line11->KELURAHAN;?>" style="width:70px;"></td>
					  <td width="150px">Kecamatan:</td>
					  <td width="195"><input type="text" id="kecamatan" name="kecamatan" value="<?php echo $line11->KECAMATAN;?>" style="width:70px;"></td>
					  <td width="150px">Kota:</td>
					  <td width="195"><input type="text" id="kota" name="kota" value="<?php echo $line11->KOTA;?>" style="width:70px;"></td>
					  <td width="150px">Provinsi:</td>
					  <td width="195"><input type="text" id="provinsi" name="provinsi" value="<?php echo $line11->PROVINSI;?>" style="width:70px;"></td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td width="150px">Tgl Lahir:</td>
					<td width="195"><input type="text" id="tgl_lahir" name="tgl_lahir" value="<?php echo date('d-m-Y',strtotime($line11->TGL_LAHIR));?>" style="width:70px;"></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr>
					<br/>
					
				
                </form>
				<?php
}
?>
				
			
		

</body>
</html>
<?php
		}
?>