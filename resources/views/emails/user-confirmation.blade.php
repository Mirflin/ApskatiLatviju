<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lietotāja konta izveides apstiprinājums</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0;">
    <main style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <div style="background: linear-gradient(90deg, #ffaa00, #ff8f05); padding: 20px; border-radius: 8px 8px 0 0; text-align: center;">
            <h2 style="color: #ffffff; margin: 0; font-size: 24px;">Sveiciens, {{ $user->name }}!</h2>
        </div>
        <div style="padding: 20px;">
            <p style="color: #333;">Jūsu konts ir veiksmīgi izveidots. Lūdzu, saglabājiet šādu informāciju:</p>

            <h3 style="color: #ff9e1f; font-size: 18px; margin-bottom: 10px;">Lietotāja detaļas</h3>
            <ul style="padding-left: 20px; margin: 0; color: #333;">
                <li><strong>Vārds:</strong> {{ $user->name }}</li>
                <li><strong>E-pasts:</strong> {{ $user->email }}</li>
                <li><strong>Pagaidu parole:</strong> {{ $password }}</li>
            </ul>

            <p style="color: #333; margin-top: 20px;">Lūdzu, nomainiet paroli pēc pirmās pieteikšanās, lai nodrošinātu savu kontu. Lai pieteiktos, apmeklējiet mūsu mājaslapu un izmantojiet savus akreditācijas datus.</p>

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