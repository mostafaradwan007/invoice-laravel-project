$(document).ready(function(){
        $('#client_id').on('change', function(){
            var clientId = $(this).val();
            if(clientId){
                $.ajax({
                    url: '{{ url("/projects-by-client") }}/' + clientId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#project_id').empty();
                        $('#project_id').append('<option value="">Select a project</option>');
                        $.each(data, function(key, value){
                            $('#project_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            } else {
                $('#project_id').empty();
                $('#project_id').append('<option value="">Select a project</option>');
            }
        });
    });