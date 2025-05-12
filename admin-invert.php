<!-- CONTENIDO DE GESTIÓN DE INVERSIONES (ADMIN CON DATATABLES Y MODALES MEJORADOS) - INICIO -->
<div class="container">
    <div class="page-inner">
        <!-- Contenedor Padre para Pestañas y Contenido -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Panel de Gestión de Inversiones</div>
                            <!-- Puedes añadir botones globales aquí si es necesario -->
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills nav-secondary nav-pills-no-bd mb-3" id="pills-tab-inversiones"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-oportunidades-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-oportunidades" type="button" role="tab"
                                    aria-controls="pills-oportunidades" aria-selected="true">Oportunidades</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-inversores-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-inversores" type="button" role="tab"
                                    aria-controls="pills-inversores" aria-selected="false">Inversores</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-solicitudes-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-solicitudes" type="button" role="tab"
                                    aria-controls="pills-solicitudes" aria-selected="false">Solicitudes</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent-inversiones">
                            <!-- Pestaña: Oportunidades de Inversión -->
                            <div class="tab-pane fade show active" id="pills-oportunidades" role="tabpanel"
                                aria-labelledby="pills-oportunidades-tab">
                                <div class="d-flex align-items-center mb-3">
                                    <h4 class="mb-0">Listado de Oportunidades</h4>
                                    <button class="btn btn-primary btn-round ms-auto"
                                        onclick="prepareCreateOpportunityModal()">
                                        <i class="fa fa-plus"></i> Nueva Oportunidad
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table id="opportunitiesTable" class="display table table-striped table-hover"
                                        style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Proyecto</th>
                                                <th>Sector</th>
                                                <th>Monto Buscado</th>
                                                <th>Progreso</th>
                                                <th>Estado</th>
                                                <th style="width: 15%">Acciones</th>
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                </div>
                            </div>

                            <!-- Pestaña: Inversores Registrados -->
                            <div class="tab-pane fade" id="pills-inversores" role="tabpanel"
                                aria-labelledby="pills-inversores-tab">
                                <h4 class="mb-3">Listado de Inversores</h4>
                                <div class="table-responsive">
                                    <table id="investorsTable" class="display table table-striped table-hover"
                                        style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Email</th>
                                                <th>Tipo</th>
                                                <th>Intereses</th>
                                                <th style="width: 10%">Acciones</th>
                                            </tr>
                                        </thead>
                                      
                                    </table>
                                </div>
                            </div>

                            <!-- Pestaña: Solicitudes de Inversión -->
                            <div class="tab-pane fade" id="pills-solicitudes" role="tabpanel"
                                aria-labelledby="pills-solicitudes-tab">
                                <h4 class="mb-3">Solicitudes de Inversión</h4>
                                <div class="table-responsive">
                                    <table id="investmentRequestsTable" class="display table table-striped table-hover"
                                        style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>ID Sol.</th>
                                                <th>Proyecto</th>
                                                <th>Inversor</th>
                                                <th>Monto Ofertado</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th style="width: 15%">Acciones</th>
                                            </tr>
                                        </thead>
                                        
                                    </table>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div> 

    </div>
</div>

<!-- Modal Crear/Editar Oportunidad de Inversión -->
<div class="modal fade" id="opportunityModal" tabindex="-1" aria-labelledby="opportunityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl"> {/* modal-xl para más espacio */}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="opportunityModalLabel">Nueva Oportunidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="opportunityForm">
                    <input type="hidden" id="opportunityId" name="opportunityId">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label for="oppProjectName" class="form-label">Nombre del Proyecto/Startup <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="oppProjectName" name="projectName" required>
                            </div>
                            <div class="mb-3">
                                <label for="oppFullDescription" class="form-label">Descripción Completa <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="oppFullDescription" name="fullDescription" rows="10"
                                    placeholder="Detalles del proyecto, equipo, mercado, etc. (Considerar WYSIWYG)"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Detalles Financieros</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="oppAmountNeeded" class="form-label">Monto Buscado (USD) <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="oppAmountNeeded"
                                            name="amountNeeded" placeholder="Ej: 100000" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="oppEquityOffered" class="form-label">Equity Ofrecido (%)</label>
                                        <input type="number" class="form-control" id="oppEquityOffered"
                                            name="equityOffered" step="0.1" placeholder="Ej: 10">
                                    </div>
                                    <div class="mb-3">
                                        <label for="oppValuation" class="form-label">Valoración Pre-Money (USD)</label>
                                        <input type="number" class="form-control" id="oppValuation" name="valuation"
                                            placeholder="Ej: 1000000">
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Configuración</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="oppSector" class="form-label">Sector <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="oppSector" name="sector" required>
                                            <option value="">Seleccionar...</option>
                                            <option>Tecnología Limpia</option>
                                            <option>Salud y Bienestar</option>
                                            <option>Agritech</option>
                                            <option>Fintech</option>
                                            <option>E-commerce</option>
                                            <option>Educación</option>
                                            <option>Otro</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="oppStatus" class="form-label">Estado <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="oppStatus" name="status" required>
                                            <option value="pendiente_revision">Pendiente Revisión</option>
                                            <option value="activa">Activa (Publicada)</option>
                                            <option value="en_financiacion">En Financiación</option>
                                            <option value="financiada_completamente">Financiada Completamente</option>
                                            <option value="cerrada">Cerrada</option>
                                            <option value="rechazada">Rechazada</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="oppBusinessPlan" class="form-label">Plan de Negocios (PDF)</label>
                                        <input type="file" class="form-control" id="oppBusinessPlan" name="businessPlan"
                                            accept=".pdf">
                                        <small id="currentBusinessPlan" class="d-block mt-1"
                                            style="display:none;">Actual: <a href="#" target="_blank"></a></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="oppShortDescription" class="form-label">Descripción Corta (para listados) <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" id="oppShortDescription" name="shortDescription" rows="2"
                            maxlength="200" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="saveOpportunityButton"
                    onclick="saveOpportunity()">Guardar Oportunidad</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver Detalles de Oportunidad -->
