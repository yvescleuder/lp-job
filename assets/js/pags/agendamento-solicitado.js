/* Custom JavaScript */
$(document).ready(function($)
{

});

function cancelar(id)
{
	swal({
		title: "Você tem certeza?",
		text: "Você irá cancelar o agendamento",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Sim, cancelar",
		cancelButtonText: "Não",
		closeOnConfirm: false,
		showLoaderOnConfirm: true, },
		function()
		{
			$.ajax({
		        type: 'POST',
		        url: '../../app/action/alterar.php',
		        data:
		        {
		        	acao: 'cancelarAgendamento',
		        	agendamento_id: id

		        },
		        dataType: 'json',
		        beforeSend: function(){},
		        error: function(){swal("Erro!", "Ops.. Algo de errado aconteceu", "error")},
		        success: function(resp)
		        {
		        	var resposta = resp.msg.texto;
		        	if(resp.msg.tipo == 's')
		        	{
		        		swal("Cancelado!", resposta, "success")
		        	}
		        	else
		        	{
		        		swal("Erro!", resposta, "error")
		        	}
		        	// Recarrega a tabela
	        		$('#tabelaAgendamentoSolicitado').bootstrapTable('refresh');
		        }
		    });
		}
	);
}