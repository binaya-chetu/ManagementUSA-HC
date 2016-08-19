@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Inventory Details</h2>

        <div class="right-wrapper pull-right">


            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">
                Patient Inventory Details
            </h2>
        </header>
        <div class="panel-body">
            <div class="row">
                @if(Session::has('flash_message'))
                <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em>{!! session('flash_message') !!}</em></div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-6 commentdiv">
                    Patient Name
                </div>
                <div class="col-md-6 commentdiv">
                    Date of Birth
                </div>
                <div class="col-md-6 commentdiv">
                    Amir       
                </div>
                <div class="col-md-6 commentdiv">
                    06/09/1987
                </div>
            </div>

        </div>


        <!-- start: page -->
        <form>
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h6 class="panel-title" id = "small-heading" >Package Totals</h6>

                        </header>
                        <div class="panel-body">
                            <div class="row show-grid">
                                <div class="col-md-2"><span class="show-grid-block">Trimix</span></div>
                                <div class="col-md-2"><span class="show-grid-block">Sublingual</span></div>
                                <div class="col-md-2"><span class="show-grid-block">Office Visit</span></div>
                                <div class="col-md-2"><span class="show-grid-block">Redose</span></div>
                                <div class="col-md-2"><span class="show-grid-block">Antidotes</span></div>
                                <div class="col-md-2"><span class="show-grid-block">Prolyfic Treatment</span></div>
                            </div>
                            <div class="row show-grid">
                                <div class="col-md-2"><span class="show-grid-block">50%</span></div>
                                <div class="col-md-2"><span class="show-grid-block">5%</span></div>
                                <div class="col-md-2"><span class="show-grid-block">61%</span></div>
                                <div class="col-md-2"><span class="show-grid-block">30%</span></div>
                                <div class="col-md-2"><span class="show-grid-block">20%</span></div>
                                <div class="col-md-2"><span class="show-grid-block">10%</span></div>
                            </div>
                            <div class="row show-grid">
                                <div class="col-md-2"><span class="show-grid-block">3305</span></div>
                                <div class="col-md-2"><span class="show-grid-block">5896</span></div>
                                <div class="col-md-2"><span class="show-grid-block">8000</span></div>
                                <div class="col-md-2"><span class="show-grid-block">9600</span></div>
                                <div class="col-md-2"><span class="show-grid-block">5698</span></div>
                                <div class="col-md-2"><span class="show-grid-block">5669</span></div>
                            </div>
                        </div>
                    </section>
                    <section class="panel" id="treatment">
                        <header class="panel-heading">
                            <div class="row-title"> Trimix /Sublingual ED Therapy </div>
                        </header>
                        <div class="panel-body">
                            <span class="row-title">Intitial Test Dosing + Expand - Colapse   Deduct from Inventory Only</span>
                            <table class="table table-bordered table-striped mb-none">
                                <tr style="text-align:center"><td class="table-text" colspan="2"> <div class = "panel-row"> Test Dose 1   (Auto Quantity 1)</div></td><td class="table-text" colspan="2"> DD9</td></tr>
                                <tr> <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select></td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD2">DD2</option>
                                            <option value="T101">T101</option>
                                            <option value="T105">T105</option>
                                            <option value="T106">T106</option>
                                            <option value="ST1">ST1</option>
                                            <option value="ST9A">ST9A</option>
                                            <option value="ST9E">ST9E</option>
                                            <option value="BM1">BM1</option>
                                            <option value="BM3">BM3</option>
                                            <option value="BM6">BM6</option>
                                            <option value="QUAD4">QUAD4</option>
                                        </select> </td>
                                    <td class="table-text"> + </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD2">DD2</option>
                                            <option value="T101">T101</option>
                                            <option value="T105">T105</option>
                                            <option value="T106">T106</option>
                                            <option value="ST1">ST1</option>
                                            <option value="ST9A">ST9A</option>
                                            <option value="ST9E">ST9E</option>
                                            <option value="BM1">BM1</option>
                                            <option value="BM3">BM3</option>
                                            <option value="BM6">BM6</option>
                                            <option value="QUAD4">QUAD4</option>
                                        </select> </td><td class="table-text"> + </td><td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td><td class="table-text">  <select class="form-control">

                                            <option value="DD3">DD3</option>
                                            <option value="PG40">PG40</option>
                                            <option value="PG80">PG80</option>
                                            <option value="PG150">PG150</option>
                                            <option value="PG250">PG250</option>
                                            <option value="PG350">PG350</option>
                                            <option value="Papaverine">Papaverine</option>
                                            <option value="2% LIDO">2% LIDO</option>

                                        </select>
                                    </td>
                                    <td class="table-text"> + </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td>
                                    <td class="table-text">
                                        <select class="form-control">
                                            <option value="DD3">DD3</option>
                                            <option value="PG40">PG40</option>
                                            <option value="PG80">PG80</option>
                                            <option value="PG150">PG150</option>
                                            <option value="PG250">PG250</option>
                                            <option value="PG350">PG350</option>
                                            <option value="Papaverine">Papaverine</option>
                                            <option value="2% LIDO">2% LIDO</option>

                                        </select></td> </tr>

                                <tr style="text-align:center"><td class="table-text" colspan="2"> <div class = "panel-row"> Test Dose 2  (Auto Quantity 1)</div></td><td colspan="2"> DD9</td></tr>
                                <tr> <td><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select></td>
                                    <td><select class="form-control">
                                            <option value="DD2">DD2</option>
                                            <option value="T101">T101</option>
                                            <option value="T105">T105</option>
                                            <option value="T106">T106</option>
                                            <option value="ST1">ST1</option>
                                            <option value="ST9A">ST9A</option>
                                            <option value="ST9E">ST9E</option>
                                            <option value="BM1">BM1</option>
                                            <option value="BM3">BM3</option>
                                            <option value="BM6">BM6</option>
                                            <option value="QUAD4">QUAD4</option>
                                        </select> </td>
                                    <td>+ </td> <td> <select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td><td><select class="form-control">
                                            <option value="DD2">DD2</option>
                                            <option value="T101">T101</option>
                                            <option value="T105">T105</option>
                                            <option value="T106">T106</option>
                                            <option value="ST1">ST1</option>
                                            <option value="ST9A">ST9A</option>
                                            <option value="ST9E">ST9E</option>
                                            <option value="BM1">BM1</option>
                                            <option value="BM3">BM3</option>
                                            <option value="BM6">BM6</option>
                                            <option value="QUAD4">QUAD4</option>
                                        </select></td><td><select class="form-control">
                                            <option value="DD2">DD2</option>
                                            <option value="T101">T101</option>
                                            <option value="T105">T105</option>
                                            <option value="T106">T106</option>
                                            <option value="ST1">ST1</option>
                                            <option value="ST9A">ST9A</option>
                                            <option value="ST9E">ST9E</option>
                                            <option value="BM1">BM1</option>
                                            <option value="BM3">BM3</option>
                                            <option value="BM6">BM6</option>
                                            <option value="QUAD4">QUAD4</option>
                                        </select> </td><td> <select class="form-control">
                                            <option value="DD1"> DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td><td><select class="form-control">
                                            <option value="DD3">DD3</option>
                                            <option value="PG40">PG40</option>
                                            <option value="PG80">PG80</option>
                                            <option value="PG150">PG150</option>
                                            <option value="PG250">PG250</option>
                                            <option value="PG350">PG350</option>
                                            <option value="Papaverine">Papaverine</option>
                                            <option value="2% LIDO">2% LIDO</option>

                                        </select></td><td> + </td><td> <select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select>  </td><td><select class="form-control">
                                            <option value="DD3">DD3</option>
                                            <option value="PG40">PG40</option>
                                            <option value="PG80">PG80</option>
                                            <option value="PG150">PG150</option>
                                            <option value="PG250">PG250</option>
                                            <option value="PG350">PG350</option>
                                            <option value="Papaverine">Papaverine</option>
                                            <option value="2% LIDO">2% LIDO</option>

                                        </select></td> </tr>
                                <tr><td></td></tr>
                                <tr>
                                    <td> Injection
                                        <select class="form-control"><option>Click Time </option>
                                            <option>9:00 am </option>
                                            <option>10:00 am </option>    
                                            <option>11:00 am </option>
                                            <option>12:0 am </option>
                                            <option>01:00 pm </option>
                                            <option>02:00 pm </option>
                                            <option>03:00 pm </option>
                                            <option>04:00 pm </option>
                                            <option>05:00 pm </option>
                                        </select>
                                    </td>
                                    <td>  Injection2 <select class="form-control"><option>Click Time </option>
                                            <option>9:00 am </option>
                                            <option>10:00 am </option>    
                                            <option>11:00 am </option>
                                            <option>12:0 am </option>
                                            <option>01:00 pm </option>
                                            <option>02:00 pm </option>
                                            <option>03:00 pm </option>
                                            <option>04:00 pm </option>
                                            <option>05:00 pm </option>
                                        </select> </td>
                                    <td> Check 1
                                        <select class="form-control">
                                            <option value="DD4"> DD4(%)</option>
                                            <option value="0">0</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                        </select>
                                    </td>
                                    <td> Check 2 <select class="form-control">
                                            <option value="DD4">DD4(%)</option>
                                            <option value="0">0</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                        </select> </td>
                                    <td>Check 3<select class="form-control">
                                            <option value="DD4">DD4(%)</option>
                                            <option value="0">0</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                        </select> </td>
                                    <td>Antidote
                                        <select class="form-control">
                                            <option value="DD5">DD5</option>
                                            <option value="DD2 or DD3"> DD2 or DD3</option>


                                        </select> </td><td>Antidote2<select class="form-control">
                                            <option value="DD5">DD5</option>
                                            <option value="DD2 or DD3"> DD2 or DD3</option>


                                        </select> </td><td>Antidote3 <select class="form-control">
                                            <option value="DD5">DD5</option>
                                            <option value="DD2 or DD3"> DD2 or DD3</option>


                                        </select></td><td>Check 4
                                        <select class="form-control">
                                            <option value="DD4">DD4(%)</option>
                                            <option value="0">0</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                        </select> </td><td>Check 5 <select class="form-control">
                                            <option value="DD4">DD4(%)</option>
                                            <option value="0">0</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                        </select></td><td>PAIN 
                                        <select class="form-control">
                                            <option value="DD7">DD7</option>
                                            <option value="None">None</option>
                                            <option value="Burning">Burning</option>
                                            <option value="Dull Pain">Dull Pain</option>
                                            <option value="Testes Pain">Testes Pain</option>
                                            <option value=" Sensitive to Touch"> Sensitive to Touch</option>
                                        </select></td></tr>
                                <tr><td></td> </tr>
                            </table>

                            <table class="table table-bordered table-striped mb-none">

                                <tr style="text-align:center"><td class="table-text" colspan="2">
                                        <span class="row-title">Intitial Take Home Dosing   + Expand - Collapse   Deduct From Inventory Only </span></td><td class="table-text" colspan="2"><span class="row-title">Antidotes</span><span class="row-title">DD10</span></td><td><span class="row-title">DD10</span></td></tr>
                                <tr style="text-align:center"><td class="table-text" colspan="2"> <div class = "panel-row"> Take Home Test Dose A  </div></td><td class="table-text" colspan="2">
                                        <select class="form-control">

                                            <option value="DD9">DD9</option>
                                            <option value="Wesley Pope">Wesley Pope</option>
                                            <option value=" MD - Kisha Farrell"> MD - Kisha Farrell</option>
                                            <option value=" ANP - Justin Henson">ANP - Justin Henson</option>
                                            <option value="ANP - Steven Scholen">ANP - Steven Scholen</option>
                                            <option value="MD">MD</option>
                                        </select> </td> <td class="table-text">QTY </td> <td class="table-text"> <select class="form-control">
                                            <option value="DD10">DD10</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select>
                                    </td></tr>
                                <tr> <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select></td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD2">DD2</option>
                                            <option value="T101">T101</option>
                                            <option value="T105">T105</option>
                                            <option value="T106">T106</option>
                                            <option value="ST1">ST1</option>
                                            <option value="ST9A">ST9A</option>
                                            <option value="ST9E">ST9E</option>
                                            <option value="BM1">BM1</option>
                                            <option value="BM3">BM3</option>
                                            <option value="BM6">BM6</option>
                                            <option value="QUAD4">QUAD4</option>
                                        </select> </td>
                                    <td class="table-text"> + </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD2">DD2</option>
                                            <option value="T101">T101</option>
                                            <option value="T105">T105</option>
                                            <option value="T106">T106</option>
                                            <option value="ST1">ST1</option>
                                            <option value="ST9A">ST9A</option>
                                            <option value="ST9E">ST9E</option>
                                            <option value="BM1">BM1</option>
                                            <option value="BM3">BM3</option>
                                            <option value="BM6">BM6</option>
                                            <option value="QUAD4">QUAD4</option>
                                        </select> </td><td class="table-text"> + </td><td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td><td class="table-text">  <select class="form-control">

                                            <option value="DD3">DD3</option>
                                            <option value="PG40">PG40</option>
                                            <option value="PG80">PG80</option>
                                            <option value="PG150">PG150</option>
                                            <option value="PG250">PG250</option>
                                            <option value="PG350">PG350</option>
                                            <option value="Papaverine">Papaverine</option>
                                            <option value="2% LIDO">2% LIDO</option>

                                        </select>
                                    </td>
                                    <td class="table-text"> + </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td>
                                    <td class="table-text">
                                        <select class="form-control">
                                            <option value="DD3">DD3</option>
                                            <option value="PG40">PG40</option>
                                            <option value="PG80">PG80</option>
                                            <option value="PG150">PG150</option>
                                            <option value="PG250">PG250</option>
                                            <option value="PG350">PG350</option>
                                            <option value="Papaverine">Papaverine</option>
                                            <option value="2% LIDO">2% LIDO</option>

                                        </select></td> </tr>

                                <tr style="text-align:center"><td colspan="11" class="table-text"> <div class = "panel-row"> Call In Results</div></tr>
                                <tr style="text-align:center"><td class="tabel-text">Time</td><td class="tabel-text">%</td><td class="tabel-text">Pain</td><td class="tabel-text">Antidote</td><td class="tabel-text">Notes</td><td class="tabel-text">PERM</td></tr>
                                <tr> <td><span><select class="form-control">DD6
                                                <option>hour</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </span>
                                        <span>
                                            <select class="form-control">
                                                <option> minuts </option>
                                                <option value="0">0</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                                <option value="30">30</option>
                                                <option value="35">35</option>
                                                <option value="40">40</option>
                                                <option value="45">45</option>
                                                <option value="50">50</option>
                                                <option value="55">55</option>
                                                <option value="60">60</option>

                                            </select>
                                        </span>
                                    </td>
                                    <td><select class="form-control">
                                            <option value="DD4">DD4(%)</option>
                                            <option value="0">0</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                        </select> </td>
                                    <td>  <select class="form-control">
                                            <option value="DD7">DD7</option>
                                            <option value="None">None</option>
                                            <option value="Burning">Burning</option>
                                            <option value="Dull Pain">Dull Pain</option>
                                            <option value="Testes Pain">Testes Pain</option>
                                            <option value=" Sensitive to Touch"> Sensitive to Touch</option>
                                        </select> </td><td><select class="form-control">
                                            <option value="DD8">DD8</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select></td>
                                    <td><textarea placeholder="click for notes" name="notes"></textarea> </td>
                                    <td> click for perm does <input type="checkbox" name="permDose" /> </td> </tr>
                                <tr style="text-align:center"> <td colspan="11" class="table-text"><select class="form-control">
                                            <option value="DD11">DD11</option>
                                            <option value="150 MG Sildenafil ">150 MG Sildenafil </option>
                                            <option value="80 MG Vardenafil">80 MG Vardenafil</option>
                                            <option value="80 MG Tadalafil ">80 MG Tadalafil </option>
                                        </select>
                                    </td> <td colspan="11" class="table-text">QTY</td>
                                    <td colspan="11" class="table-text"><select class="form-control">
                                            <option value="DD10">DD10</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select></td>
                                </tr>
                                <tr style="text-align:center"><td class="table-text" colspan="2"> <div class = "panel-row"> Take Home Test Dose B  </div></td><td class="table-text" colspan="2">
                                        <select class="form-control">

                                            <option value="DD9">DD9</option>
                                            <option value="Wesley Pope">Wesley Pope</option>
                                            <option value=" MD - Kisha Farrell"> MD - Kisha Farrell</option>
                                            <option value=" ANP - Justin Henson">ANP - Justin Henson</option>
                                            <option value="ANP - Steven Scholen">ANP - Steven Scholen</option>
                                            <option value="MD">MD</option>
                                        </select> </td> <td class="table-text">QTY </td> <td class="table-text" > <select class="form-control" >
                                            <option value="DD10">DD10</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select>
                                    </td></tr>
                                <tr> <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select></td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD2">DD2</option>
                                            <option value="T101">T101</option>
                                            <option value="T105">T105</option>
                                            <option value="T106">T106</option>
                                            <option value="ST1">ST1</option>
                                            <option value="ST9A">ST9A</option>
                                            <option value="ST9E">ST9E</option>
                                            <option value="BM1">BM1</option>
                                            <option value="BM3">BM3</option>
                                            <option value="BM6">BM6</option>
                                            <option value="QUAD4">QUAD4</option>
                                        </select> </td>
                                    <td class="table-text"> + </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD2">DD2</option>
                                            <option value="T101">T101</option>
                                            <option value="T105">T105</option>
                                            <option value="T106">T106</option>
                                            <option value="ST1">ST1</option>
                                            <option value="ST9A">ST9A</option>
                                            <option value="ST9E">ST9E</option>
                                            <option value="BM1">BM1</option>
                                            <option value="BM3">BM3</option>
                                            <option value="BM6">BM6</option>
                                            <option value="QUAD4">QUAD4</option>
                                        </select> </td><td class="table-text"> + </td><td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td><td class="table-text">  <select class="form-control">

                                            <option value="DD3">DD3</option>
                                            <option value="PG40">PG40</option>
                                            <option value="PG80">PG80</option>
                                            <option value="PG150">PG150</option>
                                            <option value="PG250">PG250</option>
                                            <option value="PG350">PG350</option>
                                            <option value="Papaverine">Papaverine</option>
                                            <option value="2% LIDO">2% LIDO</option>

                                        </select>
                                    </td>
                                    <td class="table-text"> + </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td>
                                    <td class="table-text">
                                        <select class="form-control">
                                            <option value="DD3">DD3</option>
                                            <option value="PG40">PG40</option>
                                            <option value="PG80">PG80</option>
                                            <option value="PG150">PG150</option>
                                            <option value="PG250">PG250</option>
                                            <option value="PG350">PG350</option>
                                            <option value="Papaverine">Papaverine</option>
                                            <option value="2% LIDO">2% LIDO</option>

                                        </select></td> </tr>

                                <tr style="text-align:center"><td colspan="11" class="table-text"> <div class = "panel-row"> Call In Results</div></tr>
                                <tr style="text-align:center"><td class="tabel-text">Time</td><td class="tabel-text">%</td><td class="tabel-text">Pain</td><td class="tabel-text">Antidote</td><td class="tabel-text">Notes</td><td class="tabel-text">PERM</td></tr>
                                <tr> <td><span><select class="form-control">DD6
                                                <option>hour</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </span>
                                        <span>
                                            <select class="form-control">
                                                <option> minuts </option>
                                                <option value="0">0</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                                <option value="30">30</option>
                                                <option value="35">35</option>
                                                <option value="40">40</option>
                                                <option value="45">45</option>
                                                <option value="50">50</option>
                                                <option value="55">55</option>
                                                <option value="60">60</option>

                                            </select>
                                        </span>
                                    </td>
                                    <td><select class="form-control">
                                            <option value="DD4">DD4(%)</option>
                                            <option value="0">0</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                        </select> </td>
                                    <td>  <select class="form-control">
                                            <option value="DD7">DD7</option>
                                            <option value="None">None</option>
                                            <option value="Burning">Burning</option>
                                            <option value="Dull Pain">Dull Pain</option>
                                            <option value="Testes Pain">Testes Pain</option>
                                            <option value=" Sensitive to Touch"> Sensitive to Touch</option>
                                        </select> </td><td><select class="form-control">
                                            <option value="DD8">DD8</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select></td>
                                    <td><textarea name="notes" placeholder="click for notes"></textarea> </td>
                                    <td> click for perm does <input type="checkbox" name="permDose" /> </td> </tr>
                                <tr style="text-align:center"> <td colspan="11" class="table-text"><select class="form-control">
                                            <option value="DD11">DD11</option>
                                            <option value="150 MG Sildenafil ">150 MG Sildenafil </option>
                                            <option value="80 MG Vardenafil">80 MG Vardenafil</option>
                                            <option value="80 MG Tadalafil ">80 MG Tadalafil </option>
                                        </select>
                                    </td> <td colspan="11" class="table-text">QTY</td>
                                    <td colspan="11" class="table-text"><select class="form-control">
                                            <option value="DD10">DD10</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select></td>
                                </tr>

                                <tr style="text-align:center"><td class="table-text" colspan="2"> <div class = "panel-row"> Take Home Test Dose C  </div></td><td class="table-text" colspan="2">
                                        <select class="form-control">

                                            <option value="DD9">DD9</option>
                                            <option value="Wesley Pope">Wesley Pope</option>
                                            <option value=" MD - Kisha Farrell"> MD - Kisha Farrell</option>
                                            <option value=" ANP - Justin Henson">ANP - Justin Henson</option>
                                            <option value="ANP - Steven Scholen">ANP - Steven Scholen</option>
                                            <option value="MD">MD</option>
                                        </select> </td> <td class="table-text">QTY </td> <td class="table-text"> <select class="form-control">
                                            <option value="DD10">DD10</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select>
                                    </td></tr>
                                <tr> <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select></td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD2">DD2</option>
                                            <option value="T101">T101</option>
                                            <option value="T105">T105</option>
                                            <option value="T106">T106</option>
                                            <option value="ST1">ST1</option>
                                            <option value="ST9A">ST9A</option>
                                            <option value="ST9E">ST9E</option>
                                            <option value="BM1">BM1</option>
                                            <option value="BM3">BM3</option>
                                            <option value="BM6">BM6</option>
                                            <option value="QUAD4">QUAD4</option>
                                        </select> </td>
                                    <td class="table-text"> + </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD2">DD2</option>
                                            <option value="T101">T101</option>
                                            <option value="T105">T105</option>
                                            <option value="T106">T106</option>
                                            <option value="ST1">ST1</option>
                                            <option value="ST9A">ST9A</option>
                                            <option value="ST9E">ST9E</option>
                                            <option value="BM1">BM1</option>
                                            <option value="BM3">BM3</option>
                                            <option value="BM6">BM6</option>
                                            <option value="QUAD4">QUAD4</option>
                                        </select> </td><td class="table-text"> + </td><td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td><td class="table-text">  <select class="form-control">

                                            <option value="DD3">DD3</option>
                                            <option value="PG40">PG40</option>
                                            <option value="PG80">PG80</option>
                                            <option value="PG150">PG150</option>
                                            <option value="PG250">PG250</option>
                                            <option value="PG350">PG350</option>
                                            <option value="Papaverine">Papaverine</option>
                                            <option value="2% LIDO">2% LIDO</option>

                                        </select>
                                    </td>
                                    <td class="table-text"> + </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td>
                                    <td class="table-text">
                                        <select class="form-control">
                                            <option value="DD3">DD3</option>
                                            <option value="PG40">PG40</option>
                                            <option value="PG80">PG80</option>
                                            <option value="PG150">PG150</option>
                                            <option value="PG250">PG250</option>
                                            <option value="PG350">PG350</option>
                                            <option value="Papaverine">Papaverine</option>
                                            <option value="2% LIDO">2% LIDO</option>

                                        </select></td> </tr>

                                <tr style="text-align:center"><td colspan="11" class="table-text"> <div class = "panel-row"> Call In Results</div></tr>
                                <tr style="text-align:center"><td class="tabel-text">Time</td><td class="tabel-text">%</td><td class="tabel-text">Pain</td><td class="tabel-text">Antidote</td><td class="tabel-text">Notes</td><td class="tabel-text">PERM</td></tr>
                                <tr> <td><span><select class="form-control">DD6
                                                <option>hour</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </span>
                                        <span>
                                            <select class="form-control">
                                                <option> minuts </option>
                                                <option value="0">0</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                                <option value="30">30</option>
                                                <option value="35">35</option>
                                                <option value="40">40</option>
                                                <option value="45">45</option>
                                                <option value="50">50</option>
                                                <option value="55">55</option>
                                                <option value="60">60</option>

                                            </select>
                                        </span>
                                    </td>
                                    <td><select class="form-control">
                                            <option value="DD4">DD4(%)</option>
                                            <option value="0">0</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                        </select> </td>
                                    <td>  <select class="form-control">
                                            <option value="DD7">DD7</option>
                                            <option value="None">None</option>
                                            <option value="Burning">Burning</option>
                                            <option value="Dull Pain">Dull Pain</option>
                                            <option value="Testes Pain">Testes Pain</option>
                                            <option value=" Sensitive to Touch"> Sensitive to Touch</option>
                                        </select> </td><td><select class="form-control">
                                            <option value="DD8">DD8</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select></td>
                                    <td><textarea  placeholder="click for notes" name="notes"></textarea> </td>
                                    <td> click for perm does <input type="checkbox" name="permDose" /> </td> </tr>
                                <tr style="text-align:center"> <td colspan="11" class="table-text"><select class="form-control">
                                            <option value="DD11">DD11</option>
                                            <option value="150 MG Sildenafil ">150 MG Sildenafil </option>
                                            <option value="80 MG Vardenafil">80 MG Vardenafil</option>
                                            <option value="80 MG Tadalafil ">80 MG Tadalafil </option>
                                        </select>
                                    </td> <td colspan="11" class="table-text">QTY</td>
                                    <td colspan="11" class="table-text"><select class="form-control">
                                            <option value="DD10">DD10</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select></td>
                                </tr>
                                <tr><td></td></tr>
                                <tr style="text-align:center"><td colspan="11">Redosing + Expand  - Colapse   Auto deduct from totals</td></tr>
                                <tr  style="text-align:center"><td  colspan="11">Dose D (Auto Populate Next In Alphabet)</td><td  colspan="11">
                                        <select class="form-control">

                                            <option value="DD9">DD9</option>
                                            <option value="Wesley Pope">Wesley Pope</option>
                                            <option value=" MD - Kisha Farrell"> MD - Kisha Farrell</option>
                                            <option value=" ANP - Justin Henson">ANP - Justin Henson</option>
                                            <option value="ANP - Steven Scholen">ANP - Steven Scholen</option>
                                            <option value="MD">MD</option>
                                        </select>
                                    </td><td  colspan="11">QTY</td><td  colspan="11">
                                        <select class="form-control">                
                                            <option value="DD10">DD10</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select></td></tr>
                                <tr> <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select></td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD2">DD2</option>
                                            <option value="T101">T101</option>
                                            <option value="T105">T105</option>
                                            <option value="T106">T106</option>
                                            <option value="ST1">ST1</option>
                                            <option value="ST9A">ST9A</option>
                                            <option value="ST9E">ST9E</option>
                                            <option value="BM1">BM1</option>
                                            <option value="BM3">BM3</option>
                                            <option value="BM6">BM6</option>
                                            <option value="QUAD4">QUAD4</option>
                                        </select> </td>
                                    <td class="table-text"> + </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD2">DD2</option>
                                            <option value="T101">T101</option>
                                            <option value="T105">T105</option>
                                            <option value="T106">T106</option>
                                            <option value="ST1">ST1</option>
                                            <option value="ST9A">ST9A</option>
                                            <option value="ST9E">ST9E</option>
                                            <option value="BM1">BM1</option>
                                            <option value="BM3">BM3</option>
                                            <option value="BM6">BM6</option>
                                            <option value="QUAD4">QUAD4</option>
                                        </select> </td><td class="table-text"> + </td><td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td><td class="table-text">  <select class="form-control">

                                            <option value="DD3">DD3</option>
                                            <option value="PG40">PG40</option>
                                            <option value="PG80">PG80</option>
                                            <option value="PG150">PG150</option>
                                            <option value="PG250">PG250</option>
                                            <option value="PG350">PG350</option>
                                            <option value="Papaverine">Papaverine</option>
                                            <option value="2% LIDO">2% LIDO</option>

                                        </select>
                                    </td>
                                    <td class="table-text"> + </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td>
                                    <td class="table-text">
                                        <select class="form-control">
                                            <option value="DD3">DD3</option>
                                            <option value="PG40">PG40</option>
                                            <option value="PG80">PG80</option>
                                            <option value="PG150">PG150</option>
                                            <option value="PG250">PG250</option>
                                            <option value="PG350">PG350</option>
                                            <option value="Papaverine">Papaverine</option>
                                            <option value="2% LIDO">2% LIDO</option>

                                        </select></td> </tr>

                                <tr style="text-align:center"><td colspan="11" class="table-text"> <div class = "panel-row"> Call In Results</div></tr>
                                <tr style="text-align:center"><td class="tabel-text">Time</td><td class="tabel-text">%</td><td class="tabel-text">Pain</td><td class="tabel-text">Antidote</td><td class="tabel-text">Notes</td><td class="tabel-text">PERM</td></tr>
                                <tr> <td><span><select class="form-control">DD6
                                                <option>hour</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </span>
                                        <span>
                                            <select class="form-control">
                                                <option> minuts </option>
                                                <option value="0">0</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                                <option value="30">30</option>
                                                <option value="35">35</option>
                                                <option value="40">40</option>
                                                <option value="45">45</option>
                                                <option value="50">50</option>
                                                <option value="55">55</option>
                                                <option value="60">60</option>

                                            </select>
                                        </span>
                                    </td>
                                    <td><select class="form-control">
                                            <option value="DD4">DD4(%)</option>
                                            <option value="0">0</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                        </select> </td>
                                    <td>  <select class="form-control">
                                            <option value="DD7">DD7</option>
                                            <option value="None">None</option>
                                            <option value="Burning">Burning</option>
                                            <option value="Dull Pain">Dull Pain</option>
                                            <option value="Testes Pain">Testes Pain</option>
                                            <option value=" Sensitive to Touch"> Sensitive to Touch</option>
                                        </select> </td><td><select class="form-control">
                                            <option value="DD8">DD8</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select></td>
                                    <td><textarea name="notes" placeholder="click for notes"></textarea> </td>
                                    <td> click for perm does <input type="checkbox" name="permDose" /> </td> </tr>
                                <tr style="text-align:center"> <td colspan="11" class="table-text"><select class="form-control">
                                            <option value="DD11">DD11</option>
                                            <option value="150 MG Sildenafil ">150 MG Sildenafil </option>
                                            <option value="80 MG Vardenafil">80 MG Vardenafil</option>
                                            <option value="80 MG Tadalafil ">80 MG Tadalafil </option>
                                        </select>
                                    </td> <td colspan="11" class="table-text">QTY</td>
                                    <td colspan="11" class="table-text"><select class="form-control">
                                            <option value="DD10">DD10</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select></td>
                                </tr>

                                <tr style="text-align:center"><td class="table-text" colspan="2"> <div class = "panel-row"> Take Home Test Dose C  </div></td><td class="table-text" colspan="2">
                                        <select class="form-control">

                                            <option value="DD9">DD9</option>
                                            <option value="Wesley Pope">Wesley Pope</option>
                                            <option value=" MD - Kisha Farrell"> MD - Kisha Farrell</option>
                                            <option value=" ANP - Justin Henson">ANP - Justin Henson</option>
                                            <option value="ANP - Steven Scholen">ANP - Steven Scholen</option>
                                            <option value="MD">MD</option>
                                        </select> </td> <td class="table-text">QTY </td> <td class="table-text"> <select class="form-control">
                                            <option value="DD10">DD10</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select>
                                    </td></tr>
                                <tr> <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select></td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD2">DD2</option>
                                            <option value="T101">T101</option>
                                            <option value="T105">T105</option>
                                            <option value="T106">T106</option>
                                            <option value="ST1">ST1</option>
                                            <option value="ST9A">ST9A</option>
                                            <option value="ST9E">ST9E</option>
                                            <option value="BM1">BM1</option>
                                            <option value="BM3">BM3</option>
                                            <option value="BM6">BM6</option>
                                            <option value="QUAD4">QUAD4</option>
                                        </select> </td>
                                    <td class="table-text"> + </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD2">DD2</option>
                                            <option value="T101">T101</option>
                                            <option value="T105">T105</option>
                                            <option value="T106">T106</option>
                                            <option value="ST1">ST1</option>
                                            <option value="ST9A">ST9A</option>
                                            <option value="ST9E">ST9E</option>
                                            <option value="BM1">BM1</option>
                                            <option value="BM3">BM3</option>
                                            <option value="BM6">BM6</option>
                                            <option value="QUAD4">QUAD4</option>
                                        </select> 
                                    </td>
                                    <td class="table-text"> + </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td>
                                    <td class="table-text">  <select class="form-control">

                                            <option value="DD3">DD3</option>
                                            <option value="PG40">PG40</option>
                                            <option value="PG80">PG80</option>
                                            <option value="PG150">PG150</option>
                                            <option value="PG250">PG250</option>
                                            <option value="PG350">PG350</option>
                                            <option value="Papaverine">Papaverine</option>
                                            <option value="2% LIDO">2% LIDO</option>

                                        </select>
                                    </td>
                                    <td class="table-text"> + </td>
                                    <td class="table-text"><select class="form-control">
                                            <option value="DD1">DD1</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select> </td>
                                    <td class="table-text">
                                        <select class="form-control">
                                            <option value="DD3">DD3</option>
                                            <option value="PG40">PG40</option>
                                            <option value="PG80">PG80</option>
                                            <option value="PG150">PG150</option>
                                            <option value="PG250">PG250</option>
                                            <option value="PG350">PG350</option>
                                            <option value="Papaverine">Papaverine</option>
                                            <option value="2% LIDO">2% LIDO</option>

                                        </select></td> </tr>

                                <tr style="text-align:center"><td colspan="11" class="table-text"> <div class = "panel-row"> Call In Results</div></tr>
                                <tr style="text-align:center"><td class="tabel-text">Time</td><td class="tabel-text">%</td><td class="tabel-text">Pain</td><td class="tabel-text">Antidote</td><td class="tabel-text">Notes</td><td class="tabel-text">PERM</td></tr>
                                <tr> <td><span><select class="form-control">DD6
                                                <option>hour</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </span>
                                        <span>
                                            <select class="form-control">
                                                <option> minuts </option>
                                                <option value="0">0</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="25">25</option>
                                                <option value="30">30</option>
                                                <option value="35">35</option>
                                                <option value="40">40</option>
                                                <option value="45">45</option>
                                                <option value="50">50</option>
                                                <option value="55">55</option>
                                                <option value="60">60</option>

                                            </select>
                                        </span>
                                    </td>
                                    <td><select class="form-control">
                                            <option value="DD4">DD4(%)</option>
                                            <option value="0">0</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="35">35</option>
                                        </select> </td>
                                    <td>  <select class="form-control">
                                            <option value="DD7">DD7</option>
                                            <option value="None">None</option>
                                            <option value="Burning">Burning</option>
                                            <option value="Dull Pain">Dull Pain</option>
                                            <option value="Testes Pain">Testes Pain</option>
                                            <option value=" Sensitive to Touch"> Sensitive to Touch</option>
                                        </select> </td><td><select class="form-control">
                                            <option value="DD8">DD8</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select></td>
                                    <td><textarea  placeholder="click for notes" name="notes"></textarea> </td>
                                    <td> click for perm does <input type="checkbox" name="permDose" /> </td> </tr>
                                <tr><td></td></tr>
                                <tr style="text-align:center"> <td class="tabel-text">Date & Time Stamp received by patient</td><td>Printed by  Lab</td><td class="tabel-text"></td><td class="tabel-text"><select class="form-control">
                                            <option value="DD5">DD5</option>
                                            <option value="DD2 or DD3"> DD2 or DD3</option></select></td>
                                    <td class="tabel-text"><select class="form-control">
                                            <option value="DD10">DD10</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select></td>
                                    <td class="tabel-text">Digital Sign.</td>
                                </tr>

                            </table>
                            <table class="table table-bordered table-striped mb-none">
                                <tr style="text-align:center">
                                    <td class="table-text" colspan="2"> Office Visits </td>
                                </tr>
                                <tr style="text-align:center"> 
                                    <td class="table-text">ED Office Visit   </td><td class="table-text"> 
                                        <select class="form-control">
                                            <option value="DD9">DD9</option>
                                            <option value="Wesley Pope">Wesley Pope</option>
                                            <option value=" MD - Kisha Farrell"> MD - Kisha Farrell</option>
                                            <option value=" ANP - Justin Henson">ANP - Justin Henson</option>
                                            <option value="ANP - Steven Scholen">ANP - Steven Scholen</option>
                                            <option value="MD">MD</option>
                                        </select>  </td><td  class="table-text">Auto deduct from totals</td>
                                </tr>
                                <tr style="text-align:center"> <td colspan = "11" class="table-text">Notes here by physician to include time and date stamp.</td> </tr>
                                <tr><td></td></tr>


                                <tr style="text-align:center"> 
                                    <td class="table-text">Printed by  Lab Auto Populates From Lab Dashboard</td>
                                    <td class="table-text">Shipped Check Box here Auto populates to shipping</td>
                                    <td class="table-text">
                                        <select class="form-control">
                                            <option value="DD10">DD10</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select>
                                    </td>
                                    <td class="table-text">
                                        <select class="form-control">
                                            <option value="DD9">DD9</option>
                                            <option value="Wesley Pope">Wesley Pope</option>
                                            <option value=" MD - Kisha Farrell"> MD - Kisha Farrell</option>
                                            <option value=" ANP - Justin Henson">ANP - Justin Henson</option>
                                            <option value="ANP - Steven Scholen">ANP - Steven Scholen</option>
                                            <option value="MD">MD</option>
                                        </select> 
                                    </td>
                                    <td class="table-text">
                                        <select class="form-control">
                                            <option value="DD5">DD5</option>
                                            <option value="DD2 or DD3"> DD2 or DD3</option>
                                        </select>
                                    </td>
                                    <td class="table-text">
                                        <select class="form-control">
                                            <option value="DD10">DD10</option>
                                            <option value="0.2125">0.2125</option>
                                            <option value="0.1875">0.1875</option>
                                            <option value="0.1625">0.1625</option>
                                            <option value="0.1375">0.1375</option>
                                            <option value="0.1125">0.1125</option>
                                            <option value="0.0875">0.0875</option>
                                            <option value="0.0625">0.0625</option>
                                            <option value="0.0375">0.0375</option>
                                            <option value="0.0125">0.0125</option>
                                        </select>
                                    </td>
                                    <td>
                                        Digital Signature Received by patient Date & Time Stamp received by 
                                        patient Then deducted from Package totals If Shipped box selected Then
                                        Shipping Label Number Appears Here 
                                    </td>
                                </tr>
                                <tr><td></td></tr>
                            </table>
                            <div class="toggle" data-plugin-toggle>
                                <h4 style="text-align:center">Prolyfic ED Therapy</h4>
                                <section class="toggle">
                                    <label>Treatment Log</label>
                                    <div class="toggle-content">

                                        <table class="table table-bordered table-striped mb-none">
                                               <?php
                                                   for($i = 1; $i <=12; $i++){
                                               ?>
                                            <tr style="text-align:center"><td>Treatment <?php echo $i;?></td><td>Auto Populate Date and Time</td><td><input type="checkbox" name="treatment" /></td> <td>Patient Digital Sign For Treatment And Auto Deduct From Treatment Totals</td><td>Starting Erection %</td><td><select class="form-control">
                                                        <option value="DD4"> DD4(%)</option>
                                                        <option value="0">0</option>
                                                        <option value="5">5</option>
                                                        <option value="10">10</option>
                                                        <option value="15">15</option>
                                                        <option value="20">20</option>
                                                        <option value="25">25</option>
                                                        <option value="30">30</option>
                                                        <option value="35">35</option>
                                                    </select></td><td><select class="form-control">
                                                        <option value="DD9">DD9</option>
                                                        <option value="Wesley Pope">Wesley Pope</option>
                                                        <option value=" MD - Kisha Farrell"> MD - Kisha Farrell</option>
                                                        <option value=" ANP - Justin Henson">ANP - Justin Henson</option>
                                                        <option value="ANP - Steven Scholen">ANP - Steven Scholen</option>
                                                        <option value="MD">MD</option>
                                                    </select> </td></tr>
                                            <?php
                                                   }
                                            ?>
                                        </table>



                                    </div>
                                </section>

                            </div>

                  <div class="toggle" data-plugin-toggle>
                            
                                <section class="toggle">
                                    <label>Sublingual Therapy</label>
                                        <div class="toggle-content">

                                            
                                          <table class="table table-bordered table-striped mb-none">
                                             
                                            <tr style="text-align:center"><td>Auto Populate Date</td><td><select class="form-control">
                                                        <option value="DD14"> DD14</option>
                                                        <option value="T1">T1</option>
                                                        <option value="T2">T2</option>
                                                        <option value="T3">T3</option>
                                                        <option value="T4">T4</option>
                                                        <option value="T5">T5</option>
                                                        <option value="T6">T6</option>
                                                        <option value="T7">T7</option>
                                                        <option value="T8">T8</option>
                                                        <option value="T9">T9</option>
                                                        <option value="T10">T10</option>
                                                        <option value="T11">T11</option>
                                                        <option value="T12">T12</option>
                                                    </select></td><td><select class="form-control">
                                                        <option value="DD12"> DD12(MG)</option>
                                                        <option value="10">10</option>
                                                        <option value="20">20</option>
                                                        <option value="30">30</option>
                                                        <option value="40">40</option>
                                                        <option value="50">50</option>
                                                        <option value="60">60</option>
                                                        <option value="70">70</option>
                                                        <option value="80">80</option>
                                                        <option value="90">90</option>
                                                        <option value="100">100</option>
                                                        <option value="110">110</option>
                                                        <option value="120">120</option>
                                                        <option value="120">120</option>
                                                        <option value="130">130</option>
                                                        <option value="140">140</option>
                                                        <option value="150">150</option>
                                                    </select></td>
                                                        <td><select class="form-control">
                                                            <option value="DD13"> DD13</option>
                                                            <option value="Sildenafil">Sildenafil</option>
                                                            <option value="Tadalafil">Tadalafil</option>
                                                            <option value="Vardenafil">Vardenafil</option>
                                                            </select>
                                                        </td>
                                                        <td>Erection</td>
                                                    <td><select class="form-control">
                                                        <option value="DD4"> DD4(%)</option>
                                                        <option value="0">0</option>
                                                        <option value="5">5</option>
                                                        <option value="10">10</option>
                                                        <option value="15">15</option>
                                                        <option value="20">20</option>
                                                        <option value="25">25</option>
                                                        <option value="30">30</option>
                                                        <option value="35">35</option>
                                                    </select></td>
                                                     <td>Notes</td>
                                                     <td><select class="form-control">
                                                        <option value="DD9">DD9</option>
                                                        <option value="Wesley Pope">Wesley Pope</option>
                                                        <option value=" MD - Kisha Farrell"> MD - Kisha Farrell</option>
                                                        <option value=" ANP - Justin Henson">ANP - Justin Henson</option>
                                                        <option value="ANP - Steven Scholen">ANP - Steven Scholen</option>
                                                        <option value="MD">MD</option>
                                                    </select> </td>
                                            </tr>
                                           
                                        </table>



                                        </div>
                                </section>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </form>
        <!-- end: page -->
    </section>

</section>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection