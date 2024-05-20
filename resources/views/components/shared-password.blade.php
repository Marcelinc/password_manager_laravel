@props(['password'])

<div class="password">
    <h2>Website: {{$password->website}}</h2>
    <p class='website-info'>
      <span class="sharedOwner">Shared from: {{$password->name}}</span>
      Login: {{isset($password->login) ? $password->login : 'Not set'}}
      <span class="sharedPassword">
      Password: <!--{decrypted ? decrypted : data.sh.id_password.password}--> {{$password->password}}
      </span>
    </p>
    <!--{decrypted ? <button onClick={() => setDecrypted('')}>Hide</button> : <button class='showPassword' onClick={showPassword} disabled={mode === 'Read'}>Show</button>}
    {form && <Popup><PasswordForm form={setForm} show={showPassword}/></Popup>}-->
  </div>