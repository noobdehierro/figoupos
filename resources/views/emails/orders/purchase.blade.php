@component('mail::message')
# Solicitud de activación de tarjeta SIM.

@component('mail::panel')
Detalles de la orden <strong style="color: #007bff!important">#{{ $order->id }}</strong>
<p>ID Plan: <small style="color: #b187ff!important">{{ $order->qv_offering_id }}</small></p>
@endcomponent

<table style="width: 100%">
<tr>
<td style="width: 50%">Status: </td>
<td>{{ $order->status }}</td>
</tr>
<tr>
<td>Tipo: </td>
<td>{{ $order->sales_type }}</td>
</tr>
<tr>
<td>Vendedor: </td>
<td>{{ $order->user_name }}</td>
</tr>
<tr>
<td>Fecha de operación: </td>
<td>{{ $order->created_at }}</td>
</tr>
<tr>
<td>Método de pago: </td>
<td><span style="color: #b187ff!important">{{ $order->payment_method }}</span></td>
</tr>
<tr>
<td>Referencia: </td>
<td><span style="color: #b187ff!important">{{ $order->payment_id }}</span></td>
</tr>
<tr>
<td>Total: </td>
<td><strong style="color: #000000!important">${{ $order->total }} MXN</strong></td>
</tr>
</table>

@component('mail::panel')
Datos del cliente
@endcomponent

<table style="width: 100%">
<tr>
<td style="width: 50%">Nombre: </td>
<td>{{ $order->name }} {{ $order->lastname }}</td>
</tr>
<tr>
<td>Correo electrónico: </td>
<td>{{ $order->email }}</td>
</tr>
<tr>
<td>Teléfono: </td>
<td>{{ $order->telephone }}</td>
</tr>
<tr>
<td>Fecha de nacimiento: </td>
<td>{{ $order->birday }}</td>
</tr>
<tr>
<td>Calle y número: </td>
<td>{{ $order->street }} {{ $order->outdoor }} {{ $order->indoor }}</td>
</tr>
<tr>
<td>Colonia y municipio: </td>
<td>{{ $order->suburb }} {{ $order->city }}</td>
</tr>
<tr>
<td>CP y estado: </td>
<td>{{ $order->postcode }} {{ $order->region }}</td>
</tr>
<tr>
<td>Referencias: </td>
<td>{{ $order->references }}</td>
</tr>
</table>

@component('mail::panel')
Tarjeta SIM y producto
@endcomponent

<table style="width: 100%">
<tr>
<td style="width: 50%">ICCID</td>
<td>{{ $order->iccid }}</td>
</tr>
<tr>
<td>IMEI</td>
<td>{{ $order->imei }}</td>
</tr>
<tr>
<td>Msisdn</td>
<td>{{ $order->msisdn }}</td>
</tr>
</table>
<br />
<hr />
<br />
Gracias y disfrutalo,<br>
<h2>{{ $order->brand_name }}</h2>

@endcomponent
