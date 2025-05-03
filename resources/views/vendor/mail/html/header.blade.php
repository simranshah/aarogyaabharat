@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ env('APP_URL') . '/front/images/Favicon-new.svg' }}" class="logo" alt="Aarogyaa Bharat">

@else
{{ $slot }}
@endif
</a>
</td>
</tr>
