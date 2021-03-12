


<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    @media only screen and (min-width: 768px) {
        /*for desktop*/
        .e-margin {
            margin-left: 2%;
            margin-right: 2%;
            font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
        }
    }
    @media screen and (max-width: 768px) {
        /*for mobile n tablet*/
        .e-margin {
            margin-left: 2%;
            margin-right: 2%; /* The width is 100%, when the viewport is 800px or smaller */
            font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
        }
    }
    a:link{
      text-decoration: none !important;
    }
</style>
    <p class="e-margin">Dear {{$user['name']}}</p>
    <p class="e-margin">Greetings from BDO in India!</p>
    <p class="e-margin"></p>
    <p  class="e-margin">Based on this request, a user account was created with a username of {{$user['email']}} </p>
    <p class="e-margin">
        Please click the Activate button to upgrade & activate your existing user account and configure your single sign-on access for BDO India’s 
        
        <a target="_blank" href="https://taxtechhub.bdo.in/" style="text-decoration:none;">TaxTech Hub</a> solutions.
    
    
    </p>
    <p class="e-margin" style='margin-top:37px margin-bottom:37px;'>
        <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 >
            <tr>
                <td style='background:#ED1A3B;padding:9.0pt 9.0pt 9.0pt 9.0pt'>
                    <p class=MsoNormal>
                        <span style='font-size:10.0pt;font-family:"Trebuchet MS",sans-serif;color:black'>
                            <a href="{{url('/user/verifymail', $user->verifyUser->token)}}" target="_blank" style="text-decoration:none">
                                <b>
                                    <span style='font-size:10.5pt;font-family:"Arial",sans-serif;color:white;text-decoration:none'>ACTIVATE</span>
                                </b>
                            </a>
                        </span>
                        <o:p></o:p>
                    </p>
                </td>
            </tr>
        </table>
    </p>
    <p class="e-margin">
        <strong>
            Please note, your account will not be activated until you have completed this process. 
        </strong>
        <br/>
        For security reasons the activation link will expire after 1 days. If this occurs, contact your admin user to resend the account re-activation email
    </p>
    <p class='e-margin' style='text-align: center;font-size:12px;'>This is system generated notification. Please do not reply to this mail.</p>
    <p class='e-margin'style='text-align: center; font-size:12px;;'>
    The information contained in this communication is intended solely for the use of the individual or entity to whom it is addressed and others authorized to receive it.
    This communication may contain confidential or legally privileged information. 
    If you are not the intended recipient please notify us, preferably by e-mail, and do not read, copy or disclose the contents of this message to anyone.
    No liability is accepted for any harm that may be caused to your systems or data by this message.
</p>