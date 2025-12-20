<?php
// Al inicio del archivo que muestra la lista de propiedades
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /admin/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es-mx">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php
// ...existing code...
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Blog | Krnivoro</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container py-5">
    <h1 class="mb-4">Entradas del Blog</h1>
    <button class="btn btn-primary mb-3" id="crear-articulo">Crear nuevo artículo</button>
    <div class="table-responsive">
        <table id="tabla-blog" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Sección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal para crear/editar -->
<div class="modal fade" id="modalArticulo" tabindex="-1" aria-labelledby="modalArticuloLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalArticuloLabel">Artículo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formArticulo">
                    <input type="hidden" id="articuloId">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <input type="text" class="form-control" id="autor" required>
                    </div>
                    <div class="mb-3">
                        <label for="seccion" class="form-label">Sección</label>
                        <input type="text" class="form-control" id="seccion" required>
                    </div>
                    <div class="mb-3">
                        <label for="contenido" class="form-label">Contenido</label>
                        <textarea class="form-control" id="contenido" rows="6" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    // Simulación: cargar artículos desde archivos markdown
    const articulos = [
        {
            id: '2025-10-17-KRNIVORO-bussiness-week.md',
            titulo: 'KRNIVORO Business Week Lo más importante que debes saber',
            autor: 'Equipo KRNIVORO',
            seccion: 'Negocios & Estrategia',
            contenido: `📈 KRNIVORO Business Week: Lo más importante que debes saber\nPor Equipo KRNIVORO | Octubre 2025 | Sección: Negocios & Estrategia\n...`
        },
        {
            id: '2025-10-17-el-hombre-de-valor.md',
            titulo: 'El Hombre de Valor La filosofía KRNIVORO hecha historia',
            autor: 'Equipo KRNIVORO',
            seccion: 'Mindset & Liderazgo',
            contenido: `*“El Hombre de Valor”** — la filosofía KRNIVORO hecha historia.\nPor Equipo KRNIVORO | Octubre 2025 | Sección: Mindset & Liderazgo\n...`
        }
    ];
    function renderTabla() {
        const tbody = $('#tabla-blog tbody');
        tbody.empty();
        articulos.forEach(function(a, idx) {
            tbody.append(`
                <tr>
                    <td>${a.titulo}</td>
                    <td>${a.autor}</td>
                    <td>${a.seccion}</td>
                    <td>
                        <button class="btn btn-warning btn-sm editar-articulo" data-idx="${idx}">Editar</button>
                        <button class="btn btn-danger btn-sm eliminar-articulo" data-idx="${idx}">Eliminar</button>
                    </td>
                </tr>
            `);
        });
        $('#tabla-blog').DataTable();
    }
    renderTabla();

    // Crear nuevo artículo
    $('#crear-articulo').click(function() {
        $('#formArticulo')[0].reset();
        $('#articuloId').val('');
        $('#modalArticulo').modal('show');
    });

    // Editar artículo
    $(document).on('click', '.editar-articulo', function() {
        const idx = $(this).data('idx');
        const a = articulos[idx];
        $('#articuloId').val(idx);
        $('#titulo').val(a.titulo);
        $('#autor').val(a.autor);
        $('#seccion').val(a.seccion);
        $('#contenido').val(a.contenido);
        $('#modalArticulo').modal('show');
    });

    // Eliminar artículo
    $(document).on('click', '.eliminar-articulo', function() {
        const idx = $(this).data('idx');
        if (confirm('¿Seguro que deseas eliminar este artículo?')) {
            articulos.splice(idx, 1);
            renderTabla();
        }
    });

    // Guardar artículo (crear/actualizar)
    $('#formArticulo').submit(function(e) {
        e.preventDefault();
        const idx = $('#articuloId').val();
        const nuevo = {
            titulo: $('#titulo').val(),
            autor: $('#autor').val(),
            seccion: $('#seccion').val(),
            contenido: $('#contenido').val()
        };
        if (idx === '') {
            articulos.push(nuevo);
        } else {
            articulos[idx] = {...articulos[idx], ...nuevo};
        }
        $('#modalArticulo').modal('hide');
        renderTabla();
    });
});
</script>
</body>
</html>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Puesto</th>
                <th>Empresa</th>
                <th>Ciudad</th>
                <th>Estado</th>
                <th>País</th>
                <th>Aprobado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


                        </div>
                    </div>
                </main>
            </div>
        </div>
    
    <footer id="footer" class="footer dark-background">
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <img src="/assets/img/krnivoro.png" alt="Krnivoro Logo"> 
                    </a>
                    <div class="footer-contact pt-3">
                        <p><a href="tel:+52 661 172 4066">+52 661 172 4066</a></p>
                        <p><a href="mailto:contacto@krnivoro.com">contacto@krnivoro.com</a></p>
                        <p><a href="https://maps.app.goo.gl/rYkPGA6gTngpSu9i8">Rancho Oasis, 22760 Ensenada B.C México</a></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href="https://wa.me/message/5IQRNG5VKJ3IA1"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>

            
                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>Nuestros Servicios</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="/doing-business-at-KRNIVORO.html">Doing Business at KRNIVORO</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/KRNIVORO_sos.html">KRNIVORO SOS</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/KRNIVORO_legal_protection.html">KRNIVORO Legal Protection</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/KRNIVORO-dental-bernal.html">KRNIVORO Dental Bernal & Maxilofacial Excellence</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/KRNIVORO_store.html">KRNIVORO Store – Select Cuts & Premium Nutrition</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/KRNIVORO_outdoor.html">KRNIVORO Outdoor</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12 footer-newsletter">
                    <h4>Solicita un servicio</h4>
                    <p>Selecciona el servicio que deseas solicitar:</p>
                    <form action="forms/newsletter.php" method="post" class="php-email-form">
                        <div class="newsletter-form">
                            <select name="service" id="service" required>
                                <option value="" disabled selected>Selecciona un servicio</option>
                                <option value="Experiencia Gourmet">Experiencia Gourmet</option>
                                <option value="Networking Empresarial">Networking Empresarial</option|>
                            </select>   
                            <input type="submit" value="Solicitar Servicio">
                            
                        </div>
                        <div class="loading">Cargando</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Tu solicitud de suscripción ha sido enviada. ¡Gracias!</div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container text-center">
            <p>© <span>Derechos Reservados</span> <strong class="px-1 sitename">Krnivoro</strong> <span>Todos los derechos reservados</span></p>
            <div class="credits">
                Diseñado por <a href="https://krnivoro.com/">Krnivoro</a>
            </div>
        </div>
    </div>

