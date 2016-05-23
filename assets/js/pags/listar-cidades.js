function listarCidades()
{
	$('#estado_id').val($("#listarEstado option:selected" ).val());
	consultar('#formListarCidade', '', 'json', function(){}, retornoListarCidade);
}