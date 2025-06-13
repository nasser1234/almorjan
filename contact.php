<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استلام بيانات النموذج
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // تحقق من البيانات
    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        http_response_code(400);
        echo "يرجى تعبئة النموذج بشكل صحيح.";
        exit;
    }

    // إعداد البريد الإلكتروني
    $to = "info@almorjanperfumes.com";  // عدل إلى بريدك
    $subject = "رسالة جديدة من موقع المرجان للعطور";
    $body = "الاسم: $name\n";
    $body .= "البريد الإلكتروني: $email\n\n";
    $body .= "الرسالة:\n$message\n";

    $headers = "From: $name <$email>";

    // إرسال البريد
    if (mail($to, $subject, $body, $headers)) {
        http_response_code(200);
        echo "شكرًا لتواصلك معنا، سنرد عليك قريبًا.";
    } else {
        http_response_code(500);
        echo "حدث خطأ أثناء إرسال الرسالة، حاول مرة أخرى.";
    }

} else {
    http_response_code(403);
    echo "هناك مشكلة في إرسال النموذج، يرجى المحاولة مرة أخرى.";
}
?>
