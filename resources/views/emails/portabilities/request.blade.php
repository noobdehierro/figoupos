@component('mail::message')
# Solicitud de portabilidad <strong style="color: #007bff!important">#{{ $portability->id }}</strong>

@component('mail::panel')
Datos del cliente
@endcomponent

<table style="width: 100%">
<tr>
<td style="width: 50%">Nombre completo: </td>
<td>{{ $portability->fullname }}</td>
</tr>
<tr>
<td style="width: 50%">Correo electrónico: </td>
<td>{{ $portability->email }}</td>
</tr>
<tr>
<td style="width: 50%">Msisdn: </td>
<td>{{ $portability->msisdn }}</td>
</tr>
<tr>
<td style="width: 50%">Msisdn temporal: </td>
<td>{{ $portability->msisdn_temp }}</td>
</tr>
</table>

@component('mail::panel')
Datos de la tarjeta SIM
@endcomponent

<table style="width: 100%">

<tr>
<td style="width: 50%">NIP: </td>
<td>{{ $portability->nip }}</td>
</tr>
<tr>
<td style="width: 50%">ICCID: </td>
<td>{{ $portability->iccid }}</td>
</tr>
<tr>
<td style="width: 50%">Fecha de solicitud: </td>
<td>{{ $portability->created_at }}</td>
</tr>
</table>

<br />
<hr />
<br />
Gracias y disfrutalo<br>

@endcomponent
