<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiciosSeeder extends Seeder
{
    public function run()
    {
        $servicios = [
            // Category 1: Laboratorio Clínico
            ['nombre' => 'Glucosa', 'descripcion' => 'Medición de glucosa en sangre', 'precio' => 2.00, 'id_categoria' => 1],
            ['nombre' => 'Glucosa post prandial', 'descripcion' => 'Medición de glucosa después de una comida', 'precio' => 2.00, 'id_categoria' => 1],
            ['nombre' => 'Tolerancia a la glucosa', 'descripcion' => 'Prueba para diagnosticar diabetes', 'precio' => 20.00, 'id_categoria' => 1],
            ['nombre' => 'Test de O\'Sullivan', 'descripcion' => 'Prueba de detección de diabetes gestacional', 'precio' => 18.00, 'id_categoria' => 1],
            ['nombre' => 'Hemoglobina glicosilada', 'descripcion' => 'Medición del nivel promedio de glucosa en los últimos 3 meses', 'precio' => 15.00, 'id_categoria' => 1],
            ['nombre' => 'Colesterol total', 'descripcion' => 'Medición del nivel total de colesterol en sangre', 'precio' => 4.00, 'id_categoria' => 1],
            ['nombre' => 'Colesterol HDL', 'descripcion' => 'Medición del colesterol bueno', 'precio' => 5.00, 'id_categoria' => 1],
            ['nombre' => 'Colesterol LDL', 'descripcion' => 'Medición del colesterol malo', 'precio' => 5.00, 'id_categoria' => 1],
            ['nombre' => 'Triglicéridos', 'descripcion' => 'Medición de triglicéridos en sangre', 'precio' => 4.00, 'id_categoria' => 1],
            ['nombre' => 'Ácido úrico', 'descripcion' => 'Medición del nivel de ácido úrico en sangre', 'precio' => 4.00, 'id_categoria' => 1],
            ['nombre' => 'Creatinina', 'descripcion' => 'Evaluación de la función renal', 'precio' => 4.00, 'id_categoria' => 1],
            ['nombre' => 'Nitrógeno ureico', 'descripcion' => 'Indicador de la función renal y hepática', 'precio' => 4.00, 'id_categoria' => 1],
            ['nombre' => 'Bilirrubinas', 'descripcion' => 'Evaluación de la función hepática', 'precio' => 8.00, 'id_categoria' => 1],
            ['nombre' => 'Insulina post prandial', 'descripcion' => 'Medición de insulina después de una comida', 'precio' => 22.00, 'id_categoria' => 1],
            ['nombre' => 'Proteínas totales', 'descripcion' => 'Medición de la cantidad total de proteínas en sangre', 'precio' => 8.00, 'id_categoria' => 1],
            ['nombre' => 'Albúmina', 'descripcion' => 'Evaluación de la función hepática y nutrición', 'precio' => 6.00, 'id_categoria' => 1],
            ['nombre' => 'Globulinas', 'descripcion' => 'Medición de proteínas relacionadas con el sistema inmunológico', 'precio' => 8.00, 'id_categoria' => 1],
            ['nombre' => 'TGO', 'descripcion' => 'Indicador de daño hepático o muscular', 'precio' => 7.00, 'id_categoria' => 1],
            ['nombre' => 'TGP', 'descripcion' => 'Indicador de daño hepático', 'precio' => 7.00, 'id_categoria' => 1],
            ['nombre' => 'GGT', 'descripcion' => 'Prueba hepática para detectar enfermedades del hígado', 'precio' => 8.00, 'id_categoria' => 1],
            ['nombre' => 'Sodio', 'descripcion' => 'Medición del nivel de sodio en sangre', 'precio' => 6.00, 'id_categoria' => 1],
            ['nombre' => 'Cloro', 'descripcion' => 'Medición del nivel de cloro en sangre', 'precio' => 6.00, 'id_categoria' => 1],
            ['nombre' => 'Potasio', 'descripcion' => 'Medición del nivel de potasio en sangre', 'precio' => 6.00, 'id_categoria' => 1],
            ['nombre' => 'Calcio', 'descripcion' => 'Medición del nivel de calcio en sangre', 'precio' => 6.00, 'id_categoria' => 1],
            ['nombre' => 'Magnesio', 'descripcion' => 'Medición del nivel de magnesio en sangre', 'precio' => 6.00, 'id_categoria' => 1],
            ['nombre' => 'Fósforo', 'descripcion' => 'Medición del nivel de fósforo en sangre', 'precio' => 6.00, 'id_categoria' => 1],
            ['nombre' => 'Fosfatasa alcalina', 'descripcion' => 'Prueba para evaluar función hepática y ósea', 'precio' => 6.00, 'id_categoria' => 1],
            ['nombre' => 'Fosfatasa ácida', 'descripcion' => 'Indicador de enfermedades óseas o de próstata', 'precio' => 12.00, 'id_categoria' => 1],
            ['nombre' => 'Amilasa', 'descripcion' => 'Prueba para diagnosticar problemas pancreáticos', 'precio' => 8.00, 'id_categoria' => 1],
            ['nombre' => 'Lipasa', 'descripcion' => 'Medición de enzima pancreática', 'precio' => 8.00, 'id_categoria' => 1],
            ['nombre' => 'LDH', 'descripcion' => 'Indicador de daño tisular', 'precio' => 8.00, 'id_categoria' => 1],
            ['nombre' => 'CPK total/ CK NAC', 'descripcion' => 'Indicador de daño muscular', 'precio' => 10.00, 'id_categoria' => 1],
            ['nombre' => 'CPK MB', 'descripcion' => 'Prueba para detectar daño cardíaco', 'precio' => 15.00, 'id_categoria' => 1],
            ['nombre' => 'Depuración de creatinina en 24 hrs', 'descripcion' => 'Evaluación de la función renal', 'precio' => 20.00, 'id_categoria' => 1],
            ['nombre' => 'FSH', 'descripcion' => 'Prueba hormonal para evaluar la fertilidad', 'precio' => 25.00, 'id_categoria' => 1],
            ['nombre' => 'LH', 'descripcion' => 'Prueba hormonal relacionada con la fertilidad', 'precio' => 22.00, 'id_categoria' => 1],
            ['nombre' => 'Vitamina D', 'descripcion' => 'Medición del nivel de vitamina D en sangre', 'precio' => 50.00, 'id_categoria' => 1],
            ['nombre' => 'Antígenos febriles', 'descripcion' => 'Prueba para detectar infecciones bacterianas', 'precio' => 20.00, 'id_categoria' => 1],
            ['nombre' => 'T3 libre', 'descripcion' => 'Medición de hormona tiroidea', 'precio' => 10.00, 'id_categoria' => 1],
            ['nombre' => 'T4 libre', 'descripcion' => 'Medición de hormona tiroidea', 'precio' => 10.00, 'id_categoria' => 1],
            ['nombre' => 'TSH ultrasensible', 'descripcion' => 'Evaluación de la función tiroidea', 'precio' => 14.00, 'id_categoria' => 1],
            ['nombre' => 'PSA total', 'descripcion' => 'Prueba para detectar problemas en la próstata', 'precio' => 20.00, 'id_categoria' => 1],
            ['nombre' => 'PSA libre', 'descripcion' => 'Evaluación complementaria de la salud prostática', 'precio' => 25.00, 'id_categoria' => 1],
            ['nombre' => 'CA 15-3 (Cáncer de mama)', 'descripcion' => 'Marcador tumoral para cáncer de mama', 'precio' => 32.00, 'id_categoria' => 1],
            ['nombre' => 'CA 19-9 (Cáncer de páncreas y gastrointestinal)', 'descripcion' => 'Marcador tumoral para cáncer de páncreas', 'precio' => 32.00, 'id_categoria' => 1],
            ['nombre' => 'CA 125 (Cáncer de ovarios)', 'descripcion' => 'Marcador tumoral para cáncer de ovario', 'precio' => 32.00, 'id_categoria' => 1],
            ['nombre' => 'CEA (Antígeno carcinoembrionario)', 'descripcion' => 'Marcador tumoral general', 'precio' => 30.00, 'id_categoria' => 1],
            ['nombre' => 'HCG beta cuantitativa', 'descripcion' => 'Prueba para confirmar embarazo', 'precio' => 30.00, 'id_categoria' => 1],
            ['nombre' => 'Alfa fetoproteínas (AFP)', 'descripcion' => 'Marcador tumoral y prueba prenatal', 'precio' => 26.00, 'id_categoria' => 1],
            ['nombre' => 'Prolactina', 'descripcion' => 'Prueba para evaluar función hormonal', 'precio' => 24.00, 'id_categoria' => 1],
            ['nombre' => 'Testosterona', 'descripcion' => 'Medición de nivel de testosterona', 'precio' => 30.00, 'id_categoria' => 1],
            ['nombre' => 'ANA (Anticuerpo antinucleares)', 'descripcion' => 'Prueba para enfermedades autoinmunes', 'precio' => 22.00, 'id_categoria' => 1],
            ['nombre' => 'H. pylori IgM', 'descripcion' => 'Prueba para detectar infección por H. pylori', 'precio' => 22.00, 'id_categoria' => 1],
            ['nombre' => 'CCP', 'descripcion' => 'Prueba para artritis reumatoide', 'precio' => 55.00, 'id_categoria' => 1],
            ['nombre' => 'Calcio en orina de 24 horas', 'descripcion' => 'Evaluación del metabolismo del calcio', 'precio' => 6.00, 'id_categoria' => 1],
            ['nombre' => 'Dímero D', 'descripcion' => 'Indicador de formación de coágulos', 'precio' => 55.00, 'id_categoria' => 1],
            ['nombre' => 'Hepatitis B', 'descripcion' => 'Prueba para detectar infección por Hepatitis B', 'precio' => 30.00, 'id_categoria' => 1],
            ['nombre' => 'Hepatitis C', 'descripcion' => 'Prueba para detectar infección por Hepatitis C', 'precio' => 30.00, 'id_categoria' => 1],
            ['nombre' => 'Beta 2 microglobulina', 'descripcion' => 'Marcador para enfermedades renales y cáncer', 'precio' => 24.00, 'id_categoria' => 1],
            ['nombre' => 'Cortisol AM', 'descripcion' => 'Medición de cortisol en la mañana', 'precio' => 24.00, 'id_categoria' => 1],
            ['nombre' => 'Cortisol PM', 'descripcion' => 'Medición de cortisol en la tarde', 'precio' => 24.00, 'id_categoria' => 1],
            ['nombre' => 'Inmunoglobulina E (IgE)', 'descripcion' => 'Prueba para alergias', 'precio' => 30.00, 'id_categoria' => 1],
            ['nombre' => 'Monotest (Mononucleosis infecciosa)', 'descripcion' => 'Prueba para detectar mononucleosis', 'precio' => 10.00, 'id_categoria' => 1],
            ['nombre' => 'Progesterona (P4)', 'descripcion' => 'Prueba para evaluar función ovárica', 'precio' => 40.00, 'id_categoria' => 1],
            ['nombre' => 'Rubéola IgG', 'descripcion' => 'Prueba para detectar inmunidad a la rubéola', 'precio' => 50.00, 'id_categoria' => 1],
            ['nombre' => 'Rubéola IgM', 'descripcion' => 'Prueba para detectar infección activa de rubéola', 'precio' => 50.00, 'id_categoria' => 1],
            ['nombre' => 'Hepatitis A IgM', 'descripcion' => 'Prueba para detectar infección por Hepatitis A', 'precio' => 30.00, 'id_categoria' => 1],
            ['nombre' => 'Coombs directo', 'descripcion' => 'Prueba para detectar anemia hemolítica', 'precio' => 10.00, 'id_categoria' => 1],
            ['nombre' => 'Coombs indirecto', 'descripcion' => 'Prueba prenatal para compatibilidad sanguínea', 'precio' => 10.00, 'id_categoria' => 1],
            ['nombre' => 'Vitamina B12', 'descripcion' => 'Medición del nivel de vitamina B12', 'precio' => 30.00, 'id_categoria' => 1],
            ['nombre' => 'Hormona paratiroidea', 'descripcion' => 'Evaluación del metabolismo óseo y calcio', 'precio' => 40.00, 'id_categoria' => 1],

            // Category 2: Exámenes de Orina
            ['nombre' => 'General de orina', 'descripcion' => 'Análisis general de orina', 'precio' => 2.00, 'id_categoria' => 2],
            ['nombre' => 'Prueba de embarazo en orina', 'descripcion' => 'Detección de embarazo mediante orina', 'precio' => 5.00, 'id_categoria' => 2],
            ['nombre' => 'Urocultivo', 'descripcion' => 'Cultivo de orina para detectar infecciones', 'precio' => 12.00, 'id_categoria' => 2],
            ['nombre' => 'Proteínas en orina de 24 horas', 'descripcion' => 'Medición de proteínas en orina', 'precio' => 10.00, 'id_categoria' => 2],
            ['nombre' => 'Calcio en orina de 24 horas', 'descripcion' => 'Evaluación del metabolismo del calcio', 'precio' => 6.00, 'id_categoria' => 2],

            // Category 3: Exámenes de Heces
            ['nombre' => 'General de heces', 'descripcion' => 'Análisis general de heces', 'precio' => 2.00, 'id_categoria' => 3],
            ['nombre' => 'Coprocultivo', 'descripcion' => 'Cultivo de heces para detectar bacterias patógenas', 'precio' => 12.00, 'id_categoria' => 3],
            ['nombre' => 'Cultivos de secreciones', 'descripcion' => 'Cultivo para detectar infecciones', 'precio' => 15.00, 'id_categoria' => 3],
            ['nombre' => 'Concentrado de heces', 'descripcion' => 'Prueba para detectar parásitos', 'precio' => 16.00, 'id_categoria' => 3],
            ['nombre' => 'Sangre oculta en heces', 'descripcion' => 'Detección de sangre no visible en heces', 'precio' => 8.00, 'id_categoria' => 3],
            ['nombre' => 'H. pylori en heces', 'descripcion' => 'Detección de Helicobacter pylori en heces', 'precio' => 16.00, 'id_categoria' => 3],

            // Category 4: Pruebas de Coagulación
            ['nombre' => 'Tiempo de sangramiento', 'descripcion' => 'Medición del tiempo de sangrado', 'precio' => 2.00, 'id_categoria' => 4],
            ['nombre' => 'Tiempo de coagulación', 'descripcion' => 'Medición del tiempo de coagulación', 'precio' => 2.00, 'id_categoria' => 4],
            ['nombre' => 'Tiempo de protrombina', 'descripcion' => 'Prueba para evaluar la coagulación sanguínea', 'precio' => 10.00, 'id_categoria' => 4],
            ['nombre' => 'Tiempo de tromboplastina', 'descripcion' => 'Prueba para evaluar la coagulación', 'precio' => 12.00, 'id_categoria' => 4],
            ['nombre' => 'Fibrinógeno', 'descripcion' => 'Medición de fibrinógeno en sangre', 'precio' => 15.00, 'id_categoria' => 4],
            ['nombre' => 'Tiempo de trombina', 'descripcion' => 'Evaluación de la coagulación sanguínea', 'precio' => 16.00, 'id_categoria' => 4],
            ['nombre' => 'Dímero D', 'descripcion' => 'Indicador de formación de coágulos', 'precio' => 55.00, 'id_categoria' => 4],

            // Category 5: Serología
            ['nombre' => 'Chagas anticuerpos totales', 'descripcion' => 'Prueba para detectar Chagas', 'precio' => 24.00, 'id_categoria' => 5],
            ['nombre' => 'Toxoplasma IgG', 'descripcion' => 'Detección de inmunidad a toxoplasmosis', 'precio' => 20.00, 'id_categoria' => 5],
            ['nombre' => 'Toxoplasma IgM', 'descripcion' => 'Detección de infección activa de toxoplasmosis', 'precio' => 20.00, 'id_categoria' => 5],
            ['nombre' => 'Baciloscopia', 'descripcion' => 'Detección de tuberculosis', 'precio' => 6.00, 'id_categoria' => 5],
            ['nombre' => 'H. pylori IgM', 'descripcion' => 'Prueba para detectar infección por H. pylori', 'precio' => 22.00, 'id_categoria' => 5],
            ['nombre' => 'ASO (ASTO)', 'descripcion' => 'Prueba para detectar fiebre reumática', 'precio' => 12.00, 'id_categoria' => 5],
            ['nombre' => 'Proteína C reactiva (PCR)', 'descripcion' => 'Indicador de inflamación', 'precio' => 12.00, 'id_categoria' => 5],
            ['nombre' => 'Hepatitis A IgM', 'descripcion' => 'Prueba para detectar infección por Hepatitis A', 'precio' => 30.00, 'id_categoria' => 5],
            ['nombre' => 'Hepatitis B', 'descripcion' => 'Prueba para detectar infección por Hepatitis B', 'precio' => 30.00, 'id_categoria' => 5],
            ['nombre' => 'Hepatitis C', 'descripcion' => 'Prueba para detectar infección por Hepatitis C', 'precio' => 30.00, 'id_categoria' => 5],
            ['nombre' => 'Monotest (Mononucleosis infecciosa)', 'descripcion' => 'Prueba para detectar mononucleosis', 'precio' => 10.00, 'id_categoria' => 5],

            // Category 6: Hematología
            ['nombre' => 'HT – HB', 'descripcion' => 'Medición de hemoglobina y hematocrito', 'precio' => 2.00, 'id_categoria' => 6],
            ['nombre' => 'Hemograma completo', 'descripcion' => 'Evaluación completa de células sanguíneas', 'precio' => 7.00, 'id_categoria' => 6],
            ['nombre' => 'VES', 'descripcion' => 'Velocidad de sedimentación globular', 'precio' => 5.00, 'id_categoria' => 6],
            ['nombre' => 'Frotis de sangre periférica', 'descripcion' => 'Evaluación de células sanguíneas', 'precio' => 15.00, 'id_categoria' => 6],
            ['nombre' => 'Gota gruesa', 'descripcion' => 'Detección de parásitos en sangre', 'precio' => 10.00, 'id_categoria' => 6],
            ['nombre' => 'Reticulocitos', 'descripcion' => 'Medición de reticulocitos en sangre', 'precio' => 10.00, 'id_categoria' => 6],
            ['nombre' => 'Células LE', 'descripcion' => 'Prueba para lupus', 'precio' => 12.00, 'id_categoria' => 6],
            ['nombre' => 'Látex RF', 'descripcion' => 'Prueba para artritis reumatoide', 'precio' => 12.00, 'id_categoria' => 6],

            // Category 7: Pruebas Especiales
            ['nombre' => 'VIH (PBA rápida)', 'descripcion' => 'Prueba rápida para detección de VIH', 'precio' => 10.00, 'id_categoria' => 7],
            ['nombre' => 'VIH (ELISA)', 'descripcion' => 'Prueba de detección de VIH por ELISA', 'precio' => 25.00, 'id_categoria' => 7],
            ['nombre' => 'VDRL (Sífilis)', 'descripcion' => 'Prueba de detección de sífilis', 'precio' => 4.00, 'id_categoria' => 7],
        ];

        DB::table('Servicios')->insert($servicios);
    }
}
