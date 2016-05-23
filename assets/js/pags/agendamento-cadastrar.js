/* Custom JavaScript */
$(document).ready(function($)
{
	$('#data').mask('00/00/0000');
	$('#hora').mask('00:00');

	consultar('#formListarMedico', '', 'json', function(){}, retornoListarMedico);

	var form = $('#formCadastrarAgendamento');

	form.validate({
		rules: {
			"agendamento[paciente_usuario]": {
				required: true,
				minlength: 1,
				maxlength: 20
			},
			"agendamento[hora]": {
				required: true
			},
			"agendamento[data]": {
				required: true
			},
			"agendamento[tipo]": {
				required: true,
				minlength: 1,
				maxlength: 1
			},
			"agendamento[medico_usuario]": {
				required: true,
				minlength: 1,
				maxlength: 10
			}
		}
	});

	$('.btn-primary').click(function(event)
	{
		event.preventDefault();
		if(form.valid())
		{
			salvar(form, 'json', antesEnviar('#resposta', '.loading'), retornoAgendamentoCadastrar);
		}
		else
		{
			form.validate().focusInvalid();
		}
	});
});

function retornoAgendamentoCadastrar(resp, error)
{
	console.log('aaaa');
	var form = $('#formCadastrarAgendamento');
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

function retornoListarMedico(resp, error)
{
	var datasHTML = '';
	resp.forEach(function(item, i)
	{
		datasHTML += '<option value="'+item.usuario+'">'+item.nome+' - '+item.crm+'</option>';
	});

  	$('#listarMedico').append(datasHTML);
} 