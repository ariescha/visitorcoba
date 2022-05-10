<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://live.staticflickr.com/65535/52062012277_cef3575aeb_o.jpg" class="logo" alt="My Logo">
@else
{{$slot}}
@endif
</a>
</td>
</tr>
