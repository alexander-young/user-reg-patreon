<?php

get_header();

?>

<form id="user-registration">


    <label>First Name*
        <input name="first_name" type="text" value="">
    </label>

    <hr>

    <label>Last Name*
        <input name="last_name" type="text" value="">
    </label>

    <hr>

    <label>Email*
        <input name="email" type="email" value="">
    </label>

    <hr>
    
    <label>Password*
        <input name="password" type="password" value="">
    </label>

    <hr>

    <label>Favorite Basketball Team
        <select name="favorite_basketball_team">
            <option>Utah Jazz</option>
            <option>LA Lakers</option>
            <option>Houston Rockets</option>
            <option>NY Knicks</option>
            <option>Boston Celtics</option>
        </select>
    </label>

    <hr>

    <label>Favorite Ice Cream
        <select name="favorite_ice_cream">
            <option>Vanilla</option>
            <option>Chocolate</option>
            <option>Strawberry</option>
            <option>Sherbert</option>
        </select>
    </label>

    <hr>

    <fieldset>

        <legend>Relationship Status</legend>

        <input id="relationship-single" type="radio" name="relationship_status" value="Single">
        <label for="relationship-single">Single</label>

        <input id="relationship-married" type="radio" name="relationship_status" value="Married">
        <label for="relationship-married">Married</label>

    </fieldset>

    <hr>

    <fieldset>
        <legend>Do you subscribe to any of these streaming services?</legend>

        <input id="netflix" name="subscriptions[]" type="checkbox" value="Netflix">
        <label for="netflix">Netflix</label>

        <input id="hulu" name="subscriptions[]" type="checkbox" value="Hulu">
        <label for="hulu">Hulu</label>

        <input id="youtubetv" name="subscriptions[]" type="checkbox" value="YouTube TV">
        <label for="youtubetv">YouTube TV</label>

        <input id="sling" name="subscriptions[]" type="checkbox" value="Sling">
        <label for="sling">Sling</label>

    </fieldset>

    <hr>

    <button type="submit">Save</button>

    <hr>

    <div class="response" style="display:none;"></div>

</form>

<?php get_footer();
