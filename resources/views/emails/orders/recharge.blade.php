@component('mail::message')
# Se realizo una recarga.

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
<td>{{ $order->email }}</td>
</tr>
</table>

@component('mail::panel')
Tarjeta SIM y producto
@endcomponent

<table style="width: 100%">
<tr>
<td style="width: 50%">Msisdn</td>
<td>{{ $order->msisdn }}</td>
</tr>
</table>
<br />
<hr />
<br />
Gracias y disfrutalo,<br>
<h2>{{ $order->brand_name }}</h2>

@endcomponent
