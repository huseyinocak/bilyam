<p>Yeni bir teklif talebi alindi.</p>
<p>Teklif No: <strong>{{ $quote->quote_no }}</strong></p>
<p>Firma / Talep Eden: {{ $quote->company_name ?: $quote->requester_name }}</p>
<p>Kalem Sayisi: {{ $quote->items()->count() }}</p>
