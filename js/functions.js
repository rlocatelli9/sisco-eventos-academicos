/* ////////////////////////////////////////////////////////////////////////////////////// */
function TamanhoMax(pos, tamideal) {
	var valor = document.getElementById(pos).value;
	var tamreal = valor.length;
	if (tamreal===tamideal) {
		document.getElementById(pos+1).focus();
	}
}
/* ////////////////////////////////////////////////////////////////////////////////////// */
function mudaCheckBox() {
	for (var j = 1; j <= 9; j++) {
		box = eval("document.form.area7" + j);
		box.checked = !box.checked;
	}
}
/* ////////////////////////////////////////////////////////////////////////////////////// */
function checkaTodos() {
for (var j = 1; j <= 9; j++) {
box = eval("document.form.area7" + j); 
if (box.checked === false) box.checked = true;
   }
}
/* ////////////////////////////////////////////////////////////////////////////////////// */
function limpaTodos() {
for (var j = 1; j <= 9; j++) {
box = eval("document.form.area7" + j); 
if (box.checked === true) box.checked = false;
   }
}
/* ////////////////////////////////////////////////////////////////////////////////////// */
function TamanhoMin(pos, tamMin) {
	var valor = document.getElementById(pos).value;
	var tamreal = valor.length;
	if (tamreal<=tamMin) {
		var pos = "'"+pos+"'";
		alert('Preencha corretamente o campo ' + pos + ' ' );
		putFocus(form,pos);
	}
}
/* ////////////////////////////////////////////////////////////////////////////////////// */
function putFocus(formInst, elementInst) {
	if (document.form.length > 0) {
		document.form.elements[elementInst].focus();
	}
}
/* ////////////////////////////////////////////////////////////////////////////////////// */
function checaEmail(emailStr) {
	var emailPat=/^(.+)@(.+)$/;
	var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]";
	var validChars="\[^\\s" + specialChars + "\]";
	var quotedUser="(\"[^\"]*\")";
	var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
	var atom=validChars + '+';
	var word="(" + atom + "|" + quotedUser + ")";
	var userPat=new RegExp("^" + word + "(\\." + word + ")*$");
	var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");
	var matchArray=emailStr.match(emailPat);
	if (matchArray===null) {
		return false;
	}
	var user=matchArray[1];
	var domain=matchArray[2];
	if (user.match(userPat)===null) {
		return false;
	}
	var IPArray=domain.match(ipDomainPat);
	if (IPArray!==null) {
		  for (var i=1;i<=4;i++) {
			if (IPArray[i]>255) {
			return false;
			}
		}
		return true;
	}
	var domainArray=domain.match(domainPat);
	if (domainArray===null) {
		return false;
	}
	var atomPat=new RegExp(atom,"g");
	var domArr=domain.match(atomPat);
	var len=domArr.length;
	if (domArr[domArr.length-1].length<2 || 
		domArr[domArr.length-1].length>3) {
	   return false;
	}
	if (len<2) {
	   var errStr="O endereço não mostra o hostname!";
	   return false;
	}
	return true;
}
/* ////////////////////////////////////////////////////////////////////////////////////// */
function verificaDataMaior(di1, mi2, ai3, df1, mf2, af3) {
	var diaInicio = document.getElementById(di1).value; 
	var mesInicio = (document.getElementById(mi2).value)-1; 
	var anoInicio = document.getElementById(ai3).value; 
	var diaFim = document.getElementById(df1).value; 
	var mesFim = (document.getElementById(mf2).value)-1; 
	var anoFim = document.getElementById(af3).value; 
	var dataInicio = new Date(); 
	dataInicio.setFullYear(anoInicio, mesInicio, diaInicio); 
	var dataFim = new Date(); 
	dataFim.setFullYear(anoFim, mesFim, diaFim); 
	if(dataInicio > dataFim) {
		return true;
	}
	else {
		return false;
	}
} 
/* ////////////////////////////////////////////////////////////////////////////////////// */
function limpaData(pos1, pos2, pos3) {
	document.getElementById(pos1).value='';
	document.getElementById(pos2).value='';
	document.getElementById(pos3).value='';
	document.getElementById(pos1).focus();
}
/* ////////////////////////////////////////////////////////////////////////////////////// */
function verificaData(pos, tipo) {
	if(tipo===1) {
		var pos1 = pos; 
		var pos2 = pos+1;
		var pos3 = pos+2;
	}
	if(tipo===2) {
		var pos1 = pos-1; 
		var pos2 = pos;
		var pos3 = pos+1;
	}
	if(tipo===3) {
		var pos1 = pos-2; 
		var pos2 = pos-1;
		var pos3 = pos;
	}
	var tamdia = document.getElementById(pos1).value.length; 
	var tammes = document.getElementById(pos2).value.length; 
	var tamano = document.getElementById(pos3).value.length;
	var tamtotal = tamdia+tammes+tamano;
	
	var myDayStr = document.getElementById(pos1).value; 
	var myMonthStr = (document.getElementById(pos2).value)-1; 
	var myYearStr = document.getElementById(pos3).value; 
	var myYearApos = parseInt(document.getElementById(pos3).value)+15;//18anos min
	myYearApos2 = myYearApos.toString();
	//var d = new Date();

	//var myMonth = new Array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'); 
	//var meuMes = new Array('janeiro','fevereiro','março','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro'); 
	//var myDateStr = myDayStr + ' ' + myMonth[(myMonthStr)] + ' ' + myYearStr; 
	//var minhaDataStr = myDayStr + ' de ' + meuMes[(myMonthStr)] + ' de ' + myYearStr; 
	var myDate = new Date(); 
	myDate.setFullYear( myYearStr, myMonthStr, myDayStr ); 
	var hoje = new Date();
	var diar18 = new Date();
	diar18.setFullYear( myYearApos2, myMonthStr, myDayStr );
	var d = new Date();
	d.setFullYear( d.getFullYear()-125, d.getMonth(), d.getDate() );

	//if( (hoje < myDate) && (tamtotal==8) ) {
		//var texto1 = 'Data "' + minhaDataStr + '" nÃƒÂ£o pode ser aceita!';
		//alert (texto1);
		//limpaData(pos1, pos2, pos3);
		//return 0;
	//}
	if( ( myDate.getMonth() !== myMonthStr ) && (tamtotal===8) ) { 
		//alert( 'Desculpe, mas "' + minhaDataStr + '" não é uma data válida.');
		limpaData(pos1, pos2, pos3);
		return 1;
	}
	else if( ((hoje-diar18) < 0) && (tamtotal===8) ) {
		//var texto1 = 'Data "' + minhaDataStr + '" não pode ser aceita!';
		//alert (texto1);
		limpaData(pos1, pos2, pos3);
		return 2;
	}
	else if( (d > myDate) && (tamtotal===8) ) {
		//var texto1 = 'Data "' + minhaDataStr + '" não pode ser aceita!';
		document.getElementById(pos3).focus();
		document.getElementById(pos3).value='';
		return 3;
	}
	else {
		return 4;
	}
}
/* ////////////////////////////////////////////////////////////////////////////////////// */
function validaCPF(cpf1,cpf2,cpf3,cpf4) {
	var tamcpf1 = document.getElementById(cpf1).value.length; 
	var tamcpf2 = document.getElementById(cpf2).value.length; 
	var tamcpf3 = document.getElementById(cpf3).value.length; 
	var tamcpf4 = document.getElementById(cpf4).value.length;
	var cpf = document.getElementById(cpf1).value + document.getElementById(cpf2).value + document.getElementById(cpf3).value + document.getElementById(cpf4).value;
	if ( (tamcpf1+tamcpf2+tamcpf3+tamcpf4) === 11) {
		var soma01 = 0;
		var multiplo01 = 2;
		var x = 0;
		var soma02 = 0;
		var multiplo02 = 2;
		var y = 0;
		for (i=8; i>=0; i--) {
			intchar01 = cpf.substr(i, 1);
			soma01 = soma01 + (intchar01*multiplo01);
			multiplo01++;
		}
		x = 11-(soma01%11);
		if(x===10 || x===11) x=0;
	
		for (i=9; i>=0; i--) {
			intchar02 = cpf.substr(i, 1);
			soma02 = soma02 + (intchar02*multiplo02);
			multiplo02++;
		}
		y = 11-(soma02%11);
		if(y===10 || y===11) y=0;
		
		intchar10 = cpf.substr(9, 1);
		intchar11 = cpf.substr(10, 1);
		if(x===intchar10 && y===intchar11) return true;
		else {
			document.getElementById(cpf1).value = '';
			document.getElementById(cpf2).value = '';
			document.getElementById(cpf3).value = '';
			document.getElementById(cpf4).value = '';
			return false;
		}
	}
		
}
/* ////////////////////////////////////////////////////////////////////////////////////// */
function VerificaEspaco(id) {
	var cont = 0;
	valor = document.getElementById(id).value;
	for (i = 0; i < valor.length ; i++) {
		if( valor.charAt(i) === ' ' ) cont++;
	}
	return cont;
}


