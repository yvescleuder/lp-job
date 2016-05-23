/* Custom JavaScript */
$(document).ready(function($)
{
	consultar('#formListarConvenio', '', 'json', function(){}, retornoListarConvenio);
	consultar('#formListarEstado', '', 'json', function(){}, retornoListarEstado);

	var form = $('#formCadastrarPaciente');

	form.validate({
		rules: {
			"usuario[usuario]": {
				required: true,
				minlength: 1,
				maxlength: 20
			},
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
			},
			"usuario[cidade_id]": {
				required: true,
				number: true,
				minlength: 1
			},
			"usuario[estado_id]": {
				required: true,
				number: true,
				minlength: 1
			}
		}
	});

	$('.btn-primary').click(function(event)
	{
		event.preventDefault();
		if(form.valid())
		{
			salvar(form, 'json', antesEnviar('#resposta', '.loading'), retornoPacienteCadastrar);
		}
		else
		{
			form.validate().focusInvalid();
		}
	});
});

function retornoListarEstado(resp, error)
{
	var datasHTML = '';
	resp.forEach(function(item, i)
	{
		datasHTML += '<option value="'+item.id+'">'+item.nome+'</option>';
	});

  	$('#listarEstado').append(datasHTML);
}

function retornoListarCidade(resp, error)
{
	var datasHTML = '';
	resp.forEach(function(item, i)
	{
		datasHTML += '<option value="'+item.id+'">'+item.nome+'</option>';
	});

  	$('#listarCidade').html(datasHTML);
}

function retornoPacienteCadastrar(resp, error)
{
	var form = $('#formCadastrarPaciente');
	var resposta = resp.msg.texto;
	loading('.loading', 0);
	if(resp.msg.tipo == 's')
	{
		swal({ title: "Sucesso!", text: resposta, html: true, type: 'success'});
		form.reset();
	}
	else
	{
		swal({ title: "Erro!", text: resposta, html: true, type: 'error'});
	}

	$('html, body').animate({scrollTop: $('.navbar-brand').offset().top }, 1000);	
}

function retornoListarConvenio(resp, error)
{
	var datasHTML = '';
	resp.forEach(function(item, i)
	{
		datasHTML += '<option value="'+item.id+'">'+item.nome+'</option>';
	});

  	$('#listarConvenio').append(datasHTML);
}