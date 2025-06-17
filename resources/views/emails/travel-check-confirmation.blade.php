<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ceļojuma čeka apstiprinājums</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0;">
    <main style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <div style="background: linear-gradient(90deg, #ffaa00, #ff8f05); padding: 20px; border-radius: 8px 8px 0 0; text-align: center;">
            <h2 style="color: #ffffff; margin: 0; font-size: 24px;">Paldies par jūsu pieteikumu!</h2>
        </div>
        <div style="padding: 20px;">
            <p style="color: #333;">Cienījamais klients,</p>
            <p style="color: #333;">Jūsu ceļojuma pieteikums ir veiksmīgi apstrādāts. Šeit ir jūsu čeka informācija:</p>

            <h3 style="color: #ff9e1f; font-size: 18px; margin-bottom: 10px;">Ceļojuma detaļas</h3>
            <ul style="padding-left: 20px; margin: 0; color: #333;">
                <li><strong>Nosaukums:</strong> {{ $travel->name }}</li>
                <li><strong>Pilsēta:</strong> {{ $travel->city }}</li>
                <li><strong>Cena:</strong> €{{ number_format($travel->price, 2) }}</li>
                <li><strong>Datums:</strong> {{ $travel->formattedTimeTerm() }}</li>
                <li><strong>Cilvēku skaits:</strong> {{ $check->people_count }} </li>
            </ul>

            <h3 style="color: #ff9e1f; font-size: 18px; margin-top: 20px; margin-bottom: 10px;">Čeka kods</h3>
<p style="background-color: #f4f7fa; padding: 10px; border-radius: 5px; color: #333; font-weight: bold; text-align: center;">{{ $check->code }}</p>
            <p style="color: #333;">Izmantojiet šo kodu, lai apskatītu savu čeku vai atstātu atsauksmi mūsu mājaslapā.</p>

            <p style="color: #333; margin-top: 20px;">Ja jums ir jautājumi, sazinieties ar mums pa e-pastu: 
                <a href="mailto:support@apskatilatviju.lv" style="color: #ff9e1f; text-decoration: none;">support@apskatilatviju.lv</a>.
            </p>

            <p style="color: #333; text-align: center; margin-top: 30px; border-top: 1px solid #ddd; padding-top: 10px;">
                Ar cieņu,<br><strong>Apskati Latviju!</strong>
            </p>
        </div>
    </main>
</body>
</html>