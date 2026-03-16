<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Request a Quote Submission</title>
</head>
<body style="margin:0; padding:0; background:#f4f4f4; font-family: Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4; padding:20px;">
    <tr>
        <td align="center">

            <!-- MAIN CONTAINER -->
            <table width="700" cellpadding="0" cellspacing="0" style="background:#ffffff; border:1px solid #dddddd; border-radius:6px;">

                <!-- HEADER -->
                <tr>
                    <td style="padding:20px; border-bottom:1px solid #e0e0e0;">
                        <h2 style="margin:0; font-size:18px; color:#333;">New Request a Quote Lead</h2>
                        <p style="margin:5px 0 0; font-size:13px; color:#666;">
                            Submission Date: <strong><?= date('d/m/Y', strtotime($data['created_at'])) ?></strong>
                        </p>
                    </td>
                </tr>

                <!-- BASIC INFO -->
                <tr>
                    <td style="padding:20px;">
                        <table width="100%" cellpadding="6" cellspacing="0">

                            <tr>
                                <td width="40%" style="font-weight:bold; color:#555;">Existing Customer?</td>
                                  <td><?= $data['existing_customer'] ?? 'No' ?></td>
                                
                            </tr>

                            <tr>
                                <td style="font-weight:bold; color:#555;">Inquiry About</td>
                                <td><?= $data['inquery_about'] ?? '-' ?></td>
                            </tr>

                        </table>
                    </td>
                </tr>

                <!-- PRODUCT INFO -->
                <tr>
                    <td style="background:#f0f2f5; padding:12px 20px; font-weight:bold; color:#333;">
                        Product Information
                    </td>
                </tr>

                <tr>
                    <td style="padding:20px;">
                        <table width="100%" cellpadding="6" cellspacing="0">

                            <tr>
                                <td width="40%" style="font-weight:bold;">Product</td>
                                <td><?= $data['pro_name'] ?? '-' ?></td>
                            </tr>

                            <tr>
                                <td style="font-weight:bold;">Team / Association / Company</td>
                                <td><?= $data['TAC_name'] ?? '-' ?></td>
                            </tr>

                            <tr>
                                <td style="font-weight:bold;">Project Description</td>
                                <td><?= $data['description'] ?? '-' ?></td>
                            </tr>

                        </table>
                    </td>
                </tr>

                <!-- SERVICE INFO -->
                <tr>
                    <td style="background:#f0f2f5; padding:12px 20px; font-weight:bold; color:#333;">
                        Service Information
                    </td>
                </tr>

                <tr>
                    <td style="padding:20px;">
                        <table width="100%" cellpadding="6" cellspacing="0">

                            <tr>
                                <td width="40%" style="font-weight:bold;">Quantity</td>
                                <td><?= $data['qty'] ?? '-' ?></td>
                            </tr>

                            <tr>
                                <td style="font-weight:bold;">Due Date</td>
                                <td><?= !empty($data['due_date']) ? date('d/m/Y', strtotime($data['due_date'])) : '-' ?></td>
                            </tr>

                        </table>
                    </td>
                </tr>

                <!-- CONTACT INFO -->
                <tr>
                    <td style="background:#f0f2f5; padding:12px 20px; font-weight:bold; color:#333;">
                        Contact Information
                    </td>
                </tr>

                <tr>
                    <td style="padding:20px;">
                        <table width="100%" cellpadding="6" cellspacing="0">

                            <tr>
                                <td width="40%" style="font-weight:bold;">Name</td>
                                <td><?= $data['name'] ?? '-' ?></td>
                            </tr>

                            <tr>
                                <td style="font-weight:bold;">Email</td>
                                <td>
                                    <a href="mailto:<?= $data['email'] ?? '' ?>" style="color:#1a73e8; text-decoration:none;">
                                        <?= $data['email'] ?? '-' ?>
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td style="font-weight:bold;">Phone</td>
                                <td><?= $data['phone_no'] ?? '-' ?></td>
                            </tr>


                            <tr>
                                 <td style="font-weight:bold;">State</td>
                                 <td><?= $data['state_name'] ?? '-' ?></td>
                            </tr>

                            <tr>
                                 <td style="font-weight:bold;">City</td>
                                 <td><?= $data['city'] ?? "" ?></td>
                            </tr> 

                            <tr>
                                 <td style="font-weight:bold;">Country</td>
                                 <td><?= $data['country_name'] ?? "" ?></td>
                            </tr>

                        </table>
                    </td>
                </tr>

                  <!-- sales representative -->

                 <tr>

                    <td style="background:#f0f2f5; padding:12px 20px; font-weight:bold; color:#333;">
                        SALES REPRESENTATIVE
                    </td>
                </tr>
                <tr>
                      <td style="padding:20px;">
                           <table width="100%" cellpadding="6" cellspacing="0">
                              <tr>
                                    <td>Do you currently work with a JOIN OUR GAME sales representative?</td>
                                     <td><?= $data['work_with_jog_status'] ??  'No'?></td>
                              </tr>
                           </table>
                      </td>
                </tr>

                <!-- FOOTER META -->
                <tr>
                    <td style="padding:15px 20px; border-top:1px solid #e0e0e0; font-size:12px; color:#666;">
                        <table width="100%" cellpadding="4">
                            <tr>
                                <td><strong>Brand:</strong> Join Our Game</td>
                                <td><strong>Lead Source:</strong> Website</td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Existing Rep:</strong> <?= $data['work_with_jog'] ?? '-' ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
            <!-- END CONTAINER -->

        </td>
    </tr>
</table>

</body>

</html>
