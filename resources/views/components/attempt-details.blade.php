@props(['attempt'])

<div class='attempt'>
    <p>
        @if($attempt['successful'])
            <span class="successLogin">Successful</span>
        @else 
            <span class="failedLogin">Failed</span>
        @endif
        login attempt {{$attempt['date']}}
    </p>
    <!--<div class={"attempt-details "+ (showDetails ? 'active' : '')}>-->
    <div class="attempt-details active">
        <p>Adres IP: {{$attempt['ip_address']["address"]}}</p>
        <p>Urządzenie: {{$attempt['device']}}</p>
    </div>
    <!--{showDetails ? <FaCaretSquareDown class="expandAttempt" onClick={() => setShowDetails(!showDetails)}/> :
    <FaCaretSquareUp class="expandAttempt" onClick={() => setShowDetails(!showDetails)}/>}-->
</div>