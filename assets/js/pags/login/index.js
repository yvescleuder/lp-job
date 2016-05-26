/* Custom JavaScript */
$(document).ready(function()
{
	var form = $('#formLogar');

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
			}
		}
	});

	$('#botaoLogar').click(function(event)
	{
		event.preventDefault();
		if(form.valid())
		{
			salvar(form, 'json', antesEnviar('#resposta', '.loading'), retornoLogar);
		}
		else
		{
			form.validate().focusInvalid();
		}
	});
});

function retornoLogar(resp, error)
{
	var form = $('#formLogar');
	var resposta = resp.msg.texto;
	loading('.loading', 0);
	if(resp.msg.tipo == 's')
	{
		window.location.href = resp.msg.texto;
	}
	else
	{
		swal({ title: "Erro!", text: resposta, html: true, type: 'error'});
	}
}