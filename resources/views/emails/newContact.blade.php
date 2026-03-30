<h1>
    POST CREATO
</h1>
<ul>
    <li>
        {{ $lead->title }}
    </li>
    <li>
        {{ $lead->slug }}
    </li>
    <li>
        {{ $lead->description }}
    </li>
    <li>
        <img src="{{ $lead->image }}" alt="{{ $lead->title }}">
    </li>
</ul>
