<h3>{{ $exception->getMessage() }}</h3>
<p>
    {{ $exception->getFile() }}#{{ $exception->getLine() }}
</p>