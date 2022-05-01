<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{URL::asset('/assets/img/logo-landscape.png')}}" class="logo" alt="My Logo">
@else
{{$slot}}
@endif
</a>
</td>
</tr>
