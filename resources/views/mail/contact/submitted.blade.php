<p>Yeni bir iletişim formu mesajı alındı.</p>
<p><strong>Ad Soyad:</strong> {{ $payload['name'] }}</p>
<p><strong>E-posta:</strong> {{ $payload['email'] }}</p>
<p><strong>Telefon:</strong> {{ $payload['phone'] ?: 'Belirtilmedi' }}</p>
<p><strong>Konu:</strong> {{ $payload['subject'] }}</p>
<p><strong>Mesaj:</strong></p>
<p>{{ $payload['message'] }}</p>
