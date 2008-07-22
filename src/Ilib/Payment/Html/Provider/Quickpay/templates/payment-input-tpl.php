    <div id="payment-input">
        <form action="https://secure.quickpay.dk/quickpay_pay.php" method="post" autocomplete="off" id="payment_details">

            <?php if (!empty($this->document->company_name)): ?>
                <h2><?php e($this->document->company_name); ?></h2>
            <?php endif; ?>

            <p><?php e(__('You are about to pay for order number')); ?> <strong>###ORDERNUM###</strong></p> 
            <p><?php echo '<strong>###CURRENCY### ###AMOUNT_FORMATTED###</strong>'; ?> <?php e(__('will be withdrawed from your card')); ?>.</p>
        
            <div id="cards_container">
                ###CARDS###
            </div>
            
            <div id="formrow">
                <label for="cardnum"><?php e(__('Card number')); ?></label>
                <input type="text" maxlength="16" size="19" name="cardnum" id="cardnum" />
            </div>
            
            <div id="formrow">
                <label for="month"><?php e(__('Expire date (mm/yy)')); ?></label>
                <select name="month" id="month">###MONTH_OPTIONS###</select> / 
                <select name="year" id="year">###YEAR_OPTIONS###</select>
            </div>
            
            <div id="formrow">
                <label for="cvd"><?php e(__('Cvd numbers')); ?></label>
                <input type="text" maxlength="3" size="3" name="cvd" id="cvd" />
            </div>

            <input name="submit" type="submit" value="<?php e(__('Pay')); ?>">
        </form>
    </div>
