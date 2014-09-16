 <style>


.plans {
 font: 13px/20px 'Helvetica Neue', Helvetica, Arial, sans-serif;
  color: #f5f5f5;
  width: 820px;
  margin: 0px auto;
  overflow: hidden;
}

.plan {
  float: left;
  width: 150px;
  padding: 15px 25px;
  text-align: center;
  background: white;
  background-clip: padding-box;
  border: 2px solid #e5ded6;
  border-color: rgba(0, 0, 0, 0.1);
  border-radius: 5px;
}

.plan-title {
  margin-bottom: 12px;
  font-size: 24px;
  color: #36bce6;
}

.plan-price {
  margin-bottom: 20px;
  line-height: 1;
  font-size: 28px;
  font-weight: bold;
  color: #fd935a;
}

.plan-unit {
  display: block;
  margin-top: 5px;
  font-size: 13px;
  font-weight: normal;
  color: #aaa;
}

.plan-features {
  width: 120px;
  margin: 20px auto 15px;
  padding: 15px 0 0 15px;
  border-top: 1px solid #e5ded6;
  text-align: left;
}

.plan-feature {
  line-height: 20px;
  font-size: 16px;
  font-weight: 500;
  color: #333;
}
.plan-feature + .plan-feature {
  margin-top: 5px;
}

.plan-feature-unit {
  margin-left: 2px;
  font-size: 16px;
}

.plan-feature-name {
  font-size: 13px;
  font-weight: normal;
  color: #aaa;
}

.plan-button {
  position: relative;
  display: block;
  line-height: 40px;
  font-size: 16px;
  font-weight: 500;
  color: white;
  text-align: center;
  text-decoration: none;
  text-shadow: 0 1px rgba(0, 0, 0, 0.1);
  background: #fd935c;
  border-bottom: 2px solid #cf7e3b;
  border-color: rgba(0, 0, 0, 0.15);
  border-radius: 4px;
}
.plan-button:active {
  top: 2px;
  margin-bottom: 2px;
  border-bottom: 0;
}

.plan-highlight {
  margin-top: 0;
  margin-bottom: 0;
  padding-left: 15px;
  padding-right: 15px;
  width: 170px;
  border: 4px solid #37bbe6;
}
.plan-highlight .plan-button {
  font-size: 18px;
  line-height: 49px;
  background: #37bce5;
  border-color: #3996b3;
  border-color: rgba(0, 0, 0, 0.15);
}

.plan-recommended {
  width: 160px;
  margin: -15px auto -16px;
  padding-bottom: 2px;
  line-height: 22px;
  font-size: 14px;
  font-weight: bold;
  color: white;
  text-shadow: 0 1px rgba(0, 0, 0, 0.05);
  background: #37bbe6;
  border-radius: 0 0 4px 4px;
}

</style>
 <div class="plans">
    <div class="plan">
      <h3 class="plan-title">Free</h3>
      <p class="plan-price">$0 <span class="plan-unit">per month</span></p>
      <ul class="plan-features">
        <li class="plan-feature">2 <span class="plan-feature-name">Torrents</span></li>
        <li class="plan-feature">1<span class="plan-feature-unit">GB/d</span> <span class="plan-feature-name">Bandwidth</span></li>
        <li class="plan-feature">2<span class="plan-feature-unit">day</span> <span class="plan-feature-name">Storage</span></li>
		   <li class="plan-feature">1<span class="plan-feature-unit">GB</span> <span class="plan-feature-name">Max</span></li>
      </ul>
      <a href="#" class="plan-button">Choose Plan</a>
    </div>
    <div class="plan">
      <h3 class="plan-title">30 Gold</h3>
      <p class="plan-price">$4.99 <span class="plan-unit">per month</span></p>
      <ul class="plan-features">
        <li class="plan-feature">Unlimited <span class="plan-feature-name">Torrents</span></li>
        <li class="plan-feature">1<span class="plan-feature-unit">TB</span> <span class="plan-feature-name">Bandwidth</span></li>
        <li class="plan-feature">250 GB <span class="plan-feature-name">Storage</span></li>
		<li class="plan-feature"> Unlimited<span class="plan-feature-name"> Size</span></li>
      </ul>
      <a href="{{URL::to("plan/30gold/summary?width=350&height=361")}}" class="plan-button nbsmbox fancybox.ajax">Choose Plan</a>
    </div>
    <div class="plan">
      <h3 class="plan-title">90 Stack</h3>
      <p class="plan-price">$12.99 <span class="plan-unit">per 3 months</span></p>
      <ul class="plan-features">
        <li class="plan-feature">Unlimited <span class="plan-feature-name">Torrents</span></li>
        <li class="plan-feature">4<span class="plan-feature-unit">TB</span> <span class="plan-feature-name">Bandwidth</span></li>
        <li class="plan-feature">500 GB <span class="plan-feature-name">Storage</span></li>
		<li class="plan-feature"> Unlimited<span class="plan-feature-name"> Size</span></li>
      </ul>
      <a href="{{URL::to("plan/90stack/summary?width=828&height=361")}}" class="plan-button nbsmbox fancybox.ajax">Choose Plan</a>
    </div>
    <div class="plan plan-highlight">
		<p class="plan-recommended">Recommended</p>
      <h3 class="plan-title">356 Blast</h3>
      <p class="plan-price">$59.99 <span class="plan-unit">per year</span></p>
      <ul class="plan-features">
        <li class="plan-feature">Unlimited <span class="plan-feature-name">Torrents</span></li>
        <li class="plan-feature">15<span class="plan-feature-unit">TB</span> <span class="plan-feature-name">Bandwidth</span></li>
        <li class="plan-feature">1 TB <span class="plan-feature-name">Storage</span></li>
		<li class="plan-feature"> Unlimited<span class="plan-feature-name"> Size</span></li>
      </ul>
      <a href="{{URL::to("plan/356blast/summary?width=828&height=361")}}" class="plan-button nbsmbox fancybox.ajax">Choose Plan</a>
    </div>
  </div>