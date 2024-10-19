<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geminiの応答</title>
</head>
<body>
    <h3>入力文: {{ $sentence }}</h3>

    {{-- 結果表示 --}}
    <p>（結果）</p>
    {{ isset($response_text) ? $response_text : '' }}
</body>
</html>

