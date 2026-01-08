<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Bayar — Midtrans</title>
</head>
<body>
    <p>Memuat halaman pembayaran...</p>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script>
        if (window.snap && '{{ $token }}') {
            window.snap.pay('{{ $token }}', {
                onSuccess: function(res){
                    window.location = '/dashboard/anggota';
                },
                onPending: function(res){
                    window.location = '/dashboard/anggota';
                },
                onError: function(res){
                    window.location = '/dashboard/anggota';
                }
            });
        } else {
            // fallback: go back
            window.location = '/dashboard/anggota';
        }
    </script>
</body>
</html>
