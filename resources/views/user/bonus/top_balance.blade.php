
      
      
<section class="cab-money cab-section">
  <div class="container">
    <h2 class="cab-title cab-money__title">
      <span class="cab-title__divider"></span>
      <span class="cab-title__text">Пополнить баланс</span>
      <span class="cab-title__divider cab-title__divider--reverse"></span>
    </h2>
    
    <form method="POST" id="balance_up_form"> <input type="hidden" name="csrfmiddlewaretoken" value="EuDm9ZUsgBGGfVaXrJ3pP1UkAuPJPAsnYJJcXYcPsdz9BBvD9wUQngNM4irRWQ4K">
      <input type="hidden" name="balance_up_form">
      
      


<div class="cab-wrapper cab-money__payment-wrapper">
    <h3 class="cab-subtitle cab-money__subtitle">Выберите платежную
      систему</h3>
    <ul class="list-reset cab-payment cab-deposit__payment">
        
            
                
                <li class="cab-payment__item">
                    <label class="cab-payment__label">
                        
                            <input class="cab-payment__radio" type="radio" name="billing_method" value="1" data-payment-radio data-min-sum="500" data-max-sum="1000000" >
                        
                        <div class="cab-payment__item-content cab-payment__item-content" style="background-image: url('/media/billing/billing_methods/ton_symbol_2QotA0R.svg')">
                        <div class="cab-payment__item-text">TON</div>
                        <div class="cab-payment__checkbox">
                            <svg>
                            <use xlink:href="/static/img/sprite.svg#cab-payment-checkbox"></use>
                            </svg>
                        </div>
                        </div>
                    </label>
                </li>
                
            
        
    </ul>
  </div>


      <div class="cab-wrapper">
        <div class="cab-transaction__title-wrapper">
          <h3 class="cab-subtitle ">Сумма пополнения:</h3>
          <div class="cab-transaction__text"></div>
        </div>
        <div class="cab-money__content cab-money__content--balance-up">
          <button type="button" class="btn-reset cab-money__balance-up
            cab-money__balance-up--active" data-balance-val="1000">1000₽</button>
          <button type="button" class="btn-reset cab-money__balance-up"
            data-balance-val="3000">3000₽</button>
          <button type="button" class="btn-reset cab-money__balance-up"
            data-balance-val="5000">5000₽</button>
          <button type="button" class="btn-reset cab-money__balance-up"
            data-balance-val="10000">10000₽</button>
          <label class="cab-money__label cab-money__label--balance-up">
            <input class="cab-money__input" type="number"
              placeholder="Другая сумма:" data-balance-up-input
              name="amount"
              value="1000">
          </label>
          <button class="btn-reset btn btn--bg cab-money__btn
            cab-money__btn--balance-up" data-balance-up-btn disabled >Пополнить</button>
        </div>
      </div>
    </form>
  </div>
</section>

      
     