<div class="modal fade" id="viewOpportunityModal" tabindex="-1" aria-labelledby="viewOpportunityModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewOpportunityModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8">
                        <h3 id="viewOppProjectName" class="fw-bold mb-0"></h3>
                        <p class="text-muted mb-2"><i class="fas fa-briefcase me-1"></i> Sector: <span
                                id="viewOppSector"></span> | <i class="fas fa-clipboard-check me-1"></i> Estado: <span
                                id="viewOppStatus" class="badge"></span></p>

                        <div class="card card-round">
                            <div class="card-body">
                                <div class="card-title fw-mediumbold">Descripción Completa</div>
                                <div id="viewOppFullDescription" style="max-height: 300px; overflow-y:auto;"></div>
                                <hr>
                                <p><strong>Plan de Negocios:</strong> <a id="viewOppBusinessPlanLink" href="#"
                                        target="_blank">Descargar/Ver</a> <span id="noBusinessPlanMsg"
                                        style="display:none;">No disponible</span></p>
                            </div>
                        </div>

                        <div class="card card-round mt-3">
                            <div class="card-header">
                                <h5 class="card-title">Inversores Participantes (<span
                                        id="viewOppInvestorsCount">0</span>)</h5>
                            </div>
                            <div class="card-body">
                                <div id="viewOppInvestorsListContainer" class="list-group"
                                    style="max-height: 250px; overflow-y: auto;">
                                    {/* Lista de inversores se agregará aquí */}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-stats card-primary card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center"><i class="fas fa-dollar-sign"></i></div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Monto Buscado</p>
                                            <h4 class="card-title" id="viewOppAmountNeeded"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-stats card-success card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center"><i class="fas fa-piggy-bank"></i></div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Monto Recaudado</p>
                                            <h4 class="card-title" id="viewOppAmountRaised"></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-2">
                                    <div id="viewOppProgressBar" class="progress-bar" role="progressbar"
                                        style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-stats card-info card-round">
                            <div class="card-body">
                                <p><strong>Equity Ofrecido:</strong> <span id="viewOppEquityOffered"
                                        class="fw-bold"></span>%</p>
                                <p><strong>Valoración Pre-Money:</strong> <span id="viewOppValuation"
                                        class="fw-bold"></span></p>
                            </div>
                        </div>
                        <div class="card card-round">
                            <div class="card-header">
                                <h5 class="card-title">Historial</h5>
                            </div>
                            <div class="card-body" style="max-height: 250px; overflow-y:auto;">
                                <ul class="timeline timeline-investment-item ps-1" id="viewOppTimeline"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver Perfil de Inversor -->
<div class="modal fade" id="viewInvestorModal" tabindex="-1" aria-labelledby="viewInvestorModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewInvestorModalLabel">Perfil del Inversor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card card-profile">
                    <div class="card-header" style="background-image: url('assets/img/blogpost.jpg')"> {/* Placeholder
                        */}
                        <div class="profile-picture">
                            <div class="avatar avatar-xl">
                                <img id="investorProfileAvatar" src="assets/img/profile.jpg" alt="Avatar"
                                    class="avatar-img rounded-circle" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="user-profile text-center">
                            <div class="name fw-bold fs-3" id="investorProfileName"></div>
                            <div class="job" id="investorProfileType"></div>
                            <div class="desc" id="investorProfileInterests"></div>
                            <div class="social-media">
                                <a id="investorProfileEmailLink" class="btn btn-info btn-sm btn-link" href="#"><span
                                        class="btn-label just-icon"><i class="far fa-envelope"></i></span></a>
                                {/* Más redes sociales si están disponibles */}
                            </div>
                        </div>
                        <hr>
                        <h5 class="mt-2 fw-bold">Detalles Adicionales</h5>
                        <p id="investorProfileDetails"></p>
                        <h5 class="mt-3 fw-bold">Historial de Inversiones en la Plataforma</h5>
                        <ul id="investorProfileInvestmentsList" class="list-group">
                            {/* Se llenará con JS */}
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="row user-stats text-center">
                            <div class="col">
                                <div class="number" id="investorProfileTotalInvestments">0</div>
                                <div class="title">Inversiones</div>
                            </div>
                            <div class="col">
                                <div class="number" id="investorProfileTotalAmount">N/A</div>
                                <div class="title">Monto Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver Detalles de Solicitud de Inversión -->
