// This file was made to handle the autocomplete input
// and the related actions

// this function calculates the size of an object.
function ObjectSizeAutocomplete(obj) 
{
	var size = 0, key;
	for (key in obj) {
		if (obj.hasOwnProperty(key)) size++;
	}
	return size;
};

// ids and compare have to have the values at same level.
// ids[0] corresponds to compare[0]
var ids=[
	'fullname',
	'usuario',
	'usuarioHidden',
	'password-indicator-default',
	'passwordAgain',
	'SelectPerfil'
];
var compare =[
	'NOMBRE',
	'USUARIO',
	'USERHIDDEN',
	'PASSWD',
	'CLAVE',
	'PERFIL'
];

$('#select-required').change(function()
{
	var UserSelected = this.value;
	//alert(UserSelected);
	$.getJSON('php/cargarUsuarios.php?userselected='+UserSelected, function(data) {
		/* called when request to archivo.php completes */
		for(var j=0;j<ObjectSizeAutocomplete(compare);j++)
			document.getElementById(ids[j]).value = data[0][compare[j]];		
	});
	
});