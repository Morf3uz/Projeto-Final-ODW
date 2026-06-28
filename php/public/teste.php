<?php
echo "<h2>Teste Final Supabase (Modo Pooler):</h2>";

$host = 'aws-1-us-east-2.pooler.supabase.com'; 
$port = '5432';
$dbname = 'postgres';
$user = 'postgres.gmvpufwucjmpcdfgyslu'; 
$pass = 'yRDzQS9JRtVP27s8'; 

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    echo "✅ <b>CONECTADO COM SUCESSO!</b>";
    echo "<br>O motor do Apache, as DLLs e as credenciais estão em perfeita harmonia.";

} catch (PDOException $e) {
    echo "❌ FALHOU.";
    echo "<br>Erro: " . $e->getMessage();
}