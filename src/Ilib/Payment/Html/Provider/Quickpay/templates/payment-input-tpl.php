        <form action="https://secure.quickpay.dk/quickpay_pay.php" method="post" autocomplete="off">
            <div class="s4top">
            <fieldset class="clearfix">
            <legend><span><?php e(__('Card information')); ?></span></legend>
            <div class="s4-inner">
                <div class="stop">
                    <label for="cardnum"><?php e(__('Card number')); ?></label>
                    <input type="text" maxlength="16" size="19" name="cardnum" id="cardnum" />
                </div>
                <div>
                    <label for="month"><?php e(__('Expire date')); ?></label>
                    <span>
                    <select name="month" class="s4-select" id="month">###MONTH_OPTIONS###</select>
                    <strong class="slash">/</strong>
                    <select name="year" class="s4-select" id="year">###YEAR_OPTIONS###</select>
                    </span>
                </div>
                <div>
                    <label for="cvd"><?php e(__('Security no.')); ?></label>
                    <input type="text" maxlength="3" size="3" name="cvd" id="cvd" />
                </div>
                <div>
                    <input class="godkend" type="submit" id="submit" value="<?php e(__('Pay')); ?>" />
                </div>
            </div>
            </fieldset>
        </div>
        <div class="s4top s4toplast">
            <fieldset class="clearfix">
            <legend><span><?php e(__('Company')); ?></span></legend>
            <div class="s4-inner">
                <p class="stop"><strong><span><?php e(__('Total amount')); ?></span></strong> ###CURRENCY### ###AMOUNT_FORMATTED###</p>
                <p><strong><span><?php e(__('Order')); ?></span>###ORDERNUM###</strong></p>
                <p><span><?php e(__('Company')); ?></span> <b><?php e($this->getCompanyName()); ?><br />
                    <?php e($this->getCompanyAddress()); ?><br />
                    <?php e($this->getCompanyZip()); ?></b></p>
                <p><span><?php e(__('Vat no.')); ?></span><?php e($this->getCompanyVatNumber()); ?></p>
            </div>
            </fieldset>
        </div>
       </form>
        <div class="s4base">
            <fieldset class="clearfix">
            <legend><span><?php e(__('Available cards')); ?></span></legend>
            ###CARDS###
            </fieldset>
        </div>
<br>