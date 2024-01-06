<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cupom iFood</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #e44d26;
        }

        p {
            color: #333333;
        }

        .coupon-code {
            display: inline-block;
            padding: 10px;
            background-color: #d6d8d8;
            color: #ffffff;
            font-size: 18px;
            font-weight: bold;
            border-radius: 4px;
            margin-top: 20px;
        }

        .validity {
            color: #999999;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Prêmio Especial!</h1>
        <p>Prezado(a) {{ $client->name }},</p>
        <p>Parabéns! Você  ganhou do seguinte prêmio:</p>
        <p><strong>Descrição do Prêmio:</strong> {{ $award->description }}</p>
        <p><strong>Local do sorteio Prêmio:</strong> {{ $award->local }}</p>
        <p><strong>Valor prêmio:</strong> {{ $award->value }}</p>

        <p>Data do Prêmio:
            @if ($award->date_award instanceof \Carbon\Carbon)
                {{ $award->date_award }}
            @else
                {{ $award->date_award }}
            @endif
        </p>


        <div class="coupon-code">Valor do prêmio: {{ $award->value }}</div>
        <div class="coupon-code">Local para retirada do prêmio: {{ $award->local }}</div>
        <p>Obrigado por confiar em nós!</p>

        <p>Atenciosamente</p>
    </div>
</body>
</html>
