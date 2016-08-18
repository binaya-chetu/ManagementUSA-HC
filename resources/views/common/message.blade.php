<!-- resources/views/common/message.blade.php -->

@if ($errors == 'success')
    <!-- Form Error List -->
    <div class="alert alert-success">
        <strong></strong>

        <br><br>

        <ul>
            @foreach ($messages->all() as $msg)
                <li>{{ $msg }}</li>
            @endforeach
        </ul>
    </div>
@endif