<div class="modal fade" id="viewRequestDetailsModal" tabindex="-1" aria-labelledby="viewRequestDetailsModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewRequestDetailsModalLabel">Detalles de Solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID Solicitud:</strong> <span id="reqDetailId"></span></p>
                <p><strong>Proyecto:</strong> <span id="reqDetailProjectName" class="fw-bold"></span></p>
                <p><strong>Inversor:</strong> <span id="reqDetailInvestorName" class="fw-bold"></span> (<a href="#!"
                        id="reqDetailInvestorProfileLink" onclick="">Ver perfil</a>)</p>
                <p><strong>Monto Ofrecido:</strong> <span id="reqDetailAmountOffered"
                        class="form-control-plaintext-strong"></span></p>
                <p><strong>Fecha de Solicitud:</strong> <span id="reqDetailDate"></span></p>
                <p><strong>Estado Actual:</strong> <span id="reqDetailStatus" class="badge"></span></p>
                <div class="card mt-2">
                    <div class="card-body bg-light">
                        <h6 class="card-title">Mensaje del Inversor:</h6>
                        <blockquote class="blockquote mb-0">
                            <p id="reqDetailMessage" class="fst-italic">...</p>
                        </blockquote>
                    </div>
                </div>
                <hr>
                <div id="reqDetailAdminActions" class="mt-3">
                    <h5 class="mb-2">Acciones Administrativas:</h5>
                    <button class="btn btn-success btn-round me-2"
                        onclick="processInvestmentRequestFromModal('aprobar')"><i class="fa fa-check-circle"></i>
                        Aprobar Inversión</button>
                    <button class="btn btn-danger btn-round me-2"
                        onclick="processInvestmentRequestFromModal('rechazar')"><i class="fa fa-times-circle"></i>
                        Rechazar Inversión</button>
                    <button class="btn btn-warning btn-round" onclick="contactInvestorFromRequest()"><i
                            class="fa fa-envelope"></i> Contactar Inversor</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="opportunityModal" tabindex="-1" aria-labelledby="opportunityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="opportunityModalLabel">Nueva Oportunidad</h5> <button type="button"
                    class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="opportunityForm"> <input type="hidden" id="opportunityId" name="opportunityId">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3"> <label for="oppProjectName" class="form-label">Nombre del
                                    Proyecto/Startup <span class="text-danger">*</span></label> <input type="text"
                                    class="form-control" id="oppProjectName" name="projectName" required> </div>
                            <div class="mb-3"> <label for="oppFullDescription" class="form-label">Descripción Completa
                                    <span class="text-danger">*</span></label> <textarea class="form-control"
                                    id="oppFullDescription" name="fullDescription" rows="10"
                                    placeholder="Detalles del proyecto, equipo, mercado, etc. (Considerar WYSIWYG)"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Detalles Financieros</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3"> <label for="oppAmountNeeded" class="form-label">Monto Buscado
                                            (USD) <span class="text-danger">*</span></label> <input type="number"
                                            class="form-control" id="oppAmountNeeded" name="amountNeeded"
                                            placeholder="Ej: 100000" required> </div>
                                    <div class="mb-3"> <label for="oppEquityOffered" class="form-label">Equity Ofrecido
                                            (%)</label> <input type="number" class="form-control" id="oppEquityOffered"
                                            name="equityOffered" step="0.1" placeholder="Ej: 10"> </div>
                                    <div class="mb-3"> <label for="oppValuation" class="form-label">Valoración Pre-Money
                                            (USD)</label> <input type="number" class="form-control" id="oppValuation"
                                            name="valuation" placeholder="Ej: 1000000"> </div>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6 class="card-title mb-0">Configuración</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3"> <label for="oppSector" class="form-label">Sector <span
                                                class="text-danger">*</span></label> <select class="form-select"
                                            id="oppSector" name="sector" required>
                                            <option value="">Seleccionar...</option>
                                            <option>Tecnología Limpia</option>
                                            <option>Salud y Bienestar</option>
                                            <option>Agritech</option>
                                            <option>Fintech</option>
                                            <option>E-commerce</option>
                                            <option>Educación</option>
                                            <option>Otro</option>
                                        </select> </div>
                                    <div class="mb-3"> <label for="oppStatus" class="form-label">Estado <span
                                                class="text-danger">*</span></label> <select class="form-select"
                                            id="oppStatus" name="status" required>
                                            <option value="pendiente_revision">Pendiente Revisión</option>
                                            <option value="activa">Activa (Publicada)</option>
                                            <option value="en_financiacion">En Financiación</option>
                                            <option value="financiada_completamente">Financiada Completamente</option>
                                            <option value="cerrada">Cerrada</option>
                                            <option value="rechazada">Rechazada</option>
                                        </select> </div>
                                    <div class="mb-3"> <label for="oppBusinessPlan" class="form-label">Plan de Negocios
                                            (PDF)</label> <input type="file" class="form-control" id="oppBusinessPlan"
                                            name="businessPlan" accept=".pdf"> <small id="currentBusinessPlan"
                                            class="d-block mt-1" style="display:none;">Actual: <a href="#"
                                                target="_blank"></a></small> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3"> <label for="oppShortDescription" class="form-label">Descripción Corta (para
                            listados) <span class="text-danger">*</span></label> <textarea class="form-control"
                            id="oppShortDescription" name="shortDescription" rows="2" maxlength="200"
                            required></textarea> </div>
                </form>
            </div>
            <div class="modal-footer"> <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cancelar</button> <button type="button" class="btn btn-primary"
                    id="saveOpportunityButton" onclick="saveOpportunity()">Guardar</button> </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewOpportunityModal" tabindex="-1" aria-labelledby="viewOpportunityModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewOpportunityModalLabel"></h5> <button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8">
                        <h3 id="viewOppProjectName" class="fw-bold mb-0"></h3>
                        <p class="text-muted mb-2"><i class="fas fa-briefcase me-1"></i> Sector: <span
                                id="viewOppSector"></span> | <i class="fas fa-clipboard-check me-1"></i> Estado: <span
                                id="viewOppStatus" class="badge"></span></p>
                        <div class="card card-round">
                            <div class="card-body">
                                <div class="card-title fw-mediumbold">Descripción Completa</div>
                                <div id="viewOppFullDescription" style="max-height: 300px; overflow-y:auto;"></div>
                                <hr>
                                <p><strong>Plan de Negocios:</strong> <a id="viewOppBusinessPlanLink" href="#"
                                        target="_blank">Descargar/Ver</a> <span id="noBusinessPlanMsg"
                                        style="display:none;">No disponible</span></p>
                            </div>
                        </div>
                        <div class="card card-round mt-3">
                            <div class="card-header">
                                <h5 class="card-title">Inversores Participantes (<span
                                        id="viewOppInvestorsCount">0</span>)</h5>
                            </div>
                            <div class="card-body">
                                <div id="viewOppInvestorsListContainer" class="list-group"
                                    style="max-height: 250px; overflow-y: auto;"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-stats card-primary card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center"><i class="fas fa-dollar-sign"></i></div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Monto Buscado</p>
                                            <h4 class="card-title" id="viewOppAmountNeeded"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-stats card-success card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center"><i class="fas fa-piggy-bank"></i></div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Monto Recaudado</p>
                                            <h4 class="card-title" id="viewOppAmountRaised"></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-2">
                                    <div id="viewOppProgressBar" class="progress-bar" role="progressbar"
                                        style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-stats card-info card-round">
                            <div class="card-body">
                                <p><strong>Equity Ofrecido:</strong> <span id="viewOppEquityOffered"
                                        class="fw-bold"></span>%</p>
                                <p><strong>Valoración Pre-Money:</strong> <span id="viewOppValuation"
                                        class="fw-bold"></span></p>
                            </div>
                        </div>
                        <div class="card card-round">
                            <div class="card-header">
                                <h5 class="card-title">Historial</h5>
                            </div>
                            <div class="card-body" style="max-height: 250px; overflow-y:auto;">
                                <ul class="timeline timeline-investment-item ps-1" id="viewOppTimeline"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"> <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cerrar</button> </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewInvestorModal" tabindex="-1" aria-labelledby="viewInvestorModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewInvestorModalLabel">Perfil del Inversor</h5> <button type="button"
                    class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card card-profile">
                    <div class="card-header" style="background-image: url('assets/img/blogpost.jpg')">
                        <div class="profile-picture">
                            <div class="avatar avatar-xl"> <img id="investorProfileAvatar" src="assets/img/profile.jpg"
                                    alt="Avatar" class="avatar-img rounded-circle" /> </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="user-profile text-center">
                            <div class="name fw-bold fs-3" id="investorProfileName"></div>
                            <div class="job" id="investorProfileType"></div>
                            <div class="desc" id="investorProfileInterests"></div>
                            <div class="social-media"> <a id="investorProfileEmailLink"
                                    class="btn btn-info btn-sm btn-link" href="#"><span class="btn-label just-icon"><i
                                            class="far fa-envelope"></i></span></a> </div>
                        </div>
                        <hr>
                        <h5 class="mt-2 fw-bold">Detalles Adicionales</h5>
                        <p id="investorProfileDetails"></p>
                        <h5 class="mt-3 fw-bold">Historial de Inversiones en la Plataforma</h5>
                        <ul id="investorProfileInvestmentsList" class="list-group"> </ul>
                    </div>
                    <div class="card-footer">
                        <div class="row user-stats text-center">
                            <div class="col">
                                <div class="number" id="investorProfileTotalInvestments">0</div>
                                <div class="title">Inversiones</div>
                            </div>
                            <div class="col">
                                <div class="number" id="investorProfileTotalAmount">N/A</div>
                                <div class="title">Monto Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"> <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cerrar</button> </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewRequestDetailsModal" tabindex="-1" aria-labelledby="viewRequestDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewRequestDetailsModalLabel">Detalles de Solicitud</h5> <button
                    type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID Solicitud:</strong> <span id="reqDetailId"></span></p>
                <p><strong>Proyecto:</strong> <span id="reqDetailProjectName" class="fw-bold"></span></p>
                <p><strong>Inversor:</strong> <span id="reqDetailInvestorName" class="fw-bold"></span> (<a href="#!"
                        id="reqDetailInvestorProfileLink" onclick="">Ver perfil</a>)</p>
                <p><strong>Monto Ofrecido:</strong> <span id="reqDetailAmountOffered"
                        class="form-control-plaintext-strong"></span></p>
                <p><strong>Fecha de Solicitud:</strong> <span id="reqDetailDate"></span></p>
                <p><strong>Estado Actual:</strong> <span id="reqDetailStatus" class="badge"></span></p>
                <div class="card mt-2">
                    <div class="card-body bg-light">
                        <h6 class="card-title">Mensaje del Inversor:</h6>
                        <blockquote class="blockquote mb-0">
                            <p id="reqDetailMessage" class="fst-italic">...</p>
                        </blockquote>
                    </div>
                </div>
                <hr>
                <div id="reqDetailAdminActions" class="mt-3">
                    <h5 class="mb-2">Acciones Administrativas:</h5> <button class="btn btn-success btn-round me-2"
                        onclick="processInvestmentRequestFromModal('aprobar')"><i class="fa fa-check-circle"></i>
                        Aprobar</button> <button class="btn btn-danger btn-round me-2"
                        onclick="processInvestmentRequestFromModal('rechazar')"><i class="fa fa-times-circle"></i>
                        Rechazar</button> <button class="btn btn-warning btn-round"
                        onclick="contactInvestorFromRequest()"><i class="fa fa-envelope"></i> Contactar</button>
                </div>
            </div>
            <div class="modal-footer"> <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cerrar</button> </div>
        </div>
    </div>
