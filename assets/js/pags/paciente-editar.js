/* Custom JavaScript */
$(document).ready(function($)
{
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
			},
			"usuario[complemento]": {
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

	    $('#cidade_id').html(resp.msg.texto['cidade_nome']);

	    $('#estado_id').html(resp.msg.texto['estado_nome']);

	    $('#paciente_usuario').val(resp.msg.texto['usuario']);

	    consultar('#formBuscarConvenio', '', 'json', function(){}, retornoConvenio);
	}
	else
	{
		swal({ title: "Erro!", text: resposta, html: true, type: 'error'});
	}

	$('html, body').animate({scrollTop: $('.navbar-brand').offset().top }, 1000);
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