@props(['password'])

<div class="password">
    <h2>Website: {{$password->website}}</h2>
    <p class='website-info'>
      Login: {{isset($password->login) ? $password->login : 'Not set'}}
      <span class='password-field'>
        Password: <!--{decrypted ? decrypted : data.password}--> {{$password->password}} 
      </span>
    </p>
    <!--{decrypted ? <button onClick={() => setDecrypted('')}>Hide</button> : <button class='showPassword' onClick={show} disabled={modeContext.mode === 'Read'}>Show</button>}
      <button class='sharePassword' onClick={() => {modeContext.mode === 'Edit' && setShareForm(true)}} disabled={modeContext.mode === 'Read'}>Share</button>
    {form && <Popup><PasswordForm form={setForm} show={show}/></Popup>}
    {shareForm && <Popup><SharePasswordForm form={setShareForm} passwordId={data._id}/></Popup>}-->
  </div>