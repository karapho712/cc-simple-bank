@extends('layout.app')

@section('content')
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Withdraw</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="withdrawal-form">
                <div class="card-body">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" step=".01" name="amount" class="form-control">
                        <input id="OrderId" type="text" style="display: none" name="order_id"
                            value="{{ auth()->user()->id }}-{{ ($latest->id ?? 0) + 1 }}" class="form-control">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button id="SubmitButton" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

    </div>
    <!-- /.card -->
    </div>
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            $('#withdrawal-form').on('submit', function(event) {
                event.preventDefault();
                const buttonSubmit = $('#SubmitButton');
                buttonSubmit.prop('disabled', true);

                const objectData = {};
                const formData = new FormData(this).forEach((value, key) => objectData[key] = value);
                objectData['timestamp'] = Date.now() / 1000 | 0;
                $.ajax({
                    url: "{{ route('api.withdrawal') }}",
                    timeout: 7000,
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': "Bearer {{ base64_encode(auth()->user()->name) }}"
                    },
                    method: "POST",
                    data: JSON.stringify(objectData),
                    dataType: "json",
                    success: function(data) {
                        $("form").trigger("reset");

                        const userId = {{ auth()->user()->id }};
                        const newOrderId = userId + '-' + (data.id + 1);

                        $('#OrderId').val(newOrderId);

                        $(document).Toasts('create', {
                            class: 'bg-success',
                            title: 'Withdraw',
                            // subtitle: 'Deposit',
                            body: 'Balance update',
                            autohide: true,
                            delay: 3000
                        })
                    },
                    complete: function(data) {
                        buttonSubmit.prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseJSON.message);
                        $(document).Toasts('create', {
                            class: 'bg-danger',
                            title: 'Error',
                            body: xhr.responseJSON.message,
                            autohide: true,
                            delay: 3000
                        })
                    }
                });
            });
        })
    </script>
@endsection
