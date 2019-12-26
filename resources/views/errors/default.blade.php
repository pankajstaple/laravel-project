<h2>
	ERROR CODE: {{$exception->getCode()}}<br>
	ERROR: {{ $exception->getTraceAsString() }}</h2>
<br><a href="{{route('/')}}">Go Home</a>