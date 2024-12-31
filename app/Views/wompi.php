
<?php  echo $this->extend('template/layout'); ?>
<?php  echo $this->section("content"); ?>




<button id="payButton">Pagar con Wompi</button>

<form>
  <script
    src="https://checkout.wompi.co/widget.js"
    data-render="button"
    data-public-key="pub_test_X0zDA9xoKdePzhd8a0x9HAez7HgGO2fH"
    data-currency="COP"
    data-amount-in-cents="4950000"
    data-reference="4XMPGKWWPKWQ"
    data-signature:integrity="37c8407747e595535433ef8f6a811d853cd943046624a0ec04662b17bbf33bf5"
  ></script>
</form>

<script>

</script>

<?php  echo $this->endSection("content"); ?>