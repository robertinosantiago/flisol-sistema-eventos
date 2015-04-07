<!DOCTYPE html>
<html lang="en">
    <head prefix="og: http://ogp.me/ns#">
        <meta property="og:title" content="FLISoL - Festival Latino-americano de Instalação de Software Livre">
        <meta property="og:locale" content="pt_BR">

        <link rel="canonical" href="<?php echo Router::url(null, true); ?>">
        <meta property="og:url" content="<?php echo Router::url(null, true); ?>">

        <meta property="og:site_name" content="FLISoL - Festival Latino-americano de Instalação de Software Livre">

        <meta name="description" content="O FLISoL - Festival Latino-americano de Instalação do Sofware Livre ocorrerá no dia 25 de abril de 2015, em Jandaia do Sul. Serão ofertados, além do InstallFest, palestras e minicursos. Participe. Faça sua inscrição!">
        <meta property="og:description" content="O FLISoL - Festival Latino-americano de Instalação do Sofware Livre ocorrerá no dia 25 de abril de 2015, em Jandaia do Sul. Serão ofertados, além do InstallFest, palestras e minicursos. Participe. Faça sua inscrição!">

        <meta property="og:image" content="<?php echo $this->Html->url('/img/site/flisol-200x200.png', true); ?>">
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="200">
        <meta property="og:image:height" content="200">

        <meta name="robots" content="index, follow">
        <meta name="keywords" content="flisol, 2015, software livre, open source, jandaia do sul, jandaia, festival, latino-americano, instalação, linux, software, livre, evento">

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FLISoL 2015 - Jandaia do Sul - PR</title>

        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $this->Html->url('/', true); ?>apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $this->Html->url('/', true); ?>apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $this->Html->url('/', true); ?>apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $this->Html->url('/', true); ?>apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $this->Html->url('/', true); ?>apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $this->Html->url('/', true); ?>apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $this->Html->url('/', true); ?>apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $this->Html->url('/', true); ?>apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $this->Html->url('/', true); ?>apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $this->Html->url('/', true); ?>android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $this->Html->url('/', true); ?>favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $this->Html->url('/', true); ?>favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $this->Html->url('/', true); ?>favicon-16x16.png">
        <link rel="manifest" href="<?php echo $this->Html->url('/', true); ?>manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo $this->Html->url('/', true); ?>ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('site/bootstrap-site');
        echo $this->Html->css('site/style');
        ?>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <section id="header" class="appear"></section>
        <nav class="navbar navbar-default navbar-fixed-top" data-0="min-height:95px; height:95px; background-color:rgba(0,0,0,0.3);" data-200="min-height:70px; height:70px; background-color:rgba(0,0,0,1);">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand" id="logo" data-0="width:153px; height:92px;" data-200="width:299px; height:70px;">
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="collapse-menu">
                    <ul class="nav navbar-nav navbar-main">
                        <li class="active"><a href="<?php echo $this->Html->url(array('controller' => 'Editions', 'action' => 'site'), true); ?>" data-0="line-height: 55px; font-size: 14pt;" data-200="line-height: 30px; font-size: 11pt;">Início <span class="sr-only">(atual)</span></a></li>
                        <li><a href="#programacao" data-0="line-height: 55px; font-size: 14pt;" data-200="line-height: 30px; font-size: 11pt;">Programação</a></li>
                        <li><a href="#section-map" data-0="line-height: 55px; font-size: 14pt;" data-200="line-height: 30px; font-size: 11pt;">Localização</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo $this->Html->url(array('controller' => 'Editions', 'action' => 'home'), true); ?>" data-0="line-height: 55px; font-size: 14pt;" data-200="line-height: 30px; font-size: 11pt;">Inscrição</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <section id="sobre" class="section">
            <div class="container">
                <div class="row">
                    <?php echo $this->Html->image('site/FLISoL-2015-grande.png', array('alt' => 'Logo Flisol', 'class' => 'center-block img-responsive')); ?>
                    <p class="text-justify">O Festival Latino-americano de Instalação de Software Livre (FLISol) é o maior evento da América Latina de divulgação de Software Livre. Este evento é realizado desde o ano de 2005 e desde 2008 sua realização ocorre no 4º sábado do mês de Abril de cada ano.</p>
                    <p class="text-justify">O principal objetivo do evento é promover o uso de software livre, apresentando ao público em geral sua filosofia, alcance, avanços e desafios.</p>
                    <p class="text-justify">Para tal finalidade, várias comunidades de software livre (em cada país / cidade), organizam simultaneamente eventos em que se instala, de maneira gratuita e totalmente legalizada, software livre nos computadores dos participantes interessados.</p>
                    <p class="text-justify">Também, de maneira paralela, são oferecidas palestras, apresentações e workshops sobre assuntos temáticos regionais, nacionais e latino-americanos em torno do Software Livre, em toda sua gama de expressão: artística, acadêmica, empresarial e social.</p>
                    <p class="text-justify">Em 2015, o evento ocorrerá no dia 25 de abril. Neste dia serão ofertadas atividades no período diurno.</p>

                </div>

            </div>
        </section>
        <section class="section" id="colaboradores">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Colaboradores</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <ul>
                            <li>Prof. Me. Robertino Mendes Santiago Jr (Coordenador) - <a href="email:robertino@ufpr.br">robertino@ufpr.br</a></li>
                            <li>Prof. Me. Alexandre Prusch Züge - <a href="email:alexandrezuge@ufpr.br">alexandrezuge@ufpr.br</a></li>
                            <li>Prof. Me. Andre Luiz Gazoli de Oliveira - <a href="email:andre.gazoli@ufpr.br">andre.gazoli@ufpr.br</a></li>
                            <li>Charles Masaharu Sakai - <a href="email:sakai@ufpr.br">sakai@ufpr.br</a></li>
                            <li>João Bosco Cavalcante Albuquerque - <a href="email:joao.br@live.com">joao.br@live.com</a></li>
                            <li>Profa. Marcia Maria Carlos - <a href="email:marciacarlos1@gmail.com">marciacarlos1@gmail.com</a></li>
                            <li>Marcus Vinicius Bertoncello - <a href="email:marcusbertoncello@ufpr.br">marcusbertoncello@ufpr.br</a></li>
                            <li>Prof. Dr. Rodrigo Clemente Thom de Souza - <a href="email:thom@ufpr.br">thom@ufpr.br</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul>
                            <li>Prof. Me. Carlos Roberto Beleti Jr (Vice-coordenador) - <a href="email:carlosbeleti@ufpr.br">carlosbeleti@ufpr.br</a></li>
                            <li>Prof. Anderson Mine Fernandes - <a href="email:anderson@faculdadealfaumuarama.com.br">anderson@faculdadealfaumuarama.com.br</a></li>
                            <li>Antonio Carlos Sanches Souto Junior - <a href="email:juniorsouto44@gmail.com">juniorsouto44@gmail.com</a></li>
                            <li>João Aparecido Martioro - <a href="email:joaomartioro@gmail.com">joaomartioro@gmail.com</a></li>
                            <li>Kleber Kiyomassa Shimabucuro - <a href="email:amperhigh@gmail.com">amperhigh@gmail.com</a></li>
                            <li>Marcio Costa - <a href="email:marciomccosta@gmail.com">marciomccosta@gmail.com</a></li>
                            <li>Matheus Vinicius Correa - <a href="email:matheusviniciuscorrea@gmail.com">matheusviniciuscorrea@gmail.com</a></li>
                            <li>Prof. Me. Rogério Ferreira da Silva - <a href="email:rogerio.ferreira@ufpr.br">rogerio.ferreira@ufpr.br</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="section appear" id="programacao" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Palestras</h2>
                        <p class="small">Das 08:00 às 11:30</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?php echo $this->Html->image('site/anderson.png', array('alt' => 'Anderson Mine Fernandes', 'class' => 'img-circle center-block img-responsive')); ?>
                        <h3 class="text-center">Programação Front-End com Bootstrap</h3>
                        <p class="text-center">Anderson Mine Fernandes</p>
                        <p class="text-center">Formado em Processamento de Dados, Especialista em Comércio Eletrônico e Mestrando em Informática. Trabalha com Web desde 1998, é Programador PHP e Javascript. Atua como Coordenador e Professor de Sistemas para Internet da Faculdade ALFA, Professor de Pós-Graduação e é Sócio da Uniti TI, onde possui parceria  e mantém as Lojas Virtuais do Mundo Canibal, Vida de Programador, Vida de Suporte, Piadas Nerds, Tudo Interessante e Bacon is Life.</p>
                    </div>
                    <div class="col-lg-6">
                        <?php echo $this->Html->image('site/gazoli.png', array('alt' => 'André Luiz Gazoli de Oliveira', 'class' => 'img-circle center-block img-responsive')); ?>
                        <h3 class="text-center">ODOO: ERP Open Source</h3>
                        <p class="text-center">André Luiz Gazoli de Oliveira</p>
                        <p class="text-center">Doutorando no Programa de Pós-Graduação em Engenharia de Produção e Sistemas de PUCPR, Mestre em Engenharia de Produção e Sistemas pela PUCPR, Especialista em Gestão Estratégica da Produção pela UTFPR e graduado em Engenharia de Produção pela PUCPR. Profissionalmente, foi analista de processos, desenvolvendo as seguintes atividades: Desenvolvimento e acompanhamento de indicadores de produção, planejamento e controle da produção, análise de capacidade produtiva, análise de viabilidade de produtos, auditor interno de qualidade (ISO 9001:2008).</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?php echo $this->Html->image('site/joaomartioro.png', array('alt' => 'João Aparecido Martioro', 'class' => 'img-circle center-block img-responsive')); ?>
                        <h3 class="text-center">Distribuição Ubuntu Linux</h3>
                        <p class="text-center">João Aparecido Martioro</p>
                        <p class="text-center">Estudante do curso de Licenciatura em Computação da Universidade Federal do Paraná em Jandaia do Sul.</p>
                    </div>
                    <div class="col-lg-6">
                        <?php echo $this->Html->image('site/joaobosco.png', array('alt' => 'João Bosco Cavalcante Albuquerque', 'class' => 'img-circle center-block img-responsive')); ?>
                        <h3 class="text-center">Distribuição Arch Linux</h3>
                        <p class="text-center">João Bosco Cavalcante Albuquerque</p>
                        <p class="text-center">Estudante do curso de Licenciatura em Computação da Universidade Federal do Paraná em Jandaia do Sul.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?php echo $this->Html->image('site/matheus.png', array('alt' => 'Matheus Vinicius Correa', 'class' => 'img-circle center-block img-responsive')); ?>
                        <h3 class="text-center">Ferramentas de automação de front-end</h3>
                        <p class="text-center">Matheus Vinicius Correa</p>
                        <p class="text-center">Estudante do curso de Licenciatura em Computação da Universidade Federal do Paraná em Jandaia do Sul.</p>
                    </div>
                    <div class="col-lg-6">
                        <?php echo $this->Html->image('site/marcio.png', array('alt' => 'Marcio Costa', 'class' => 'img-circle center-block img-responsive')); ?>
                        <h3 class="text-center">Clonezilla e DRBL: uso em parque tecnológico</h3>
                        <p class="text-center">Marcio Costa</p>
                        <p class="text-center">Graduado em Redes de Computadores pela UniCesumar e Pós-graduado em MBA em TI. Atua na área de informática desde 1991. Atualmente trabalha na CELEPAR onde já participou em mais de 20 eventos (Multirão / UPS).</p>
                    </div>

                </div>

            </div>

        </section>

        <section class="section" id="minicursos">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Mini-cursos</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <?php echo $this->Html->image('site/anderson.png', array('alt' => 'Anderson Mine Fernandes', 'class' => 'img-circle center-block img-responsive')); ?>
                        <h3 class="text-center">Introdução ao Bootstrap</h3>
                        <p class="text-center">Anderson Mine Fernandes</p>
                        <p class="text-center small">Duração: 4 horas - das 13:30 às 17:30</p>
                        <p class="text-center">Bootstrap é um elegante, intuitivo e poderoso framework front-end para tornar mais rápido e fácil o desenvolvimento web, criado por Mark Otto e Jacob Thornton.</p>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Html->image('site/robertino.jpg', array('alt' => 'Robertino Mendes Santiago Junior', 'class' => 'img-circle center-block img-responsive')); ?>
                        <h3 class="text-center">Introdução ao CakePHP</h3>
                        <p class="text-center">Robertino Mendes Santiago Junior</p>
                        <p class="text-center small">Duração: 2 horas - das 13:30 às 15:30</p>
                        <p class="text-center">CakePHP é um framework escrito em PHP que tem como principais objetivos oferecer uma estrutura que possibilite aos programadores de PHP de todos os níveis desenvolverem aplicações robustas rapidamente, sem perder flexibilidade.</p>
                    </div>
                    <div class="col-lg-4">
                        <?php echo $this->Html->image('site/zuge.jpg', array('alt' => 'Alexandre Prusch Zuge', 'class' => 'img-circle center-block img-responsive')); ?>
                        <h3 class="text-center">Introdução ao SageMath</h3>
                        <p class="text-center">Alexandre Prusch Züge</p>
                        <p class="text-center small">Duração: 2 horas - das 15:30 às 17:30</p>
                        <p class="text-center"> SageMath é um software matemático com características que abrangem diversos aspectos da matemática, incluindo álgebra, análise combinatória, matemática numérica, teoria dos números e cálculo.</p>
                    </div>
                </div>

            </div>
        </section>

        <section class="section" id="installfest">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>InstallFest</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p class="text-justify">O InstallFest é uma atividade em que um grupo de participantes da organização do evento promovem a instalação de softwares livres aos participantes do evento que trouxerem seus computadores.</p>
                        <p class="text-justify">O proprietário do computador é responsável por realizar a cópia de segurança de seus dados e a instalação dos software pode ser feita ou assistida por um representante da organização do evento.</p>
                        <p class="text-justify">O evento ocorrerá concomitante às palestras e aos minicursos.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-map" class="clearfix appear section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Localização</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <h3>Palestras</h3>
                        <h4>Auditório Municipal de Jandaia do Sul</h4>
                        <p>Praça do Café, Centro, Jandaia do Sul - PR, 86900-000</p>
                    </div>
                    <div class="col-lg-6">
                        <h3>Minicursos</h3>
                        <h4>UFPR - Câmpus Avançado em Jandaia do Sul</h4>
                        <p>Rua Doutor João Maximiano, 426 - Vila Operária, Jandaia do Sul - PR, 86900-000<br>
                            Fone-Fax: 43 3432 4627</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h3>InstallFest</h3>
                        <p>Das 08:00 às 11:30 - Auditório Municipal de Jandaia do Sul</p>
                        <p>Das 13:30 às 17:30 - UFPR - Câmpus Avançado em Jandaia do Sul</p>
                    </div>
                </div>
            </div>

            <div id="map"></div>
        </section>

        <section id="apoio" class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Realização</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="http://www.jandaiadosul.ufpr.br/" target="_blank" title="UFPR Jandaia do Sul">
                                    <?php echo $this->Html->image('site/ufpr.png', array('alt' => 'UFPR Jandaia do Sul', 'class' => 'img-responsive center-block')); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Colaboração</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="http://www.jandaiadosul.pr.gov.br" target="_blank" title="Prefeitura Municipal de Jandaia do Sul">
                                    <?php echo $this->Html->image('site/prefeitura.png', array('alt' => 'Prefeitura Municipal de Jandaia do Sul', 'class' => 'img-responsive center-block')); ?>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="http://www.novatec.com.br/" target="_blank" title="Novatec Editora">
                                    <?php echo $this->Html->image('site/novatec.png', array('alt' => 'Novatec Editora', 'class' => 'img-responsive center-block')); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Apoio</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="http://www.valdarmoveis.com.br" target="_blank" title="Valdar Móveis">
                                    <?php echo $this->Html->image('site/valdar.png', array('alt' => 'Valdar Móveis', 'class' => 'img-responsive center-block')); ?>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="http://www.metafa.com.br" target="_blank" title="Metafa">
                                    <?php echo $this->Html->image('site/metafa.png', array('alt' => 'Metafa', 'class' => 'img-responsive center-block')); ?>
                                </a>
                            </div>
                            <div class="col-lg-6">
                                <a href="http://www.autoescolajandaia.com.br/" target="_blank" title="Auto Escola Jandaia">
                                    <?php echo $this->Html->image('site/autoescolajandaia.png', array('alt' => 'Auto Escola Jandaia', 'class' => 'img-responsive center-block')); ?>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="http://www.rabassi.com.br/" target="_blank" title="Rabassi Informática">
                                    <?php echo $this->Html->image('site/rabassi.png', array('alt' => 'Rabassi Informática', 'class' => 'img-responsive center-block')); ?>
                                </a>
                            </div>
                            <div class="col-lg-6">
                                <a href="http://www.hashimotocorretordeimoveis.com.br/" target="_blank" title="Hashimoto Corretor de Imóveis">
                                    <?php echo $this->Html->image('site/hashimoto.png', array('alt' => 'Hashimoto Corretor de Imóveis', 'class' => 'img-responsive center-block')); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="rodape">
            <div class="container">
                <div class="row">
                    <p class="text-right">Baseado no tema: <a href="http://bootstraptaste.com/free-one-page-bootstrap-template-amoeba/" title="Amoeba Theme" target="_blank">Amoeba</a></p>
                </div>
            </div>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2c5xZG4J3N5hAfuW2eWOqeJeUcrrH6wA&sensor=false"></script>

        <?php echo $this->Html->script(array('site/modernizr-2.6.2-respond-1.1.0.min', 'site/stellar')); ?>
        <?php echo $this->Html->script(array('site/skrollr.min', 'site/jquery.appear', 'site/jquery.easing.1.3')); ?>
        <?php echo $this->Html->script(array('site/jquery.scrollTo-1.4.3.1-min', 'site/jquery.localscroll-1.2.7-min')); ?>
        <?php echo $this->Html->script('site/main'); ?>

        <script type="text/javascript">
            function init() {
                var posUfpr = new google.maps.LatLng(-23.596947, -51.649038);
                var posAuditorio = new google.maps.LatLng(-23.600913, -51.645484);
                var posCenter = new google.maps.LatLng(-23.598689, -51.648249);

                var mapOptions = {
                    zoom: 16,
                    center: posCenter,
                    styles: [{featureType: "all", elementType: "all", stylers: [{invert_lightness: true}, {saturation: 10}, {lightness: 30}, {gamma: 0.5}, {hue: "#1C705B"}]}]
                };
                var mapElement = document.getElementById('map');
                var map = new google.maps.Map(mapElement, mapOptions);

                var descriptionUfpr = '<div id="content" class="map-text"><div id="siteNotice></div>"' +
                        '<h1 id="firstHeading" class="firstHeading">Minicursos</h1>' +
                        '<div id="bodyContent">' +
                        '<p><b>Universidade Federal do Paraná</b></p>' +
                        '<p>Câmpus Avançado em Jandaia do Sul</p>' +
                        '<p>Rua Doutor João Maximiano, 426 - Vila Operária, Jandaia do Sul - PR, 86900-000</p>' +
                        '<p>Fone-Fax: 43 3432 4627</p>' +
                        '</div></div>';

                var windowUfpr = new google.maps.InfoWindow({
                    content: descriptionUfpr
                });

                var markerUfpr = new google.maps.Marker({
                    position: posUfpr,
                    map: map,
                    title: 'UFPR - Universidade Federal do Paraná'
                });

                var descriptionAuditorio = '<div id="content" class="map-text"><div id="siteNotice></div>"' +
                        '<h1 id="firstHeading" class="firstHeading">Palestras</h1>' +
                        '<div id="bodyContent">' +
                        '<p><b>Auditório Municipal de Jandaia do Sul</b></p>' +
                        '<p>Praça do Café - Centro, Jandaia do Sul - PR, 86900-000</p>' +
                        '</div></div>';

                var windowAuditorio = new google.maps.InfoWindow({
                    content: descriptionAuditorio
                });

                var markerAuditorio = new google.maps.Marker({
                    position: posAuditorio,
                    map: map,
                    title: 'UFPR - Universidade Federal do Paraná'
                });

                google.maps.event.addListener(
                        markerUfpr,
                        'click',
                        function () {
                            windowUfpr.open(map, markerUfpr);
                        });

                google.maps.event.addListener(
                        markerAuditorio,
                        'click',
                        function () {
                            windowAuditorio.open(map, markerAuditorio);
                        });

            }
            google.maps.event.addDomListener(window, 'load', init);
        </script>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-49816123-1', 'auto');
            ga('send', 'pageview');

        </script>
    </body>
</html>
