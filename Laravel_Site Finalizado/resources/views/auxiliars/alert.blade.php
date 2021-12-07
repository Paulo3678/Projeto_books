{{-- Mensagens de erro/sucesso --}}
@if (session()->has('error_message'))
    <div class="alert alert-danger" role="alert" style="margin-top: 10px;">
        {{ session('error_message') }}
    </div>
@endif
@if (session()->has('success_message'))
    <div class="alert alert-success" role="alert" style="margin-top: 10px;">
        {{ session('success_message') }}
    </div>
@endif
