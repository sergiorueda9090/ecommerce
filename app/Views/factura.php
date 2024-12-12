
<?php  echo $this->extend('template/layout'); ?>
<?php  echo $this->section("content"); ?>
<style>

.products th, .products td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
    font-weight: 500;
}
.products th {
    background-color: #fcb800;
    color: #000;
}
</style>
<!--=====================================
    Breadcrumb
    ======================================-->  
	
	<div class="ps-breadcrumb">

        <div class="container">

            <ul class="breadcrumb">

                <li><a href="<?php base_url() ?>">Home</a></li>

                <li>Factura de Compra</li>

            </ul>

        </div>

    </div>

    <!--=====================================
    FACTURA Content
    ======================================-->
    <div class="container" style="width: 80%;margin: 20px auto;background: #fff;box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);border-radius: 8px;padding: 20px;">
        <div class="header" style="text-align: center;
                                    border-bottom: 2px solid #fcb800;
                                    padding-bottom: 15px;
                                    margin-bottom: 20px;">
            <h1 style="margin: 0; color: #000;">Factura de Compra</h1>
            <p style="margin: 5px 0;">Gracias por tu compra en [Nombre del Comercio]</p>
        </div>
        <?php
            $fechaCompra = $orders[0]->created_at;
            // Crear un objeto DateTime
            $fecha = new DateTime($fechaCompra);
            // Formatear la fecha
            $formatoAmigable = $fecha->format('d/m/Y \a \l\a\s h:i A')
        ?>

        <div class="details" style="margin-bottom: 20px;">
            <h2 style="margin-bottom: 10px;font-size: 1.2em;color: #555;">Detalles de la Factura</h2>
            <p style="margin: 5px 0;"><strong>Número de Factura:</strong> #123456</p>
            <p style="margin: 5px 0;"><strong>Fecha:</strong> <?php echo $fechaCompra; ?></p>
            <p style="margin: 5px 0;"><strong>Comprador:</strong> <?php echo $customer->name.' '.$customer->lastname.' '.$customer->second_surname; ?></p>
            <p style="margin: 5px 0;"><strong>Dirección de Envío:</strong> <?php echo $customer->address; ?></p>
            <p style="margin: 5px 0;"><strong>Teléfono :</strong> <?php echo $customer->phone; ?></p>
        </div>

        <table class="products" style="  width: 100%;
                                        border-collapse: collapse;
                                        margin-bottom: 20px;">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                    foreach($orders as $key => $value){

                        echo '<tr>
                                <td><img src="'.base_url().$value->image.'"/></td>
                                <td>'.$value->name.'</td>
                                <td>'.$value->quantity.'</td>
                                <td>$'.$value->value.'</td>
                            </tr>';

                    }
                ?>

            </tbody>
        </table>

        <div class="total" style="  text-align: right;
            font-size: 1.2em;
            margin-top: 20px;">
            <p><strong>Total a Pagar:</strong> $190.00</p>
        </div>

        <div class="download-button" style=" text-align: center;
            margin-top: 20px;">
            <a href="/factura/pdf" target="_blank" style="            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #000;
            font-weight: 600;
            background-color: #fcb800;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;">Descargar en PDF</a>
        </div>

        <div class="footer" style="    text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
            color: #777;">
            <p>Si tienes alguna pregunta sobre tu compra, contáctanos en soporte@comercio.com</p>
            <p>¡Gracias por elegirnos!</p>
        </div>
    </div>
  
    <!--=====================================
	Newletter
	======================================-->  

    <div class="ps-newsletter">

        <div class="container">

            <form class="ps-form--newsletter" action="do_action" method="post">

                <div class="row">

                    <div class="col-xl-5 col-12 ">
                        <div class="ps-form__left">
                            <h3>Newsletter</h3>
                            <p>Subcribe to get information about products and coupons</p>
                        </div>
                    </div>

                    <div class="col-xl-7 col-12 ">

                        <div class="ps-form__right">

                            <div class="form-group--nest">

                                <input class="form-control" type="email" placeholder="Email address">
                                <button class="ps-btn">Subscribe</button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

<?php  echo $this->endSection("content"); ?>