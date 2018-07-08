<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 11/29/2016
 * Time: 5:44 PM
 */
use app\components\ActorDisplayWidget;
use app\components\HomeHeaderContentWidget;
use app\components\NavbarWidget;
use app\components\SimpleSearchWidget;
use app\models\Notifications;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'FastCast - Find an Actor, without the Drama';
?>
<!--- headerTop starts here --->
<div class="container-fluid">
    <?= HomeHeaderContentWidget::widget(['model' => !empty($user) ? $user : '']); ?>
    <!--- logo starts here --->
    <div class="row p-zero">
        <div class="logoTop col-md-12">
            <a href="<?= Yii::$app->urlManager->createUrl(['']) ?>">
                <span><img src="images/logoTop.png" alt="image not found"></span>
            </a>
        </div>
    </div>
    <!--- logo ends here --->

    <?= NavbarWidget::widget(['model' => !empty($user) ? $user : '', 'highlight' => 'actors']); ?>

</div><!--- header ends here --->


<!--- mainBody_container starts here --->
<div class="container-fluid p-zero">
    <!--- main_wrapper starts here --->
    <div class="container p-zero">
        <!--- find_Person_Category starts here --->
        <div class="row">
            <?= SimpleSearchWidget::widget(); ?>
        </div>
        <!--- find_Person_Category ends here --->

        <div class="row p-zero">
            <div class="featuredActor col-md-12 pull-left">
                <div class="col-md-12 p-zero">
                    <h4>Terms and Conditions</h4>
                </div>
                <div class="col-md-12" style="padding: 2% 2%">
                    <b><p>1. Introduction</p></b>

                    <p>These Website Standard Terms and Conditions written on this webpage shall manage your use of
                        this website. These Terms will be applied fully and affect to your use of this Website. By
                        using this Website, you agreed to accept all terms and conditions written in here. You must
                        not use this Website if you disagree with any of these Website Standard Terms and
                        Conditions.</p>

                    <p>Minors or people below 18 years old are not allowed to use this Website.</p>

                    <b><p>2. Intellectual Property Rights</p></b>

                    <p>Other than the content you own, under these Terms, FAST CAST and/or its licensors own all the
                        intellectual property rights and materials contained in this Website.</p>

                    <p>You are granted limited license only for purposes of viewing the material contained on this
                        Website.</p>

                    <b><p>3. Restrictions</p></b>
                    <p>You are specifically restricted from all of the following</p>

                    <ul>
                        <li>
                            <p>publishing any Website material in any other media;</p>
                        </li>
                        <li><p>selling, sublicensing and/or otherwise commercializing any Website material;</p>

                        </li>
                        <li><p>publicly performing and/or showing any Website material;</p>

                        </li>
                        <li><p>using this Website in any way that is or may be damaging to this Website;</p>

                        </li>
                        <li><p>using this Website in any way that impacts user access to this Website;</p>

                        </li>
                        <li><p>using this Website contrary to applicable laws and regulations, or in any way may
                                cause harm to the Website, or to any person or business entity;</p>

                        </li>
                        <li><p>engaging in any data mining, data harvesting, data extracting or any other similar
                                activity in relation to this Website;</p>

                        </li>
                        <li><p>using this Website to engage in any advertising or marketing.</p>

                        </li>
                    </ul>

                    <p>Certain areas of this Website are restricted from being access by you and FAST CAST may
                        further restrict access by you to any areas of this Website, at any time, in absolute
                        discretion. Any user ID and password you may have for this Website are confidential and you
                        must maintain confidentiality as well.</p>

                    <b><p>4. Your Content</p></b>
                    <p>In these Website Standard Terms and Conditions, “Your Content” shall mean any audio, video
                        text, images or other material you choose to display on this Website. By displaying Your
                        Content, you grant FAST CAST a non-exclusive, worldwide irrevocable, sub licensable license
                        to use, reproduce, adapt, publish, translate and distribute it in any and all media.</p>

                    <p>Your Content must be your own and must not be invading any third-party’s rights. FAST CAST
                        reserves the right to remove any of Your Content from this Website at any time without
                        notice.</p>

                    <b><p>5. No warranties</p></b>
                    <p>This Website is provided “as is,” with all faults, and FAST CAST express no representations
                        or warranties, of any kind related to this Website or the materials contained on this
                        Website. Also, nothing contained on this Website shall be interpreted as advising you.</p>

                    <b><p>6. Limitation of liability</p></b>
                    <p>In no event shall FAST CAST, nor any of its officers, directors and employees, shall be held
                        liable for anything arising out of or in any way connected with your use of this <a
                            href="http://www.unit-conversion.info///%22https://freedirectorysubmissionsites.com///"
                            data-mce-href="../../%22https:/freedirectorysubmissionsites.com/">Website</a> whether
                        such liability is under contract. FAST CAST, including its officers, directors and employees
                        shall not be held liable for any indirect, consequential or special liability arising out of
                        or in any way related to your use of this Website.</p>

                    <b><p>7. Indemnification</p></b>
                    <p>You hereby indemnify to the fullest extent FAST CAST from and against any and/or all
                        liabilities, costs, demands, causes of action, damages and expenses arising in any way
                        related to your breach of any of the provisions of these Terms.</p>

                    <b><p>8. Severability</p></b>
                    <p>If any provision of these Terms is found to be invalid under any applicable law, such
                        provisions shall be deleted without affecting the remaining provisions herein.</p>

                    <b><p>9. Variation of Terms</p></b>
                    <p>FAST CAST is permitted to revise these Terms at any time as it sees fit, and by using this
                        Website you are expected to review these Terms on a regular basis.</p>

                    <b><p>10. Assignment</p></b>
                    <p>The FAST CAST is allowed to assign, transfer, and subcontract its rights and/or obligations
                        under these Terms without any notification. However, you are not allowed to assign,
                        transfer, or subcontract any of your rights and/or obligations under these Terms.</p>

                    <b><p>11. Entire Agreement</p></b>
                    <p>These Terms constitute the entire agreement between FAST CAST and you in relation to your use
                        of this Website, and supersede all prior agreements and understandings.</p>

                    <b><p>12. Governing Law &amp; Jurisdiction</p></b>
                    <p>These Terms will be governed by and interpreted in accordance with the laws of the Province
                        of Ontario, and you submit to the non-exclusive jurisdiction of the Province and federal
                        courts located in Ontario for the resolution of any disputes.</p>
                </div>
            </div>
        </div><!--- row --->

    </div><!-- end container -->
</div><!--- ends main_container here --->