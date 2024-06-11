<h2 class="popup-header">Add password</h2>
<form action="#" method="POST" class="form passwordForm">
    @csrf
    <label class="formElem">
        <p>Password</p>
        <input type='password' name="password" />
    </label>
    <label class="formElem">
        <p>Web Address</p>
        <select name="web_address" class='formElem'>
            <option value="yt">Youtube</option>
        </select>
    </label>
    <label class="formElem">
        <p>Login (Optional)</p>
        <input type='text' name="login"/>
    </label>
    <label class="formElem">
        <p>Description (Optional)</p>
        <input type='text' name="description"/>
    </label>
    <p class='appMessage'></p>
    <button class="submit">Add</button>
    <button type="button" class="submit" onclick="toggleAddPasswordPopup()">Cancel</button>
</form>