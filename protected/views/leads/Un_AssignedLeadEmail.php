<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lead Assignment Update</title>
</head>

<body style="margin:0; padding:0; background-color:#eef2f7; font-family: 'Segoe UI', Roboto, Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
<tr>
<td align="center">

    <!-- Main Card -->
    <table width="650" cellpadding="0" cellspacing="0" 
           style="background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 8px 24px rgba(0,0,0,0.06);">

        <!-- Blue Header -->
        <tr>
            <td style="background:linear-gradient(90deg, #2F50A3, #274183); padding:22px 30px;">
                <h2 style="margin:0; color:#ffffff; font-weight:600; font-size:20px; letter-spacing:0.3px;">
                    Lead Assignment Update
                </h2>
                <p style="margin:5px 0 0 0; color:#dbe9ff; font-size:13px;">
                    CRM Notification
                </p>
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td style="padding:35px 40px; color:#2f3e4d; font-size:14px; line-height:1.7;">
                
                <p style="margin-top:0;">
                    Dear <strong><?= htmlspecialchars($name) ?></strong>,
                </p>

                <p>
                    This is to inform you that the following lead has been 
                    <strong style="color:#d9534f;">unassigned</strong> from your account.
                </p>

                <!-- Highlight Box -->
                <table width="100%" cellpadding="0" cellspacing="0" 
                       style="margin-top:25px; background:#f4f8ff; border-left:4px solid #274183; border-radius:6px;">
                    <tr>
                        <td style="padding:20px;">

                            <table width="100%" cellpadding="6" cellspacing="0">

                                <tr>
                                    <td width="30%" style="color:#6c757d;">Lead Name</td>
                                    <td>:</td>
                                    <td style="font-weight:600;"><?= htmlspecialchars($data['name'] ?? "") ?></td>
                                </tr>

                                <tr>
                                    <td style="color:#6c757d;">Company</td>
                                    <td>:</td>
                                    <td><?= htmlspecialchars($data['TAC_name'] ?? "") ?></td>
                                </tr>

                                <tr>
                                    <td style="color:#6c757d;">Email</td>
                                    <td>:</td>
                                    <td><?= htmlspecialchars($data['email'] ?? "") ?></td>
                                </tr>

                                <tr>
                                    <td style="color:#6c757d;">Phone </td>
                                    <td>:</td>
                                    <td><?= htmlspecialchars($data['phone_no'] ?? "") ?></td>
                                </tr>

                                <tr>
                                    <td style="color:#6c757d;">Unassigned On</td>
                                    <td>:</td>
                                    <td><?= date('d M Y', strtotime($date)) ?></td>
                                </tr>

                            </table>

                        </td>
                    </tr>
                </table>

                <p style="margin-top:30px;">
                    If you require further clarification regarding this update, 
                    please contact your reporting manager or CRM administrator.
                </p>

                <p style="margin-bottom:0;">
                    Regards,<br>
                    <strong>Sales-Rep CRM System</strong>
                </p>

            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background:#f9fbff; padding:18px; text-align:center; font-size:12px; color:#8a94a6;">
                This is an automated system notification. Please do not reply to this email.
            </td>
        </tr>

    </table>

</td>
</tr>
</table>

</body>
</html>
