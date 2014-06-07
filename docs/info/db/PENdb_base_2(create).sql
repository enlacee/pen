-- Tablas Base
-- Objetivo 1
CREATE TABLE IF NOT EXISTS objetivo_01
       (no_autoinc MEDIUMINT NOT NULL AUTO_INCREMENT,
        cuadro varchar(4),
        
       anio_calendario    varchar(4),
       edad    Integer (4),
       estrategias_caracteristicas    varchar(4),
       sexo    varchar(4),
       area_geografica    varchar(4),
       t_gestion_ie    varchar(4),
           
       acceso_personas_discapacidad    varchar(4),
       aprobacion    varchar(4),
       ciclo    varchar(4),
       dimension_proyecto    varchar(4),
       especialidad_intervencion_temprana    varchar(4),
       especialidad_profesional_no_docente    varchar(4),
       grupo_etario    varchar(4),
       grupo_etnico    varchar(4),
       lengua_materna    varchar(4),
       modalidad_atencion    varchar(4),
       modalidad_educativa    varchar(4),
       nivel_gobierno    varchar(4),
       nivel_educativo    varchar(4),
       regiones    varchar(4),
       region    varchar(4),
       servicios_basicos    varchar(4),
       tematicas_especializacion    varchar(4),
       t_casos_atendidos    varchar(4),
       t_centros_acopio    varchar(4),
       t_discapacidad    varchar(4),
       t_especializacion_docentes    varchar(4),
       t_instituciones_financiadoras    varchar(4),
       t_institucion    varchar(4),
       t_lenguaje    varchar(4),
       t_programa_social_menores_3_anios    varchar(4),
       t_programas_apoyo_la_familia    varchar(4),
       t_proyecto_educativo_financiado    varchar(4),
       t_recurso_brindado    varchar(4),
       t_reparacion    varchar(4),
           
       no_iiee_multigrado_nivel_nacional    integer(8),
       no_iiee_unidocentes_nivel_nacional    integer(8),
       no_iiee_unidocentes_convertidas_iiee_multigrado    integer(8),
       no_atenciones    integer(8),
       no_iiee    integer(8),
       no_pei_vinculados_proyectos    integer(8),
       no_alfabetizadores_1l    integer(8),
       no_alfabetizadores_2l    integer(8),
       no_analfabetos    integer(8),
       no_animadoras    integer(8),
       no_casos    integer(8),
       no_centros    integer(8),
       no_demunas    integer(8),
       no_docentes    integer(8),
       no_docentes_bilingues    integer(8),
       no_estudiantes    integer(8),
       no_familias    integer(8),
       no_instituciones    integer(8),
       no_matriculados    integer(8),
       no_ninios_atendidos    integer(8),
       no_ninios_almuerzos_escolares    integer(8),
       no_ninios_desayunos_escolares    integer(8),
       no_profesionales    integer(8),
       no_programas_salud    integer(8),
       no_proyectos    integer(8),
       poblacion_total    integer(8),
       porcentaje_conclusion    decimal(5,2),

       PRIMARY KEY (no_autoinc)) 
        ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='';
        
        
        
-- Objetivo 2
CREATE TABLE IF NOT EXISTS objetivo_02
       (no_autoinc MEDIUMINT NOT NULL AUTO_INCREMENT,
        cuadro varchar(4),
        
       anio_calendario    varchar(4),
       caracteristicas_ie    varchar(4),
       sexo    varchar(4),
       area_geografica    varchar(4),
       t_gestion_ie    varchar(4),
           
       aprobacion    varchar(4),
       area_conocimiento    varchar(4),
       areas_desempenio    varchar(4),
       escala_magisterial    varchar(4),
       estado_proyecto    varchar(4),
       etapa_evaluacion_ingreso_carrera_publica    varchar(4),
       etapas_curriculo    varchar(4),
       fuente_financiamiento    varchar(4),
       grado    varchar(4),
       lengua_materna    varchar(4),
       material_distribuido    varchar(4),
       modalidad_educativa    varchar(4),
       nivel_logro    varchar(4),
       nivel_educativo    varchar(4),
       region    varchar(4),
       t_ie_superior    varchar(4),
       t_programa_desarrollo_profesional    varchar(4),
       t_casos_reportados    varchar(4),
       t_conexion_internet    varchar(4),
       t_evaluacion_desempenio_extraordinaria    varchar(4),
       t_incentivos_docentes    varchar(4),
       t_institucion_brinda_capacitacion    varchar(4),
       t_material_distribuido_docentes    varchar(4),
       t_material_distribuido_estudiantes    varchar(4),
       t_proyectos_presentados    varchar(4),
           
       monto_desembolsado    decimal(8,2),
       monto_destinado    decimal(8,2),
       no_copales    integer(8),
       no_copares    integer(8),
       no_iiee    integer(8),
       no_iiee_conforman_red    integer(8),
       no_casos    integer(8),
       no_competencias    integer(8),
       no_directores    integer(8),
       no_docentes    integer(8),
       no_docentes_aprobados    integer(8),
       no_docentes_no_ratificados    integer(8),
       no_docentes_postulantes    integer(8),
       no_docentes_ratificados    integer(8),
       no_egresados    integer(8),
       no_estudiantes    integer(8),
       no_ingresantes    integer(8),
       no_instituciones    integer(8),
       no_plazas_cubiertas    integer(8),
       no_plazas_vacantes    integer(8),
       no_plazas_vacantes_asignadas    integer(8),
       no_plazas_vacantes_desiertas    integer(8),
       no_proyectos    integer(8),
       no_redes    integer(8),
       no_redes_con_pcc    integer(8),
       no_redes_con_pei    integer(8),
       no_redes_con_acceso_internet    integer(8),
       no_redes_con_acompaniamiento_pedagogico    integer(8),
       no_redes_con_centro_recursos    integer(8),
       no_redes_conformadas    integer(8),
       no_visitas_acompaniamiento    integer(8),
       porcentaje_alumnos    decimal(5,2),

       PRIMARY KEY (no_autoinc)) 
        ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='';
        
        
        
