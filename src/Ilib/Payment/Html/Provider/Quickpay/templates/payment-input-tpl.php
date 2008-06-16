    <div id="payment-input">
        <form action="https://secure.quickpay.dk/quickpay_pay.php" method="post" autocomplete="off" id="payment_details">

            <p>You are about to pay for order number <strong>###ORDERNUM###</strong></p> 
            <p><?php echo '<strong>###CURRENCY### ###AMOUNT_FORMATTED###</strong>'; ?> will be withdrawed from your card.</p>
        
            <div id="cards_container">
                ###CARDS###
            </div>
            
            <div id="formrow">
                <label for="cardnum">###TXT_CARDNUM###</label>
                <input type="text" maxlength="16" size="19" name="cardnum" id="cardnum" />
            </div>
            
            <div id="formrow">
                <label for="month">###TXT_EXPIR###</label>
                <select name="month" id="month">###MONTH_OPTIONS###</select> / 
                <select name="year" id="year">###YEAR_OPTIONS###</select>
            </div>
            
            <div id="formrow">
                <label for="cvd">###TXT_CVD###</label>
                <input type="text" maxlength="3" size="3" name="cvd" id="cvd" />
            </div>

            <input name="submit" type="submit" value="   ###TXT_PAYBUTTON###   ">
        </form>
    </div>
