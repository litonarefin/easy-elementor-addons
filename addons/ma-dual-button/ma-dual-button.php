

			<div btn-group data-grouptype="OR">
				<a href="#">Left</a>
				<a href="#">Rigth</a>
			</div>
			<br>




            [btn-group] {
  position:relative;
  display:inline-block;
  margin:10px 0;
}

[btn-group]:before {
  content:attr(data-grouptype);
  color:#999;
  display:block;
  font-size:0.8125em;
  width: 55px;
  height: 55px;
  padding:5px;
  border-radius:50%;
  background:#FFF;
  position:absolute;
  left:48%;
  top:0;
  margin-left:-18px;
  line-height:3em;
}

[btn-group] > a + a {
  margin-left:-4px;
}

[btn-group] > a {
  display:inline-block;
  padding:6px 14px;
  background:#F2F2F2;
  border-radius:3px;
  font-size:0.8125em;
  color:#B9BCBC;
  transition:background .3s ease, color .3s ease;
  text-decoration:none;
  transition:color .3s ease;
  /* padding:12px 28px; */
  padding: 1.322rem 4.75rem;
  text-transform:uppercase;
  border-radius: 3rem;
}

[btn-group] > a:nth-of-type(1) {
  background:#A1D36E;
  color:#FFF;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}

/* a:nth-of-type(1):hover [btn-group]:before{
  background: red;
  position: absolute;
  left: 0;
  margin-left: -200px;
} */

[btn-group] > a:nth-of-type(1):hover {
  background:#94CD5A;
}

[btn-group] > a:nth-of-type(2) {
  background:#6AD1DD;
  color:#FFF;
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}

[btn-group] > a:nth-of-type(2):hover {
  background:#55CBD8;
}



