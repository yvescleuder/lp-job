/* Custom JavaScript */
$(document).ready(function($)
{
	consultar('#formListarPaciente', '', 'json', function(){}, retornoListarPaciente);

	var formBuscar = $('#formBuscarPaciente');

	formBuscar.validate({
		rules: {
			"usuario": {
				required: true,
				minlength: 1,
				maxlength: 20
			}
		}
	});

	var formDados = $('#formDadosPaciente');

	formDados.validate({
		rules: {
			"usuario[senha]": {
				required: true,
				minlength: 1,
				maxlength: 20
			},
			"usuario[convenio_id]": {
				required: true,
				number: true,
				minlength: 1,
				maxlength: 10
			},
			"usuario[nome]": {
				required: true,
				minlength: 4,
				maxlength: 100
			},
			"usuario[sobrenome]": {
				required: true,
				minlength: 4,
				maxlength: 100
			},
			"usuario[telefone1]": {
				required: true,
				minlength: 14,
				maxlength: 16
			},
			"usuario[telefone2]": {
				minlength: 14,
				maxlength: 16
			},
			"usuario[celular1]": {
				required: true,
				minlength: 14,
				maxlength: 16
			},
			"usuario[celular2]": {
				minlength: 14,
				maxlength: 16
			},
			"usuario[rua]": {
				required: true,
				minlength: 5,
				maxlength: 100
			},
			"usuario[numero]": {
				required: true,
				number: true,
				minlength: 1,
				maxlength: 10
			},
			"usuario[bairro]": {
				required: true,
				minlength: 5,
				maxlength: 100
			}
		}
	});

	$('#botaoBuscarPaciente').click(function(event)
	{
		event.preventDefault();
		if(formBuscar.valid())
		{
			consultar('#formListarEstado', '', 'json', function(){}, retornoListarEstado);
			consultar('#formBuscarPaciente', '', 'json', antesEnviar('#resposta', '.loading'), retornoBuscarPaciente);
		}
		else
		{
			formBuscar.validate().focusInvalid();
		}
	});

	$('#botaoSalvarAlteracoes').click(function(event)
	{
		event.preventDefault();
		if(formDados.valid())
		{
			salvar($('#formDadosPaciente'), 'json', antesEnviar('#resposta','.loading'), retornoSalvarAlteracoes);
		}
		else
		{
			formDados.validate().focusInvalid();
		}
	});
});

function ListarTodosEstados()
{
	$('#id_estado').val($("#estado_id option:selected").val());
	consultar('#formListarCidade', '', 'json', function(){}, retornoListarCidade);
}

function retornoListarEstado(resp, error)
{
	var datasHTML = '';
	resp.forEach(function(item, i)
	{
		datasHTML += '<option value="'+item.id+'">'+item.nome+'</option>';
	});

  	$('#estado_id').append(datasHTML);
}

function retornoSalvarAlteracoes(resp, error)
{
	var resposta = resp.msg.texto;
	loading('.loading', 0);
	if(resp.msg.tipo == 's')
	{
		swal({ title: "Sucesso!", text: resposta, html: true, type: 'success'});
	}
	else
	{
		swal({ title: "Erro!", text: resposta, html: true, type: 'error'});
	}
	$('html, body').animate({scrollTop: $('.navbar-brand').offset().top }, 1000);
	
}

function retornoBuscarPaciente(resp, error)
{
	var form = $('#formBuscarPaciente');
	var resposta = resp.msg.texto;
	loading('.loading', 0);
	if(resp.msg.tipo == 's')
	{
		$('#divBuscarPaciente').attr('class', 'hidden');
		$('#divDadosPaciente').removeClass('hidden');
		form.reset();

		for(var index in resp.msg.texto)
		{
	        $("#"+index).val(resp.msg.texto[index]);
	    }
	    $('#convenio_id').html(resp.msg.texto['convenio_nome']);
	    $('#paciente_id_editar').val(resp.msg.texto['convenio_id']);

	    $('#id_estado').val(resp.msg.texto.estado_id);

		consultar('#formListarCidade', '', 'json', function(){}, function(json, error){
			retornoListarCidade(json, error);
			$('#cidade_id').val(resp.msg.texto.cidade_id);
		});

	    $('#paciente_usuario').val(resp.msg.texto['usuario']);

	    consultar('#formBuscarConvenio', '', 'json', function(){}, retornoConvenio);
	}
	else
	{
		swal({ title: "Erro!", text: resposta, html: true, type: 'error'});
	}

	$('html, body').animate({scrollTop: $('.navbar-brand').offset().top }, 1000);
}

function retornoListarCidade(resp, error)
{
	var datasHTML = '';
	$('#cidade_id').html(datasHTML);

	resp.forEach(function(item, i)
	{
		datasHTML += '<option value="'+item.id+'">'+item.nome+'</option>';
	});

  	$('#cidade_id').append(datasHTML);
}
function retornoConvenio(resp, error)
{
	var datasHTML = '';
	resp.forEach(function(item, i)
	{
		datasHTML += '<option value="'+item.id+'">'+item.nome+'</option>';
	});

  	$('#listarConvenio').append(datasHTML);
}

function retornoListarPaciente(resp, error)
{
	var datasHTML = '';
	resp.forEach(function(item, i)
	{
		datasHTML += '<option value="'+item.usuario+'">'+item.nome+' '+item.sobrenome+' - ('+item.usuario+')</option>';
	});

  	$('#listarPaciente').append(datasHTML);
}