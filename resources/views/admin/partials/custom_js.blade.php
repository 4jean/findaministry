<script>

    {{--Notifications--}}

    @if (session('flash_info'))
        flashInfo("{{ session('flash_info') }}");
    @endif

    @if (session('flash_success'))
        flashSuccess("{{ session('flash_success') }}");
    @endif

    @if (session('flash_warning'))
        flashWarning("{{ session('flash_warning') }}");
    @endif

    @if (session('flash_error') || session('flash_danger'))
        flashDanger("{{ session('flash_danger') }}");
    @endif

    function flash(data){
        new PNotify({
            text: data.msg,
            addclass: 'bg-'+data.type+' border-'+data.type,
            hide : data.type !== "danger"
        });
    }

    function flashSuccess(message) {
        return flash({ msg:message, type:'success' })
    }
    function flashDanger(message) {
        return flash({ msg:message, type:'danger' })
    }
    function flashInfo(message) {
        return flash({ msg:message, type:'info' })
    }
    function flashWarning(message) {
        return flash({ msg:message, type:'warning' })
    }
    function flashPrimary(message) {
        return flash({ msg:message, type:'primary' })
    }

    {{-- Delete Item --}}
    $('.delete-item').on('click', function(){

        let notice = setupPNotifyConfirm();
        let $this = $(this);

        notice.get().on('pnotify.confirm', function() {
            $.ajax({
                url: $this.data('url'),
                type:'DELETE',
                data:{ _token : '{{ csrf_token() }}', id : $this.data('id') },
                success:function(){
                    $this.closest('tr').fadeOut('slow');
                    flashSuccess('Record Deleted Successfully')
                }
            });
        });

        notice.get().on('pnotify.cancel', function() {

        });

    });

    function setupPNotifyConfirm(){
        return new PNotify({
            title: 'Confirmation',
            text: '<p>Are you sure you want to proceed?</p>',
            hide: false,
            type: 'warning',
            confirm: {
                confirm: true,
                buttons: [
                    {
                        text: 'Yes',
                        addClass: 'btn btn-sm btn-primary'
                    },
                    {
                        addClass: 'btn btn-sm btn-link'
                    }
                ]
            },
            buttons: {
                closer: false,
                sticker: false
            }
        });
    }

    $('#ajax_country_code').on('change', function(){
        getCountryStates(this.value);
    });

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

            }
        })
    }

    /* Generate Sitemap */
    $('#gen-sitemap').on('click', function(){
        flashDanger("Generating SiteMap");
        $.get("{{ route('sitemap') }}", function (resp) {
            return flashSuccess(resp)
        })
    });

</script>
