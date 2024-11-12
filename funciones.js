
// JavaScript Document

//como se puede impedir que se ingrese un dato no num�rico?
function LP_data(evt){
	var key = evt.which || evt.keyCode; // C�digo de tecla. 
	if ((key < 48 || key > 57) 
		//&& (key != 8 && key != '-')
	&& !(key == 8 || key == 45)
	){ // Si no es n�mero o retroceso
		if (evt.preventDefault) {
			evt.preventDefault();
		} else {
			evt.returnValue = false;
		}
	}
}
   
// !OJO! no puedo escribir aqui las funciones para validar formularios
// ya que no funciona
	