</div>
<!-- CONTENIDO DE GESTIÓN DE INVERSIONES - FIN -->

<!-- Scripts -->
<script>
    // Datos de ejemplo (simulando backend)
    let sampleOpportunities = [
        { id: 1, projectName: "EcoTech Solutions", sector: "Tecnología Limpia", shortDescription: "Soluciones innovadoras para la gestión de residuos.", fullDescription: "EcoTech Solutions se dedica a desarrollar e implementar tecnologías de vanguardia para el reciclaje y la reducción de la huella de carbono industrial. Nuestro equipo está compuesto por ingenieros y ambientalistas con más de 10 años de experiencia...", amountNeeded: 150000, amountRaised: 75000, equityOffered: 15, valuation: 850000, businessPlanUrl: "docs/ecotech_bp.pdf", status: "en_financiacion", investorsInterestedIds: [101, 102], timeline: [{ date: "10/07/2024", event: "Creada y pendiente revisión" }, { date: "15/07/2024", event: "Aprobada por Admin, pasa a Activa" }, { date: "20/07/2024", event: "Recibe primera inversión, pasa a En Financiación" }] },
        { id: 2, projectName: "SaludBienestar App", sector: "Salud y Bienestar", shortDescription: "App móvil para seguimiento de hábitos saludables.", fullDescription: "Nuestra aplicación móvil SaludBienestar App utiliza IA para personalizar planes de dieta y ejercicio, ayudando a los usuarios a alcanzar sus objetivos de salud de manera efectiva y sostenible. Contamos con un equipo de nutricionistas y desarrolladores.", amountNeeded: 80000, amountRaised: 80000, equityOffered: 10, valuation: 720000, businessPlanUrl: null, status: "financiada_completamente", investorsInterestedIds: [102], timeline: [{ date: "01/06/2024", event: "Creada" }, { date: "05/06/2024", event: "Aprobada" }, { date: "15/06/2024", event: "Financiación completada" }] },
        { id: 3, projectName: "AgroFuturo Sostenible", sector: "Agritech", shortDescription: "Tecnología para optimizar cultivos de forma sostenible.", fullDescription: "AgroFuturo Sostenible implementa sensores IoT y análisis de datos para ayudar a los agricultores a maximizar su producción reduciendo el impacto ambiental. Buscamos revolucionar la agricultura tradicional.", amountNeeded: 250000, amountRaised: 20000, equityOffered: 20, valuation: 1000000, businessPlanUrl: "docs/agrofuturo_bp.pdf", status: "pendiente_revision", investorsInterestedIds: [], timeline: [{ date: "22/07/2024", event: "Creada, pendiente revisión por el administrador" }] }
    ];
    let sampleInvestors = [
        { id: 101, name: "Carlos López", email: "c.lopez@example.com", type: "Ángel Inversor", interests: "Tecnología, SaaS, Impacto Social", totalInvestments: 3, totalAmount: 75000, avatar: "assets/img/jm_denis.jpg", profileDetails: "Inversor ángel con más de 5 años de experiencia en el ecosistema startup. Enfocado en proyectos con alto potencial de crecimiento y un fuerte componente de impacto social. Ha mentorizado a varias startups exitosas." },
        { id: 102, name: "Ana Martínez", company: "Ventura Capital Group", email: "ana.martinez@vcgroup.example", type: "Fondo VC", interests: "Fintech, E-commerce, IA", totalInvestments: 8, totalAmount: 1250000, avatar: "assets/img/chadengle.jpg", profileDetails: "Directora de Inversiones en Ventura Capital Group. Busca activamente startups en etapas tempranas (Seed, Serie A) con modelos de negocio disruptivos y equipos sólidos. Interesada en tecnologías emergentes." }
    ];
    let sampleRequests = [
        { id: 501, opportunityId: 1, investorId: 101, amountOffered: 25000, date: "20/07/2024", status: "pendiente", message: "Muy interesado en EcoTech, creo que podemos escalar rápido. Me gustaría discutir los términos." },
        { id: 502, opportunityId: 3, investorId: 102, amountOffered: 50000, date: "23/07/2024", status: "pendiente", message: "El proyecto AgroFuturo se alinea con nuestra tesis de inversión en Agritech. Dispuestos a evaluar." },
        { id: 503, opportunityId: 1, investorId: 102, amountOffered: 30000, date: "25/07/2024", status: "aprobada", message: "Confirmamos nuestra participación en EcoTech." }
    ];
    let currentOpportunityIdForRequestModal = null; // Para saber qué oportunidad se está viendo al abrir modal de solicitud
    let currentInvestorIdForRequestModal = null; // Para saber qué inversor al abrir modal de solicitud
    let currentRequestIdForDetails = null;


    // Instancias de Modales (asegúrate que los IDs HTML coincidan)
    const opportunityModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('opportunityModal'));
    const viewOpportunityModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('viewOpportunityModal'));
    const viewInvestorModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('viewInvestorModal'));
    const viewRequestDetailsModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('viewRequestDetailsModal'));

    // --- Inicialización de DataTables ---
    let opportunitiesTable, investorsTable, investmentRequestsTable;

    function initializeDataTables() {
        if ($.fn.DataTable.isDataTable('#opportunitiesTable')) {
            opportunitiesTable.destroy();
        }
        opportunitiesTable = $('#opportunitiesTable').DataTable({
            data: sampleOpportunities,
            columns: [
                { data: 'id' },
                { data: 'projectName' },
                { data: 'sector' },
                { data: 'amountNeeded', render: $.fn.dataTable.render.number(',', '.', 0, '$') },
                {
                    data: null,
                    render: function (data, type, row) {
                        const progress = row.amountNeeded > 0 ? (row.amountRaised / row.amountNeeded) * 100 : 0;
                        return `<div class="progress progress-sm">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: ${progress.toFixed(0)}%" aria-valuenow="${progress.toFixed(0)}" aria-valuemin="0" aria-valuemax="100">${progress.toFixed(0)}%</div>
                                        </div>
                                        <small>$${row.amountRaised.toLocaleString()} / $${row.amountNeeded.toLocaleString()}</small>`;
                    }
                },
                {
                    data: 'status',
                    render: function (data) {
                        let badgeClass = 'bg-secondary';
                        if (data === 'activa' || data === 'en_financiacion') badgeClass = 'bg-info';
                        else if (data === 'financiada_completamente') badgeClass = 'bg-success';
                        else if (data === 'pendiente_revision') badgeClass = 'bg-warning text-dark';
                        else if (data === 'rechazada') badgeClass = 'bg-danger';
                        return `<span class="badge ${badgeClass}">${formatStatus(data)}</span>`;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    render: function (data, type, row) {
                        let actions = `<div class="form-button-action">
                                    <button type="button" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Editar" onclick="prepareEditOpportunityModal(${row.id})"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Eliminar" onclick="confirmDeleteOpportunity(${row.id})"><i class="fa fa-times"></i></button>
                                    <button type="button" class="btn btn-link btn-info" data-bs-toggle="tooltip" title="Ver Detalles" onclick="viewOpportunityDetails(${row.id})"><i class="fa fa-eye"></i></button>`;
                        if (row.status === 'pendiente_revision') {
                            actions += `<button type="button" class="btn btn-link btn-success" data-bs-toggle="tooltip" title="Aprobar" onclick="approveOpportunity(${row.id})"><i class="fa fa-check"></i></button>`;
                        }
                        actions += `</div>`;
                        return actions;
                    }
                }
            ],
            "pageLength": 5,
            "drawCallback": function (settings) { // Para reinicializar tooltips después de cada redibujo
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                });
            }
        });

        if ($.fn.DataTable.isDataTable('#investorsTable')) {
            investorsTable.destroy();
        }
        investorsTable = $('#investorsTable').DataTable({
            data: sampleInvestors,
            columns: [
                { data: 'id' },
                { data: 'name', render: function (data, type, row) { return row.company ? `${data} (${row.company})` : data; } },
                { data: 'email' },
                { data: 'type' },
                { data: 'interests' },
                {
                    data: null,
                    orderable: false,
                    render: function (data, type, row) {
                        return `<div class="form-button-action">
                                    <button type="button" class="btn btn-link btn-info btn-lg" data-bs-toggle="tooltip" title="Ver Perfil" onclick="viewInvestorDetails(${row.id})"><i class="fa fa-user-circle"></i></button>
                                    <button type="button" class="btn btn-link btn-warning" data-bs-toggle="tooltip" title="Contactar" onclick="contactInvestor(${row.id})"><i class="fa fa-envelope"></i></button>
                                </div>`;
                    }
                }
            ],
            "pageLength": 5,
            "drawCallback": function (settings) {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) { return new bootstrap.Tooltip(tooltipTriggerEl) });
            }
        });

        if ($.fn.DataTable.isDataTable('#investmentRequestsTable')) {
            investmentRequestsTable.destroy();
        }
        investmentRequestsTable = $('#investmentRequestsTable').DataTable({
            data: sampleRequests,
            columns: [
                { data: 'id' },
                { data: 'opportunityId', render: function (data) { return sampleOpportunities.find(o => o.id === data)?.projectName || 'N/A'; } },
                { data: 'investorId', render: function (data) { return sampleInvestors.find(i => i.id === data)?.name || 'N/A'; } },
                { data: 'amountOffered', render: $.fn.dataTable.render.number(',', '.', 0, '$') },
                { data: 'date' },
                {
                    data: 'status',
                    render: function (data) {
                        let badgeClass = 'bg-secondary';
                        if (data === 'aprobada') badgeClass = 'bg-success';
                        else if (data === 'pendiente') badgeClass = 'bg-warning text-dark';
                        else if (data === 'rechazada') badgeClass = 'bg-danger';
                        return `<span class="badge ${badgeClass}">${formatStatus(data)}</span>`;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    render: function (data, type, row) {
                        let actions = `<div class="form-button-action">
                                     <button type="button" class="btn btn-link btn-info btn-lg" data-bs-toggle="tooltip" title="Ver Detalles" onclick="viewRequestDetails(${row.id})"><i class="fa fa-file-alt"></i></button>`;
                        if (row.status === 'pendiente') {
                            actions += `<button type="button" class="btn btn-link btn-success" data-bs-toggle="tooltip" title="Aprobar" onclick="processInvestmentRequest(${row.id}, 'aprobar')"><i class="fa fa-check-circle"></i></button>
                                                <button type="button" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Rechazar" onclick="processInvestmentRequest(${row.id}, 'rechazar')"><i class="fa fa-times-circle"></i></button>`;
                        }
                        actions += `</div>`;
                        return actions;
                    }
                }
            ],
            "pageLength": 5,
            "drawCallback": function (settings) {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) { return new bootstrap.Tooltip(tooltipTriggerEl) });
            }
        });
    }

    function formatStatus(status) {
        if (!status) return 'N/A';
        return status.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
    }

    // --- Funciones para Oportunidades ---
    function prepareCreateOpportunityModal() {
        $('#opportunityForm')[0].reset();
        $('#opportunityId').val('');
        $('#opportunityModalLabel').text('Nueva Oportunidad de Inversión');
        $('#saveOpportunityButton').text('Crear Oportunidad').removeClass('btn-warning').addClass('btn-primary');
        $('#currentBusinessPlan').hide().find('a').attr('href', '#').text('');
        opportunityModal.show();
    }

    function prepareEditOpportunityModal(id) {
        const opp = sampleOpportunities.find(o => o.id === id);
        if (!opp) return;
        $('#opportunityForm')[0].reset();
        $('#opportunityId').val(opp.id);
        $('#opportunityModalLabel').text('Editar Oportunidad de Inversión');
        $('#saveOpportunityButton').text('Actualizar Oportunidad').removeClass('btn-primary').addClass('btn-warning');

        $('#oppProjectName').val(opp.projectName);
        $('#oppSector').val(opp.sector);
        $('#oppFullDescription').val(opp.fullDescription);
        $('#oppShortDescription').val(opp.shortDescription);
        $('#oppAmountNeeded').val(opp.amountNeeded);
        $('#oppEquityOffered').val(opp.equityOffered);
        $('#oppValuation').val(opp.valuation);
        $('#oppStatus').val(opp.status);

        const currentBP = $('#currentBusinessPlan');
        if (opp.businessPlanUrl) {
            currentBP.find('a').attr('href', opp.businessPlanUrl).text(opp.businessPlanUrl.split('/').pop());
            currentBP.show();
        } else {
            currentBP.hide();
        }
        opportunityModal.show();
    }

    function saveOpportunity() {
        const form = $('#opportunityForm')[0];
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        const id = parseInt($('#opportunityId').val());
        const newOppData = {
            id: id || Date.now(), // Nuevo ID si no existe
            projectName: $('#oppProjectName').val(),
            sector: $('#oppSector').val(),
            shortDescription: $('#oppShortDescription').val(),
            fullDescription: $('#oppFullDescription').val(),
            amountNeeded: parseFloat($('#oppAmountNeeded').val()),
            amountRaised: id ? sampleOpportunities.find(o => o.id === id).amountRaised : 0, // Mantener recaudado si edita, 0 si nuevo
            equityOffered: parseFloat($('#oppEquityOffered').val()) || null,
            valuation: parseFloat($('#oppValuation').val()) || null,
            // businessPlanUrl: // Manejar subida de archivo
            status: $('#oppStatus').val(),
            investorsInterestedIds: id ? sampleOpportunities.find(o => o.id === id).investorsInterestedIds : [],
            timeline: id ? sampleOpportunities.find(o => o.id === id).timeline : [{ date: new Date().toLocaleDateString(), event: "Creada" }]
        };

        if (id) { // Editar
            const index = sampleOpportunities.findIndex(o => o.id === id);
            sampleOpportunities[index] = newOppData;
            newOppData.timeline.push({ date: new Date().toLocaleDateString(), event: "Actualizada por Admin" });
        } else { // Crear
            sampleOpportunities.push(newOppData);
        }

        console.log("Guardando oportunidad:", newOppData);
        opportunityModal.hide();
        showToast(id ? 'Oportunidad actualizada.' : 'Oportunidad creada.', 'success');
        initializeDataTables(); // Recargar DataTables
    }

    function confirmDeleteOpportunity(id) {
        swal({
            title: "¿Estás seguro?", text: "Esta acción eliminará la oportunidad permanentemente.", icon: "warning",
            buttons: { cancel: { text: "Cancelar", value: null, visible: true, className: "btn btn-secondary" }, confirm: { text: "Sí, eliminar", value: true, visible: true, className: "btn btn-danger" } },
        }).then(willDelete => {
            if (willDelete) {
                sampleOpportunities = sampleOpportunities.filter(o => o.id !== id);
                console.log("Eliminando oportunidad ID:", id);
                showToast(`Oportunidad ID ${id} eliminada.`, 'success');
                initializeDataTables();
            }
        });
    }

    function viewOpportunityDetails(id) {
        const opp = sampleOpportunities.find(o => o.id === id);
        if (!opp) return;
        $('#viewOpportunityModalLabel').text(`Detalles: ${opp.projectName}`);
        $('#viewOppProjectName').text(opp.projectName);
        $('#viewOppSector').text(opp.sector);
        $('#viewOppFullDescription').html(opp.fullDescription.replace(/\n/g, '<br>')); // Simple render de saltos de línea

        const statusBadge = $('#viewOppStatus');
        statusBadge.text(formatStatus(opp.status));
        statusBadge.attr('class', 'badge '); // Limpiar clases
        if (opp.status === 'activa' || opp.status === 'en_financiacion') statusBadge.addClass('bg-info');
        else if (opp.status === 'financiada_completamente') statusBadge.addClass('bg-success');
        else if (opp.status === 'pendiente_revision') statusBadge.addClass('bg-warning text-dark');
        else if (opp.status === 'rechazada') statusBadge.addClass('bg-danger');
        else statusBadge.addClass('bg-secondary');


        const bpLink = $('#viewOppBusinessPlanLink');
        const noBpMsg = $('#noBusinessPlanMsg');
        if (opp.businessPlanUrl) { bpLink.attr('href', opp.businessPlanUrl).show(); noBpMsg.hide(); }
        else { bpLink.hide(); noBpMsg.show(); }

        $('#viewOppAmountNeeded').text(`$${opp.amountNeeded.toLocaleString()}`);
        $('#viewOppAmountRaised').text(`$${opp.amountRaised.toLocaleString()}`);
        const progress = opp.amountNeeded > 0 ? (opp.amountRaised / opp.amountNeeded) * 100 : 0;
        const progressBar = $('#viewOppProgressBar');
        progressBar.css('width', `${progress.toFixed(0)}%`).text(`${progress.toFixed(0)}%`).attr('aria-valuenow', progress.toFixed(0));

        $('#viewOppEquityOffered').text(opp.equityOffered || 'N/A');
        $('#viewOppValuation').text(opp.valuation ? `$${opp.valuation.toLocaleString()}` : 'N/A');
        $('#viewOppInvestorsCount').text(opp.investorsInterestedIds.length);

        const timelineContainer = $('#viewOppTimeline').empty();
        opp.timeline.forEach(item => {
            timelineContainer.append(`<li><div class="timeline-badge primary"><i class="fas fa-flag"></i></div><div class="timeline-panel"><div class="timeline-heading"><h6 class="timeline-title">${item.event}</h6></div><div class="timeline-body"><p><small class="text-muted">${item.date}</small></p></div></div></li>`);
        });

        const investorsListContainer = $('#viewOppInvestorsListContainer').empty();
        if (opp.investorsInterestedIds.length > 0) {
            opp.investorsInterestedIds.forEach(invId => {
                const investor = sampleInvestors.find(i => i.id === invId);
                if (investor) {
                    investorsListContainer.append(`<a href="#!" onclick="viewInvestorDetails(${investor.id})" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">${investor.name} <img src="${investor.avatar || 'assets/img/profile.jpg'}" alt="avatar" class="avatar-xs rounded-circle"></a>`);
                }
            });
        } else {
            investorsListContainer.append('<p class="text-muted">Aún no hay inversores participando.</p>');
        }
        viewOpportunityModal.show();
    }

    function approveOpportunity(id) {
        swal({
            title: `¿Aprobar oportunidad ID ${id}?`, text: "La oportunidad pasará a estado 'Activa'.", icon: "info",
            buttons: { cancel: { text: "Cancelar", value: null, visible: true, className: "btn btn-secondary" }, confirm: { text: "Sí, aprobar", value: true, visible: true, className: "btn btn-success" } },
        }).then(willApprove => {
            if (willApprove) {
                const opp = sampleOpportunities.find(o => o.id === id);
                if (opp) {
                    opp.status = "activa";
                    opp.timeline.push({ date: new Date().toLocaleDateString(), event: "Aprobada por Admin, pasa a Activa" });
                }
                showToast(`Oportunidad ID ${id} aprobada.`, 'success');
                initializeDataTables();
            }
        });
    }

    // --- Funciones para Inversores ---
    function viewInvestorDetails(id) {
        const investor = sampleInvestors.find(i => i.id === id);
        if (!investor) return;
        $('#viewInvestorModalLabel').text(`Perfil: ${investor.name}`);
        $('#investorProfileAvatar').attr('src', investor.avatar || 'assets/img/profile.jpg');
        $('#investorProfileName').text(investor.name + (investor.company ? ` (${investor.company})` : ''));
        $('#investorProfileType').text(investor.type);
        $('#investorProfileInterests').text(`Intereses: ${investor.interests}`);
        $('#investorProfileEmailLink').attr('href', `mailto:${investor.email}`);
        $('#investorProfileDetails').html(investor.profileDetails ? investor.profileDetails.replace(/\n/g, '<br>') : 'No hay detalles adicionales.');

        $('#investorProfileTotalInvestments').text(investor.totalInvestments);
        $('#investorProfileTotalAmount').text(investor.totalAmount ? `$${investor.totalAmount.toLocaleString()}` : 'N/A');

        const investmentsList = $('#investorProfileInvestmentsList').empty();
        // Simular algunas inversiones
        sampleRequests.filter(r => r.investorId === id && r.status === 'aprobada').forEach(req => {
            const opp = sampleOpportunities.find(o => o.id === req.opportunityId);
            if (opp) {
                investmentsList.append(`<li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="#!" onclick="viewOpportunityModal.hide(); setTimeout(() => viewOpportunityDetails(${opp.id}), 500);">${opp.projectName}</a>
                            <span class="badge bg-success rounded-pill">$${req.amountOffered.toLocaleString()}</span>
                        </li>`);
            }
        });
        if (investmentsList.children().length === 0) investmentsList.append('<li class="list-group-item text-muted">No hay inversiones aprobadas registradas.</li>');

        viewInvestorModal.show();
    }
    function contactInvestor(id) {
        const investor = sampleInvestors.find(i => i.id === id);
        if (!investor) return;
        window.location.href = `mailto:${investor.email}?subject=Contacto desde Plataforma Emprendedores`;
    }

    // --- Funciones para Solicitudes de Inversión ---
    function processInvestmentRequest(requestId, action) {
        const request = sampleRequests.find(r => r.id === requestId);
        if (!request) return;
        const opportunity = sampleOpportunities.find(o => o.id === request.opportunityId);

        let newStatus = request.status;
        let message = "";
        let title = "";

        if (action === 'aprobar') {
            newStatus = 'aprobada';
            title = `¿Aprobar solicitud ${requestId}?`;
            message = `La solicitud de inversión para "${opportunity.projectName}" será aprobada.`;
        } else if (action === 'rechazar') {
            newStatus = 'rechazada';
            title = `¿Rechazar solicitud ${requestId}?`;
            message = `La solicitud de inversión para "${opportunity.projectName}" será rechazada.`;
        }

        swal({
            title: title, text: message, icon: action === 'aprobar' ? "info" : "warning",
            buttons: { cancel: { text: "Cancelar", value: null, visible: true, className: "btn btn-secondary" }, confirm: { text: "Confirmar", value: true, visible: true, className: action === 'aprobar' ? "btn btn-success" : "btn btn-danger" } },
        }).then(willProcess => {
            if (willProcess) {
                request.status = newStatus;
                if (newStatus === 'aprobada' && opportunity) {
                    opportunity.amountRaised += request.amountOffered;
                    if (!opportunity.investorsInterestedIds.includes(request.investorId)) {
                        opportunity.investorsInterestedIds.push(request.investorId);
                    }
                    opportunity.timeline.push({ date: new Date().toLocaleDateString(), event: `Inversión de $${request.amountOffered.toLocaleString()} aprobada (Solicitud #${request.id})` });
                    if (opportunity.amountRaised >= opportunity.amountNeeded) {
                        opportunity.status = 'financiada_completamente';
                        opportunity.timeline.push({ date: new Date().toLocaleDateString(), event: "Financiación completada" });
                    } else {
                        opportunity.status = 'en_financiacion';
                    }
                }
                showToast(`Solicitud ${requestId} ${newStatus}.`, action === 'aprobar' ? 'success' : 'error');
                initializeDataTables(); // Recargar todas las tablas
            }
        });
    }

    function viewRequestDetails(requestId) {
        currentRequestIdForDetails = requestId;
        const request = sampleRequests.find(r => r.id === requestId);
        const opportunity = sampleOpportunities.find(o => o.id === request.opportunityId);
        const investor = sampleInvestors.find(i => i.id === request.investorId);
        if (!request || !opportunity || !investor) return;

        $('#viewRequestDetailsModalLabel').text(`Detalles Solicitud #${request.id}`);
        $('#reqDetailId').text(request.id);
        $('#reqDetailProjectName').text(opportunity.projectName);
        $('#reqDetailInvestorName').text(investor.name);
        $('#reqDetailInvestorProfileLink').off('click').on('click', () => { viewRequestDetailsModal.hide(); setTimeout(() => viewInvestorDetails(investor.id), 300); });
        $('#reqDetailAmountOffered').text(`$${request.amountOffered.toLocaleString()}`);
        $('#reqDetailDate').text(request.date);

        const statusBadge = $('#reqDetailStatus');
        statusBadge.text(formatStatus(request.status));
        statusBadge.attr('class', 'badge ');
        if (request.status === 'aprobada') statusBadge.addClass('bg-success');
        else if (request.status === 'rechazada') statusBadge.addClass('bg-danger');
        else statusBadge.addClass('bg-warning text-dark');

        $('#reqDetailMessage').text(request.message || "No hay mensaje adicional.");

        $('#reqDetailAdminActions').toggle(request.status === 'pendiente');
        viewRequestDetailsModal.show();
    }

    function processInvestmentRequestFromModal(action) {
        if (currentRequestIdForDetails) {
            viewRequestDetailsModal.hide(); // Ocultar modal antes de mostrar swal
            // Pequeño delay para asegurar que el modal se oculte antes de que swal bloquee la UI
            setTimeout(() => {
                processInvestmentRequest(currentRequestIdForDetails, action);
            }, 300);
        }
    }
    function contactInvestorFromRequest() {
        if (currentRequestIdForDetails) {
            const request = sampleRequests.find(r => r.id === currentRequestIdForDetails);
            const investor = sampleInvestors.find(i => i.id === request.investorId);
            if (investor) contactInvestor(investor.id);
        }
    }

    $(document).ready(function () {
        initializeDataTables();
        // Inicializar tooltips una vez al cargar (DataTables lo hará en redibujos)
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });

    // Simulación de Toast mejorada (como la de Kaiadmin)
    function showToast(message, type = 'info') {
        const toastPlacement = "top-end"; // top-start, top-center, top-end, middle-start, middle-center, middle-end, bottom-start, bottom-center, bottom-end
        const toastId = 'liveToast-' + Date.now();
        const toastHTML = `
                    <div id="${toastId}" class="toast fade" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto text-${type === 'success' ? 'success' : type === 'danger' ? 'danger' : 'primary'}">Notificación</strong>
                            <small>${new Date().toLocaleTimeString()}</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            ${message}
                        </div>
                    </div>`;

        let toastContainer = document.getElementById('toastContainerGlobal');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toastContainerGlobal';
            toastContainer.className = `toast-container position-fixed p-3 ${toastPlacement.includes("top") ? "top-0" : "bottom-0"} ${toastPlacement.includes("end") ? "end-0" : "start-0"}`;
            document.body.appendChild(toastContainer);
        }

        toastContainer.insertAdjacentHTML('beforeend', toastHTML);
        const toastElement = document.getElementById(toastId);
        const toast = new bootstrap.Toast(toastElement, { delay: 5000, autohide: true });

        toastElement.addEventListener('hidden.bs.toast', function () {
            toastElement.remove(); // Limpiar el DOM después de que el toast se oculte
        });
        toast.show();
    }
</script>