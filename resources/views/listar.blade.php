<table border=1>
@foreach($productos as $prod)
    <tr>
        <td>{{$prod->nombre}}</td>
        <td>{{$prod->precio}}</td>
        <td>{{$prod->categoria}}</td>
    </tr>
@endforeach
</table>    
