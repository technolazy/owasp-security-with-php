<section class="container-fluid row">
    <div id='content' class='clearfix col-xs-12
      col-sm-offset-2 col-md-offset-2 col-lg-offset-2
      col-sm-8 col-md-8 col-lg-8'>
        <div id='successHolder' class="alert alert-success" role="alert" style='display:none;'>
            <div id='successContent'></div>
        </div>
        <div id='errorHolder' class="alert alert-danger" role="alert" style='display:none;'>
            <div id='errorContent'></div>
        </div>
        <div id='corporateInformation'>
            <h2>Order page.</h2>
            <p>Verify and Update the information for this order.
            </p>
        </div>

    <form class="form-signin form-horizontal" id='updateOrderForm'
    name='updateOrderForm'
    role="form" method='POST'
    action='../../jsHelper/reroute.php' novalidate='novalidate'>
        <section id='corporateBody'>

        <input type='hidden' id='csrf' name='csrf' value='<?=$_SESSION['csrf_token'];?>' />
        <input type='hidden' name='to' value='Controllers/Corporate/CorporateEditOrderController.php' />

        <div class="form-group">
            <label for="inputOrderID" class="col-sm-2 control-label">Order ID:</label>
            <div class='col-sm-10'>
            <input type="number" name='inputOrderID' id="inputOrderID" class="form-control"
                placeholder="Order ID" min="0" disabled='disabled' readonly="readonly" required="" autocomplete="off" value='<?=$id;?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="inputFulfilled" class="col-sm-2 control-label">Fulfilled:</label>
            <div class='col-sm-10'>
            <input type="number" name='inputFulfilled' id="inputFulfilled" class="form-control"
                placeholder="Number Fulfilled" min="0" required="" autocomplete="off" value='<?=$fulfilled;?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="inputUnfulfilled" class="col-sm-2 control-label">Unfulfilled:</label>
            <div class='col-sm-10'>
            <input type="number" name='inputUnfulfilled' id="inputUnfulfilled" class="form-control"
                placeholder="Number Fulfilled" min="0" required="" autocomplete="off" value='<?=$unfulfilled;?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="inputIsShipped" class="col-sm-2 control-label">Is Shipped:</label>
            <div class='col-sm-10'>
            <input type="checkbox" name='inputIsShipped' id="inputIsShipped" class="form-control"
                <?=$checked;?>>
            </div>
        </div>

        <div class="form-group">
            <label for="inputUsername" class="col-sm-2 control-label">Username:</label>
            <div class='col-sm-10'>
            <input type="text" name='inputIsShipped' id="inputIsShipped"
            disabled='disabled' readonly="readonly" class="form-control"
                placeholder="Username"  required="" autocomplete="off" value='<?=$username;?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Email:</label>
            <div class='col-sm-10'>
            <input type="email" name='inputEmail' id="inputEmail"
            disabled='disabled' readonly="readonly" class="form-control"
                placeholder="Email"  required="" autocomplete="off" value='<?=$email;?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="inputAddress" class="col-sm-2 control-label">Address:</label>
            <div class='col-sm-10'>
            <input type="text" name='inputAddress' id="inputAddress"
            disabled='disabled' readonly="readonly" class="form-control"
                placeholder="Street Address"  required="" autocomplete="off" value='<?=$address;?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="inputPhone" class="col-sm-2 control-label">Phone:</label>
            <div class='col-sm-10'>
            <input type="tel" name='inputPhone' id="inputPhone"
            disabled='disabled' readonly="readonly" class="form-control"
                placeholder="Phone Number"  required="" autocomplete="off" value='<?=$phone;?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="inputCity" class="col-sm-2 control-label">City:</label>
            <div class='col-sm-10'>
            <input type="text" name='inputCity' id="inputCity"
            disabled='disabled' readonly="readonly" class="form-control"
                placeholder="City"  required="" autocomplete="off" value='<?=$city;?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="inputState" class="col-sm-2 control-label">State:</label>
            <div class='col-sm-10'>
            <input type="text" name='inputState' id="inputState"
            disabled='disabled' readonly="readonly" class="form-control"
                placeholder="City"  required="" autocomplete="off" value='<?=$state;?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="inputCountryCode" class="col-sm-2 control-label">Country Code:</label>
            <div class='col-sm-10'>
            <input type="text" name='inputCountryCode' id="inputCountryCode"
            disabled='disabled' readonly="readonly" class="form-control"
                placeholder="Country Code"  required="" autocomplete="off" value='<?=$countrycode;?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="inputZip" class="col-sm-2 control-label">Zip:</label>
            <div class='col-sm-10'>
            <input type="text" name='inputZip' id="inputZip"
            disabled='disabled' readonly="readonly" class="form-control"
                placeholder="Zip"  required="" autocomplete="off" value='<?=$zip;?>'>
            </div>
        </div>
        <div class="form-group">
            <label for="inputInstructions" class="col-sm-2 control-label">Instructions:</label>
            <div class='col-sm-10'>
            <textarea type="text" name='inputInstructions' id="inputInstructions"
            disabled='disabled' readonly="readonly" class="form-control"
                placeholder="Additional Instructions"><?=$instructions;?></textarea>
            </div>
        </div>

        <input type='text' id='honeypot' style='display:none;' />
        <button class="btn btn-lg btn-primary center-block" type="submit" name='submit' id='submit'>Update</button>

        </section>
    </form>
    </div><!-- End content -->
</section>