</footer>
<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<!-- Preloader -->
<!-- <div id="preloader"></div> -->
<!-- Vendor JS Files -->
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/php-email-form/validate.js"></script>
<script src="/assets/vendor/aos/aos.js"></script>
<script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<!-- Main JS File -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    function cargarUsuarios() {
        $.get('/api/usuarios.php', function(usuarios) {
            const tbody = $('#tabla-usuarios tbody');
            tbody.empty();
            usuarios.forEach(function(u) {
                // Filtrar administradores
                if (u.rol && u.rol === 'admin') return;
                let aprobado = u.aprobado == 1 ? 'Sí' : 'No';
                let accion = '';
                if (u.aprobado == 0) {
                    accion = `<button class="btn btn-success btn-sm aprobar-btn" data-id="${u.id}">Aprobar</button>`;
                }
                tbody.append(`
                    <tr>
                        <td>${u.nombre}</td>
                        <td>${u.email}</td>
                        <td>${u.telefono || ''}</td>
                        <td>${u.puesto || ''}</td>
                        <td>${u.empresa || ''}</td>
                        <td>${u.ciudad || ''}</td>
                        <td>${u.estado || ''}</td>
                        <td>${u.pais || ''}</td>
                        <td>${aprobado}</td>
                        <td>${accion}</td>
                    </tr>
                `);
            });
            $('#tabla-usuarios').DataTable();
        });
    }

    cargarUsuarios();

    // Aprobar usuario
    $(document).on('click', '.aprobar-btn', function() {
        const id = $(this).data('id');
        $.ajax({
            url: '/api/usuarios.php?aprobar=1',
            type: 'PUT',
            data: JSON.stringify({id: id}),
            contentType: 'application/json',
            success: function(resp) {
                alert('Usuario aprobado');
                cargarUsuarios();
            },
            error: function() {
                alert('Error al aprobar usuario');
            }
        });
    });
});
</script>
<script src="/assets/js/main.js"></script>
</body>

</html>