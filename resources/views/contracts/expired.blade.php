@extends('layouts.app')
@section('title','Expired Contracts')

@section('content')
    <div class="col-md-12 mt-1 mx-auto justify-content-between">
        <div class="card card-success card-outline">
            <div class="table table-responsive">
                <div class="card-body">
                    <div class="text-center" id="loading">
                        <b-spinner style="width: 3rem; height: 3rem;" variant="primary"></b-spinner>
                    </div>
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{$dataTable->scripts()}}
    <script>
        $(document).ready(function () {
            $('#loading').hide();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function (){
            $('.card').on('submit','.renewalForm', function (e){
                e.preventDefault();
                $.ajax({
                    type:"POST",
                    url:"/contract",
                    data:$(this).serialize(),
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success:function (response){
                        if(response.status == 0){
                            $.each(response.error,function (prefix,val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }else {
                            $('.modal').modal('hide')
                            swal.fire(
                                'Success!',
                                'Record saved successfully.',
                                'success'
                            )
                            window.location="{{ route('contract.expired') }}";
                        }
                    },
                    error:function (error){
                        swal.fire({
                            title: 'Error',
                            text: "Cannot save data, try again!",
                            icon: 'error'
                        });
                    }
                });
            });
        });
    </script>
@endpush

