<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recordatorio de devolución de libro</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #f4f4f4; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
        <h1 style="color: #2c3e50; margin-bottom: 20px; text-align: center;">Recordatorio de devolución de libro</h1>
        
        <p style="margin-bottom: 15px;">Estimado/a <strong>{{ $bookReader->reader->names }}</strong>,</p>
        
        <p style="margin-bottom: 15px;">Le recordamos que el libro <strong style="color: #3498db;">"{{ $bookReader->book->title }}"</strong> debe ser devuelto el:</p>
        
        <p style="font-size: 18px; font-weight: bold; color: #e74c3c; text-align: center; margin: 20px 0;">
            @if ($bookReader->return_date instanceof \Carbon\Carbon)
                {{ $bookReader->return_date->format('d/m/Y') }}
            @else
                {{ \Carbon\Carbon\Carbon::parse($bookReader->return_date)->format('d/m/Y') }}
            @endif
        </p>
        
        <div style="background-color: #3498db; color: #ffffff; padding: 15px; border-radius: 5px; text-align: center; margin-top: 20px;">
            <p style="margin: 0;">Por favor, asegúrese de devolver el libro a tiempo para evitar multas y permitir que otros lectores puedan disfrutarlo.</p>
        </div>
    </div>
    
    <p style="text-align: center; color: #7f8c8d; font-size: 14px;">Gracias por usar nuestra biblioteca digital. ¡Esperamos verle pronto!</p>
    
    <div style="text-align: center; margin-top: 20px;">
        <p style="font-size: 12px; color: #95a5a6;">
            Si tiene alguna pregunta, no dude en contactarnos.<br>
            Teléfono: (502) 0000-0000 | Email: bibliojose18@gmail.com
        </p>
    </div>
</body>
</html>