-- Objetivo 3
CREATE TABLE IF NOT EXISTS objetivo_03
       (no_autoinc MEDIUMINT NOT NULL AUTO_INCREMENT,
        cuadro varchar(4),
        
       anio_calendario    varchar(4),
       sexo    varchar(4),
       area_geografica    varchar(4),
       t_gestion_ie    varchar(4),
           
       especialidad    varchar(4),
       especialidad_beca_segun_formacion    varchar(4),
       modalidad_educacion    varchar(4),
       modalidad_educativa    varchar(4),
       nivel_gobierno    varchar(4),
       nivel_educativo    varchar(4),
       region    varchar(4),
       t_ie    varchar(4),
       t_asignaciones_especiales    varchar(4),
       t_buenas_practicas    varchar(4),
       t_becas_formacion    varchar(4),
       t_becas_ubicacion    varchar(4),
       t_egresado    varchar(4),
       t_formacion_servicio_ofrecida_minedu    varchar(4),
       t_institucion_educativa    varchar(4),
       t_pasantias    varchar(4),
       t_plazas    varchar(4),
       t_programa_universitario    varchar(4),
       t_situaciones_especiales    varchar(4),
           
       monto_asignado    decimal(8,2),
       monto_desembolsado    decimal(8,2),
       no_institutos_acreditados    integer(8),
       no_institutos_iniciado_acreditacion    integer(8),
       no_iiee_beneficiarias    integer(8),
       no_acompaniantes_pedagogicos_    integer(8),
       no_carreras_educacion_acreditadas    integer(8),
       no_docentes    integer(8),
       no_docentes_beneficiarios    integer(8),
       no_docentes_formacion_servicios    integer(8),
       no_docentes_egresados    integer(8),
       no_docentes_ganadores    integer(8),
       no_egresados    integer(8),
       no_institutos_superiores    integer(8),
       no_plazas_convocadas    integer(8),
       no_plazas_cubiertas    integer(8),
       no_programas_acreditados    integer(8),
       no_universidades_carreras_acreditadas    integer(8),
       no_universidades_programas_acreditados    integer(8),
       no_universidades_iniciado_acreditacion    integer(8),
       no_viviendas_alojadas    integer(8),
       no_viviendas_destinadas    integer(8),

       PRIMARY KEY (no_autoinc)) 
        ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='';
        
        
        
-- Objetivo 4
CREATE TABLE IF NOT EXISTS objetivo_04
       (no_autoinc MEDIUMINT NOT NULL AUTO_INCREMENT,
        cuadro varchar(4),
        
       anio_calendario    varchar(4),
       area_geografica    varchar(4),
           
       fase_plan    varchar(4),
       iged    varchar(4),
       manejo_quechua    varchar(4),
       modalidad_educativa    varchar(4),
       nivel_gobierno    varchar(4),
       nivel_educativo    varchar(4),
       regiones    varchar(4),
       region    varchar(4),
           
       gasto_por_alumno    decimal(8,2),
       monto_asignado    decimal(8,2),
       monto_presupuesto    decimal(8,2),
       monto_ejecutado    decimal(8,2),
       no_dre    integer(8),
       no_egresados_enap    integer(8),
       no_gerentes    integer(8),
       no_ingresantes_enap    integer(8),
       no_localidades    integer(8),
       no_postulantes_enap    integer(8),
       no_regiones    integer(8),
       no_copales    integer(8),
       no_copares    integer(8),
       porcentaje_canon    decimal(5,2),
       porcentaje_ejecucion    decimal(5,2),
       tasa_crecimiento    decimal(5,2),

       PRIMARY KEY (no_autoinc)) 
        ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='';
        
        
        
