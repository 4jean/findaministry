<script>
    $("input#min_name").typeahead({
        ajax: {
            url: "{{ route('ajax.min_names') }}",
            timeout: 500,
            triggerLength: 1,
            method: "post",
            preDispatch: function (query) {
                return {
                    search: query,
                    '_token' : $('#csrf').attr('content')
                }
            },
            preProcess: function (data) {
                return data;
            }
        }
    });

    function setFavMin(min_id)
    {
        var url = '{{ route('set_fav_min') }}';

        $.ajax({
            type:'post',
            url: url,
            data: {min_id:min_id, '_token' : '{{csrf_token()}}'},
            success: function (resp) {  }
        })
    }

    function getCountryStates(country_code){
        var url = '{{ route('get_country_states', [':id']) }}';
        url = url.replace(':id', country_code);
        var country_state = $('#ajax_state');

        $.ajax({
            dataType: 'json',
            url: url,
            success: function (resp) {
                console.log(resp);
                country_state.empty();
                $.each(resp, function (i, data) {
                    country_state.append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });
                country_state.selectpicker('refresh', 'render');

            }
        })
    }

</script>

@if($page_title == 'Home' || Route::is('show_ministry'))
    <script>
        $(window).load(function(){
            initializeOwl(false);
        });
    </script>
@endif