-- Objetivo 5
CREATE TABLE IF NOT EXISTS objetivo_05
       (no_autoinc MEDIUMINT NOT NULL AUTO_INCREMENT,
        cuadro varchar(4),
        
       anio_calendario    varchar(4),
       sexo    varchar(4),
       tipo_gestion_ie    varchar(4),
           
       acreditador    varchar(4),
       entidad_certificadora    varchar(4),
       especialidad    varchar(4),
       estado_acreditacion    varchar(4),
       evento_capacitacion    varchar(4),
       familia_profesional    varchar(4),
       fondo_regional    varchar(4),
       institucion_universitaria    varchar(4),
       nivel_gobierno    varchar(4),
       normas_aprobados_por_ipeba    varchar(4),
       tematica    varchar(4),
       t_ie_superior    varchar(4),
       t_fondos_concursables    varchar(4),
           
       monto_asignado    decimal(8,2),
       monto_credito    decimal(8,2),
       monto_otorgado    decimal(8,2),
       no_instituciones_universitarias    integer(8),
       no_institutos_superiores    integer(8),
       no_proyectos_investigacion    integer(8),
       no_alumnos_matriculados_pre_grado    integer(8),
       no_alumnos_matriculados_post_grado    integer(8),
       no_articulos_cientificos    integer(8),
       no_becas_ofrecidas    integer(8),
       no_beneficicarios    integer(8),
       no_certificados    integer(8),
       no_cetpro    integer(8),
       no_convenios_institucion_internacional    integer(8),
       no_convenios_institucion_nacional    integer(8),
       no_creditos_ofrecidos    integer(8),
       no_cursos_actualizacion_docente    integer(8),
       no_especialidades_acreditadas    integer(8),
       no_especialidades_proceso_acreditacion    integer(8),
       no_especialidades_ofrecidas    integer(8),
       no_estudiantes    integer(8),
       no_estudiantes_recibido    integer(8),
       no_estudiantes_solicitado    integer(8),
       no_eventos_realizados    integer(8),
       no_iniversidades_acreditadas    integer(8),
       no_institutos_superiores_acreditados    integer(8),
       no_libros_publicados    integer(8),
       no_matriculados    integer(8),
       no_patentes_otorgadas_    integer(8),
       no_proyectos_ciencias_aplicadas    integer(8),
       no_proyectos_ciencias_basicas    integer(8),
       no_proyectos_presentados    integer(8),
       no_solicitantes    integer(8),
       no_solicitudes_patentes    integer(8),
       porcentaje_asignado_educacion_superior    decimal(5,2),
       porcentaje_asignado_universidad    decimal(5,2),
       porcentaje_asignado_institutos_superiores    decimal(5,2),
       porcentaje_becas_universidades_nacionales    decimal(5,2),
       porcentaje_becas_universidades_extranjeras    decimal(5,2),
       porcentaje_cooperacion_internacional    decimal(5,2),
       porcentaje_empresas    decimal(5,2),
       porcentaje_regalias    decimal(5,2),
       porcentaje_canon    decimal(5,2),
       tasa_actividades_economicas    decimal(5,2),
       tasa_desocupacion    decimal(5,2),
       tasa_subocupacion    decimal(5,2),

       PRIMARY KEY (no_autoinc)) 
        ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='';
        
        
        
-- Objetivo 6
CREATE TABLE IF NOT EXISTS objetivo_06
       (no_autoinc MEDIUMINT NOT NULL AUTO_INCREMENT,
        cuadro varchar(4),
        
       anio_calendario    varchar(4),
       sexo_    varchar(4),
       area_geografica    varchar(4),
       t_gestion_ie    varchar(4),
           
       dimension_proyecto    varchar(4),
       grupo_etario    varchar(4),
       lengua_materna    varchar(4),
       metas_vinculadas_a_la_medida    varchar(4),
       modalidad_educativa    varchar(4),
       estado_logro    varchar(4),
       nivel_educativo    varchar(4),
       periodo_reporte    varchar(4),
       regiones    varchar(4),
       region    varchar(4),
       tematica_franja_horaria    varchar(4),
       t_actividades_educativas    varchar(4),
       t_empresas    varchar(4),
       t_institucion_armada    varchar(4),
       t_medio_comunicacion    varchar(4),
       t_municipalidades    varchar(4),
       t_programa    varchar(4),
           
       no_actividades    integer(8),
       no_empresas    integer(8),
       no_medios    integer(8),
       no_metas    integer(8),
       no_municipalidades    integer(8),
       no_personas    integer(8),
       no_proyectos    integer(8),
       no_voluntarios    integer(8),
       porcentaje_programacion    decimal(5,2),

       PRIMARY KEY (no_autoinc)) 
        ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='';
   
   
   -- Fuentes de Información
   CREATE TABLE IF NOT EXISTS fuentes_informacion
       (cuadro varchar(4),
        fuentes    varchar(400),
       PRIMARY KEY (cuadro)) 
        ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='';        